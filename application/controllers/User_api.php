<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_api extends MY_Controller
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

        $parameterMenu = [
            'source' => 'vw_menu',
            'field' => 'StatMenu',
            'value' => 'AKTIF',
        ];
        $menu = $this->api->specific_data($parameterMenu, $tokenAuth);
        if ($menu['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $menu = $this->api->specific_data($parameterMenu, $newToken);
        }
        if ($menu['status'] == 200) {
            $dataMain['data_menu'] = $menu['data'];
        } else {
            $dataMain['data_menu'] = [];
        }
        $this->load->view('authority/user/view', $dataMain);

        // Modal
        $this->load->view('components/modal/user');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/user/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_user()
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

        $parameterMenu = [
            'source' => 'vw_menu',
            'field' => 'StatMenu',
            'value' => 'AKTIF',
        ];
        $menu = $this->api->specific_data($parameterMenu, $tokenAuth);
        if ($menu['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $menu = $this->api->specific_data($parameterMenu, $newToken);
        }
        if ($menu['status'] == 200) {
            $dataMain['data_menu'] = $menu['data'];
        } else {
            $dataMain['data_menu'] = [];
        }
        $this->load->view('authority/user/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/user/add');

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

        $datatables = $this->api_usr->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_usr->datatables($data, $newToken);
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
        $this->session->unset_userdata('id_user');
        $auth_user = htmlspecialchars(trim($this->input->post("auth_user")));
        $tokenAuth = $this->session->userdata('token');

        $dataUser = [
            'field' => 'auth_user',
            'value' => $auth_user,
        ];
        $result = $this->api_usr->read_specific_data($dataUser, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_usr->read_specific_data($dataUser, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_user'] == "T") {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }

            $data = [
                'statusCode' => 200,
                'nama_user' => $result['data'][0]['nama_user'],
                'email_user' => $result['data'][0]['email_user'],
                'tgl_aktif' => date('Y-m-d', strtotime($result['data'][0]['tgl_aktif'])),
                'tgl_exp' => date('Y-m-d', strtotime($result['data'][0]['tgl_exp'])),
                'menu' => $result['data'][0]['NamaMenu'],
                'perusahaan' => $result['data'][0]['nama_perusahaan'],
                'struktur' => $result['data'][0]['nama_m_perusahaan'],
            ];

            $this->session->set_userdata('id_user', $result['data'][0]['id_user']);
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "kode_pesan" => "Gagal", "pesan" => "User tidak ditemukan!", "tipe_pesan" => "error"));
        }
    }

    public function insert()
    {
        $nama_user = htmlspecialchars(trim($this->input->post('nama_user')));
        $email_user = htmlspecialchars(trim($this->input->post('email_user')));
        $tgl_aktif = htmlspecialchars($this->input->post('tgl_aktif'));
        $tgl_exp = htmlspecialchars($this->input->post('tgl_exp'));
        $sesi = htmlspecialchars(trim($this->input->post('sesi')));
        $id_menu = htmlspecialchars($this->input->post('id_menu'));
        $id_m_perusahaan = htmlspecialchars($this->input->post('id_m_perusahaan'));

        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'email_user',
            'value' => $email_user,
        ];
        $checkEmail = $this->api_usr->read_specific_data($dataID, $tokenAuth);
        if ($checkEmail['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkEmail = $this->api_usr->read_specific_data($dataID, $newToken);
        }
        if ($checkEmail['status'] == 200) {
            echo json_encode(array("statusCode" => 403, "kode_pesan" => "Gagal", "pesan" => "Email sudah terdaftar!", "tipe_pesan" => "warning"));
            return;
        }

        $parameterkAkses = [
            'source' => 'vw_menu',
            'field' => 'auth_menu',
            'value' => $id_menu,
        ];
        $akses = $this->api->specific_data($parameterkAkses, $tokenAuth);
        if ($akses['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $akses = $this->api->specific_data($parameterkAkses, $newToken);
        }

        $id_menu = $akses['data'][0]['IdMenu'];

        if ($id_menu == 1) {
            $akses_apps = 'ALL';
        } elseif ($id_menu == 2) {
            $akses_apps = 'HCT';
        } else {
            $akses_apps = 'TEMP';
        }

        $parameterPerusahaan = [
            'field' => 'auth_m_perusahaan',
            'value' => $id_m_perusahaan,
        ];
        $perusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $tokenAuth);
        if ($perusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $perusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $newToken);
        }

        $id_m_perusahaan = $perusahaan['data'][0]['id_m_perusahaan'];

        $data = [
            'nama_user' => $nama_user,
            'email_user' => $email_user,
            'tgl_aktif' => $tgl_aktif,
            'tgl_exp' => $tgl_exp,
            'sesi' => md5($sesi),
            'id_menu' => $id_menu,
            'akses_apps' => $akses_apps,
            'id_user' => $this->session->userdata('id_user_hcdata'),
            'id_m_perusahaan' => $id_m_perusahaan,
        ];

        $result = $this->api_usr->create($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_usr->create($data, $newToken);
        }
        if ($result == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "User berhasil disimpan!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "User gagal disimpan!", "tipe_pesan" => "error", "content" => $result));
        }
    }

    public function update()
    {
        $id_user = $this->session->userdata('id_user');

        if (empty($id_user)) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "User tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $nama_user = htmlspecialchars(trim($this->input->post('nama_user')));
        $email_user = htmlspecialchars(trim($this->input->post('email_user')));
        $tgl_aktif = htmlspecialchars($this->input->post('tgl_aktif'));
        $tgl_exp = htmlspecialchars($this->input->post('tgl_exp'));
        $id_menu = htmlspecialchars($this->input->post('id_menu'));
        $id_m_perusahaan = htmlspecialchars($this->input->post('id_m_perusahaan'));
        $tokenAuth = $this->session->userdata('token');

        $parameterEmail = [
            'source' => 'vw_user',
            'field' => 'id_user !=',
            'value' => $id_user,
            'field2' => 'email_user',
            'value2' => $email_user,
        ];

        $checkEmail = $this->api->specific_data_by_2_fields($parameterEmail, $tokenAuth);
        if ($checkEmail['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkEmail = $this->api->specific_data_by_2_fields($parameterEmail, $newToken);
        }
        if ($checkEmail['status'] == 200) {
            echo json_encode(array("statusCode" => 403, "kode_pesan" => "Gagal", "pesan" => "Email sudah terdaftar!", "tipe_pesan" => "warning"));
            return;
        }

        $parameterkAkses = [
            'source' => 'vw_menu',
            'field' => 'auth_menu',
            'value' => $id_menu,
        ];
        $akses = $this->api->specific_data($parameterkAkses, $tokenAuth);
        if ($akses['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $akses = $this->api->specific_data($parameterkAkses, $newToken);
        }

        $id_menu = $akses['data'][0]['IdMenu'];

        if ($id_user == 106) {
            $akses_apps = 'ALL';
        } else {
            if ($id_menu == 1) {
                $akses_apps = 'ALL';
            } elseif ($id_menu == 4) {
                $akses_apps = 'HCT';
            } else {
                $akses_apps = 'TEMP';
            }
        }

        $parameterPerusahaan = [
            'field' => 'auth_m_perusahaan',
            'value' => $id_m_perusahaan,
        ];
        $perusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $tokenAuth);
        if ($perusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $perusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $newToken);
        }

        $id_m_perusahaan = $perusahaan['data'][0]['id_m_perusahaan'];

        $parameter = [
            'id_user' => $id_user,
            'nama_user' => $nama_user,
            'email_user' => $email_user,
            'tgl_aktif' => $tgl_aktif,
            'tgl_exp' => $tgl_exp,
            'id_menu' => $id_menu,
            'akses_apps' => $akses_apps,
            'id_m_perusahaan' => $id_m_perusahaan,
        ];

        $updateUser = $this->api_usr->update($parameter, $tokenAuth);
        if ($updateUser == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $updateUser = $this->api_usr->update($parameter, $newToken);
        }
        if ($updateUser == 200) {
            $this->session->unset_userdata('id_user');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "User berhasil diupdate!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => 'User gagal diupdate!', "tipe_pesan" => "error"));
        }
    }

    public function reset_password()
    {
        $id_user = $this->session->userdata('id_user');

        if (empty($id_user)) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "User tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $newPassword = htmlspecialchars(trim($this->input->post("newPassword")));
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'id_user' => $id_user,
            'sesi' => md5($newPassword),
        ];

        $resetPassword = $this->api_usr->reset($parameter, $tokenAuth);
        if ($resetPassword == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resetPassword = $this->api_usr->reset($parameter, $newToken);
        }
        if ($resetPassword == 200) {
            $this->session->unset_userdata('id_user');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Sandi User berhasil direset!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => 'Sandi User gagal direset!', "tipe_pesan" => "error"));
        }
    }

    public function aktif()
    {
        $auth_user = htmlspecialchars(trim($this->input->post("auth_user")));
        $tokenAuth = $this->session->userdata('token');

        $paramterData = [
            'field' => 'auth_user',
            'value' => $auth_user,
        ];
        $dataUser = $this->api_usr->read_specific_data($paramterData, $tokenAuth);
        if ($dataUser['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataUser = $this->api_usr->read_specific_data($paramterData, $newToken);
        }

        $id_user = $dataUser['data'][0]['id_user'];

        $parameter = [
            'id_user' => $id_user,
            'stat_user' => 'T',
        ];

        $nonaktifUser = $this->api_usr->changeStatus($parameter, $tokenAuth);
        if ($nonaktifUser == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $nonaktifUser = $this->api_usr->changeStatus($parameter, $newToken);
        }
        if ($nonaktifUser == 200) {
            $this->session->unset_userdata('id_user');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "User berhasil diaktifkan kembali!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => 'User gagal diaktifkan kembali!', "tipe_pesan" => "error"));
        }
    }

    public function nonaktif()
    {
        $auth_user = htmlspecialchars(trim($this->input->post("auth_user")));
        $tokenAuth = $this->session->userdata('token');

        $paramterData = [
            'field' => 'auth_user',
            'value' => $auth_user,
        ];
        $dataUser = $this->api_usr->read_specific_data($paramterData, $tokenAuth);
        if ($dataUser['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataUser = $this->api_usr->read_specific_data($paramterData, $newToken);
        }

        $id_user = $dataUser['data'][0]['id_user'];

        $parameter = [
            'id_user' => $id_user,
            'stat_user' => 'F',
        ];

        $nonaktifUser = $this->api_usr->changeStatus($parameter, $tokenAuth);
        if ($nonaktifUser == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $nonaktifUser = $this->api_usr->changeStatus($parameter, $newToken);
        }
        if ($nonaktifUser == 200) {
            $this->session->unset_userdata('id_user');
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "User berhasil dinonaktifkan!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => 'User gagal dinonaktifkan!', "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_user = htmlspecialchars(trim($this->input->post('auth_user')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_user',
            'value' => $auth_user,
        ];
        $dataUser = $this->api_usr->read_specific_data($dataID, $tokenAuth);
        if ($dataUser['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataUser = $this->api_usr->read_specific_data($dataID, $newToken);
        }

        if ($dataUser['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "kode_pesan" => "Gagal", "pesan" => "User tidak ditemukan!", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'id_user' => $dataUser['data'][0]['id_user'],
        ];

        $result = $this->api_usr->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_usr->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "User berhasil dihapus!", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 400, "kode_pesan" => "Gagal", "pesan" => "User gagal dihapus!", "tipe_pesan" => "error"));
        }
    }
}