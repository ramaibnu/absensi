<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin_tambang_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
        $this->load->library('FTP_File');
    }

    public function add_unit_izin_tambang()
    {
        $this->form_validation->set_rules("jenisunit", "jenisunit", "required|trim", [
            'required' => 'Jenis unit wajib dipilih',
        ]);
        $this->form_validation->set_rules("tipeakses", "tipeakses", "required|trim", [
            'required' => 'Tipe akses wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));

            if ($filesim == "" || $filesim == "") {
                $errsim = "<p>SIM Polisi wajib diupload</p>";
            } else {
                $errsim = "";
            }

            if ($filesmp == "" || $filesmp == "") {
                $errsmp = "<p>SIMPER /MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisunit' => form_error("jenisunit"),
                'tipeakses' => form_error("tipeakses"),
                "filesim" => $errsim,
                "filesmp" => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_simpol = htmlspecialchars($this->input->post("auth_simpol", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $jenis_unit = htmlspecialchars($this->input->post("jenisunit", true));
            $tipe_akses = htmlspecialchars($this->input->post("tipeakses", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $tokenAuth = $this->session->userdata("token");
            $parameterKaryawan = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
            }
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $parameterPersonal = [
                'field' => 'auth_personal',
                'value' => $auth_person,
            ];
            $dataPersonal = $this->api_psn->read_specific_data($parameterPersonal, $tokenAuth);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->api_psn->read_specific_data($parameterPersonal, $newToken);
            }
            $id_personal = $dataPersonal['data'][0]['id_personal'];
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_smp = $now . "-SMP.pdf";
            $nama_sim = $now . "-SIMPOL.pdf";
            // $parameterIDKaryawan = [
            //     'field' => 'id_karyawan',
            //     'value' => $id_karyawan,
            //     'field2' => 'tgl_exp_sim >',
            //     'value2' => date('Y-m-d'),
            // ];
            // $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $tokenAuth);
            // if ($dataSIM['status'] == 403) {
            //     $this->session->unset_userdata('token');
            //     $tokenData = $this->api_tkn->getToken($this->tokenData());
            //     $this->session->set_userdata('token', $tokenData['data']);
            //     $newToken = $this->session->userdata('token');
            //     $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $newToken);
            // }
            // echo json_encode(array("test" => $dataSIM));
            // return;
            // $id_sim_kary = $dataSIM['data'][0]['id_sim_kary'];

            $parameterAksesUnit = [
                'field' => 'id_tipe_akses_unit',
                'value' => $tipe_akses,
            ];
            $dataAksesUnit = $this->api_izt->specific_tipe_akses($parameterAksesUnit, $tokenAuth);
            if ($dataAksesUnit['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataAksesUnit = $this->api_izt->specific_tipe_akses($parameterAksesUnit, $newToken);
            }
            if ($dataAksesUnit['status'] == 404) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Izin akses tidak ditemukan"));
                return;
            }

            if ($auth_izin == "") {
                $extension = 'pdf';
                $inputSim = 'filesimpolisi';
                $fileSize = 110;
                $uploadSim = $this->ftp_file->uploadFile($foldername, $extension, $inputSim, $fileSize, $nama_sim);
                $inputSimper = 'filesmpkary';
                $uploadSimper = $this->ftp_file->uploadFile($foldername, $extension, $inputSimper, $fileSize, $nama_smp);
                if ($uploadSim == 200 || $uploadSimper == 200) {
                    $data_sim_polisi = [
                        'id_personal' => $id_personal,
                        'jenissim' => $jenissim,
                        'tglexpsim' => $tglexpsim,
                        'nama_file' => $nama_sim,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $resultSimKaryawan = $this->api_izt->create_sim_karyawan($data_sim_polisi, $tokenAuth);
                    if ($resultSimKaryawan == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $resultSimKaryawan = $this->api_izt->create_sim_karyawan($data_sim_polisi, $newToken);
                    }

                    $parameterLastSIM = [
                        'condition' => 'id_personal',
                        'conditionValue' => $id_personal,
                        'orderField' => 'id_sim_kary',
                        'orderValue' => 'DESC',
                    ];
                    $dataLastSIM = $this->api_izt->lastest_data_sim($parameterLastSIM, $tokenAuth);
                    if ($dataLastSIM['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLastSIM = $this->api_izt->lastest_data_sim($parameterLastSIM, $newToken);
                    }
                    $last_sim = $dataLastSIM['data'][0]['id_sim_kary'];

                    $data_izin_tambang = [
                        'id_karyawan' => $id_karyawan,
                        'jenisizin' => $jenisizin,
                        'noreg' => $noreg,
                        'tglexp' => $tglexp,
                        'id_sim_kary' => $last_sim,
                        'url_izin' => $nama_smp,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createIzin = $this->api_izt->create_permit($data_izin_tambang, $tokenAuth);
                    if ($createIzin == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createIzin = $this->api_izt->create_permit($data_izin_tambang, $newToken);
                    }

                    $parameterLastest = [
                        'condition' => 'id_personal',
                        'conditionValue' => $id_personal,
                        'orderField' => 'id_izin_tambang',
                        'orderValue' => 'DESC',
                    ];
                    $dataLastIzin = $this->api_izt->lastest_data_izin($parameterLastest, $tokenAuth);
                    if ($dataLastIzin['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLastIzin = $this->api_izt->lastest_data_izin($parameterLastest, $newToken);
                    }
                    $auth_simpol = $dataLastSIM['data'][0]['auth_sim_kary'];
                    if ($dataLastIzin['status'] == 200) {
                        $auth_izin = $dataLastIzin['data'][0]['auth_izin_tambang'];
                        $id_izin = $dataLastIzin['data'][0]['id_izin_tambang'];

                        $data_unit_izin = [
                            'id_izin' => $id_izin,
                            'jenis_unit' => $jenis_unit,
                            'tipe_akses' => $tipe_akses,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $tokenAuth);
                        if ($createSimperUnit == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $newToken);
                        }
                        $linkizn = base_url('Izin_tambang_api/checkFile/' . $auth_izin);
                        $linksim = base_url('Izin_tambang_api/checkFileSIM/' . $auth_simpol);

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data SIMPER berhasil disimpan",
                            "auth_izin" => $auth_izin,
                            "auth_simpol" => $auth_simpol,
                            "auth_unit" => "j78uh5yg",
                            "filesmp" => $smpname,
                            "filesmpsv" => $_FILES['filesmpkary']['name'],
                            "linkizin" => $linkizn,
                            "filesim" => $smpname,
                            "filesimsv" => $_FILES['filesimpolisi']['name'],
                            "linksim" => $linksim,
                        ));
                    } else {
                        $auth_izin = "";
                        $id_izin = "";

                        echo json_encode(array(
                            "statusCode" => 201,
                            "pesan" => "Unit gagal disimpan, data izin tidak ditemukan",
                        ));
                    }
                } else {
                    $auth_izin = "";
                    $id_izin = "";

                    echo json_encode(array(
                        "statusCode" => 201,
                        "pesan" => "Unit gagal disimpan, data izin tidak ditemukan",
                    ));
                }
            } else {
                $parameterCheckUnitIzin = [
                    'field' => 'auth_izin_tambang',
                    'value' => $auth_izin,
                    'field2' => 'id_unit',
                    'value2' => $jenis_unit,
                ];
                $checkUnitIzin = $this->api_izt->check_unit_izin($parameterCheckUnitIzin, $tokenAuth);
                if ($checkUnitIzin['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $checkUnitIzin = $this->api_izt->check_unit_izin($parameterCheckUnitIzin, $newToken);
                }
                if (!empty($checkUnitIzin['data'])) {
                    echo json_encode(array(
                        "statusCode" => 201,
                        'pesan' => 'Unit sudah ada',
                    ));
                    return;
                }

                $parameterIDIzin = [
                    'field' => 'auth_izin_tambang',
                    'value' => $auth_izin,
                ];
                $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $tokenAuth);
                if ($dataIzinTambang['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $newToken);
                }

                $id_izin = $dataIzinTambang['data'][0]['id_izin_tambang'];

                if (!empty($id_izin)) {
                    $data_unit_izin = [
                        'id_izin' => $id_izin,
                        'jenis_unit' => $jenis_unit,
                        'tipe_akses' => $tipe_akses,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $tokenAuth);
                    if ($createSimperUnit == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $newToken);
                    }
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit berhasil ditambahkan',
                        "auth_izin" => $auth_izin,
                        "auth_unit" => 0,
                    ));
                } else {
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit gagal ditambahkan',
                        "auth_unit" => 0,
                    ));
                    return;
                }
            }
        }
    }

    public function add_unit_izin_tambang_new()
    {
        $this->form_validation->set_rules("jenisunit", "jenisunit", "required|trim", [
            'required' => 'Jenis unit wajib dipilih',
        ]);
        $this->form_validation->set_rules("tipeakses", "tipeakses", "required|trim", [
            'required' => 'Tipe akses wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));

            if ($filesim == "" || $filesim == "") {
                $errsim = "<p>SIM Polisi wajib diupload</p>";
            } else {
                $errsim = "";
            }

            if ($filesmp == "" || $filesmp == "") {
                $errsmp = "<p>SIMPER /MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisunit' => form_error("jenisunit"),
                'tipeakses' => form_error("tipeakses"),
                "filesim" => $errsim,
                "filesmp" => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_simpol = htmlspecialchars($this->input->post("auth_simpol", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $jenis_unit = htmlspecialchars($this->input->post("jenisunit", true));
            $tipe_akses = htmlspecialchars($this->input->post("tipeakses", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $tokenAuth = $this->session->userdata("token");
            $parameterPersonal = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterPersonal, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterPersonal, $newToken);
            }
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $id_personal = $dataKaryawan['data'][0]['id_personal'];
            $auth_person = $dataKaryawan['data'][0]['auth_personal'];
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_smp = $now . "-SMP.pdf";
            $nama_sim = $now . "-SIMPOL.pdf";
            $parameterIDKaryawan = [
                'field' => 'id_karyawan',
                'value' => $id_karyawan,
                'field2' => 'tgl_exp_sim >',
                'value2' => date('Y-m-d'),
            ];
            $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $tokenAuth);
            if ($dataSIM['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $newToken);
            }
            $id_sim_kary = $dataSIM['data'][0]['id_sim_kary'];

            $parameterAksesUnit = [
                'field' => 'id_tipe_akses_unit',
                'value' => $tipe_akses,
            ];
            $dataAksesUnit = $this->api_izt->specific_tipe_akses($parameterAksesUnit, $tokenAuth);
            if ($dataAksesUnit['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataAksesUnit = $this->api_izt->specific_tipe_akses($parameterAksesUnit, $newToken);
            }
            if ($dataAksesUnit['status'] == 404) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Izin akses tidak ditemukan"));
                return;
            }

            // ---------- cek simper ---------------------------
            $smpname = $_FILES['filesmpkary']['name'];
            $smptipe = $_FILES['filesmpkary']['type'];
            $smpsize = $_FILES['filesmpkary']['size'];

            if ($smpname == "") {
                echo json_encode(array("statusCode" => 202, "filesmp" => "SIMPER wajib diupload."));
                return;
            }

            if ($smptipe === 'application\/pdf') {
                echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                return;
            }

            if ($smpsize > 100000) {
                echo json_encode(array("statusCode" => 202, "filesmp" => "Ukuran file maksimal 100kb."));
                return;
            }

            // ---------- cek sim ---------------------------
            $simname = $_FILES['filesimpolisi']['name'];
            $simtype = $_FILES['filesimpolisi']['type'];
            $simsize = $_FILES['filesimpolisi']['size'];

            if ($simname == "") {
                echo json_encode(array("statusCode" => 202, "filesim" => "SIM Polisi wajib diupload."));
                return;
            }

            if ($simtype == "application\/pdf") {
                echo json_encode(array("statusCode" => 202, "filesim" => "Format file yang diupload wajib dalam bentuk pdf."));
                return;
            }

            if ($simsize > 100000) {
                echo json_encode(array("statusCode" => 202, "filesim" => "Ukuran file maksimal 100kb."));
                return;
            }

            if ($auth_izin == "") {
                $extension = 'pdf';
                $inputSim = 'filesimpolisi';
                $fileSize = 110;
                $uploadSim = $this->ftp_file->uploadFile($foldername, $extension, $inputSim, $fileSize, $nama_sim);
                $inputSimper = 'filesmpkary';
                $uploadSimper = $this->ftp_file->uploadFile($foldername, $extension, $inputSimper, $fileSize, $nama_smp);
                if ($uploadSim == 200 || $uploadSimper == 200) {
                    $data_sim_polisi = [
                        'id_personal' => $id_personal,
                        'jenissim' => $jenissim,
                        'tglexpsim' => $tglexpsim,
                        'nama_file' => $nama_sim,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $resultSimKaryawan = $this->api_izt->create_sim_karyawan($data_sim_polisi, $tokenAuth);
                    if ($resultSimKaryawan == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $resultSimKaryawan = $this->api_izt->create_sim_karyawan($data_sim_polisi, $newToken);
                    }

                    $parameterLastSIM = [
                        'condition' => 'id_personal',
                        'conditionValue' => $id_personal,
                        'orderField' => 'id_sim_kary',
                        'orderValue' => 'DESC',
                    ];
                    $dataLastSIM = $this->api_izt->lastest_data_sim($parameterLastSIM, $tokenAuth);
                    if ($dataLastSIM['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLastSIM = $this->api_izt->lastest_data_sim($parameterLastSIM, $newToken);
                    }
                    $last_sim = $dataLastSIM['data'][0]['id_sim_kary'];

                    $data_izin_tambang = [
                        'id_karyawan' => $id_karyawan,
                        'jenisizin' => $jenisizin,
                        'noreg' => $noreg,
                        'tglexp' => $tglexp,
                        'id_sim_kary' => $last_sim,
                        'url_izin' => $nama_smp,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createIzin = $this->api_izt->create_permit($data_izin_tambang, $tokenAuth);
                    if ($createIzin == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createIzin = $this->api_izt->create_permit($data_izin_tambang, $newToken);
                    }

                    $parameterLastest = [
                        'condition' => 'id_personal',
                        'conditionValue' => $id_personal,
                        'orderField' => 'id_izin_tambang',
                        'orderValue' => 'DESC',
                    ];
                    $dataLastIzin = $this->api_izt->lastest_data_izin($parameterLastest, $tokenAuth);
                    if ($dataLastIzin['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLastIzin = $this->api_izt->lastest_data_izin($parameterLastest, $newToken);
                    }
                    $auth_simpol = $dataLastSIM['data'][0]['auth_sim_kary'];
                    if ($dataLastIzin['status'] == 200) {
                        $auth_izin = $dataLastIzin['data'][0]['auth_izin_tambang'];
                        $id_izin = $dataLastIzin['data'][0]['id_izin_tambang'];

                        $data_unit_izin = [
                            'id_izin' => $id_izin,
                            'jenis_unit' => $jenis_unit,
                            'tipe_akses' => $tipe_akses,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $tokenAuth);
                        if ($createSimperUnit == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $newToken);
                        }
                        $linkizn = base_url('Izin_tambang_api/checkFile/' . $auth_izin);
                        $linksim = base_url('Izin_tambang_api/checkFileSIM/' . $auth_simpol);

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data SIMPER berhasil disimpan",
                            "auth_izin" => $auth_izin,
                            "auth_simpol" => $auth_simpol,
                            "auth_unit" => "j78uh5yg",
                            "filesmp" => $smpname,
                            "filesmpsv" => $_FILES['filesmpkary']['name'],
                            "linkizin" => $linkizn,
                            "filesim" => $smpname,
                            "filesimsv" => $_FILES['filesimpolisi']['name'],
                            "linksim" => $linksim,
                        ));
                    } else {
                        $auth_izin = "";
                        $id_izin = "";

                        echo json_encode(array(
                            "statusCode" => 201,
                            "pesan" => "Unit gagal disimpan, data izin tidak ditemukan",
                        ));
                    }
                }
            } else {
                $parameterCheckUnitIzin = [
                    'field' => 'auth_izin_tambang',
                    'value' => $auth_izin,
                    'field2' => 'id_unit',
                    'value2' => $jenis_unit,
                ];
                $checkUnitIzin = $this->api_izt->check_unit_izin($parameterCheckUnitIzin, $tokenAuth);
                if ($checkUnitIzin['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $checkUnitIzin = $this->api_izt->check_unit_izin($parameterCheckUnitIzin, $newToken);
                }
                if (!empty($checkUnitIzin['data'])) {
                    echo json_encode(array(
                        "statusCode" => 201,
                        'pesan' => 'Unit sudah ada',
                    ));
                    return;
                }

                $parameterIDIzin = [
                    'field' => 'auth_izin_tambang',
                    'value' => $auth_izin,
                ];
                $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $tokenAuth);
                if ($dataIzinTambang['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $newToken);
                }

                $id_izin = $dataIzinTambang['data'][0]['id_izin_tambang'];

                if (!empty($id_izin)) {
                    $data_unit_izin = [
                        'id_izin' => $id_izin,
                        'jenis_unit' => $jenis_unit,
                        'tipe_akses' => $tipe_akses,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $tokenAuth);
                    if ($createSimperUnit == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createSimperUnit = $this->api_izt->create_simper_unit($data_unit_izin, $newToken);
                    }
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit berhasil ditambahkan',
                        "auth_izin" => $auth_izin,
                        "auth_unit" => 0,
                    ));
                } else {
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit gagal ditambahkan',
                        "auth_unit" => 0,
                    ));
                    return;
                }
            }
        }
    }

    public function create()
    {
        $this->form_validation->set_rules("jenisizin", "jenisizin", "required|trim", [
            'required' => 'Jenis Izin wajib dipilih',
        ]);
        $this->form_validation->set_rules("noreg", "noreg", "required|trim|max_length[50]", [
            'required' => 'No. Register wajib diisi',
            'max_length' => 'No. Register maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("tglexp", "tglexp", "required|trim", [
            'required' => 'Tanggal expired wajib diisi',
        ]);
        $this->form_validation->set_rules("jenissim", "jenissim", "trim");
        $this->form_validation->set_rules("tglexpsim", "tglexpsim", "trim");

        if ($this->form_validation->run() == false) {
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));

            if ($jenisizin == 2) { // ================= jika simper ===========================
                $filesim = htmlspecialchars($this->input->post("filesim", true));
                if ($jenissim == "") {
                    $errjenis = "<p>Jenis SIM wajib dipilih</p>";
                } else {
                    $errjenis = "";
                }

                if ($tglexpsim == "") {
                    $errtglsim = "<p>Tanggal expired SIM wajib diisi</p>";
                } else {
                    $errtglsim = "";
                }

                if ($filesim == "") {
                    $errsim = "<p>SIM Polisi wajib diupload</p>";
                } else {
                    $errsim = "";
                }
            } else {
                $errjenis = "";
                $errtglsim = "";
                $errsim = "";
            }

            if ($filesmp == "") {
                $errsmp = "<p>SIMPER / MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisizin' => form_error("jenisizin"),
                'noreg' => form_error("noreg"),
                'tglexp' => form_error("tglexp"),
                'jenissim' => $errjenis,
                'tglexpsim' => $errtglsim,
                'filesim' => $errsim,
                'filesmp' => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_simpol = htmlspecialchars($this->input->post("auth_simpol", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $tokenAuth = $this->session->userdata("token");
            $parameterKaryawan = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
            }
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $id_personal = $dataKaryawan['data'][0]['id_personal'];

            $parameterIDKaryawan = [
                'field' => 'id_karyawan',
                'value' => $id_karyawan,
                'field2' => 'tgl_exp_sim >',
                'value2' => date('Y-m-d'),
            ];
            $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $tokenAuth);
            if ($dataSIM['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $newToken);
            }
            if (!empty($dataSIM['data'])) {
                $id_sim_kary = $dataSIM['data'][0]['id_sim_kary'];
            } else {
                $id_sim_kary = '';
            }
            $url_izin = date('YmdHis') . '-SMP.pdf';
            $url_sim = date('YmdHis') . '-SIMPOL.pdf';
            $foldername = md5($id_personal);
            $tokenAuth = $this->session->userdata("token");

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($jenisizin == 2) {
                if ($auth_izin != "") {
                    $parameterCheckUnitIzin = [
                        'field' => 'auth_izin_tambang',
                        'value' => $auth_izin,
                    ];
                    $checkUnitIzin = $this->api_izt->read_data_simper_unit($parameterCheckUnitIzin, $tokenAuth);
                    if ($checkUnitIzin['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $checkUnitIzin = $this->api_izt->read_data_simper_unit($parameterCheckUnitIzin, $newToken);
                    }

                    if ($checkUnitIzin['status'] == 404) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                        return;
                    } else {
                        $simname = $_FILES['filesimkary']['name'];
                        $simtipe = $_FILES['filesimkary']['type'];
                        $simsize = $_FILES['filesimkary']['size'];

                        if ($filesimnm !== $simname) {

                            if ($simname == "" || $simname == "Pilih file SIMPER/MINE PERMIT") {
                                echo json_encode(array("statusCode" => 202, "filesim" => "SIM Polisi wajib diupload."));
                                return;
                            }

                            if ($simtipe == "application\/pdf") {
                                echo json_encode(array("statusCode" => 202, "filesim" => "Format file yang diupload wajib dalam bentuk pdf."));
                                return;
                            }

                            if ($simsize > 100000) {
                                echo json_encode(array("statusCode" => 202, "filesim" => "File melebihi batas ukuran file maksimal. Batas ukuran file maksimal 100kb."));
                                return;
                            }

                            if ($filesimsv == "") {
                                $_FILES['filesimkary']['name'] = $url_sim;
                            } else {
                                $_FILES['filesimkary']['name'] = $filesimsv;
                            }

                            $extension = 'pdf';
                            $inputName = 'filesimkary';
                            $fileSize = 110;
                            $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $_FILES['filesimkary']['name']);
                        } else {
                            if ($filesimsv == "") {
                                $_FILES['filesimkary']['name'] = $url_sim;
                            } else {
                                $_FILES['filesimkary']['name'] = $filesimsv;
                            }
                        }

                        $smpname = $_FILES['filesmpkary']['name'];
                        $smptipe = $_FILES['filesmpkary']['type'];
                        $smpsize = $_FILES['filesmpkary']['size'];

                        // echo json_encode([$filesmpnm . " - " . $smpname]);
                        // return;

                        if ($filesmpnm !== $smpname) {
                            if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                                echo json_encode(array("statusCode" => 202, "filesmp" => "SIMPER/MINE PERMIT wajib diupload."));
                                return;
                            }

                            if ($smptipe == "application\/pdf") {
                                echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                                return;
                            }

                            if ($smpsize > 100000) {
                                echo json_encode(array("statusCode" => 202, "filesmp" => "File melebihi Batas ukuran file maksimal 100kb."));
                                return;
                            }

                            if ($filesmpsv == "") {
                                $_FILES['filesmpkary']['name'] = $url_izin;
                            } else {
                                $_FILES['filesmpkary']['name'] = $filesmpsv;
                            }

                            $extension = 'pdf';
                            $inputName = 'filesmpkary';
                            $fileSize = 110;
                            $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $_FILES['filesmpkary']['name']);
                        } else {
                            if ($filesmpsv == "") {
                                $_FILES['filesmpkary']['name'] = $url_izin;
                            } else {
                                $_FILES['filesmpkary']['name'] = $filesmpsv;
                            }
                        }

                        $parameterIDIzin = [
                            'field' => 'auth_izin_tambang',
                            'value' => $auth_izin,
                        ];
                        $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $tokenAuth);
                        if ($dataIzinTambang['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $newToken);
                        }
                        $id_izin = $dataIzinTambang['data'][0]['id_izin_tambang'];
                        $dtizin = array(
                            'id_izin_tambang' => $id_izin,
                            'jenisizin' => $jenisizin,
                            'noreg' => $noreg,
                            'tglexp' => $tglexp,
                            'id_sim_kary' => $id_sim_kary,
                        );
                        $updateIzin = $this->api_izt->update_permit($dtizin, $tokenAuth);
                        if ($updateIzin == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $updateIzin = $this->api_izt->update_permit($dtizin, $newToken);
                        }

                        // echo json_encode([$_FILES['filesmpkary']['name'] . " - " . $_FILES['filesimkary']['name']]);
                        // return;

                        $parameterSIM = [
                            'field' => 'auth_sim_kary',
                            'value' => $auth_simpol,
                        ];
                        $dataSIMKaryawan = $this->api_izt->spesifik_data_sim($parameterSIM, $tokenAuth);
                        if ($dataSIMKaryawan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataSIMKaryawan = $this->api_izt->spesifik_data_sim($parameterSIM, $newToken);
                        }
                        $id_sim_kary_last = $dataSIMKaryawan['data'][0]['id_sim_kary'];

                        $data_sim_polisi = [
                            'id_sim_kary' => $id_sim_kary_last,
                            'id_sim' => $jenissim,
                            'tgl_exp_sim' => $tglexpsim,
                        ];
                        $updateSIM = $this->api_izt->update_sim($data_sim_polisi, $tokenAuth);
                        if ($updateSIM == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $updateSIM = $this->api_izt->update_sim($data_sim_polisi, $newToken);
                        }

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data SIMPER berhasil diupdate",
                            "filesim" => $simname,
                            "filesimsv" => $_FILES['filesimkary']['name'],
                            "filesmp" => $smpname,
                            "filesmpsv" => $_FILES['filesmpkary']['name'],
                        ));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                    return;
                }
            } else if ($jenisizin == 1) {
                $id_sim_kary = 0;
                $tglexpsim = "1970-01-01";

                if ($auth_izin !== "") {
                    $parameterIDIzin = [
                        'field' => 'auth_izin_tambang',
                        'value' => $auth_izin,
                    ];
                    $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $tokenAuth);
                    if ($dataIzinTambang['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterIDIzin, $newToken);
                    }
                    $id_izin = $dataIzinTambang['data'][0]['id_izin_tambang'];

                    $parameterIzin = [
                        'field' => 'no_reg',
                        'value' => $noreg,
                        'field2' => 'id_izin_tambang <>',
                        'value2' => $id_izin,
                    ];
                    $dataIzin = $this->api_izt->spesifik_data_izin($parameterIzin, $tokenAuth);
                    if ($dataIzin['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataIzin = $this->api_izt->spesifik_data_izin($parameterIzin, $newToken);
                    }

                    if ($dataIzin['status'] == 200) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                        return;
                    }

                    $smpname = $_FILES['filesmpkary']['name'];
                    $smptipe = $_FILES['filesmpkary']['type'];
                    $smpsize = $_FILES['filesmpkary']['size'];

                    if ($filesmpnm != $smpname) {

                        if ($smpname == "") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                            return;
                        }

                        if ($smptipe == "application\/pdf") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                            return;
                        }

                        if ($smpsize > 100000) {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 100kb."));
                            return;
                        }

                        if ($filesmpsv == "") {
                            $_FILES['filesmpkary']['name'] = $url_izin;
                        } else {
                            $_FILES['filesmpkary']['name'] = $filesmpsv;
                        }

                        // echo json_encode([$smpname]);
                        // return;

                        $extension = 'pdf';
                        $inputName = 'filesmpkary';
                        $fileSize = 110;
                        $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $_FILES['filesmpkary']['name']);
                    } else {
                        if ($filesmpsv == "") {
                            $_FILES['filesmpkary']['name'] = $url_izin;
                        } else {
                            $_FILES['filesmpkary']['name'] = $filesmpsv;
                        }
                    }

                    $dtizin = array(
                        'id_izin_tambang' => $id_izin,
                        'jenisizin' => $jenisizin,
                        'noreg' => $noreg,
                        'tglexp' => $tglexp,
                        'id_sim_kary' => $id_sim_kary,
                        'nama_file' => $_FILES['filesmpkary']['name'],
                    );

                    $updateIzin = $this->api_izt->update_permit($dtizin, $tokenAuth);
                    if ($updateIzin == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $updateIzin = $this->api_izt->update_permit($dtizin, $newToken);
                    }
                    $linkizn = base_url() . 'Izin_tambang_api/checkFile/' . $auth_izin;

                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data Mine Permit berhasil diupdate",
                        "filesmp" => $smpname,
                        "filesmpsv" => $_FILES['filesmpkary']['name'],
                        "linkizin" => $linkizn,
                    ));
                    return;
                } else {
                    $parameterRegIzin = [
                        'field' => 'no_reg',
                        'value' => $noreg,
                    ];
                    $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterRegIzin, $tokenAuth);
                    if ($dataIzinTambang['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterRegIzin, $newToken);
                    }
                    if ($dataIzinTambang['status'] == 200) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                        return;
                    }

                    if ($auth_kary !== "") {
                        $smpname = $_FILES['filesmpkary']['name'];
                        $smptipe = $_FILES['filesmpkary']['type'];
                        $smpsize = $_FILES['filesmpkary']['size'];

                        if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                            return;
                        }

                        if ($smptipe == "application\/pdf") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                            return;
                        }

                        if ($smpsize > 100000) {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 100kb."));
                            return;
                        }

                        $_FILES['filesmpkary']['name'] = $url_izin;
                        $extension = 'pdf';
                        $inputName = 'filesmpkary';
                        $fileSize = 110;
                        $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $_FILES['filesmpkary']['name']);

                        $data_izin_tambang = [
                            'id_karyawan' => $id_karyawan,
                            'jenisizin' => $jenisizin,
                            'noreg' => $noreg,
                            'tglexp' => $tglexp,
                            'id_sim_kary' => $id_sim_kary,
                            'url_izin' => $url_izin,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];
                        $createIzin = $this->api_izt->create_permit($data_izin_tambang, $tokenAuth);
                        if ($createIzin == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createIzin = $this->api_izt->create_permit($data_izin_tambang, $newToken);
                        }

                        if ($createIzin == 201) {
                            $parameterLastIzin = [
                                'condition' => 'auth_karyawan',
                                'conditionValue' => $auth_kary,
                                'orderField' => 'id_izin_tambang',
                                'orderValue' => 'DESC',
                            ];
                            $lastDataIzin = $this->api_izt->lastest_data_izin($parameterLastIzin, $tokenAuth);
                            if ($lastDataIzin['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $lastDataIzin = $this->api_izt->lastest_data_izin($parameterLastIzin, $newToken);
                            }

                            if ($lastDataIzin['status'] == 200) {
                                $auth_izin = $lastDataIzin['data'][0]['auth_izin_tambang'];

                                $linkizn = base_url('Izin_tambang_api/checkFile/' . $auth_izin);

                                echo json_encode(array(
                                    "statusCode" => 200,
                                    "pesan" => "Data Mine Permit berhasil disimpan",
                                    "auth_izin" => $auth_izin,
                                    "filesmp" => $smpname,
                                    "filesmpsv" => $url_izin,
                                    "linkizin" => $linkizn,
                                ));
                            } else {
                                echo json_encode(array(
                                    "statusCode" => 201,
                                    "pesan" => "Error saat mengambil data Mine Permit",
                                ));
                            }
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data Mine Permit gagal disimpan"));
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
                    }
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Kode jenis izin tidak diketahui"));
                return;
            }
        }
    }

    public function create_new()
    {
        $this->form_validation->set_rules("jenisizin", "jenisizin", "required|trim", [
            'required' => 'Jenis Izin wajib dipilih',
        ]);
        $this->form_validation->set_rules("noreg", "noreg", "required|trim|max_length[50]", [
            'required' => 'No. Register wajib diisi',
            'max_length' => 'No. Register maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("tglexp", "tglexp", "required|trim", [
            'required' => 'Tanggal expired wajib diisi',
        ]);
        $this->form_validation->set_rules("jenissim", "jenissim", "trim");
        $this->form_validation->set_rules("tglexpsim", "tglexpsim", "trim");

        if ($this->form_validation->run() == false) {
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));

            if ($jenisizin == 2) {
                $filesim = htmlspecialchars($this->input->post("filesim", true));
                if ($jenissim == "") {
                    $errjenis = "<p>Jenis SIM wajib dipilih</p>";
                } else {
                    $errjenis = "";
                }

                if ($tglexpsim == "") {
                    $errtglsim = "<p>Tanggal expired SIM wajib diisi</p>";
                } else {
                    $errtglsim = "";
                }

                if ($filesim == "") {
                    $errsim = "<p>SIM Polisi wajib diupload</p>";
                } else {
                    $errsim = "";
                }
            } else {
                $errjenis = "";
                $errtglsim = "";
                $errsim = "";
            }

            if ($filesmp == "") {
                $errsmp = "<p>SIMPER / MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisizin' => form_error("jenisizin"),
                'noreg' => form_error("noreg"),
                'tglexp' => form_error("tglexp"),
                'jenissim' => $errjenis,
                'tglexpsim' => $errtglsim,
                'filesim' => $errsim,
                'filesmp' => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $tokenAuth = $this->session->userdata("token");
            $parameterKaryawan = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
            }
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $id_personal = $dataKaryawan['data'][0]['id_personal'];

            $url_izin = date('YmdHis') . '-SMP.pdf';
            $url_sim = date('YmdHis') . '-SIMPOL.pdf';
            $foldername = md5($id_personal);
            $tokenAuth = $this->session->userdata("token");

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($jenisizin == 2) {
                $parameterIDKaryawan = [
                    'field' => 'id_karyawan',
                    'value' => $id_karyawan,
                    'field2' => 'tgl_exp_sim >',
                    'value2' => date('Y-m-d'),
                ];
                $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $tokenAuth);
                if ($dataSIM['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataSIM = $this->api_izt->spesifik_data_sim_karyawan($parameterIDKaryawan, $newToken);
                }
                $id_sim_kary = $dataSIM['data'][0]['id_sim_kary'];
                if ($auth_izin == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                    return;
                } else {
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data SIMPER berhasil disimpan",
                    ));
                }
            } else if ($jenisizin == 1) {
                $id_sim_kary = 0;
                $tglexpsim = "1970-01-01";

                $parameterRegIzin = [
                    'field' => 'no_reg',
                    'value' => $noreg,
                ];
                $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterRegIzin, $tokenAuth);
                if ($dataIzinTambang['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataIzinTambang = $this->api_izt->spesifik_data_mine_permit($parameterRegIzin, $newToken);
                }
                if ($dataIzinTambang['status'] == 200) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                    return;
                }

                if ($auth_kary !== "") {
                    $smpname = $_FILES['filesmpkary']['name'];
                    $smptipe = $_FILES['filesmpkary']['type'];
                    $smpsize = $_FILES['filesmpkary']['size'];

                    if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                        echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                        return;
                    }

                    if ($smptipe == "application\/pdf") {
                        echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                        return;
                    }

                    if ($smpsize > 200000) {
                        echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 100kb."));
                        return;
                    }

                    $_FILES['filesmpkary']['name'] = $url_izin;
                    $extension = 'pdf';
                    $inputName = 'filesmpkary';
                    $fileSize = 110;
                    $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $_FILES['filesmpkary']['name']);

                    $data_izin_tambang = [
                        'id_karyawan' => $id_karyawan,
                        'jenisizin' => $jenisizin,
                        'noreg' => $noreg,
                        'tglexp' => $tglexp,
                        'id_sim_kary' => $id_sim_kary,
                        'url_izin' => $url_izin,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createIzin = $this->api_izt->create_permit($data_izin_tambang, $tokenAuth);
                    if ($createIzin == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createIzin = $this->api_izt->create_permit($data_izin_tambang, $newToken);
                    }

                    if ($createIzin == 201) {
                        $parameterLastIzin = [
                            'condition' => 'auth_karyawan',
                            'conditionValue' => $auth_kary,
                            'orderField' => 'id_izin_tambang',
                            'orderValue' => 'DESC',
                        ];
                        $lastDataIzin = $this->api_izt->lastest_data_izin($parameterLastIzin, $tokenAuth);
                        if ($lastDataIzin['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastDataIzin = $this->api_izt->lastest_data_izin($parameterLastIzin, $newToken);
                        }

                        if ($lastDataIzin['status'] == 200) {
                            $auth_izin = $lastDataIzin['data'][0]['auth_izin_tambang'];

                            $linkizn = base_url('Izin_tambang_api/checkFile/' . $auth_izin);

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data Mine Permit berhasil disimpan",
                                "auth_izin" => $auth_izin,
                                "filesmp" => $smpname,
                                "filesmpsv" => $url_izin,
                                "linkizin" => $linkizn,
                            ));
                        } else {
                            echo json_encode(array(
                                "statusCode" => 201,
                                "pesan" => "Error saat mengambil data Mine Permit",
                            ));
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data Mine Permit gagal disimpan"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Kode jenis izin tidak diketahui"));
            }
        }
    }

    public function check_jenisizin()
    {
        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
        $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
        $tokenAuth = $this->session->userdata("token");

        if ($auth_izin != "") {
            $parameter = [
                'field' => 'auth_izin_tambang',
                'value' => $auth_izin,
            ];
            $result = $this->api_izt->spesifik_data_izin($parameter, $tokenAuth);
            if ($result['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_izt->spesifik_data_izin($parameter, $newToken);
            }

            if ($result['status'] == 200) {
                $id_jenis = $result['data'][0]['id_jenis_izin_tambang'];
                if ($jenisizin != $id_jenis) {
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Yakin akan ganti jenis izin? semua data sebelumnya akan dihapus",
                        "auth_izn" => $jenisizin,
                        "jns" => $id_jenis,
                    ));
                    return;
                }
            }
        }
    }

    public function checkFile($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'field' => 'auth_izin_tambang',
            'value' => $auth,
        ];
        $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameter, $tokenAuth);
        if ($dataIzin['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameter, $newToken);
        }
        if ($dataIzin['status'] == 200) {
            $url_izin_tambang = $dataIzin['data'][0]['url_izin_tambang'];
            $id_m_perusahaan = $dataIzin['data'][0]['id_m_perusahaan'];
            $id_personal = $dataIzin['data'][0]['id_personal'];

            $foldername = md5($id_personal);

            $dataPDF = $this->ftp_file->readFilePDF(
                [
                    '/home/onedb_kary/karyawan/' . $foldername . '/' . $url_izin_tambang,
                    '/home/onedb_kary/simper/' . $id_m_perusahaan . '/' . $url_izin_tambang,
                ],
                $url_izin_tambang
            );
            if ($dataPDF == null) {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function checkFileSIM($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameterCheck = [
            'field' => 'auth_izin_tambang',
            'value' => $auth,
            'field2' => 'id_jenis_izin_tambang',
            'value2' => 2,
        ];
        $dataIzin = $this->api_izt->spesifik_data_izin($parameterCheck, $tokenAuth);
        if ($dataIzin['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataIzin = $this->api_izt->spesifik_data_izin($parameterCheck, $newToken);
        }

        if ($dataIzin['status'] != 200) {
            redirect('not_found');
        }
        $parameter = [
            'field' => 'id_sim_kary',
            'value' => $dataIzin['data'][0]['id_sim_kary'],
        ];
        $result = $this->api_izt->spesifik_data_sim($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_izt->spesifik_data_sim($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            $perusahaan = $dataIzin['data'][0]['id_m_perusahaan'];
            $url_file = $result['data'][0]['url_file'];
            $id_personal = $result['data'][0]['id_personal'];

            $foldername = md5($id_personal);

            $dataPDF = $this->ftp_file->readFilePDF(
                [
                    '/home/onedb_kary/karyawan/' . $foldername . '/' . $url_file,
                    '/home/onedb_kary/' . $perusahaan . '/' . $url_file,
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

    public function delete_unit()
    {
        $id_unit = htmlspecialchars($this->input->post("id_unit", true));
        $tokenAuth = $this->session->userdata("token");

        if ($id_unit != "") {
            $parameter = [
                'id_izin_tambang_unit' => $id_unit,
            ];
            $delete = $this->api_izt->delete_unit($parameter, $tokenAuth);
            if ($delete == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $delete = $this->api_izt->delete_unit($parameter, $newToken);
            }
            if ($delete == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Unit berhasil dihapus"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Unit gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data tidak ditemukan"));
        }
    }

    public function delete_all()
    {
        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
        $tokenAuth = $this->session->userdata("token");

        if ($auth_izin != "") {
            $parameter = [
                'field' => 'auth_izin_tambang',
                'value' => $auth_izin,
            ];
            $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameter, $tokenAuth);
            if ($dataIzin['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameter, $newToken);
            }
            $id_izin = $dataIzin['data'][0]['id_izin_tambang'];
            $id_personal = $dataIzin['data'][0]['id_personal'];
            $url_izin_tambang = $dataIzin['data'][0]['url_izin_tambang'];

            $parameterDelete = [
                'id_izin_tambang' => $id_izin,
            ];
            $deleteIzin = $this->api_izt->delete_permit($parameterDelete, $tokenAuth);
            if ($deleteIzin == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $deleteIzin = $this->api_izt->delete_permit($parameterDelete, $newToken);
            }
            if ($deleteIzin == 200) {
                $foldername = md5($id_personal);
                $this->ftp_file->deleteFile($foldername, $url_izin_tambang);
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Data izin berhasil dihapus",
                    "filesmp" => "Pilih file SIMPER/MINE PERMIT",
                    "filesim" => "Pilih file SIM Polisi",
                ));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "SIMPER, SIM Polisi dan Unit gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data tidak ditemukan"));
        }
    }

    public function tgl_exp_izin()
    {
        $tglsim = htmlspecialchars($this->input->post("tglsim", true));
        $now = date('Y-m-d');

        if ($tglsim < $now) {
            echo json_encode(array(
                "statusCode" => 201,
                'pesan' => 'Tanggal expired SIM tidak boleh sebelum hari ini',
            ));
            return;
        }

        if ($tglsim == $now) {
            echo json_encode(array(
                "statusCode" => 201,
                'pesan' => 'Tanggal expired SIM tidak boleh sama dengan hari ini',
            ));
            return;
        }

        $dsim = date('d', strtotime($tglsim));
        $msim = date('m', strtotime($tglsim));
        $ysim = date('Y', strtotime($tglsim));

        $ynow = date("Y");
        $mnow = date("m");
        $dnow = date("d");

        if ($ysim > $ynow) {
            $tglexpizin = (intval($ynow) + 1) . "-" . $msim . "-" . $dsim;
        } else {
            if ($msim > $mnow) {
                $tglexpizin = (intval($ynow)) . "-" . $msim . "-" . $dsim;
            } else if ((intval($msim) - intval($mnow)) == 0) {
                if ($dsim > $dnow) {
                    $tglexpizin = (intval($ynow)) . "-" . $msim . "-" . $dsim;
                } else {
                    echo json_encode(array(
                        "statusCode" => 201,
                        'pesan' => 'Tanggal expired SIM tidak boleh sama dengan hari ini',
                    ));
                    return;
                }
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                    'pesan' => 'Tanggal expired SIM tidak dapat dibuat',
                ));
                return;
            }
        }

        echo json_encode(array(
            "statusCode" => 200,
            'pesan' => 'Tanggal expired SIM berhasil dibuat',
            "tglexpizin" => $tglexpizin,
        ));
    }
}