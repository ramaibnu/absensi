<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_API_model extends CI_Model
{
    public function datatables($data, $auth)
    {
        $api_url = API_URL . 'pelanggaran_datatables';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    
    public function read_data_jenis_pelanggaran($auth)
    {
        $api_url = API_URL . 'data_jenis_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    
    public function read_specific_data($data, $auth)
    {
        $api_url = API_URL . 'spesifik_data_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    
    public function read_specific_data_pelanggaran($data, $auth)
    {
        $api_url = API_URL . 'spesifik_data_pelanggaran2';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    
    public function read_specific_data_jenis_pelanggaran($data, $auth)
    {
        $api_url = API_URL . 'spesifik_data_jenis_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    
    public function create($data, $auth)
    {
        $api_url = API_URL . 'tambah_data_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);

        return $http_status_code;
    }
    
    public function update($data, $auth)
    {
        $api_url = API_URL . 'edit_data_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);

        return $http_status_code;
    }
    
    public function update_file($data, $auth)
    {
        $api_url = API_URL . 'edit_file_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);

        return $http_status_code;
    }
    
    public function delete($data, $auth)
    {
        $api_url = API_URL . 'hapus_data_pelanggaran';

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
           return $http_status_code;
        }

        curl_close($ch);

        return $http_status_code;
    }
}
