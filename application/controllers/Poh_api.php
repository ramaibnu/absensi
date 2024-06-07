<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poh_api extends MY_Controller
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
        $this->load->view('data_master/poh/view');

        // Modal
        $this->load->view('components/modal/poh');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/poh/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_poh()
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
        $this->load->view('data_master/poh/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/poh/add');

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

        $datatables = $this->api_poh->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_poh->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_poh_hcdata');
        $auth_poh = htmlspecialchars(trim($this->input->post("auth_poh")));
        $tokenAuth = $this->session->userdata('token');

        $dataPOH = [
            'field' => 'auth_poh',
            'value' => $auth_poh,
        ];
        $result = $this->api_poh->read_specific_data($dataPOH, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_poh->read_specific_data($dataPOH, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_poh'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'kode' => $result['data'][0]['kd_poh'],
                'poh' => $result['data'][0]['poh'],
                'ket' => $result['data'][0]['ket_poh'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_poh_hcdata', $result['data'][0]['id_poh']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $kd_poh = strtoupper(htmlspecialchars($this->input->post("kode", true)));
        $poh = strtoupper(htmlspecialchars($this->input->post("poh", true)));
        $ket_poh = htmlspecialchars($this->input->post("ket"));

        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'kd_poh',
            'value' => $kd_poh,
        ];
        $checkKode = $this->api_poh->read_specific_data($dataID, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api_poh->read_specific_data($dataID, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID2 = [
            'field' => 'poh',
            'value' => $poh,
        ];
        $checkPOH = $this->api_poh->read_specific_data($dataID2, $tokenAuth);
        if ($checkPOH['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkPOH = $this->api_poh->read_specific_data($dataID2, $newToken);
        }
        if ($checkPOH['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kd_poh' => $kd_poh,
            'poh' => $poh,
            'ket_poh' => $ket_poh,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $result = $this->api_poh->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_poh->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of Hire berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_poh = $this->session->userdata('id_poh_hcdata');

        if ($id_poh == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $kd_poh = strtoupper(htmlspecialchars($this->input->post("kode", true)));
        $poh = strtoupper(htmlspecialchars($this->input->post("poh", true)));
        $ket_poh = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataKode = [
            'source' => 'tb_poh',
            'field' => 'id_poh !=',
            'value' => $id_poh,
            'field2' => 'kd_poh',
            'value2' => $kd_poh,
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

        $dataPoh = [
            'source' => 'tb_poh',
            'field' => 'id_poh !=',
            'value' => $id_poh,
            'field2' => 'poh',
            'value2' => $poh,
        ];

        $checkPoh = $this->api->specific_data_by_2_fields($dataPoh, $tokenAuth);
        if ($checkPoh['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkPoh = $this->api->specific_data_by_2_fields($dataPoh, $newToken);
        }
        if ($checkPoh['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_poh' => $id_poh,
            'kd_poh' => $kd_poh,
            'poh' => $poh,
            'ket_poh' => $ket_poh,
            'status' => $status,
        ];

        $result = $this->api_poh->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_poh->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_poh_hcdata');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of Hire berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Point of Hire gagal diupdate', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_poh = htmlspecialchars(trim($this->input->post('auth_poh')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_poh',
            'value' => $auth_poh,
        ];
        $id_poh = $this->api_poh->read_specific_data($dataID, $tokenAuth);
        if ($id_poh['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_poh = $this->api_poh->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_poh' => $id_poh['data'][0]['id_poh'],
        ];

        $result = $this->api_poh->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_poh->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of Hire berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of Hire gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}