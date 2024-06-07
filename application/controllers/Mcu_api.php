<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcu_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    public function checkFile($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameter = [
            'field' => 'auth_mcu',
            'value' => $auth,
        ];
        $data = $this->api_kry->read_specific_data_mcu($parameter, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_kry->read_specific_data_mcu($parameter, $newToken);
        }
        if ($data['status'] == 200) {
            $file = $data['data'][0]['url_file'];
            $perusahaan = $data['data'][0]['id_m_perusahaan'];
            $id_personal = $data['data'][0]['id_personal'];

            $foldername = md5($id_personal);

            $dataPDF = $this->ftp_file->readFilePDF(
                [
                    '/home/onedb_kary/karyawan/' . $foldername . '/' . $file,
                    '/home/onedb_kary/mcu/' . $perusahaan . '/' . $file,
                ],
                $file
            );
            if ($dataPDF == null) {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }
}
