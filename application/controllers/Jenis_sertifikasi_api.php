<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_sertifikasi_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }
    // Variables
    private $datatablesEndpoint = 'jenis_sertifikasi_datatables';
    private $createEndpoint = 'tambah_jenis_sertifikasi';
    private $updateEndpoint = 'edit_jenis_sertifikasi';
    private $deleteEndpoint = 'hapus_jenis_sertifikasi';

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
        $this->load->view('data_master/jenis_sertifikasi/view');

        // Modal
        $this->load->view('components/modal/jenis_sertifikasi');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/jenis_sertifikasi/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_jenis_sertifikasi()
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
        $this->load->view('data_master/jenis_sertifikasi/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/jenis_sertifikasi/add');

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
        $tokenAuth = $this->session->userdata("token");

        $data = [
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->std->api($this->datatablesEndpoint, $this->getMethod(), $tokenAuth, $data);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->std->api($this->datatablesEndpoint, $this->getMethod(), $newToken, $data);
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

    public function options()
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'source' => 'vw_jenis_sertifikasi',
            'field' => 'stat_jenis_sertifikasi',
            'value' => 'T',
        ];
        $result = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH JENIS SERTIFIKASI --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_jenis_sertifikasi'] . "'>" . $list['jenis_sertifikasi'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "options" => $output));
        } else {
            $output = "<option value=''>-- JENIS SERTIFIKASI TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "options" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_jenis_sertifikasi');
        $auth_jenis_sertifikasi = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_jenis_sertifikasi',
            'field' => 'auth_jenis_sertifikasi',
            'value' => $auth_jenis_sertifikasi,
        ];
        $result = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterData);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterData);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_jenis_sertifikasi'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'kode' => $result['data'][0]['kode_jenis_sertifikasi'],
                'jenis_sertifikasi' => $result['data'][0]['jenis_sertifikasi'],
                'keterangan' => $result['data'][0]['ket_jenis_sertifikasi'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_jenis_sertifikasi', $result['data'][0]['id_jenis_sertifikasi']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Jenis Sertifikasi tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $kode = htmlspecialchars(trim($this->input->post("kode", true)));
        $jenis = htmlspecialchars(trim($this->input->post("jenis", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_jenis_sertifikasi',
            'field' => 'jenis_sertifikasi',
            'value' => $jenis,
        ];
        $checkData = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterData);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterData);
        }
        if ($checkData['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Jenis Sertifikasi sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kode' => $kode,
            'jenis' => $jenis,
            'keterangan' => $keterangan,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $result = $this->std->api($this->createEndpoint, $this->postMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->createEndpoint, $this->postMethod(), $newToken, $data);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis Sertifikasi berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Jenis Sertifikasi gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_jenis_sertifikasi = $this->session->userdata('id_jenis_sertifikasi');

        if ($id_jenis_sertifikasi == "") {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Jenis Sertifikasi tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $kode = htmlspecialchars(trim($this->input->post("kode", true)));
        $jenis = htmlspecialchars(trim($this->input->post("jenis", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $parameterCheckData = [
            'source' => 'vw_jenis_sertifikasi',
            'field' => 'id_jenis_sertifikasi !=',
            'value' => $id_jenis_sertifikasi,
            'field2' => 'jenis_sertifikasi',
            'value2' => $jenis,
        ];

        $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterCheckData);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameterCheckData);
        }
        if ($checkData['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Jenis Sertifikasi sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id' => $id_jenis_sertifikasi,
            'kode' => $kode,
            'jenis' => $jenis,
            'keterangan' => $keterangan,
            'status' => $status,
        ];

        $result = $this->std->api($this->updateEndpoint, $this->putMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->updateEndpoint, $this->putMethod(), $newToken, $data);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_jenis_sertifikasi');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis Sertifikasi berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Jenis Sertifikasi gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_jenis_sertifikasi = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_jenis_sertifikasi',
            'field' => 'auth_jenis_sertifikasi',
            'value' => $auth_jenis_sertifikasi,
        ];
        $data = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $dataID);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $dataID);
        }

        $data = [
            'id' => $data['data'][0]['id_jenis_sertifikasi'],
        ];

        $result = $this->std->api($this->deleteEndpoint, $this->deleteMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->deleteEndpoint, $this->deleteMethod(), $newToken, $data);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis Sertifikasi berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Jenis Sertifikasi gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}