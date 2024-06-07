<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChangePassword_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
        $this->load->library('Encryption_Data');
    }

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
        }
        $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $this->load->view('changePass');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/changePass');

        // Footer
        $this->load->view('components/footer');
    }

    public function process()
    {
        $tokenAuth = $this->session->userdata("token");
        $email = $this->session->userdata('email_hcdata');
        $oldPassword = htmlspecialchars($this->input->post("oldPassword", true));
        $newPassword = htmlspecialchars($this->input->post("newPassword", true));

        $data = [
            'email' => $this->encryption_data->encryptData($email),
            'oldPassword' => $this->encryption_data->encryptData($oldPassword),
            'newPassword' => $this->encryption_data->encryptData($newPassword),
        ];

        $result = $this->api_lgn->update_password($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_lgn->update_password($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array('statusCode' => 200, 'kode_pesan' => 'Berhasil', 'pesan' => 'Kata Sandi berhasil diganti!', 'tipe_pesan' => 'success'));
        } else if ($result == 406) {
            echo json_encode(array('statusCode' => 406, 'kode_pesan' => 'Peringatan', 'pesan' => 'Kata Sandi lama salah/tidak valid', 'tipe_pesan' => 'warning'));
        } else if ($result == 404) {
            echo json_encode(array('statusCode' => 404, 'kode_pesan' => 'Gagal', 'pesan' => 'Data User tidak ditemukan', 'tipe_pesan' => 'error'));
        } else {
            echo json_encode(array('statusCode' => 400, 'kode_pesan' => 'Gagal', 'pesan' => 'Kata Sandi gagal diganti!', 'tipe_pesan' => 'error'));
        }
    }
}