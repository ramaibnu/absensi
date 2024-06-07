<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->authentication()) {
            redirect('login_view');
        }
    }

    // View
    public function data()
    {
        $auth_personal = htmlspecialchars(trim($this->input->get('auth_personal', true)));
        $tokenAuth = $this->session->userdata('token');
        if (!empty($auth_personal)) {
            $parameter = [
                'source' => 'vw_karyawan',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
            }
            if ($dataPersonal['status'] == 200) {
                $auth = $dataPersonal['data'][0]['id_personal'];
            } else {
                $auth = '';
            }
        } else {
            $auth = htmlspecialchars(trim($this->input->get('auth', true)));
        }
        $parameter = [
            'source' => 'tb_keluarga',
            'field' => 'id_personal',
            'value' => $auth,
        ];
        $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
        if ($dataKeluarga['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
        }
        if ($dataKeluarga['status'] == 200) {
            $data['keluarga'] = $dataKeluarga['data'][0];
        } else {
            $data['keluarga'] = [];
        }
        $this->load->view('karyawan/keluarga', $data);
    }

    public function detail()
    {
        $auth = htmlspecialchars(trim($this->input->post("auth")));
        $tipe = htmlspecialchars(trim($this->input->post("tipe")));
        $tokenAuth = $this->session->userdata('token');
        $parameter = [
            'source' => 'tb_keluarga',
            'field' => 'id_personal',
            'value' => $auth,
        ];
        $result = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
        if ($result['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $result = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
        }
        if ($result['status'] == 200) {
            if ($tipe == 0) {
                $data = [
                    'statusCode' => 200,
                    'nik' => $result['data'][0]['nik_pasangan'],
                    'nama' => $result['data'][0]['nama_pasangan'],
                    'ibu' => $result['data'][0]['nama_ibu_pasangan'],
                    'ayah' => $result['data'][0]['nama_ayah_pasangan'],
                    'tempat' => $result['data'][0]['tmp_lahir_pasangan'],
                    'tanggal' => $result['data'][0]['tgl_lahir_pasangan'],
                    'jenis_kelamin' => $result['data'][0]['jk_pasangan'],
                    'bpjs' => $result['data'][0]['no_bpjs_pasangan'],
                    'eli' => $result['data'][0]['no_eli_pasangan'],
                    'nohp' => $result['data'][0]['hp_pasangan'],
                    'status' => $result['data'][0]['stat_bpjs_pasangan'],
                ];
            } else {
                $data = [
                    'statusCode' => 200,
                    'nik' => $result['data'][0]['nik_anak_' . $tipe],
                    'nama' => $result['data'][0]['nama_anak_' . $tipe],
                    'ibu' => $result['data'][0]['nama_ibu_anak_' . $tipe],
                    'ayah' => $result['data'][0]['nama_ayah_anak_' . $tipe],
                    'tempat' => $result['data'][0]['tmp_lahir_anak_' . $tipe],
                    'tanggal' => $result['data'][0]['tgl_lahir_anak_' . $tipe],
                    'jenis_kelamin' => $result['data'][0]['jk_anak_' . $tipe],
                    'bpjs' => $result['data'][0]['no_bpjs_anak_' . $tipe],
                    'eli' => $result['data'][0]['no_eli_anak_' . $tipe],
                    'nohp' => $result['data'][0]['hp_anak_' . $tipe],
                    'status' => $result['data'][0]['stat_bpjs_anak_' . $tipe],
                ];
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 404, "pesan" => "Data tidak ditemukan!"));
        }
    }

    public function update()
    {
        $tokenAuth = $this->session->userdata('token');
        $auth_personal = htmlspecialchars(trim($this->input->post('auth_personal', true)));
        if (!empty($auth_personal)) {
            $parameter = [
                'source' => 'vw_karyawan',
                'field' => 'auth_personal',
                'value' => $auth_personal,
            ];
            $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameter);
            if ($dataPersonal['status'] == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $dataPersonal = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameter);
            }
            if ($dataPersonal['status'] == 200) {
                $auth = $dataPersonal['data'][0]['id_personal'];
            } else {
                echo json_encode(array('statusCode' => 400, "pesan" => "Data Keluarga gagal disimpan!"));
                return;
            }
        } else {
            $auth = htmlspecialchars(trim($this->input->post('auth', true)));
        }
        
        $tipe = htmlspecialchars(trim($this->input->post('tipe', true)));
        $nik = htmlspecialchars(trim($this->input->post('nik', true)));
        $nama = htmlspecialchars(trim($this->input->post('nama', true)));
        $ibu = htmlspecialchars(trim($this->input->post('ibu', true)));
        $ayah = htmlspecialchars(trim($this->input->post('ayah', true)));
        $jenisKelamin = htmlspecialchars(trim($this->input->post('jenisKelamin', true)));
        $tempatLahir = htmlspecialchars(trim($this->input->post('tempatLahir', true)));
        $tanggalLahir = htmlspecialchars(trim($this->input->post('tanggalLahir', true)));
        $bpjs = htmlspecialchars(trim($this->input->post('bpjs', true)));
        $statusBpjs = htmlspecialchars(trim($this->input->post('statusBpjs', true)));
        $eli = htmlspecialchars(trim($this->input->post('eli', true)));
        $nohp = htmlspecialchars(trim($this->input->post('nohp', true)));

        $parameterCheck = [
            'source' => 'tb_keluarga',
            'field' => 'id_personal',
            'value' => $auth,
        ];
        $checkData = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterCheck);
        if ($checkData['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $checkData = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterCheck);
        }
        if ($checkData['status'] == 200) {
            $endpoint = 'edit_keluarga';
            $parameter = [
                'id' => $auth,
                'tipe' => $tipe,
                'nik' => $nik,
                'nama' => $nama,
                'ibu' => $ibu,
                'ayah' => $ayah,
                'jenisKelamin' => $jenisKelamin,
                'tempatLahir' => $tempatLahir,
                'tanggalLahir' => $tanggalLahir,
                'bpjs' => $bpjs,
                'status' => $statusBpjs,
                'eli' => $eli,
                'nohp' => $nohp,
            ];
            $update = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $parameter);
            if ($update == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $update = $this->std->api($endpoint, $this->putMethod(), $newToken, $parameter);
            }
            if ($update == 200) {
                echo json_encode(array('statusCode' => 200, "pesan" => "Data Keluarga berhasil diedit!"));
            } else {
                echo json_encode(array('statusCode' => 400, "pesan" => "Data Keluarga gagal diedit!"));
            }
        } else {
            $endpointTambah = 'tambah_keluarga';
            $parameterTambah = [
                'id' => $auth,
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];
            $create = $this->std->api($endpointTambah, $this->postMethod(), $tokenAuth, $parameterTambah);
            if ($create == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $create = $this->std->api($endpointTambah, $this->postMethod(), $newToken, $parameterTambah);
            }
            if ($create != 201) {
                echo json_encode(array('statusCode' => 400, "pesan" => "Data Keluarga gagal ditambah!"));
                return;
            }
            $endpoint = 'edit_keluarga';
            $parameter = [
                'id' => $auth,
                'tipe' => $tipe,
                'nik' => $nik,
                'nama' => $nama,
                'ibu' => $ibu,
                'ayah' => $ayah,
                'jenisKelamin' => $jenisKelamin,
                'tempatLahir' => $tempatLahir,
                'tanggalLahir' => $tanggalLahir,
                'bpjs' => $bpjs,
                'status' => $statusBpjs,
                'eli' => $eli,
                'nohp' => $nohp,
            ];
            $update = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $parameter);
            if ($update == 403) {
                $this->session->unset_userdata('token');
                $tokenData = $this->api_tkn->getToken($this->tokenData());
                $this->session->set_userdata('token', $tokenData['data']);
                $newToken = $this->session->userdata('token');
                $update = $this->std->api($endpoint, $this->putMethod(), $newToken, $parameter);
            }
            if ($update == 200) {
                echo json_encode(array('statusCode' => 200, "pesan" => "Data Keluarga berhasil ditambah!"));
            } else {
                echo json_encode(array('statusCode' => 400, "pesan" => "Data Keluarga gagal ditambah!"));
            }
        }
    }

    public function delete()
    {
        $auth = htmlspecialchars(trim($this->input->post("auth")));
        $tipe = htmlspecialchars(trim($this->input->post("tipe")));
        $tokenAuth = $this->session->userdata('token');
        $endpoint = 'edit_keluarga';
        $parameter = [
            'id' => $auth,
            'tipe' => $tipe,
            'nik' => 0,
            'nama' => null,
            'ibu' => null,
            'ayah' => null,
            'jenisKelamin' => null,
            'tempatLahir' => null,
            'tanggalLahir' => '1970-01-01',
            'bpjs' => null,
            'status' => 'F',
            'eli' => null,
            'nohp' => null,
        ];
        $delete = $this->std->api($endpoint, $this->putMethod(), $tokenAuth, $parameter);
        if ($delete == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $delete = $this->std->api($endpoint, $this->putMethod(), $newToken, $parameter);
        }
        if ($delete == 200) {
            echo json_encode(array('statusCode' => 200, "pesan" => "Data berhasil dihapus!"));
        } else {
            echo json_encode(array('statusCode' => 400, "pesan" => "Data gagal dihapus!"));
        }
    }

    // Testing
    public function test()
    {
        $tokenAuth = $this->session->userdata('token');
        $parameterKeluarga = [
            'source' => 'tb_keluarga',
            'field' => 'id_personal',
            'value' => 1,
        ];
        $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $tokenAuth, $parameterKeluarga);
        if ($dataKeluarga['status'] == 403) {
            $this->session->unset_userdata('token');
            $tokenData = $this->api_tkn->getToken($this->tokenData());
            $this->session->set_userdata('token', $tokenData['data']);
            $newToken = $this->session->userdata('token');
            $dataKeluarga = $this->std->api($this->specificData(), $this->getMethod(), $newToken, $parameterKeluarga);
        }
        if ($dataKeluarga['status'] == 200) {
            $row = $dataKeluarga['data'][0];

            $new_array = array();

            $temp_array = array_intersect_key($row, array_flip(array_merge(['nik_pasangan'], preg_grep('/^nik_anak_\d+$/', array_keys($row)))));
            $temp_array2 = array_intersect_key($row, array_flip(array_merge(['nama_pasangan'], preg_grep('/^nama_anak_\d+$/', array_keys($row)))));
            $temp_array3 = array_intersect_key($row, array_flip(array_merge(['nama_ibu_pasangan'], preg_grep('/^nama_ibu_anak_\d+$/', array_keys($row)))));
            $temp_array4 = array_intersect_key($row, array_flip(array_merge(['nama_ayah_pasangan'], preg_grep('/^nama_ayah_anak_\d+$/', array_keys($row)))));
            $temp_array5 = array_intersect_key($row, array_flip(array_merge(['tmp_lahir_pasangan'], preg_grep('/^tmp_lahir_anak_\d+$/', array_keys($row)))));
            $temp_array6 = array_intersect_key($row, array_flip(array_merge(['tgl_lahir_pasangan'], preg_grep('/^tgl_lahir_anak_\d+$/', array_keys($row)))));
            $temp_array7 = array_intersect_key($row, array_flip(array_merge(['jk_pasangan'], preg_grep('/^jk_anak_\d+$/', array_keys($row)))));
            $temp_array8 = array_intersect_key($row, array_flip(array_merge(['no_bpjs_pasangan'], preg_grep('/^no_bpjs_anak_\d+$/', array_keys($row)))));
            $temp_array9 = array_intersect_key($row, array_flip(array_merge(['no_eli_pasangan'], preg_grep('/^no_eli_anak_\d+$/', array_keys($row)))));
            $temp_array10 = array_intersect_key($row, array_flip(array_merge(['hp_pasangan'], preg_grep('/^hp_anak_\d+$/', array_keys($row)))));
            $temp_array11 = array_intersect_key($row, array_flip(array_merge(['stat_pasangan'], preg_grep('/^stat_anak_\d+$/', array_keys($row)))));
            $temp_array12 = array_intersect_key($row, array_flip(array_merge(['stat_bpjs_pasangan'], preg_grep('/^stat_bpjs_anak_\d+$/', array_keys($row)))));

            $nik_keys = preg_grep('/^nik_/', array_keys($temp_array));
            $nik_keys2 = preg_grep('/^nama_/', array_keys($temp_array2));
            $nik_keys3 = preg_grep('/^nama_ibu_/', array_keys($temp_array3));
            $nik_keys4 = preg_grep('/^nama_ayah_/', array_keys($temp_array4));
            $nik_keys5 = preg_grep('/^tmp_lahir_/', array_keys($temp_array5));
            $nik_keys6 = preg_grep('/^tgl_lahir_/', array_keys($temp_array6));
            $nik_keys7 = preg_grep('/^jk_/', array_keys($temp_array7));
            $nik_keys8 = preg_grep('/^no_bpjs_/', array_keys($temp_array8));
            $nik_keys9 = preg_grep('/^no_eli_/', array_keys($temp_array9));
            $nik_keys10 = preg_grep('/^hp_/', array_keys($temp_array10));
            $nik_keys11 = preg_grep('/^stat_/', array_keys($temp_array11));
            $nik_keys12 = preg_grep('/^stat_bpjs_/', array_keys($temp_array12));

            $start_time = microtime(true);
            foreach ($nik_keys as $index => $key) {
                $new_array[$index][$key] = $temp_array[$key];
            }

            foreach ($nik_keys2 as $index => $key2) {
                $new_array[$index][$key2] = $temp_array2[$key2];
            }

            foreach ($nik_keys3 as $index => $key3) {
                $new_array[$index][$key3] = $temp_array3[$key3];
            }

            foreach ($nik_keys4 as $index => $key4) {
                $new_array[$index][$key4] = $temp_array4[$key4];
            }

            foreach ($nik_keys5 as $index => $key5) {
                $new_array[$index][$key5] = $temp_array5[$key5];
            }

            foreach ($nik_keys6 as $index => $key6) {
                $new_array[$index][$key6] = $temp_array6[$key6];
            }

            foreach ($nik_keys7 as $index => $key7) {
                $new_array[$index][$key7] = $temp_array7[$key7];
            }

            foreach ($nik_keys8 as $index => $key8) {
                $new_array[$index][$key8] = $temp_array8[$key8];
            }

            foreach ($nik_keys9 as $index => $key9) {
                $new_array[$index][$key9] = $temp_array9[$key9];
            }

            foreach ($nik_keys10 as $index => $key10) {
                $new_array[$index][$key10] = $temp_array10[$key10];
            }

            foreach ($nik_keys11 as $index => $key11) {
                $new_array[$index][$key11] = $temp_array11[$key11];
            }

            foreach ($nik_keys12 as $index => $key12) {
                $new_array[$index][$key12] = $temp_array12[$key12];
            }

            $end_time = microtime(true);

            $execution_time_ms = ($end_time - $start_time) * 1000;

            $data = $new_array;

        } else {
            $data = [];
        }
        $data['keluarga'] = $data;
        $this->load->view('karyawan/keluarga', $data);
        // $output = [
        //     'data' => $data,
        //     'execution_time' => $execution_time_ms . ' milliseconds'
        // ];
        // echo json_encode($output);
    }
}
