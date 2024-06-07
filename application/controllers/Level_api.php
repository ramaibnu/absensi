<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_api extends MY_Controller
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
        $this->load->view('data_master/level/view', $dataMain);

        // Modal
        $this->load->view('components/modal/level');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/level/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_level()
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
        $this->load->view('data_master/level/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/level/add');

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

        $datatables = $this->api_lvl->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_lvl->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_level_hcdata');
        $this->session->unset_userdata('id_perusahaan_lvl');
        $auth_level = htmlspecialchars(trim($this->input->post("authlevel")));
        $tokenAuth = $this->session->userdata('token');

        $dataLevel = [
            'field' => 'auth_level',
            'value' => $auth_level,
        ];
        $result = $this->api_lvl->read_specific_data($dataLevel, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->read_specific_data($dataLevel, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_level'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'auth_perusahaan' => $result['data'][0]['auth_perusahaan'],
                'nama_perusahaan' => $result['data'][0]['nama_perusahaan'],
                'kode' => $result['data'][0]['kd_level'],
                'level' => $result['data'][0]['level'],
                'ket' => $result['data'][0]['ket_level'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_level_hcdata', $result['data'][0]['id_level']);
            $this->session->set_userdata('id_perusahaan_lvl', $result['data'][0]['id_perusahaan']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Level tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
        $kd_level = strtoupper(htmlspecialchars($this->input->post("kode", true)));
        $level = strtoupper(htmlspecialchars($this->input->post("level", true)));
        $ket_level = htmlspecialchars($this->input->post("ket", true));
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
            'field2' => 'kd_level',
            'value2' => $kd_level,
        ];
        $checkKode = $this->api_lvl->read_specific_data2($dataID2, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api_lvl->read_specific_data2($dataID2, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataID3 = [
            'field1' => 'id_perusahaan',
            'value1' => $id_perusahaan['data'][0]['id_perusahaan'],
            'field2' => 'level',
            'value2' => $level,
        ];
        $checkLevel = $this->api_lvl->read_specific_data2($dataID3, $tokenAuth);
        if ($checkLevel['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkLevel = $this->api_lvl->read_specific_data2($dataID3, $newToken);
        }
        if ($checkLevel['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kd_level' => $kd_level,
            'level' => $level,
            'ket_level' => $ket_level,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $id_perusahaan['data'][0]['id_perusahaan'],
        ];

        $result = $this->api_lvl->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_perusahaan = $this->session->userdata('id_perusahaan_lvl');
        $id_level = $this->session->userdata('id_level_hcdata');

        if ($id_perusahaan == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        if ($id_level == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $level = strtoupper(htmlspecialchars($this->input->post("level", true)));
        $kd_level = htmlspecialchars($this->input->post("kode", true));
        $ket_level = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataKode = [
            'source' => 'tb_level',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'kd_level',
            'value2' => $kd_level,
            'field3' => 'id_level !=',
            'value3' => $id_level,
        ];

        $checkKode = $this->api->specific_data_by_3_fields($dataKode, $tokenAuth);
        if ($checkKode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKode = $this->api->specific_data_by_3_fields($dataKode, $newToken);
        }
        if ($checkKode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataLevel = [
            'source' => 'tb_level',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'level',
            'value2' => $level,
            'field3' => 'id_level !=',
            'value3' => $id_level,
        ];

        $checkLevel = $this->api->specific_data_by_3_fields($dataLevel, $tokenAuth);
        if ($checkLevel['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkLevel = $this->api->specific_data_by_3_fields($dataLevel, $newToken);
        }
        if ($checkLevel['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_level' => $id_level,
            'level' => $level,
            'kd_level' => $kd_level,
            'ket_level' => $ket_level,
            'status' => $status,
        ];

        $result = $this->api_lvl->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_level_hcdata');
            $this->session->unset_userdata('id_perusahaan_lvl');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Level gagal diupdate', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_level = htmlspecialchars(trim($this->input->post('authlevel')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_level',
            'value' => $auth_level,
        ];
        $id_level = $this->api_lvl->read_specific_data($dataID, $tokenAuth);
        if ($id_level['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_level = $this->api_lvl->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_level' => $id_level['data'][0]['id_level'],
        ];

        $result = $this->api_lvl->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level gagal dihapus", "tipe_pesan" => "error"));
        }
    }

    public function options()
    {
        $auth_m_per = htmlspecialchars($this->input->post('auth_per', true));
        $tokenAuth = $this->session->userdata('token');
        $parameterStruktur = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $strukturPerusahaan = $this->api_str->read_specific_data($parameterStruktur, $tokenAuth);
        if ($strukturPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $strukturPerusahaan = $this->api_str->read_specific_data($parameterStruktur, $newToken);
        }
        if ($strukturPerusahaan['status'] == 404) {
            $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "lvl" => $output));
        }

        $parameter = [
            'field' => 'id_perusahaan',
            'value' => $strukturPerusahaan['data'][0]['id_perusahaan'],
        ];
        $result = $this->api_lvl->read_specific_data($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->read_specific_data($parameter, $newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH LEVEL --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_level'] . "'>" . $list['level'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "lvl" => $output));
        } else {
            $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "lvl" => $output));
        }
    }

    public function option()
    {
        $auth_per = $this->input->post('auth_per');
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'field' => 'auth_perusahaan',
            'value' => $auth_per,
        ];
        $result = $this->api_lvl->read_specific_data($parameter, $tokenAuth);
        $output = "<option value=''>-- PILIH LEVEL --</option>";
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lvl->read_specific_data($parameter, $newToken);
        }

        if ($result['status'] == 200) {
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_level'] . "'>" . $list['level'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "level" => $output));
        } else {
            $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "level" => $output));
        }
    }
}