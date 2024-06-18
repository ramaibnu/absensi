<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Exportimport extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Jadwal');
    }
    function export()
    {
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $id_depart = $this->input->post('depart');
        $depart = $this->M_Jadwal->get_departid($id_depart)->row();
        $karyawan = $this->M_Jadwal->get_kary_depart($id_depart)->result();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Ambil objek worksheet pertama (indeks 0)
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValueByColumnAndRow(1, 1, 'PT Unggul Dinamika Utama');
        $worksheet->setCellValueByColumnAndRow(1, 2, $depart->depart);
        $worksheet->setCellValueByColumnAndRow(1, 3, $start . ' - ' . $end);

        $worksheet->setCellValueByColumnAndRow(1, 4, 'Nama');
        $worksheet->setCellValueByColumnAndRow(2, 4, 'Departemen');
        $worksheet->setCellValueByColumnAndRow(3, 4, 'Posisi');

        // Auto size kolom untuk baris 1 sampai 4
        for ($col = 1; $col <= 3; $col++) {
            $worksheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }



        // Tentukan tanggal awal dan akhir bulan
        // $startDate = new DateTime('first day of this month');
        // $endDate = new DateTime('last day of this month');
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);

        // Inisialisasi indeks kolom
        $columnIndex = 4;

        // Loop untuk setiap hari dalam bulan ini
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            // Ambil nilai tanggal saat ini
            $currentDateValue = $currentDate->format('Y-m-d');

            // Set nilai di sel yang sesuai
            $worksheet->setCellValueByColumnAndRow($columnIndex, 4, $currentDateValue);

            // Auto size kolom
            $worksheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);

            // Pindah ke kolom berikutnya
            $columnIndex++;

            // Tambahkan 1 hari ke tanggal saat ini
            $currentDate->modify('+1 day');
        }

        // Looping Karyawan
        $namaRow = 5; // Mulai baris di bawah header
        foreach ($karyawan as $nama) {
            $worksheet->setCellValueByColumnAndRow(1, $namaRow, $nama->nama_lengkap);
            $worksheet->setCellValueByColumnAndRow(2, $namaRow, $depart->depart);
            $worksheet->setCellValueByColumnAndRow(3, $namaRow, $nama->posisi);
            $namaRow++;
        }

        // Ambil dimensi sel
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $worksheet->getStyle('A4:' . $highestColumn . $highestRow)->applyFromArray($styleArray);
        $worksheet->getStyle('A1:A3')->getFont()->setBold(true);
        $worksheet->getStyle('A4:' . $highestColumn . '4')->getFont()->setBold(true);
        $worksheet->getStyle('A4:' . $highestColumn . '4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Buat objek Writer
        $writer = new Xlsx($spreadsheet);

        // Tentukan nama file yang akan diekspor
        $filename = 'export_excel ' . $start . ' -' . $end . '.xlsx';

        // Atur header untuk membuat file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file Excel ke output
        $writer->save('php://output');
    }
    function import()
    {
        date_default_timezone_set('Asia/Jakarta');
        $start =  new DateTime($this->input->post('start'));
        $end =  new DateTime(date('Y-m-d', strtotime($this->input->post('end') . "+1 days")));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);

        // Mendapatkan nama file yang diunggah
        $uploadedFile = $_FILES['file']['tmp_name'];

        // Membaca file Excel
        $spreadsheet = IOFactory::load($uploadedFile);

        // Mendapatkan sheet aktif
        $worksheet = $spreadsheet->getActiveSheet();

        // Mendapatkan dimensi data (baris dan kolom)
        $highestRow = $worksheet->getHighestDataRow();
        $highestColumn = $worksheet->getHighestDataColumn();
        // var_dump($worksheet->getRowIterator());
        // die;

        // Inisialisasi array untuk menyimpan data dari Excel
        $data = [];
        $index = 0;
        // Loop untuk membaca setiap sel dan menyimpan nilainya ke dalam array
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
            if ($index >= 4) {
                // var_dump($data[$index]);
                // die;
                $indshift = 3;
                foreach ($period as $dt) {
                    $kary = $this->M_Jadwal->get_kary_nama($data[$index][0])->row();
                    $x = array(
                        'nik' => $kary->no_nik,
                        'date' => $dt->format("Y-m-d"),
                        'kode_shift' => $data[$index][$indshift]
                    );
                    $this->M_Jadwal->add_jadwal($x);
                    $indshift++;
                }
            }
            $index++;
        }

        // var_dump($data[4]);
        // die;
        // Sekarang variabel $data berisi seluruh data dari file Excel

        // Lakukan sesuatu dengan data yang diimpor, seperti menyimpan ke database, dll.

        // Misalnya, tampilkan data yang diimpor
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        $this->session->set_flashdata('sukses', 'Upload Plan Kehadiran Berhasil!');
        redirect(base_url('set_plan'));
    }
}
