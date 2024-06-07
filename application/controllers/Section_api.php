<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Section_api extends MY_Controller
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
        $this->load->view('data_master/section/view', $dataMain);

        // Modal
        $this->load->view('components/modal/section');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/section/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_section()
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
        $this->load->view('data_master/section/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/section/add');

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
        $endpoint = 'section_datatables';

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
        $auth_depart = htmlspecialchars($this->input->post('auth_depart', true));
        $parameter = [
            'source' => 'vw_section',
            'field' => 'auth_depart',
            'value' => $auth_depart,
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
            $output = "<option value=''>-- PILIH SECTION --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_section'] . "'>" . $list['section'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "section" => $output));
        } else {
            $output = "<option value=''>-- SECTION TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "section" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_section');
        $this->session->unset_userdata('id_departemen');
        $this->session->unset_userdata('id_perusahaan');
        $auth_section = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $dataSection = [
            'source' => 'vw_section',
            'field' => 'auth_section',
            'value' => $auth_section,
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
            if ($result['data'][0]['stat_section'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'auth_perusahaan' => $result['data'][0]['auth_perusahaan'],
                'nama_perusahaan' => $result['data'][0]['nama_perusahaan'],
                'kode' => $result['data'][0]['kd_section'],
                'section' => $result['data'][0]['section'],
                'depart' => $result['data'][0]['depart'],
                'auth_depart' => $result['data'][0]['auth_depart'],
                'keterangan' => $result['data'][0]['ket_section'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_section', $result['data'][0]['id_section']);
            $this->session->set_userdata('id_departemen', $result['data'][0]['id_depart']);
            $this->session->set_userdata('id_perusahaan', $result['data'][0]['id_perusahaan']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Section tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $auth_m_perusahaan = htmlspecialchars($this->input->post("perusahaan", true));
        $auth_depart = htmlspecialchars($this->input->post("departemen", true));
        $kode = htmlspecialchars(trim($this->input->post("kode", true)));
        $section = htmlspecialchars(trim($this->input->post("section", true)));
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
            'field' => 'auth_depart',
            'value' => $auth_depart,
        ];
        $data_departemen = $this->api_dprt->read_specific_data($dataID2, $tokenAuth);
        if ($data_departemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data_departemen = $this->api_dprt->read_specific_data($dataID2, $newToken);
        }
        if ($data_departemen['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        $checkKodeSection = [
            'source' => 'vw_section',
            'field' => 'auth_perusahaan',
            'value' => $data_perusahaan['data'][0]['auth_perusahaan'],
            'field2' => 'auth_depart',
            'value2' => $auth_depart,
            'field3' => 'kd_section',
            'value3' => $kode,
        ];
        $dataCheckKodeSection = $this->std->api($this->specificData3Fields(), $this->getMethod(), $tokenAuth, $checkKodeSection);
        if ($dataCheckKodeSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckKodeSection = $this->std->api($this->specificData3Fields(), $this->getMethod(), $newToken, $checkKodeSection);
        }
        if ($dataCheckKodeSection['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Kode Section sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $checkSection = [
            'source' => 'vw_section',
            'field' => 'auth_perusahaan',
            'value' => $data_perusahaan['data'][0]['auth_perusahaan'],
            'field2' => 'auth_depart',
            'value2' => $auth_depart,
            'field3' => 'section',
            'value3' => $section,
        ];
        $dataCheckSection = $this->std->api($this->specificData3Fields(), $this->getMethod(), $tokenAuth, $checkSection);
        if ($dataCheckSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckSection = $this->std->api($this->specificData3Fields(), $this->getMethod(), $newToken, $checkSection);
        }
        if ($dataCheckSection['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Section sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kd_section' => $kode,
            'section' => $section,
            'id_depart' => $data_departemen['data'][0]['id_depart'],
            'ket_section' => $keterangan,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $data_perusahaan['data'][0]['id_perusahaan'],
        ];

        $endpoint = 'tambah_section';
        $result = $this->std->api($endpoint, $this->postMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->postMethod(), $newToken, $data);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Section berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Section gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_section = $this->session->userdata('id_section');
        $id_departemen = $this->session->userdata('id_departemen');
        $id_perusahaan = $this->session->userdata('id_perusahaan');

        if ($id_section == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Section tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $departemen = htmlspecialchars($this->input->post("departemen", true));
        $kode = htmlspecialchars(trim($this->input->post("kode", true)));
        $section = htmlspecialchars(trim($this->input->post("section", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $checkKodeSection = [
            'source' => 'vw_section',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'id_depart',
            'value2' => $id_departemen,
            'field3' => 'id_section !=',
            'value3' => $id_section,
            'field4' => 'kd_section',
            'value4' => $kode,
        ];

        $dataCheckKodeSection = $this->std->api($this->specificData4Fields(), $this->getMethod(), $tokenAuth, $checkKodeSection);
        if ($dataCheckKodeSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckKodeSection = $this->std->api($this->specificData4Fields(), $this->getMethod(), $newToken, $checkKodeSection);
        }
        if ($dataCheckKodeSection['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Kode Section sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $checkKodeSection = [
            'source' => 'vw_section',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'id_depart',
            'value2' => $id_departemen,
            'field3' => 'id_section !=',
            'value3' => $id_section,
            'field4' => 'section',
            'value4' => $section,
        ];

        $dataCheckKodeSection = $this->std->api($this->specificData4Fields(), $this->getMethod(), $tokenAuth, $checkKodeSection);
        if ($dataCheckKodeSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataCheckKodeSection = $this->std->api($this->specificData4Fields(), $this->getMethod(), $newToken, $checkKodeSection);
        }
        if ($dataCheckKodeSection['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Section sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $dataDepartemen = [
            'field' => 'auth_depart',
            'value' => $departemen,
        ];
        $data_departemen = $this->api_dprt->read_specific_data($dataDepartemen, $tokenAuth);
        if ($data_departemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data_departemen = $this->api_dprt->read_specific_data($dataDepartemen, $newToken);
        }

        $id_departemen = $data_departemen['data'][0]['id_depart'];

        $data = [
            'id_section' => $id_section,
            'kd_section' => $kode,
            'section' => $section,
            'id_depart' => $id_departemen,
            'ket_section' => $keterangan,
            'stat_section' => $status,
        ];
        $endpoint = 'edit_section';

        $result = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->putMethod(), $newToken, $data);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_section');
            $this->session->unset_userdata('id_departemen');
            $this->session->unset_userdata('id_perusahaan');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Section berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Section gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_section = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_section',
            'field' => 'auth_section',
            'value' => $auth_section,
        ];
        $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $dataID);
        if ($dataSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $dataID);
        }

        $data = [
            'id_section' => $dataSection['data'][0]['id_section'],
        ];

        $endpoint = 'hapus_section';
        $result = $this->std->api($endpoint, $this->deleteMethod(), $tokenAuth, $data);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($endpoint, $this->deleteMethod(), $newToken, $data);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Section berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Section gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}