<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Karyawan');
    }

    function viewkaryawan()
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
        $data['karyawan'] = $this->M_Karyawan->get_allkaryawan()->result();

        $this->load->view('karyawan/data_karyawan', $data);

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
