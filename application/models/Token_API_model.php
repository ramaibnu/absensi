<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token_API_model extends CI_Model
{
    public function getToken($data)
    {
        $api_url = API_URL . 'getToken';

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
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
}
