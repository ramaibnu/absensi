<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatusPerjanjian_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    // Variables
    private $datatablesEndpoint = 'status_perjanjian_datatables';
    private $createEndpoint = 'tambah_status_perjanjian';
    private $updateEndpoint = 'edit_status_perjanjian';
    private $deleteEndpoint = 'hapus_status_perjanjian';

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
        $this->load->view('data_master/status_perjanjian/view');

        // Modal
        $this->load->view('components/modal/status_perjanjian');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/status_perjanjian/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_status_perjanjian()
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
        $this->load->view('data_master/status_perjanjian/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/status_perjanjian/add');

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
            'source' => 'vw_stat_perjanjian',
            'field' => 'stat_stat_perjanjian',
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
            $output = "<option value=''>-- PILIH STATUS PERJANJIAN --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_stat_perjanjian'] . "'>" . $list['stat_perjanjian'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "options" => $output));
        } else {
            $output = "<option value=''>-- STATUS PERJANJIAN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "options" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_stat_perjanjian');
        $auth_stat_perjanjian = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $dataSection = [
            'source' => 'vw_stat_perjanjian',
            'field' => 'auth_stat_perjanjian',
            'value' => $auth_stat_perjanjian,
        ];
        $result = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $dataSection);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $dataSection);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_stat_perjanjian'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            if ($result['data'][0]['stat_waktu'] == "T") {
                $jangkaWaktu = "Memiliki jangka waktu";
            } else {
                $jangkaWaktu = "Tidak memiliki jangka waktu";
            }

            $data = [
                'statusCode' => 200,
                'status_perjanjian' => $result['data'][0]['stat_perjanjian'],
                'keterangan' => $result['data'][0]['ket_stat_perjanjian'],
                'option_waktu' => $result['data'][0]['stat_waktu'],
                'jangka_waktu' => $jangkaWaktu,
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_stat_perjanjian', $result['data'][0]['id_stat_perjanjian']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Status Perjanjian tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $status_perjanjian = htmlspecialchars(trim($this->input->post("status_perjanjian", true)));
        $status_waktu = htmlspecialchars($this->input->post("status_waktu", true));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_stat_perjanjian',
            'field' => 'stat_perjanjian',
            'value' => $status_perjanjian,
        ];
        $checkStatusPerjanjian = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterData);
        if ($checkStatusPerjanjian['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkStatusPerjanjian = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterData);
        }
        if ($checkStatusPerjanjian['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Status Perjanjian sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'status_perjanjian' => $status_perjanjian,
            'status_waktu' => $status_waktu,
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Status Perjanjian berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Status Perjanjian gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_stat_perjanjian = $this->session->userdata('id_stat_perjanjian');

        if ($id_stat_perjanjian == "") {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Status Perjanjian tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $status_perjanjian = htmlspecialchars(trim($this->input->post("status_perjanjian", true)));
        $status_waktu = htmlspecialchars($this->input->post("status_waktu", true));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $status = htmlspecialchars($this->input->post("status", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $parameterCheckData = [
            'source' => 'vw_stat_perjanjian',
            'field' => 'id_stat_perjanjian !=',
            'value' => $id_stat_perjanjian,
            'field2' => 'stat_perjanjian',
            'value2' => $status_perjanjian,
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
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Status Perjanjian sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id' => $id_stat_perjanjian,
            'status_perjanjian' => $status_perjanjian,
            'status_waktu' => $status_waktu,
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
            $this->session->unset_userdata('id_stat_perjanjian');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Status Perjanjian berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Status Perjanjian gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_stat_perjanjian = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_stat_perjanjian',
            'field' => 'auth_stat_perjanjian',
            'value' => $auth_stat_perjanjian,
        ];
        $dataStatus = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $dataID);
        if ($dataStatus['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataStatus = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $dataID);
        }

        $data = [
            'id' => $dataStatus['data'][0]['id_stat_perjanjian'],
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Status Perjanjian berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Status Perjanjian gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}