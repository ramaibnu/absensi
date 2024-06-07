<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_nonaktif_API_model extends CI_Model
{
    public function datatables($data, $auth)
    {
        $api_url = API_URL . 'karyawan_nonaktif_datatables';

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
    
    public function read_specific_data($data, $auth)
    {
        $api_url = API_URL . 'spesifik_data_karyawan_nonaktif';

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
        $api_url = API_URL . 'tambah_data_karyawan_nonaktif';

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
        $api_url = API_URL . 'edit_data_karyawan_nonaktif';

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
        $api_url = API_URL . 'hapus_data_karyawan_nonaktif';

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
    
    // Data Master
    public function alasan_nonaktif($auth)
    {
        $api_url = API_URL . 'data_alasan_nonaktif';

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
    
    public function specific_alasan_nonaktif($data, $auth)
    {
        $api_url = API_URL . 'specific_alasan_nonaktif';

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
}