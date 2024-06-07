<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
        $this->load->library('FTP_File');
    }

    // View
    public function index()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sweetalert
        $this->load->view('components/sweetalert/pelanggaran/view');

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
        $this->load->view('pelanggaran/view', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/pelanggaran/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_pelanggaran()
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
        $jenisPelanggaran = $this->api_plg->read_data_jenis_pelanggaran($tokenAuth);
        if ($jenisPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $jenisPelanggaran = $this->api_plg->read_data_jenis_pelanggaran($newToken);
        }

        if ($jenisPelanggaran['status'] == 200) {
            $dataMain['langgar_jenis'] = $jenisPelanggaran['data'];
        } else {
            $dataMain['langgar_jenis'] = '';
        }

        $this->load->view('pelanggaran/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/pelanggaran/add');

        // Footer
        $this->load->view('components/footer');
    }

    public function detail_pelanggaran($auth)
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
        $parameter = [
            'field' => 'auth_langgar',
            'value' => $auth,
        ];
        $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $tokenAuth);
        if ($dataPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $newToken);
        }
        if ($dataPelanggaran['status'] == 200) {
            $tglnow = date('Y-m-d');
            $tglakhir = date('Y-m-d', strtotime($dataPelanggaran['data'][0]['tgl_akhir_langgar']));
            if ($tglnow <= $tglakhir) {
                $status = "AKTIF";
            } else {
                $status = "NONAKTIF";
            }
            $pelanggaranKaryawan = [
                'kode_perusahaan' => $dataPelanggaran['data'][0]['kode_perusahaan'],
                'nama_perusahaan' => $dataPelanggaran['data'][0]['nama_m_perusahaan'],
                'no_ktp' => $dataPelanggaran['data'][0]['no_ktp'],
                'no_nik' => $dataPelanggaran['data'][0]['no_nik'],
                'nama_lengkap' => $dataPelanggaran['data'][0]['nama_lengkap'],
                'depart' => $dataPelanggaran['data'][0]['depart'],
                'posisi' => $dataPelanggaran['data'][0]['posisi'],
                'tgl_langgar' => date('d-M-Y', strtotime($dataPelanggaran['data'][0]['tgl_langgar'])),
                'tgl_punishment' => date('d-M-Y', strtotime($dataPelanggaran['data'][0]['tgl_punishment'])),
                'kode_langgar_jenis' => $dataPelanggaran['data'][0]['kode_langgar_jenis'],
                'langgar_jenis' => $dataPelanggaran['data'][0]['langgar_jenis'],
                'tgl_akhir_langgar' => date('d-M-Y', strtotime($dataPelanggaran['data'][0]['tgl_akhir_langgar'])),
                'url_berkas' => base_url('./berkasPelanggaran/') . $auth,
                'ket_langgar' => $dataPelanggaran['data'][0]['ket_langgar'],
                'status' => $status,
                'tgl_buat' => date('d-M-Y H:i:s', strtotime($dataPelanggaran['data'][0]['tgl_buat'])),
                'tgl_edit' => date('d-M-Y H:i:s', strtotime($dataPelanggaran['data'][0]['tgl_edit'])),
                'pembuat' => $dataPelanggaran['data'][0]['nama_user'],
            ];
        } else {
            $pelanggaranKaryawan = [];
        }
        $dataMain['langgar'] = $pelanggaranKaryawan;
        $this->load->view('pelanggaran/detail', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/pelanggaran/detail');

        // Footer
        $this->load->view('components/footer');
    }

    public function update_pelanggaran($auth)
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sweetalert
        $this->load->view('components/sweetalert/pelanggaran/update');

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
        $parameter = [
            'field' => 'auth_langgar',
            'value' => $auth,
        ];
        $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $tokenAuth);
        if ($dataPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $newToken);
        }
        if ($dataPelanggaran['status'] == 200) {
            $pelanggaranKaryawan = [
                'kode_perusahaan' => $dataPelanggaran['data'][0]['kode_perusahaan'],
                'nama_perusahaan' => $dataPelanggaran['data'][0]['nama_m_perusahaan'],
                'auth_m_per' => $dataPelanggaran['data'][0]['auth_m_per'],
                'auth_langgar' => $dataPelanggaran['data'][0]['auth_langgar'],
                'auth_langgar_jenis' => $dataPelanggaran['data'][0]['auth_langgar_jenis'],
                'auth_kary' => $dataPelanggaran['data'][0]['auth_kary'],
                'no_ktp' => $dataPelanggaran['data'][0]['no_ktp'],
                'no_nik' => $dataPelanggaran['data'][0]['no_nik'],
                'nama_lengkap' => $dataPelanggaran['data'][0]['nama_lengkap'],
                'depart' => $dataPelanggaran['data'][0]['depart'],
                'posisi' => $dataPelanggaran['data'][0]['posisi'],
                'tgl_langgar' => date('Y-m-d', strtotime($dataPelanggaran['data'][0]['tgl_langgar'])),
                'tgl_punishment' => date('Y-m-d', strtotime($dataPelanggaran['data'][0]['tgl_punishment'])),
                'kode_langgar_jenis' => $dataPelanggaran['data'][0]['kode_langgar_jenis'],
                'langgar_jenis' => $dataPelanggaran['data'][0]['langgar_jenis'],
                'tgl_akhir_langgar' => date('Y-m-d', strtotime($dataPelanggaran['data'][0]['tgl_akhir_langgar'])),
                'url_berkas' => base_url('./berkasPelanggaran/') . $auth,
                'ket_langgar' => $dataPelanggaran['data'][0]['ket_langgar'],
            ];
        } else {
            $pelanggaranKaryawan = [];
        }
        $jenisPelanggaran = $this->api_plg->read_data_jenis_pelanggaran($tokenAuth);
        if ($jenisPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $jenisPelanggaran = $this->api_plg->read_data_jenis_pelanggaran($newToken);
        }

        $dataMain['langgar'] = $pelanggaranKaryawan;
        if ($jenisPelanggaran['status'] == 200) {
            $dataMain['langgar_jenis'] = $jenisPelanggaran['data'];
        } else {
            $dataMain['langgar_jenis'] = [];
        }
        $this->load->view('pelanggaran/update', $dataMain);

        // Modal
        $this->load->view('components/modal/pelanggaran', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/pelanggaran/update');

        // Footer
        $this->load->view('components/footer');
    }

    public function berkas($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'field' => 'auth_langgar',
            'value' => $auth,
        ];
        $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $tokenAuth);
        if ($dataPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPelanggaran = $this->api_plg->read_specific_data($parameter, $newToken);
        }

        if ($dataPelanggaran['status'] == 200) {
            $url_file = $dataPelanggaran['data'][0]['url_langgar'];
            $id_personal = $dataPelanggaran['data'][0]['id_personal'];

            $foldername = md5($id_personal);
            $dataPDF = $this->ftp_file->readFilePDF(
                [
                    '/home/onedb_kary/karyawan/' . $foldername . '/' . $url_file,
                ],
                $url_file
            );
            if ($dataPDF == null) {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
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
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'auth_per' => $auth_per,
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_plg->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_plg->datatables($data, $newToken);
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

    public function create()
    {
        $authKTPKaryLanggar = htmlspecialchars($this->input->post("authKaryawan", true));
        $tglLanggar = htmlspecialchars($this->input->post("tanggalPelanggaran", true));
        $tglPunish = htmlspecialchars($this->input->post("tanggalHukuman"));
        $jenisPunish = htmlspecialchars($this->input->post("jenisPelanggaran"));
        $tglAkhirPunish = htmlspecialchars($this->input->post("tanggalAkhirHukuman"));
        $ketLanggar = htmlspecialchars($this->input->post("keterangan"));
        $tokenAuth = $this->session->userdata('token');
        $parameterJenis = [
            'field' => 'auth_langgar_jenis',
            'value' => $jenisPunish,
        ];
        $parameterKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $authKTPKaryLanggar,
        ];
        $dataJenis = $this->api_plg->read_specific_data_jenis_pelanggaran($parameterJenis, $tokenAuth);
        if ($dataJenis['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataJenis = $this->api_plg->read_specific_data_jenis_pelanggaran($parameterJenis, $newToken);
        }
        $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
        }
        $id_jenis = $dataJenis['data'][0]['id_langgar_jenis'];
        $id_kary = $dataKaryawan['data'][0]['id_kary'];
        $id_personal = $dataKaryawan['data'][0]['id_personal'];
        $foldername = md5($id_personal);
        $now = date('YmdHis');
        $nama_file = $now . "-LGR.pdf";

        $parameterCheck = [
            'field' => 'id_kary',
            'field2' => 'id_langgar_jenis',
            'value' => $id_kary,
            'value2' => $id_jenis,
        ];
        $checkKaryawan = $this->api_plg->read_specific_data_pelanggaran($parameterCheck, $tokenAuth);
        if ($checkKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKaryawan = $this->api_plg->read_specific_data_pelanggaran($parameterCheck, $newToken);
        }
        if ($checkKaryawan['status'] == 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Karyawan yang dipilih masih memiliki Disciplinary Action yang aktif."));
        }

        $extension = 'pdf';
        $inputName = 'filePelanggaran';
        $fileSize = 110;
        $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
        if ($uploadFile) {
            $data = [
                'id_kary' => $id_kary,
                'tgl_langgar' => $tglLanggar,
                'tgl_punishment' => $tglPunish,
                'id_langgar_jenis' => $id_jenis,
                'ket_langgar' => $ketLanggar,
                'url_langgar' => $nama_file,
                'tgl_akhir_langgar' => $tglAkhirPunish,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $create = $this->api_plg->create($data, $tokenAuth);
            if ($create == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $create = $this->api_plg->create($data, $newToken);
            }
            if ($create == 201) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Data Pelanggaran berhasil disimpan."));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data Pelanggaran gagal disimpan."));
            }
        } elseif ($uploadFile == 400) {
            echo json_encode(array("statusCode" => 201, "pesan" => "File Pelanggaran gagal diupload"));
        } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "File Pelanggaran gagal diupload"));
        }
    }

    public function update()
    {
        $authLgrEdit = htmlspecialchars($this->input->post("authLgrEdit", true));
        $tglLgrEdit = htmlspecialchars($this->input->post("tglLgrEdit", true));
        $tglPunishLgrEdit = htmlspecialchars($this->input->post("tglPunishLgrEdit", true));
        $jenisLgrEdit = htmlspecialchars($this->input->post("jenisLgrEdit", true));
        $tglAkhirPunishLgrEdit = htmlspecialchars($this->input->post("tglAkhirPunishLgrEdit", true));
        $ketLgrEdit = htmlspecialchars($this->input->post("ketLgrEdit", true));
        $tokenAuth = $this->session->userdata('token');
        $parameterJenis = [
            'field' => 'auth_langgar_jenis',
            'value' => $jenisLgrEdit,
        ];
        $dataJenis = $this->api_plg->read_specific_data_jenis_pelanggaran($parameterJenis, $tokenAuth);
        if ($dataJenis['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataJenis = $this->api_plg->read_specific_data_jenis_pelanggaran($parameterJenis, $newToken);
        }
        $parameterPelanggaran = [
            'field' => 'auth_langgar',
            'value' => $authLgrEdit,
        ];
        $dataPelanggaran = $this->api_plg->read_specific_data($parameterPelanggaran, $tokenAuth);
        if ($dataPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPelanggaran = $this->api_plg->read_specific_data($parameterPelanggaran, $newToken);
        }
        if ($dataJenis['status'] == 200) {
            $id_jenis = $dataJenis['data'][0]['id_langgar_jenis'];
        } else {
            $id_jenis = '';
        }
        if ($dataPelanggaran['status'] == 200) {
            $id_langgar = $dataPelanggaran['data'][0]['id_langgar'];
        } else {
            $this->session->set_flashdata('not_found', 'not_found');
            redirect(base_url('pelanggaran') . $authLgrEdit);
        }

        $parameter = [
            'id_langgar' => $id_langgar,
            'tgl_langgar' => $tglLgrEdit,
            'tgl_punishment' => $tglPunishLgrEdit,
            'id_langgar_jenis' => $id_jenis,
            'ket_langgar' => $ketLgrEdit,
            'tgl_akhir_langgar' => $tglAkhirPunishLgrEdit,
        ];
        $update = $this->api_plg->update($parameter, $tokenAuth);
        if ($update == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $update = $this->api_plg->update($parameter, $newToken);
        }
        if ($update == 200) {
            $this->session->set_flashdata('update_success', 'update_success');
            redirect('pelanggaran');
        } else {
            $this->session->set_flashdata('update_fail', 'update_fail');
            redirect(base_url('update_pelanggaran/') . $authLgrEdit);
        }
    }

    public function upload_file()
    {
        $authlgr = htmlspecialchars($this->input->post("authlgr", true));
        $tokenAuth = $this->session->userdata('token');
        $parameterPelanggaran = [
            'field' => 'auth_langgar',
            'value' => $authlgr,
        ];
        $dataPelanggaran = $this->api_plg->read_specific_data($parameterPelanggaran, $tokenAuth);
        if ($dataPelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPelanggaran = $this->api_plg->read_specific_data($parameterPelanggaran, $newToken);
        }

        if ($dataPelanggaran['status'] == 200) {
            $id_langgar = $dataPelanggaran['data'][0]['id_langgar'];
            $id_personal = $dataPelanggaran['data'][0]['id_personal'];
            $url_langgar = $dataPelanggaran['data'][0]['url_langgar'];

            if (!empty($url_langgar)) {
                $namafile = $url_langgar;
            } else {
                $namafile = date('YmdHis') . "-LGR.pdf";
            }

            $foldername = md5($id_personal);

            $extension = 'pdf';
            $inputName = 'berkasPunishEdit';
            $fileSize = 110;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $namafile);
            if ($uploadFile) {
                $parameter = [
                    'id_langgar' => $id_langgar,
                    'url_langgar' => $namafile,
                ];
                $update = $this->api_plg->update_file($parameter, $tokenAuth);
                if ($update == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $update = $this->api_plg->update_file($parameter, $newToken);
                }
                if ($update == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Berkas Disciplinary Action berhasil diganti", "brks" => base_url('./berkasPelanggaran/') . $authlgr));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Berkas Disciplinary Action gagal diganti"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Berkas Disciplinary Action gagal diupload"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Berkas Disciplinary Action gagal diupload"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Berkas Disciplinary Action gagal diganti"));
        }
    }

    public function delete()
    {
        $auth_langgar = $this->input->post('auth_langgar');
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'field' => 'auth_langgar',
            'value' => $auth_langgar,
        ];
        $data = $this->api_plg->read_specific_data($parameterData, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_plg->read_specific_data($parameterData, $newToken);
        }

        if ($data['status'] == 404) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data pelanggaran tidak ditemukan"));
            return;
        }

        $id_personal = $data['data'][0]['id_personal'];
        $foldername = md5($id_personal);
        $id_langgar = $data['data'][0]['id_langgar'];
        $file = $data['data'][0]['url_langgar'];
        $parameter = [
            'field' => 'id_langgar',
            'value' => $id_langgar,
        ];
        $delete = $this->api_plg->delete($parameter, $tokenAuth);
        if ($delete == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $delete = $this->api_plg->delete($parameter, $newToken);
        }
        if ($delete == 200) {
            $this->ftp_file->deleteFile($foldername, $file);
            echo json_encode(array("statusCode" => 200, "pesan" => "Data pelanggaran berhasil dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data pelanggaran gagal dihapus"));
            return;
        }
    }
}