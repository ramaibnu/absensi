<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Standard_API_model extends CI_Model
{
    public function api($endpoint, $method, $auth, $parameterData = null)
    {
        $api_url = API_URL . $endpoint;

        $ch = curl_init($api_url);

        $headers = array(
            'Authorization: ' . $auth,
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($parameterData != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameterData));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return $http_status_code;
        }

        curl_close($ch);
        if ($method === 'GET') {
            $returnArray = json_decode($response, true);

            return $returnArray;
        }

        return $http_status_code;
    }
}
