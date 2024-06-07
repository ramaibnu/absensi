<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roster_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }
    // Variables
    private $datatablesEndpoint = 'roster_datatables';
    private $createEndpoint = 'tambah_roster';
    private $updateEndpoint = 'edit_roster';
    private $deleteEndpoint = 'hapus_roster';

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
        $this->load->view('data_master/roster/view', $dataMain);

        // Modal
        $this->load->view('components/modal/roster');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/roster/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_roster()
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
        $this->load->view('data_master/roster/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/roster/add');

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
        $auth_m_per = htmlspecialchars($this->input->post('perusahaan', true));
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
            $output = "<option value=''>-- ROSTER TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "roster" => $output));
        }

        $parameter = [
            'source' => 'vw_roster',
            'field' => 'auth_perusahaan',
            'value' => $strukturPerusahaan['data'][0]['auth_perusahaan'],
            'field2' => 'stat_roster',
            'value2' => 'T',
        ];
        $result = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameter);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameter);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH ROSTER --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_roster'] . "'>" . $list['roster'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "roster" => $output));
        } else {
            $output = "<option value=''>-- ROSTER TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "roster" => $output));
        }
    }

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_roster');
        $auth_roster = htmlspecialchars(trim($this->input->post("auth")));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'source' => 'vw_roster',
            'field' => 'auth_roster',
            'value' => $auth_roster,
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
            if ($result['data'][0]['stat_roster'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'kode' => $result['data'][0]['kd_roster'],
                'roster' => $result['data'][0]['roster'],
                'keterangan' => $result['data'][0]['ket_roster'],
                'jumlah_onsite' => $result['data'][0]['jml_hari_onsite'],
                'onsite' => intval($result['data'][0]['jml_hari_onsite']) / 7,
                'jumlah_offsite' => $result['data'][0]['jml_hari_offsite'],
                'offsite' => intval($result['data'][0]['jml_hari_offsite']) / 7,
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat'])),
                'pembuat' => $result['data'][0]['nama_user'],
            ];

            $this->session->set_userdata('id_roster', $result['data'][0]['id_roster']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "Roster tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $jumlah_onsite = htmlspecialchars($this->input->post("onsite", true));
        $jumlah_offsite = htmlspecialchars($this->input->post("offsite", true));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $perusahaan = htmlspecialchars($this->input->post("perusahaan", true));
        $tokenAuth = $this->session->userdata('token');

        $jumlahHariOnsite = intval($jumlah_onsite) * 7;
        $jumlahHariOffsite = intval($jumlah_offsite) * 7;

        $kode = $jumlah_onsite . $jumlah_offsite . 'W';
        $roster = $jumlah_onsite . ' - ' . $jumlah_offsite . ' WEEK';

        $parameterData = [
            'source' => 'vw_roster',
            'field' => 'jml_hari_onsite',
            'value' => $jumlahHariOnsite,
            'field2' => 'jml_hari_offsite',
            'value2' => $jumlahHariOffsite,
        ];
        $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterData);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameterData);
        }
        if ($checkData['status'] == 200) {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Roster sudah ada!", "tipe_pesan" => "error"));
            return;
        }

        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $perusahaan,
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

        $data = [
            'kode' => $kode,
            'roster' => $roster,
            'jumlah_onsite' => $jumlahHariOnsite,
            'jumlah_offsite' => $jumlahHariOffsite,
            'keterangan' => $keterangan,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_perusahaan' => $data_perusahaan['data'][0]['id_perusahaan'],
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Roster berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "Roster gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        $id_roster = $this->session->userdata('id_roster');

        if ($id_roster == "") {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "Roster tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $jumlah_onsite = htmlspecialchars($this->input->post("onsite", true));
        $jumlah_offsite = htmlspecialchars($this->input->post("offsite", true));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $tokenAuth = $this->session->userdata('token');

        $jumlahHariOnsite = intval($jumlah_onsite) * 7;
        $jumlahHariOffsite = intval($jumlah_offsite) * 7;

        $kode = $jumlah_onsite . $jumlah_offsite . 'W';
        $roster = $jumlah_onsite . ' - ' . $jumlah_offsite . ' WEEK';

        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $parameterCheckData = [
            'source' => 'vw_roster',
            'field' => 'id_roster !=',
            'value' => $id_roster,
            'field2' => 'jml_hari_onsite',
            'value2' => $jumlahHariOnsite,
            'field3' => 'jml_hari_offsite',
            'value3' => $jumlahHariOffsite,
        ];

        $checkData = $this->std->api($this->specificData3Fields(), $this->getMethod(), $tokenAuth, $parameterCheckData);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->std->api($this->specificData3Fields(), $this->getMethod(), $newToken, $parameterCheckData);
        }
        if ($checkData['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Roster sudah ada!', "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id' => $id_roster,
            'kode' => $kode,
            'roster' => $roster,
            'jumlah_onsite' => $jumlahHariOnsite,
            'jumlah_offsite' => $jumlahHariOffsite,
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
            $this->session->unset_userdata('id_roster');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Roster berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => 'Roster gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_roster = htmlspecialchars(trim($this->input->post('auth')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'source' => 'vw_roster',
            'field' => 'auth_roster',
            'value' => $auth_roster,
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
            'id' => $dataStatus['data'][0]['id_roster'],
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
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Roster berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Roster gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}