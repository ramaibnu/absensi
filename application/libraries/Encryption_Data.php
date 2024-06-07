<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Encryption_Data
{
    private $key = "54s4k1_k4mad3";
    private $iv = "eJ4G(Jy{=9?nA].v";

    public function encryptData($data)
    {
        $cipher = "aes-256-cbc";
        $options = 0;
        $encrypted = openssl_encrypt($data, $cipher, $this->key, $options, $this->iv);
        return base64_encode($encrypted);
    }

    public function decryptData($data)
    {
        $cipher = "aes-256-cbc";
        $options = 0;
        $decrypted = openssl_decrypt(base64_decode($data), $cipher, $this->key, $options, $this->iv);
        return $decrypted;
    }
}
