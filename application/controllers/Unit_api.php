<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_api extends MY_Controller
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
        $this->load->view('data_master/unit/view');

        // Modal
        $this->load->view('components/modal/unit');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/unit/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_unit()
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
        $this->load->view('data_master/unit/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/unit/add');

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

        $datatables = $this->api_unt->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_unt->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_unit_hcdata');
        $auth_unit = htmlspecialchars(trim($this->input->post("auth_unit")));
        $tokenAuth = $this->session->userdata('token');

        $dataUnit = [
            'field' => 'auth_unit',
            'value' => $auth_unit,
        ];
        $result = $this->api_unt->read_specific_data($dataUnit, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_unt->read_specific_data($dataUnit, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_unit'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'kode_unit' => $result['data'][0]['kode_unit'],
                'unit' => $result['data'][0]['unit'],
                'ket' => $result['data'][0]['ket_unit'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_unit_hcdata', $result['data'][0]['id_unit']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Unit tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $kode_unit = strtoupper(htmlspecialchars($this->input->post("kode_unit", true)));
        $unit = strtoupper(htmlspecialchars($this->input->post("unit", true)));
        $ket_unit = htmlspecialchars($this->input->post("ket"));

        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'kode_unit',
            'value' => $kode_unit,
        ];
        $checkKode = $this->api_unt->read_specific_data($dataID, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api_unt->read_specific_data($dataID, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID2 = [
            'field' => 'unit',
            'value' => $unit,
        ];
        $checkUnit = $this->api_unt->read_specific_data($dataID2, $tokenAuth);
        if ($checkUnit['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkUnit = $this->api_unt->read_specific_data($dataID2, $newToken);
        }
        if ($checkUnit['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kode_unit' => $kode_unit,
            'unit' => $unit,
            'ket_unit' => $ket_unit,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $result = $this->api_unt->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_unt->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_unit = $this->session->userdata('id_unit_hcdata');

        if ($id_unit == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $kode_unit = strtoupper(htmlspecialchars($this->input->post("kode_unit", true)));
        $unit = strtoupper(htmlspecialchars($this->input->post("unit", true)));
        $ket_unit = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataKode = [
            'source' => 'tb_unit',
            'field' => 'id_unit !=',
            'value' => $id_unit,
            'field2' => 'kode_unit',
            'value2' => $kode_unit,
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

        $dataUnit = [
            'source' => 'tb_unit',
            'field' => 'id_unit !=',
            'value' => $id_unit,
            'field2' => 'unit',
            'value2' => $unit,
        ];

        $checkUnit = $this->api->specific_data_by_2_fields($dataUnit, $tokenAuth);
        if ($checkUnit['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkUnit = $this->api->specific_data_by_2_fields($dataUnit, $newToken);
        }
        if ($checkUnit['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_unit' => $id_unit,
            'kode_unit' => $kode_unit,
            'unit' => $unit,
            'ket_unit' => $ket_unit,
            'status' => $status,
        ];

        $result = $this->api_unt->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_unt->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_unit_hcdata');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Unit gagal diupdate', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_unit = htmlspecialchars(trim($this->input->post('auth_unit')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_unit',
            'value' => $auth_unit,
        ];
        $id_unit = $this->api_unt->read_specific_data($dataID, $tokenAuth);
        if ($id_unit['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_unit = $this->api_unt->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_unit' => $id_unit['data'][0]['id_unit'],
        ];

        $result = $this->api_unt->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_unt->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}