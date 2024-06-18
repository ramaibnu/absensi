<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_api extends MY_Controller
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
        $this->load->view('karyawan/view', $dataMain);

        // Modal
        $this->load->view('components/modal/karyawan/view');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_karyawan()
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

        $this->load->view('components/sidebar_karyawan', $dataSidebar);

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
        $this->load->view('karyawan/add', $dataMain);

        // Modal
        $this->load->view('components/modal/karyawan/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan/add');

        // Footer
        $this->load->view('components/footer');
    }

    public function edit_karyawan($auth)
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
        $parameterKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
        }

        $parameterAlamat = [
            'field' => 'auth_karyawan',
            'value' => $auth,
            'field2' => 'stat_alamat_ktp',
            'value2' => 'T',
        ];
        $parameterDepartemen = [
            'field' => 'id_depart',
            'value' => $dataKaryawan['data'][0]['id_depart'],
        ];
        $parameterPosisi = [
            'field' => 'id_posisi',
            'value' => $dataKaryawan['data'][0]['id_posisi'],
        ];
        $parameterLevel = [
            'field' => 'id_level',
            'value' => $dataKaryawan['data'][0]['id_level'],
        ];
        $parameterPOH = [
            'field' => 'id_poh',
            'value' => $dataKaryawan['data'][0]['id_poh'],
        ];
        $parameterLokasiPenerimaan = [
            'field' => 'id_lokterima',
            'value' => $dataKaryawan['data'][0]['id_lokterima'],
        ];
        $parameterLokasiKerja = [
            'field' => 'id_lokker',
            'value' => $dataKaryawan['data'][0]['id_lokker'],
        ];
        $dataAlamat = $this->api_kry->read_data_alamat($parameterAlamat, $tokenAuth);
        if ($dataAlamat['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataAlamat = $this->api_kry->read_data_alamat($parameterAlamat, $newToken);
        }
        $dataKontrak = $this->api_kry->specific_kontrak_karyawan($parameterKaryawan, $tokenAuth);
        if ($dataKontrak['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKontrak = $this->api_kry->specific_kontrak_karyawan($parameterKaryawan, $newToken);
        }
        $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $tokenAuth);
        if ($dataDepartemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $newToken);
        }
        $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $tokenAuth);
        if ($dataPosisi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $newToken);
        }
        $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $tokenAuth);
        if ($dataLevel['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $newToken);
        }
        $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $tokenAuth);
        if ($dataPOH['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $newToken);
        }
        $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $tokenAuth);
        if ($dataLokasiPenerimaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $newToken);
        }
        $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $tokenAuth);
        if ($dataLokasiKerja['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $newToken);
        }

        $id_section = $dataKaryawan['data'][0]['id_section'];
        $id_grade = $dataKaryawan['data'][0]['id_grade'];
        $id_roster = $dataKaryawan['data'][0]['id_roster'];
        if ($id_section != 0) {
            $parameterSection = [
                'source' => 'vw_section',
                'field' => 'id_section',
                'value' => $id_section,
            ];
            $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterSection);
            if ($dataSection['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterSection);
            }
            $dataMain['data_section'] = $dataSection['data'][0];
        }
        if ($id_grade != 0) {
            $parameterGrade = [
                'source' => 'vw_grd',
                'field' => 'id_grade',
                'value' => $id_grade,
            ];
            $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterGrade);
            if ($dataGrade['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterGrade);
            }
            $dataMain['data_grade'] = $dataGrade['data'][0];
        }
        if ($id_roster != 0) {
            $parameterRoster = [
                'source' => 'vw_roster',
                'field' => 'id_roster',
                'value' => $id_roster,
            ];
            $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterRoster);
            if ($dataRoster['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterRoster);
            }
            $dataMain['data_roster'] = $dataRoster['data'][0];
        }

        $auth_personal = $dataKaryawan['data'][0]['auth_personal'];
        if (!empty($auth_personal)) {
            $parameterBank = [
                'source' => 'vw_bank_kary',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $dataBank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
            if ($dataBank['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataBank = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterBank);
            }
            $parameterEc = [
                'source' => 'vw_ec',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $dataEc = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            if ($dataEc['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataEc = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            }
            if ($dataBank['status'] == 200) {
                $dataMain['data_bank'] = $dataBank['data'][0];
            } else {
                $dataMain['data_bank'] = [];
            }
            if ($dataEc['status'] == 200) {
                $dataMain['data_ec'] = $dataEc['data'][0];
            } else {
                $dataMain['data_ec'] = [];
            }
        }

        $dataMain['data_karyawan'] = $dataKaryawan['data'][0];
        if ($dataAlamat['status'] != 200) {
            $dataMain['data_alamat'] = '';
        } else {
            $dataMain['data_alamat'] = $dataAlamat['data'][0];
        }
        $dataMain['data_kontrak'] = $dataKontrak['data'][0];
        $dataMain['data_departemen'] = $dataDepartemen['data'][0];
        $dataMain['data_posisi'] = $dataPosisi['data'][0];
        $dataMain['data_level'] = $dataLevel['data'][0];
        $dataMain['data_poh'] = $dataPOH['data'][0];
        $dataMain['data_lokterima'] = $dataLokasiPenerimaan['data'][0];
        $dataMain['data_lokker'] = $dataLokasiKerja['data'][0];
        $this->load->view('karyawan/edit', $dataMain);

        // Modal
        $this->load->view('components/modal/karyawan/edit');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan/edit');

        // Footer
        $this->load->view('components/footer');
    }

    public function detail_karyawan($auth)
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
            'field' => 'auth_karyawan',
            'value' => $auth,
        ];
        $parameterKaryawan = [
            'field' => 'auth_kary',
            'value' => $auth,
        ];
        $parameterAlamat = [
            'auth_karyawan' => $auth,
        ];
        $karyawan = $this->api_kry->read_specific_data($parameter, $tokenAuth);
        if ($karyawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $karyawan = $this->api_kry->read_specific_data($parameter, $newToken);
        }
        if ($karyawan['status'] == 200) {
            $dataKaryawan = $karyawan['data'][0];
            $auth_personal = $karyawan['data'][0]['auth_personal'];
            $id_personal = $karyawan['data'][0]['id_personal'];
            $id_pendidikan = $karyawan['data'][0]['id_pendidikan'];
            $paybase = $karyawan['data'][0]['paybase'];
            $status_pajak = $karyawan['data'][0]['statpajak'];
            $parameterPersonal = [
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
        } else {
            $dataKaryawan = [];
        }
        $alamat = $this->api_kry->read_detail_alamat($parameterAlamat, $tokenAuth);
        if (!$alamat) {
            $dataAlamat = [];
        } else {
            if ($alamat['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $alamat = $this->api_kry->read_detail_alamat($parameterAlamat, $newToken);
            }
            if ($alamat['status'] == 200) {
                $dataAlamat = $alamat['data'];
            } else {
                $dataAlamat = [];
            }
        }
        $izinTambang = $this->api_izt->spesifik_data_mine_permit($parameter, $tokenAuth);
        if ($izinTambang['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $izinTambang = $this->api_izt->spesifik_data_mine_permit($parameter, $newToken);
        }
        if ($izinTambang['status'] == 200) {
            $dataIzinTambang = $izinTambang['data'];
        } else {
            $dataIzinTambang = [];
        }
        if (!empty($id_personal)) {
            $sertifikasi = $this->api_srt->read_data_sertifikasi($parameterPersonal, $tokenAuth);
            if ($sertifikasi['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $sertifikasi = $this->api_srt->read_data_sertifikasi($parameterPersonal, $newToken);
            }
            if ($sertifikasi['status'] == 200) {
                $dataSertifikasi = $sertifikasi['data'];
            } else {
                $dataSertifikasi = [];
            }
            $mcu = $this->api_kry->specific_mcu($parameterPersonal, $tokenAuth);
            if ($mcu['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $mcu = $this->api_kry->specific_mcu($parameterPersonal, $newToken);
            }
            if ($mcu['status'] == 200) {
                $dataMCU = $mcu['data'];
            } else {
                $dataMCU = [];
            }
            $vaksin = $this->api_kry->specific_vaksin($parameterPersonal, $tokenAuth);
            if ($vaksin['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $vaksin = $this->api_kry->specific_vaksin($parameterPersonal, $newToken);
            }
            if ($vaksin['status'] == 200) {
                $dataVaksin = $vaksin['data'];
            } else {
                $dataVaksin = [];
            }
            $parameterKeluarga = [
                'source' => 'tb_keluarga',
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $keluarga = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterKeluarga);
            if ($keluarga['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $keluarga = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterKeluarga);
            }
            if ($keluarga['status'] == 200) {
                $dataKeluarga = $keluarga['data'][0];
            } else {
                $dataKeluarga = [];
            }
        } else {
            $dataSertifikasi = [];
            $dataMCU = [];
            $dataVaksin = [];
            $dataKeluarga = [];
        }
        $pelanggaran = $this->api_plg->read_specific_data($parameterKaryawan, $tokenAuth);
        if ($pelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $pelanggaran = $this->api_plg->read_specific_data($parameterKaryawan, $newToken);
        }
        if ($pelanggaran['status'] == 200) {
            $dataPelanggaran = $pelanggaran['data'];
        } else {
            $dataPelanggaran = [];
        }
        $kontrak = $this->api_kry->specific_kontrak_karyawan($parameter, $tokenAuth);
        if ($kontrak['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $kontrak = $this->api_kry->specific_kontrak_karyawan($parameter, $newToken);
        }
        if ($kontrak['status'] == 200) {
            $dataKontrak = $kontrak['data'];
        } else {
            $dataKontrak = [];
        }
        if (!empty($auth_personal)) {
            $parameterBank = [
                'source' => 'vw_bank_kary',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $bank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
            if ($bank['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $bank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
            }
            if ($bank['status'] == 200) {
                $dataBank = $bank['data'][0];
            } else {
                $dataBank = [];
            }
            $parameterEc = [
                'source' => 'vw_ec',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $emergency_contact = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            if ($emergency_contact['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $emergency_contact = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            }
            if ($emergency_contact['status'] == 200) {
                $dataEc = $emergency_contact['data'][0];
            } else {
                $dataEc = [];
            }
        } else {
            $dataBank = [];
            $dataEc = [];
        }
        if (!empty($id_pendidikan)) {
            $parameterPendidikan = [
                'source' => 'tb_pendidikan',
                'field' => 'id_pendidikan',
                'value' => $id_pendidikan,
            ];
            $pendidikan = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterPendidikan);
            if ($pendidikan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $pendidikan = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterPendidikan);
            }
            if ($pendidikan['status'] == 200) {
                $dataPendidikan = $pendidikan['data'][0];
            } else {
                $dataPendidikan = [];
            }
        } else {
            $dataPendidikan = [];
        }

        if (!empty($paybase) || $paybase != '0') {
            $parameterPaybase = [
                'source' => 'tb_paybase',
                'field' => 'id_paybase',
                'value' => $paybase,
                'field2' => 'stat_paybase',
                'value2' => 'T',
            ];
            $paybase = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterPaybase);
            if ($paybase['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $paybase = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameterPaybase);
            }
            if ($paybase['status'] == 200) {
                $dataPaybase = $paybase['data'][0];
            } else {
                $dataPaybase = [];
            }
        } else {
            $dataPaybase = [];
        }

        if (!empty($status_pajak) || $status_pajak != '0') {
            $parameterPajak = [
                'source' => 'tb_statpajak',
                'field' => 'id_statpajak',
                'value' => $status_pajak,
                'field2' => 'stat_aktif_pajak',
                'value2' => 'T',
            ];
            $status_pajak = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterPajak);
            if ($status_pajak['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $status_pajak = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameterPajak);
            }
            if ($status_pajak['status'] == 200) {
                $dataPajak = $status_pajak['data'][0];
            } else {
                $dataPajak = [];
            }
        } else {
            $dataPajak = [];
        }

        $dataMain["data_kary"] = $dataKaryawan;
        $dataMain["data_alamat"] = $dataAlamat;
        $dataMain["data_izin"] = $dataIzinTambang;
        $dataMain["data_sertifikasi"] = $dataSertifikasi;
        $dataMain["data_langgar"] = $dataPelanggaran;
        $dataMain["data_mcu"] = $dataMCU;
        $dataMain["data_vaksin"] = $dataVaksin;
        $dataMain["data_kontrak"] = $dataKontrak;
        $dataMain["data_bank"] = $dataBank;
        $dataMain["data_ec"] = $dataEc;
        $dataMain["data_pendidikan"] = $dataPendidikan;
        $dataMain["data_paybase"] = $dataPaybase;
        $dataMain["data_pajak"] = $dataPajak;
        $dataMain["data_keluarga"] = $dataKeluarga;
        $this->load->view('karyawan/detail', $dataMain);

        // Modal
        $this->load->view('components/modal/karyawan/detail');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan/detail');

        // Footer
        $this->load->view('components/footer');
    }

    public function izin_tambang()
    {
        $auth_izin = htmlspecialchars($this->input->get('auth_izin', true));
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_izin_tambang',
            'value' => $auth_izin,
        ];
        $result = $this->api_izt->read_data_simper_unit($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_izt->read_data_simper_unit($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            $data['unit_izin'] = $result['data'];
        } else {
            $data['unit_izin'] = [];
        }
        $this->load->view('karyawan/izin_tambang', $data);
    }

    public function sertifikasi()
    {
        $auth_person = $this->input->get('auth_person');
        $tokenAuth = $this->session->userdata('token');
        $parameterID = [
            'field' => 'auth_personal',
            'value' => $auth_person,
        ];
        $dataPersonal = $this->api_kry->read_specific_data($parameterID, $tokenAuth);
        if ($dataPersonal['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPersonal = $this->api_kry->read_specific_data($parameterID, $newToken);
        }
        if ($dataPersonal['status'] == 404) {
            $data['sert'] = [];
            $this->load->view('karyawan/sertifikasi', $data);
            return;
        }
        $id_personal = $dataPersonal['data'][0]['id_personal'];

        $parameter = [
            'field' => 'id_personal',
            'value' => $id_personal,
        ];
        $result = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            $data['sert'] = $result['data'];
        } else {
            $data['sert'] = [];
        }
        $this->load->view('karyawan/sertifikasi', $data);
    }

    public function sertifikasi_update()
    {
        $auth_person = $this->input->get('auth_person');
        $tokenAuth = $this->session->userdata('token');
        $parameterID = [
            'field' => 'auth_personal',
            'value' => $auth_person,
        ];
        $dataPersonal = $this->api_kry->read_specific_data($parameterID, $tokenAuth);
        if ($dataPersonal['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPersonal = $this->api_kry->read_specific_data($parameterID, $newToken);
        }
        if ($dataPersonal['status'] == 404) {
            $data['sert'] = [];
            $this->load->view('karyawan/sertifikasi', $data);
            return;
        }
        $id_personal = $dataPersonal['data'][0]['id_personal'];

        $parameter = [
            'field' => 'id_personal',
            'value' => $id_personal,
        ];
        $result = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            $data['sert'] = $result['data'];
        } else {
            $data['sert'] = [];
        }
        $this->load->view('karyawan/sertifikasi_edit', $data);
    }

    public function kontrak()
    {
        $auth_karyawan = $this->input->get('auth_karyawan');
        $tokenAuth = $this->session->userdata('token');
        $parameterKontrakKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_karyawan,
        ];
        $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $tokenAuth);
        if ($dataKontrakKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $newToken);
        }
        if ($dataKontrakKaryawan['status'] == 200) {
            $data['kontrak'] = $dataKontrakKaryawan['data'];
        } else {
            $data['kontrak'] = '';
        }
        $this->load->view('karyawan/kontrak', $data);
    }

    public function vaksin()
    {
        $auth_person = $this->input->get('auth_person');
        $tokenAuth = $this->session->userdata('token');
        $parameterID = [
            'field' => 'auth_personal',
            'value' => $auth_person,
        ];
        $dataPersonal = $this->api_kry->read_specific_data($parameterID, $tokenAuth);
        if ($dataPersonal['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPersonal = $this->api_kry->read_specific_data($parameterID, $newToken);
        }
        if ($dataPersonal['status'] == 404) {
            $data['vaks'] = [];
            $this->load->view('karyawan/vaksin', $data);
            return;
        }
        $id_personal = $dataPersonal['data'][0]['id_personal'];

        $parameter = [
            'field' => 'id_personal',
            'value' => $id_personal,
        ];
        $result = $this->api_vks->read_data_vaksin($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_vks->read_data_vaksin($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            $data['vaks'] = $result['data'];
        } else {
            $data['vaks'] = [];
        }
        $this->load->view('karyawan/vaksin', $data);
    }

    public function hapus_vaksin()
    {
        $auth_vaksin = htmlspecialchars(trim($this->input->post('auth_vaksin', true)));

        $query = $this->kry->hapus_vaksin($auth_vaksin);

        if ($query == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil dihapus"));
            return;
        } else if ($query == 201) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data vaksin tidak ditemukan"));
            return;
        }
    }

    public function fileSertifikasi($auth_sertifikat)
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_sertifikat',
            'value' => $auth_sertifikat,
        ];
        $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($dataSertifikasi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        if ($dataSertifikasi['status'] == 200) {
            $file_sertifikasi = $dataSertifikasi['data'][0]['file_sertifikasi'];
            $id_personal = $dataSertifikasi['data'][0]['id_personal'];
            $parameterPerusahaan = [
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $dataPerusahaan = $this->api_kry->read_specific_data($parameterPerusahaan, $tokenAuth);
            if ($dataPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPerusahaan = $this->api_kry->read_specific_data($parameterPerusahaan, $newToken);
            }
            $foldername = md5($id_personal);
            if ($dataPerusahaan['status'] == 200) {
                $id_m_perusahaan = $dataPerusahaan['data'][0]['id_m_perusahaan'];
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/karyawan/' . $foldername . '/' . $file_sertifikasi,
                        '/home/onedb_kary/sertifikasi/' . $id_m_perusahaan . '/' . $file_sertifikasi,
                    ],
                    $file_sertifikasi
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function data_mcu()
    {
        $auth_person = htmlspecialchars($this->input->get('auth_person', true));
        $tokenAuth = $this->session->userdata('token');

        $parameterMCU = [
            'field' => 'auth_personal',
            'value' => $auth_person,
        ];
        $dataMCU = $this->api_kry->specific_mcu($parameterMCU, $tokenAuth);
        if ($dataMCU['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataMCU = $this->api_kry->specific_mcu($parameterMCU, $newToken);
        }

        if ($dataMCU['status'] == 200) {
            $data['data_mcu'] = $dataMCU['data'];
        } else {
            $data['data_mcu'] = '';
        }
        $this->load->view('karyawan/mcu_edit', $data);
    }

    public function mcu($auth_mcu)
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_mcu',
            'value' => $auth_mcu,
        ];
        $dataMCU = $this->api_kry->specific_mcu($parameter, $tokenAuth);
        if ($dataMCU['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataMCU = $this->api_kry->specific_mcu($parameter, $newToken);
        }
        if ($dataMCU['status'] == 200) {
            $url_file = $dataMCU['data'][0]['url_file'];
            $id_personal = $dataMCU['data'][0]['id_personal'];
            $id_m_perusahaan = $dataMCU['data'][0]['id_m_perusahaan'];
            $foldername = md5($id_personal);
            $dataPDF = $this->ftp_file->readFilePDF(
                [
                    '/home/onedb_kary/karyawan/' . $foldername . '/' . $url_file,
                    '/home/onedb_kary/mcu/' . $id_m_perusahaan . '/' . $url_file,
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

    public function support($auth)
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_karyawan',
            'value' => $auth,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameter, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameter, $newToken);
        }
        if ($dataKaryawan['status'] == 200) {
            $id_personal = $dataKaryawan['data'][0]['id_personal'];
            $id_m_perusahaan = $dataKaryawan['data'][0]['id_m_perusahaan'];
            $parameterPersonal = [
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $dataPersonal = $this->api_psn->read_specific_data($parameterPersonal, $tokenAuth);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->api_psn->read_specific_data($parameterPersonal, $newToken);
            }
            if ($dataPersonal['status'] == 200) {
                $url_pendukung = $dataPersonal['data'][0]['url_pendukung'];
                $foldername = md5($id_personal);

                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/karyawan/' . $foldername . '/' . $url_pendukung,
                        '/home/onedb_kary/pendukung/' . $id_m_perusahaan . '/' . $url_pendukung,
                    ],
                    $url_pendukung
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
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
        $karyawan = $this->input->post("ck");
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'auth_per' => $auth_per,
            'karyawan' => $karyawan,
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_kry->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_kry->datatables($data, $newToken);
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

    public function detailKodePerusahaan()
    {
        $prs = htmlspecialchars($this->input->post("prs", true));
        $tokenAuth = $this->session->userdata("token");
        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $prs,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if (!empty($dataPerusahaan['data'])) {
            $id_m_per = $dataPerusahaan['data'][0]['id_m_perusahaan'];
        } else {
            $id_m_per = 0;
        }

        $parameter = [
            'id' => $id_m_per,
        ];
        $result = $this->api_str->struktur_perusahaan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->struktur_perusahaan($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            echo $result['data'];
        } else {
            echo '';
        }
    }

    public function upload_foto_karyawan()
    {
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        if (empty($auth_kary)) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            return;
        }
        $tokenAuth = $this->session->userdata("token");
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }
        $foldername = md5($dataKaryawan['data'][0]['id_personal']);
        $nama_file = $dataKaryawan['data'][0]['url_foto'];
        if (empty($nama_file)) {
            $now = date('YmdHis');
            $nama_file = $now . "-FOTO.jpg";
        }

        $extension = 'jpg|jpeg';
        $inputName = 'file_foto';
        $fileSize = 110;
        $uploadFoto = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
        if ($uploadFoto == 200) {
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $dt_personal = array(
                'id_karyawan' => $id_karyawan,
                'url_foto' => $nama_file,
            );
            $update = $this->api_kry->update_foto($dt_personal, $tokenAuth);
            if ($update == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $update = $this->api_kry->update_foto($dt_personal, $newToken);
            }
            if ($update == 200) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Foto Karyawan berhasil diupload",
                ));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload foto karyawan"));
            }
        } elseif ($uploadFoto == 400) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload foto karyawan"));
        } elseif ($uploadFoto == 404 || $uploadFoto == 401 || $uploadFoto == 403) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator" . $uploadFoto));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload foto karyawan"));
        }
    }

    public function foto_karyawan($auth)
    {
        $tokenAuth = $this->session->userdata('token');
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }
        if ($dataKaryawan['status'] == 200) {
            $perusahaan = $dataKaryawan['data'][0]['id_m_perusahaan'];
            $fileName = $dataKaryawan['data'][0]['url_foto'];
            $id_personal = $dataKaryawan['data'][0]['id_personal'];
            $folderName = md5($id_personal);
            $dataImage = $this->ftp_file->showImage(
                [
                    '/home/onedb_kary/karyawan/' . $folderName . '/' . $fileName,
                    '/home/onedb_kary/foto/' . $perusahaan . '/' . $fileName,
                ],
            );
            if ($dataImage == null) {
                echo file_get_contents(base_url('berkas/pasphoto/pasphoto.jpg'));
            } else {
                echo $dataImage;
            }
        } else {
            echo file_get_contents(base_url('berkas/pasphoto/pasphoto.jpg'));
        }
    }

    public function upload_file_pendukung()
    {
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $tokenAuth = $this->session->userdata('token');
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }
        $id_personal = $dataKaryawan['data'][0]['id_personal'];
        $foldername = md5($id_personal);
        if ($auth_kary == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            return;
        }
        $nama_file = $dataKaryawan['data'][0]['url_pendukung'];
        if ($nama_file == "") {
            $now = date('YmdHis');
            $nama_file = $now . "-SUPPORT.pdf";
        }

        $extension = 'pdf';
        $inputName = 'fl_pendukung';
        $fileSize = 1010;
        $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
        if ($uploadFile == 200) {
            $dt_personal = array(
                'id_personal' => $id_personal,
                'url_pendukung' => $nama_file,
            );
            $updateFilePendukung = $this->api_psn->update_file_pendukung($dt_personal, $tokenAuth);
            if ($updateFilePendukung == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $updateFilePendukung = $this->api_psn->update_file_pendukung($dt_personal, $newToken);
            }
            if ($updateFilePendukung == 200) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "File pendukung berhasil diupload",
                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 202,
                    "pesan" => "File pendukung gagal diupload",
                ));
            }
        } elseif ($uploadFile == 400) {
            echo json_encode(array("statusCode" => 201, "pesan" => "File pendukung gagal diupload"));
        } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "File pendukung gagal diupload"));
        }
    }

    public function create_data_personal()
    {
        $this->form_validation->set_rules("noktp", "noktp", "required|trim|numeric|max_length[16]|min_length[16]", [
            'required' => 'No. KTP wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. KTP maksimal 16 karakter',
            'min_length' => 'No. KTP minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("nama", "nama", "required|trim", [
            'required' => 'Nama wajib dipilih',
        ]);
        $this->form_validation->set_rules("alamat", "alamat", "required|trim|max_length[1000]", [
            'required' => 'Alamat wajib diisi',
            'max_length' => 'Alamat maksimal 1000 karakter',
        ]);
        $this->form_validation->set_rules("rt", "rt", "trim|max_length[3]", [
            'max_length' => 'No. RT maksimal 3 karakter',
        ]);
        $this->form_validation->set_rules("rw", "rw", "trim|max_length[3]", [
            'max_length' => 'No. RW maksimal 3 karakter',
        ]);
        $this->form_validation->set_rules("id_prov", "id_prov", "required|trim", [
            'required' => 'Provinsi wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_kab", "id_kab", "required|trim", [
            'required' => 'Kabupaten wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_kec", "id_kec", "required|trim", [
            'required' => 'Kecamatan wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_kel", "id_kel", "required|trim", [
            'required' => 'Kelurahan wajib dipilih',
        ]);
        $this->form_validation->set_rules("tmp_lahir", "tmp_lahir", "required|trim|max_length[100]", [
            'required' => 'Tempat lahir wajib diisi',
            'max_length' => 'Tempat Lahir maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("tgl_lahir", "tgl_lahir", "required|trim", [
            'required' => 'Tanggal lahir wajib diisi',
        ]);
        $this->form_validation->set_rules("stat_nikah", "stat_nikah", "required|trim", [
            'required' => 'Status pernikahan wajib diisi',
        ]);
        $this->form_validation->set_rules("id_agama", "id_agama", "required|trim", [
            'required' => 'Agama wajib dipilih',
        ]);
        $this->form_validation->set_rules("warga", "warga", "required|trim", [
            'required' => 'Warga negara wajib diisi',
        ]);
        $this->form_validation->set_rules("jk", "jk", "required|trim", [
            'required' => 'Jenis kelamin wajib dipilih',
        ]);
        $this->form_validation->set_rules("bpjs_tk", "bpjs_tk", "trim");
        $this->form_validation->set_rules("bpjs_kes", "bpjs_kes", "trim");
        $this->form_validation->set_rules("no_equity", "no_equity", "trim");
        $this->form_validation->set_rules("npwp", "npwp", "trim");
        $this->form_validation->set_rules("email", "email", "trim|valid_email", [
            'valid_email' => 'Format email anda salah',
        ]);
        $this->form_validation->set_rules("notelp", "notelp", "trim|numeric", [
            'numeric' => 'No. Telp. wajib diisi dengan angka',
        ]);
        $this->form_validation->set_rules("nokk", "nokk", "required|trim|max_length[16]|min_length[16]", [
            'required' => 'No. Kartu Keluarga wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. Kartu Keluarga maksimal 16 karakter',
            'min_length' => 'No. Kartu Keluarga minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("pddakhir", "pddakhir", "required|trim", [
            'required' => 'Pendidikan Terakhir wajib diisi',
        ]);
        $this->form_validation->set_rules("sekolah", "sekolah", "trim|max_length[100]", [
            'max_length' => 'Sekolah maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("fakultas", "fakultas", "trim|max_length[100]", [
            'max_length' => 'Fakultas maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("jurusan", "jurusan", "trim|max_length[100]", [
            'max_length' => 'Jurusan maksimal 100 karakter',
        ]);

        if ($this->form_validation->run() == false) {
            $npwp = htmlspecialchars($this->input->post("npwp", true));
            $npwp_num = str_replace([".", "-", "_"], "", $npwp);
            $jml_npwp = strlen($npwp_num);
            if ($npwp != "") {
                if ($jml_npwp < 15) {
                    $errnpwp = "<p>NPWP tidak boleh kurang dari 15 karakter</p>";
                } else {
                    $errnpwp = "";
                }
            } else {
                $errnpwp = "";
            }

            $error = [
                'statusCode' => 202,
                'pesan' => 'Tidak dapat melanjutkan, lengkapi data personal.',
                'noktp' => form_error("noktp"),
                'nama' => form_error("nama"),
                'alamat' => form_error("alamat"),
                'rt' => form_error("rt"),
                'rw' => form_error("rw"),
                'id_prov' => form_error("id_prov"),
                'id_kab' => form_error("id_kab"),
                'id_kec' => form_error("id_kec"),
                'id_kel' => form_error("id_kel"),
                'tmp_lahir' => form_error("tmp_lahir"),
                'tgl_lahir' => form_error("tgl_lahir"),
                'stat_nikah' => form_error("stat_nikah"),
                'id_agama' => form_error("id_agama"),
                'warga' => form_error("warga"),
                'jk' => form_error("jk"),
                'bpjs_tk' => form_error("bpjs_tk"),
                'bpjs_kes' => form_error("bpjs_kes"),
                'no_equity' => form_error("no_equity"),
                'email' => form_error("email"),
                'notelp' => form_error("notelp"),
                'nokk' => form_error("nokk"),
                'pddakhir' => form_error("pddakhir"),
                'sekolah' => form_error("sekolah"),
                'fakultas' => form_error("fakultas"),
                'jurusan' => form_error("jurusan"),
                'npwp' => $errnpwp,
            ];

            echo json_encode($error);
            return;
        } else {
            $noktp = htmlspecialchars($this->input->post("noktp", true));
            $nokk = htmlspecialchars($this->input->post("nokk", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_check = htmlspecialchars($this->input->post("auth_check", true));
            $noktp_old = htmlspecialchars($this->input->post("noktp_old", true));
            $nokk_old = htmlspecialchars($this->input->post("nokk_old", true));
            $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
            $ynow = date("Y");
            $ylahir = date("Y", strtotime($tgl_lahir));
            $usia = intval($ynow) - intval($ylahir);
            $tokenAuth = $this->session->userdata("token");

            if ($usia <= 15) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Usia kurang dari 15 tahun, isi tanggal lahir anda dengan benar"));
                return;
            }

            if ($usia >= 75) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Isi tanggal lahir anda dengan benar"));
                return;
            }

            if ($auth_person !== "") {
                if ($auth_check == "") {
                    $no_ktp = $noktp_old;
                    $no_kk = $nokk_old;

                    if ($no_ktp != $noktp) {
                        $parameterNOKTP = [
                            'field' => 'no_ktp',
                            'value' => $noktp,
                        ];
                        $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $tokenAuth);
                        if ($checkNOKTP['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $newToken);
                        }
                        if ($checkNOKTP['status'] == 200) {
                            echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                            return;
                        }
                    }

                    // if ($no_kk != $nokk) {
                    //      $query = $this->kry->cek_noKK($nokk);
                    //      if ($query) {
                    //           echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                    //           return;
                    //      }
                    // }
                }
            } else {
                $parameterNOKTP = [
                    'field' => 'no_ktp',
                    'value' => $noktp,
                ];
                $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $tokenAuth);
                if ($checkNOKTP['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $newToken);
                }
                if ($checkNOKTP['status'] == 200) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                }

                // $query = $this->kry->cek_noKK($nokk);
                // if ($query) {
                //      echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                //      return;
                // }
            }

            echo json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
        }
    }

    public function update_data_personal()
    {
        // Data Personal
        $id_personal = htmlspecialchars($this->input->post("id_personal", true));
        $no_ktp_old = htmlspecialchars($this->input->post("no_ktp_old", true));
        $no_ktp = htmlspecialchars($this->input->post("no_ktp", true));
        $no_kk = htmlspecialchars($this->input->post("no_kk", true));
        $nama_lengkap = htmlspecialchars($this->input->post("nama_lengkap", true));
        $jk = htmlspecialchars($this->input->post("jk", true));
        $tmp_lahir = htmlspecialchars($this->input->post("tmp_lahir", true));
        $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
        $id_stat_nikah = htmlspecialchars($this->input->post("id_stat_nikah", true));
        $id_agama = htmlspecialchars($this->input->post("id_agama", true));
        $warga_negara = htmlspecialchars($this->input->post("warga_negara", true));
        $email_pribadi = htmlspecialchars($this->input->post("email_pribadi", true));
        $hp_1 = htmlspecialchars($this->input->post("no_hp", true));
        $no_bpjstk = htmlspecialchars($this->input->post("no_bpjstk", true));
        $no_bpjskes = htmlspecialchars($this->input->post("no_bpjskes", true));
        $no_npwp = htmlspecialchars($this->input->post("no_npwp", true));
        $id_pendidikan = htmlspecialchars($this->input->post("id_pendidikan", true));
        $sekolah = htmlspecialchars($this->input->post("sekolah", true));
        $fakultas = htmlspecialchars($this->input->post("fakultas", true));
        $jurusan = htmlspecialchars($this->input->post("jurusan", true));
        // Data Alamat
        $id_alamat_ktp = htmlspecialchars($this->input->post("id_alamat_ktp", true));
        $alamat_ktp = htmlspecialchars($this->input->post("alamat_ktp", true));
        $rt_ktp = htmlspecialchars($this->input->post("rt_ktp", true));
        $rw_ktp = htmlspecialchars($this->input->post("rw_ktp", true));
        $prov_ktp = htmlspecialchars($this->input->post("prov_ktp", true));
        $kab_ktp = htmlspecialchars($this->input->post("kab_ktp", true));
        $kec_ktp = htmlspecialchars($this->input->post("kec_ktp", true));
        $kel_ktp = htmlspecialchars($this->input->post("kel_ktp", true));

        $tokenAuth = $this->session->userdata("token");
        if ($no_ktp != $no_ktp_old) {
            $parameterNOKTP = [
                'field' => 'no_ktp',
                'value' => $no_ktp,
            ];
            $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $tokenAuth);
            if ($checkNOKTP['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $newToken);
            }
            if ($checkNOKTP['status'] == 200) {
                echo json_encode(array("statusCode" => 400, "pesan" => "No. KTP sudah digunakan"));
                return;
            } else if ($checkNOKTP['status'] != 404) {
                echo json_encode(array("statusCode" => 500, "pesan" => "Server Error, hubungi administrator"));
                return;
            }
        }

        $data_personal = array(
            'id_personal' => $id_personal,
            'no_ktp' => $no_ktp,
            'no_kk' => $no_kk,
            'nama_lengkap' => $nama_lengkap,
            'jk' => $jk,
            'tmp_lahir' => $tmp_lahir,
            'tgl_lahir' => $tgl_lahir,
            'id_stat_nikah' => $id_stat_nikah,
            'id_agama' => $id_agama,
            'warga_negara' => $warga_negara,
            'email_pribadi' => $email_pribadi,
            'hp_1' => $hp_1,
            'no_bpjstk' => $no_bpjstk,
            'no_bpjskes' => $no_bpjskes,
            'no_npwp' => $no_npwp,
            'id_pendidikan' => $id_pendidikan,
            'sekolah' => $sekolah,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan,
        );

        $data_alamat_ktp = array(
            'id_alamat_ktp' => $id_alamat_ktp,
            'alamat_ktp' => $alamat_ktp,
            'rt_ktp' => $rt_ktp,
            'rw_ktp' => $rw_ktp,
            'kel_ktp' => $kel_ktp,
            'kec_ktp' => $kec_ktp,
            'kab_ktp' => $kab_ktp,
            'prov_ktp' => $prov_ktp,
        );

        $updatePersonal = $this->api_psn->update($data_personal, $tokenAuth);
        if ($updatePersonal == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $updatePersonal = $this->api_psn->update($data_personal, $newToken);
        }
        if ($updatePersonal != 200) {
            echo json_encode(array("statusCode" => 400, "pesan" => "Terjadi kesalahan saat menyimpan data personal."));
            return;
        }
        $updateAlamat = $this->api_kry->update_alamat($data_alamat_ktp, $tokenAuth);
        if ($updateAlamat == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $updateAlamat = $this->api_kry->update_alamat($data_alamat_ktp, $newToken);
        }
        if ($updateAlamat != 200) {
            echo json_encode(array("statusCode" => 400, "pesan" => "Terjadi kesalahan saat menyimpan data alamat."));
            return;
        }
        if ($updatePersonal == 200 && $updateAlamat == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data personal berhasil diperbarui."));
        } else {
            echo json_encode(array("statusCode" => 400, "pesan" => "Data personal gagal diperbarui."));
        }
    }

    public function update_data_tambahan()
    {
        $auth_person = htmlspecialchars(trim($this->input->post("auth_person", true)));
        $tokenAuth = $this->session->userdata("token");
        if (!empty($auth_person)) {
            $parameterPersonal = [
                'source' => 'vw_personal',
                'field' => 'auth_personal',
                'value' => $auth_person,
            ];
            $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterPersonal);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterPersonal);
            }
            if ($dataPersonal['status'] == 200) {
                $id_personal = $dataPersonal['data'][0]['id_personal'];
            } else {
                echo json_encode(array("statusCode" => 404, "pesan" => "Data Karyawan tidak ditemukan"));
                return;
            }
        } else {
            $id_personal = htmlspecialchars(trim($this->input->post("id_personal", true)));
        }
        if (empty($id_personal)) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Data Karyawan tidak ditemukan"));
            return;
        }
        $parameterCheckBank = [
            'source' => 'vw_bank_kary',
            'field' => 'id_personal',
            'value' => $id_personal,
        ];
        $parameterCheckEc = [
            'source' => 'vw_ec',
            'field' => 'id_personal',
            'value' => $id_personal,
        ];
        $checkBank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterCheckBank);
        if ($checkBank['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkBank = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterCheckBank);
        }
        $checkEc = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterCheckEc);
        if ($checkEc['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkEc = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterCheckEc);
        }

        if ($checkBank['status'] != 200 || $checkEc['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Data Karyawan tidak ditemukan!"));
            return;
        }

        // Data Orang Tua
        $namaIbu = htmlspecialchars(trim($this->input->post("namaIbu", true)));
        $statusIbu = htmlspecialchars(trim($this->input->post("statusIbu", true)));
        $namaAyah = htmlspecialchars(trim($this->input->post("namaAyah", true)));
        $statusAyah = htmlspecialchars(trim($this->input->post("statusAyah", true)));
        $endpointUpdate = 'edit_data_orang_tua';

        // Data Bank
        $bank = htmlspecialchars(trim($this->input->post("bank", true)));
        $rekening = htmlspecialchars(trim($this->input->post("rekening", true)));
        $pemilik = htmlspecialchars(trim($this->input->post("pemilik", true)));
        $keterangan = htmlspecialchars(trim($this->input->post("keterangan", true)));
        $endpointCreateBank = 'tambah_data_bank_personal';
        $endpointUpdateBank = 'edit_data_bank_personal';

        $parameterOptionBank = [
            'source' => 'vw_bank',
            'field' => 'auth_bank',
            'value' => $bank,
        ];
        $optionBank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterOptionBank);
        if ($optionBank['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $optionBank = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterOptionBank);
        }

        // Data Emergency Contact
        $nama = htmlspecialchars(trim($this->input->post("nama", true)));
        $relasi = htmlspecialchars(trim($this->input->post("relasi", true)));
        $hp = htmlspecialchars(trim($this->input->post("hp", true)));
        $hp2 = htmlspecialchars(trim($this->input->post("hp2", true)));
        $keteranganEc = htmlspecialchars(trim($this->input->post("keteranganEc", true)));
        $endpointCreateEc = 'tambah_data_emergency_contact';
        $endpointUpdateEc = 'edit_data_emergency_contact';

        $parameterUpdate = [
            'id_personal' => $id_personal,
            'nama_ibu' => $namaIbu,
            'status_ibu' => $statusIbu,
            'nama_ayah' => $namaAyah,
            'status_ayah' => $statusAyah,
        ];

        $update = $this->std->api($endpointUpdate, $this->putMethod(), $tokenAuth, $parameterUpdate);
        if ($update == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $update = $this->std->api($endpointUpdate, $this->putMethod(), $newToken, $parameterUpdate);
        }
        if ($update != 200) {
            echo json_encode(array("statusCode" => 400, "pesan" => "Data Orang Tua gagal diupdate!"));
            return;
        }

        if (empty($checkBank['data'][0]['id_bank_kary'])) {
            $parameterCreateBank = [
                'id_personal' => $id_personal,
                'id_bank' => $optionBank['data'][0]['id_bank'],
                'rekening' => $rekening,
                'nama' => $pemilik,
                'keterangan' => $keterangan,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $createBank = $this->std->api($endpointCreateBank, $this->postMethod(), $tokenAuth, $parameterCreateBank);
            if ($createBank == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $createBank = $this->std->api($endpointCreateBank, $this->postMethod(), $newToken, $parameterCreateBank);
            }
            if ($createBank != 201) {
                echo json_encode(array("statusCode" => 400, "pesan" => "Data Bank gagal diupdate!"));
                return;
            }
        } else {
            $parameterUpdateBank = [
                'id' => $checkBank['data'][0]['id_bank_kary'],
                'id_bank' => $optionBank['data'][0]['id_bank'],
                'rekening' => $rekening,
                'nama' => $pemilik,
                'keterangan' => $keterangan,
            ];

            $updateBank = $this->std->api($endpointUpdateBank, $this->putMethod(), $tokenAuth, $parameterUpdateBank);
            if ($updateBank == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $updateBank = $this->std->api($endpointUpdateBank, $this->putMethod(), $newToken, $parameterUpdateBank);
            }
            if ($updateBank != 200) {
                echo json_encode(array("statusCode" => 400, "pesan" => "Data Bank gagal diupdate!"));
                return;
            }
        }

        if (empty($checkEc['data'][0]['id_ec'])) {
            $parameterCreateEc = [
                'id_personal' => $id_personal,
                'nama' => $nama,
                'hp' => $hp,
                'hp2' => $hp2,
                'relasi' => $relasi,
                'keterangan' => $keteranganEc,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $createEc = $this->std->api($endpointCreateEc, $this->postMethod(), $tokenAuth, $parameterCreateEc);
            if ($createEc == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $createEc = $this->std->api($endpointCreateEc, $this->postMethod(), $newToken, $parameterCreateEc);
            }
            if ($createEc != 201) {
                echo json_encode(array("statusCode" => 400, "pesan" => "Data Emergency Contact gagal diupdate!"));
                return;
            }
        } else {
            $parameterUpdateEc = [
                'id' => $checkEc['data'][0]['id_ec'],
                'nama' => $nama,
                'hp' => $hp,
                'hp2' => $hp2,
                'relasi' => $relasi,
                'keterangan' => $keteranganEc,
            ];

            $updateEc = $this->std->api($endpointUpdateEc, $this->putMethod(), $tokenAuth, $parameterUpdateEc);
            if ($updateEc == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $updateEc = $this->std->api($endpointUpdateEc, $this->putMethod(), $newToken, $parameterUpdateEc);
            }
            if ($updateEc != 200) {
                echo json_encode(array("statusCode" => 400, "pesan" => "Data Emergency Contact gagal diupdate!"));
                return;
            }
        }
        echo json_encode(array("statusCode" => 200, "pesan" => "Data Tambahan Karyawan berhasil diperbarui!"));
    }

    public function create_data_karyawan()
    {
        $this->form_validation->set_rules("id_m_perusahaan", "id_m_perusahaan", "required|trim", [
            'required' => 'Perusahaan wajib dipilih',
        ]);
        $this->form_validation->set_rules("no_nik", "no_nik", "required|trim|numeric|max_length[25]", [
            'required' => 'NIK wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'NIK maksimal 25 karakter',
        ]);
        $this->form_validation->set_rules("depart", "depart", "required|trim", [
            'required' => 'Departemen wajib dipilih',
        ]);
        $this->form_validation->set_rules("section", "section", "required|trim", [
            'required' => 'Section wajib dipilih',
        ]);
        $this->form_validation->set_rules("posisi", "posisi", "required|trim", [
            'required' => 'Posisi wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_level", "id_level", "required|trim", [
            'required' => 'Level wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_grade", "id_grade", "required|trim", [
            'required' => 'Grade wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_klasifikasi", "id_klasifikasi", "required|trim", [
            'required' => 'Klasifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_tipe", "id_tipe", "required|trim", [
            'required' => 'Golongan wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_roster", "id_roster", "required|trim", [
            'required' => 'Roster wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_poh", "id_poh", "required|trim", [
            'required' => 'Point of Hire wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_lokterima", "id_lokterima", "required|trim", [
            'required' => 'Lokasi penerimaan wajib dipilih',
        ]);
        $this->form_validation->set_rules("id_lokker", "id_lokker", "required|trim", [
            'required' => 'Lokasi kerja wajib dipilih',
        ]);
        $this->form_validation->set_rules("stat_tinggal", "stat_tinggal", "required|trim", [
            'required' => 'Status Residence wajib diisi',
        ]);
        $this->form_validation->set_rules("doh", "doh", "required|trim", [
            'required' => 'Date of Hire wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_aktif", "tgl_aktif", "required|trim", [
            'required' => 'Tanggal Aktif wajib diisi',
        ]);
        $this->form_validation->set_rules("stat_kerja", "stat_kerja", "required|trim", [
            'required' => 'Status Karyawan wajib dipilih',
        ]);
        $this->form_validation->set_rules("email_kantor", "email_kantor", "trim|valid_email", [
            'valid_email' => 'Format email perusahaan salah',
        ]);
        $this->form_validation->set_rules("paybase", "paybase", "required|trim", [
            'required' => 'Paybase wajib dipilih',
        ]);
        $this->form_validation->set_rules("pajak", "pajak", "required|trim", [
            'required' => 'Status Pajak wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'pesan3' => 'Tidak dapat melanjutkan, lengkapi data karyawan.',
                'id_m_perusahaan' => form_error("id_m_perusahaan"),
                'no_nik' => form_error("no_nik"),
                'depart' => form_error("depart"),
                'section' => form_error("section"),
                'posisi' => form_error("posisi"),
                'id_level' => form_error("id_level"),
                'id_grade' => form_error("id_grade"),
                'id_roster' => form_error("id_roster"),
                'id_lokker' => form_error("id_lokker"),
                'id_lokterima' => form_error("id_lokterima"),
                'id_poh' => form_error("id_poh"),
                'id_klasifikasi' => form_error("id_klasifikasi"),
                'id_tipe' => form_error("id_tipe"),
                'stat_tinggal' => form_error("stat_tinggal"),
                'doh' => form_error("doh"),
                'tgl_aktif' => form_error("tgl_aktif"),
                'stat_kerja' => form_error("stat_kerja"),
                'email_kantor' => form_error("email_kantor"),
                'paybase' => form_error("paybase"),
                'pajak' => form_error("pajak"),
                'tgl_mulai_kontrak' => form_error("tgl_mulai_kontrak"),
                'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
            ];

            echo json_encode($error);
            return;
        } else {
            //personal
            $auth_ver = htmlspecialchars($this->input->post("auth_ver", true));
            $auth_check = htmlspecialchars($this->input->post("auth_check", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_alamat = htmlspecialchars($this->input->post("auth_alamat", true));
            $noktp = htmlspecialchars($this->input->post("noktp", true));
            $nokk = htmlspecialchars($this->input->post("nokk", true));
            $nama = htmlspecialchars($this->input->post("nama", true));
            $alamat = htmlspecialchars($this->input->post("alamat", true));
            $rt = htmlspecialchars($this->input->post("rt", true));
            $rw = htmlspecialchars($this->input->post("rw", true));
            $id_prov = htmlspecialchars($this->input->post("id_prov", true));
            $id_kab = htmlspecialchars($this->input->post("id_kab", true));
            $id_kec = htmlspecialchars($this->input->post("id_kec", true));
            $id_kel = htmlspecialchars($this->input->post("id_kel", true));
            $tmp_lahir = htmlspecialchars($this->input->post("tmp_lahir", true));
            $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
            $stat_nikah = htmlspecialchars($this->input->post("stat_nikah", true));
            $id_agama = htmlspecialchars($this->input->post("id_agama", true));
            $warga = htmlspecialchars($this->input->post("warga", true));
            $jk = htmlspecialchars($this->input->post("jk", true));
            $email = htmlspecialchars($this->input->post("email", true));
            $telp = htmlspecialchars($this->input->post("telp", true));
            $bpjs_tk = htmlspecialchars($this->input->post("bpjs_tk", true));
            $bpjs_kes = htmlspecialchars($this->input->post("bpjs_kes", true));
            $npwp = htmlspecialchars($this->input->post("npwp", true));
            $namaibu = htmlspecialchars($this->input->post("namaibu", true));
            $id_pendidikan = htmlspecialchars($this->input->post("id_pendidikan", true));
            $sekolah = htmlspecialchars($this->input->post("sekolah", true));
            $fakultas = htmlspecialchars($this->input->post("fakultas", true));
            $jurusan = htmlspecialchars($this->input->post("jurusan", true));

            //karyawan
            $auth_ktr = htmlspecialchars($this->input->post("auth_ktr", true));
            $no_nik = htmlspecialchars($this->input->post("no_nik", true));
            $auth_depart = htmlspecialchars($this->input->post("depart", true));
            $auth_section = htmlspecialchars($this->input->post("section", true));
            $auth_posisi = htmlspecialchars($this->input->post("posisi", true));
            $auth_lokker = htmlspecialchars($this->input->post("id_lokker", true));
            $auth_lokterima = htmlspecialchars($this->input->post("id_lokterima", true));
            $auth_poh = htmlspecialchars($this->input->post("id_poh", true));
            $auth_level = htmlspecialchars($this->input->post("id_level", true));
            $auth_roster = htmlspecialchars($this->input->post("id_roster", true));
            $auth_grade = htmlspecialchars($this->input->post("id_grade", true));
            $id_klasifikasi = htmlspecialchars($this->input->post("id_klasifikasi", true));
            $id_tipe = htmlspecialchars($this->input->post("id_tipe", true));
            $doh = htmlspecialchars($this->input->post("doh", true));
            $tgl_aktif = htmlspecialchars($this->input->post("tgl_aktif", true));
            $stat_tinggal = htmlspecialchars($this->input->post("stat_tinggal", true));
            $stat_kerja = htmlspecialchars($this->input->post("stat_kerja", true));
            $email_kantor = htmlspecialchars($this->input->post("email_kantor", true));
            $paybase = htmlspecialchars($this->input->post("paybase", true));
            $pajak = htmlspecialchars($this->input->post("pajak", true));
            $tgl_permanen = htmlspecialchars($this->input->post("tgl_permanen", true));
            $tgl_mulai_kontrak = htmlspecialchars($this->input->post("tgl_mulai_kontrak", true));
            $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
            $id_m_perusahaan = htmlspecialchars($this->input->post("id_m_perusahaan", true));
            $no_nik_old = htmlspecialchars($this->input->post("no_nik_old", true));

            if ($auth_check == "") {
                echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($id_m_perusahaan == "") {
                echo json_encode(array("statusCode" => 202, "pesan" => "Data perusahaan tidak ditemukan"));
                return;
            }

            $tokenAuth = $this->session->userdata('token');
            $parameterStatusPerjanjian = [
                'field' => 'id_stat_perjanjian',
                'value' => $stat_kerja,
            ];
            $dataStatusPerjanjian = $this->api_kry->specific_perjanjian_kerja($parameterStatusPerjanjian, $tokenAuth);
            if ($dataStatusPerjanjian['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataStatusPerjanjian = $this->api_kry->specific_perjanjian_kerja($parameterStatusPerjanjian, $newToken);
            }
            $query = $dataStatusPerjanjian['data'][0]['stat_waktu'];
            if ($query == "T") {
                if ($tgl_mulai_kontrak == "" && $tgl_akhir_kontrak == "") {
                    echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => "Tanggal akhir wajib diisi"));
                    return;
                }
                if ($tgl_mulai_kontrak == "") {
                    echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => ""));
                    return;
                }
                if ($tgl_akhir_kontrak == "") {
                    echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "", "pesan2" => "Tanggal akhir wajib diisi"));
                    return;
                }

                if ($tgl_mulai_kontrak > $tgl_akhir_kontrak) {
                    echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "", "pesan2" => "Isi tanggal akhir dengan benar"));
                    return;
                }

                $tgl_permanen = "1970-01-01";
            } else if ($query == "F") {
                if ($tgl_permanen == "") {
                    echo json_encode(array("statusCode" => 202, "pesan" => "Tanggal permanen wajib diisi", "pesan1" => "", "pesan2" => ""));
                    return;
                }

                $tgl_akhir_kontrak = "1970-01-01";
                $tgl_mulai_kontrak = $tgl_permanen;
            } else {
                echo json_encode(array("statusCode" => 202, "pesan" => "Kesalahan saat mengambil status kerja", "pesan1" => "", "pesan2" => ""));
                return;
            }

            if ($auth_person !== "") {
                $nonik = $no_nik_old;
                if ($nonik != $no_nik) {
                    $parameterMPerusahaan = [
                        'field' => 'auth_perusahaan',
                        'value' => $id_m_perusahaan,
                    ];
                    $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterMPerusahaan, $tokenAuth);
                    if ($dataStrukturPerusahaan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterMPerusahaan, $newToken);
                    }
                    $id_per = $dataStrukturPerusahaan['data'][0]['id_perusahaan'];

                    $parameterCheckNIK = [
                        'field' => 'no_nik',
                        'value' => $no_nik,
                        'field2' => 'id_perusahaan',
                        'value2' => $id_per,
                    ];
                    $dataCheckNIK = $this->api_kry->read_specific_data2($parameterCheckNIK, $tokenAuth);
                    if ($dataCheckNIK['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataCheckNIK = $this->api_kry->read_specific_data2($parameterCheckNIK, $newToken);
                    }
                    if ($dataCheckNIK['status'] == 200) {
                        echo json_encode(array("statusCode" => 202, "no_nik" => "NIK sudah digunakan", "pesan1" => "", "pesan2" => ""));
                        die;
                    }
                }
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
                $idpersonal = $dataPersonal['data'][0]['id_personal'];
                $parameterUpdatePersonal = [
                    'id_personal' => $idpersonal,
                    'no_ktp' => $noktp,
                    'no_kk' => $nokk,
                    'nama_lengkap' => $nama,
                    'jk' => $jk,
                    'tmp_lahir' => strtoupper($tmp_lahir),
                    'tgl_lahir' => $tgl_lahir,
                    'id_stat_nikah' => $stat_nikah,
                    'id_agama' => $id_agama,
                    'warga_negara' => $warga,
                    'email_pribadi' => $email,
                    'hp_1' => $telp,
                    'no_bpjstk' => $bpjs_tk,
                    'no_bpjskes' => $bpjs_kes,
                    'no_npwp' => $npwp,
                    'id_pendidikan' => $id_pendidikan,
                    'sekolah' => $sekolah,
                    'fakultas' => $fakultas,
                    'jurusan' => $jurusan,
                ];
                $updatePersonal = $this->api_psn->update($data_personal, $tokenAuth);
                if ($updatePersonal == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $updatePersonal = $this->api_psn->update($data_personal, $newToken);
                }
                $parameterAlamatKaryawan = [
                    'field' => 'id_personal',
                    'value' => $idpersonal,
                    'field2' => 'stat_alamat_ktp',
                    'value2' => 'T',
                ];
                $alamatKaryawan = $this->api_kry->read_data_alamat($parameterAlamatKaryawan, $tokenAuth);
                if ($alamatKaryawan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $alamatKaryawan = $this->api_kry->read_data_alamat($parameterAlamatKaryawan, $newToken);
                }

                $idalamat = $alamatKaryawan['data'][0]['id_alamat_ktp'];

                $parameterUpdateAlamat = [
                    'id_alamat_ktp' => $idalamat,
                    'alamat_ktp' => $alamat,
                    'rt_ktp' => $rt,
                    'rw_ktp' => $rw,
                    'kel_ktp' => $id_kel,
                    'kec_ktp' => $id_kec,
                    'kab_ktp' => $id_kab,
                    'prov_ktp' => $id_prov,
                ];
                $resultUpdateAlamat = $this->api_kry->update_alamat($parameterUpdateAlamat, $tokenAuth);
                if ($resultUpdateAlamat == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $resultUpdateAlamat = $this->api_kry->update_alamat($parameterUpdateAlamat, $newToken);
                }

                if ($auth_ver == "") {
                    $parameterIDMPerusahaan = [
                        'field' => 'auth_m_perusahaan',
                        'value' => $id_m_perusahaan,
                    ];
                    $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $tokenAuth);
                    if ($dataMPerusahaan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $newToken);
                    }
                    $id_m_perusahaan = $dataMPerusahaan['data'][0]['id_m_perusahaan'];

                    $parameterDepartemen = [
                        'field' => 'auth_depart',
                        'value' => $auth_depart,
                    ];
                    $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $tokenAuth);
                    if ($dataDepartemen['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $newToken);
                    }
                    $id_depart = $dataDepartemen['data'][0]['id_depart'];

                    $parameterSection = [
                        'source' => 'vw_section',
                        'field' => 'auth_section',
                        'value' => $auth_section,
                    ];
                    $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterSection);
                    if ($dataSection['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterSection);
                    }
                    if ($dataSection['status'] == 200) {
                        $id_section = $dataSection['data'][0]['id_section'];
                    } else {
                        $id_section = 0;
                    }

                    $parameterGrade = [
                        'source' => 'vw_grd',
                        'field' => 'auth_grade',
                        'value' => $auth_grade,
                    ];
                    $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterGrade);
                    if ($dataGrade['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterGrade);
                    }
                    if ($dataGrade['status'] == 200) {
                        $id_grade = $dataGrade['data'][0]['id_grade'];
                    } else {
                        $id_grade = 0;
                    }

                    $parameterRoster = [
                        'source' => 'vw_roster',
                        'field' => 'auth_roster',
                        'value' => $auth_roster,
                    ];
                    $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterRoster);
                    if ($dataRoster['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterRoster);
                    }
                    if ($dataRoster['status'] == 200) {
                        $id_roster = $dataRoster['data'][0]['id_roster'];
                    } else {
                        $id_roster = 0;
                    }

                    $parameterPosisi = [
                        'field' => 'auth_posisi',
                        'value' => $auth_posisi,
                    ];
                    $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $tokenAuth);
                    if ($dataPosisi['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $newToken);
                    }
                    $id_posisi = $dataPosisi['data'][0]['id_posisi'];

                    $parameterLevel = [
                        'field' => 'auth_level',
                        'value' => $auth_level,
                    ];
                    $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $tokenAuth);
                    if ($dataLevel['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $newToken);
                    }
                    $id_level = $dataLevel['data'][0]['id_level'];

                    $parameterLokasiPenerimaan = [
                        'field' => 'auth_lokterima',
                        'value' => $auth_lokterima,
                    ];
                    $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $tokenAuth);
                    if ($dataLokasiPenerimaan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $newToken);
                    }
                    $id_lokterima = $dataLokasiPenerimaan['data'][0]['id_lokterima'];

                    $parameterLokasiKerja = [
                        'field' => 'auth_lokker',
                        'value' => $auth_lokker,
                    ];
                    $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $tokenAuth);
                    if ($dataLokasiKerja['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $newToken);
                    }
                    $id_lokker = $dataLokasiKerja['data'][0]['id_lokker'];

                    $parameterPOH = [
                        'field' => 'auth_poh',
                        'value' => $auth_poh,
                    ];
                    $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $tokenAuth);
                    if ($dataPOH['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $newToken);
                    }
                    $id_poh = $dataPOH['data'][0]['id_poh'];

                    $parameterIDKaryawan = [
                        'field' => 'auth_karyawan',
                        'value' => $auth_kary,
                    ];
                    $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
                    if ($dataKaryawan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
                    }

                    $idkaryawan = $dataKaryawan['data'][0]['id_karyawan'];

                    $parameterUpdateKaryawan = [
                        'id_karyawan' => $idkaryawan,
                        'no_nik' => $no_nik,
                        'doh' => $doh,
                        'tgl_aktif' => $tgl_aktif,
                        'id_depart' => $id_depart,
                        'id_posisi' => $id_posisi,
                        'id_level' => $id_level,
                        'id_lokker' => $id_lokker,
                        'id_lokterima' => $id_lokterima,
                        'id_poh' => $id_poh,
                        'id_klasifikasi' => $id_klasifikasi,
                        'id_tipe' => $id_tipe,
                        'id_stat_tinggal' => $stat_tinggal,
                        'email_kantor' => $email_kantor,
                        'paybase' => $paybase,
                        'pajak' => $pajak,
                        'id_m_perusahaan' => $id_m_perusahaan,
                        'id_section' => $id_section,
                        'id_grade' => $id_grade,
                        'id_roster' => $id_roster,
                    ];
                    $dataUpdateKaryawan = $this->api_kry->update($parameterUpdateKaryawan, $tokenAuth);
                    if ($dataUpdateKaryawan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataUpdateKaryawan = $this->api_kry->update($parameterUpdateKaryawan, $newToken);
                    }

                    if ($auth_ktr != "") {
                        $parameterKontrakKaryawan = [
                            'field' => 'auth_kontrak_kary',
                            'value' => $authktr,
                        ];
                        $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $tokenAuth);
                        if ($dataKontrakKaryawan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $newToken);
                        }
                        if (!empty($dataKontrakKaryawan['data'])) {
                            $id_kontrak = $dataKontrakKaryawan['data'][0]['id_kontak_kary'];
                        } else {
                            $id_kontrak = "";
                        }
                        if ($id_kontrak != "") {
                            $data_kontrak = [
                                'id_kontrak_kary' => $id_kontrak,
                                'id_kary' => $idkaryawan,
                                'id_stat_perjanjian' => $stat_kerja,
                                'tgl_mulai' => $tgl_mulai_kontrak,
                                'tgl_akhir' => $tgl_akhir_kontrak,
                            ];
                            $updateKontrak = $this->api_kry->update_kontrak_karyawan($data_kontrak, $tokenAuth);
                            if ($updateKontrak == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $updateKontrak = $this->api_kry->update_kontrak_karyawan($data_kontrak, $newToken);
                            }

                            // echo json_encode([$data_kontrak]);
                            // return;
                        }
                    }

                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data karyawan berhasil diupdate",
                        "no_ktp" => $noktp,
                        "no_kk" => $nokk,
                        "nik" => $no_nik,
                    ));
                    return;
                } else {
                    $parameterIDMPerusahaan = [
                        'field' => 'auth_m_perusahaan',
                        'value' => $id_m_perusahaan,
                    ];
                    $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $tokenAuth);
                    if ($dataMPerusahaan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $newToken);
                    }
                    $id_m_perusahaan = $dataMPerusahaan['data'][0]['id_m_perusahaan'];

                    $parameterDepartemen = [
                        'field' => 'auth_depart',
                        'value' => $auth_depart,
                    ];
                    $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $tokenAuth);
                    if ($dataDepartemen['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $newToken);
                    }
                    $id_depart = $dataDepartemen['data'][0]['id_depart'];

                    $parameterSection = [
                        'source' => 'vw_section',
                        'field' => 'auth_section',
                        'value' => $auth_section,
                    ];
                    $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterSection);
                    if ($dataSection['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterSection);
                    }
                    if ($dataSection['status'] == 200) {
                        $id_section = $dataSection['data'][0]['id_section'];
                    } else {
                        $id_section = 0;
                    }

                    $parameterGrade = [
                        'source' => 'vw_grd',
                        'field' => 'auth_grade',
                        'value' => $auth_grade,
                    ];
                    $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterGrade);
                    if ($dataGrade['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterGrade);
                    }
                    if ($dataGrade['status'] == 200) {
                        $id_grade = $dataGrade['data'][0]['id_grade'];
                    } else {
                        $id_grade = 0;
                    }

                    $parameterRoster = [
                        'source' => 'vw_roster',
                        'field' => 'auth_roster',
                        'value' => $auth_roster,
                    ];
                    $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterRoster);
                    if ($dataRoster['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterRoster);
                    }
                    if ($dataRoster['status'] == 200) {
                        $id_roster = $dataRoster['data'][0]['id_roster'];
                    } else {
                        $id_roster = 0;
                    }

                    $parameterPosisi = [
                        'field' => 'auth_posisi',
                        'value' => $auth_posisi,
                    ];
                    $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $tokenAuth);
                    if ($dataPosisi['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $newToken);
                    }
                    $id_posisi = $dataPosisi['data'][0]['id_posisi'];

                    $parameterLevel = [
                        'field' => 'auth_level',
                        'value' => $auth_level,
                    ];
                    $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $tokenAuth);
                    if ($dataLevel['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $newToken);
                    }
                    $id_level = $dataLevel['data'][0]['id_level'];

                    $parameterLokasiPenerimaan = [
                        'field' => 'auth_lokterima',
                        'value' => $auth_lokterima,
                    ];
                    $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $tokenAuth);
                    if ($dataLokasiPenerimaan['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $newToken);
                    }
                    $id_lokterima = $dataLokasiPenerimaan['data'][0]['id_lokterima'];

                    $parameterLokasiKerja = [
                        'field' => 'auth_lokker',
                        'value' => $auth_lokker,
                    ];
                    $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $tokenAuth);
                    if ($dataLokasiKerja['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $newToken);
                    }
                    $id_lokker = $dataLokasiKerja['data'][0]['id_lokker'];

                    $parameterPOH = [
                        'field' => 'auth_poh',
                        'value' => $auth_poh,
                    ];
                    $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $tokenAuth);
                    if ($dataPOH['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $newToken);
                    }
                    $id_poh = $dataPOH['data'][0]['id_poh'];

                    if ($auth_kary != "") {
                        $parameterIDKaryawan = [
                            'field' => 'auth_karyawan',
                            'value' => $auth_kary,
                        ];
                        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
                        if ($dataKaryawan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
                        }

                        $idkaryawan = $dataKaryawan['data'][0]['id_karyawan'];

                        $parameterUpdateKaryawan = [
                            'id_karyawan' => $idkaryawan,
                            'no_nik' => $no_nik,
                            'doh' => $doh,
                            'tgl_aktif' => $tgl_aktif,
                            'id_depart' => $id_depart,
                            'id_posisi' => $id_posisi,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_klasifikasi' => $id_klasifikasi,
                            'id_tipe' => $id_tipe,
                            'id_stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'paybase' => $paybase,
                            'pajak' => $pajak,
                            'id_m_perusahaan' => $id_m_perusahaan,
                            'id_section' => $id_section,
                            'id_grade' => $id_grade,
                            'id_roster' => $id_roster,
                        ];
                        $dataUpdateKaryawan = $this->api_kry->update($parameterUpdateKaryawan, $tokenAuth);
                        if ($dataUpdateKaryawan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataUpdateKaryawan = $this->api_kry->update($parameterUpdateKaryawan, $newToken);
                        }

                        if ($auth_ktr != "") {
                            $parameterKontrakKaryawan = [
                                'field' => 'auth_kontrak_kary',
                                'value' => $authktr,
                            ];
                            $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $tokenAuth);
                            if ($dataKontrakKaryawan['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $dataKontrakKaryawan = $this->api_kry->specific_kontrak_karyawan($parameterKontrakKaryawan, $newToken);
                            }
                            if (!empty($dataKontrakKaryawan['data'])) {
                                $id_kontrak = $dataKontrakKaryawan['data'][0]['id_kontak_kary'];
                            } else {
                                $id_kontrak = "";
                            }
                            if ($id_kontrak != "") {
                                $data_kontrak = [
                                    'id_kontrak_kary' => $id_kontrak,
                                    'id_kary' => $idkaryawan,
                                    'id_stat_perjanjian' => $stat_kerja,
                                    'tgl_mulai' => $tgl_mulai_kontrak,
                                    'tgl_akhir' => $tgl_akhir_kontrak,
                                ];
                                $updateKontrak = $this->api_kry->update_kontrak_karyawan($data_kontrak, $tokenAuth);
                                if ($updateKontrak == 403) {
                                    $this->session->unset_userdata('token');
                                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                                    $this->session->set_userdata('token', $tokenData['data']);
                                    $newToken = $this->session->userdata('token');
                                    $updateKontrak = $this->api_kry->update_kontrak_karyawan($data_kontrak, $newToken);
                                }
                            }
                        }

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data karyawan berhasil diupdate",
                            "no_ktp" => $noktp,
                            "no_kk" => $nokk,
                            "nik" => $no_nik,
                        ));
                    } else {
                        $data_karyawan = [
                            'id_personal' => $idpersonal,
                            'no_nik' => $no_nik,
                            'doh' => $doh,
                            'tgl_aktif' => $tgl_aktif,
                            'id_depart' => $id_depart,
                            'id_posisi' => $id_posisi,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_klasifikasi' => $id_klasifikasi,
                            'id_tipe' => $id_tipe,
                            'stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'paybase' => $paybase,
                            'pajak' => $pajak,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                            'id_m_perusahaan' => $id_m_perusahaan,
                            'id_section' => $id_section,
                            'id_grade' => $id_grade,
                            'id_roster' => $id_roster,
                        ];
                        $createKaryawan = $this->api_kry->create($data_karyawan, $tokenAuth);
                        if ($createKaryawan == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createKaryawan = $this->api_kry->create($data_karyawan, $newToken);
                        }

                        if ($createKaryawan == 201) {
                            if ($auth_ver == "") {
                                $parameterPersonalLast = [
                                    'field' => 'tgl_buat',
                                ];
                                $dataPersonalLast = $this->api_psn->read_lastest_data($parameterPersonalLast, $tokenAuth);
                                if ($dataPersonalLast['status'] == 403) {
                                    $this->session->unset_userdata('token');
                                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                                    $this->session->set_userdata('token', $tokenData['data']);
                                    $newToken = $this->session->userdata('token');
                                    $dataPersonalLast = $this->api_psn->read_lastest_data($parameterPersonalLast, $newToken);
                                }
                                $auth_person = $dataPersonalLast['data'][0]['auth_personal'];
                            }

                            $parameterKaryawan = [
                                'condition' => 'auth_personal',
                                'conditionValue' => $auth_person,
                            ];
                            $lastKaryawan = $this->api_kry->read_lastest_data($parameterKaryawan, $tokenAuth);
                            if ($lastKaryawan['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $lastKaryawan = $this->api_kry->read_lastest_data($parameterKaryawan, $newToken);
                            }
                            $auth_kary_new = $lastKaryawan['data'][0]['auth_karyawan'];

                            $parameterAlamatKaryawan2 = [
                                'field' => 'auth_personal',
                                'value' => $auth_person,
                                'field2' => 'stat_alamat_ktp',
                                'value2' => 'T',
                            ];
                            $alamatKaryawan2 = $this->api_kry->read_data_alamat($parameterAlamatKaryawan2, $tokenAuth);
                            if ($alamatKaryawan2['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $alamatKaryawan2 = $this->api_kry->read_data_alamat($parameterAlamatKaryawan2, $newToken);
                            }
                            $auth_alamat = $alamatKaryawan2['data'][0]['auth_alamat'];

                            $lastKary = $this->api_kry->read_last_data($tokenAuth);
                            if ($lastKary['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $lastKary = $this->api_kry->read_last_data($newToken);
                            }
                            $id_kary = $lastKary['data'][0]['id_karyawan'];

                            if ($lastKary['status'] == 404) {
                                $data_kontrak = [
                                    'id_kary' => $id_kary,
                                    'id_stat_perjanjian' => $stat_kerja,
                                    'tgl_mulai' => $tgl_mulai_kontrak,
                                    'tgl_akhir' => $tgl_akhir_kontrak,
                                    'id_user' => $this->session->userdata('id_user_hcdata'),
                                ];

                                $createKontrakKaryawan = $this->api_kry->create_kontrak_karyawan($data_kontrak, $tokenAuth);
                                if ($createKontrakKaryawan == 403) {
                                    $this->session->unset_userdata('token');
                                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                                    $this->session->set_userdata('token', $tokenData['data']);
                                    $newToken = $this->session->userdata('token');
                                    $createKontrakKaryawan = $this->api_kry->create_kontrak_karyawan($data_kontrak, $newToken);
                                }

                                $parameterLastKontrak = [
                                    'condition' => 'id_kary',
                                    'conditionValue' => $id_kary,
                                ];

                                $dataLastKontrak = $this->api_kry->lastest_kontrak_karyawan($parameterLastKontrak, $tokenAuth);
                                if ($dataLastKontrak['status'] == 403) {
                                    $this->session->unset_userdata('token');
                                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                                    $this->session->set_userdata('token', $tokenData['data']);
                                    $newToken = $this->session->userdata('token');
                                    $dataLastKontrak = $this->api_kry->lastest_kontrak_karyawan($parameterLastKontrak, $newToken);
                                }
                                $auth_kontrak = $dataLastKontrak['data'][0]['auth_kontrak_kary'];
                            } else {
                                $auth_kontrak = "";
                            }

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data karyawan berhasil disimpan",
                                "auth_person" => $auth_person,
                                "auth_kary" => $auth_kary_new,
                                "auth_alamat" => $auth_alamat,
                                "auth_kontrak" => $auth_kontrak,
                                "no_ktp" => $noktp,
                                "no_kk" => $nokk,
                                "nik" => $no_nik,
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal disimpan"));
                        }
                    }
                }
            } else {
                $parameterMPerusahaan = [
                    'field' => 'auth_m_perusahaan',
                    'value' => $id_m_perusahaan,
                ];
                $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterMPerusahaan, $tokenAuth);
                if ($dataStrukturPerusahaan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterMPerusahaan, $newToken);
                }
                $id_per = $dataStrukturPerusahaan['data'][0]['id_perusahaan'];
                $parameterCheckNIK = [
                    'field' => 'no_nik',
                    'value' => $no_nik,
                    'field2' => 'id_perusahaan',
                    'value2' => $id_per,
                ];
                $dataCheckNIK = $this->api_kry->read_specific_data2($parameterCheckNIK, $tokenAuth);
                if ($dataCheckNIK['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataCheckNIK = $this->api_kry->read_specific_data2($parameterCheckNIK, $newToken);
                }
                if ($dataCheckNIK['status'] == 200) {
                    echo json_encode(array("statusCode" => 202, "no_nik" => "NIK sudah digunakan", "pesan1" => "", "pesan2" => ""));
                    return;
                }

                $data_personal = [
                    'noktp' => $noktp,
                    'nokk' => $nokk,
                    'nama' => $nama,
                    'jk' => $jk,
                    'tmp_lahir' => $tmp_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'stat_nikah' => $stat_nikah,
                    'id_agama' => $id_agama,
                    'warga' => $warga,
                    'email' => $email,
                    'telp' => $telp,
                    'bpjs_tk' => $bpjs_tk,
                    'bpjs_kes' => $bpjs_kes,
                    'npwp' => $npwp,
                    'sekolah' => $sekolah,
                    'fakultas' => $fakultas,
                    'jurusan' => $jurusan,
                    'id_pendidikan' => $id_pendidikan,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];
                $createPersonal = $this->api_psn->create($data_personal, $tokenAuth);
                if ($createPersonal == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $createPersonal = $this->api_psn->create($data_personal, $newToken);
                }
                if ($createPersonal == 201) {
                    $parameterPersonalLast2 = [
                        'field' => 'id_personal',
                    ];
                    $dataPersonalLast2 = $this->api_psn->read_lastest_data($parameterPersonalLast2, $tokenAuth);
                    if ($dataPersonalLast2['status'] == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $dataPersonalLast2 = $this->api_psn->read_lastest_data($parameterPersonalLast2, $newToken);
                    }
                    $id_personal = $dataPersonalLast2['data'][0]['id_personal'];
                    if ($id_personal === 0) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat menyimpan alamat"));
                        return;
                    } else {
                        $foldername = md5($id_personal);
                        $makeFolder = $this->ftp_file->makeFolder($foldername);

                        $data_alamat = [
                            'id_personal' => $id_personal,
                            'alamat_ktp' => $alamat,
                            'rt_ktp' => $rt,
                            'rw_ktp' => $rw,
                            'kel_ktp' => $id_kel,
                            'kec_ktp' => $id_kec,
                            'kab_ktp' => $id_kab,
                            'prov_ktp' => $id_prov,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];
                        $createAlamatKaryawan = $this->api_kry->create_alamat($data_alamat, $tokenAuth);
                        if ($createAlamatKaryawan == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createAlamatKaryawan = $this->api_kry->create_alamat($data_alamat, $newToken);
                        }

                        $parameterIDMPerusahaan = [
                            'field' => 'auth_m_perusahaan',
                            'value' => $id_m_perusahaan,
                        ];
                        $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $tokenAuth);
                        if ($dataMPerusahaan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataMPerusahaan = $this->api_str->read_specific_data($parameterIDMPerusahaan, $newToken);
                        }
                        $id_m_perusahaan = $dataMPerusahaan['data'][0]['id_m_perusahaan'];

                        $parameterDepartemen = [
                            'field' => 'auth_depart',
                            'value' => $auth_depart,
                        ];
                        $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $tokenAuth);
                        if ($dataDepartemen['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $newToken);
                        }
                        $id_depart = $dataDepartemen['data'][0]['id_depart'];

                        $parameterSection = [
                            'source' => 'vw_section',
                            'field' => 'auth_section',
                            'value' => $auth_section,
                        ];
                        $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterSection);
                        if ($dataSection['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterSection);
                        }
                        if ($dataSection['status'] == 200) {
                            $id_section = $dataSection['data'][0]['id_section'];
                        } else {
                            $id_section = 0;
                        }

                        $parameterGrade = [
                            'source' => 'vw_grd',
                            'field' => 'auth_grade',
                            'value' => $auth_grade,
                        ];
                        $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterGrade);
                        if ($dataGrade['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterGrade);
                        }
                        if ($dataGrade['status'] == 200) {
                            $id_grade = $dataGrade['data'][0]['id_grade'];
                        } else {
                            $id_grade = 0;
                        }

                        $parameterRoster = [
                            'source' => 'vw_roster',
                            'field' => 'auth_roster',
                            'value' => $auth_roster,
                        ];
                        $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterRoster);
                        if ($dataRoster['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterRoster);
                        }
                        if ($dataRoster['status'] == 200) {
                            $id_roster = $dataRoster['data'][0]['id_roster'];
                        } else {
                            $id_roster = 0;
                        }

                        $parameterPosisi = [
                            'field' => 'auth_posisi',
                            'value' => $auth_posisi,
                        ];
                        $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $tokenAuth);
                        if ($dataPosisi['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $newToken);
                        }
                        $id_posisi = $dataPosisi['data'][0]['id_posisi'];

                        $parameterLevel = [
                            'field' => 'auth_level',
                            'value' => $auth_level,
                        ];
                        $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $tokenAuth);
                        if ($dataLevel['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $newToken);
                        }
                        $id_level = $dataLevel['data'][0]['id_level'];

                        $parameterLokasiPenerimaan = [
                            'field' => 'auth_lokterima',
                            'value' => $auth_lokterima,
                        ];
                        $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $tokenAuth);
                        if ($dataLokasiPenerimaan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $newToken);
                        }
                        $id_lokterima = $dataLokasiPenerimaan['data'][0]['id_lokterima'];

                        $parameterLokasiKerja = [
                            'field' => 'auth_lokker',
                            'value' => $auth_lokker,
                        ];
                        $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $tokenAuth);
                        if ($dataLokasiKerja['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $newToken);
                        }
                        $id_lokker = $dataLokasiKerja['data'][0]['id_lokker'];

                        $parameterPOH = [
                            'field' => 'auth_poh',
                            'value' => $auth_poh,
                        ];
                        $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $tokenAuth);
                        if ($dataPOH['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $newToken);
                        }
                        $id_poh = $dataPOH['data'][0]['id_poh'];

                        $data_karyawan = [
                            'id_personal' => $id_personal,
                            'no_nik' => $no_nik,
                            'doh' => $doh,
                            'tgl_aktif' => $tgl_aktif,
                            'id_depart' => $id_depart,
                            'id_posisi' => $id_posisi,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_klasifikasi' => $id_klasifikasi,
                            'id_tipe' => $id_tipe,
                            'stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'paybase' => $paybase,
                            'pajak' => $pajak,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                            'id_m_perusahaan' => $id_m_perusahaan,
                            'id_section' => $id_section,
                            'id_grade' => $id_grade,
                            'id_roster' => $id_roster,
                        ];
                        $createKaryawan = $this->api_kry->create($data_karyawan, $tokenAuth);
                        if ($createKaryawan == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $createKaryawan = $this->api_kry->create($data_karyawan, $newToken);
                        }

                        if ($createKaryawan == 201) {
                            $parameterPersonalLast = [
                                'field' => 'tgl_buat',
                            ];
                            $dataPersonalLast = $this->api_psn->read_lastest_data($parameterPersonalLast, $tokenAuth);
                            if ($dataPersonalLast['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $dataPersonalLast = $this->api_psn->read_lastest_data($parameterPersonalLast, $newToken);
                            }
                            $auth_person = $dataPersonalLast['data'][0]['auth_personal'];

                            $parameterKaryawan = [
                                'condition' => 'auth_personal',
                                'conditionValue' => $auth_person,
                            ];
                            $lastKaryawan = $this->api_kry->read_lastest_data($parameterKaryawan, $tokenAuth);
                            if ($lastKaryawan['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $lastKaryawan = $this->api_kry->read_lastest_data($parameterKaryawan, $newToken);
                            }
                            $auth_kary = $lastKaryawan['data'][0]['auth_karyawan'];

                            $parameterAlamatKaryawan2 = [
                                'field' => 'auth_personal',
                                'value' => $auth_person,
                            ];
                            $alamatKaryawan2 = $this->api_kry->read_spesifik_alamat($parameterAlamatKaryawan2, $tokenAuth);
                            if ($alamatKaryawan2['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $alamatKaryawan2 = $this->api_kry->read_spesifik_alamat($parameterAlamatKaryawan2, $newToken);
                            }
                            if ($alamatKaryawan2['status'] == 200) {
                                $auth_alamat = $alamatKaryawan2['data'][0]['auth_alamat'];
                            } else {
                                $auth_alamat = '0';
                            }
                            $id_kary = $lastKaryawan['data'][0]['id_kary'];

                            $data_kontrak = [
                                'id_kary' => $id_kary,
                                'id_stat_perjanjian' => $stat_kerja,
                                'tgl_mulai' => $tgl_mulai_kontrak,
                                'tgl_akhir' => $tgl_akhir_kontrak,
                                'id_user' => $this->session->userdata('id_user_hcdata'),
                            ];

                            $createKontrakKaryawan = $this->api_kry->create_kontrak_karyawan($data_kontrak, $tokenAuth);
                            if ($createKontrakKaryawan == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $createKontrakKaryawan = $this->api_kry->create_kontrak_karyawan($data_kontrak, $newToken);
                            }

                            $parameterLastKontrak = [
                                'condition' => 'id_kary',
                                'conditionValue' => $id_kary,
                            ];

                            $dataLastKontrak = $this->api_kry->lastest_kontrak_karyawan($parameterLastKontrak, $tokenAuth);
                            if ($dataLastKontrak['status'] == 403) {
                                $this->session->unset_userdata('token');
                                $tokenData = $this->api_tkn->getToken($this->tokenData());
                                $this->session->set_userdata('token', $tokenData['data']);
                                $newToken = $this->session->userdata('token');
                                $dataLastKontrak = $this->api_kry->lastest_kontrak_karyawan($parameterLastKontrak, $newToken);
                            }
                            $auth_kontrak = $dataLastKontrak['data'][0]['auth_kontrak_kary'];

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data karyawan berhasil disimpan, lengkapi data selanjutnya",
                                "auth_person" => $auth_person,
                                "auth_kary" => $auth_kary,
                                "auth_alamat" => $auth_alamat,
                                "auth_kontrak" => $auth_kontrak,
                                "no_ktp" => $noktp,
                                "no_kk" => $nokk,
                                "nik" => $no_nik,
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal disimpan"));
                        }
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data personal gagal disimpan"));
                }
            }
        }
    }

    public function update_data_karyawan()
    {
        $id_karyawan = htmlspecialchars($this->input->post("id_karyawan", true));
        $no_nik = htmlspecialchars($this->input->post("no_nik", true));
        $auth_departemen = htmlspecialchars($this->input->post("auth_departemen", true));
        $auth_section = htmlspecialchars($this->input->post("auth_section", true));
        $auth_posisi = htmlspecialchars($this->input->post("auth_posisi", true));
        $auth_lokker = htmlspecialchars($this->input->post("auth_lokker", true));
        $auth_lokterima = htmlspecialchars($this->input->post("auth_lokterima", true));
        $auth_poh = htmlspecialchars($this->input->post("auth_poh", true));
        $id_tipe = htmlspecialchars($this->input->post("id_tipe", true));
        $auth_level = htmlspecialchars($this->input->post("auth_level", true));
        $auth_grade = htmlspecialchars($this->input->post("auth_grade", true));
        $auth_roster = htmlspecialchars($this->input->post("auth_roster", true));
        $id_klasifikasi = htmlspecialchars($this->input->post("id_klasifikasi", true));
        $doh = htmlspecialchars($this->input->post("doh", true));
        $tgl_aktif = htmlspecialchars($this->input->post("tgl_aktif", true));
        $id_stat_tinggal = htmlspecialchars($this->input->post("stat_tinggal", true));
        $email_kantor = htmlspecialchars($this->input->post("email_kantor", true));
        $paybase = htmlspecialchars($this->input->post("paybase", true));
        $pajak = htmlspecialchars($this->input->post("pajak", true));

        $tokenAuth = $this->session->userdata("token");
        $parameterDepartemen = [
            'field' => 'auth_depart',
            'value' => $auth_departemen,
        ];
        $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $tokenAuth);
        if ($dataDepartemen['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataDepartemen = $this->api_dprt->read_specific_data($parameterDepartemen, $newToken);
        }
        if ($dataDepartemen['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Departemen tidak ditemukan!"));
            return;
        }

        $parameterPosisi = [
            'field' => 'auth_posisi',
            'value' => $auth_posisi,
        ];
        $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $tokenAuth);
        if ($dataPosisi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPosisi = $this->api_pss->read_specific_data($parameterPosisi, $newToken);
        }
        if ($dataPosisi['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Posisi tidak ditemukan!"));
            return;
        }

        $parameterLokasiKerja = [
            'field' => 'auth_lokker',
            'value' => $auth_lokker,
        ];
        $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $tokenAuth);
        if ($dataLokasiKerja['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLokasiKerja = $this->api_lkr->read_specific_data($parameterLokasiKerja, $newToken);
        }
        if ($dataLokasiKerja['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Lokasi Kerja tidak ditemukan!"));
            return;
        }

        $parameterLokasiPenerimaan = [
            'field' => 'auth_lokterima',
            'value' => $auth_lokterima,
        ];
        $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $tokenAuth);
        if ($dataLokasiPenerimaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLokasiPenerimaan = $this->api_kry->specific_lokasi_penerimaan($parameterLokasiPenerimaan, $newToken);
        }
        if ($dataLokasiPenerimaan['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Lokasi Penerimaan tidak ditemukan!"));
            return;
        }

        $parameterLevel = [
            'field' => 'auth_level',
            'value' => $auth_level,
        ];
        $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $tokenAuth);
        if ($dataLevel['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataLevel = $this->api_lvl->read_specific_data($parameterLevel, $newToken);
        }
        if ($dataLevel['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Level tidak ditemukan!"));
            return;
        }

        $parameterPOH = [
            'field' => 'auth_poh',
            'value' => $auth_poh,
        ];
        $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $tokenAuth);
        if ($dataPOH['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPOH = $this->api_poh->read_specific_data($parameterPOH, $newToken);
        }
        if ($dataPOH['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Point of Hire tidak ditemukan!"));
            return;
        }

        $parameterSection = [
            'source' => 'vw_section',
            'field' => 'auth_section',
            'value' => $auth_section,
        ];
        $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterSection);
        if ($dataSection['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSection = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterSection);
        }
        if ($dataSection['status'] == 200) {
            $id_section = $dataSection['data'][0]['id_section'];
        } else {
            $id_section = 0;
        }

        $parameterGrade = [
            'source' => 'vw_grd',
            'field' => 'auth_grade',
            'value' => $auth_grade,
        ];
        $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterGrade);
        if ($dataGrade['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataGrade = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterGrade);
        }
        if ($dataGrade['status'] == 200) {
            $id_grade = $dataGrade['data'][0]['id_grade'];
        } else {
            $id_grade = 0;
        }

        $parameterRoster = [
            'source' => 'vw_roster',
            'field' => 'auth_roster',
            'value' => $auth_roster,
        ];
        $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterRoster);
        if ($dataRoster['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataRoster = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterRoster);
        }
        if ($dataRoster['status'] == 200) {
            $id_roster = $dataRoster['data'][0]['id_roster'];
        } else {
            $id_roster = 0;
        }

        $id_departemen = $dataDepartemen['data'][0]['id_depart'];
        $id_posisi = $dataPosisi['data'][0]['id_posisi'];
        $id_lokker = $dataLokasiKerja['data'][0]['id_lokker'];
        $id_lokterima = $dataLokasiPenerimaan['data'][0]['id_lokterima'];
        $id_poh = $dataPOH['data'][0]['id_poh'];
        $id_level = $dataLevel['data'][0]['id_level'];

        $parameterData = [
            'id_karyawan' => $id_karyawan,
            'no_nik' => $no_nik,
            'doh' => $doh,
            'tgl_aktif' => $tgl_aktif,
            'id_depart' => $id_departemen,
            'id_posisi' => $id_posisi,
            'id_level' => $id_level,
            'id_lokker' => $id_lokker,
            'id_lokterima' => $id_lokterima,
            'id_poh' => $id_poh,
            'id_klasifikasi' => $id_klasifikasi,
            'id_tipe' => $id_tipe,
            'id_stat_tinggal' => $id_stat_tinggal,
            'email_kantor' => $email_kantor,
            'paybase' => $paybase,
            'pajak' => $pajak,
            'id_section' => $id_section,
            'id_grade' => $id_grade,
            'id_roster' => $id_roster,
        ];
        $updateKaryawan = $this->api_kry->update($parameterData, $tokenAuth);
        if ($updateKaryawan == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $updateKaryawan = $this->api_kry->update($parameterData, $newToken);
        }
        if ($updateKaryawan == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data Karyawan berhasil diedit!"));
        } else {
            echo json_encode(array("statusCode" => 400, "pesan" => "Data Karyawan gagal diedit!"));
        }
    }

    public function delete_karyawan()
    {
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $tokenAuth = $this->session->userdata('token');

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

        if ($dataKaryawan['status'] == 200) {
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];
            $id_personal = $dataKaryawan['data'][0]['id_personal'];
            $foldername = md5($id_personal);

            $parameterIDKaryawan = [
                'id_kary' => $id_karyawan,
            ];
            $parameterIDKaryawan2 = [
                'field' => 'id_kary',
                'value' => $id_karyawan,
            ];
            $parameterIDPersonal = [
                'id_personal' => $id_personal,
            ];
            $parameterIDPersonal2 = [
                'field' => 'id_personal',
                'value' => $id_personal,
            ];

            // Karyawan
            $deleteKaryawan = $this->api_kry->delete($parameterIDKaryawan, $tokenAuth);
            if ($deleteKaryawan == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $deleteKaryawan = $this->api_kry->delete($parameterIDKaryawan, $newToken);
            }
            // Kontrak
            $deleteKontrak = $this->api_kry->delete_kontrak_karyawan($parameterIDKaryawan2, $tokenAuth);
            if ($deleteKontrak == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $deleteKontrak = $this->api_kry->delete_kontrak_karyawan($parameterIDKaryawan2, $newToken);
            }
            // Izin Tambang & Unit (Mine Permit & Simper)
            $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameterIDKaryawan2, $tokenAuth);
            if ($dataIzin['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataIzin = $this->api_izt->spesifik_data_mine_permit($parameterIDKaryawan2, $newToken);
            }
            if ($dataIzin['status'] == 200) {
                foreach ($dataIzin['data'] as $data) {
                    $parameterIzin = [
                        'field' => 'id_izin_tambang',
                        'value' => $data['id_izin_tambang'],
                    ];
                    $deleteIzin = $this->api_izt->delete_permit($parameterIzin, $tokenAuth);
                    if ($deleteIzin == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $deleteIzin = $this->api_izt->delete_permit($parameterIzin, $newToken);
                    }
                    $deleteUnit = $this->api_izt->delete_all_unit($parameterIzin, $tokenAuth);
                    if ($deleteUnit == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $deleteUnit = $this->api_izt->delete_all_unit($parameterIzin, $newToken);
                    }
                }
            }
            // Alamat Karyawan
            $deleteAlamat = $this->api_kry->delete_alamat($parameterIDPersonal2, $tokenAuth);
            if ($deleteAlamat == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $deleteAlamat = $this->api_kry->delete_alamat($parameterIDPersonal2, $newToken);
            }
            // Vaksin
            $deleteVaksin = $this->api_kry->delete_all_vaksin($parameterIDPersonal, $tokenAuth);
            if ($deleteVaksin == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $deleteVaksin = $this->api_kry->delete_all_vaksin($parameterIDPersonal, $newToken);
            }
            // MCU
            $dataMCU = $this->api_kry->specific_mcu($parameterIDPersonal2, $tokenAuth);
            if ($dataMCU['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataMCU = $this->api_kry->specific_mcu($parameterIDPersonal2, $newToken);
            }
            if ($dataMCU['status'] == 200) {
                $deleteMCU = $this->api_kry->delete_all_mcu($parameterIDPersonal, $tokenAuth);
                if ($deleteMCU == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteMCU = $this->api_kry->delete_all_mcu($parameterIDPersonal, $newToken);
                }
                if ($deleteMCU == 200) {
                    foreach ($dataMCU['data'] as $data) {
                        $file_mcu = $data['url_file'];
                        $this->ftp_file->deleteFile($foldername, $file_mcu);
                    }
                }
            }
            // Sim Karyawan (SIM Polisi)
            $dataSIMKaryawan = $this->api_izt->spesifik_data_sim($parameterIDPersonal2, $tokenAuth);
            if ($dataSIMKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSIMKaryawan = $this->api_izt->spesifik_data_sim($parameterIDPersonal2, $newToken);
            }
            if ($dataSIMKaryawan['status'] == 200) {
                $deleteSIM = $this->api_izt->delete_sim($parameterIDPersonal, $tokenAuth);
                if ($deleteSIM == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteSIM = $this->api_izt->delete_sim($parameterIDPersonal, $newToken);
                }
                if ($deleteSIM == 200) {
                    foreach ($dataSIMKaryawan['data'] as $data) {
                        $file = $data['url_file'];
                        $this->ftp_file->deleteFile($foldername, $file);
                    }
                }
            }
            // Sertifikasi
            $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameterIDPersonal2, $tokenAuth);
            if ($dataSertifikasi['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameterIDPersonal2, $newToken);
            }
            if ($dataSertifikasi['status'] == 200) {
                $deleteSertifikasi = $this->api_srt->delete_all($parameterIDPersonal, $tokenAuth);
                if ($deleteSertifikasi == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteSertifikasi = $this->api_srt->delete_all($parameterIDPersonal, $newToken);
                }
                if ($deleteSertifikasi == 200) {
                    foreach ($dataSertifikasi['data'] as $data) {
                        $nama_file = $data['file_sertifikasi'];
                        $this->ftp_file->deleteFile($foldername, $nama_file);
                    }
                }
            }
            // Personal & File Pendukung
            $dataPersonal = $this->api_psn->read_specific_data($parameterIDPersonal2, $tokenAuth);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->api_psn->read_specific_data($parameterIDPersonal2, $newToken);
            }
            if ($dataPersonal['status'] == 200) {
                $deletePersonal = $this->api_psn->delete($parameterIDPersonal, $tokenAuth);
                if ($deletePersonal == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deletePersonal = $this->api_psn->delete($parameterIDPersonal, $newToken);
                }
                if ($deletePersonal == 200) {
                    foreach ($dataPersonal['data'] as $data) {
                        $nama_file = $data['url_pendukung'];
                        $this->ftp_file->deleteFile($foldername, $nama_file);
                    }
                }
            }

            // Bank
            $parameterBank = [
                'source' => 'tb_bank_kary',
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $dataBank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
            if ($dataBank['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataBank = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterBank);
            }
            if ($dataBank['status'] == 200) {
                $endpointBank = 'hapus_data_bank_personal';
                $parameterDeleteBank = [
                    'id' => $dataBank['data'][0]['id_bank_kary'],
                ];
                $deleteBank = $this->std->api($endpointBank, $this->deleteMethod(), $tokenAuth, $parameterDeleteBank);
                if ($deleteBank == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteBank = $this->std->api($endpointBank, $this->deleteMethod(), $tokenAuth, $parameterDeleteBank);
                }
            }

            // Emergency Contact
            $parameterEc = [
                'source' => 'tb_ec',
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $dataEc = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            if ($dataEc['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataEc = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterEc);
            }
            if ($dataEc['status'] == 200) {
                $endpointEc = 'hapus_data_emergency_contact';
                $parameterDeleteEc = [
                    'id' => $dataEc['data'][0]['id_ec'],
                ];
                $deleteEc = $this->std->api($endpointEc, $this->deleteMethod(), $tokenAuth, $parameterDeleteEc);
                if ($deleteEc == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteEc = $this->std->api($endpointEc, $this->deleteMethod(), $tokenAuth, $parameterDeleteEc);
                }
            }

            // Keluarga
            $parameterKeluarga = [
                'source' => 'tb_keluarga',
                'field' => 'id_personal',
                'value' => $id_personal,
            ];
            $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterKeluarga);
            if ($dataKeluarga['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterKeluarga);
            }
            if ($dataKeluarga['status'] == 200) {
                $endpointKeluarga = 'hapus_keluarga';
                $parameterDeleteKeluarga = [
                    'id' => $dataKeluarga['data'][0]['id_personal'],
                ];
                $deleteKeluarga = $this->std->api($endpointKeluarga, $this->deleteMethod(), $tokenAuth, $parameterDeleteKeluarga);
                if ($deleteKeluarga == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $deleteKeluarga = $this->std->api($endpointKeluarga, $this->deleteMethod(), $tokenAuth, $parameterDeleteKeluarga);
                }
            }

            if ($deleteKaryawan == 200) {
                $ktp = $dataKaryawan['data'][0]['no_ktp'];
                $nama = $dataKaryawan['data'][0]['nama_lengkap'];
                $endpointAudit = 'tambah_audit';
                $parameterAudit = [
                    'jenis' => 'HAPUS',
                    'data' => 'KARYAWAN',
                    'keterangan' => $ktp . ' | ' . $nama,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];

                $audit = $this->std->api($endpointAudit, $this->postMethod(), $tokenAuth, $parameterAudit);
                if ($audit == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $audit = $this->std->api($endpointAudit, $this->postMethod(), $newToken, $parameterAudit);
                }
                echo json_encode(array(
                    'statusCode' => 200,
                    'pesan' => 'Data karyawan berhasil dihapus',
                ));
            } else {
                echo json_encode(array(
                    'statusCode' => 201,
                    'pesan' => 'Data karyawan gagal dihapus',
                ));
            }
        } else {
            echo json_encode(array(
                'statusCode' => 201,
                'pesan' => 'Data karyawan tidak ditemukan',
            ));
        }
    }

    public function create_sertifikasi()
    {
        $this->form_validation->set_rules("jenissrt", "jenissrt", "required|trim", [
            'required' => 'Jenis sertifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("nosrt", "nosrt", "required|trim|max_length[50]", [
            'required' => 'No. Sertifikat wajib diisi',
            'max_length' => 'No. Sertikat maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("tglsrt", "tglsrt", "required|trim", [
            'required' => 'Tanggal sertifikat wajib diisi',
        ]);
        $this->form_validation->set_rules("tglexp", "tglexp", "required|trim", [
            'required' => 'Tanggal expired wajib diisi',
        ]);
        $this->form_validation->set_rules("filesrt", "filesrt", "required|trim", [
            'required' => 'File sertifikat wajib diupload',
        ]);
        $this->form_validation->set_rules("namalembaga", "namalembaga", "required|trim", [
            'required' => 'Nama lembaga wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'jenissrt' => form_error("jenissrt"),
                'nosrt' => form_error("nosrt"),
                'tglsrt' => form_error("tglsrt"),
                'tglexp' => form_error("tglexp"),
                'filesrt' => form_error("filesrt"),
                'namalembaga' => form_error("namalembaga"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $jenisizin = htmlspecialchars($this->input->post("jenissrt", true));
            $nosrt = htmlspecialchars($this->input->post("nosrt", true));
            $tglsrt = htmlspecialchars($this->input->post("tglsrt", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $namalembaga = htmlspecialchars($this->input->post("namalembaga", true));
            $tokenAuth = $this->session->userdata('token');

            if ($auth_person == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }

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
            $nama_file = $now . "-SRT.pdf";

            if ($tglsrt > $tglexp) {
                $error = [
                    'statusCode' => 202,
                    'jenissrt' => "",
                    'nosrt' => "",
                    'tglsrt' => "",
                    'tglexp' => "Isi tanggal expired dengan benar",
                    'filesrt' => "",
                    'namalembaga' => "",
                ];

                echo json_encode($error);
                return;
            }

            $extension = 'pdf';
            $inputName = 'filesertifikat';
            $fileSize = 310;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
            if ($uploadFile == 200) {
                $data_sertifikat = [
                    'id_personal' => $id_personal,
                    'id_jenis_sertifikasi' => $jenisizin,
                    'no_sertifikasi' => $nosrt,
                    'lembaga' => $namalembaga,
                    'tgl_sertifikasi' => $tglsrt,
                    'tgl_berakhir_sertifikasi' => $tglexp,
                    'file_sertifikasi' => $nama_file,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];
                $createSertifikasi = $this->api_srt->create($data_sertifikat, $tokenAuth);
                if ($createSertifikasi == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $createSertifikasi = $this->api_srt->create($data_sertifikat, $newToken);
                }
                if ($createSertifikasi == 201) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data sertifikasi berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data sertifikasi gagal disimpan"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
            }
        }
    }

    public function create_sertifikasi_new()
    {
        $this->form_validation->set_rules("jenis", "jenis", "required|trim", [
            'required' => 'Jenis sertifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("no_ser", "no_ser", "required|trim|max_length[50]", [
            'required' => 'No. Sertifikat wajib diisi',
            'max_length' => 'No. Sertikat maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("tgl_ser", "tgl_ser", "required|trim", [
            'required' => 'Tanggal sertifikat wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_ser", "tgl_akhir_ser", "required|trim", [
            'required' => 'Tanggal expired wajib diisi',
        ]);
        $this->form_validation->set_rules("file_ser", "file_ser", "required|trim", [
            'required' => 'File sertifikat wajib diupload',
        ]);
        $this->form_validation->set_rules("lembaga", "lembaga", "required|trim", [
            'required' => 'Nama lembaga wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'jenis' => form_error("jenis"),
                'nosrt' => form_error("nosrt"),
                'tgl_ser' => form_error("tgl_ser"),
                'tgl_akhir_ser' => form_error("tgl_akhir_ser"),
                'file_ser' => form_error("file_ser"),
                'lembaga' => form_error("lembaga"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $jenis = htmlspecialchars($this->input->post("jenis", true));
            $no_ser = htmlspecialchars($this->input->post("no_ser", true));
            $tgl_ser = htmlspecialchars($this->input->post("tgl_ser", true));
            $tgl_akhir_ser = htmlspecialchars($this->input->post("tgl_akhir_ser", true));
            $lembaga = htmlspecialchars($this->input->post("lembaga", true));
            $tokenAuth = $this->session->userdata('token');

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

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
            $id_personal = $dataKaryawan['data'][0]['id_personal'];
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-SRT.pdf";

            $extension = 'pdf';
            $inputName = 'fl_ser';
            $fileSize = 310;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
            if ($uploadFile == 200) {
                $data_sertifikat = [
                    'id_personal' => $id_personal,
                    'id_jenis_sertifikasi' => $jenis,
                    'no_sertifikasi' => $no_ser,
                    'lembaga' => $lembaga,
                    'tgl_sertifikasi' => $tgl_ser,
                    'tgl_berakhir_sertifikasi' => $tgl_akhir_ser,
                    'file_sertifikasi' => $nama_file,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];
                $createSertifikasi = $this->api_srt->create($data_sertifikat, $tokenAuth);
                if ($createSertifikasi == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $createSertifikasi = $this->api_srt->create($data_sertifikat, $newToken);
                }
                if ($createSertifikasi == 201) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data sertifikasi berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data sertifikasi gagal disimpan"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
            }
        }
    }

    public function get_sertifikasi()
    {
        $auth_sertifikat = htmlspecialchars(trim($this->input->post("auth_sertifikat", true)));
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_sertifikat',
            'value' => $auth_sertifikat,
        ];
        $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($dataSertifikasi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        if ($dataSertifikasi['status'] == 200) {
            $auth_sertifkat = $dataSertifikasi['data'][0]['auth_sertifikat'];
            $jenis_sertifikasi = $dataSertifikasi['data'][0]['jenis_sertifikasi'];
            $id_jenis_sertifikasi = $dataSertifikasi['data'][0]['id_jenis_sertifikasi'];
            $no_sertifikasi = $dataSertifikasi['data'][0]['no_sertifikasi'];
            $lembaga = $dataSertifikasi['data'][0]['lembaga'];
            $tgl_sertifikasi = $dataSertifikasi['data'][0]['tgl_sertifikasi'];
            $tgl_berakhir_sertifikasi = $dataSertifikasi['data'][0]['tgl_berakhir_sertifikasi'];

            echo json_encode(array(
                'statusCode' => 200,
                "auth_sertifikat" => $auth_sertifkat,
                "id_jenis_sertifikasi" => $id_jenis_sertifikasi,
                "jenis_sertifikasi" => $jenis_sertifikasi,
                "no_sertifikasi" => $no_sertifikasi,
                "lembaga" => $lembaga,
                "tgl_sertifikasi" => $tgl_sertifikasi,
                "tgl_sertifikasi_show" => date('d-M-Y', strtotime($tgl_sertifikasi)),
                "tgl_berakhir_sertifikasi" => $tgl_berakhir_sertifikasi,
                "tgl_berakhir_sertifikasi_show" => date('d-M-Y', strtotime($tgl_berakhir_sertifikasi)),
            ));
        } else {
            echo json_encode(array('statusCode' => 201, "pesan" => "Sertifikasi tidak ditemukan"));
        }
    }

    public function upload_sertifikasi()
    {
        $auth_ser = htmlspecialchars($this->input->post("auth_ser", true));
        $auth_person = htmlspecialchars($this->input->post("auth_person", true));
        $tokenAuth = $this->session->userdata('token');

        if ($auth_person == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            return;
        }

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

        $parameter = [
            'field' => 'auth_sertifikat',
            'value' => $auth_ser,
        ];
        $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($dataSertifikasi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        $data_ser = $this->srt->get_sertifikasi_id($auth_ser);

        if ($dataSertifikasi['status'] == 200) {
            $id_ser = $dataSertifikasi['data'][0]['id_sertifikasi'];
            $nama_file = $dataSertifikasi['data'][0]['file_sertifikasi'];

            if ($nama_file == "") {
                $now = date('YmdHis');
                $nama_file = $now . "-SRT.pdf";
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data Sertifikasi tidak ditemukan"));
            die;
        }

        $extension = 'pdf';
        $inputName = 'filesertifikat';
        $fileSize = 310;
        $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
        if ($uploadFile == 200) {
            $dt_ser = array(
                'file_sertifikasi' => $nama_file,
            );
            $update = $this->api_srt->update_file($dt_ser, $tokenAuth);
            if ($update == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $update = $this->api_srt->update_file($dt_ser, $newToken);
            }
            if ($update == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "File sertifikasi berhasil diupload"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "File sertifikasi gagal diupload"));
            }
        } elseif ($uploadFile == 400) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
        } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file sertifikasi"));
        }
    }

    public function delete_sertifikasi()
    {
        $auth_sertifikasi = htmlspecialchars(trim($this->input->post('auth_Sertifikat', true)));
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'field' => 'auth_sertifikat',
            'value' => $auth_sertifikasi,
        ];
        $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $tokenAuth);
        if ($dataSertifikasi['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSertifikasi = $this->api_srt->read_data_sertifikasi($parameter, $newToken);
        }
        if ($dataSertifikasi['status'] == 404) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Sertifikasi tidak ditemukan"));
            return;
        }

        $id = $dataSertifikasi['data'][0]['id_sertifikasi'];
        $folderName = md5($dataSertifikasi['data'][0]['id_personal']);
        $fileName = $dataSertifikasi['data'][0]['file_sertifikasi'];
        $parameterDelete = [
            'id_sertifikasi' => $id,
        ];
        $delete = $this->api_srt->delete($parameterDelete, $tokenAuth);
        if ($delete == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $delete = $this->api_srt->delete($parameterDelete, $newToken);
        }

        if ($delete == 200) {
            $this->ftp_file->deleteFile($folderName, $fileName);
            echo json_encode(array("statusCode" => 200, "pesan" => "Sertifikasi berhasil dihapus"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Sertifikasi gagal dihapus"));
        }
    }

    public function create_mcu()
    {
        $this->form_validation->set_rules("tglmcu", "tglmcu", "required|trim", [
            'required' => 'Tanggal MCU wajib dipilih',
        ]);
        $this->form_validation->set_rules("hasilmcu", "hasilmcu", "required|trim|max_length[50]", [
            'required' => 'Hasil MCU wajib dipilih',
            'max_length' => 'Hasil MCU maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("ketmcu", "ketmcu", "required|trim", [
            'required' => 'Keterangan MCU wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'tglmcu' => form_error("tglmcu"),
                'hasilmcu' => form_error("hasilmcu"),
                'ketmcu' => form_error("ketmcu"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
            $tglmcu = htmlspecialchars($this->input->post("tglmcu", true));
            $hasilmcu = htmlspecialchars($this->input->post("hasilmcu", true));
            $ketmcu = htmlspecialchars($this->input->post("ketmcu", true));
            $tokenAuth = $this->session->userdata('token');
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
            $nama_file = $now . "-MCU.pdf";

            if (empty($auth_person)) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            } else {
                if ($dataPersonal['status'] == 404) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                    return;
                }
            }

            if (!empty($auth_mcu)) {
                $parameterCheckMCU = [
                    'field' => 'auth_mcu',
                    'value' => $auth_mcu,
                ];
                $dataMCU = $this->api_kry->read_specific_data_mcu($parameterCheckMCU, $tokenAuth);
                if ($dataMCU['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataMCU = $this->api_kry->read_specific_data_mcu($parameterCheckMCU, $newToken);
                }

                if ($dataMCU['status'] == 404) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU tidak ditemukan"));
                    return;
                }

                $id_mcu = $dataMCU['data'][0]['id_mcu'];
                $flemcu = $dataMCU['data'][0]['url_file'];

                if ($id_mcu != "") {
                    $extension = 'pdf';
                    $inputName = 'filemedik';
                    $fileSize = 1010;
                    $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
                    if ($uploadFile == 200) {
                        if ($flemcu != "") {
                            $deleteFile = $this->ftp_file->deleteFile($foldername, $flemcu);
                            if ($deleteFile == 400) {
                                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
                                return;
                            }
                        }

                        $dtmcu = array(
                            'id_mcu' => $id_mcu,
                            'id_mcu_jenis' => $hasilmcu,
                            'tgl_mcu' => $tglmcu,
                            'ket_mcu' => $ketmcu,
                            'url_file' => $nama_file,
                        );

                        $updateMCU = $this->api_kry->update_mcu($dtmcu, $tokenAuth);
                        if ($updateMCU == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $updateMCU = $this->api_kry->update_mcu($dtmcu, $newToken);
                        }
                        if ($updateMCU == 200) {
                            echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil diupdate"));
                            return;
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal diupdate"));
                        }
                    } elseif ($uploadFile == 400) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file mcu"));
                    } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file mcu"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Gagal memanggil data MCU"));
                }
            } else {
                $extension = 'pdf';
                $inputName = 'filemedik';
                $fileSize = 1010;
                $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $data_mcu = [
                        'id_personal' => $id_personal,
                        'id_mcu_jenis' => $hasilmcu,
                        'tgl_mcu' => $tglmcu,
                        'ket_mcu' => $ketmcu,
                        'url_file' => $nama_file,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];
                    $createMCU = $this->api_kry->create_mcu($data_mcu, $tokenAuth);
                    if ($createMCU == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $createMCU = $this->api_kry->create_mcu($data_mcu, $newToken);
                    }
                    if ($createMCU == 201) {
                        $lastMCU = $this->api_kry->lastest_mcu($tokenAuth);
                        if ($lastMCU['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($tokenAuth);
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastMCU = $this->api_kry->lastest_mcu($newToken);
                        }
                        $auth_mcu = $lastMCU['data'][0]['auth_mcu'];
                        $link = base_url('Mcu_api/checkFile/' . $auth_mcu);
                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data MCU berhasil disimpan",
                            "auth_mcu" => $auth_mcu,
                            "filemcu" => $nama_file,
                            "link" => $link,
                        ));
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal disimpan"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file mcu"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file mcu"));
                }
            }
        }
    }

    public function create_mcu_new()
    {
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $tglMCU = htmlspecialchars($this->input->post("tglMCU", true));
        $hasilMCU = htmlspecialchars($this->input->post("hasilMCU", true));
        $ketMCU = htmlspecialchars(trim($this->input->post("ketMCU", true)));
        $tokenAuth = $this->session->userdata('token');
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }

        if ($dataKaryawan['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }
        $id_personal = $dataKaryawan['data'][0]['id_personal'];

        if ($auth_kary == "") {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }

        $foldername = md5($id_personal);
        $now = date('YmdHis');
        $nama_file = $now . "-MCU.pdf";

        $extension = 'pdf';
        $inputName = 'fl_MCU';
        $fileSize = 1010;
        $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
        if ($uploadFile == 200) {
            $data_mcu = [
                'id_personal' => $id_personal,
                'id_mcu_jenis' => $hasilMCU,
                'tgl_mcu' => $tglMCU,
                'ket_mcu' => $ketMCU,
                'url_file' => $nama_file,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];
            $createMCU = $this->api_kry->create_mcu($data_mcu, $tokenAuth);
            if ($createMCU == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $createMCU = $this->api_kry->create_mcu($data_mcu, $newToken);
            }
            if ($createMCU == 201) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Data MCU berhasil disimpan",
                ));
            } else {
                echo json_encode(array("statusCode" => 202, "pesan" => "Data MCU gagal disimpan"));
            }
        } elseif ($uploadFile == 400) {
            echo json_encode(array("statusCode" => 202, "pesan" => "File MCU gagal diupload"));
        } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Server error, hubungi administrator"));
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "File MCU gagal diupload"));
        }
    }

    public function delete_mcu()
    {
        $auth_mcu = htmlspecialchars(trim($this->input->post('auth_mcu', true)));
        $tokenAuth = $this->session->userdata('token');
        $parameterCheckMCU = [
            'field' => 'auth_mcu',
            'value' => $auth_mcu,
        ];
        $dataMCU = $this->api_kry->read_specific_data_mcu($parameterCheckMCU, $tokenAuth);
        if ($dataMCU['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataMCU = $this->api_kry->read_specific_data_mcu($parameterCheckMCU, $newToken);
        }

        if ($dataMCU['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }

        $id_personal = $dataMCU['data'][0]['id_personal'];
        $nama_file = $dataMCU['data'][0]['url_file'];
        $id_perusahaan = $dataMCU['data'][0]['id_m_perusahaan'];
        $namafolder = md5($id_personal);

        $parameterHapus = [
            'id_mcu' => $dataMCU['data'][0]['id_mcu'],
        ];
        $hapusMCU = $this->api_kry->delete_mcu($parameterHapus, $tokenAuth);
        if ($hapusMCU == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $hapusMCU = $this->api_kry->delete_mcu($parameterHapus, $newToken);
        }
        if ($hapusMCU == 200) {
            $this->ftp_file->deleteFile($namafolder, $nama_file);
            echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal dihapus"));
            return;
        }
    }

    public function check_mcu()
    {
        $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
        $auth_person = htmlspecialchars($this->input->post("auth_person", true));
        $tokenAuth = $this->session->userdata('token');

        if (!empty($auth_person)) {
            if (!empty($auth_mcu)) {
                $parameterCheckMCU = [
                    'field' => 'auth_mcu',
                    'value' => $auth_mcu,
                ];
                $dataMCU = $this->api_kry->read_specific_data_mcu($parameterCheckMCU, $tokenAuth);
                if ($dataMCU['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataMCU = $this->api_psn->read_specific_data_mcu($parameterCheckMCU, $newToken);
                }
                if ($dataMCU['status'] == 404) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data MCU belum di-input"));
                } else {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data MCU belum di-input"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data personal belum di-input"));
        }
    }

    public function checkKTP()
    {
        $this->form_validation->set_rules("noktp", "noktp", "required|trim|max_length[20]", [
            'required' => 'No. KTP wajib diisi',
            'max_length' => 'No. KTP maksimal 16 karakter',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 201,
                'noktp' => form_error("noktp"),
            ];

            echo json_encode($error);
            return;
        } else {
            $noktp = htmlspecialchars($this->input->post("noktp", true));
            $tokenAuth = $this->session->userdata("token");
            $parameterNOKTP = [
                'field' => 'no_ktp',
                'value' => $noktp,
            ];
            $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $tokenAuth);
            if ($checkNOKTP['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $checkNOKTP = $this->api_psn->read_specific_data($parameterNOKTP, $newToken);
            }

            if (empty($checkNOKTP['data'])) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Data personal dengan No. KTP : " . $noktp . ", belum ada, silahkan lengkapi data selanjutnya",
                    "auth_personal" => "",
                ));
                return;
            } else {
                $parameterKTPKaryawan = [
                    'field' => 'no_ktp',
                    'value' => $noktp,
                ];
                $checkKTP = $this->api_kry->read_specific_data($parameterKTPKaryawan, $tokenAuth);
                if ($checkKTP['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $checkKTP = $this->api_kry->read_specific_data($parameterKTPKaryawan, $newToken);
                }
                if ($checkKTP['data'][0]['tgl_nonaktif'] == null) {
                    $data = [
                        "statusCode" => 201,
                        "pesan" => 'Proses tidak dapat dilanjutkan, Data karyawan :',
                        "no_ktp" => $checkKTP['data'][0]['no_ktp'],
                        "nama_lengkap" => $checkKTP['data'][0]['nama_lengkap'],
                        "tgl_nonaktif" => date('d-M-Y', strtotime($checkKTP['data'][0]['tgl_nonaktif'])),
                        "lama_nonaktif" => "0 Hari",
                        "perusahaan" => $checkKTP['data'][0]['nama_perusahaan'],
                        "status" => 'AKTIF',
                    ];
                    echo json_encode($data);
                    return;
                } else {
                    $tgl_nonaktif = strtotime(date('Y-m-d', strtotime($checkKTP['data'][0]['tgl_nonaktif'])));
                    $tgl_Sekarang = strtotime(date('Y-m-d'));
                    $jarak = $tgl_Sekarang - $tgl_nonaktif;
                    $hari = $jarak / 60 / 60 / 24;

                    if ($hari > 90) {
                        $parameter = [
                            'field' => 'id_personal',
                            'value' => $checkNOKTP['data'][0]['id_personal'],
                            'field2' => 'stat_alamat_ktp',
                            'value2' => 'T',
                        ];
                        $alamatKaryawan = $this->api_kry->read_data_alamat($parameter, $tokenAuth);
                        if ($alamatKaryawan['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $alamatKaryawan = $this->api_kry->read_data_alamat($parameter, $newToken);
                        }
                        if (!empty($alamatKaryawan['data'])) {
                            $alamat = $alamatKaryawan['data'][0]['alamat_ktp'];
                            $prov = $alamatKaryawan['data'][0]['prov_ktp'];
                            $kab = $alamatKaryawan['data'][0]['kab_ktp'];
                            $kec = $alamatKaryawan['data'][0]['kec_ktp'];
                            $kel = $alamatKaryawan['data'][0]['kel_ktp'];
                            $rt = $alamatKaryawan['data'][0]['rt_ktp'];
                            $rw = $alamatKaryawan['data'][0]['rw_ktp'];
                            $auth_alamat = $alamatKaryawan['data'][0]['auth_alamat'];
                        } else {
                            $alamat = '';
                            $prov = '';
                            $kab = '';
                            $kec = '';
                            $kel = '';
                            $rt = '';
                            $rw = '';
                            $auth_alamat = '';
                        }

                        $data = [
                            "statusCode" => 202,
                            "pesan" => 'Data berhasil ditemukan',
                            "auth_personal" => $checkNOKTP['data'][0]['auth_personal'],
                            "auth_alamat" => $auth_alamat,
                            "no_ktp" => $checkNOKTP['data'][0]['no_ktp'],
                            "nama" => $checkNOKTP['data'][0]['nama_lengkap'],
                            "alamat" => $alamat,
                            "rt" => $rt,
                            "rw" => $rw,
                            "kel" => $kel,
                            "kec" => $kec,
                            "kab" => $kab,
                            "prov" => $prov,
                            "warga_negara" => $checkNOKTP['data'][0]['warga_negara'],
                            "agama" => $checkNOKTP['data'][0]['id_agama'],
                            "jk" => $checkNOKTP['data'][0]['jk'],
                            "stat_nikah" => $checkNOKTP['data'][0]['id_stat_nikah'],
                            "tmp_lahir" => $checkNOKTP['data'][0]['tmp_lahir'],
                            "tgl_lahir" => $checkNOKTP['data'][0]['tgl_lahir'],
                            "bpjs_tk" => $checkNOKTP['data'][0]['no_bpjstk'],
                            "bpjs_ks" => $checkNOKTP['data'][0]['no_bpjstk'],
                            "npwp" => $checkNOKTP['data'][0]['no_npwp'],
                            "no_kk" => $checkNOKTP['data'][0]['no_kk'],
                            "email_pribadi" => $checkNOKTP['data'][0]['email_pribadi'],
                            "no_telp" => $checkNOKTP['data'][0]['hp_1'],
                            "didik_terakhir" => $checkNOKTP['data'][0]['id_pendidikan'],
                            "sekolah" => $checkNOKTP['data'][0]['nama_sekolah'],
                            "fakultas" => $checkNOKTP['data'][0]['fakultas'],
                            "jurusan" => $checkNOKTP['data'][0]['jurusan'],
                        ];

                        echo json_encode($data);
                        return;
                    } else {
                        $parameterKTPKaryawan = [
                            'field' => 'no_ktp',
                            'value' => $noktp,
                        ];
                        $checkKTP = $this->api_kry->read_specific_data($parameterKTPKaryawan, $tokenAuth);
                        if ($checkKTP['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $checkKTP = $this->api_kry->read_specific_data($parameterKTPKaryawan, $newToken);
                        }
                        if (!empty($checkKTP['data'])) {
                            $data = [
                                "statusCode" => 201,
                                "pesan" => 'Proses tidak dapat dilanjutkan, Data karyawan :',
                                "no_ktp" => $checkKTP['data'][0]['no_ktp'],
                                "nama_lengkap" => $checkKTP['data'][0]['nama_lengkap'],
                                "tgl_nonaktif" => date('d-M-Y', strtotime($checkKTP['data'][0]['tgl_nonaktif'])),
                                "lama_nonaktif" => $hari . " Hari",
                                "perusahaan" => $checkKTP['data'][0]['nama_perusahaan'],
                                "status" => 'NONAKTIF',
                            ];
                        }

                        echo json_encode($data);
                        return;
                    }
                }
            }
        }
    }

    public function check_vaksin()
    {
        $this->form_validation->set_rules("auth_person", "auth_person", "required|trim", [
            'required' => 'Data personal tidak ditemukan',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 201,
                'auth_person' => form_error("auth_person"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $tokenAuth = $this->session->userdata('token');
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

            if ($id_personal != "") {
                $parameter = [
                    'field' => 'id_personal',
                    'value' => $id_personal,
                ];
                $check = $this->api_kry->specific_vaksin($parameter, $tokenAuth);
                if ($check['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $check = $this->api_kry->specific_vaksin($parameter, $newToken);
                }
                if ($check['status'] == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin wajib diisi"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin tidak ada"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
            }
        }
    }

    public function create_vaksin()
    {
        $this->form_validation->set_rules("jenisvaksin", "jenisvaksin", "required|trim", [
            'required' => 'Jenis vaksin wajib dipilih',
        ]);
        $this->form_validation->set_rules("namavaksin", "namavaksin", "required|trim|max_length[20]", [
            'required' => 'Nama vaksin wajib diisi',
            'max_length' => 'Nama vaksin maksimal 20 karakter',
        ]);
        $this->form_validation->set_rules("tglvaksin", "tglvaksin", "required|trim", [
            'required' => 'Tanggal vaksin wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'jenisvaksin' => form_error("jenisvaksin"),
                'namavaksin' => form_error("namavaksin"),
                'tglvaksin' => form_error("tglvaksin"),
            ];

            echo json_encode($error);
            return;
        } else {
            $jenisvaksin = htmlspecialchars($this->input->post("jenisvaksin", true));
            $namavaksin = htmlspecialchars($this->input->post("namavaksin", true));
            $tglvaksin = htmlspecialchars($this->input->post("tglvaksin", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $tokenAuth = $this->session->userdata('token');
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
            $now = date("Y-m-d");

            if (empty($auth_person)) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                die;
            }

            if ($tglvaksin > $now) {
                echo json_encode(array("statusCode" => 202, "tglvaksin" => "Isi tanggal vaksin dengan benar"));
                die;
            }

            if ($id_personal != "") {
                $data_vaksin = [
                    'id_personal' => $id_personal,
                    'id_vaksin_jenis' => $jenisvaksin,
                    'tgl_vaksin' => $tglvaksin,
                    'id_vaksin_nama' => $namavaksin,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];
                $create = $this->api_kry->create_vaksin($data_vaksin, $tokenAuth);
                if ($create == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $create = $this->api_kry->create_vaksin($data_vaksin, $newToken);
                }
                if ($create == 201) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal disimpan"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
            }
        }
    }

    public function create_vaksin_new()
    {
        $jenisVaksin = htmlspecialchars($this->input->post("jenisVaksin", true));
        $namaVaksin = htmlspecialchars($this->input->post("namaVaksin", true));
        $tanggalVaksin = htmlspecialchars($this->input->post("tanggalVaksin", true));
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $tokenAuth = $this->session->userdata('token');
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }

        if ($dataKaryawan['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }
        $id_personal = $dataKaryawan['data'][0]['id_personal'];
        $now = date("Y-m-d");

        if ($auth_kary == "") {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }

        $data_vaksin = [
            'id_personal' => $id_personal,
            'id_vaksin_jenis' => $jenisVaksin,
            'tgl_vaksin' => $tanggalVaksin,
            'id_vaksin_nama' => $namaVaksin,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];
        $create = $this->api_kry->create_vaksin($data_vaksin, $tokenAuth);
        if ($create == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $create = $this->api_kry->create_vaksin($data_vaksin, $newToken);
        }
        if ($create == 201) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil disimpan"));
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data vaksin gagal disimpan"));
        }
    }

    public function delete_vaksin()
    {
        $auth_vaksin = htmlspecialchars(trim($this->input->post('auth_vaksin', true)));
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_vaksin',
            'value' => $auth_vaksin,
        ];
        $dataVaksin = $this->api_kry->specific_vaksin($parameter, $tokenAuth);
        if ($dataVaksin['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataVaksin = $this->api_kry->specific_vaksin($parameter, $newToken);
        }

        if ($dataVaksin['status'] == 200) {
            $id = $dataVaksin['data'][0]['id_vaksin'];

            $parameterDelete = [
                'id_vaksin' => $id,
            ];
            $delete = $this->api_kry->delete_vaksin($parameterDelete, $tokenAuth);
            if ($delete == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $delete = $this->api_kry->delete_vaksin($parameterDelete, $newToken);
            }
            if ($delete == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil dihapus"));
                return;
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal dihapus"));
                return;
            }
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data vaksin tidak ditemukan"));
            return;
        }
    }

    public function create_kontrak()
    {
        $auth = htmlspecialchars(trim($this->input->post('auth', true)));
        $status = htmlspecialchars(trim($this->input->post('status', true)));
        $tanggalPermanen = htmlspecialchars(trim($this->input->post('tanggalPermanen', true)));
        $tanggalAwal = htmlspecialchars(trim($this->input->post('tanggalAwal', true)));
        $tanggalAkhir = htmlspecialchars(trim($this->input->post('tanggalAkhir', true)));
        $tokenAuth = $this->session->userdata('token');

        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }
        if ($dataKaryawan['status'] != 200) {
            echo json_encode(array("statusCode" => 404, "pesan" => "Data Karyawan tidak ditemukan"));
            return;
        }
        $idKaryawan = $dataKaryawan['data'][0]['id_kary'];

        if ($status == 1) {
            $parameter = [
                'id_kary' => $idKaryawan,
                'id_stat_perjanjian' => $status,
                'tgl_mulai' => $tanggalPermanen,
                'tgl_akhir' => '1970-01-01',
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];
        } else {
            $parameter = [
                'id_kary' => $idKaryawan,
                'id_stat_perjanjian' => $status,
                'tgl_mulai' => $tanggalAwal,
                'tgl_akhir' => $tanggalAkhir,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];
        }
        $createKontrak = $this->api_kry->create_kontrak_karyawan($parameter, $tokenAuth);
        if ($createKontrak == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $createKontrak = $this->api_kry->create_kontrak_karyawan($parameter, $newToken);
        }
        if ($createKontrak == 201) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data Kontrak Kerja berhasil ditambahkan!"));
        } else {
            echo json_encode(array("statusCode" => 400, "pesan" => "Data Kontrak Kerja gagal ditambahkan!"));
        }
    }

    public function delete_kontrak()
    {
        $auth_kontrak = htmlspecialchars(trim($this->input->post('auth_kontrak', true)));
        $tokenAuth = $this->session->userdata('token');

        $parameterData = [
            'field' => 'auth_kontrak_kary',
            'value' => $auth_kontrak,
        ];
        $data = $this->api_kry->specific_kontrak_karyawan($parameterData, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_kry->specific_kontrak_karyawan($parameterData, $newToken);
        }
        if ($data['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data Kontrak Kerja tidak ditemukan"));
            return;
        }

        $parameter = [
            'field' => 'id_kontrak_kary',
            'value' => $auth_kontrak,
        ];
        $deleteKontrak = $this->api_kry->delete_kontrak_karyawan($parameter, $tokenAuth);
        if ($deleteKontrak == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $deleteKontrak = $this->api_kry->delete_kontrak_karyawan($parameter, $newToken);
        }
        if ($deleteKontrak == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data Kontrak Kerja berhasil dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data Kontrak Kerja gagal dihapus"));
            return;
        }
    }

    public function check_file()
    {
        $auth_person = htmlspecialchars($this->input->post("auth_person", true));
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
        $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
        $tokenAuth = $this->session->userdata('token');
        if ($auth_person == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            return;
        }

        if ($auth_kary == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }

        if ($auth_izin == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data SIMPER/Mine Permit tidak ditemukan"));
            return;
        }

        if ($auth_mcu == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }

        $parameter = [
            'field' => 'auth_personal',
            'value' => $auth_person,
        ];
        $check = $this->api_kry->specific_vaksin($parameter, $tokenAuth);
        if ($check['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $check = $this->api_kry->specific_vaksin($parameter, $newToken);
        }
        if ($check['status'] == 404) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin tidak ditemukan"));
            return;
        }

        // ======= cek foto =============
        $fotoname = $_FILES['flfoto']['name'];
        $fototype = $_FILES['flfoto']['type'];
        $fotosize = $_FILES['flfoto']['size'];

        if ($fotoname == "" || $fotoname == "Pilih file foto karyawan") {
            echo json_encode(array(
                "statusCode" => 202,
                "filefoto" => "Foto karyawan wajib diupload.",
                "filedukung" => "",
            ));
            return;
        }

        if ($fototype != "image/jpeg") {
            echo json_encode(array(
                "statusCode" => 202,
                "filefoto" => "Format file foto yang diupload wajib dalam bentuk jpg.",
                "filedukung" => "",
            ));
            return;
        }

        if ($fotosize > 100000) {
            echo json_encode(array(
                "statusCode" => 202,
                "filefoto" => "Ukuran file maksimal 100kb.",
                "filedukung" => "",
            ));
            return;
        }

        // ========= cek pendukung =============
        $dukungname = $_FILES['fldukung']['name'];
        $dukungtype = $_FILES['fldukung']['type'];
        $dukungsize = $_FILES['fldukung']['size'];

        if ($dukungname == "" || $dukungname == "Pilih file pendukung") {
            echo json_encode(array(
                "statusCode" => 202,
                "filedukung" => "File pedukung wajib diupload.",
                "filefoto" => "",
            ));
            return;
        }

        if ($dukungtype != "application/pdf") {
            echo json_encode(array(
                "statusCode" => 202,
                "filedukung" => "Format file pendukung yang diupload wajib dalam bentuk pdf.",
                "filefoto" => "",
            ));
            return;
        }

        if ($dukungsize > 1000000) {
            echo json_encode(array(
                "statusCode" => 202,
                "filedukung" => "Ukuran file maksimal 1000kb/1mb.",
                "filefoto" => "",
            ));
            return;
        }

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
        if ($dataPersonal['status'] == 200) {
            $id_personal = $dataPersonal['data'][0]['id_personal'];

            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $namafile = $now . "-SUPPORT.pdf";
            $nama_file = $now . "-FOTO.jpg";

            $parameterIDKaryawan = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
            }
            $id_kary = $dataKaryawan['data'][0]['id_kary'];

            $extensionPendukung = 'pdf';
            $inputNamePendukung = 'fldukung';
            $fileSizePendukung = 1010;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extensionPendukung, $inputNamePendukung, $fileSizePendukung, $namafile);
            $extensionFoto = 'jpg|jpeg';
            $inputNameFoto = 'flfoto';
            $fileSizeFoto = 110;
            $uploadFoto = $this->ftp_file->uploadFile($foldername, $extensionFoto, $inputNameFoto, $fileSizeFoto, $nama_file);
            if ($uploadFile == 200 || $uploadFoto == 200) {
                $dtfoto = [
                    'id_karyawan' => $id_kary,
                    'url_foto' => $nama_file,
                ];
                $updateFoto = $this->api_kry->update_foto($dtfoto, $tokenAuth);
                if ($updateFoto == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $updateFoto = $this->api_kry->update_foto($dtfoto, $newToken);
                }

                $dtdukung = [
                    'id_personal' => $id_personal,
                    'url_pendukung' => $namafile,
                ];
                $updateFilePendukung = $this->api_psn->update_file_pendukung($dtdukung, $tokenAuth);
                if ($updateFilePendukung == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $updateFilePendukung = $this->api_psn->update_file_pendukung($dtdukung, $newToken);
                }
                echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil disimpan"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal disimpan"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal karyawan tidak ditemukan"));
        }
    }

    public function get_stat_waktu()
    {
        $stat_kary = htmlspecialchars($this->input->post("stat_kary", true));
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'field' => 'id_stat_perjanjian',
            'value' => $stat_kary,
        ];
        $result = $this->api_kry->specific_perjanjian_kerja($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->specific_perjanjian_kerja($parameter, $newToken);
        }
        if ($result['status'] == 404) {
            echo json_encode(array("statusCode" => 201, "stat_waktu" => '', "pesan" => "Kesalahan dalam mengambil data status karyawan"));
            return;
        } else {
            echo json_encode(array("statusCode" => 200, "stat_waktu" => $result['data'][0]['stat_waktu'], "pesan" => "Sukses"));
            return;
        }
    }

    // Data Select Options
    public function dataAgama()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->agama($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->agama($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH AGAMA --</option>";
            foreach ($result['data'] as $agm) {
                $output = $output . "<option value=" . $agm['id_agama'] . ">" . $agm['agama'] . "</option>";
            }
        } else {
            $output = "<option value=''>-- Agama tidak ditemukan --</option>";
        }

        echo json_encode(array("agama" => $output));
    }

    public function dataStatusNikah()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->status_nikah($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->status_nikah($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH STATUS PERNIKAHAN --</option>";
            foreach ($result['data'] as $stt) {
                $output = $output . "<option value=" . $stt['id_stat_nikah'] . ">" . $stt['stat_nikah'] . "</option>";
            }
        } else {
            $output = "<option value=''>-- STATUS PERNIKAHAN TIDAK DITEMUKAN --</option>";
        }

        echo json_encode(array("statnikah" => $output));
    }

    public function dataJenisMCU()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->jenis_mcu($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->jenis_mcu($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH JENIS MCU --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . " <option value='" . $list['id_mcu_jenis'] . "'>" . $list['mcu_jenis'] . "</option>";
            }

            echo json_encode(array("statusCode" => 200, "jmcu" => $output, "pesan" => "Sukses"));
        } else {
            $output = "<option value=''>-- Hasil MCU tidak ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "jmcu" => $output, "pesan" => "Sukses"));
        }
    }

    public function dataUnitSimper()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_unt->read_all_data($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_unt->read_all_data($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- Pilih Unit --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_unit'] . "'>" . $list['unit'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "unit" => $output));
        } else {
            $output = "<option value=''>-- Unit tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "unit" => $output));
        }
    }

    public function dataJenisVaksin()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_vks->jenis_vaksin($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_vks->jenis_vaksin($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- Pilih Jenis Vaksin --</option> ";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_vaksin_jenis'] . "'>" . $list['vaksin_jenis'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "jvks" => $output));
        } else {
            $output = "<option value=''>-- Jenis vaksin tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "jvks" => $output));
        }
    }

    public function dataNamaVaksin()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_vks->nama_vaksin($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_vks->nama_vaksin($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- Pilih Nama Vaksin --</option> ";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_vaksin_nama'] . "'>" . $list['vaksin_nama'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "nvks" => $output));
        } else {
            $output = "<option value=''>-- Nama vaksin tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "nvks" => $output));
        }
    }

    public function dataTipeAkses()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_izt->tipe_akses($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_izt->tipe_akses($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- Pilih Tipe Akses --</option> ";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_tipe_akses_unit'] . "'>" . $list['tipe_akses_unit'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "akses" => $output));
        } else {
            $output = "<option value=''>-- Tipe akses tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "akses" => $output));
        }
    }

    public function dataPendidikan()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->pendidikan($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->pendidikan($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH PENDIDIKAN --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_pendidikan'] . "'>" . $list['pendidikan'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "pdk" => $output));
        } else {
            $output = "<option value=''>-- PENDIDIKAN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "pdk" => $output));
        }
    }

    public function dataResident()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->resident($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->resident($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH STATUS RESIDENCE --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_stat_tinggal'] . "'>" . $list['stat_tinggal'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "tgl" => $output));
        } else {
            $output = "<option value=''>-- STATUS RESIDENCE TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "tgl" => $output));
        }
    }

    public function dataKlasifikasi()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->klasifikasi($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->klasifikasi($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH KLASIFIKASI --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_klasifikasi'] . "'>" . $list['klasifikasi'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "kls" => $output));
        } else {
            $output = "<option value=''>-- KLASIFIKASI TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "kls" => $output));
        }
    }

    public function dataJenisSIM()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->jenis_sim($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->jenis_sim($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH SIM --</option>";
            foreach ($result['data'] as $sim) {
                $output = $output . "<option value=" . $sim['id_sim'] . ">" . $sim['sim'] . "</option>";
            }
        } else {
            $output = "<option value=''>-- SIM tidak ditemukan --</option>";
        }

        echo json_encode(array("siim" => $output));
    }

    public function dataPOH()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_poh->read_all_data($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_poh->read_all_data($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH POH --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_poh'] . "'>" . $list['poh'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "poh" => $output, "tipe_pesan" => "success"));
        } else {
            $output = "<option value=''>-- POH TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "poh" => $output, "tipe_pesan" => "error"));
        }
    }

    public function dataLokasiKerja()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_lkr->read_all_data($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lkr->read_all_data($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH LOKASI KERJA --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_lokker'] . "'>" . $list['lokker'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "lkr" => $output, "tipe_pesan" => "success"));
        } else {
            $output = "<option value=''>-- LOKASI KERJA TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "lkr" => $output, "tipe_pesan" => "error"));
        }
    }

    public function dataStatusPerjanjian()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->perjanjian_kerja($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->perjanjian_kerja($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH STATUS KARYAWAN --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_stat_perjanjian'] . "'>" . $list['stat_perjanjian'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "janji" => $output));
        } else {
            $output = "<option value=''>-- STATUS KARYAWAN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "janji" => $output));
        }
    }

    public function dataGolongan()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_gol->read_all_data($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_gol->read_all_data($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH GOLONGAN --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . " <option value='" . $list['id_tipe'] . "'>" . $list['tipe'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "tipe" => $output, "pesan" => "Sukses"));
        } else {
            $output = "<option value=''>-- GOLONGAN TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "tipe" => $output, "pesan" => "Sukses"));
        }
    }

    public function dataJenisSertifikasi()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_srt->read_all_data_jenis($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_srt->read_all_data_jenis($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- Pilih Jenis Sertifikasi --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_jenis_sertifikasi'] . "'>" . $list['jenis_sertifikasi'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "srt" => $output));
        } else {
            $output = "<option value=''>-- Jenis sertifikasi tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "srt" => $output));
        }
    }

    public function dataLokasiPenerimaan()
    {
        $tokenAuth = $this->session->userdata("token");
        $result = $this->api_kry->lokasi_penerimaan($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_kry->lokasi_penerimaan($newToken);
        }
        if (!empty($result['data'])) {
            $output = "<option value=''>-- PILIH LOKASI PENERIMAAN --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['auth_lokterima'] . "'>" . $list['lokterima'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "lkt" => $output));
        } else {
            $output = "<option value=''>-- LOKASI PENERIMAAN TIDAK ADA --</option>";
            echo json_encode(array("statusCode" => 201, "lkt" => $output));
        }
    }

    public function dataPaybase()
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'source' => 'tb_paybase',
            'field' => 'stat_paybase',
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
            $output = "<option value=''>-- PILIH PAYBASE --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_paybase'] . "'>" . $list['paybase'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "options" => $output));
        } else {
            $output = "<option value=''>-- PAYBASE TIDAK ADA --</option>";
            echo json_encode(array("statusCode" => 201, "options" => $output));
        }
    }

    public function dataPajak()
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'source' => 'tb_statpajak',
            'field' => 'stat_aktif_pajak',
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
            $output = "<option value=''>-- PILIH STATUS PAJAK --</option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id_statpajak'] . "'>" . $list['stat_pajak'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "options" => $output));
        } else {
            $output = "<option value=''>-- STATUS PAJAK TIDAK ADA --</option>";
            echo json_encode(array("statusCode" => 201, "options" => $output));
        }
    }
}
