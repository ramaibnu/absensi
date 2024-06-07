<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error_pages extends My_Controller
{
    public function not_found()
    {
        $this->load->view('errors/errnotfound');
    }

    public function device_unauthorized()
    {
        $this->load->view('errors/errdevice');
    }

    public function unauthorized()
    {
        $this->load->view('errors/errauth');
    }

    public function ip_blocked()
    {
        $this->load->view('errors/errorvalidation');
    }

    public function forbidden()
    {
        $this->load->view('errors/notallowed');
    }

    public function forbidden_2()
    {
        $this->load->view('errors/forbidden');
    }

    public function page_error()
    {
        $this->load->view('errors/error_page');
    }
}
