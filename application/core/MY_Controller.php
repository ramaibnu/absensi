<?php

class My_Controller extends CI_Controller
{
    private $dataTokenAuth;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('user_agent');

        // API
        $this->load->model("Standard_API_model", 'std');
        $this->load->model("Token_API_model", 'api_tkn');
        $this->load->model("Login_API_model", 'api_lgn');
        $this->load->model("Dashboard_API_model", 'api_dsb');
        $this->load->model("Daerah_API_model", 'api_drh');
        $this->load->model("Perusahaan_API_model", 'api_prs');
        $this->load->model("Struktur_API_model", 'api_str');
        $this->load->model("Departemen_API_model", 'api_dprt');
        $this->load->model("Posisi_API_model", 'api_pss');
        $this->load->model("Level_API_model", 'api_lvl');
        $this->load->model("Golongan_API_model", 'api_gol');
        $this->load->model("LokasiKerja_API_model", 'api_lkr');
        $this->load->model("Poh_API_model", 'api_poh');
        $this->load->model("Unit_API_model", 'api_unt');
        $this->load->model("Search_API_model", 'api_src');
        $this->load->model("Karyawan_API_model", 'api_kry');
        $this->load->model("Karyawan_nonaktif_API_model", 'api_nkry');
        $this->load->model("Izin_tambang_API_model", 'api_izt');
        $this->load->model("Sertifikasi_API_model", 'api_srt');
        $this->load->model("Vaksin_API_model", 'api_vks');
        $this->load->model("Personal_API_model", 'api_psn');
        $this->load->model("Pelanggaran_API_model", 'api_plg');
        $this->load->model("API_model", 'api');
        $this->load->model("Users_API_model", 'api_usr');
        // $this->load->model("KaryawanDetail_API_model", 'api_krd');
    }

    // API Method
    public function getMethod()
    {
        return 'GET';
    }

    public function postMethod()
    {
        return 'POST';
    }

    public function putMethod()
    {
        return 'PUT';
    }

    public function deleteMethod()
    {
        return 'DELETE';
    }

    // Endpoint
    public function specificData()
    {
        return 'specific_data';
    }
    
    public function specificDataOrder()
    {
        return 'specific_data_order';
    }

    public function specificData2Fields()
    {
        return 'specific_data_by_2_fields';
    }

    public function specificData3Fields()
    {
        return 'specific_data_by_3_fields';
    }

    public function specificData4Fields()
    {
        return 'specific_data_by_4_fields';
    }

    public function tokenData()
    {
        return $this->dataTokenAuth = [
            'auth' => $this->session->userdata('dataToken'),
        ];
    }

    public function authentication()
    {
        return ($this->session->userdata('login'));
    }

    public function cek_auth($auth)
    {
        $auth_valid = $this->session->csrf_token;
        $email = $this->session->email_hcdata;
        if ($auth !== $auth_valid) {
            $data_err = [
                'email_error' => $email,
                'ip_error' => $_SERVER['REMOTE_ADDR'],
                'ip_akses' => $_SERVER['REMOTE_ADDR'],
                'msg_error' => 'Token tidak valid : ' . $auth . " - valid token : " . $auth_valid,
                'tgl_buat' => date('Y-m-d H:i:s'),
            ];
            $tokenData = $this->api_tkn->getToken($dataTokenAuth);
            if ($tokenData['status'] == 202) {
                $tokenAuth = $tokenData['data'];
                $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
            }
            return 501;
        } else {
            return 500;
        }
    }

    public function cek_device()
    {
        $OSblock = ['Android', 'Linux', 'IOS'];

        $currentPlatform = $this->agent->platform();

        if (in_array($currentPlatform, $OSblock)) {
            redirect('device_unauthorized');
        }
    }

    // Indonesian Date Format
    public function formatIndonesianDate($timestampOrDateString)
    {
        if (!ctype_digit($timestampOrDateString)) {
            $timestamp = strtotime($timestampOrDateString);
        }
        
        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        $date = new DateTime();
        $date->setTimestamp($timestamp);
        $day = $date->format('d');
        $month = $monthNames[$date->format('n') - 1];
        $year = $date->format('Y');

        $formattedDate = $day . " " . $month . " " . $year;

        return $formattedDate;
    }

    // Struktur
    public function getParentOnly($id)
    {
        $condition = array();
        $tokenAuth = $this->session->userdata("token");
        $parameterParent = [
            'source' => 'vw_m_prs',
            'field' => 'stat_m_perusahaan',
            'value' => 'T',
            'field2' => 'id_parent',
            'value2' => $id,
        ];
        $getID = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterParent);
        if ($getID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $getID = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterParent);
        }
        if ($getID['status'] == 200) {
            $condition[] = intval($id);
            foreach ($getID['data'] as $id_perusahaan) {
                $condition[] = intval($id_perusahaan['id_m_perusahaan']);
            }
        } else {
            $parameter = [
                'field' => 'id_m_perusahaan',
                'value' => $id,
            ];
            $dataCheck = $this->api_str->read_specific_data($parameter, $tokenAuth);
            if ($dataCheck['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataCheck = $this->api_str->read_specific_data($parameter, $newToken);
            }
            if ($dataCheck['status'] == 200) {
                $condition[] = intval($dataCheck['data'][0]['id_m_perusahaan']);
            }
        }
        return $condition;
    }

    public function getParent($id, $condition = array())
    {
        $condition[] = intval($id);
        $tokenAuth = $this->session->userdata("token");
        $parameterParent = [
            'source' => 'vw_m_prs',
            'field' => 'stat_m_perusahaan',
            'value' => 'T',
            'field2' => 'id_parent',
            'value2' => $id,
        ];
        $getID = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterParent);
        if ($getID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $getID = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterParent);
        }
        if ($getID['status'] == 200) {
            foreach ($getID['data'] as $id_perusahaan) {
                $parameter = [
                    'field' => 'id_m_perusahaan',
                    'value' => $id_perusahaan['id_parent'],
                ];
                $dataCheck = $this->api_str->read_specific_data($parameter, $tokenAuth);
                if ($dataCheck['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataCheck = $this->api_str->read_specific_data($parameter, $newToken);
                }
                if ($dataCheck['status'] == 200) {
                    $condition = $this->getParent($id_perusahaan['id_m_perusahaan'], $condition);
                }
            }
        }
        return $condition;
    }
}
