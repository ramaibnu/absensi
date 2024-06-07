<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
        $this->load->library('FTP_File');
    }

    // View
    public function selesai()
    {
        $this->session->set_flashdata("str_sukses", "1");
    }

    public function index()
    {
        if ($this->session->flashdata("updstr_sukses") != "") {
            $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesupdtstr animate__animated animate__bounce mb-2" role="alert"> Nama perusahaan berhasil diupdate </div>');
        }

        if ($this->session->flashdata("hapus_sukses") != "") {
            $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesupdtstr animate__animated animate__bounce mb-2" role="alert"> Struktur Perusahaan berhasil dihapus</div>');
        }

        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataID = [
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
        ];

        $result = $this->api_prs->read_specific_data($dataID, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_prs->read_specific_data($dataID, $newToken);
            $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        } else {
            $dataSidebar['nama_per'] = "PT UNGGUL";
        }

        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $this->load->view('data_master/struktur/view');

        // Modal
        $this->load->view('components/modal/struktur');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/struktur/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_struktur()
    {
        if ($this->session->flashdata("str_sukses") != "") {
            $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesalrt animate__animated animate__bounce mb-2" role="alert"> Struktur perusahaan berhasil dibuat </div>');
        }

        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");

        // Header
        $this->load->view('components/header');

        // Sidebar
        $dataID = [
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
        ];

        $result = $this->api_prs->read_specific_data($dataID, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_prs->read_specific_data($dataID, $newToken);
            $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        } else {
            $dataSidebar['nama_per'] = "PT UNGGUL";
        }

        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $this->load->view('data_master/struktur/add');

        // Modal
        if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
            $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
            if ($idmper != "") {
                $parameterOption = [
                    'id' => $idmper,
                ];
                $mainOption = $this->api_str->mainOption($parameterOption, $tokenAuth);
                if ($mainOption['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $mainOption = $this->api_str->mainOption($parameterOption, $newToken);
                }
                $options = $this->api_str->options($parameterOption, $tokenAuth);
                if ($options['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $options = $this->api_str->options($parameterOption, $newToken);
                }
                $dataModal['permst'] = $mainOption['data'];
                $dataModal['perstr'] = $options['data'];
            } else {
                $dataModal['permst'] = "";
                $dataModal['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataModal['permst'] = "";
            $dataModal['perstr'] = "";
        }
        $this->load->view('components/modal/struktur', $dataModal);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/struktur/add');

        // Footer
        $this->load->view('components/footer');
    }

    public function get_auth()
    {
        $id_m_perusahaan = $this->session->userdata('id_m_perusahaan_hcdata');
        $tokenAuth = $this->session->userdata('token');
        $data = [
            'field' => 'id_m_perusahaan',
            'value' => $id_m_perusahaan,
        ];
        $result = $this->api_str->read_specific_data($data, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->read_specific_data($data, $newToken);
        }

        if ($result['status'] == 200) {
            echo json_encode([
                "statusCode" => 200,
                "auth" => $result['data'][0]['auth_m_perusahaan'],
            ]);
        } else {
            echo json_encode([
                "statusCode" => 201,
                "auth" => "",
            ]);
        }
    }

    public function pjo()
    {
        $auth_struktur = $this->input->get('auth_m_per');
        $tokenAuth = $this->session->userdata("token");

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        $id_m_perusahaan = $dataPerusahaan['data'][0]['id_m_perusahaan'];

        $paramater = [
            'field' => 'id_m_perusahaan',
            'value' => $id_m_perusahaan,
        ];
        $data['pjo'] = $this->api_str->data_pjo_order_by_tanggal($paramater, $tokenAuth);
        $this->load->view('data_master/karyawan/pjo', $data);
    }

    public function pjodetail()
    {
        $auth_struktur = $this->input->post('auth_m_per');
        $tokenAuth = $this->session->userdata("token");

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
        }

        $parameter = [
            'field' => 'id_m_perusahaan',
            'value' => $dataID['data'][0]['id_m_perusahaan'],
        ];
        $result = $this->api_str->data_pjo_order_by_tanggal($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->data_pjo_order_by_tanggal($parameter, $newToken);
        }

        if ($result['status'] == 200) {
            $data['pjo'] = $result['data'];
        } else {
            $data['pjo'] = '';
        }
        $this->load->view('data_master/struktur/pjo', $data);
    }

    public function iujpdetail()
    {
        $auth_struktur = $this->input->post('auth_m_per');
        $tokenAuth = $this->session->userdata("token");

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
        }

        $parameter = [
            'field' => 'id_m_perusahaan',
            'value' => $dataID['data'][0]['id_m_perusahaan'],
        ];
        $result = $this->api_str->data_iujp_order_by_tanggal($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->data_iujp_order_by_tanggal($parameter, $newToken);
        }

        if ($result['status'] == 200) {
            $data['izin_per'] = $result['data'];
        } else {
            $data['izin_per'] = '';
        }
        $this->load->view('data_master/struktur/izindetail', $data);
    }

    public function siodetail()
    {
        $auth_struktur = $this->input->post('auth_m_per');
        $tokenAuth = $this->session->userdata("token");

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if ($dataID['status'] == 404) {
            $data['sio_per'] = '';
        } else {
            $parameter = [
                'field' => 'id_m_perusahaan',
                'value' => $dataID['data'][0]['id_m_perusahaan'],
            ];
            $result = $this->api_str->data_sio_order_by_tanggal($parameter, $tokenAuth);
            if ($result['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_str->data_sio_order_by_tanggal($parameter, $newToken);
            }

            if ($result['status'] == 200) {
                $data['sio_per'] = $result['data'];
            } else {
                $data['sio_per'] = '';
            }
        }
        $this->load->view('data_master/struktur/siodetail', $data);
    }

    public function kontrakdetail()
    {
        $auth_struktur = $this->input->post('auth_m_per');
        $tokenAuth = $this->session->userdata("token");

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataID['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
        }

        $parameter = [
            'field' => 'id_m_perusahaan',
            'value' => $dataID['data'][0]['id_m_perusahaan'],
        ];
        $result = $this->api_str->data_kontrak_order_by_tanggal($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->data_kontrak_order_by_tanggal($parameter, $newToken);
        }

        if ($result['status'] == 200) {
            $data['kontrak_per'] = $result['data'];
        } else {
            $data['kontrak_per'] = '';
        }
        $this->load->view('data_master/struktur/kontrakdetail', $data);
    }

    public function filePJO($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $paramater = [
            'field' => 'auth_pjo_perusahaan',
            'value' => $auth,
        ];
        $data = $this->api_str->pjo($paramater, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_str->pjo($paramater, $newToken);
        }
        if ($data['status'] == 200) {
            $url_pengesahan_pjo = $data['data'][0]['url_pengesahan_pjo'];
            $id_perusahaan = $data['data'][0]['id_perusahaan'];
            if ($url_pengesahan_pjo != "") {
                $foldername = md5($id_perusahaan);
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/perusahaan/' . $foldername . '/' . $url_pengesahan_pjo,
                    ],
                    $url_pengesahan_pjo
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function fileRK3L($auth)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if ($dataPerusahaan['status'] == 200) {
            $url_rk3l = $dataPerusahaan['data'][0]['url_rk3l'];
            $id_perusahaan = $dataPerusahaan['data'][0]['id_perusahaan'];
            if ($url_rk3l != "") {
                $foldername = md5($id_perusahaan);
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/perusahaan/' . $foldername . '/' . $url_rk3l,
                    ],
                    $url_rk3l
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function fileIUJP($auth_m_per)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if ($dataPerusahaan['status'] == 200) {
            $url_izin_perusahaan = $dataPerusahaan['data'][0]['url_izin_perusahaan'];
            $id_perusahaan = $dataPerusahaan['data'][0]['id_perusahaan'];
            if ($url_izin_perusahaan != "") {
                $foldername = md5($id_perusahaan);
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/perusahaan/' . $foldername . '/' . $url_izin_perusahaan,
                    ],
                    $url_izin_perusahaan
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function fileSIO($auth_m_per)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if ($dataPerusahaan['status'] == 200) {
            $url_sio = $dataPerusahaan['data'][0]['url_sio'];
            $id_perusahaan = $dataPerusahaan['data'][0]['id_perusahaan'];
            if ($url_sio != "") {
                $foldername = md5($id_perusahaan);
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/perusahaan/' . $foldername . '/' . $url_sio,
                    ],
                    $url_sio
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    public function fileKontrak($auth_m_per)
    {
        $tokenAuth = $this->session->userdata("token");
        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterID, $newToken);
        }
        if ($dataPerusahaan['status'] == 200) {
            $url_doc_kontrak_perusahaan = $dataPerusahaan['data'][0]['url_doc_kontrak_perusahaan'];
            $id_perusahaan = $dataPerusahaan['data'][0]['id_perusahaan'];
            if ($url_doc_kontrak_perusahaan != "") {
                $foldername = md5($id_perusahaan);
                $dataPDF = $this->ftp_file->readFilePDF(
                    [
                        '/home/onedb_kary/perusahaan/' . $foldername . '/' . $url_doc_kontrak_perusahaan,
                    ],
                    $url_doc_kontrak_perusahaan
                );
                if ($dataPDF == null) {
                    redirect('not_found');
                }
            } else {
                redirect('not_found');
            }
        } else {
            redirect('not_found');
        }
    }

    // Process
    public function datatables()
    {
        $id = $this->input->post("id");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'id' => $id,
        ];

        $datatables = $this->api_str->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_str->datatables($data, $newToken);
        }
        if ($datatables['status'] == 200 || $datatables['status'] == 404) {
            $data = array(
                "statusCode" => 200,
                "data" => $datatables['data'],
            );
            echo json_encode($data);
        } else {
            $data = array(
                "statusCode" => 404,
                "pesan" => "Error",
            );
            echo json_encode($data);
        }
    }

    public function read_specific_data()
    {
        $auth_struktur = htmlspecialchars(trim($this->input->post("auth_m_per")));
        $tokenAuth = $this->session->userdata('token');

        $dataStruktur = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];
        $result = $this->api_str->read_specific_data($dataStruktur, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->read_specific_data($dataStruktur, $newToken);
        }
        if ($result['status'] == 200) {
            $auth_m_per = $result['data'][0]['auth_m_perusahaan'];
            $kode_perusahaan = $result['data'][0]['kode_perusahaan'];
            $nama_perusahaan = $result['data'][0]['nama_perusahaan'];
            $nama_m_perusahaan = $result['data'][0]['nama_m_perusahaan'];
            $url_rk3l = $result['data'][0]['url_rk3l'];
            $no_izin_perusahaan = $result['data'][0]['no_izin_perusahaan'];
            $tgl_mulai_izin = date('d-M-Y', strtotime($result['data'][0]['tgl_mulai_izin']));
            $tgl_akhir_izin = date('d-M-Y', strtotime($result['data'][0]['tgl_akhir_izin']));
            $ket_izin_perusahaan = $result['data'][0]['ket_izin_perusahaan'];
            $url_izin_perusahaan = $result['data'][0]['url_izin_perusahaan'];
            $no_sio_perusahaan = $result['data'][0]['no_sio_perusahaan'];
            $tgl_mulai_sio = date('d-M-Y', strtotime($result['data'][0]['tgl_mulai_sio']));
            $tgl_akhir_sio = date('d-M-Y', strtotime($result['data'][0]['tgl_akhir_sio']));
            $ket_sio = $result['data'][0]['ket_sio'];
            $url_sio = $result['data'][0]['url_sio'];
            $no_kontrak_perusahaan = $result['data'][0]['no_kontrak_perusahaan'];
            $tgl_mulai_kontrak = date('d-M-Y', strtotime($result['data'][0]['tgl_mulai_kontrak']));
            $tgl_akhir_kontrak = date('d-M-Y', strtotime($result['data'][0]['tgl_akhir_kontrak']));
            $ket_kontrak_perusahaan = $result['data'][0]['ket_kontrak_perusahaan'];
            $url_doc_kontrak_perusahaan = $result['data'][0]['url_doc_kontrak_perusahaan'];
            $nama_user = $result['data'][0]['nama_user'];
            $tgl_buat = date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_buat']));
            $tgl_edit = date('d-M-Y H:i:s', strtotime($result['data'][0]['tgl_edit']));
            if ($result['data'][0]['stat_m_perusahaan'] == "T") {
                $stat_m_perusahaan = "AKTIF";
            } else {
                $stat_m_perusahaan = "NONAKTIF";
            }

            if ($tgl_mulai_izin == "01-Jan-1970") {
                $tgl_izin = "Tidak ada IUJP";
                $no_izin_perusahaan = "Tidak ada IUJP";
                $ket_izin_perusahaan = "Tidak ada IUJP";
            } else {
                $tgl_izin = $tgl_mulai_izin . " - " . $tgl_akhir_izin;
                if ($ket_izin_perusahaan == "") {
                    $ket_izin_perusahaan = "-";
                }
            }

            if ($tgl_mulai_sio == "01-Jan-1970") {
                $tgl_sio = "Tidak ada SIO";
                $no_sio_perusahaan = "Tidak ada SIO";
                $ket_sio = "Tidak ada SIO";
            } else {
                $tgl_sio = $tgl_mulai_sio . " - " . $tgl_akhir_sio;
                if ($ket_sio == "") {
                    $ket_sio = "-";
                }
            }

            if ($tgl_mulai_kontrak == "01-Jan-1970") {
                $tgl_kontrak = "Tidak ada Kontrak";
                $no_kontrak_perusahaan = "Tidak ada Kontrak";
                $ket_kontrak_perusahaan = "Tidak ada Kontrak";
            } else {
                $tgl_kontrak = $tgl_mulai_kontrak . " - " . $tgl_akhir_kontrak;
                if ($ket_kontrak_perusahaan == "") {
                    $ket_kontrak_perusahaan = "-";
                }
            }

            if ($url_rk3l != "") {
                $stat_RK3L = "Ada RK3L";
            } else {
                $stat_RK3L = "Tidak ada RK3L";
            }

            $data = [
                'statusCode' => 200,
                'auth_m_per' => $auth_m_per,
                'kode_perusahaan' => $kode_perusahaan,
                'nama_perusahaan' => $nama_perusahaan,
                'nama_m_perusahaan' => $nama_m_perusahaan,
                'url_rk3l' => $url_rk3l,
                'stat_RK3L' => $stat_RK3L,
                'no_izin_perusahaan' => $no_izin_perusahaan,
                'tgl_izin' => $tgl_izin,
                'ket_izin_perusahaan' => $ket_izin_perusahaan,
                'url_izin_perusahaan' => $url_izin_perusahaan,
                'no_sio_perusahaan' => $no_sio_perusahaan,
                'tgl_sio' => $tgl_sio,
                'ket_sio' => $ket_sio,
                'url_sio' => $url_sio,
                'no_kontrak_perusahaan' => $no_kontrak_perusahaan,
                'tgl_kontrak' => $tgl_kontrak,
                'ket_kontrak_perusahaan' => $ket_kontrak_perusahaan,
                'url_doc_kontrak_perusahaan' => $url_doc_kontrak_perusahaan,
                'nama_buat' => $nama_user,
                'tgl_buat' => $tgl_buat,
                'tgl_edit' => $tgl_edit,
                'stat_m_perusahaan' => $stat_m_perusahaan,
                'pesan' => 'Sukses',
            ];
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Struktur Perusahaan tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function lokasiPJO()
    {
        $tokenAuth = $this->session->userdata('token');

        $result = $this->api_str->lokasi_pjo($tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->lokasi_pjo($newToken);
        }

        $data_lokasi = $result['data'];
        $output = "<option value=''>-- PILIH LOKASI PJO --</option>";
        if (!empty($data_lokasi)) {
            foreach ($data_lokasi as $list) {
                $output = $output . "<option value='" . $list['id_lokasi_pjo'] . "'>" . $list['lokasi_pjo'] . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "pjoo" => $output));
        } else {
            $output = "<option value=''>-- LOKASI PJO TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "pjoo" => $output));
        }
    }

    public function insert()
    {
        $this->form_validation->set_rules("idparent", "idparent", "required|trim", [
            'required' => 'Perusahaan utama wajib dipilih',
        ]);
        $this->form_validation->set_rules("kodeper", "kodeper", "required|trim", [
            'required' => 'Kode perusahaan wajib diisi',
        ]);
        $this->form_validation->set_rules("namaper", "namaper", "required|trim", [
            'required' => 'Nama perusahaan wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {

            $error = [
                'statusCode' => 202,
                'idparent' => form_error("idparent"),
                'kodeper' => form_error("kodeper"),
                'namaper' => form_error("namaper"),
            ];

            echo json_encode($error);
        } else {
            $auth_per = $this->session->userdata('auth_per_sub');
            $idparent = htmlspecialchars($this->input->post("idparent", true));
            $namaper = htmlspecialchars($this->input->post("namaper", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_perusahaan',
                'value' => $auth_per,
            ];
            $dataPerusahaan = $this->api_prs->read_specific_data($parameterID, $tokenAuth);
            if ($dataPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPerusahaan = $this->api_prs->read_specific_data($parameterID, $newToken);
            }

            $id_perusahaan = $dataPerusahaan['data'][0]['id_perusahaan'];

            $parameterID2 = [
                'field' => 'auth_m_perusahaan',
                'value' => $idparent,
            ];
            $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterID2, $tokenAuth);
            if ($dataStrukturPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataStrukturPerusahaan = $this->api_str->read_specific_data($parameterID2, $newToken);
            }

            $id_parent = $dataStrukturPerusahaan['data'][0]['id_m_perusahaan'];
            $id_jenis = $dataStrukturPerusahaan['data'][0]['id_jenis_perusahaan'];

            $parameterCheckData = [
                'source' => 'vw_m_prs',
                'field' => 'id_parent',
                'value' => $id_parent,
                'field2' => 'id_perusahaan',
                'value2' => $id_perusahaan,
            ];

            $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $tokenAuth, $parameterCheckData);
            if ($checkData['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $checkData = $this->std->api($this->specificData2Fields(), $this->getMethod(), $newToken, $parameterCheckData);
            }

            if ($checkData['status'] == 200) {
                echo json_encode(array(
                    'statusCode' => 201,
                    'kode_pesan' => 'Gagal',
                    'tipe_pesan' => 'error',
                    'pesan' => 'Perusahaan yang dipilih sudah ada di Struktur Perusahaan!',
                    'kode_pesan' => 'Gagal',
                    'tipe_pesan' => 'error',
                ));
                return;
            }

            $paramater = [
                'id_jenis' => $id_jenis,
                'id_parent' => $id_parent,
                'id_perusahaan' => $id_perusahaan,
                'namaper' => $namaper,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $result = $this->api_str->create($paramater, $tokenAuth);
            if ($result == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_str->create($parameter, $newToken);
            }
            if ($result == 201) {
                $dataStrukturPerusahaan = $this->api_str->read_lastest_data($tokenAuth);
                if ($dataStrukturPerusahaan['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $dataStrukturPerusahaan = $this->api_str->read_lastest_data($newToken);
                }
                $auth_m_per = $dataStrukturPerusahaan['data'][0]['auth_m_perusahaan'];
                echo json_encode(array(
                    'statusCode' => 200,
                    'pesan' => 'Data struktur perusahaan berhasil disimpan, lanjut lengkapi data selanjutnya',
                    'auth_m_per' => $auth_m_per,
                    'auth_parent' => $idparent,
                    'auth_per' => $auth_per,
                    'kode_pesan' => 'Berhasil',
                    'tipe_pesan' => 'success',
                ));
            } else {
                echo json_encode(array(
                    'statusCode' => 201,
                    'kode_pesan' => 'Gagal',
                    'tipe_pesan' => 'error',
                    'pesan' => 'Data struktur perusahaan gagal disimpan',
                    'kode_pesan' => 'Gagal',
                    'tipe_pesan' => 'error',
                ));
            }
        }
    }

    public function insert_IUJP()
    {
        $this->form_validation->set_rules("no_iujp", "no_iujp", "required|trim", [
            'required' => 'No. IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_iujp", "tgl_awal_iujp", "required|trim", [
            'required' => 'Tanggal mulai IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_iujp", "tgl_akhir_iujp", "required|trim", [
            'required' => 'Tanggal akhir IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_iujp", "ket_iujp", "trim");

        if ($this->form_validation->run() == false) {
            $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

            if ($fileiujp == "") {
                $errupload = "<p>File IUJP wajib diupload</p>";
            } else {
                $errupload = "";
            }

            $error = [
                'statusCode' => 202,
                'no_iujp' => form_error("no_iujp"),
                'tgl_awal_iujp' => form_error("tgl_awal_iujp"),
                'tgl_akhir_iujp' => form_error("tgl_akhir_iujp"),
                'auth_m_per' => form_error("auth_m_per"),
                'fileiujp' => $errupload,
            ];

            echo json_encode($error);
        } else {
            $no_iujp = htmlspecialchars($this->input->post("no_iujp", true));
            $tgl_awal_iujp = htmlspecialchars($this->input->post("tgl_awal_iujp", true));
            $tgl_akhir_iujp = htmlspecialchars($this->input->post("tgl_akhir_iujp", true));
            $ket_iujp = htmlspecialchars($this->input->post("ket_iujp", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_iujp));
            $nama_file = $tglakhir . "-" . $now . "-IUJP.pdf";
            $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

            if ($fileiujp == "") {
                echo json_encode(array('statusCode' => 202, 'fileiujp' => '<p>File IUJP wajib dipilih</p>'));
                return;
            }

            if ($tgl_awal_iujp > $tgl_akhir_iujp) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_iujp' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkIzin = [
                'field' => 'no_izin_perusahaan',
                'value' => $no_iujp,
            ];

            $cek_izin = $this->api_str->data_iujp_order_by_tanggal($checkIzin, $tokenAuth);
            if ($cek_izin['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_izin = $this->api_str->data_iujp_order_by_tanggal($checkIzin, $newToken);
            }

            if ($cek_izin['status'] == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'IUJP/Perizinan dengan Nomor : ' . $no_iujp . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'fliujp';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $paramater = [
                        'id_m_per' => $id_m_per,
                        'no_iujp' => $no_iujp,
                        'tgl_awal_iujp' => $tgl_awal_iujp,
                        'tgl_akhir_iujp' => $tgl_akhir_iujp,
                        'nama_file' => $nama_file,
                        'ket_iujp' => $ket_iujp,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $result = $this->api_str->create_iujp($paramater, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->create_iujp($paramater, $newToken);
                    }
                    if ($result == 201) {
                        $lastIUJP = $this->api_str->lastest_data_iujp($tokenAuth);
                        if ($lastIUJP['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastIUJP = $this->api_str->lastest_data_iujp($newToken);
                        }
                        if ($lastIUJP['status'] == 200) {
                            $auth_izin = $lastIUJP['data'][0]['auth_izin_perusahaan'];
                        } else {
                            $auth_izin = '';
                        }
                        $link = base_url('Struktur_api/fileIUJP/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data IUJP berhasil disimpan', "tipe_pesan" => "success", "auth_izin" => $auth_izin, "link" => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data IUJP gagal disimpan', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File IUJP gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File IUJP gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function insert_SIO()
    {
        $this->form_validation->set_rules("no_sio", "no_sio", "required|trim", [
            'required' => 'No. SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_sio", "tgl_awal_sio", "required|trim", [
            'required' => 'Tanggal mulai SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_sio", "tgl_akhir_sio", "required|trim", [
            'required' => 'Tanggal akhir SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_sio", "ket_sio", "trim");

        if ($this->form_validation->run() == false) {

            $filesio = htmlspecialchars($this->input->post("filesio", true));
            if ($filesio == "") {
                $errfile = "<p>File SIO wajib dipilih</p>";
            } else {
                $errfile = "";
            }

            $error = [
                'statusCode' => 202,
                'no_sio' => form_error("no_sio"),
                'tgl_awal_sio' => form_error("tgl_awal_sio"),
                'tgl_akhir_sio' => form_error("tgl_akhir_sio"),
                'filesio' => $errfile,
            ];

            echo json_encode($error);
        } else {
            $no_sio = htmlspecialchars($this->input->post("no_sio", true));
            $tgl_awal_sio = htmlspecialchars($this->input->post("tgl_awal_sio", true));
            $tgl_akhir_sio = htmlspecialchars($this->input->post("tgl_akhir_sio", true));
            $ket_sio = htmlspecialchars($this->input->post("ket_sio", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_sio));
            $nama_file = $tglakhir . "-" . $now . "-SIO.pdf";

            $filesio = htmlspecialchars($this->input->post("filesio", true));
            if ($filesio == "") {
                echo json_encode(array('statusCode' => 202, 'filesio' => '<p>File SIO wajib diupload</p>'));
                return;
            }

            if ($tgl_awal_sio > $tgl_akhir_sio) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_sio' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkSIO = [
                'field' => 'no_sio_perusahaan',
                'value' => $no_sio,
            ];

            $cek_sio = $this->api_str->data_sio_order_by_tanggal($checkSIO, $tokenAuth);
            if ($cek_sio['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_sio = $this->api_str->data_sio_order_by_tanggal($checkSIO, $newToken);
            }
            if ($cek_sio['status'] == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'SIO dengan Nomor : ' . $no_sio . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'flsio';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $parameter = [
                        'id_m_per' => $id_m_per,
                        'no_sio' => $no_sio,
                        'tgl_awal_sio' => $tgl_awal_sio,
                        'tgl_akhir_sio' => $tgl_akhir_sio,
                        'nama_file' => $nama_file,
                        'ket_sio' => $ket_sio,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $result = $this->api_str->create_sio($parameter, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->create_sio($paramater, $newToken);
                    }
                    if ($result == 201) {
                        $lastSIO = $this->api_str->lastest_data_sio($tokenAuth);
                        if ($lastSIO['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastSIO = $this->api_str->lastest_data_sio($newToken);
                        }
                        if ($lastSIO['status'] == 200) {
                            $auth_sio = $lastSIO['data'][0]['auth_sio_perusahaan'];
                        } else {
                            $auth_sio = '';
                        }
                        $link = base_url('Struktur_api/fileSIO/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data SIO berhasil disimpan', "auth_sio" => $auth_sio, "tipe_pesan" => "success", 'link' => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data SIO gagal disimpan', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File SIO gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File SIO gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function insert_kontrak()
    {
        $this->form_validation->set_rules("no_kontrak", "no_kontrak", "required|trim", [
            'required' => 'No. kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_kontrak", "tgl_awal_kontrak", "required|trim", [
            'required' => 'Tanggal mulai kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_kontrak", "tgl_akhir_kontrak", "required|trim", [
            'required' => 'Tanggal akhir kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_kontrak", "ket_kontrak", "trim");

        if ($this->form_validation->run() == false) {
            $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
            if ($filekontrak == "") {
                $errfile = "<p>File kontrak wajib dipilih</p>";
            } else {
                $errfile = "";
            }

            $error = [
                'statusCode' => 202,
                'no_kontrak' => form_error("no_kontrak"),
                'tgl_awal_kontrak' => form_error("tgl_awal_kontrak"),
                'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
                'filekontrak' => $errfile,
            ];

            echo json_encode($error);
        } else {
            $no_kontrak = htmlspecialchars($this->input->post("no_kontrak", true));
            $tgl_awal_kontrak = htmlspecialchars($this->input->post("tgl_awal_kontrak", true));
            $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
            $ket_kontrak = htmlspecialchars($this->input->post("ket_kontrak", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_kontrak));
            $nama_file = $tglakhir . "-" . $now . "-KONTRAK.pdf";

            $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
            if ($filekontrak == "") {
                echo json_encode(array('statusCode' => 202, 'filekontrak' => '<p>File kontrak wajib diupload</p>'));
                return;
            }

            if ($tgl_awal_kontrak > $tgl_akhir_kontrak) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_kontrak' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkKontrak = [
                'field' => 'no_kontrak_perusahaan',
                'value' => $no_kontrak,
            ];

            $cek_kontrak = $this->api_str->data_kontrak_order_by_tanggal($checkKontrak, $tokenAuth);
            if ($cek_kontrak['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_kontrak = $this->api_str->data_kontrak_order_by_tanggal($checkKontrak, $newToken);
            }
            if ($cek_kontrak == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Kontrak dengan Nomor : ' . $no_kontrak . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'flkontrak';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $parameter = [
                        'id_m_per' => $id_m_per,
                        'no_kontrak' => $no_kontrak,
                        'ket_kontrak' => $ket_kontrak,
                        'tgl_awal_kontrak' => $tgl_awal_kontrak,
                        'tgl_akhir_kontrak' => $tgl_akhir_kontrak,
                        'nama_file' => $nama_file,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $result = $this->api_str->create_kontrak($parameter, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->create_kontrak($parameter, $newToken);
                    }

                    if ($result == 201) {
                        $lastKontrak = $this->api_str->lastest_data_kontrak($tokenAuth);
                        if ($lastKontrak['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastKontrak = $this->api_str->lastest_data_kontrak($newToken);
                        }
                        if ($lastKontrak['status'] == 200) {
                            $auth_kontrak = $lastKontrak['data'][0]['auth_kontrak_perusahaan'];
                        } else {
                            $auth_kontrak = '';
                        }
                        $link = base_url('Struktur_api/fileKontrak/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data kontrak berhasil disimpan', "auth_kontrak" => $auth_kontrak, "tipe_pesan" => "success", "link" => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data kontrak gagal disimpan', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File kontrak gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File kontrak gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function insert_PJO()
    {
        $this->form_validation->set_rules("no_pjo", "no_pjo", "required|trim", [
            'required' => 'No. pengesahan PJO wajib diisi',
        ]);
        $this->form_validation->set_rules("id_lokker", "id_lokker", "required|trim", [
            'required' => 'Lokasi kerja PJO wajib dipilih',
        ]);
        $this->form_validation->set_rules("tgl_awal_pjo", "tgl_awal_pjo", "required|trim", [
            'required' => 'Tanggal aktif wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_pjo", "tgl_akhir_pjo", "required|trim", [
            'required' => 'Tanggal akhir wajib diisi',
        ]);
        $this->form_validation->set_rules("ketpjo", "ketpjo", "trim");

        $this->form_validation->set_rules("ktp_pjo", "ktp_pjo", "required|trim", [
            'required' => 'No. KTP PJO wajib diisi',
        ]);
        $this->form_validation->set_rules("nik_pjo", "nik_pjo", "required|trim", [
            'required' => 'NIK PJO wajib diisi',
        ]);
        $this->form_validation->set_rules("nama_pjo", "nama_pjo", "required|trim", [
            'required' => 'Nama PJO Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {

            $filepjo = htmlspecialchars($this->input->post("filepjo", true));
            if ($filepjo == "") {
                $errfile = "<p>File pengesahan PJO wajib diupload</p>";
            } else {
                $errfile = "";
            }

            $error = [
                'statusCode' => 202,
                'no_pjo' => form_error("no_pjo"),
                'id_lokker' => form_error("id_lokker"),
                'tgl_awal_pjo' => form_error("tgl_awal_pjo"),
                'tgl_akhir_pjo' => form_error("tgl_akhir_pjo"),
                'ktp_pjo' => form_error("ktp_pjo"),
                'nik_pjo' => form_error("nik_pjo"),
                'nama_pjo' => form_error("nama_pjo"),
                'filepjo' => $errfile,
            ];

            echo json_encode($error);
            return;
        } else {
            $no_pjo = htmlspecialchars($this->input->post("no_pjo", true));
            $lokker_pjo = htmlspecialchars($this->input->post("id_lokker", true));
            $tgl_aktif_pjo = htmlspecialchars($this->input->post("tgl_awal_pjo", true));
            $tgl_akhir_pjo = htmlspecialchars($this->input->post("tgl_akhir_pjo", true));
            $ket_pjo = htmlspecialchars($this->input->post("ket_pjo", true));
            $ktp_pjo = htmlspecialchars($this->input->post("ktp_pjo", true));
            $nik_pjo = htmlspecialchars($this->input->post("nik_pjo", true));
            $nama_pjo = htmlspecialchars($this->input->post("nama_pjo", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $filepjo = htmlspecialchars($this->input->post("filepjo", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_pjo));
            $nama_file = $tglakhir . "-" . $now . "-PJO.pdf";

            if ($filepjo == "") {
                $errfile = "<p>File pengesahan PJO wajib diupload</p>";
                echo json_encode(array("statusCode" => 202, "filepjo" => "<p>File pengesahan PJO wajib diupload</p>"));
                return;
            }

            if ($tgl_aktif_pjo > $tgl_akhir_pjo) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_pjo' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkPJO = [
                'field' => 'no_pengesahan_pjo',
                'value' => $no_pjo,
            ];

            $cek_pjo = $this->api_str->data_pjo_order_by_tanggal($checkPJO, $tokenAuth);
            if ($cek_pjo['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_pjo = $this->api_str->data_pjo_order_by_tanggal($checkPJO, $newToken);
            }

            if ($cek_pjo['status'] == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Pengesahan PJO dengan Nomor : ' . $no_pjo . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            $parameterIDKaryawan = [
                'field' => 'auth_karyawan',
                'value' => $auth_kary,
            ];
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
            if ($dataKaryawan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
            }

            if ($dataKaryawan['status'] == 404) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Karyawan PJO tidak ditemukan", 'pesan' => 'Harap buat data karyawan PJO terlebih dahulu', "tipe_pesan" => "error"));
                return;
            }
            $id_karyawan = $dataKaryawan['data'][0]['id_kary'];

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'flpjo';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $paramater = [
                        'id_m_per' => $id_m_per,
                        'lokker_pjo' => $lokker_pjo,
                        'id_karyawan' => $id_karyawan,
                        'no_pjo' => $no_pjo,
                        'tgl_aktif_pjo' => $tgl_aktif_pjo,
                        'tgl_akhir_pjo' => $tgl_akhir_pjo,
                        'nama_file' => $nama_file,
                        'ket_pjo' => $ket_pjo,
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $result = $this->api_str->create_pjo($paramater, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->create_pjo($paramater, $newToken);
                    }

                    if ($result == 201) {
                        echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data PJO berhasil disimpan', "tipe_pesan" => "success"));
                    } else {
                        echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data PJO gagal disimpan', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File PJO gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File PJO gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function update()
    {
        $auth_struktur = htmlspecialchars($this->input->post("auth_m_per", true));
        $namaper = htmlspecialchars($this->input->post("namaper", true));
        $tokenAuth = $this->session->userdata('token');

        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];

        $id_struktur = $this->api_str->read_specific_data($dataID, $tokenAuth);
        if ($id_struktur['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_struktur = $this->api_str->read_specific_data($dataID, $newToken);
        }

        if ($id_struktur['data'][0]['id_m_perusahaan'] != "") {
            $parameter = [
                'nama_perusahaan' => $namaper,
                'id_m_perusahaan' => $id_struktur['data'][0]['id_m_perusahaan'],
            ];

            $updstr = $this->api_str->update($parameter, $tokenAuth);
            if ($updstr == 200) {
                $this->session->set_flashdata("updstr_sukses", "1");
                echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Nama perusahaan berhasil diupdate", "tipe_pesan" => "success"));
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Nama perusahaan gagal diupdate", "tipe_pesan" => "error"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Data perusahaan tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function update_IUJP()
    {
        $this->form_validation->set_rules("no_iujp", "no_iujp", "required|trim", [
            'required' => 'No. IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_iujp", "tgl_awal_iujp", "required|trim", [
            'required' => 'Tanggal mulai IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_iujp", "tgl_akhir_iujp", "required|trim", [
            'required' => 'Tanggal akhir IUJP wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_iujp", "ket_iujp", "trim");

        if ($this->form_validation->run() == false) {
            $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

            if ($fileiujp == "") {
                $errupload = "<p>File IUJP wajib diupload</p>";
            } else {
                $errupload = "";
            }

            $error = [
                'statusCode' => 202,
                'no_iujp' => form_error("no_iujp"),
                'tgl_awal_iujp' => form_error("tgl_awal_iujp"),
                'tgl_akhir_iujp' => form_error("tgl_akhir_iujp"),
                'fileiujp' => $errupload,
            ];

            echo json_encode($error);
        } else {
            $no_iujp = htmlspecialchars($this->input->post("no_iujp", true));
            $tgl_awal_iujp = htmlspecialchars($this->input->post("tgl_awal_iujp", true));
            $tgl_akhir_iujp = htmlspecialchars($this->input->post("tgl_akhir_iujp", true));
            $ket_iujp = htmlspecialchars($this->input->post("ket_iujp", true));
            $auth_iujp = htmlspecialchars($this->input->post("auth_iujp", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $auth_per = htmlspecialchars($this->input->post("auth_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_iujp));
            $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

            if ($fileiujp == "") {
                echo json_encode(array('statusCode' => 202, 'fileiujp' => '<p>File IUJP wajib dipilih</p>'));
                return;
            }

            if ($tgl_awal_iujp > $tgl_akhir_iujp) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_iujp' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkIzin = [
                'field' => 'no_izin_perusahaan',
                'value' => $no_iujp,
            ];

            $cek_izin = $this->api_str->data_iujp_order_by_tanggal($checkIzin, $tokenAuth);
            if ($cek_izin['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_izin = $this->api_str->data_iujp_order_by_tanggal($checkIzin, $newToken);
            }

            if ($cek_izin['status'] == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'IUJP/Perizinan dengan Nomor : ' . $no_iujp . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            $paramaterUrl = [
                'field' => 'auth_izin_perusahaan',
                'value' => $auth_iujp,
            ];
            $dataIUJP = $this->api_str->data_iujp_order_by_tanggal($paramaterUrl, $tokenAuth);
            if ($dataIUJP['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataIUJP = $this->api_str->data_iujp_order_by_tanggal($paramaterUrl, $newToken);
            }
            $url_izin = $dataIUJP['data'][0]['url_izin_perusahaan'];
            $id_izin = $dataIUJP['data'][0]['id_izin_perusahaan'];

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'fliujp';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $url_izin);
                if ($uploadFile == 200) {
                    $paramaterUpdateIUJP = [
                        'id_izin' => $id_izin,
                        'no_iujp' => $no_iujp,
                        'tgl_awal_iujp' => $tgl_awal_iujp,
                        'tgl_akhir_iujp' => $tgl_akhir_iujp,
                        'nama_file' => $nama_file,
                        'ket_iujp' => $ket_iujp,
                    ];

                    $result = $this->api_str->update_iujp($paramaterUpdateIUJP, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->update_iujp($paramaterUpdateIUJP, $newToken);
                    }
                    if ($result == 200) {
                        $lastIUJP = $this->api_str->lastest_data_iujp($tokenAuth);
                        if ($lastIUJP['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastIUJP = $this->api_str->lastest_data_iujp($newToken);
                        }
                        if ($lastIUJP['status'] == 200) {
                            $auth_izin = $lastIUJP['data'][0]['auth_izin_perusahaan'];
                        } else {
                            $auth_izin = '';
                        }
                        $link = base_url('Struktur_api/fileIUJP/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data IUJP berhasil diupdate', "tipe_pesan" => "success", "auth_izin" => $auth_izin, "link" => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data IUJP gagal diupdate', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File IUJP gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File IUJP gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function update_SIO()
    {
        $this->form_validation->set_rules("no_sio", "no_sio", "required|trim", [
            'required' => 'No. SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_sio", "tgl_awal_sio", "required|trim", [
            'required' => 'Tanggal mulai SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_sio", "tgl_akhir_sio", "required|trim", [
            'required' => 'Tanggal akhir SIO wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_sio", "ket_sio", "trim");

        if ($this->form_validation->run() == false) {

            $filesio = htmlspecialchars($this->input->post("filesio", true));
            if ($filesio == "") {
                $errfile = "<p>File SIO wajib dipilih</p>";
            } else {
                $errfile = "";
            }

            $error = [
                'statusCode' => 202,
                'no_sio' => form_error("no_sio"),
                'tgl_awal_sio' => form_error("tgl_awal_sio"),
                'tgl_akhir_sio' => form_error("tgl_akhir_sio"),
                'filesio' => $errfile,
            ];

            echo json_encode($error);
        } else {
            $no_sio = htmlspecialchars($this->input->post("no_sio", true));
            $tgl_awal_sio = htmlspecialchars($this->input->post("tgl_awal_sio", true));
            $tgl_akhir_sio = htmlspecialchars($this->input->post("tgl_akhir_sio", true));
            $ket_sio = htmlspecialchars($this->input->post("ket_sio", true));
            $auth_sio = htmlspecialchars($this->input->post("auth_sio", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $auth_per = htmlspecialchars($this->input->post("auth_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_sio));

            $filesio = htmlspecialchars($this->input->post("filesio", true));
            if ($filesio == "") {
                echo json_encode(array('statusCode' => 202, 'filesio' => '<p>File SIO wajib diupload</p>'));
                return;
            }

            if ($tgl_awal_sio > $tgl_akhir_sio) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_sio' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkSIO = [
                'field' => 'no_sio_perusahaan',
                'value' => $no_sio,
            ];

            $cek_sio = $this->api_str->data_sio_order_by_tanggal($checkSIO, $tokenAuth);
            if ($cek_sio['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_sio = $this->api_str->data_sio_order_by_tanggal($checkSIO, $newToken);
            }
            if ($cek_sio['status'] == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'SIO dengan Nomor : ' . $no_sio . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            $paramaterUrl = [
                'field' => 'auth_sio_perusahaan',
                'value' => $auth_sio,
            ];
            $dataSIO = $this->api_str->data_sio_order_by_tanggal($paramaterUrl, $tokenAuth);
            if ($dataSIO['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataSIO = $this->api_str->data_sio_order_by_tanggal($paramaterUrl, $newToken);
            }
            $url_sio = $dataSIO['data'][0]['url_sio'];
            $id_sio = $dataSIO['data'][0]['id_sio_perusahaan'];

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'flsio';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $url_sio);
                if ($uploadFile == 200) {
                    $paramater = [
                        'id_sio' => $id_sio,
                        'no_sio' => $no_sio,
                        'tgl_mulai_sio' => $tgl_awal_sio,
                        'tgl_akhir_sio' => $tgl_akhir_sio,
                        'url_sio' => $nama_file,
                        'ket_sio' => $ket_sio,
                    ];

                    $result = $this->api_str->update_sio($paramater, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->update_sio($paramater, $newToken);
                    }
                    if ($result == 200) {
                        $lastSIO = $this->api_str->lastest_data_sio($tokenAuth);
                        if ($lastSIO['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastSIO = $this->api_str->lastest_data_sio($newToken);
                        }
                        if ($lastSIO['status'] == 200) {
                            $auth_sio = $lastSIO['data'][0]['auth_sio_perusahaan'];
                        } else {
                            $auth_sio = '';
                        }
                        $link = base_url('Struktur_api/fileSIO/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data SIO berhasil diupdate', "tipe_pesan" => "success", "auth_sio" => $auth_sio, 'link' => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data SIO gagal diupdate', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File SIO gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File SIO gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function update_kontrak()
    {
        $this->form_validation->set_rules("no_kontrak", "no_kontrak", "required|trim", [
            'required' => 'No. kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_awal_kontrak", "tgl_awal_kontrak", "required|trim", [
            'required' => 'Tanggal mulai kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_kontrak", "tgl_akhir_kontrak", "required|trim", [
            'required' => 'Tanggal akhir kontrak wajib diisi',
        ]);
        $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
            'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor',
        ]);
        $this->form_validation->set_rules("ket_kontrak", "ket_kontrak", "trim");

        if ($this->form_validation->run() == false) {
            $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
            if ($filekontrak == "") {
                $errfile = "<p>File kontrak wajib dipilih</p>";
            } else {
                $errfile = "";
            }

            $error = [
                'statusCode' => 202,
                'no_kontrak' => form_error("no_kontrak"),
                'tgl_awal_kontrak' => form_error("tgl_awal_kontrak"),
                'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
                'filekontrak' => $errfile,
            ];

            echo json_encode($error);
        } else {
            $no_kontrak = htmlspecialchars($this->input->post("no_kontrak", true));
            $tgl_awal_kontrak = htmlspecialchars($this->input->post("tgl_awal_kontrak", true));
            $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
            $ket_kontrak = htmlspecialchars($this->input->post("ket_kontrak", true));
            $auth_kontrak = htmlspecialchars($this->input->post("auth_kontrak", true));
            $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
            $auth_per = htmlspecialchars($this->input->post("auth_per", true));
            $tokenAuth = $this->session->userdata('token');

            $parameterID = [
                'field' => 'auth_m_perusahaan',
                'value' => $auth_m_per,
            ];

            $dataID = $this->api_str->read_specific_data($parameterID, $tokenAuth);
            if ($dataID['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataID = $this->api_str->read_specific_data($parameterID, $newToken);
            }

            $id_m_per = $dataID['data'][0]['id_m_perusahaan'];
            $id_per = $dataID['data'][0]['id_perusahaan'];
            $namafolder = md5($id_per);
            $now = date('YmdHis');
            $tglakhir = date('Ymd', strtotime($tgl_akhir_kontrak));

            $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
            if ($filekontrak == "") {
                echo json_encode(array('statusCode' => 202, 'filekontrak' => '<p>File kontrak wajib diupload</p>'));
                return;
            }

            if ($tgl_awal_kontrak > $tgl_akhir_kontrak) {
                echo json_encode(array('statusCode' => 202, 'tgl_akhir_kontrak' => '<p>Isi tanggal berakhir dengan benar</p>'));
                return;
            }

            $checkKontrak = [
                'field' => 'no_kontrak_perusahaan',
                'value' => $no_kontrak,
            ];

            $cek_kontrak = $this->api_str->data_kontrak_order_by_tanggal($checkKontrak, $tokenAuth);
            if ($cek_kontrak['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $cek_kontrak = $this->api_str->data_kontrak_order_by_tanggal($checkKontrak, $newToken);
            }
            if ($cek_kontrak == 200) {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Kontrak dengan Nomor : ' . $no_kontrak . ' Sudah digunakan', "tipe_pesan" => "error"));
                return;
            }

            $paramaterDataKontrak = [
                'field' => 'auth_kontrak_perusahaan',
                'value' => $auth_kontrak,
            ];
            $dataKontrakPerusahaan = $this->api_str->data_kontrak_order_by_tanggal($paramaterDataKontrak, $tokenAuth);
            if ($dataKontrakPerusahaan['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataKontrakPerusahaan = $this->api_str->data_kontrak_order_by_tanggal($paramaterDataKontrak, $newToken);
            }
            $url_kontrak = $dataKontrakPerusahaan['data'][0]['url_doc_kontrak_perusahaan'];
            $id_kontrak = $dataKontrakPerusahaan['data'][0]['id_kontrak_perusahaan'];

            if ($id_m_per != "") {
                $extension = 'pdf';
                $inputName = 'flkontrak';
                $fileSize = 110;
                $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
                if ($uploadFile == 200) {
                    $parameter = [
                        'id_kontrak' => $id_kontrak,
                        'no_kontrak' => $no_kontrak,
                        'ket_kontrak' => $ket_kontrak,
                        'tgl_mulai' => $tgl_awal_kontrak,
                        'tgl_akhir' => $tgl_akhir_kontrak,
                        'nama_file' => $nama_file,
                    ];

                    $result = $this->api_str->update_kontrak($parameter, $tokenAuth);
                    if ($result == 403) {
                        $this->session->unset_userdata('token');
                        $tokenData = $this->api_tkn->getToken($this->tokenData());
                        $this->session->set_userdata('token', $tokenData['data']);
                        $newToken = $this->session->userdata('token');
                        $result = $this->api_str->update_kontrak($parameter, $newToken);
                    }
                    if ($result == 200) {
                        $lastKontrak = $this->api_str->lastest_data_kontrak($tokenAuth);
                        if ($lastKontrak['status'] == 403) {
                            $this->session->unset_userdata('token');
                            $tokenData = $this->api_tkn->getToken($this->tokenData());
                            $this->session->set_userdata('token', $tokenData['data']);
                            $newToken = $this->session->userdata('token');
                            $lastKontrak = $this->api_str->lastest_data_kontrak($newToken);
                        }
                        if ($lastKontrak['status'] == 200) {
                            $auth_kontrak = $lastKontrak['data'][0]['auth_kontrak_perusahaan'];
                        } else {
                            $auth_kontrak = '';
                        }
                        $link = base_url('Struktur_api/fileKontrak/') . $auth_m_per;
                        echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data kontrak berhasil diupdate', "auth_kontrak" => $auth_kontrak, "tipe_pesan" => "success", "link" => $link));
                    } else {
                        echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data kontrak gagal diupdate', "tipe_pesan" => "error"));
                    }
                } elseif ($uploadFile == 400) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File kontrak gagal diupload", "tipe_pesan" => "error"));
                } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
                } else {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File kontrak gagal diupload", "tipe_pesan" => "error"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
            }
        }
    }

    public function update_RK3L()
    {
        $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
        $tokenAuth = $this->session->userdata('token');

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];

        $dataDetail = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataDetail['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataDetail = $this->api_str->read_specific_data($parameterID, $newToken);
        }

        $id_m_per = $dataDetail['data'][0]['id_m_perusahaan'];
        $id_per = $dataDetail['data'][0]['id_perusahaan'];
        $namafolder = md5($id_per);
        $now = date('YmdHis');
        if (empty($dataDetail['data'][0]['url_rk3l'])) {
            $nama_file = $now . "-RK3L.pdf";
        } else {
            $nama_file = $dataDetail['data'][0]['url_rk3l'];
        }

        $filerk3l = htmlspecialchars($this->input->post("filerk3l", true));
        if ($filerk3l == "") {
            echo json_encode(array('statusCode' => 202, 'filerk3l' => '<p>File RK3L wajib diupload</p>'));
            return;
        }

        if ($id_m_per != "") {
            $extension = 'pdf';
            $inputName = 'flrk3l';
            $fileSize = 610;
            $uploadFile = $this->ftp_file->uploadFilePerusahaan($namafolder, $extension, $inputName, $fileSize, $nama_file);
            if ($uploadFile == 200) {
                $parameter = [
                    'nama_file' => $nama_file,
                    'id_m_perusahaan' => $id_m_per,
                ];

                $result = $this->api_str->edit_rk3l($parameter, $tokenAuth);
                if ($result == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $result = $this->api_str->edit_rk3l($parameter, $newToken);
                }
                if ($result == 200) {
                    $link = base_url('Struktur_api/fileRK3L/') . $auth_m_per;
                    echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data RK3L berhasil disimpan', 'link' => $link, "tipe_pesan" => "success"));
                } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data RK3L gagal disimpan', "tipe_pesan" => "error"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File RK3L gagal diupload", "tipe_pesan" => "error"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Server error, hubungi administrator", "tipe_pesan" => "error"));
            } else {
                echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "File RK3L gagal diupload", "tipe_pesan" => "error"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
        }
    }

    public function reset_IUJP()
    {
        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
        $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
        $tokenAuth = $this->session->userdata('token');
        $parameterPerusahaan = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $parameterIUJP = [
            'field' => 'auth_izin_perusahaan',
            'value' => $auth_izin,
        ];

        $dataPerusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $tokenAuth);
        if ($dataPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataPerusahaan = $this->api_str->read_specific_data($parameterPerusahaan, $newToken);
        }
        $dataIUJP = $this->api_str->data_iujp_order_by_tanggal($parameterIUJP, $tokenAuth);
        if ($dataIUJP['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataIUJP = $this->api_str->data_iujp_order_by_tanggal($parameterIUJP, $newToken);
        }

        $id_izin = $dataIUJP['data'][0]['id_izin_perusahaan'];
        $id_per = $dataPerusahaan['data'][0]['id_perusahaan'];
        $namafolder = md5($id_per);
        $url_iujp = $dataIUJP['data'][0]['url_izin_perusahaan'];

        if ($url_iujp != "") {
            $this->ftp_file->deleteFile($namafolder, $url_iujp);
        }

        if ($id_izin != "") {
            $paramater = [
                'id_izin' => $id_izin,
            ];
            $result = $this->api_str->delete_iujp($paramater, $tokenAuth);
            if ($result == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_str->delete_iujp($paramater, $newToken);
            }
            if ($result == 200) {
                echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data IUJP/Perizinan berhasil Hapus', "tipe_pesan" => "error"));
            } else {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data IUJP/Perizinan gagal Hapus', "tipe_pesan" => "error"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perizinan", "tipe_pesan" => "error"));
        }
    }

    public function reset_RK3L()
    {
        $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));

        $parameterID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];

        $dataDetail = $this->api_str->read_specific_data($parameterID, $tokenAuth);
        if ($dataDetail['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataDetail = $this->api_str->read_specific_data($parameterID, $newToken);
        }

        $id_m_per = $dataDetail['data'][0]['id_m_perusahaan'];
        $id_per = $dataDetail['data'][0]['id_perusahaan'];
        $namafolder = md5($id_per);
        $url_rk3l = $dataDetail['data'][0]['url_rk3l'];

        if ($url_rk3l != "") {
            $this->ftp_file->deleteFile($namafolder, $url_rk3l);
        }
        if ($id_m_per != "") {
            $parameter = [
                'nama_file' => '',
                'id_m_perusahaan' => $id_m_per,
            ];

            $result = $this->api_str->edit_rk3l($parameter, $tokenAuth);
            if ($result == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_str->edit_rk3l($parameter, $newToken);
            }
            if ($result == 200) {
                echo json_encode(array('statusCode' => 200, "kode_pesan" => "Berhasil", 'pesan' => 'Data RK3L berhasil direset', "tipe_pesan" => "success"));
            } else {
                echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", 'pesan' => 'Data RK3L gagal direset', "tipe_pesan" => "error"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Error saat mengambil data perusahaan", "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_struktur = htmlspecialchars(trim($this->input->post('auth_m_per')));
        $tokenAuth = $this->session->userdata('token');
        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_struktur,
        ];

        $checkData = $this->api_kry->read_specific_data($dataID, $tokenAuth);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->api_kry->read_specific_data($dataID, $newToken);
        }

        if ($checkData['status'] == 200) {
            echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Data struktur perusahaan tidak dapat dihapus, digunakan pada data karyawan", "tipe_pesan" => "error"));
            return;
        }

        $id_struktur = $this->api_str->read_specific_data($dataID, $tokenAuth);
        if ($id_struktur['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $id_struktur = $this->api_str->read_specific_data($dataID, $newToken);
        }

        $data = [
            'id_m_perusahaan' => $id_struktur['data'][0]['id_m_perusahaan'],
        ];

        $result = $this->api_str->delete($data, $tokenAuth);
        if ($result == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_str->delete($data, $newToken);
        }
        if ($result == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Struktur Perusahaan berhasil dihapus", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Struktur Perusahaan gagal dihapus", "tipe_pesan" => "error"));
        }
    }
}