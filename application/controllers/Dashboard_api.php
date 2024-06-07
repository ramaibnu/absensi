<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_api extends MY_Controller
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
        $parameterStruktur = [
            'field' => 'stat_m_perusahaan',
            'value' => 'T',
        ];
        $dataStruktur = $this->api_str->read_specific_data($parameterStruktur, $tokenAuth);
        if ($dataStruktur['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataStruktur = $this->api_str->read_specific_data($parameterStruktur, $newToken);
        }

        $authStruktur = [];
        foreach ($dataStruktur['data'] as $key) {
            $authStruktur[] = intval($key['id_m_perusahaan']);
        }
        sort($authStruktur);

        $parameterPerusahaan = [
            'condition' => $authStruktur,
        ];
        $this->session->unset_userdata('parameterDashboard');
        $this->session->set_userdata('parameterDashboard', $parameterPerusahaan);

        $resultTotalKaryawan = $this->api_dsb->count_all_karyawan($parameterPerusahaan, $tokenAuth);
        if ($resultTotalKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resultTotalKaryawan = $this->api_dsb->count_all_karyawan($parameterPerusahaan, $newToken);
        }
        if ($resultTotalKaryawan['status'] == 200) {
            $jml_karyawan = $resultTotalKaryawan['data'];
        } else {
            $jml_karyawan = [];
        }

        $resultTotalKaryawanBaru = $this->api_dsb->count_all_karyawan_baru($tokenAuth);
        if ($resultTotalKaryawanBaru['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resultTotalKaryawanBaru = $this->api_dsb->count_all_karyawan_baru($newToken);
        }
        if ($resultTotalKaryawanBaru['status'] == 200) {
            $new_kry = $resultTotalKaryawanBaru['data'];
        } else {
            $new_kry = [];
        }

        $resultTotalPerusahaan = $this->api_dsb->count_all_perusahaan($parameterPerusahaan, $tokenAuth);
        if ($resultTotalPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resultTotalPerusahaan = $this->api_dsb->count_all_perusahaan($parameterPerusahaan, $newToken);
        }
        if ($resultTotalPerusahaan['status'] == 200) {
            $jml_perusahaan = $resultTotalPerusahaan['data'];
        } else {
            $jml_perusahaan = [];
        }

        $resultTotalPelanggaranAktif = $this->api_dsb->count_all_pelanggaran_aktif($parameterPerusahaan, $tokenAuth);
        if ($resultTotalPelanggaranAktif['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resultTotalPelanggaranAktif = $this->api_dsb->count_all_pelanggaran_aktif($parameterPerusahaan, $newToken);
        }
        if ($resultTotalPelanggaranAktif['status'] == 200) {
            $jml_lgr_aktif = $resultTotalPelanggaranAktif['data'];
        } else {
            $jml_lgr_aktif = [];
        }

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

        $parameterFilter = [
            'source' => 'vw_m_prs',
            'field' => 'stat_m_perusahaan',
            'value' => 'T',
            'order' => 'id_m_perusahaan',
            'orderValue' => 'ASC',
        ];
        $dataPerusahaan = $this->std->api($this->specificDataOrder(), $this->getMethod(), $tokenAuth, $parameterFilter);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->std->api($this->specificDataOrder(), $this->getMethod(), $newToken, $parameterFilter);
        }
        if ($dataPerusahaan['status'] == 200) {
            $dataFilter = $dataPerusahaan['data'];
        } else {
            $dataFilter = [];
        }

        $sourceYear = 'tahun_nonaktif';

        $dataTahun = $this->std->api($sourceYear, $this->getMethod(), $tokenAuth);
        if ($dataTahun['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataTahun = $this->std->api($sourceYear, $this->getMethod(), $newToken);
        }
        if ($dataTahun['status'] == 200) {
            $year = $dataTahun['data'];
        } else {
            $year = [];
        }

        $dataMain['nama'] = $this->session->userdata("nama_hcdata");
        $dataMain['jml_karyawan'] = $jml_karyawan;
        $dataMain['jml_perusahaan'] = $jml_perusahaan;
        $dataMain['jml_lgr_aktif'] = $jml_lgr_aktif;
        $dataMain['new_kry'] = $new_kry;
        $dataMain['perusahaan'] = $dataFilter;
        $dataMain['year'] = $year;
        $this->load->view('dashboardNew/hc', $dataMain);

        // Modal
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
                $dataModal['permst'] = $mainOption['data'];
                $dataModal['perstr'] = $options['data'];
            } else {
                $dataModal['permst'] = "";
                $dataModal['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataModal['permst'] = "";
            $dataModal['perstr'] = "";
        }
        $this->load->view('components/modal/dashboardNew/hc', $dataModal);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/dashboardNew/hc');

        // Footer
        $this->load->view('components/footer');
    }

    public function new_data()
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
        $dataPerusahaan = $this->api_dsb->data_terbaru_by_perusahaan($tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_dsb->data_terbaru_by_perusahaan($newToken);
        }
        if ($dataPerusahaan['status'] == 200) {
            $dataMain['data_by_perusahaan'] = $dataPerusahaan['data'];
        } else {
            $dataMain['data_by_perusahaan'] = [];
        }
        $dataUser = $this->api_dsb->data_terbaru_by_user($tokenAuth);
        if ($dataUser['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataUser = $this->api_dsb->data_terbaru_by_user($newToken);
        }
        if ($dataUser['status'] == 200) {
            $dataMain['data_by_user'] = $dataUser['data'];
        } else {
            $dataMain['data_by_user'] = [];
        }
        $this->load->view('dashboardNew/data_baru', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/dashboardNew/data_baru');

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

        $datatables = $this->api_dsb->data_baru_datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_dsb->data_baru_datatables($data, $newToken);
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

    public function data_langgar_aktif()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $tokenAuth = $this->session->userdata('token');
        $data = [
            'id' => $id,
        ];
        $resultPelanggaranAktif = $this->api_dsb->data_pelanggaran_aktif($data, $tokenAuth);
        if ($resultPelanggaranAktif['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $resultPelanggaranAktif = $this->api_dsb->data_pelanggaran_aktif($data, $newToken);
        }
        $data['dtlanggar'] = $resultPelanggaranAktif['data'];
        $this->load->view("dashboardNew/data_pelanggar", $data);
    }

    public function countData()
    {
        $tokenAuth = $this->session->userdata('token');
        $auth = $this->input->get('auth');
        $tipe = $this->input->get('tipe');
        if ($auth == "0" || empty($auth)) {
            $parameterStruktur = [
                'field' => 'stat_m_perusahaan',
                'value' => 'T',
            ];
            $dataStruktur = $this->api_str->read_specific_data($parameterStruktur, $tokenAuth);
            if ($dataStruktur['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataStruktur = $this->api_str->read_specific_data($parameterStruktur, $newToken);
            }

            $authStruktur = [];
            foreach ($dataStruktur['data'] as $key) {
                $authStruktur[] = intval($key['id_m_perusahaan']);
            }
            sort($authStruktur);

            $parameter = [
                'condition' => $authStruktur,
            ];
        } else {
            $parameterFilter = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth,
            ];
            $dataPerusahaan = $this->api_str->read_specific_data($parameterFilter, $tokenAuth);
            if ($dataPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPerusahaan = $this->api_str->read_specific_data($parameterFilter, $newToken);
            }
            if ($dataPerusahaan['status'] != 200) {
                $parameter = [
                    'condition' => array(''),
                ];
            } else {
                if ($tipe == "0") {
                    $arrayCondition[] = intval($dataPerusahaan['data'][0]['id_m_perusahaan']);
                } elseif ($tipe == "3") {
                    $arrayCondition = $this->getParent($dataPerusahaan['data'][0]['id_m_perusahaan']);
                } else {
                    $arrayCondition = $this->getParentOnly($dataPerusahaan['data'][0]['id_m_perusahaan']);
                }
                $parameter = [
                    'condition' => $arrayCondition,
                ];
            }
        }

        $this->session->unset_userdata('parameterDashboard');
        $this->session->set_userdata('parameterDashboard', $parameter);

        $perusahaan = $this->api_dsb->count_all_perusahaan($parameter, $tokenAuth);
        if ($perusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $perusahaan = $this->api_dsb->count_all_perusahaan($parameter, $newToken);
        }
        if ($perusahaan['status'] == 200) {
            $totalPerusahaan = $perusahaan['data'];
        } else {
            $totalPerusahaan = 0;
        }

        $pelanggaran = $this->api_dsb->count_all_pelanggaran_aktif($parameter, $tokenAuth);
        if ($pelanggaran['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $pelanggaran = $this->api_dsb->count_all_pelanggaran_aktif($parameter, $newToken);
        }
        if ($pelanggaran['status'] == 200) {
            $totalPelanggaran = $pelanggaran['data'];
        } else {
            $totalPelanggaran = 0;
        }

        $data = [
            'totalPerusahaan' => $totalPerusahaan,
            'totalPelanggaran' => $totalPelanggaran,
        ];

        echo json_encode($data);
    }

    public function countKaryawan()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $karyawan = $this->api_dsb->count_all_karyawan($parameter, $tokenAuth);
        if ($karyawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $karyawan = $this->api_dsb->count_all_karyawan($parameter, $newToken);
        }
        if ($karyawan['status'] == 200) {
            $totalKaryawan = $karyawan['data'];
        } else {
            $totalKaryawan = 0;
        }

        $data = [
            'totalKaryawan' => $totalKaryawan,
        ];

        echo json_encode($data);
    }

    public function chartPerusahaan()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_perusahaan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_perusahaan($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartJenisKelamin()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_gender($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_gender($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartLokasi()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_lokasi($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_lokasi($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartKlasifikasi()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_klasifikasi($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_klasifikasi($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartPendidikan()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_pendidikan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_pendidikan($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartResidence()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_residence($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_residence($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartSertifikasi()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameter = $this->session->userdata('parameterDashboard');

        $result = $this->api_dsb->chart_sertifikasi($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_dsb->chart_sertifikasi($parameter, $newToken);
        }
        $data = $result['data'];

        echo json_encode($data);
    }

    public function chartPerbandingan()
    {
        $tokenAuth = $this->session->userdata('token');
        $auth = $this->input->get('auth');
        $tahun = $this->input->get('tahun');

        if ($auth == "0" || empty($auth)) {
            $perusahaan = 1;
        } else {
            $parameterFilter = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth,
            ];
            $dataPerusahaan = $this->api_str->read_specific_data($parameterFilter, $tokenAuth);
            if ($dataPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPerusahaan = $this->api_str->read_specific_data($parameterFilter, $newToken);
            }
            if ($dataPerusahaan['status'] != 200) {
                $perusahaan = 0;
            } else {
                $perusahaan = intval($dataPerusahaan['data'][0]['id_m_perusahaan']);
            }
        }

        if (empty($tahun)) {
            $tahun = date("Y");
        }
        $source = 'perbandingan_karyawan';

        $parameter = [
            'tahun' => $tahun,
            'perusahaan' => $perusahaan,
        ];

        $result = $this->std->api($source, $this->getMethod(), $tokenAuth, $parameter);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($source, $this->getMethod(), $newToken, $parameter);
        }
        $data = $result['data'];

        echo json_encode($data);
    }
}