<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Jadwal');
    }

    function index()
    {
    }
    function set_plan()
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
        $data['kary'] = $this->M_Jadwal->get_karyall()->result();
        $data['depart'] = $this->M_Jadwal->get_departemenall()->result();
        $this->load->view('jadwal/setting_plan', $data);

        // Modal
        $this->load->view('components/modal/golongan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/view');

        // Footer
        $this->load->view('components/footer');
    }
    function plan()
    {
        $id_depart = $this->input->post('depart');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        if (!isset($start) && !isset($end)) {
            $id_depart = 4;
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        } else {
            $data['dpt'] = $this->M_Jadwal->get_departid($id_depart)->row();
            $data['start'] = $start;
            $data['end'] = $end;
        }
        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataSidebar['nama_per'] = "PT UNGGUL";
        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = "PT UNGGUL";
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $data['depart'] = $this->M_Jadwal->get_departemenall()->result();
        $kary = $this->M_Jadwal->get_kary_depart($id_depart)->result();
        $data['jadwal'] = $this->M_Jadwal->get_jadwalkarytest($start, $end)->result();
        $data['jadwalgroup'] = $this->M_Jadwal->get_jadwalkarygroup($start, $end)->result();
        foreach ($kary as $a) {
            $dt = [];
            $dt['nama'] = $a->nama_lengkap;
            $dt['depart'] = $a->depart;
            $dt['posisi'] = $a->posisi;
            $row = $this->M_Jadwal->get_jadwalkary($a->no_nik, $start, $end)->result();
            $x = 1;
            foreach ($row as $r) {
                $dt[$r->date] = $r->kode_shift;
                $x++;
            }
            $ar[] = $dt;
        }
        $data['data'] = $ar;
        $data['start'] = $start;
        $data['end'] = $end;
        $this->load->view('jadwal/plan', $data);

        // Modal
        $this->load->view('components/modal/golongan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/view');

        // Footer
        $this->load->view('components/footer');
    }
    function updjadwal()
    {
        $nik = $this->input->post('nik');
        $date = $this->input->post('date');

        $x = array(
            'kode_shift' => $this->input->post('tipe')
        );
        $this->M_Jadwal->upd_jadwal($nik, $date, $x);
        redirect(base_url('plan'));
    }
}
