<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    // View
    public function index()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata('token');
        $this->session->unset_userdata('auth_per_sub');

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
        $this->load->view('data_master/perusahaan/view');

        // Modal
        $this->load->view('components/modal/perusahaan');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/perusahaan/view');

        // Footer
        $this->load->view('components/footer');
    }

    public function tambah_perusahaan()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $this->session->unset_userdata('auth_per_sub');
        $tokenAuth = $this->session->userdata('token');

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
        $this->load->view('data_master/perusahaan/add');

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/perusahaan/add');

        // Footer
        $this->load->view('components/footer');
    }

    public function edit_perusahaan($id)
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $tokenAuth = $this->session->userdata("token");
        $this->session->unset_userdata('auth_per_sub');

        // Header
        $this->load->view('components/header');

        // Sidebar
        if ($result['status'] == 403) {
            $dataSidebar['nama_per'] = $result['data'][0]['kode_perusahaan'];
        } else {
            $dataSidebar['nama_per'] = "PT UNGGUL";
        }

        $this->load->view('components/sidebar', $dataSidebar);

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_hcdata");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $dataID = [
            'field' => 'auth_perusahaan',
            'value' => $id,
        ];
        $dataMain['perusahaan'] = $this->api_prs->read_specific_data($dataID, $tokenAuth);
        if ($dataMain['perusahaan']['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataMain['perusahaan'] = $this->api_prs->read_specific_data($dataID, $newToken);
        }
        $this->load->view('data_master/perusahaan/edit', $dataMain);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/perusahaan/edit');

        // Footer
        $this->load->view('components/footer');
    }

    // Process
    public function datatables()
    {
        $start = $this->input->post("start");
        $draw = $this->input->post("draw");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        $order = $this->input->post("order");
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'start' => $start,
            'draw' => $draw,
            'length' => $length,
            'search' => $search,
            'order' => $order,
        ];

        $datatables = $this->api_prs->datatables($data, $tokenAuth);
        if ($datatables['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $datatables = $this->api_prs->datatables($data, $newToken);
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

    public function read_specific_data()
    {
        $this->session->unset_userdata('id_perusahaan_prs_hcdata');
        $auth_perusahaan = htmlspecialchars(trim($this->input->post("auth_perusahaan", true)));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'field' => 'auth_perusahaan',
            'value' => $auth_perusahaan,
        ];
        $query = $this->api_prs->read_specific_data($data, $tokenAuth);
        if ($query['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $query = $this->api_prs->read_specific_data($data, $newToken);
        }
        if ($query['status'] == 200) {
            foreach ($query['data'] as $list) {
                if ($list['stat_perusahaan'] == "T") {
                    $status = "AKTIF";
                } else {
                    $status = "NONAKTIF";
                }

                $idProvinsi = [
                    'id' => $list['prov_perusahaan'],
                ];
                $prov = $this->api_drh->provinsi_by_id($idProvinsi, $tokenAuth);
                if ($prov['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $prov = $this->api_drh->provinsi_by_id($idProvinsi, $newToken);
                }

                $idKota = [
                    'id' => $list['kab_perusahaan'],
                ];
                $kab = $this->api_drh->kota_by_id($idKota, $tokenAuth);
                if ($kab['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kab = $this->api_drh->kota_by_id($idKota, $newToken);
                }

                $idKecamatan = [
                    'id' => $list['kec_perusahaan'],
                ];
                $kec = $this->api_drh->kecamatan_by_id($idKecamatan, $tokenAuth);
                if ($kec['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kec = $this->api_drh->kecamatan_by_id($idKecamatan, $newToken);
                }

                $idKelurahan = [
                    'id' => $list['kel_perusahaan'],
                ];
                $kel = $this->api_drh->kelurahan_by_id($idKelurahan, $tokenAuth);
                if ($kel['status'] == 403) {
                    $this->session->unset_userdata('token');
                    $tokenData = $this->api_tkn->getToken($this->tokenData());
                    $this->session->set_userdata('token', $tokenData['data']);
                    $newToken = $this->session->userdata('token');
                    $kel = $this->api_drh->kelurahan_by_id($idKelurahan, $newToken);
                }

                if ($list['kodepos_perusahaan'] == 0) {
                    $kodepos = "";
                } else {
                    $kodepos = " " . $list['kodepos_perusahaan'];
                }

                $data = [
                    'statusCode' => 200,
                    'kode' => $list['kode_perusahaan'],
                    'perusahaan' => $list['nama_perusahaan'],
                    'alamat' => $list['alamat_perusahaan'] . ", KEL. " . $kel['data'][0]['name'] . ", KEC. " . $kec['data'][0]['name'] . ", " . $kab['data'][0]['name'] . ", " . $prov['data'][0]['name'] . $kodepos,
                    'telp' => $list['telp_perusahaan'],
                    'email' => $list['email_perusahaan'],
                    'web' => $list['website_perusahaan'],
                    'npwp' => $list['npwp_perusahaan'],
                    'keg' => $list['kegiatan'],
                    'ket' => $list['ket_perusahaan'],
                    'status' => $status,
                    'tgl_buat' => date('d-M-Y H:i:s', strtotime($list['tgl_buat'])),
                    'tgl_edit' => date('d-M-Y H:i:s', strtotime($list['tgl_edit'])),
                    'pembuat' => $list['nama_user'],
                ];

                $this->session->set_userdata('id_perusahaan_prs_hcdata', $list['id_perusahaan']);
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function read_specific_data2()
    {
        $this->session->unset_userdata('id_perusahaan_prs_edit');
        $auth_perusahaan = htmlspecialchars(trim($this->input->post("auth_perusahaan", true)));
        $tokenAuth = $this->session->userdata('token');

        $data = [
            'field' => 'auth_perusahaan',
            'value' => $auth_perusahaan,
        ];
        $query = $this->api_prs->read_specific_data($data, $tokenAuth);
        if ($query['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $query = $this->api_prs->read_specific_data($data, $newToken);
        }
        if ($query['status'] == 200) {
            foreach ($query['data'] as $list) {
                if ($list['stat_perusahaan'] == "T") {
                    $status = "AKTIF";
                } else {
                    $status = "NONAKTIF";
                }

                if ($list['kodepos_perusahaan'] == 0) {
                    $kodepos = "";
                } else {
                    $kodepos = " " . $list['kodepos_perusahaan'];
                }

                $data = [
                    'statusCode' => 200,
                    'judul' => "Edit Perusahaan | " . $list['nama_perusahaan'],
                    'kode' => $list['kode_perusahaan'],
                    'perusahaan' => $list['nama_perusahaan'],
                    'alamat' => $list['alamat_perusahaan'],
                    'kodepos' => $kodepos,
                    'kel' => $list['kel_perusahaan'],
                    'kec' => $list['kec_perusahaan'],
                    'kab' => $list['kab_perusahaan'],
                    'prov' => $list['prov_perusahaan'],
                    'telp' => $list['telp_perusahaan'],
                    'email' => $list['email_perusahaan'],
                    'web' => $list['website_perusahaan'],
                    'npwp' => $list['npwp_perusahaan'],
                    'keg' => $list['kegiatan'],
                    'ket' => $list['ket_perusahaan'],
                    'status' => $status,
                    'tgl_buat' => date('d-M-Y H:i:s', strtotime($list['tgl_buat'])),
                    'tgl_edit' => date('d-M-Y H:i:s', strtotime($list['tgl_edit'])),
                    'pembuat' => $list['nama_user'],
                ];
                $this->session->set_userdata('id_perusahaan_prs_edit', $list['id_perusahaan']);
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak ditemukan", "tipe_pesan" => "error"));
        }
    }

    public function get_auth()
    {
        $id_perusahaan = $this->session->userdata('id_perusahaan_hcdata');
        $tokenAuth = $this->session->userdata('token');
        $data = [
            'field' => 'id_perusahaan',
            'value' => $id_perusahaan,
        ];
        $result = $this->api_prs->read_specific_data($data, $tokenAuth);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->api_prs->read_specific_data($data, $newToken);
        }

        if ($result['status'] == 200) {
            echo json_encode([
                "statusCode" => 200,
                "prs" => $result['data'][0]['auth_perusahaan'],
            ]);
        } else {
            echo json_encode([
                "statusCode" => 201,
                "prs" => "",
            ]);
        }
    }

    public function insert()
    {
        $kode_perusahaan = htmlspecialchars($this->input->post("kode", true));
        $nama_perusahaan = htmlspecialchars($this->input->post("perusahaan", true));
        $alamat = htmlspecialchars($this->input->post("alamat", true));
        $kodepos = htmlspecialchars($this->input->post("kodepos", true));
        $prov = htmlspecialchars($this->input->post("prov", true));
        $kab = htmlspecialchars($this->input->post("kab", true));
        $kec = htmlspecialchars($this->input->post("kec", true));
        $kel = htmlspecialchars($this->input->post("kel", true));
        $telp = htmlspecialchars($this->input->post("telp", true));
        $email = htmlspecialchars($this->input->post("email", true));
        $web = htmlspecialchars($this->input->post("web", true));
        $npwp = htmlspecialchars($this->input->post("npwp", true));
        $keg = htmlspecialchars($this->input->post("keg", true));
        $ket = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');

        $dataKode = [
            'field' => 'kode_perusahaan',
            'value' => $kode_perusahaan,
        ];
        $cekkode = $this->api_prs->read_specific_data($dataKode, $tokenAuth);
        if ($cekkode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekkode = $this->api_prs->read_specific_data($dataKode, $newToken);
        }
        if ($cekkode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataPerusahaan = [
            'field' => 'nama_perusahaan',
            'value' => $nama_perusahaan,
        ];
        $cekperusahaan = $this->api_prs->read_specific_data($dataPerusahaan, $tokenAuth);
        if ($cekperusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekperusahaan = $this->api_prs->read_specific_data($dataPerusahaan, $newToken);
        }
        if ($cekperusahaan['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Nama perusahaan sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = [
            'kode_perusahaan' => $kode_perusahaan,
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perusahaan' => $alamat,
            'kelurahan' => $kel,
            'kecamatan' => $kec,
            'kota' => $kab,
            'provinsi' => $prov,
            'keterangan' => $ket,
            'id_user' => $this->session->userdata('id_user_hcdata'),
        ];

        $perusahaan = $this->api_prs->create($data, $tokenAuth);
        if ($perusahaan == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $perusahaan = $this->api_prs->create($data, $newToken);
        }
        if ($perusahaan == 201) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Perusahaan berhasil disimpan", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan gagal disimpan", "tipe_pesan" => "error"));
        }
    }

    public function update()
    {
        if ($this->session->userdata('id_perusahaan_prs_edit') == "") {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }

        $id_perusahaan = $this->session->userdata('id_perusahaan_prs_edit');
        $kode_perusahaan = htmlspecialchars($this->input->post("kode", true));
        $nama_perusahaan = htmlspecialchars($this->input->post("perusahaan", true));
        $alamat = htmlspecialchars($this->input->post("alamat", true));
        $kodepos = htmlspecialchars($this->input->post("kodepos", true));
        $prov = htmlspecialchars($this->input->post("prov", true));
        $kab = htmlspecialchars($this->input->post("kab", true));
        $kec = htmlspecialchars($this->input->post("kec", true));
        $kel = htmlspecialchars($this->input->post("kel", true));
        $ket = htmlspecialchars($this->input->post("ket", true));
        $tokenAuth = $this->session->userdata('token');

        if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
            $status = "T";
        } else {
            $status = "F";
        }

        $dataKode = [
            'source' => 'tb_perusahaan',
            'field' => 'kode_perusahaan',
            'value' => $kode_perusahaan,
            'field2' => 'id_perusahaan !=',
            'value2' => $id_perusahaan,
        ];
        $cekkode = $this->api->specific_data_by_2_fields($dataKode, $tokenAuth);
        if ($cekkode['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekkode = $this->api->specific_data_by_2_fields($dataKode, $newToken);
        }
        if ($cekkode['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $dataPerusahaan = [
            'source' => 'tb_perusahaan',
            'field' => 'nama_perusahaan',
            'value' => $nama_perusahaan,
            'field2' => 'id_perusahaan !=',
            'value2' => $id_perusahaan,
        ];
        $cekperusahaan = $this->api->specific_data_by_2_fields($dataPerusahaan, $tokenAuth);
        if ($cekperusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekperusahaan = $this->api->specific_data_by_2_fields($dataPerusahaan, $newToken);
        }
        if ($cekperusahaan['status'] == 200) {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Nama perusahaan sudah digunakan", "tipe_pesan" => "error"));
            return;
        }

        $data = array(
            'id_perusahaan' => $id_perusahaan,
            'kode_perusahaan' => $kode_perusahaan,
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perusahaan' => $alamat,
            'kelurahan' => $kel,
            'kecamatan' => $kec,
            'kota' => $kab,
            'provinsi' => $prov,
            'status' => $status,
            'keterangan' => $ket,
        );

        $perusahaan = $this->api_prs->update($data, $tokenAuth);
        if ($perusahaan == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $perusahaan = $this->api_prs->update($data, $newToken);
        }
        if ($perusahaan == 200) {
            $endpoint = 'update_status_struktur';
            $parameterStatus = [
                'id' => $id_perusahaan,
                'status' => $status,
            ];

            $changeStatus = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $parameterStatus);
            if ($changeStatus == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $changeStatus = $this->std->api($endpoint, $this->putMethod(), $newToken, $parameterStatus);
            }
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Perusahaan berhasil diupdate", "tipe_pesan" => "success"));
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan gagal diupdate", "tipe_pesan" => "error"));
        }
    }

    public function delete()
    {
        $auth_perusahaan = htmlspecialchars(trim($this->input->post('auth_perusahaan', true)));
        $tokenAuth = $this->session->userdata('token');

        $dataID2 = [
            'field' => 'auth_perusahaan',
            'value' => $auth_perusahaan,
        ];
        $cekStruktur = $this->api_str->read_specific_data($dataID2, $tokenAuth);
        if ($cekStruktur['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekStruktur = $this->api_str->read_specific_data($dataID2, $newToken);
        }
        if ($cekStruktur['status'] == 200) {
            echo json_encode(array("statusCode" => 203, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak dapat dihapus, ada pada struktur perusahaan", "tipe_pesan" => "error"));
            return;
        }

        $cekPerusahaan = $this->api_prs->read_specific_data($dataID2, $tokenAuth);
        if ($cekPerusahaan['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $cekPerusahaan = $this->api_prs->read_specific_data($dataID2, $newToken);
        }
        if ($cekPerusahaan['status'] != 200) {
            echo json_encode(array("statusCode" => 202, "kode_pesan" => "$dataID", "pesan" => "Perusahaan tidak ditemukan", "tipe_pesan" => "error"));
            return;
        }
        $dataID = [
            'id_perusahaan' => $cekPerusahaan['data'][0]['id_perusahaan'],
        ];

        $query = $this->api_prs->delete($dataID, $tokenAuth);
        if ($query == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $query = $this->api_prs->delete($dataID, $newToken);
        }
        if ($query == 200) {
            echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Perusahaan berhasil dihapus", "tipe_pesan" => "success"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan gagal dihapus", "tipe_pesan" => "error"));
            return;
        }
    }
}