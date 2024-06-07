<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KaryawanDetail_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    public function getKaryawan()
    {
        $auth_m_per = $this->input->post('auth_m_per');
        $search = $this->input->post('search');
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'auth' => $auth_m_per,
            'searchValue' => $search,
        ];
        $result = $this->api_krd->getKaryawan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_krd->getKaryawan($parameter, $newToken);
        }

        echo json_encode($result['data']);
    }
}