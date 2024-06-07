<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Golongan_api extends MY_Controller
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
        $this->load->view('data_master/golongan/view');

        // Modal
        $this->load->view('components/modal/golongan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_golongan()
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
        $this->load->view('data_master/golongan/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/golongan/add');

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

        $datatables = $this->api_gol->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_gol->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_tipe_hcdt');
        $auth_tipe = htmlspecialchars(trim($this->input->post("authtipe")));
        $tokenAuth = $this->session->userdata('token');

        $dataGolongan = [
            'field' => 'auth_tipe',
            'value' => $auth_tipe,
        ];
        $result = $this->api_gol->read_specific_data($dataGolongan, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_gol->read_specific_data($dataGolongan, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_tipe'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'tipe' => $result['data'][0]['tipe'],
                'ket' => $result['data'][0]['ket_tipe'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_tipe_hcdt', $result['data'][0]['id_tipe']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $tipe = strtoupper(htmlspecialchars($this->input->post("tipe", true)));
        $ket_tipe = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'tipe',
            'value' => $tipe,
        ];
        $checkGolongan = $this->api_gol->read_specific_data($dataID, $tokenAuth);
        if ($checkGolongan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkGolongan = $this->api_gol->read_specific_data($dataID, $newToken);
        }
        if ($checkGolongan['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'tipe' => $tipe,
            'ket_tipe' => $ket_tipe,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $result = $this->api_gol->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_gol->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Golongan berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_tipe = $this->session->userdata('id_tipe_hcdt');

        if ($id_tipe == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $tipe = strtoupper(htmlspecialchars($this->input->post("tipe", true)));
        $ket_tipe = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataGolongan = [
            'source' => 'tb_tipe',
            'field' => 'id_tipe !=',
            'value' => $id_tipe,
            'field2' => 'tipe',
            'value2' => $tipe,
        ];

        $checkGolongan = $this->api->specific_data_by_2_fields($dataGolongan, $tokenAuth);
        if ($checkGolongan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkGolongan = $this->api->specific_data_by_2_fields($dataGolongan, $newToken);
        }
        if ($checkGolongan['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_tipe' => $id_tipe,
            'tipe' => $tipe,
            'ket_tipe' => $ket_tipe,
            'status' => $status,
        ];

        $result = $this->api_gol->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_gol->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_tipe_hcdt');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Golongan berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Golongan gagal diupdate', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_tipe = htmlspecialchars(trim($this->input->post('authtipe')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_tipe',
            'value' => $auth_tipe,
        ];
        $id_golongan = $this->api_gol->read_specific_data($dataID, $tokenAuth);
        if ($id_golongan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_golongan = $this->api_gol->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_tipe' => $id_golongan['data'][0]['id_tipe'],
        ];

        $result = $this->api_gol->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_gol->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Golongan berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Golongan gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}