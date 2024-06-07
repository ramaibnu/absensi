<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout_api extends MY_Controller
{
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login_view');
    }
}
