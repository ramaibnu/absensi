<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_API_model extends CI_Model
{
    public function login($data)
    {
        $api_url = API_URL . 'login';

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }
    public function checkIP($data)
    {
        $api_url = API_URL . 'check_IP';

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return $http_status_code;
        }

        curl_close($ch);
        $returnArray = json_decode($response, true);

        return $returnArray;
    }

    public function create_log($data, $auth)
    {
        $api_url = API_URL . 'login_history';

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

    public function create_blacklist($data, $auth)
    {
        $api_url = API_URL . 'blacklist';

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

    public function create_error_log($data, $auth)
    {
        $api_url = API_URL . 'error_log';

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

    public function update_password($data, $auth)
    {
        $api_url = API_URL . 'update_password';

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
}
