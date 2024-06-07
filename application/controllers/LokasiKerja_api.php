<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LokasiKerja_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    // View
    public function index()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataID = [
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
        ];

        $result = $this->api_prs->read_specific_data($dataID, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_prs->read_specific_data($dataID, $newToken);
            $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        } else {
            $dataSidebar['nama_per'] = "PT UNGGUL";
        }

        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $this->load->view('data_master/lokasi_kerja/view');

        // Modal
        $this->load->view('components/modal/lokasi_kerja');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/lokasi_kerja/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_lokasi_kerja()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataID = [
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
        ];

        $result = $this->api_prs->read_specific_data($dataID, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_prs->read_specific_data($dataID, $newToken);
        }
        $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $this->load->view('data_master/lokasi_kerja/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/lokasi_kerja/add');

        // Footer
        $this->load->view('components/footer');
    }

    // Process
    public function datatables()
    {
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_lkr->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_lkr->datatables($data, $newToken);
        }
        if ($datatables['status'] == 200 || $datatables['status'] == 404) {
            echo json_encode($datatables['data']);
        } else {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
            echo json_encode($output);
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_lokker_hcdata');
        $auth_lokker = htmlspecialchars(trim($this->input->post("auth_lokker")));
        $tokenAuth = $this->session->userdata('token');

        $dataLokasiKerja = [
            'field' => 'auth_lokker',
            'value' => $auth_lokker,
        ];
        $result = $this->api_lkr->read_specific_data($dataLokasiKerja, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lkr->read_specific_data($dataLokasiKerja, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_lokker'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'kode' => $result['data'][0]['kd_lokker'],
                'lokker' => $result['data'][0]['lokker'],
                'ket' => $result['data'][0]['ket_lokker'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_lokker_hcdata', $result['data'][0]['id_lokker']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $kd_lokker = strtoupper(htmlspecialchars($this->input->post("kode", true)));
        $lokker = strtoupper(htmlspecialchars($this->input->post("lokker", true)));
        $ket_lokker = htmlspecialchars($this->input->post("ket"));

        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'kd_lokker',
            'value' => $kd_lokker,
        ];
        $checkKode = $this->api_lkr->read_specific_data($dataID, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api_lkr->read_specific_data($dataID, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID2 = [
            'field' => 'lokker',
            'value' => $lokker,
        ];
        $checkLokasiKerja = $this->api_lkr->read_specific_data($dataID2, $tokenAuth);
        if ($checkLokasiKerja['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkLokasiKerja = $this->api_lkr->read_specific_data($dataID2, $newToken);
        }
        if ($checkLokasiKerja['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kd_lokker' => $kd_lokker,
            'lokker' => $lokker,
            'ket_lokker' => $ket_lokker,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $result = $this->api_lkr->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lkr->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi Kerja berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_lokker = $this->session->userdata('id_lokker_hcdata');

        if ($id_lokker == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $kd_lokker = strtoupper(htmlspecialchars($this->input->post("kode", true)));
        $lokker = strtoupper(htmlspecialchars($this->input->post("lokker", true)));
        $ket_lokker = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataKode = [
            'source' => 'tb_lokker',
            'field' => 'id_lokker !=',
            'value' => $id_lokker,
            'field2' => 'kd_lokker',
            'value2' => $kd_lokker,
        ];

        $checkKode = $this->api->specific_data_by_2_fields($dataKode, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api->specific_data_by_2_fields($dataKode, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataLokasiKerja = [
            'source' => 'tb_lokker',
            'field' => 'id_lokker !=',
            'value' => $id_lokker,
            'field2' => 'lokker',
            'value2' => $lokker,
        ];

        $checkLokasiKerja = $this->api->specific_data_by_2_fields($dataLokasiKerja, $tokenAuth);
        if ($checkLokasiKerja['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkLokasiKerja = $this->api->specific_data_by_2_fields($dataLokasiKerja, $newToken);
        }
        if ($checkLokasiKerja['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_lokker' => $id_lokker,
            'kd_lokker' => $kd_lokker,
            'lokker' => $lokker,
            'ket_lokker' => $ket_lokker,
            'status' => $status,
        ];

        $result = $this->api_lkr->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lkr->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_lokker_hcdata');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi Kerja berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Lokasi Kerja gagal diupdate', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_lokker = htmlspecialchars(trim($this->input->post('auth_lokker')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_lokker',
            'value' => $auth_lokker,
        ];
        $id_lokasi_kerja = $this->api_lkr->read_specific_data($dataID, $tokenAuth);
        if ($id_lokasi_kerja['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_lokasi_kerja = $this->api_lkr->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_lokker' => $id_lokasi_kerja['data'][0]['id_lokker'],
        ];

        $result = $this->api_lkr->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lkr->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi Kerja berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi Kerja gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}