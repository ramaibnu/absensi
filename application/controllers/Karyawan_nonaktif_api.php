<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_nonaktif_api extends MY_Controller
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
    public function index()
    {
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
                $dataMain['permst'] = $mainOption['data'];
                $dataMain['perstr'] = $options['data'];
            } else {
                $dataMain['permst'] = "";
                $dataMain['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataMain['permst'] = "";
            $dataMain['perstr'] = "";
        }
        $this->load->view('karyawan_nonaktif/view', $dataMain);

        // Modal
        $this->load->view('components/modal/karyawan_nonaktif');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan_nonaktif/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_nonaktif_karyawan()
    {
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
                $dataMain['permst'] = $mainOption['data'];
                $dataMain['perstr'] = $options['data'];
            } else {
                $dataMain['permst'] = "";
                $dataMain['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataMain['permst'] = "";
            $dataMain['perstr'] = "";
        }
        $this->load->view('karyawan_nonaktif/add', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/karyawan_nonaktif/add');

        // Footer
        $this->load->view('components/footer');
    }

    // Process
    public function datatables()
    {
        $auth_per = htmlspecialchars($this->input->post("auth_per", true));
        if (empty($auth_per)) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
            echo json_encode($output);
            return;
        }
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'auth_per' => $auth_per,
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_nkry->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_nkry->datatables($data, $newToken);
        }
        if ($datatables['status'] == 200 || $datatables['status'] == 404) {
            echo json_encode($datatables['data']);
        } else {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
            echo json_encode($output);
        }
    }

    public function check_alasan()
    {
        $auth_alasan = htmlspecialchars($this->input->post("auth_alasan", true));
        $tokenAuth = $this->session->userdata('token');

        $parameter = [
            'field' => 'auth_alasan_nonaktif',
            'value' => $auth_alasan,
        ];

        $result = $this->api_nkry->specific_alasan_nonaktif($parameter, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_nkry->specific_alasan_nonaktif($parameter, $newToken);
        }
        if ($result['status'] == 200) {
            if ($result['data'][0]['stat_upload_berkas'] == 'F') {
                echo json_encode(["status" => false]);
            } else {
                echo json_encode(["status" => true]);
            }
        } else {
            echo json_encode(["status" => 400]);
        }
    }

    public function create()
    {
        $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $tglnonaktif = htmlspecialchars($this->input->post("tglnonaktif", true));
        $auth_alasan = htmlspecialchars($this->input->post("auth_alasan", true));
        $ket_alasan = htmlspecialchars($this->input->post("ket_alasan", true));
        $file_nonaktif = htmlspecialchars($this->input->post("file_nonaktif", true));
        $tokenAuth = $this->session->userdata('token');

        $parameterNonaktif = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $checkKaryawan = $this->api_nkry->read_specific_data($parameterNonaktif, $tokenAuth);
        if ($checkKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkKaryawan = $this->api_nkry->read_specific_data($parameterNonaktif, $newToken);
        }
        if ($checkKaryawan['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data gagal disimpan, karyawan telah dinonaktifkan, periksa data"));
            return;
        }

        $dataID = [
            'field' => 'auth_m_perusahaan',
            'value' => $auth_m_per,
        ];
        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_kary,
        ];
        $parameterAlasan = [
            'field' => 'auth_alasan_nonaktif',
            'value' => $auth_alasan,
        ];
        $dataStruktur = $this->api_str->read_specific_data($dataID, $tokenAuth);
        if ($dataStruktur['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataStruktur = $this->api_str->read_specific_data($dataID, $newToken);
        }

        if ($dataStruktur['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
            return;
        }

        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }

        if ($dataKaryawan['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }

        $dataAlasan = $this->api_nkry->specific_alasan_nonaktif($parameterAlasan, $tokenAuth);
        if ($dataAlasan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataAlasan = $this->api_nkry->specific_alasan_nonaktif($parameterAlasan, $newToken);
        }
        $id_m_perusahaan = $dataStruktur['data'][0]['id_m_perusahaan'];
        $id_personal = $dataKaryawan['data'][0]['id_personal'];
        $id_kary = $dataKaryawan['data'][0]['id_kary'];
        $id_alasan = $dataAlasan['data'][0]['id_alasan_nonaktif'];

        if (!empty($file_nonaktif)) {
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-NONAKTIF.pdf";
            $extension = 'pdf';
            $inputName = 'fl_nonaktif';
            $fileSize = 110;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
            if ($uploadFile == 200) {
                $dt_nonaktif = array(
                    'id_kary' => $id_kary,
                    'tgl_nonaktif' => $tglnonaktif,
                    'id_alasan_nonaktif' => $id_alasan,
                    'ket_nonaktif' => $ket_alasan,
                    'url_berkas_nonaktif' => $nama_file,
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                );
                $create = $this->api_nkry->create($dt_nonaktif, $tokenAuth);
                if ($create == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $create = $this->api_nkry->create($dt_nonaktif, $newToken);
                }
                if ($create == 201) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file nonaktif karyawan"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator" . $uploadFile));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file nonaktif karyawan"));
            }
        } else {
            $dt_nonaktif = array(
                'id_kary' => $id_kary,
                'tgl_nonaktif' => $tglnonaktif,
                'id_alasan_nonaktif' => $id_alasan,
                'ket_nonaktif' => $ket_alasan,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            );
            $create = $this->api_nkry->create($dt_nonaktif, $tokenAuth);
            if ($create == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $create = $this->api_nkry->create($dt_nonaktif, $newToken);
            }
            if ($create == 201) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
                return;
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
            }
        }
    }

    public function update()
    {
        $auth_karyawan = htmlspecialchars($this->input->post("auth_karyawan", true));
        $auth_data = htmlspecialchars($this->input->post("auth_data", true));
        $tglnonaktif = htmlspecialchars($this->input->post("tglnonaktif", true));
        $auth_alasan = htmlspecialchars($this->input->post("auth_alasan", true));
        $ket_alasan = htmlspecialchars($this->input->post("ket_alasan", true));
        $file_nonaktif = htmlspecialchars($this->input->post("file_nonaktif", true));
        $tokenAuth = $this->session->userdata('token');

        $parameterIDKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $auth_karyawan,
        ];
        $parameterAlasan = [
            'field' => 'auth_alasan_nonaktif',
            'value' => $auth_alasan,
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterIDKaryawan, $newToken);
        }

        if ($dataKaryawan['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
            return;
        }

        $dataAlasan = $this->api_nkry->specific_alasan_nonaktif($parameterAlasan, $tokenAuth);
        if ($dataAlasan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataAlasan = $this->api_nkry->specific_alasan_nonaktif($parameterAlasan, $newToken);
        }

        $parameter = [
            'field' => 'auth_kary_nonaktif',
            'value' => $auth_data,
        ];
        $dataNonaktif = $this->api_nkry->read_specific_data($parameter, $tokenAuth);
        if ($dataNonaktif['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataNonaktif = $this->api_nkry->read_specific_data($parameter, $newToken);
        }

        if ($dataNonaktif['status'] != 200) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data Karyawan Nonaktif tidak ditemukan"));
            return;
        }

        $id_karyawan_nonaktif = $dataNonaktif['data'][0]['id_kary_nonaktif'];
        $id_personal = $dataKaryawan['data'][0]['id_personal'];
        $id_alasan = $dataAlasan['data'][0]['id_alasan_nonaktif'];
        $oldFile = $dataNonaktif['data'][0]['url_berkas_nonaktif'];

        if (!empty($file_nonaktif)) {
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-NONAKTIF.pdf";
            $extension = 'pdf';
            $inputName = 'fl_nonaktif';
            $fileSize = 110;
            $uploadFile = $this->ftp_file->uploadFile($foldername, $extension, $inputName, $fileSize, $nama_file);
            if ($uploadFile == 200) {
                $dt_nonaktif = array(
                    'id_karyawan_nonaktif' => $id_karyawan_nonaktif,
                    'tgl_nonaktif' => $tglnonaktif,
                    'id_alasan_nonaktif' => $id_alasan,
                    'ket_nonaktif' => $ket_alasan,
                    'url_berkas_nonaktif' => $nama_file,
                );
                $update = $this->api_nkry->update($dt_nonaktif, $tokenAuth);
                if ($update == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $update = $this->api_nkry->update($dt_nonaktif, $newToken);
                }
                if ($update == 200) {
                    $this->ftp_file->deleteFile($foldername, $oldFile);
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
                }
            } elseif ($uploadFile == 400) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file nonaktif karyawan"));
            } elseif ($uploadFile == 404 || $uploadFile == 401 || $uploadFile == 403) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Server error, hubungi administrator" . $uploadFile));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file nonaktif karyawan"));
            }
        } else {
            $dt_nonaktif = array(
                'id_karyawan_nonaktif' => $id_karyawan_nonaktif,
                'tgl_nonaktif' => $tglnonaktif,
                'id_alasan_nonaktif' => $id_alasan,
                'ket_nonaktif' => $ket_alasan,
            );
            $update = $this->api_nkry->update($dt_nonaktif, $tokenAuth);
            if ($update == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $update = $this->api_nkry->update($dt_nonaktif, $newToken);
            }
            if ($update == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
            }
        }
    }

    public function delete()
    {
        $authNonaktifKary = htmlspecialchars(trim($this->input->post('authNonaktifKary')));
        $tokenAuth = $this->session->userdata('token');
        $parameterID = [
            'field' => 'auth_kary_nonaktif',
            'value' => $authNonaktifKary,
        ];
        $data = $this->api_nkry->read_specific_data($parameterID, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_nkry->read_specific_data($parameterID, $newToken);
        }

        if ($data['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data nonaktif karyawan tidak ditemukan"));
            return;
        }
        $id = $data['data'][0]['id_kary_nonaktif'];

        $parameterKaryawan = [
            'field' => 'auth_karyawan',
            'value' => $data['data'][0]['auth_karyawan'],
        ];
        $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $tokenAuth);
        if ($dataKaryawan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKaryawan = $this->api_kry->read_specific_data($parameterKaryawan, $newToken);
        }

        if ($dataKaryawan['status'] == 200) {
            $directory = md5($dataKaryawan['data'][0]['id_personal']);
            $fileName = $data['data'][0]['url_berkas_nonaktif'];
            $parameter = [
                'id_kary_nonaktif' => $id,
            ];
            $result = $this->api_nkry->delete($parameter, $tokenAuth);
            if ($result == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $result = $this->api_nkry->delete($parameter, $newToken);
            }
            if ($result == 200) {
                $this->ftp_file->deleteFile($directory, $fileName);
                echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil dihapus"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal dihapus"));
        }
    }

    public function detail()
    {
        $authNonaktifKary = htmlspecialchars(trim($this->input->post('authNonaktifKary')));
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'field' => 'auth_kary_nonaktif',
            'value' => $authNonaktifKary,
        ];
        $data = $this->api_nkry->read_specific_data($parameter, $tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_nkry->read_specific_data($parameter, $newToken);
        }

        if ($data['status'] == 200) {
            $parameterAlasan = [
                'field' => 'id_alasan_nonaktif',
                'value' => $data['data'][0]['id_alasan_nonaktif'],
            ];
            $dataAlasan = $this->api_nkry->specific_alasan_nonaktif($parameterAlasan, $tokenAuth);
            echo json_encode(array(
                'statusCode' => 200,
                'auth_kary_nonaktif' => $data['data'][0]['auth_kary_nonaktif'],
                'auth_karyawan' => $data['data'][0]['auth_karyawan'],
                'nama_perusahaan' => $data['data'][0]['nama_perusahaan'],
                'depart' => $data['data'][0]['depart'],
                'no_ktp' => $data['data'][0]['no_ktp'],
                'nama_lengkap' => $data['data'][0]['nama_lengkap'],
                'tgl_nonaktif' => $data['data'][0]['tgl_nonaktif'],
                'alasan_nonaktif' => $data['data'][0]['alasan_nonaktif'],
                'auth_alasan_nonaktif' => $dataAlasan['data'][0]['auth_alasan_nonaktif'],
                'nama_user' => $data['data'][0]['nama_user'],
                'tgl_buat' => $data['data'][0]['tgl_buat'],
                'ket_nonaktif' => $data['data'][0]['ket_nonaktif'],
                'posisi' => $data['data'][0]['posisi'],
            ));
        } else {
            echo json_encode(array(
                'statusCode' => 400,
                'pesan' => 'Server error, hubungi administrator',
            ));
        }
    }

    // Data Master
    public function dataAlasan()
    {
        $tokenAuth = $this->session->userdata('token');
        $data = $this->api_nkry->alasan_nonaktif($tokenAuth);
        if ($data['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $data = $this->api_nkry->alasan_nonaktif($newToken);
        }
        if ($data['status'] == 200) {
            $output = "<option value=''>-- PILIH ALASAN NONAKTIF --</option>";
            foreach ($data['data'] as $list) {
                $output = $output . " <option value='" . $list['auth_alasan_nonaktif'] . "'>" . $list['alasan_nonaktif'] . "</option>";
            }
        } else {
            $output = " <option value=''>TIDAK ADA DATA</option>";
        }

        echo json_encode(array("statusCode" => 200, "alasan" => $output, "pesan" => "Sukses"));
    }
}