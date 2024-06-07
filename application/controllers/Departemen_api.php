<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen_api extends MY_Controller
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
        if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
            $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
            if ($idmper != "") {
                $parameterOption = [
                    'id' => $idmper,
                ];
                $mainOption = $this->api_str->mainOption($parameterOption, $tokenAuth);
                if ($mainOption['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $mainOption = $this->api_str->mainOption($parameterOption, $newToken);
                }
                $options = $this->api_str->options($parameterOption, $tokenAuth);
                if ($options['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $options = $this->api_str->options($parameterOption, $newToken);
                }
                $dataMain['permst'] = $mainOption['data'];
                $dataMain['perstr'] = $options['data'];
            } else {
                $dataMain['permst'] = "";
                $dataMain['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataMain['permst'] = "";
            $dataMain['perstr'] = "";
        }
        $this->load->view('data_master/departemen/view', $dataMain);

        // Modal
        $this->load->view('components/modal/departemen');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/departemen/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_departemen()
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
        if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
            $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
            if ($idmper != "") {
                $parameterOption = [
                    'id' => $idmper,
                ];
                $mainOption = $this->api_str->mainOption($parameterOption, $tokenAuth);
                if ($mainOption['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $mainOption = $this->api_str->mainOption($parameterOption, $newToken);
                }
                $options = $this->api_str->options($parameterOption, $tokenAuth);
                if ($options['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $options = $this->api_str->options($parameterOption, $newToken);
                }
                $dataMain['permst'] = $mainOption['data'];
                $dataMain['perstr'] = $options['data'];
            } else {
                $dataMain['permst'] = "";
                $dataMain['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataMain['permst'] = "";
            $dataMain['perstr'] = "";
        }
        $this->load->view('data_master/departemen/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/departemen/add');

        // Footer
        $this->load->view('components/footer');
    }

    // Process
    public function datatables()
    {
        $auth_per = htmlspecialchars($this->input->post("auth_per", true));
        if (empty($auth_per)) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
            echo json_encode($output);
            return;
        }
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_per,
        ];
        $strukturPerusahaan = $this->api_str->read_specific_data($parameter, $tokenAuth);
        if ($strukturPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $strukturPerusahaan = $this->api_str->read_specific_data($parameter, $newToken);
        }

        if ($strukturPerusahaan['status'] == 404) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
            echo json_encode($output);
            return;
        }

        $auth_perusahaan = $strukturPerusahaan['data'][0]['auth_perusahaan'];
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");

        $data = [
            'auth_per' => $auth_perusahaan,
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_dprt->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_dprt->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_depart_hcdata');
        $this->session->unset_userdata('id_perusahaan_depart');
        $auth_depart = trim($this->input->post("authdepart", true));
        $tokenAuth = $this->session->userdata('token');

        $dataDepartemen = [
            'field' => 'auth_depart',
            'value' => $auth_depart,
        ];
        $result = $this->api_dprt->read_specific_data($dataDepartemen, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dprt->read_specific_data($dataDepartemen, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_depart'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }
            $data = [
                'statusCode' => 200,
                'nama_perusahaan' => $result['data'][0]['nama_perusahaan'],
                'kode' => $result['data'][0]['kd_depart'],
                'depart' => $result['data'][0]['depart'],
                'ket' => $result['data'][0]['ket_depart'],
                'status' => $status,
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_depart_hcdata', $result['data'][0]['id_depart']);
            $this->session->set_userdata('id_perusahaan_depart', $result['data'][0]['id_perusahaan']);
            echo json_encode($data);
            return;
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }
    }

    public function options()
    {
        $auth_per = $this->input->post('auth_per');
        $tokenAuth = $this->session->userdata('token');

        $dataDepartemen = [
            'field' => 'auth_perusahaan',
            'value' => $auth_per,
        ];
        $result = $this->api_dprt->read_specific_data($dataDepartemen, $tokenAuth);
        $output = "<option value=''>-- PILIH DEPARTEMEN --</option>";
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dprt->read_specific_data($dataDepartemen, $newToken);
        }

        if ($result['status'] == 200) {
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_depart'] . "'>" . $list['depart'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "dprt" => $output));
        } else {
            $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "dprt" => $output));
        }
    }

    public function options_struktur()
    {
        $auth_per = $this->input->post('auth_per');
        $tokenAuth = $this->session->userdata('token');

        $dataDepartemen = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_per,
        ];
        $strukturPerusahaan = $this->api_str->read_specific_data($dataDepartemen, $tokenAuth);
        if ($strukturPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $strukturPerusahaan = $this->api_str->read_specific_data($dataDepartemen, $newToken);
        }
        if ($strukturPerusahaan['status'] == 404) {
            $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "dprt" => $output));
            return;
        }

        $parameterCheck = [
            'field' => 'id_perusahaan',
            'value' => $strukturPerusahaan['data'][0]['id_perusahaan'],
        ];
        $result = $this->api_dprt->read_specific_data($parameterCheck, $tokenAuth);
        $output = "<option value=''>-- PILIH DEPARTEMEN --</option>";
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dprt->read_specific_data($parameterCheck, $newToken);
        }

        if ($result['status'] == 200) {
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_depart'] . "'>" . $list['depart'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "dprt" => $output));
        } else {
            $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "dprt" => $output));
        }
    }

    public function insert()
    {
        $auth_perusahaan = $this->input->post("prs");
        $kd_depart = trim($this->input->post("kode"));
        $depart = trim($this->input->post("depart"));
        $ket_depart = trim($this->input->post("ket"));
        $valid_token = $this->session->csrf_token;
        $email = $this->session->email_hcdata;
        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_perusahaan,
        ];
        $id_perusahaan = $this->api_str->read_specific_data($dataID, $tokenAuth);
        if ($id_perusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_perusahaan = $this->api_str->read_specific_data($dataID, $newToken);
        }
        if ($id_perusahaan['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        $dataID2 = [
            'field1' => 'id_perusahaan',
            'value1' => $id_perusahaan['data'][0]['id_perusahaan'],
            'field2' => 'kd_depart',
            'value2' => $kd_depart,
        ];
        $cekkode = $this->api_dprt->read_specific_data2($dataID2, $tokenAuth);
        if ($cekkode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekkode = $this->api_dprt->read_specific_data2($dataID2, $newToken);
        }
        if ($cekkode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID3 = [
            'field1' => 'id_perusahaan',
            'value1' => $id_perusahaan['data'][0]['id_perusahaan'],
            'field2' => 'depart',
            'value2' => $depart,
        ];
        $cekdepart = $this->api_dprt->read_specific_data2($dataID3, $tokenAuth);
        if ($cekdepart['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekdepart = $this->api_dprt->read_specific_data2($dataID3, $newToken);
        }
        if ($cekdepart['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kd_depart' => $kd_depart,
            'depart' => $depart,
            'ket_depart' => $ket_depart,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $id_perusahaan['data'][0]['id_perusahaan'],
        ];

        $result = $this->api_dprt->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dprt->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        if ($this->session->userdata('id_perusahaan_depart') == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        if ($this->session->userdata('id_depart_hcdata') == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $kd_depart = trim($this->input->post("kode"));
        $depart = trim($this->input->post("depart"));
        $ket_depart = trim($this->input->post("ket"));
        if ($this->input->post("status") == 'AKTIF') {
            $status = "T";
        } else {
            $status = "F";
        }
        $tokenAuth = $this->session->userdata('token');

        $dataID2 = [
            'source' => 'tb_depart',
            'field' => 'id_perusahaan',
            'value' => $this->session->userdata('id_perusahaan_hcdata'),
            'field2' => 'id_depart !=',
            'value2' => $this->session->userdata('id_depart_hcdata'),
            'field3' => 'kd_depart',
            'value3' => $kd_depart,
        ];
        $checkKode = $this->api->specific_data_by_3_fields($dataID2, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api->specific_data_by_3_fields($dataID2, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID3 = [
            'source' => 'tb_depart',
            'field' => 'id_perusahaan',
            'value' => $this->session->userdata('id_perusahaan_hcdata'),
            'field2' => 'id_depart !=',
            'value2' => $this->session->userdata('id_depart_hcdata'),
            'field3' => 'depart',
            'value3' => $depart,
        ];
        $cekdepart = $this->api->specific_data_by_3_fields($dataID3, $tokenAuth);
        if ($cekdepart['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekdepart = $this->api->specific_data_by_3_fields($dataID3, $newToken);
        }
        if ($cekdepart['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen sudah digunakan", "tipe_pesan" => "error"));
            return;
        }
        $data = [
            'kd_depart' => $kd_depart,
            'depart' => $depart,
            'ket_depart' => $ket_depart,
            'status' => $status,
            'id_depart' => $this->session->userdata('id_depart_hcdata'),
        ];
        $depart = $this->api_dprt->update($data, $tokenAuth);
        if ($depart == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $depart = $this->api_dprt->update($data, $newToken);
        }
        if ($depart == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal diupdate", "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_depart = htmlspecialchars(trim($this->input->post('authdepart')));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'field' => 'auth_depart',
            'value' => $auth_depart,
        ];
        $cekDepartemen = $this->api_dprt->read_specific_data($data, $tokenAuth);
        if ($cekDepartemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekDepartemen = $this->api_dprt->read_specific_data($data, $newToken);
        }
        if ($cekDepartemen['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $dataID = [
            'id_depart' => $cekDepartemen['data'][0]['id_depart'],
        ];
        $result = $this->api_dprt->delete($dataID, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dprt->delete($dataID, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil dihapus", "tipe_pesan" => "success"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal dihapus", "tipe_pesan" => "error"));
            return;
        }
    }
}