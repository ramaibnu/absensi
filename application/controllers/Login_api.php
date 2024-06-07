<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_device();
        if ($this->authentication()) {
            redirect('dashboard_main');
        }
        $this->load->library('Encryption_Data');
    }

    public function index()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $dataIP = [
            'ip' => $ip,
        ];
        $cek_ip = $this->api_lgn->checkIP($dataIP);

        if ($cek_ip !== null && isset($cek_ip['status'])) {
            if ($cek_ip['status'] == 200) {
                $waktu = $cek_ip['data'];
    
                $now = date("Y-m-d H:i:s");
    
                if ($waktu < $now) {
                    $dtcap = array(
                        'captcha' => $this->create_captcha(),
                    );
    
                    $this->load->view('login/login', $dtcap);
                } else {
                    redirect('blokir');
                }
            } else {
                $dtcap = array(
                    'captcha' => $this->create_captcha(),
                );
    
                $this->load->view('login/login', $dtcap);
            }
        } else {
            $dtcap = array(
                'captcha' => $this->create_captcha(),
            );

            $this->load->view('login/login', $dtcap);
        }
    }

    private function create_captcha()
    {
        $data = array(
            'img_path' => './captcha/',
            'img_url' => base_url('captcha/'),
            'font_path' => FCPATH . 'assets/fonts/calibri.ttf',
            'font_size' => 30,
            'word_length' => 3,
            'img_width' => '200',
            'img_height' => '43',
            'border' => 1,
            'expiration' => 3600,
        );

        $captcha = create_captcha($data);
        $image = $captcha['image'];

        $this->session->set_userdata('captchaword', $captcha['word']);

        return $image;
    }

    public function refCaptcha()
    {
        // Captcha configuration
        $data = array(
            'img_path' => './captcha/',
            'img_url' => base_url('captcha/'),
            'font_path' => FCPATH . 'assets/fonts/calibri.ttf',
            'font_size' => 30,
            'word_length' => 3,
            'img_width' => '200',
            'img_height' => '43',
            'border' => 1,
            'expiration' => 3600,
        );
        $captcha = create_captcha($data);

        $this->session->unset_userdata('captchaword');
        $this->session->set_userdata('captchaword', $captcha['word']);

        echo $captcha['image'];
    }

    public function auth()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $dataIP = [
            'ip' => $ip,
        ];
        $cek_ip = $this->api_lgn->checkIP($dataIP);

        if ($cek_ip !== null && isset($cek_ip['status'])) {
            if ($cek_ip['status'] == 200) {
                $waktu = $cek_ip['data'];
    
                $now = date("Y-m-d H:i:s");
    
                if ($waktu < $now) {
                    $this->auth_process();
                } else {
                    redirect('blokir');
                }
            } else {
                $this->auth_process();
            }
        } else {
            $this->auth_process();
        }
    }

    private function auth_process()
    {
        $this->form_validation->set_rules('captcha', 'captcha', 'trim|required', [
            'required' => "Kode wajib diisi",
        ]);
        $this->form_validation->set_rules('temail', 'email', 'required|trim|valid_email', [
            'required' => "Email tidak boleh kosong",
            'valid_email' => 'Format email anda salah',
        ]);
        $this->form_validation->set_rules('tsandi', 'sandi', 'required|trim', [
            'required' => "Sandi tidak boleh kosong",
        ]);
        if ($this->form_validation->run() == false) {
            $dtcap = array(
                'captcha' => $this->create_captcha(),
            );

            $this->load->view('login/login', $dtcap);
        } else {
            $token = strip_tags(trim($this->input->post('token', true)));
            $valid_token = $this->session->csrf_token;
            $email = strip_tags(trim($this->input->post('temail', true)));
            $captcha_save = strip_tags($this->session->userdata('captchaword'), true);
            $captcha = strip_tags(trim($this->input->post('captcha', true)));
            $sandi = md5(trim($this->input->post('tsandi')));
            $dataTokenAuth = [
                'auth' => $this->encryption_data->encryptData($email),
            ];

            // if ($token !== $valid_token) {
            //     $data_err = [
            //         'email_error' => $this->encryption_data->encryptData($email),
            //         'ip_error' => $_SERVER['REMOTE_ADDR'],
            //         'ip_akses' => $_SERVER['REMOTE_ADDR'],
            //         'msg_error' => 'Token tidak valid : ' . $token . " - valid token : " . $valid_token,
            //     ];
            //     $tokenData = $this->api_tkn->getToken($dataTokenAuth);
            //     if ($tokenData['status'] == 202) {
            //         $tokenAuth = $tokenData['data'];
            //         $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
            //     }
            //     redirect('unauthorized');
            // }

            if ($captcha_save != "") {
                if ($captcha_save === $captcha) {
                    $data = $this->check_data($email, $sandi);

                    if ($data != "") {
                        if ($data['statusCode'] == 200) {
                            $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                            $session_data = array(
                                'login' => true,
                                'id_user_hcdata' => $data['id_user'],
                                'email_hcdata' => $data['email_user'],
                                'nama_hcdata' => $data['nama_user'],
                                'auth_user_hcdata' => $data['auth_user'],
                                'id_menu_hcdata' => $data['id_menu'],
                                'akses_apps_hcdata' => $data['akses_apps'],
                                'id_m_perusahaan_hcdata' => $data['id_m_perusahaan'],
                                'id_perusahaan_hcdata' => $data['id_perusahaan'],
                                'csrf_token_hcdata' => bin2hex(random_bytes(32)),
                                'ip_address' => $_SERVER['REMOTE_ADDR'],
                                'token' => $tokenData['data'],
                                'dataToken' => $this->encryption_data->encryptData($data['email_user']),
                            );
                            $this->session->set_userdata($session_data);
                            redirect('dashboard_main');
                        } else if ($data['statusCode'] == 201) {
                            $dtcap = array(
                                'captcha' => $this->create_captcha(),
                            );

                            $data_err = [
                                'email_error' => $this->encryption_data->encryptData($email),
                                'ip_error' => $_SERVER['REMOTE_ADDR'],
                                'ip_akses' => $_SERVER['REMOTE_ADDR'],
                                'msg_error' => $data['pesan'],
                            ];
                            $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                            if ($tokenData['status'] == 202) {
                                $tokenAuth = $tokenData['data'];
                                $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                            }

                            $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> ' . $data['pesan'] . '</div>');
                            $this->load->view('login/login', $dtcap);
                        } else {
                            $data_err = [
                                'email_error' => $this->encryption_data->encryptData($email),
                                'ip_error' => $_SERVER['REMOTE_ADDR'],
                                'ip_akses' => $_SERVER['REMOTE_ADDR'],
                                'msg_error' => 'Ip Address diblokir karena salah sandi sebanyak 5x',
                            ];
                            $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                            if ($tokenData['status'] == 202) {
                                $tokenAuth = $tokenData['data'];
                                $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                            }

                            redirect('blokir');
                        }
                    } else {
                        $dtcap = array(
                            'captcha' => $this->create_captcha(),
                        );

                        $data_err = [
                            'email_error' => $this->encryption_data->encryptData($email),
                            'ip_error' => $_SERVER['REMOTE_ADDR'],
                            'ip_akses' => $_SERVER['REMOTE_ADDR'],
                            'msg_error' => 'Email tidak ditemukan',
                        ];
                        $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                        if ($tokenData['status'] == 202) {
                            $tokenAuth = $tokenData['data'];
                            $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                        }

                        $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> Email tidak ditemukan</div>');
                        $this->load->view('login/login', $dtcap);
                    }
                } else {
                    $dtcap = array(
                        'captcha' => $this->create_captcha(),
                    );

                    $data_err = [
                        'email_error' => $this->encryption_data->encryptData($email),
                        'ip_error' => $_SERVER['REMOTE_ADDR'],
                        'ip_akses' => $_SERVER['REMOTE_ADDR'],
                        'msg_error' => 'Kode Captcha Salah',
                    ];
                    $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                    if ($tokenData['status'] == 202) {
                        $tokenAuth = $tokenData['data'];
                        $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                    }

                    $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">Kode salah</div>');
                    $this->load->view('login/login', $dtcap);
                }
            } else {
                $dtcap = array(
                    'captcha' => $this->create_captcha(),
                );

                $data_err = [
                    'email_error' => $this->encryption_data->encryptData($email),
                    'ip_error' => $_SERVER['REMOTE_ADDR'],
                    'ip_akses' => $_SERVER['REMOTE_ADDR'],
                    'msg_error' => 'Refresh Captcha Salah',
                ];
                $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                if ($tokenData['status'] == 202) {
                    $tokenAuth = $tokenData['data'];
                    $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                }

                $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">Refresh Kode</div>');
                $this->load->view('login/login', $dtcap);
            }
        }
    }

    private function check_data($email, $password)
    {
        $attemp_temp = $this->session->userdata('attemps_temp');
        $back_time = $this->session->userdata('back_time');

        if ($attemp_temp == 5) {
            return array("statusCode" => 201, "pesan" => "Batas salah sandi hanya 5x, silahkan login kembali pada pukul " . date('d-M-Y H:i:s', strtotime($back_time)));
        } else {
            $data = [
                'email' => $email,
                'password' => $password,
            ];

            $check_auth = $this->api_lgn->login($data);
            if ($check_auth['status'] == 200) {
                $id_user = $this->encryption_data->decryptData($check_auth['data']['id_user']);
                $email_user = $this->encryption_data->decryptData($check_auth['data']['email_user']);
                $nama_user = $this->encryption_data->decryptData($check_auth['data']['nama_user']);
                $id_menu = $this->encryption_data->decryptData($check_auth['data']['id_menu']);
                $id_m_perusahaan = $this->encryption_data->decryptData($check_auth['data']['id_m_perusahaan']);
                $id_perusahaan = $this->encryption_data->decryptData($check_auth['data']['id_perusahaan']);
                $akses_apps = $this->encryption_data->decryptData($check_auth['data']['akses_apps']);
                $dataTokenAuth = [
                    'auth' => $check_auth['data']['email_user'],
                ];

                $apps = ['HCT', 'ALL'];
                if (in_array($akses_apps, $apps)) {
                    $dt_log = [
                        'user_log' => $check_auth['data']['email_user'],
                        'tgl_log' => date('Y-m-d H:i:s'),
                        'ip_address_log' => $_SERVER['REMOTE_ADDR'],
                    ];

                    $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                    if ($tokenData['status'] == 202) {
                        $tokenAuth = $tokenData['data'];
                        $blacklist_data = $this->api_lgn->create_log($dt_log, $tokenAuth);
                        $this->session->unset_userdata('attemps_temp');

                        return array(
                            "statusCode" => 200,
                            "id_user" => $id_user,
                            "email_user" => $email_user,
                            "nama_user" => $nama_user,
                            "auth_user" => md5($id_user . date('Y-m-d')),
                            "id_menu" => $id_menu,
                            "id_m_perusahaan" => $id_m_perusahaan,
                            "id_perusahaan" => $id_perusahaan,
                            "akses_apps" => $akses_apps,
                            "token_data" => $check_auth['data']['email_user'],
                        );
                    } else {
                        return array("statusCode" => 201, "pesan" => "Server Error, harap hubungi Administrator");
                    }
                } else {
                    $data_err = [
                        'email_error' => $check_auth['data']['email_user'],
                        'ip_error' => $_SERVER['REMOTE_ADDR'],
                        'ip_akses' => $_SERVER['REMOTE_ADDR'],
                        'msg_error' => 'Mencoba akses aplikasi yang tidak diizinkan | TEMP',
                    ];
                    $tokenData = $this->api_tkn->getToken($dataTokenAuth);
                    if ($tokenData['status'] == 202) {
                        $tokenAuth = $tokenData['data'];
                        $blacklist_data = $this->api_lgn->create_error_log($data_err, $tokenAuth);
                    }
                    redirect('forbidden');
                }
            } elseif ($check_auth['status'] == 400) {
                $attemp_temp = $this->session->userdata('attemps_temp');

                if ($attemp_temp == 4) {
                    $attemp_temp++;
                    $now = date('Y-m-d H:i:s');
                    $sekarang = strtotime($now);
                    $jamlogback = date('Y-m-d H:i:s', strtotime("+15 minutes", $sekarang));
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $this->session->set_userdata('attemps_temp', $attemp_temp);
                    $data_auth = $this->encryption_data->encryptData($email);

                    $data_blok = [
                        'ip_address' => $ip,
                        'back_log' => $jamlogback,
                        'email_user' => $data_auth,
                    ];

                    $tokenData = $this->api_tkn->getToken($data_auth);
                    if ($tokenData['status'] == 202) {
                        $tokenAuth = $tokenData['data'];
                        $this->api_lgn->create_blacklist($data_blok, $tokenAuth);
                        $this->session->unset_userdata('attemps_temp');
                        return array("statusCode" => 202, "waktu" => $jamlogback);
                    } else {
                        return array("statusCode" => 201, "pesan" => "Server Error, harap hubungi Administrator");
                    }
                } else {
                    $attemp_temp++;
                    $sisa = 5 - intval($attemp_temp);
                    $this->session->set_userdata('attemps_temp', $attemp_temp);
                    return array("statusCode" => 201, "pesan" => "Sandi anda salah, kesempatan tinggal " . $sisa . "x");
                }
            } elseif ($check_auth['status'] == 403) {
                return array("statusCode" => 201, "pesan" => "User telah expired");
            } elseif ($check_auth['status'] == 401) {
                return array("statusCode" => 201, "pesan" => "User tidak aktif");
            } else {
                return array("statusCode" => 201, "pesan" => "User tidak ditemukan");
            }
        }
    }
}
