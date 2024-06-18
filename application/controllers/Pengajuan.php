<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pengajuan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pengajuan');
        $this->load->helper(array('form', 'url', 'file'));
    }

    function viewpengajuan()
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
        $data['kary'] = $this->M_pengajuan->get_karyall()->result();
        $data['data'] = $this->M_pengajuan->get_pengajuanall()->result();
        $this->load->view('kalender/pengajuan', $data);

        // Modal
        $this->load->view('components/modal/golongan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/view');

        // Footer
        $this->load->view('components/footer');
    }
    function addpengajuan()
    {
        $config['upload_path'] = 'upload/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 3000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $data['error'] = $this->upload->display_errors();
        } else {
            $uploaded = $this->upload->data();
        }

        $nikpengaju = $this->input->post('pengaju');
        $tipe = $this->input->post('tipe');
        $date = $this->input->post('date');
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $nikatasan = $this->input->post('atasan');
        $ket = $this->input->post('ket');
        $nmfile = $uploaded['file_name'];

        $x = array(
            'tipe' => $tipe,
            'nik' => $nikpengaju,
            'date' => $date,
            'time_start' => $timestart,
            'time_end' => $timeend,
            'atasan' => $nikatasan,
            'status_doc' => 0,
            'ket' => $ket,
            'nm_file' => $nmfile
        );
        $this->M_pengajuan->add_pengajuan($x);
        redirect(base_url('pengajuan'));
    }
    function updpengajuan($id)
    {
        $this->M_pengajuan->upd_pengajuan($id);
        redirect(base_url('pengajuan'));
    }
}
