<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    public function global()
    {
        $value = htmlspecialchars(trim($this->input->get('value', true)));
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $id_m_perusahaan = $this->session->userdata("id_m_perusahaan_hcdata");
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
        if ($id_m_perusahaan != 1) {
            $condition = $this->getParent($id_m_perusahaan);
        } else {
            $condition = array(1);
        }
        $valueSearch = [
            'value' => $value,
            'condition' => $condition,
        ];
        $dataSearch = $this->api_src->globalSearching($valueSearch, $tokenAuth);
        if ($dataSearch['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataSearch = $this->api_src->globalSearching($valueSearch, $newToken);
        }
        if ($dataSearch['status'] == 200) {
            $dataMain["data_kry"] = $dataSearch['data'];
        } else {
            $dataMain["data_kry"] = [];
        }
        $dataMain["status"] = $dataSearch['status'];
        $dataMain["textcari"] = $value;
        $this->load->view('globalSearch', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/globalSearch');

        // Footer
        $this->load->view('components/footer');
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
        $result = $this->api_src->getKaryawan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_src->getKaryawan($parameter, $newToken);
        }

        echo json_encode($result['data']);
    }

    public function getPerusahaan()
    {
        $search = $this->input->post('search');
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'searchValue' => $search,
        ];
        $result = $this->api_src->getPerusahaan($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_src->getPerusahaan($parameter, $newToken);
        }

        if ($result['data'][0]['value'] != '') {
            $this->session->set_userdata('auth_per_sub', $result['data'][0]['value']);
        }
        echo json_encode($result['data']);
    }
}