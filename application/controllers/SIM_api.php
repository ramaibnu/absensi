<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SIM_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }
    // Variables
    private $datatablesEndpoint = 'sim_datatables';
    private $createEndpoint = 'tambah_sim';
    private $updateEndpoint = 'edit_sim';
    private $deleteEndpoint = 'hapus_sim';

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
        $this->load->view('data_master/sim/view');

        // Modal
        $this->load->view('components/modal/sim');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/sim/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_sim()
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
        $this->load->view('data_master/sim/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/sim/add');

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
            'source' => 'vw_sim',
            'field' => 'stat_sim',
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
            $output = "<option value=''>-- PILIH JENIS SIM POLISI --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_sim'] . "'>" . $list['sim'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "options" => $output));
        } else {
            $output = "<option value=''>-- JENIS SIM POLISI TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "options" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_sim');
        $auth_sim = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_sim',
            'field' => 'auth_sim',
            'value' => $auth_sim,
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
            if ($result['data'][0]['stat_sim'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'sim' => $result['data'][0]['sim'],
                'keterangan' => $result['data'][0]['ket_sim'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_sim', $result['data'][0]['id_sim']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Jenis SIM Polisi tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $sim = htmlspecialchars(trim($this->input->post("sim", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_sim',
            'field' => 'sim',
            'value' => $sim,
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
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Jenis SIM Polisi sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'sim' => $sim,
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis SIM Polisi berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Jenis SIM Polisi gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id = $this->session->userdata('id_sim');

        if ($id == "") {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Jenis SIM Polisi tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $sim = htmlspecialchars(trim($this->input->post("sim", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $parameterCheckData = [
            'source' => 'vw_sim',
            'field' => 'id_sim !=',
            'value' => $id,
            'field2' => 'sim',
            'value2' => $sim,
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
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Jenis SIM Polisi sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id' => $id,
            'sim' => $sim,
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
            $this->session->unset_userdata('id_sim');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis SIM Polisi berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Jenis SIM Polisi gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_sim = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_sim',
            'field' => 'auth_sim',
            'value' => $auth_sim,
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
            'id' => $data['data'][0]['id_sim'],
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Jenis SIM Polisi berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Jenis SIM Polisi gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}