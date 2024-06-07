<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade_api extends MY_Controller
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
        $this->load->view('data_master/grade/view', $dataMain);

        // Modal
        $this->load->view('components/modal/grade');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/grade/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_grade()
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
        $this->load->view('data_master/grade/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/grade/add');

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
            'auth_perusahaan' => $auth_perusahaan,
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];
        $endpoint = 'grade_datatables';

        $datatables = $this->std->api($endpoint, $this->getMethod(), $tokenAuth, $data);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->std->api($endpoint, $this->getMethod(), $newToken, $data);
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
        $auth_level = htmlspecialchars($this->input->post('auth_level', true));
        $parameter = [
            'source' => 'vw_grade',
            'field' => 'auth_level',
            'value' => $auth_level,
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
            $output = "<option value=''>-- PILIH GRADE --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_grade'] . "'>" . $list['grade'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "grade" => $output));
        } else {
            $output = "<option value=''>-- GRADE TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "grade" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_grade');
        $this->session->unset_userdata('id_level');
        $this->session->unset_userdata('id_perusahaan');
        $auth_grade = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $dataSection = [
            'source' => 'vw_grade',
            'field' => 'auth_grade',
            'value' => $auth_grade,
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
            if ($result['data'][0]['stat_grade'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'auth_perusahaan' => $result['data'][0]['auth_perusahaan'],
                'nama_perusahaan' => $result['data'][0]['nama_perusahaan'],
                'grade' => $result['data'][0]['grade'],
                'level' => $result['data'][0]['level'],
                'auth_level' => $result['data'][0]['auth_level'],
                'keterangan' => $result['data'][0]['ket_grade'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_grade', $result['data'][0]['id_grade']);
            $this->session->set_userdata('id_level', $result['data'][0]['id_level']);
            $this->session->set_userdata('id_perusahaan', $result['data'][0]['id_perusahaan']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Grade tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $auth_m_perusahaan = htmlspecialchars($this->input->post("perusahaan", true));
        $auth_level = htmlspecialchars($this->input->post("level", true));
        $grade = htmlspecialchars(trim($this->input->post("grade", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan")));
        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_perusahaan,
        ];
        $data_perusahaan = $this->api_str->read_specific_data($dataID, $tokenAuth);
        if ($data_perusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data_perusahaan = $this->api_str->read_specific_data($dataID, $newToken);
        }
        if ($data_perusahaan['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar!", "tipe_pesan" => "error"));
            return;
        }

        $dataID2 = [
            'field' => 'auth_level',
            'value' => $auth_level,
        ];
        $dataLevel = $this->api_lvl->read_specific_data($dataID2, $tokenAuth);
        if ($dataLevel['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLevel = $this->api_lvl->read_specific_data($dataID2, $newToken);
        }
        if ($dataLevel['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Level tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        $checkGrade = [
            'source' => 'vw_grade',
            'field' => 'auth_perusahaan',
            'value' => $data_perusahaan['data'][0]['auth_perusahaan'],
            'field2' => 'auth_level',
            'value2' => $auth_level,
            'field3' => 'grade',
            'value3' => $grade,
        ];
        $dataCheckGrade = $this->std->api($this->specificData3Fields(), $this->getMethod(), $tokenAuth, $checkGrade);
        if ($dataCheckGrade['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckGrade = $this->std->api($this->specificData3Fields(), $this->getMethod(), $newToken, $checkGrade);
        }
        if ($dataCheckGrade['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Grade sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'grade' => $grade,
            'id_level' => $dataLevel['data'][0]['id_level'],
            'ket_grade' => $keterangan,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $data_perusahaan['data'][0]['id_perusahaan'],
        ];

        $endpoint = 'tambah_grade';
        $result = $this->std->api($endpoint, $this->postMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->postMethod(), $newToken, $data);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Grade berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Grade gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_grade = $this->session->userdata('id_grade');
        $id_level = $this->session->userdata('id_level');
        $id_perusahaan = $this->session->userdata('id_perusahaan');

        if ($id_grade == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Grade tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $level = htmlspecialchars($this->input->post("level", true));
        $grade = htmlspecialchars(trim($this->input->post("grade", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $checkGrade = [
            'source' => 'vw_grade',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'id_level',
            'value2' => $id_level,
            'field3' => 'id_grade !=',
            'value3' => $id_grade,
            'field4' => 'grade',
            'value4' => $grade,
        ];

        $dataCheckGrade = $this->std->api($this->specificData4Fields(), $this->getMethod(), $tokenAuth, $checkGrade);
        if ($dataCheckGrade['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckGrade = $this->std->api($this->specificData4Fields(), $this->getMethod(), $newToken, $checkGrade);
        }
        if ($dataCheckGrade['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Grade sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $dataLevel = [
            'field' => 'auth_level',
            'value' => $level,
        ];
        $data_departemen = $this->api_lvl->read_specific_data($dataLevel, $tokenAuth);
        if ($data_departemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data_departemen = $this->api_lvl->read_specific_data($dataLevel, $newToken);
        }

        $id_level = $data_departemen['data'][0]['id_level'];

        $data = [
            'id_grade' => $id_grade,
            'grade' => $grade,
            'id_level' => $id_level,
            'ket_grade' => $keterangan,
            'stat_grade' => $status,
        ];
        $endpoint = 'edit_grade';

        $result = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->putMethod(), $newToken, $data);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_grade');
            $this->session->unset_userdata('id_level');
            $this->session->unset_userdata('id_perusahaan');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Grade berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Grade gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_grade = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_grade',
            'field' => 'auth_grade',
            'value' => $auth_grade,
        ];
        $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $dataID);
        if ($dataGrade['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $dataID);
        }

        $data = [
            'id_grade' => $dataGrade['data'][0]['id_grade'],
        ];

        $endpoint = 'hapus_grade';
        $result = $this->std->api($endpoint, $this->deleteMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->deleteMethod(), $newToken, $data);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Grade berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Grade gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}