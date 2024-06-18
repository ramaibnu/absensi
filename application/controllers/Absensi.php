<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Absensi');
    }

    function index()
    {
        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataSidebar['nama_per'] = "PT UNGGUL";
        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = "PT UNGGUL";
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $data['absenfinger'] = $this->M_Absensi->get_absensifinger()->result();
        $data['absen'] = $this->M_Absensi->get_absensifix()->result();
        // foreach ($absenall as $a) {
        //     $date = date('Y-m-d', strtotime($a->datetime));
        //     $jadwal = $this->M_Absensi->get_jadwalshift($a->id_finger, $date)->row();
        //     if (isset($jadwal)) {
        //         $schinstart = $jadwal->jam_masuk;
        //         $schinend = '10:00:00';
        //         $schoutstart = $jadwal->jam_pulang;
        //         $schoutend = '21:00:00';
        //     } else {
        //         $schinstart = '09:00:00';
        //         $schinend = '10:30:00';
        //         $schoutstart = '16:00:00';
        //         $schoutend = '18:30:00';
        //     }
        //     $in = $this->M_Absensi->get_absenin($a->id_finger, $date, $schinstart, $schinend)->row();
        //     $out = $this->M_Absensi->get_absenout($a->id_finger, $date, $schoutstart, $schoutend)->row();
        //     if (isset($a->id_finger)) {
        //         // $abs = new stdClass();
        //         $abs["finger"] = $a->id_finger;
        //         $abs["date"] = date('Y-m-d', strtotime($a->datetime));
        //         if (isset($in->datetime)) {
        //             $abs["in"] = date('H:i:s', strtotime($in->datetime));
        //         } else {
        //             $abs["in"] = '';
        //         }
        //         if (isset($out->datetime)) {
        //             $abs["out"] = date('H:i:s', strtotime($out->datetime));
        //             // $abs["ket"] = $out->ket;
        //         } else {
        //             $abs["out"] = '';
        //         }
        //         $absen[] = $abs;
        //     }
        // }
        // $data['absen'] = array_unique($absen, SORT_REGULAR);
        // $data['absensi'] = $this->M_Absensi->get_absensifix()->result();
        $this->load->view('absensi/data_absensi', $data);

        // Modal
        $this->load->view('components/modal/golongan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/view');

        // Footer
        $this->load->view('components/footer');
    }
    function kalabsen()
    {
        $abslast = $this->M_Absensi->get_abslast()->row();
        if (isset($abslast)) {
            $date = date('Y-m-d', strtotime($abslast->date . "+1 days"));
        } else {
            $absfirst = $this->M_Absensi->get_absenfirst()->row();
            $date = date('Y-m-d', strtotime($absfirst->datetime));
        }
        $absen = array();
        $absenall = $this->M_Absensi->get_absensiall($date)->result();
        foreach ($absenall as $a) {
            $date = date('Y-m-d', strtotime($a->datetime));
            $jadwal = $this->M_Absensi->get_jadwalshift($a->id_finger, $date)->row();
            if (isset($jadwal)) {
                $schinstart = $jadwal->jam_masuk;
                $schinend = (new DateTime($schinstart))->modify('-5 hours')->format('H:i:s');
                $schoutstart = $jadwal->jam_pulang;
                $schoutend = (new DateTime($schoutstart))->modify('-5 hours')->format('H:i:s');

                $in = $this->M_Absensi->get_absenin($a->id_finger, $date, $schinstart, $schinend)->row();
                if ($jadwal->kode_shift == 'N') {
                    $date = date('Y-m-d', strtotime($date . "+1 days"));
                }
                $out = $this->M_Absensi->get_absenout($a->id_finger, $date, $schoutstart, $schoutend)->row();
                if (isset($a->id_finger)) {
                    // $abs = new stdClass();
                    $abs["finger"] = $a->id_finger;
                    $abs["date"] = date('Y-m-d', strtotime($a->datetime));
                    if (isset($in->datetime)) {
                        $abs["in"] = date('H:i:s', strtotime($in->datetime));
                    } else {
                        $abs["in"] = '';
                    }
                    if (isset($out->datetime)) {
                        $abs["out"] = date('H:i:s', strtotime($out->datetime));
                        // $abs["ket"] = $out->ket;
                    } else {
                        $abs["out"] = '';
                    }
                    $absen[] = $abs;
                }
            } else {
                $abs["finger"] = $a->id_finger;
                $abs["date"] = date('Y-m-d', strtotime($a->datetime));
                $abs["in"] = '';
                $abs["out"] = '';
            }
        }
        $data = array_unique($absen, SORT_REGULAR);
        foreach ($data as $a) {
            if ($a['in'] || $a['out']) {
                $idkat = 1;
            } else {
                $idkat = 0;
            }
            $x = array(
                'nik' => $a['finger'],
                'date' => $a['date'],
                'in' => $a['in'],
                'out' => $a['out'],
                'id_kategori' => $idkat
            );
            $this->M_Absensi->add_kalabsen($x);
        }
        redirect(base_url('absensi'));
    }
}
