<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Master</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('Karyawan_api'); ?>">
                                    Karyawan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Detail Data Karyawan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header mt-3">

                        <?php
                              if (empty($data_kary['tgl_nonaktif'])) {
                                   echo '<h4>' . $data_kary['no_ktp'] . ' - ' . $data_kary['nama_lengkap'] . ' | <span class="text-success">AKTIF</span> </h4>';
                              } else {
                                   echo '<h4>' . $data_kary['no_ktp'] . ' - ' . $data_kary['nama_lengkap'] . ' | <span class="text-danger">NONAKTIF</span> </h4>';
                              }
                              ?>

                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i style="font-size: 32;" class="feather icon-menu"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-edit"></i> Edit Data</a>
                                    </li>
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                FullScreen</span><span style="display: none"><i
                                                    class="feather icon-minimize"></i> Restore</span></a>
                                    </li>
                                    <!-- <li class="dropdown-item minimize-card">
                                                  <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
                                             </li> -->
                                    <li class="dropdown-item reload-card">
                                        <a id="btnrefDetailKary" href="#!"><i
                                                class="feather icon-refresh-cw"></i>Reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row">
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <a id="btnrefDetailKary" href="#!" class="btn btn-primary">Refresh</a>
                                   </div> -->
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <li><a class="nav-link text-left has-ripple active" id="v-pills-dtPersonal-tab"
                                            data-toggle="pill" href="#v-pills-dtPersonal" role="tab"
                                            aria-controls="v-pills-dtPersonal" aria-selected="true">Data
                                            Personal<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -152.188px; left: -96.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtKaryawan-tab"
                                            data-toggle="pill" href="#v-pills-dtKaryawan" role="tab"
                                            aria-controls="v-pills-dtKaryawan" aria-selected="false">Data
                                            Karyawan<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -162.188px; left: -102.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtSIMPER-tab"
                                            data-toggle="pill" href="#v-pills-dtSIMPER" role="tab"
                                            aria-controls="v-pills-dtSIMPER" aria-selected="false">SIMPER/Mine
                                            Permit<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -174.188px; left: -108.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtSertifikasi-tab"
                                            data-toggle="pill" href="#v-pills-dtSertifikasi" role="tab"
                                            aria-controls="v-pills-dtSertifikasi" aria-selected="false">Sertifikasi<span
                                                class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtMCU-tab"
                                            data-toggle="pill" href="#v-pills-dtMCU" role="tab"
                                            aria-controls="v-pills-dtMCU" aria-selected="false">Medical Check
                                            Up (MCU)<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtVaksin-tab"
                                            data-toggle="pill" href="#v-pills-dtVaksin" role="tab"
                                            aria-controls="v-pills-dtVaksin" aria-selected="false">Vaksin<span
                                                class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtFilePendukung-tab"
                                            data-toggle="pill" href="#v-pills-dtFilePendukung" role="tab"
                                            aria-controls="v-pills-dtFilePendukung" aria-selected="false">File
                                            Pendukung<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a>
                                    </li>
                                    <li><a class="nav-link text-left has-ripple" id="v-pills-dtPelanggaran-tab"
                                            data-toggle="pill" href="#v-pills-dtPelanggaran" role="tab"
                                            aria-controls="v-pills-dtPelanggaran" aria-selected="false">Data
                                            Pelanggaran<span class="ripple ripple-animate"
                                                style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-dtPersonal" role="tabpanel"
                                        aria-labelledby="v-pills-dtPersonal-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                                                <div class="m-b-25">
                                                    <?php
                                                    if (empty($data_kary['url_foto'])) {
                                                            $linkfoto = base_url() . 'berkas/pasphoto/pasphoto.jpg';
                                                    } else {
                                                            $linkfoto = base_url('Karyawan_api/foto_karyawan') . '/' . $data_kary['auth_karyawan'];
                                                    }
                                                    ?>
                                                    <img style="border: 10px solid #3c3c3c;" src="<?= $linkfoto ?>"
                                                        width="200" height="200" class="img-radius"
                                                        alt="User-Profile-Image">
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-8 col-md-8 col-sm-12 d-flex-row justify-content-center align-items-center">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <h6>No. KTP</h6>
                                                        <input type="text" class="form-control"
                                                            value="<?= $data_kary['no_ktp'] ?? '-' ?>"
                                                            style="background-color:transparent;margin-top:-10px;"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <h6>Nama Lengkap</h6>
                                                        <input type="text" class="form-control"
                                                            value="<?= $data_kary['nama_lengkap'] ?? '-' ?>"
                                                            style="background-color:transparent;margin-top:-10px;"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <h6>Tempat & Tanggal Lahir</h6>
                                                        <input type="text" class="form-control"
                                                            value="<?= ($data_kary['tmp_lahir'] ?? '-') . ", " . ($data_kary['tgl_lahir'] == "1970-01-01" ? '' : date('d-M-Y', strtotime($data_kary['tgl_lahir']))) ?>"
                                                            style="background-color:transparent;margin-top:-10px;"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Alamat</h6>
                                                    <textarea type="text" class="form-control"
                                                        style="background-color:transparent;margin-top:-10px;"
                                                        disabled><?= empty($data_alamat) ? '' : $data_alamat ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Agama</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['agama'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Jenis Kelamin</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['jk']) ? (($data_kary['jk'] == 'LK') ? "LAKI-LAKI" : "PEREMPUAN") : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Status Pernikahan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['stat_nikah'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Kewarganegaraan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['warga_negara'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>No. KK</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['no_kk'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>No. NPWP</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['no_npwp'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>No. BPJS Tenaga Kerja</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['no_bpjstk'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>No. BPJS Kesehatan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['no_bpjskes'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nomor Telepon</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['hp_1'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Email Pribadi</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['email_pribadi'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Pendidikan Terakhir</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_pendidikan['pendidikan'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Sekolah/Perguruan Tinggi</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['nama_sekolah'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Fakultas</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['fakultas'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Jurusan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['jurusan'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama Ibu</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['nama_ibu'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Status Ibu</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['stat_ibu'] ? ($data_kary['stat_ibu'] == 'H' ? 'Masih Ada' : 'Tidak Ada') : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama Ayah</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['nama_ayah'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Status Ayah</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['stat_ayah'] ? ($data_kary['stat_ayah'] == 'H' ? 'Masih Ada' : 'Tidak Ada') : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Bank</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_bank['bank'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama Pemilik</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_bank['nama_pemilik'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nomor Rekening</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_bank['no_rek'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h6>Emegency Contact :</h6>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_ec['nama_ec'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Relasi</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_ec['relasi_ec'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nomor HP</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_ec['hp_ec'] || $data_ec['hp_ec'] != '0' ? $data_ec['hp_ec'] : '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nomor HP 2</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_ec['hp_ec_2'] || $data_ec['hp_ec_2'] != '0' ? $data_ec['hp_ec_2'] : '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table
                                                    class="table table-striped table-bordered table-hover text-black text-nowrap"
                                                    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center;">No.</th>
                                                            <th style="text-align:center;">Nama Lengkap</th>
                                                            <th style="text-align:center;">Hubungan</th>
                                                            <th style="text-align:center;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        if (!empty($data_keluarga)) { 
                                                            $allEmpty = true;
                                                            if (!empty($data_keluarga['nama_pasangan'])) {
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:center;">1</td>
                                                            <td style="text-align:center;">
                                                                <?= $data_keluarga['nama_pasangan'] ?></td>
                                                            <td style="text-align:center;">
                                                                <?= $data_keluarga['jk_pasangan'] == 'L' ? 'Suami' : 'Istri' ?>
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <button type="button"
                                                                    id="<?= $data_keluarga['id_personal'] . ',' . 0 ?>"
                                                                    class="tooltips detailKeluarga btn btn-success btn-sm"
                                                                    title="Detail"><i
                                                                        class="fas fa-info-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php }
                                                        for  ($i = 1; $i <= 10; $i++) {
                                                            if (!empty($data_keluarga['nama_anak_'.$i])) {
                                                                $allEmpty = false;
                                                                break;
                                                            }
                                                        }
                                                        if ($allEmpty && empty($data_keluarga['nama_pasangan'])) {
                                                        ?>
                                                        <tr>
                                                            <td colspan="4" style="text-align:center;">Data Tidak
                                                                Ditemukan</td>
                                                        </tr>
                                                        <?php
                                                        } elseif (!$allEmpty) {
                                                            if (empty($data_keluarga['nama_pasangan'])) {
                                                                $no = 0;
                                                            } else {
                                                                $no = 1;
                                                            }
                                                            for  ($i = 1; $i <= 10; $i++) {
                                                                if ($data_keluarga['nama_anak_'.$i] != null) {
                                                                    $no++;        
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:center;"><?= $no ?></td>
                                                            <td style="text-align:center;">
                                                                <?= $data_keluarga['nama_anak_'.$i] ?></td>
                                                            <td style="text-align:center;">Anak ke <?= $i ?></td>
                                                            <td style="text-align:center;">
                                                                <button type="button"
                                                                    id="<?= $data_keluarga['id_personal'] . ',' . $i ?>"
                                                                    class="tooltips detailKeluarga btn btn-success btn-sm"
                                                                    title="Detail"><i
                                                                        class="fas fa-info-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php }
                                                            }
                                                        }
                                                        } else { ?>
                                                        <tr>
                                                            <td colspan="4" style="text-align:center;">Data Tidak
                                                                Ditemukan</td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtKaryawan" role="tabpanel"
                                        aria-labelledby="v-pills-dtKaryawan-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama Perusahaan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['nama_perusahaan']) ? $data_kary['nama_perusahaan'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <h6>NIK</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['no_nik']) ? $data_kary['no_nik'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Departemen</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['depart']) ? $data_kary['depart'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Section</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['section'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Posisi</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['posisi']) ? $data_kary['posisi'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Level</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= (isset($data_kary['level']) ? $data_kary['level'] : '-') ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Grade</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['grade'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Klasifikasi</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['klasifikasi']) ? $data_kary['klasifikasi'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Golongan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['tipe']) ? $data_kary['tipe'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Roster</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['roster'] ?? '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Point of Hire</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['poh']) ? $data_kary['poh'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Lokasi Penerimaan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['lokterima']) ? $data_kary['lokterima'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Lokasi Kerja</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['lokker']) ? $data_kary['lokker'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Email Perusahaan</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= isset($data_kary['email_kantor']) ? $data_kary['email_kantor'] : '-' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Status Residence</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['stat_tinggal'] ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Date of Hire</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= date('d-M-Y', strtotime($data_kary['doh'])) ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Tanggal Aktif</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= date('d-M-Y', strtotime($data_kary['tgl_aktif'])) ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Paybase</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_paybase['paybase'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Status Pajak</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_pajak['stat_pajak'] ?? '' ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table
                                                    class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center;width:1%;">NO.</th>
                                                            <th style="text-align:center;width:35%;">STATUS KONTRAK
                                                                KERJA</th>
                                                            <th style="text-align:center;width:35%;">TANGGAL AWAL
                                                                KONTRAK</th>
                                                            <th style="text-align:center;width:10%;">TANGGAL AKHIR
                                                                KONTRAK</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($data_kontrak)) {
                                                            $n = 1;
                                                            foreach ($data_kontrak as $list) {
                                                                echo "<tr>";
                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $n++ . "</td>";
                                                                echo "<td class='align-middle' style='text-align:center;width:35%;'>" . $list['stat_perjanjian'] . "</td>";
                                                                echo "<td class='align-middle' style='text-align:center;width:10%;'>" . date("d-M-Y", strtotime($list['tgl_mulai'])) . "</td>";
                                                                echo "<td class='align-middle' style='text-align:center;width:10%;'>" . ($list['tgl_akhir'] == '1970-01-01' ? '-' : date("d-M-Y", strtotime($list['tgl_akhir']))) . "</td>";
                                                                echo "<tr>";
                                                            }
                                                        } else {
                                                            echo  "<tr>";
                                                            echo "<td colspan='6' style='text-align:center;'> Tidak ada data</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtSIMPER" role="tabpanel"
                                        aria-labelledby="v-pills-dtSIMPER-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <table id="tbmSertifikasiDetail"
                                                        class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center;width: 1%;">
                                                                    NO.</th>
                                                                <th style="width: 20%;">JENIS IZIN</th>
                                                                <th style="width: 60%;">NO. REGISTRASI
                                                                </th>
                                                                <th style="width: 10%;">TGL. EXPIRED
                                                                </th>
                                                                <th style="width: 9%;">PROSES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 1;
                                                            if (!empty($data_izin)) {
                                                                 foreach ($data_izin as $list) {
                                                                      echo '<tr>';
                                                                      echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                      echo '<td class="align-middle" style="width: 20%;">' . $list['jenis_izin_tambang'] . '</td>';
                                                                      echo '<td class="align-middle" style="width: 60%;">' . $list['no_reg'] . '</td>';
                                                                      echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list['tgl_expired'])) . '</td>';
                                                                      echo '<td style="text-align:center;">';
                                                                      echo '<button id="' . $list['auth_izin_tambang'] . '" class="btn btn-primary btn-sm text-white" title="Detail"><i class="fas fa-asterisk"></i></button> ';
                                                                      if ($list['url_izin_tambang'] != "") {
                                                                           if ($list['id_jenis_izin_tambang'] == 2) {
                                                                                echo '<a href ="' . base_url('Izin_tambang_api/checkFileSIM/') . $list['auth_izin_tambang'] . '" target="_blank" class="btn btn-success btn-sm text-white" title="Tampilkan SIM"><i class="fas fa-id-badge"></i></a> ';
                                                                           }
                                                                           echo '<a href ="' . base_url('Izin_tambang_api/checkFile/') . $list['auth_izin_tambang'] . '" target="_blank" class="btn btn-primary btn-sm text-white" title="Tampilkan Sertifikasi"><i class="far fa-file-pdf"></i></a>';
                                                                      } else {
                                                                           echo '<a class="btn btn-danger btn-sm text-white" title="File tidak ada"><i class="fas fa-ban"></i></a>';
                                                                      }
                                                                      echo '</td>';
                                                                      echo '</tr>';
                                                                 }
                                                            } else {
                                                                 echo '<tr>';
                                                                 echo '<td colspan=6 class=" align-middle text-center">Data tidak ada</td>';
                                                                 echo '</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtSertifikasi" role="tabpanel"
                                        aria-labelledby="v-pills-dtSertifikasi-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <table id="tbmSertifikasiDetail"
                                                        class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center;width: 1%;">
                                                                    NO.</th>
                                                                <th style="width: 55%;">JENIS
                                                                    SERTIFIKASI</th>
                                                                <th style="width: 19%;">NO. SERTIFIKASI
                                                                </th>
                                                                <th style="width: 10%;">TGL. SERTIFIKASI
                                                                </th>
                                                                <th style="width: 10%;">TGL. EXPIRED
                                                                </th>
                                                                <th style="width: 5%;">PROSES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 1;
                                                            if (!empty($data_sertifikasi)) {
                                                                 foreach ($data_sertifikasi as $list) {
                                                                      echo '<tr>';
                                                                      echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                      echo '<td class="align-middle" style="width: 60%;">' . $list['jenis_sertifikasi'] . '</td>';
                                                                      echo '<td class="align-middle" style="width: 19%;">' . $list['no_sertifikasi'] . '</td>';
                                                                      echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list['tgl_sertifikasi'])) . '</td>';
                                                                      echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list['tgl_berakhir_sertifikasi'])) . '</td>';
                                                                      echo '<td style="text-align:center;">';
                                                                      if ($list['file_sertifikasi'] != "") {
                                                                           echo '<a href ="' . base_url('./berkasSertifikasi/') . $list['auth_sertifikat'] . '" target="_blank" class="btn btn-primary btn-sm" title="Tampilkan Sertifikasi"><i class="far fa-file-pdf"></i></a>';
                                                                      } else {
                                                                           echo '<a class="btn btn-danger btn-sm" title="File sertifikasi tidak ada"><i class="fas fa-ban"></i></a>';
                                                                      }
                                                                      echo '</td>';
                                                                      echo '</tr>';
                                                                 }
                                                            } else {
                                                                 echo '<tr>';
                                                                 echo '<td colspan=6 class=" align-middle text-center">Data tidak ada</td>';
                                                                 echo '</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtMCU" role="tabpanel"
                                        aria-labelledby="v-pills-dtMCU-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table id="tbmSertifikasiDetail"
                                                    class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center;width: 1%;">NO.
                                                            </th>
                                                            <th style="width: 15%;">TGL. MCU</th>
                                                            <th style="width: 25%;">HASIL MCU</th>
                                                            <th style="width: 59%;">KETERANGAN</th>
                                                            <th style="width: 59%;">PROSES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        if (!empty($data_mcu)) {
                                                             foreach ($data_mcu as $list) {
                                                                  echo '<tr>';
                                                                  echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                  echo '<td class="align-middle" style="width: 15%;">' . date('d-M-Y', strtotime($list['tgl_mcu'])) . '</td>';
                                                                  echo '<td class="align-middle" style="width: 25%;">' . $list['mcu_jenis'] . '</td>';
                                                                  echo '<td class="align-middle" style="width: 54%;">' . $list['ket_mcu'] . '</td>';
                                                                  echo '<td style="text-align:center;">';

                                                                  if ($list['url_file'] != "") {
                                                                       echo '<a href ="' . base_url('./berkasMCU/') . $list['auth_mcu'] . '" target="_blank" class="btn btn-primary btn-sm" title="Tampilkan Hasil MCU"><i class="far fa-file-pdf"></i></a>';
                                                                  } else {
                                                                       echo '<a class="btn btn-danger btn-sm" title="File MCU tidak ada"><i class="fas fa-ban"></i></a>';
                                                                  }
                                                                  echo '</td>';
                                                                  echo '</tr>';
                                                             }
                                                        } else {
                                                             echo '<tr>';
                                                             echo '<td colspan=4 class=" align-middle text-center">Data tidak ada</td>';
                                                             echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtVaksin" role="tabpanel"
                                        aria-labelledby="v-pills-dtVaksin-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table id="tbmSertifikasiDetail"
                                                    class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center;width: 1%;">NO.
                                                            </th>
                                                            <th style="width: 30%;">VAKSIN</th>
                                                            <th style="width: 39%;">NAMA VAKSIN</th>
                                                            <th style="width: 30%;">TGL. VAKSIN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        if (!empty($data_vaksin)) {
                                                             foreach ($data_vaksin as $list) {
                                                                  echo '<tr>';
                                                                  echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                  echo '<td class="align-middle" style="width: 30%;">' . $list['vaksin_jenis'] . '</td>';
                                                                  echo '<td class="align-middle" style="width: 39%;">' . $list['vaksin_nama'] . '</td>';
                                                                  echo '<td class="align-middle" style="width: 30%;">' . date('d-M-Y', strtotime($list['tgl_vaksin'])) . '</td>';
                                                                  echo '</tr>';
                                                             }
                                                        } else {
                                                             echo '<tr>';
                                                             echo '<td colspan=4 class=" align-middle text-center">Data tidak ada</td>';
                                                             echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtFilePendukung" role="tabpanel"
                                        aria-labelledby="v-pills-dtFilePendukung-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <h6>No. KTP</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['no_ktp'] ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <h6>Nama Lengkap</h6>
                                                    <input type="text" class="form-control"
                                                        value="<?= $data_kary['nama_lengkap'] ?>"
                                                        style="background-color:transparent;margin-top:-10px;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <h6>File Pendukung</h6>
                                                    <?php
                                                    if ($data_kary['url_pendukung'] != "") {
                                                        echo '<a href ="' . base_url('./berkasPendukung/') . $data_kary['auth_karyawan'] . '" target="_blank" class="btn btn-primary">Tampilkan File Pendukung</a>';
                                                    } else {
                                                        echo '<a target="_blank" class="btn btn-danger">File Tidak Ada</a>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-dtPelanggaran" role="tabpanel"
                                        aria-labelledby="v-pills-dtPelanggaran-tab">
                                        <div class="card-body row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <table id="tbmPelanggaranDetail"
                                                        class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center;width: 1%;">
                                                                    NO.</th>
                                                                <th style="width: 10%;">Tgl. Pelanggaran
                                                                </th>
                                                                <th style="width: 55%;">Punistment</th>
                                                                <th style="width: 19%;">Tgl. Punishment
                                                                </th>
                                                                <th style="width: 10%;">Tgl. Akhir
                                                                    Punishment</th>
                                                                <th style="width: 5%;">PROSES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 1;
                                                            if (!empty($data_langgar)) {
                                                                 foreach ($data_langgar as $list) {
                                                                      echo '<tr>';
                                                                      echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                      echo '<td class="align-middle" style="width: 60%;">' . date('d-M-Y', strtotime($list['tgl_langgar'])) . '</td>';
                                                                      echo '<td class="align-middle" style="width: 19%;">' . $list['langgar_jenis'] . '</td>';
                                                                      echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list['tgl_punishment'])) . '</td>';
                                                                      echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list['tgl_akhir_langgar'])) . '</td>';
                                                                      echo '<td style="text-align:center;">';
                                                                      echo '<button class="btn btn-info btn-sm text-white" title="Detail"><i class="fas fa-asterisk"></i></button> ';
                                                                      if ($list['url_langgar'] != "") {
                                                                           echo '<a href ="' . base_url('./berkasPelanggaran/') . $list['auth_langgar'] . '" target="_blank" class="btn btn-primary btn-sm text-white" title="Tampilkan File Pelanggaran"><i class="far fa-file-pdf"></i></a>';
                                                                      } else {
                                                                           echo '<a class="btn btn-danger btn-sm text-white" title="File pelanggaran tidak ada"><i class="fas fa-ban "></i></a>';
                                                                      }
                                                                      echo '</td>';
                                                                      echo '</tr>';
                                                                 }
                                                            } else {
                                                                 echo '<tr>';
                                                                 echo '<td colspan=6 class=" align-middle text-center">Data tidak ada</td>';
                                                                 echo '</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>