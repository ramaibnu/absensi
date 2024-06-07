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
        $absen = array();
        $absenall = $this->M_Absensi->get_absensiall()->result();
        foreach ($absenall as $a) {
            $date = date('Y-m-d', strtotime($a->datetime));
            $in = $this->M_Absensi->get_absenin($a->id_finger, $date)->row();
            $out = $this->M_Absensi->get_absenout($a->id_finger, $date)->row();
            if (isset($a->id_finger)) {
                // $abs = new stdClass();
                $abs["finger"] = $a->id_finger;
                $abs["date"] = date('Y-m-d', strtotime($a->datetime));
                $abs["in"] = date('H:i:s', strtotime($in->datetime));
                $abs["out"] = date('H:i:s', strtotime($out->datetime));
                $absen[] = $abs;
            }
        }
        $data['absen'] = array_unique($absen, SORT_REGULAR);
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
}
