<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daerah_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    public function get_prov()
    {
        $tokenAuth = $this->session->userdata('token');

        $result = $this->api_drh->provinsi($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_drh->provinsi($newToken);
        }
        if ($result['status'] == 200) {
            $output = "<option value=''> -- PILIH PROVINSI -- </option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id'] . "'>" . $list['name'] . "</option>";
            }

            $data = [
                "statusCode" => 200,
                "prov" => $output,
            ];

            echo json_encode($data);
        } else {
            $output = "<option value=''> -- PROVINSI TIDAK ADA -- </option>";

            $data = [
                "statusCode" => 201,
                "prov" => $output,
            ];

            echo json_encode($data);
        }
    }

    public function get_kab()
    {
        $id = htmlspecialchars($this->input->post("id_prov"));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'id' => $id,
        ];

        $result = $this->api_drh->kota_by_provinsi($data, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_drh->kota_by_provinsi($data, $newToken);
        }
        if ($result['status'] == 200) {
            $output = "<option value=''> -- PILIH KABUPATEN/KOTA -- </option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id'] . "'>" . $list['name'] . "</option>";
            }
            $data = [
                "statusCode" => 200,
                "kab" => $output,
            ];
            echo json_encode($data);
        } else {
            $output = "<option value=''> -- KABUPATEN/KOTA TIDAK ADA -- </option>";

            $data = [
                "statusCode" => 201,
                "kab" => $output,
            ];
            echo json_encode($data);
        }
    }

    public function get_kec()
    {
        $id = htmlspecialchars($this->input->post("id_kab"));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'id' => $id,
        ];

        $result = $this->api_drh->kecamatan_by_kota($data, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_drh->kecamatan_by_kota($data, $newToken);
        }
        if ($result['status'] == 200) {
            $output = "<option value=''> -- PILIH KECAMATAN -- </option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id'] . "'>" . $list['name'] . "</option>";
            }
            $data = [
                "statusCode" => 200,
                "kec" => $output,
            ];
            echo json_encode($data);
        } else {
            $output = "<option value=''> -- KECAMATAN TIDAK ADA -- </option>";

            $data = [
                "statusCode" => 201,
                "kec" => $output,
            ];
            echo json_encode($data);
        }
    }

    public function get_kel()
    {
        $id = htmlspecialchars($this->input->post("id_kec"));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'id' => $id,
        ];

        $result = $this->api_drh->kelurahan_by_kecamatan($data, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_drh->kelurahan_by_kecamatan($data, $newToken);
        }
        if ($result['status'] == 200) {
            $output = "<option value=''> -- PILIH KELURAHAN -- </option>";
            foreach ($result['data'] as $list) {
                $output = $output . "<option value='" . $list['id'] . "'>" . $list['name'] . "</option>";
            }
            $data = [
                "statusCode" => 200,
                "kel" => $output,
            ];
            echo json_encode($data);
        } else {
            $output = "<option value=''> -- KELURAHAN TIDAK ADA -- </option>";

            $data = [
                "statusCode" => 201,
                "kel" => $output,
            ];
            echo json_encode($data);
        }
    }
}
