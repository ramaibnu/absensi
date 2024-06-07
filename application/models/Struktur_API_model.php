<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur_API_model extends CI_Model
{
    // Struktur Perusahaan
    public function mainOption($data, $auth)
    {
        $api_url = API_URL . 'mainOption';

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

    public function options($data, $auth)
    {
        $api_url = API_URL . 'options';

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

    public function datatables($data, $auth)
    {
        $api_url = API_URL . 'struktur_datatables';

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
        $api_url = API_URL . 'spesifik_struktur';

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
    
    public function struktur_perusahaan($data, $auth)
    {
        $api_url = API_URL . 'struktur_perusahaan';

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
    
    public function read_lastest_data($auth)
    {
        $api_url = API_URL . 'new_struktur';

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

    public function create($data, $auth)
    {
        $api_url = API_URL . 'tambah_struktur';

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
        $api_url = API_URL . 'edit_struktur';

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
        $api_url = API_URL . 'hapus_struktur';

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

    // RK3L
    public function edit_rk3l($data, $auth)
    {
        $api_url = API_URL . 'edit_rk3l';

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
    
    // IUJP
    public function lastest_data_iujp($auth)
    {
        $api_url = API_URL . 'lastest_data_iujp';

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

    public function data_iujp_order_by_tanggal($data, $auth)
    {
        $api_url = API_URL . 'spesifik_iujp_order_tanggal';

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

    public function create_iujp($data, $auth)
    {
        $api_url = API_URL . 'tambah_iujp';

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

    public function update_iujp($data, $auth)
    {
        $api_url = API_URL . 'edit_iujp';

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

    public function delete_iujp($data, $auth)
    {
        $api_url = API_URL . 'hapus_iujp';

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
    
    // SIO
    public function lastest_data_sio($auth)
    {
        $api_url = API_URL . 'lastest_data_sio';

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

    public function data_sio_order_by_tanggal($data, $auth)
    {
        $api_url = API_URL . 'spesifik_sio_order_tanggal';

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

    public function create_sio($data, $auth)
    {
        $api_url = API_URL . 'tambah_sio';

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

    public function update_sio($data, $auth)
    {
        $api_url = API_URL . 'edit_sio';

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

    // Kontrak
    public function data_kontrak_order_by_tanggal($data, $auth)
    {
        $api_url = API_URL . 'spesifik_kontrak_order_tanggal';

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
    
    public function lastest_data_kontrak($auth)
    {
        $api_url = API_URL . 'lastest_data_kontrak';

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
    
    public function create_kontrak($data, $auth)
    {
        $api_url = API_URL . 'tambah_kontrak';

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

    // PJO
    public function pjo($data, $auth)
    {
        $api_url = API_URL . 'pjo';

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

    public function data_pjo_order_by_tanggal($data, $auth)
    {
        $api_url = API_URL . 'spesifik_pjo_order_tanggal';

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

    public function create_pjo($data, $auth)
    {
        $api_url = API_URL . 'tambah_pjo';

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
    
    public function lokasi_pjo($auth)
    {
        $api_url = API_URL . 'lokasi_pjo';

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
    
    public function lokasi_pjo_by_id($data, $auth)
    {
        $api_url = API_URL . 'lokasi_pjo_by_id';

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
