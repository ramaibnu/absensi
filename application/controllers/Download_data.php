<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Download_data extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('id_user_hcdata');
        redirect('unallowed');
        $allowedUser = [106, 1, 27, 60, 59, 24];
        if (!$this->authentication()) {
            redirect('login_view');
        } elseif (!in_array($user, $allowedUser)) {
            redirect('unallowed');
        }
    }

    public function karyawan()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];

        $tokenAuth = $this->session->userdata("token");
        $jenisData = htmlspecialchars(trim($this->input->post("jenisData")));
        $perusahaan = htmlspecialchars(trim($this->input->post("perusahaan")));
        $nama_perusahaan = '';
        $jenis_data = '';

        if (!empty($perusahaan)) {
            $parameterPerusahaan = [
                'source' => 'vw_m_prs',
                'field' => 'auth_m_perusahaan',
                'value' => $perusahaan,
            ];
            $dataPerusahaan = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterPerusahaan);
            if ($dataPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPerusahaan = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterPerusahaan);
            }
            $sheet->setCellValue('A1', $dataPerusahaan['data'][0]['nama_perusahaan']);
            $nama_perusahaan = $dataPerusahaan['data'][0]['nama_perusahaan'];
        } else {
            $sheet->setCellValue('A1', "PT UNGGUL DINAMIKA UTAMA");
            $nama_perusahaan = 'PT UNGGUL DINAMIKA UTAMA';
        }

        if ($jenisData == 'NONAKTIF') {
            $parameter = [
                'source' => 'vw_karyawan_nonaktif',
                'field' => 'id_m_perusahaan',
                'value' => 1,
            ];
            $dataKaryawan = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
            }
            $jenis_data = 'KARYAWAN NONAKTIF';
            $sheet->setCellValue('A2', "DATA KARYAWAN NONAKTIF");
            $sheet->setCellValue('A3', "");
            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A1')->getFont()->setSize(20);
            $sheet->getStyle('A2')->getFont()->setSize(14);

            $sheet->setCellValue('A4', "NO");
            $sheet->setCellValue('B4', "NO. KTP");
            $sheet->setCellValue('C4', "NIK");
            $sheet->setCellValue('D4', "NAMA LENGKAP");
            $sheet->setCellValue('E4', "DEPARTEMEN");
            $sheet->setCellValue('F4', "POSISI");
            $sheet->setCellValue('G4', "TANGGAL NONAKTIF");
            $sheet->setCellValue('H4', "ALASAN NONAKTIF");
            $sheet->setCellValue('I4', "KETERANGAN NONAKTIF");

            $sheet->getStyle('A4:I4')->applyFromArray($style_col);

            $no = 1;
            $numrow = 5;

            if ($dataKaryawan['status'] == 200) {
                foreach ($dataKaryawan['data'] as $data) {
                    $sheet->setCellValue('A' . $numrow, $no);
                    $sheet->setCellValueExplicit('B' . $numrow, $data['no_ktp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit('C' . $numrow, $data['no_nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('D' . $numrow, $data['nama_lengkap']);
                    $sheet->setCellValue('E' . $numrow, $data['depart']);
                    $sheet->setCellValue('F' . $numrow, $data['posisi']);
                    $sheet->setCellValue('G' . $numrow, $this->formatIndonesianDate($data['tgl_nonaktif']));
                    $sheet->setCellValue('H' . $numrow, $data['alasan_nonaktif']);
                    $sheet->setCellValue('I' . $numrow, $data['ket_nonaktif']);

                    $sheet->getStyle('A' . $numrow . ':I' . $numrow)->applyFromArray($style_row);

                    $no++;
                    $numrow++;
                }
            } else {
                $sheet->getStyle('A' . $numrow)->getFont()->setBold(true);
                $sheet->getStyle('A' . $numrow)->getFont()->setSize(10);
                $sheet->mergeCells('A' . $numrow . ':I' . $numrow);
                $sheet->setCellValue('A' . $numrow, 'DATA TIDAK DITEMUKAN');
                $sheet->getStyle('A' . $numrow . ':I' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('A' . $numrow . ':I' . $numrow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }

            $sheet->getColumnDimension('A')->setWidth(5);
            $columns = range('B', 'I');

            foreach ($columns as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
        } else {
            $parameter = [
                'source' => 'vw_karyawan',
                'field' => 'tgl_nonaktif',
                'value' => null,
                'field2' => 'auth_m_perusahaan',
                'value2' => $perusahaan,
            ];
            $dataKaryawan = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameter);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameter);
            }
            $jenis_data = 'KARYAWAN AKTIF';
            $sheet->setCellValue('A2', "DATA KARYAWAN");
            $sheet->setCellValue('A3', "");
            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A1')->getFont()->setSize(20);
            $sheet->getStyle('A2')->getFont()->setSize(14);

            $sheet->setCellValue('A4', "NO");
            $sheet->setCellValue('B4', "NO. KTP");
            $sheet->setCellValue('C4', "NAMA LENGKAP");
            $sheet->setCellValue('D4', "TEMPAT & TANGGAL LAHIR");
            $sheet->setCellValue('E4', "ALAMAT");
            $sheet->setCellValue('F4', "AGAMA");
            $sheet->setCellValue('G4', "JENIS KELAMIN");
            $sheet->setCellValue('H4', "STATUS PERNIKAHAN");
            $sheet->setCellValue('I4', "KEWARGANEGARAAN");
            $sheet->setCellValue('J4', "NO. KK");
            $sheet->setCellValue('K4', "NO. NPWP");
            $sheet->setCellValue('L4', "NO. BPJS TENAGA KERJA");
            $sheet->setCellValue('M4', "NO. BPJS KESEHATAN");
            $sheet->setCellValue('N4', "NO. TELEPON");
            $sheet->setCellValue('O4', "EMAIL PRIBADI");
            $sheet->setCellValue('P4', "PENDIDIKAN TERAKHIR");
            $sheet->setCellValue('Q4', "NAMA IBU");
            $sheet->setCellValue('R4', "STATUS IBU");
            $sheet->setCellValue('S4', "BANK");
            $sheet->setCellValue('T4', "PEMILIK REKENING");
            $sheet->setCellValue('U4', "NO. REKENING");
            $sheet->setCellValue('V4', "NAMA EC");
            $sheet->setCellValue('W4', "RELASI EC");
            $sheet->setCellValue('X4', "NOMOR HP EC");
            $sheet->setCellValue('Y4', "NOMOR HP EC 2");
            $sheet->setCellValue('Z4', "NO. NIK");
            $sheet->setCellValue('AA4', "DEPARTEMEN");
            $sheet->setCellValue('AB4', "SECTION");
            $sheet->setCellValue('AC4', "POSISI");
            $sheet->setCellValue('AD4', "LEVEL");
            $sheet->setCellValue('AE4', "GRADE");
            $sheet->setCellValue('AF4', "KLASIFIKASI");
            $sheet->setCellValue('AG4', "GOLONGAN");
            $sheet->setCellValue('AH4', "ROSTER");
            $sheet->setCellValue('AI4', "POH");
            $sheet->setCellValue('AJ4', "LOKASI PENERIMAAN");
            $sheet->setCellValue('AK4', "LOKASI KERJA");
            $sheet->setCellValue('AL4', "EMAIL PERUSAHAAN");
            $sheet->setCellValue('AM4', "STATUS RESIDENCE");
            $sheet->setCellValue('AN4', "DOH");
            $sheet->setCellValue('AO4', "TANGGAL AKTIF");

            $sheet->getStyle('A4:AO4')->applyFromArray($style_col);

            $no = 1;
            $numrow = 5;

            if ($dataKaryawan['status'] == 200) {
                // Data Alamat
                $parameterAlamat = [
                    'source' => 'tb_alamat_ktp',
                    'field' => 'stat_alamat_ktp',
                    'value' => 'T',
                ];
                $alamat = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterAlamat);
                if ($alamat['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $alamat = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterAlamat);
                }
                if ($alamat['status'] == 200) {
                    $dataAlamat = $alamat['data'];
                } else {
                    $dataAlamat = '';
                }

                // Data Daerah
                // Provinsi
                $provinsi = $this->api_drh->provinsi($tokenAuth);
                if ($provinsi['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $provinsi = $this->api_drh->provinsi($newToken);
                }
                if ($provinsi['status'] == 200) {
                    $dataProvinsi = $provinsi['data'];
                } else {
                    $dataProvinsi = '';
                }
                // Kota/Kabupaten
                $kota = $this->api_drh->kota($tokenAuth);
                if ($kota['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kota = $this->api_drh->kota($newToken);
                }
                if ($kota['status'] == 200) {
                    $dataKota = $kota['data'];
                } else {
                    $dataKota = '';
                }
                // Kecamatan
                $kecamatan = $this->api_drh->kecamatan($tokenAuth);
                if ($kecamatan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kecamatan = $this->api_drh->kecamatan($newToken);
                }
                if ($kecamatan['status'] == 200) {
                    $dataKecamatan = $kecamatan['data'];
                } else {
                    $dataKecamatan = '';
                }
                // Kelurahan
                $kelurahan = $this->api_drh->kelurahan($tokenAuth);
                if ($kelurahan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kelurahan = $this->api_drh->kelurahan($newToken);
                }
                if ($kelurahan['status'] == 200) {
                    $dataKelurahan = $kelurahan['data'];
                } else {
                    $dataKelurahan = '';
                }

                // Data Pendidikan
                $parameterPendidikan = [
                    'source' => 'tb_pendidikan',
                    'field' => 'stat_pendidikan',
                    'value' => 'T',
                ];
                $pendidikan = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterPendidikan);
                if ($pendidikan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $pendidikan = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterPendidikan);
                }
                if ($pendidikan['status'] == 200) {
                    $dataPendidikan = $pendidikan['data'];
                } else {
                    $dataPendidikan = '';
                }

                // Data Bank
                $parameterBank = [
                    'source' => 'vw_bank_kary',
                    'field' => 'stat_bank_kary',
                    'value' => 'T',
                ];
                $bank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
                if ($bank['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $bank = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterBank);
                }
                if ($bank['status'] == 200) {
                    $dataBank = $bank['data'];
                } else {
                    $dataBank = '';
                }

                // Data Emergency Contact
                $parameterEc = [
                    'source' => 'tb_ec',
                    'field' => 'stat_ec',
                    'value' => 'T',
                ];
                $emergency_contact = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
                if ($emergency_contact['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $emergency_contact = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterEc);
                }
                if ($emergency_contact['status'] == 200) {
                    $dataEc = $emergency_contact['data'];
                } else {
                    $dataEc = '';
                }

                foreach ($dataKaryawan['data'] as $data) {
                    // Find Pendidikan
                    if ($data['id_pendidikan'] == 0 || empty($data['id_pendidikan'])) {
                        $pendidikan = '';
                    } else {
                        if (!empty($dataPendidikan)) {
                            $pendidikanKey = 'id_pendidikan';
                            $pendidikanValue = $data['id_pendidikan'];

                            $pendidikanValueIndex = array_search($pendidikanValue, array_column($dataPendidikan, $pendidikanKey));
                            if ($pendidikanValueIndex !== false) {
                                $pendidikanSubArrayIndex = array_keys(array_column($dataPendidikan, $pendidikanKey), $pendidikanValue)[0];
                                $pendidikan = $dataPendidikan[$pendidikanSubArrayIndex]['pendidikan'];
                            } else {
                                $pendidikan = '';
                            }
                        } else {
                            $pendidikan = '';
                        }
                    }

                    if ($data['id_personal'] == 0 || empty($data['id_personal'])) {
                        $bank = '';
                        $pemilikBank = '';
                        $rekeningBank = '';
                        $namaEc = '';
                        $relasiEc = '';
                        $noHPEc = '';
                        $noHPEc2 = '';
                        $alamat = '';
                    } else {
                        // Find Data Bank
                        if (!empty($dataBank)) {
                            $bankKey = 'id_personal';
                            $bankValue = $data['id_personal'];

                            $bankValueIndex = array_search($bankValue, array_column($dataBank, $bankKey));
                            if ($bankValueIndex !== false) {
                                $bankSubArrayIndex = array_keys(array_column($dataBank, $bankKey), $bankValue)[0];
                                $bank = $dataBank[$bankSubArrayIndex]['bank'];
                                $pemilikBank = $dataBank[$bankSubArrayIndex]['nama_pemilik'];
                                $rekeningBank = $dataBank[$bankSubArrayIndex]['no_rek'];
                            } else {
                                $bank = '';
                                $pemilikBank = '';
                                $rekeningBank = '';
                            }
                        } else {
                            $bank = '';
                            $pemilikBank = '';
                            $rekeningBank = '';
                        }
                        // Find Data Emergency Contact
                        if (!empty($dataEc)) {
                            $ecKey = 'id_personal';
                            $ecValue = $data['id_personal'];

                            $ecValueIndex = array_search($ecValue, array_column($dataEc, $ecKey));
                            if ($ecValueIndex !== false) {
                                $ecSubArrayIndex = array_keys(array_column($dataEc, $ecKey), $ecValue)[0];
                                $namaEc = $dataEc[$ecSubArrayIndex]['nama_ec'];
                                $relasiEc = $dataEc[$ecSubArrayIndex]['relasi_ec'];
                                $noHPEc = $dataEc[$ecSubArrayIndex]['hp_ec'];
                                $noHPEc2 = $dataEc[$ecSubArrayIndex]['hp_ec_2'];
                            } else {
                                $namaEc = '';
                                $relasiEc = '';
                                $noHPEc = '';
                                $noHPEc2 = '';
                            }
                        } else {
                            $namaEc = '';
                            $relasiEc = '';
                            $noHPEc = '';
                            $noHPEc2 = '';
                        }
                        // Find Alamat
                        if (!empty($dataAlamat)) {
                            $alamatKey = 'id_personal';
                            $alamatValue = $data['id_personal'];

                            $alamatValueIndex = array_search($alamatValue, array_column($dataAlamat, $alamatKey));
                            if ($alamatValueIndex !== false) {
                                $alamatSubArrayIndex = array_keys(array_column($dataAlamat, $alamatKey), $alamatValue)[0];
                                $temporaryAlamat = $dataAlamat[$alamatSubArrayIndex]['alamat_ktp'];
                                $rt = $dataAlamat[$alamatSubArrayIndex]['rt_ktp'];
                                $rw = $dataAlamat[$alamatSubArrayIndex]['rw_ktp'];
                                $temporaryProvinsi = $dataAlamat[$alamatSubArrayIndex]['prov_ktp'];
                                $temporaryKota = $dataAlamat[$alamatSubArrayIndex]['kab_ktp'];
                                $temporaryKecamatan = $dataAlamat[$alamatSubArrayIndex]['kec_ktp'];
                                $temporaryKabupaten = $dataAlamat[$alamatSubArrayIndex]['kel_ktp'];
                                if (!empty($temporaryProvinsi)) {
                                    $provinsiKey = 'id';
                                    $provinsiValue = $temporaryProvinsi;
                                    if (!empty($dataProvinsi)) {
                                        $provinsiValueIndex = array_search($provinsiValue, array_column($dataProvinsi, $provinsiKey));
                                        if ($provinsiValueIndex !== false) {
                                            $provinsiSubArrayIndex = array_keys(array_column($dataProvinsi, $provinsiKey), $provinsiValue)[0];
                                            $provinsi = $dataProvinsi[$provinsiSubArrayIndex]['name'];
                                        } else {
                                            $provinsi = '';
                                        }
                                    } else {
                                        $provinsi = '';
                                    }
                                } else {
                                    $provinsi = '';
                                }
                                if (!empty($temporaryKota)) {
                                    $kotaKey = 'id';
                                    $kotaValue = $temporaryKota;
                                    if (!empty($dataKota)) {
                                        $kotaValueIndex = array_search($kotaValue, array_column($dataKota, $kotaKey));
                                        if ($kotaValueIndex !== false) {
                                            $kotaSubArrayIndex = array_keys(array_column($dataKota, $kotaKey), $kotaValue)[0];
                                            $kota = $dataKota[$kotaSubArrayIndex]['name'];
                                        } else {
                                            $kota = '';
                                        }
                                    } else {
                                        $kota = '';
                                    }
                                } else {
                                    $kota = '';
                                }
                                if (!empty($temporaryKecamatan)) {
                                    $kecamatanKey = 'id';
                                    $kecamatanValue = $temporaryKecamatan;
                                    if (!empty($dataKecamatan)) {
                                        $kecamatanValueIndex = array_search($kecamatanValue, array_column($dataKecamatan, $kecamatanKey));
                                        if ($kecamatanValueIndex !== false) {
                                            $kecamatanSubArrayIndex = array_keys(array_column($dataKecamatan, $kecamatanKey), $kecamatanValue)[0];
                                            $kecamatan = $dataKecamatan[$kecamatanSubArrayIndex]['name'];
                                        } else {
                                            $kecamatan = '';
                                        }
                                    } else {
                                        $kecamatan = '';
                                    }
                                } else {
                                    $kecamatan = '';
                                }
                                if (!empty($temporaryKelurahan)) {
                                    $kelurahanKey = 'id';
                                    $kelurahanValue = $temporaryKelurahan;
                                    if (!empty($dataKelurahan)) {
                                        $kelurahanValueIndex = array_search($kelurahanValue, array_column($dataKelurahan, $kelurahanKey));
                                        if ($kelurahanValueIndex !== false) {
                                            $kelurahanSubArrayIndex = array_keys(array_column($dataKelurahan, $kelurahanKey), $kelurahanValue)[0];
                                            $kelurahan = $dataKelurahan[$kelurahanSubArrayIndex]['name'];
                                        } else {
                                            $kelurahan = '';
                                        }
                                    } else {
                                        $kelurahan = '';
                                    }
                                } else {
                                    $kelurahan = '';
                                }
                                $alamat = $temporaryAlamat . $rt . $rw . " KEL. " . $kelurahan . ", KEC. " . $kecamatan . ", " . $kota . " - " . $provinsi;
                            } else {
                                $alamat = '';
                            }
                        } else {
                            $alamat = '';
                        }
                    }

                    if ($data['stat_ibu'] == 'H') {
                        $statusIbu = 'Masih Ada';
                    } elseif ($data['stat_ibu'] == 'M') {
                        $statusIbu = 'Tidak Ada';
                    } else {
                        $statusIbu = '';
                    }

                    $sheet->setCellValue('A' . $numrow, $no);
                    $sheet->setCellValueExplicit('B' . $numrow, $data['no_ktp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('C' . $numrow, $data['nama_lengkap']);
                    $sheet->setCellValue('D' . $numrow, ($data['tmp_lahir'] ?? '-') . ', ' . ($data['tgl_lahir'] == "1970-01-01" ? '-' : $this->formatIndonesianDate($data['tgl_lahir'])));
                    $sheet->setCellValue('E' . $numrow, $alamat);
                    $sheet->setCellValue('F' . $numrow, $data['agama']);
                    $sheet->setCellValue('G' . $numrow, ((($data['jk'] == 'LK') ? "LAKI-LAKI" : "PEREMPUAN")) ?? '-');
                    $sheet->setCellValue('H' . $numrow, $data['id_stat_nikah'] != 0 || $data['id_stat_nikah'] != '' ? $data['stat_nikah'] : '');
                    $sheet->setCellValue('I' . $numrow, $data['warga_negara']);
                    $sheet->setCellValueExplicit('J' . $numrow, $data['no_kk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit('K' . $numrow, $data['no_npwp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('L' . $numrow, $data['no_bpjstk']);
                    $sheet->setCellValue('M' . $numrow, $data['no_bpjskes']);
                    $sheet->setCellValue('N' . $numrow, $data['hp_1']);
                    $sheet->setCellValue('O' . $numrow, $data['email_pribadi']);
                    $sheet->setCellValue('P' . $numrow, $pendidikan);
                    $sheet->setCellValue('Q' . $numrow, $data['nama_ibu']);
                    $sheet->setCellValue('R' . $numrow, $statusIbu);
                    $sheet->setCellValue('S' . $numrow, $bank);
                    $sheet->setCellValue('T' . $numrow, $pemilikBank);
                    $sheet->setCellValue('U' . $numrow, $rekeningBank);
                    $sheet->setCellValue('V' . $numrow, $namaEc);
                    $sheet->setCellValue('W' . $numrow, $relasiEc);
                    $sheet->setCellValue('X' . $numrow, $noHPEc != '0' ? $noHPEc : '');
                    $sheet->setCellValue('Y' . $numrow, $noHPEc2 != '0' ? $noHPEc2 : '');
                    $sheet->setCellValueExplicit('Z' . $numrow, $data['no_nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('AA' . $numrow, $data['id_depart'] != 0 || $data['id_depart'] != '' ? $data['depart'] : '');
                    $sheet->setCellValue('AB' . $numrow, $data['id_section'] != 0 || $data['id_section'] != '' ? $data['section'] : '');
                    $sheet->setCellValue('AC' . $numrow, $data['id_posisi'] != 0 || $data['id_posisi'] != '' ? $data['posisi'] : '');
                    $sheet->setCellValue('AD' . $numrow, $data['id_level'] != 0 || $data['id_level'] != '' ? $data['level'] : '');
                    $sheet->setCellValue('AE' . $numrow, $data['id_grade'] != 0 || $data['id_grade'] != '' ? $data['grade'] : '');
                    $sheet->setCellValue('AF' . $numrow, $data['id_klasifikasi'] != 0 || $data['id_klasifikasi'] != '' ? $data['klasifikasi'] : '');
                    $sheet->setCellValue('AG' . $numrow, $data['id_tipe'] != 0 || $data['id_tipe'] != '' ? $data['tipe'] : '');
                    $sheet->setCellValue('AH' . $numrow, $data['id_roster'] != 0 || $data['id_roster'] != '' ? $data['roster'] : '');
                    $sheet->setCellValue('AI' . $numrow, $data['id_poh'] != 0 || $data['id_poh'] != '' ? $data['poh'] : '');
                    $sheet->setCellValue('AJ' . $numrow, $data['id_lokterima'] != 0 || $data['id_lokterima'] != '' ? $data['lokterima'] : '');
                    $sheet->setCellValue('AK' . $numrow, $data['id_lokker'] != 0 || $data['id_lokker'] != '' ? $data['lokker'] : '');
                    $sheet->setCellValue('AL' . $numrow, $data['email_kantor']);
                    $sheet->setCellValue('AM' . $numrow, $data['id_stat_tinggal'] != 0 || $data['id_stat_tinggal'] != '' ? $data['stat_tinggal'] : '');
                    $sheet->setCellValue('AN' . $numrow, $data['doh'] != '1970-01-01' || $data['doh'] != '' ? $this->formatIndonesianDate($data['doh']) : '');
                    $sheet->setCellValue('AO' . $numrow, $data['tgl_aktif'] != '1970-01-01' || $data['tgl_aktif'] != '' ? $this->formatIndonesianDate($data['tgl_aktif']) : '');

                    $sheet->getStyle('A' . $numrow . ':AO' . $numrow)->applyFromArray($style_row);

                    $no++;
                    $numrow++;
                }
            } else {
                $sheet->getStyle('A' . $numrow)->getFont()->setBold(true)->setSize(10);
                $sheet->mergeCells('A' . $numrow . ':AO' . $numrow);
                $sheet->setCellValue('A' . $numrow, 'DATA TIDAK DITEMUKAN');
                $sheet->getStyle('A' . $numrow . ':AO' . $numrow)
                    ->applyFromArray($style_row)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }

            $sheet->getColumnDimension('A')->setWidth(5);
            $columns = range('B', 'Z');

            foreach ($columns as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
            $sheet->getColumnDimension('AA')->setAutoSize(true);
            $sheet->getColumnDimension('AB')->setAutoSize(true);
            $sheet->getColumnDimension('AC')->setAutoSize(true);
            $sheet->getColumnDimension('AD')->setAutoSize(true);
            $sheet->getColumnDimension('AE')->setAutoSize(true);
            $sheet->getColumnDimension('AF')->setAutoSize(true);
            $sheet->getColumnDimension('AG')->setAutoSize(true);
            $sheet->getColumnDimension('AH')->setAutoSize(true);
            $sheet->getColumnDimension('AI')->setAutoSize(true);
            $sheet->getColumnDimension('AJ')->setAutoSize(true);
            $sheet->getColumnDimension('AK')->setAutoSize(true);
            $sheet->getColumnDimension('AL')->setAutoSize(true);
            $sheet->getColumnDimension('AM')->setAutoSize(true);
            $sheet->getColumnDimension('AN')->setAutoSize(true);
            $sheet->getColumnDimension('AO')->setAutoSize(true);
        }

        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("Data Karyawan");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Karyawan.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // Audit
        $endpointAudit = 'tambah_audit';
        $parameterAudit = [
            'jenis' => 'DOWNLOAD',
            'data' => 'KARYAWAN',
            'keterangan' => $jenis_data . ' | ' . $nama_perusahaan,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $audit = $this->std->api($endpointAudit, $this->postMethod(), $tokenAuth, $parameterAudit);
        if ($audit == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $audit = $this->std->api($endpointAudit, $this->postMethod(), $newToken, $parameterAudit);
        }
    }

    public function pelanggaran()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];

        $tokenAuth = $this->session->userdata("token");
        $jenisData = htmlspecialchars(trim($this->input->post("jenisData")));
        $jenis_data = '';
        $today = date('Y-m-d');

        if ($jenisData == 'AKTIF') {
            $parameter = [
                'source' => 'vw_langgar',
                'field' => 'tgl_akhir_langgar >=',
                'value' => $today,
            ];
            $dataKaryawan = $this->api_plg->read_specific_data($parameter, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_plg->read_specific_data($parameter, $newToken);
            }
            $jenis_data = 'PELANGGARAN AKTIF';
        } else {
            $parameter = [
                'source' => 'vw_langgar',
                'field' => 'tgl_akhir_langgar <',
                'value' => $today,
            ];
            $dataKaryawan = $this->api_plg->read_specific_data($parameter, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_plg->read_specific_data($parameter, $newToken);
            }
            $jenis_data = 'PELANGGARAN NONAKTIF';
        }

        $sheet->setCellValue('A1', "PT UNGGUL DINAMIKA UTAMA");
        $sheet->setCellValue('A2', "DATA PELANGGARAN");
        $sheet->setCellValue('A3', "");
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(20);
        $sheet->getStyle('A2')->getFont()->setSize(14);

        $sheet->setCellValue('A4', "NO");
        $sheet->setCellValue('B4', "NO. KTP");
        $sheet->setCellValue('C4', "NO. NIK");
        $sheet->setCellValue('D4', "NAMA LENGKAP");
        $sheet->setCellValue('E4', "DEPARTEMEN");
        $sheet->setCellValue('F4', "POSISI");
        $sheet->setCellValue('G4', "TANGGAL PELANGGARAN");
        $sheet->setCellValue('H4', "DISCIPLINARY ACTION");
        $sheet->setCellValue('I4', "TANGGAL BERLAKU");
        $sheet->setCellValue('J4', "TANGGAL BERAKHIR");
        $sheet->setCellValue('K4', "KETERANGAN");

        $sheet->getStyle('A4:K4')->applyFromArray($style_col);

        $no = 1;
        $numrow = 5;

        if ($dataKaryawan['status'] == 200) {
            foreach ($dataKaryawan['data'] as $data) {
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValueExplicit('B' . $numrow, $data['no_ktp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue('C' . $numrow, $data['no_nik']);
                $sheet->setCellValue('D' . $numrow, $data['nama_lengkap']);
                $sheet->setCellValue('E' . $numrow, $data['depart']);
                $sheet->setCellValue('F' . $numrow, $data['posisi']);
                $sheet->setCellValue('G' . $numrow, $this->formatIndonesianDate($data['tgl_langgar']));
                $sheet->setCellValue('H' . $numrow, $data['kode_langgar_jenis'] . ' | ' . $data['langgar_jenis']);
                $sheet->setCellValue('I' . $numrow, $this->formatIndonesianDate($data['tgl_punishment']));
                $sheet->setCellValue('J' . $numrow, $this->formatIndonesianDate($data['tgl_akhir_langgar']));
                $sheet->setCellValue('K' . $numrow, strtoupper($data['ket_langgar']));

                $sheet->getStyle('A' . $numrow . ':K' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }
        } else {
            $sheet->getStyle('A' . $numrow)->getFont()->setBold(true);
            $sheet->getStyle('A' . $numrow)->getFont()->setSize(10);
            $sheet->mergeCells('A' . $numrow . ':K' . $numrow);
            $sheet->setCellValue('A' . $numrow, 'DATA TIDAK DITEMUKAN');
            $sheet->getStyle('A' . $numrow . ':K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('A' . $numrow . ':K' . $numrow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $columns = range('B', 'K');

        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("Data Pelanggaran");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Pelanggaran.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // Audit
        $endpointAudit = 'tambah_audit';
        $parameterAudit = [
            'jenis' => 'DOWNLOAD',
            'data' => 'PELANGGARAN',
            'keterangan' => $jenis_data . ' | PT UNGGUL DINAMIKA UTAMA',
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $audit = $this->std->api($endpointAudit, $this->postMethod(), $tokenAuth, $parameterAudit);
        if ($audit == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $audit = $this->std->api($endpointAudit, $this->postMethod(), $newToken, $parameterAudit);
        }
    }
}
