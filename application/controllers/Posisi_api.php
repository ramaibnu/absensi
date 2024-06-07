<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posisi_api extends MY_Controller
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
        $this->load->view('data_master/posisi/view', $dataMain);

        // Modal
        $this->load->view('components/modal/posisi');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/posisi/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_posisi()
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
        $this->load->view('data_master/posisi/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/posisi/add');

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

        $datatables = $this->api_pss->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_pss->datatables($data, $newToken);
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
            'field' => 'auth_depart',
            'value' => $auth_depart,
        ];
        $result = $this->api_pss->read_specific_data($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_pss->read_specific_data($parameter, $newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH POSISI --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_posisi'] . "'>" . $list['posisi'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "posisi" => $output));
        } else {
            $output = "<option value=''>-- POSISI TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "posisi" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_depart_hcdt');
        $this->session->unset_userdata('id_posisi_hcdt');
        $this->session->unset_userdata('id_perusahaan_posisi_hcdt');
        $auth_posisi = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $dataPosisi = [
            'field' => 'auth_posisi',
            'value' => $auth_posisi,
        ];
        $result = $this->api_pss->read_specific_data($dataPosisi, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_pss->read_specific_data($dataPosisi, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_posisi'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'auth_perusahaan' => $result['data'][0]['auth_perusahaan'],
                'nama_perusahaan' => $result['data'][0]['nama_perusahaan'],
                'posisi' => $result['data'][0]['posisi'],
                'depart' => $result['data'][0]['depart'],
                'auth_depart' => $result['data'][0]['auth_depart'],
                'ket' => $result['data'][0]['ket_posisi'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_depart_hcdt', $result['data'][0]['id_depart']);
            $this->session->set_userdata('id_posisi_hcdt', $result['data'][0]['id_posisi']);
            $this->session->set_userdata('id_perusahaan_posisi_hcdt', $result['data'][0]['id_perusahaan']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Posisi tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
        $auth_depart = htmlspecialchars($this->input->post("depart", true));
        $posisi = strtoupper(htmlspecialchars($this->input->post("posisi", true)));
        $ket_posisi = htmlspecialchars($this->input->post("ket"));
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
            'field' => 'auth_depart',
            'value' => $auth_depart,
        ];
        $id_departemen = $this->api_dprt->read_specific_data($dataID2, $tokenAuth);
        if ($id_departemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_departemen = $this->api_dprt->read_specific_data($dataID2, $newToken);
        }
        if ($id_departemen['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak terdaftar", "tipe_pesan" => "error"));
            return;
        }

        $dataID3 = [
            'field1' => 'auth_perusahaan',
            'value1' => $id_perusahaan['data'][0]['auth_perusahaan'],
            'field2' => 'auth_depart',
            'value2' => $auth_depart,
            'field3' => 'posisi',
            'value3' => $posisi,
        ];
        $checkPosisi = $this->api_pss->read_specific_data2($dataID3, $tokenAuth);
        if ($checkPosisi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkPosisi = $this->api_pss->read_specific_data2($dataID3, $newToken);
        }
        if ($checkPosisi['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Posisi sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'posisi' => $posisi,
            'id_depart' => $id_departemen['data'][0]['id_depart'],
            'ket_posisi' => $ket_posisi,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $id_perusahaan['data'][0]['id_perusahaan'],
        ];

        $result = $this->api_pss->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_pss->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Posisi berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Posisi gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_perusahaan = $this->session->userdata('id_perusahaan_posisi_hcdt');
        $id_posisi = $this->session->userdata('id_posisi_hcdt');
        $id_departemen = $this->session->userdata('id_depart_hcdt');

        if ($id_perusahaan == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar!", "tipe_pesan" => "error"));
            return;
        }

        if ($id_posisi == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Posisi tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        if ($id_departemen == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $posisi = strtoupper(htmlspecialchars($this->input->post("posisi", true)));
        $depart = htmlspecialchars($this->input->post("depart", true));
        $ket_posisi = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');
        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataID = [
            'source' => 'tb_posisi',
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
            'field2' => 'id_depart',
            'value2' => $id_departemen,
            'field3' => 'id_posisi !=',
            'value3' => $id_posisi,
            'field4' => 'posisi',
            'value4' => $posisi,
        ];

        $checkPosisi = $this->api->specific_data_by_4_fields($dataID, $tokenAuth);
        if ($checkPosisi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkPosisi = $this->api->specific_data_by_4_fields($dataID, $newToken);
        }
        if ($checkPosisi['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Posisi sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $departemen = [
            'field' => 'auth_depart',
            'value' => $depart,
        ];
        $dataDepartemen = $this->api_dprt->read_specific_data($departemen, $tokenAuth);
        if ($dataDepartemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataDepartemen = $this->api_dprt->read_specific_data($departemen, $newToken);
        }
        $id_departemen = $dataDepartemen['data'][0]['id_depart'];

        $data = [
            'id_posisi' => $id_posisi,
            'posisi' => $posisi,
            'id_depart' => $id_departemen,
            'ket_posisi' => $ket_posisi,
            'status' => $status,
        ];

        $result = $this->api_pss->update($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_pss->update($data, $newToken);
        }
        if ($result == 200) {
            $this->session->unset_userdata('id_posisi_hcdt');
            $this->session->unset_userdata('id_depart_hcdt');
            $this->session->unset_userdata('id_perusahaan_posisi_hcdt');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Posisi berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Posisi gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_posisi = htmlspecialchars(trim($this->input->post('authposisi')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_posisi',
            'value' => $auth_posisi,
        ];
        $id_posisi = $this->api_pss->read_specific_data($dataID, $tokenAuth);
        if ($id_posisi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_posisi = $this->api_pss->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_posisi' => $id_posisi['data'][0]['id_posisi'],
        ];

        $result = $this->api_pss->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_pss->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Posisi berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Posisi gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}