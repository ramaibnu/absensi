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
                                <a href="#">
                                    Karyawan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Edit Karyawan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12" style="overflow-x:auto;">
                <div id="addkry" class="card latest-update-card">
                    <div class="card-header align-items-center">
                        <h5 id="pageHeader">Edit Karyawan -
                            <?= $data_karyawan['nama_lengkap'] . ' (' . $data_karyawan['nama_m_perusahaan'] . ')' ?>
                        </h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                Fullscreen</span><span style="display: none"><i
                                                    class="feather icon-minimize"></i> Restore</span></a>
                                    </li>
                                    <li class="dropdown-item minimize-card">
                                        <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span
                                                style="display: none"><i class="feather icon-plus"></i>
                                                expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Data Alamat -->
                        <input type="text" id="valueAlamat" class="d-none"
                            value="<?= $data_alamat['id_alamat_ktp'] ?? '' ?>"></input>
                        <input type="text" id="valueProvinsi" class="d-none"
                            value="<?= $data_alamat['prov_ktp'] ?? '' ?>"></input>
                        <input type="text" id="valueKabupaten" class="d-none"
                            value="<?= $data_alamat['kab_ktp'] ?? '' ?>"></input>
                        <input type="text" id="valueKecamatan" class="d-none"
                            value="<?= $data_alamat['kec_ktp'] ?? '' ?>"></input>
                        <input type="text" id="valueKelurahan" class="d-none"
                            value="<?= $data_alamat['kel_ktp'] ?? '' ?>"></input>

                        <!-- Data Personal -->
                        <input type="text" id="authPersonal" class="d-none"
                            value="<?= $data_karyawan['auth_personal'] ?? '' ?>"></input>
                        <input type="text" id="valuePersonal" class="d-none"
                            value="<?= $data_karyawan['id_personal'] ?? '' ?>"></input>
                        <input type="text" id="valueKTP" class="d-none"
                            value="<?= $data_karyawan['no_ktp'] ?? '' ?>"></input>
                        <input type="text" id="valueWargaNegara" class="d-none"
                            value="<?= $data_karyawan['warga_negara'] ?? '' ?>"></input>
                        <input type="text" id="valueAgama" class="d-none"
                            value="<?= $data_karyawan['id_agama'] ?? '' ?>"></input>
                        <input type="text" id="valueJenisKelamin" class="d-none"
                            value="<?= $data_karyawan['jk'] ?? '' ?>"></input>
                        <input type="text" id="valueStatNikah" class="d-none"
                            value="<?= $data_karyawan['id_stat_nikah'] ?? '' ?>"></input>
                        <input type="text" id="valueStatPendidikan" class="d-none"
                            value="<?= $data_karyawan['id_pendidikan'] ?? '' ?>"></input>

                        <!-- Data Karyawan -->
                        <input type="text" id="authKaryawan" class="d-none"
                            value="<?= $data_karyawan['auth_karyawan'] ?? '' ?>"></input>
                        <input type="text" id="valueKaryawan" class="d-none"
                            value="<?= $data_karyawan['id_kary'] ?? '' ?>"></input>
                        <input type="text" id="valueDepartemen" class="d-none"
                            value="<?= $data_departemen['auth_depart'] ?? '' ?>"></input>
                        <input type="text" id="valueSection" class="d-none"
                            value="<?= $data_section['auth_section'] ?? '' ?>"></input>
                        <input type="text" id="valuePosisi" class="d-none"
                            value="<?= $data_posisi['auth_posisi'] ?? '' ?>"></input>
                        <input type="text" id="valueKlasifikasi" class="d-none"
                            value="<?= $data_karyawan['id_klasifikasi'] ?? '' ?>"></input>
                        <input type="text" id="valueGolongan" class="d-none"
                            value="<?= $data_karyawan['id_tipe'] ?? '' ?>"></input>
                        <input type="text" id="valueLevel" class="d-none"
                            value="<?= $data_level['auth_level'] ?? '' ?>"></input>
                        <input type="text" id="valueGrade" class="d-none"
                            value="<?= $data_grade['auth_grade'] ?? '' ?>"></input>
                        <input type="text" id="valueRoster" class="d-none"
                            value="<?= $data_roster['auth_roster'] ?? '' ?>"></input>
                        <input type="text" id="valuePointofHire" class="d-none"
                            value="<?= $data_poh['auth_poh'] ?? '' ?>"></input>
                        <input type="text" id="valueLokasiPenerimaan" class="d-none"
                            value="<?= $data_lokterima['auth_lokterima'] ?? '' ?>"></input>
                        <input type="text" id="valueLokasiKerja" class="d-none"
                            value="<?= $data_lokker['auth_lokker'] ?? '' ?>"></input>
                        <input type="text" id="valueStatusResidence" class="d-none"
                            value="<?= $data_karyawan['id_stat_tinggal'] ?? '' ?>"></input>
                        <input type="text" id="valuePaybase" class="d-none"
                            value="<?= $data_karyawan['paybase'] ?? '' ?>"></input>
                        <input type="text" id="valuePajak" class="d-none"
                            value="<?= $data_karyawan['statpajak'] ?? '' ?>"></input>
                        <input type="text" id="valueStruktur" class="d-none"
                            value="<?= $data_karyawan['auth_m_perusahaan'] ?? '' ?>"></input>

                        <!-- Data Tambahan -->
                        <input type="text" id="authBank" class="d-none"
                            value="<?= $data_bank['auth_bank'] ?? '' ?>"></input>

                        <div class="alert alert-danger errormsg animate__animated animate__bounce d-none mb-2"></div>

                        <div class="row p-3">
                            <div class="container-fluid">
                                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase" id="personal-tab" data-toggle="tab"
                                            href="#personalTab" role="tab" aria-controls="personal"
                                            aria-selected="true">Data Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="employee-tab" data-toggle="tab"
                                            href="#employeeTab" role="tab" aria-controls="employee"
                                            aria-selected="false">Data Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="additional-tab" data-toggle="tab"
                                            href="#additionalTab" role="tab" aria-controls="additional"
                                            aria-selected="false">Data Tambahan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="certificate-tab" data-toggle="tab"
                                            href="#certificateTab" role="tab" aria-controls="certificate"
                                            aria-selected="false">Sertifikasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="mcu-tab" data-toggle="tab" href="#mcuTab"
                                            role="tab" aria-controls="mcu" aria-selected="false">MCU</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="vaccine-tab" data-toggle="tab"
                                            href="#vaccineTab" role="tab" aria-controls="vaccine"
                                            aria-selected="false">Vaksin</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content px-5 py-3 container-fluid" id="myTabContent">
                                <div class="tab-pane fade show active" id="personalTab" role="tabpanel">
                                    <form action="javascript:void(0)" id="updateDataPersonal" method="POST"
                                        data-parsley-validate>
                                        <div class="card-body row">
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editNoKTP"> No. KTP
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editNoKTP' name='editNoKTP' type="text"
                                                        autocomplete=" off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['no_ktp'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editNamaLengkap">Nama Lengkap
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editNamaLengkap' name='editNamaLengkap'
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['nama_lengkap'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-10 col-md-10 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editAlamatKTP">Alamat <span
                                                            class="text-danger">*</span></label>
                                                    <input id='editAlamatKTP' name='editAlamatKTP' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_alamat['alamat_ktp'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-1 col-md-1 col-sm-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editRtKTP">RT </label>
                                                    <input id='editRtKTP' name='editRtKTP' type="number"
                                                        placeholder="000" autocomplete="off" spellcheck="false"
                                                        class="form-control" style="padding: 0.625rem 0;"
                                                        value="<?= $data_alamat['rt_ktp'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-1 col-md-1 col-sm-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editRwKTP">RW </label>
                                                    <input id='editRwKTP' name='editRwKTP' type="number"
                                                        placeholder="000" autocomplete="off" spellcheck="false"
                                                        class="form-control" style="padding: 0.625rem 0;"
                                                        value="<?= $data_alamat['rw_ktp'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editProvData">Provinsi <span
                                                            class="text-danger">*</span></label>
                                                    <div id="txtEditProv" class="input-group">
                                                        <select id='editProvData' name='editProvData' type="number"
                                                            autocomplete="off" spellcheck="false" class="form-control"
                                                            value="" required>
                                                            <option value="">-- TIDAK ADA DATA --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditProv"
                                                                name="refreshEditProv" class="btn btn-primary btn-sm"
                                                                title="Refresh Provinsi"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editKotaData">Kabupaten / Kota
                                                        <span class="text-danger">*</span></label>
                                                    <div id="txtEditKota" class="input-group">
                                                        <select id='editKotaData' name='editKotaData' type="text"
                                                            autocomplete="off" spellcheck="false" class="form-control"
                                                            value="" required>
                                                            <option value="">-- TIDAK ADA DATA --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditKota"
                                                                name="refreshEditKota" class="btn btn-primary btn-sm"
                                                                title="Refresh Kabupaten/Kota"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editKecData">Kecamatan <span
                                                            class="text-danger">*</span></label>
                                                    <div id="txtEditKec" class="input-group">
                                                        <select id='editKecData' name='editKecData' type="text"
                                                            autocomplete="off" spellcheck="false" class="form-control"
                                                            value="" required>
                                                            <option value="">-- TIDAK ADA DATA --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditKec"
                                                                name="refreshEditKec" class="btn btn-primary btn-sm"
                                                                title="Refresh Kecamatan"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editKelData">Kelurahan <span
                                                            class="text-danger">*</span></label>
                                                    <div id="txtEditKel" class="input-group">
                                                        <select id='editKelData' name='editKelData' type="text"
                                                            autocomplete="off" spellcheck="false" class="form-control"
                                                            value="" required>
                                                            <option value="">-- TIDAK ADA DATA --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditKel"
                                                                name="refreshEditKel" class="btn btn-primary btn-sm"
                                                                title="Refresh Kelurahan"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editKewarganegaraan">Warga
                                                        Negara
                                                        <span class="text-danger">*</span></label>
                                                    <select id="editKewarganegaraan" class="mb-3 form-control" required>
                                                        <option value="">-- PILIH WARGA NEGARA --</option>
                                                        <option value="WNI">WNI</option>
                                                        <option value="WNA">WNA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editAgama">Agama
                                                        <span class="text-danger">*</span></label>
                                                    <select id="editAgama" class="mb-3 form-control" required>
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editJenisKelamin">Jenis Kelamin
                                                        <span class="text-danger">*</span></label>
                                                    <select id="editJenisKelamin" class="mb-3 form-control" required>
                                                        <option value="">-- PILIH JENIS KELAMIN --</option>
                                                        <option value="LK">LAKI - LAKI</option>
                                                        <option value="P">PEREMPUAN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editStatPernikahan">Status
                                                        Pernikahan <span class="text-danger">*</span></label>
                                                    <div id="txtEditNikah" class="input-group">
                                                        <select id="editStatPernikahan" class="form-control" required>
                                                            <option value="">-- PILIH PERNIKAHAN --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditStatNikah"
                                                                name="refreshStatNikah" class="btn btn-primary btn-sm"
                                                                title="Refresh Status Pernikahan"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editTempatLahir">Tempat Lahir
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editTempatLahir' name='editTempatLahir' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['tmp_lahir'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editTanggalLahir">Tanggal Lahir
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editTanggalLahir' name='editTanggalLahir' type="date"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['tgl_lahir'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editNoBPJSTK">No. BPJS Tenaga
                                                        Kerja
                                                    </label>
                                                    <input id='editNoBPJSTK' name='editNoBPJSTK' type="number"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['no_bpjstk'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editNoBPJSKES">No. BPJS
                                                        Kesehatan
                                                    </label>
                                                    <input id='editNoBPJSKES' name='editNoBPJSKES' type="number"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['no_bpjskes'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editNoNPWP">No. NPWP </label>
                                                    <input id='editNoNPWP' name='editNoNPWP' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['no_npwp'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editNoKK">No. Kartu
                                                        Keluarga
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editNoKK' name='editNoKK' type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['no_kk'] ?? '' ?>" required>
                                                    <span class="89kjm78ujki782m4x787909h3 d-none"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editEmail">Email Pribadi
                                                    </label>
                                                    <input id='editEmail' name='editEmail' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['email_pribadi'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editNoTelp">Nomor Telepon /
                                                        Handphone </label>
                                                    <input id='editNoTelp' name='editNoTelp' type="number"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['hp_1'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editPendidikanTerakhir">Pendidikan
                                                        Terakhir <span class="text-danger">*</span></label></label>
                                                    <div id="txtEditDidik" name="txtEditDidik" class="input-group">
                                                        <select id='editPendidikanTerakhir'
                                                            name='editPendidikanTerakhir' type="text" autocomplete="off"
                                                            spellcheck="false" class="form-control" required>
                                                            <option value="">-- PILIH PENDIDIKAN --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditDidik"
                                                                title="Refresh Pendidikan" name="refreshDidik"
                                                                class="btn btn-primary btn-sm"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editSekolah">Nama Sekolah/Perguruan Tinggi
                                                    </label>
                                                    <input id='editSekolah' name='editSekolah' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['nama_sekolah'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editFakultas">Fakultas
                                                    </label>
                                                    <input id='editFakultas' name='editFakultas' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['fakultas'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editJurusan">Jurusan
                                                    </label>
                                                    <input id='editJurusan' name='editJurusan' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['jurusan'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mt-3 col-lg-12 col-md-12 col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary font-weight-bold">Simpan
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="employeeTab" role="tabpanel">
                                    <form action="javascript:void(0)" id="updateDataKaryawan" method="post"
                                        data-parsley-validate>
                                        <div class="card-body row">
                                            <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editNIKKary">Nomor
                                                        Induk
                                                        Karyawan
                                                        (NIK) <span class="text-danger">*</span></label>
                                                    <input id="editNIKKary" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_karyawan['no_nik'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editDepartKary">Departemen
                                                        <span class="text-danger">*</span></label>
                                                    <div id='txtEditDepartKary' class="input-group">
                                                        <select id='editDepartKary' name='editDepartKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditDepart"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Departemen"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editSectionKary">Section <span
                                                            class="text-danger">*</span></label>
                                                    <div id='txtEditSectionKary' class="input-group">
                                                        <select id='editSectionKary' name='editSectionKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditSection"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Section"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editPosisiKary">Posisi <span
                                                            class="text-danger">*</span></label>
                                                    <div id='txtEditPosisiKary' class="input-group">
                                                        <select id='editPosisiKary' name='editPosisiKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditPosisi"
                                                                class="btn btn-primary btn-sm" title="Refresh Posisi"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editLevelKary">Level
                                                        <span class="text-danger">*</span></label>
                                                    <div id='txtEditLevelKary' class="input-group">
                                                        <select id='editLevelKary' name='editLevelKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditLevel"
                                                                name="refreshEditLevel" class="btn btn-primary btn-sm"
                                                                title="Refresh Level"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editGradeKary">Grade
                                                        <span class="text-danger">*</span></label>
                                                    <div id='txtEditGradeKary' class="input-group">
                                                        <select id='editGradeKary' name='editGradeKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditGrade"
                                                                name="refreshEditGrade" class="btn btn-primary btn-sm"
                                                                title="Refresh Grade"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editKlasifikasiKary">Klasifikasi
                                                        <span class="text-danger">*</span></label>
                                                    <div id="txtEditKlasifikasiKary" class="input-group">
                                                        <select id="editKlasifikasiKary" name="editKlasifikasiKary"
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditKlasifikasi"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Klasifikasi"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                            <button type="button" id="infoEditKlasifikasi"
                                                                class="btn btn-warning btn-sm" title="Informasi"><i
                                                                    class="fas fa-info-circle"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editTipeKary">Golongan <span
                                                            class="text-danger">*</span></label>
                                                    <div id='txtEditJeniskary' class="input-group">
                                                        <select id='editTipeKary' name='editTipeKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditTipe"
                                                                name="refreshEditTipe" class="btn btn-primary btn-sm"
                                                                title="Refresh Golongan"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editRosterKary">Roster <span
                                                            class="text-danger">*</span></label>
                                                    <div id='txtEditJeniskary' class="input-group">
                                                        <select id='editRosterKary' name='editRosterKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditRoster"
                                                                name="refreshEditRoster" class="btn btn-primary btn-sm"
                                                                title="Refresh Roster"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editPOHKary">Point
                                                        of Hire
                                                        <span class="text-danger">*</span></label>
                                                    <div id='txtEditPOHKary' class="input-group">
                                                        <select id='editPOHKary' name='editPOHKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditPOH"
                                                                name="refreshEditPOH" class="btn btn-primary btn-sm"
                                                                title="Refresh Point of Hire"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editLokterimaKary">Lokasi
                                                        Penerimaan <span class="text-danger">*</span></label>
                                                    <div id='txtEditLokterimaKary' class="input-group">
                                                        <select id='editLokterimaKary' name='editLokterimaKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditLokterima"
                                                                name="refreshEditLokterima"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Lokasi Penerimaan"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editLokkerKary">Lokasi Kerja
                                                        <span class="text-danger">*</span></label>
                                                    <div id='txtEditLokkerKary' class="input-group">
                                                        <select id='editLokkerKary' name='editLokkerKary'
                                                            class="form-control form-control-user" required>
                                                            <option value="">-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditLokker"
                                                                name="refreshEditLokker" class="btn btn-primary btn-sm"
                                                                title="Refresh Lokasi Kerja"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editStatusResidence">Status
                                                        Residence <span class="text-danger">*</span></label>
                                                    <div id='txtEditStatResidence' class="input-group">
                                                        <select id='editStatusResidence' name='editStatusResidence'
                                                            class="form-control form-control-user" required>
                                                            <option value="" default>-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditResidence"
                                                                name="refreshEditResidence"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Status Residence"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="editDOH">Date of
                                                        Hire <span class="text-danger">*</span></label>
                                                    <input id='editDOH' name='editDOH' type='date'
                                                        class="form-control form-control-user"
                                                        value="<?= $data_karyawan['doh'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editTanggalAktif">Tanggal Aktif
                                                        <span class="text-danger">*</span></label>
                                                    <input id='editTanggalAktif' name='editTanggalAktif' type='date'
                                                        class="form-control form-control-user"
                                                        value="<?= $data_karyawan['tgl_aktif'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="editEmailKantor">Email
                                                        Perusahaan
                                                    </label>
                                                    <input id='editEmailKantor' name='editEmailKantor' type="text"
                                                        autocomplete="off" spellcheck="false" class="form-control"
                                                        value="<?= $data_karyawan['email_kantor'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editPaybase">Paybase <span class="text-danger">*</span></label>
                                                    <div id='txtEditPaybase' class="input-group">
                                                        <select id='editPaybase' name='editPaybase'
                                                            class="form-control form-control-user" required>
                                                            <option value="" default>-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditPaybase"
                                                                name="refreshEditPaybase"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Paybase"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="editPajak">Status Pajak <span class="text-danger">*</span></label>
                                                    <div id='txtEditPajak' class="input-group">
                                                        <select id='editPajak' name='editPajak'
                                                            class="form-control form-control-user" required>
                                                            <option value="" default>-- WAJIB DIPILIH --</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="refreshEditPajak"
                                                                name="refreshEditPajak"
                                                                class="btn btn-primary btn-sm"
                                                                title="Refresh Status Pajak"><i
                                                                    class="fas fa-sync-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" id="dataKontrakKaryawan">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                <button type="submit"
                                                    class="btn btn-primary font-weight-bold text-white">Simpan
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="additionalTab" role="tabpanel">b
                                    <form action="javascript:void(0)" id="updateDataTambahan" method="post"
                                        data-parsley-validate>
                                        <div class="card-body row">
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="namaIbu">Nama
                                                        Ibu</label>
                                                    <input id="namaIbu" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_karyawan['nama_ibu'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="statusIbu">Status
                                                        Ibu</label>
                                                    <select class="form-control" id="statusIbu">
                                                        <option value=""> -- PILIH STATUS IBU -- </option>
                                                        <option value="H"
                                                            <?= $data_karyawan['stat_ibu'] == 'H' ? 'selected' : '' ?>>
                                                            Masih Ada</option>
                                                        <option value="M"
                                                            <?= $data_karyawan['stat_ibu'] == 'M' ? 'selected' : '' ?>>
                                                            Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="namaAyah">Nama
                                                        Ayah</label>
                                                    <input id="namaAyah" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_karyawan['nama_ayah'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-5 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="statusAyah">Status
                                                        Ayah</label>
                                                    <select class="form-control" id="statusAyah">
                                                        <option value=""> -- PILIH STATUS AYAH -- </option>
                                                        <option value="H"
                                                            <?= $data_karyawan['stat_ayah'] == 'H' ? 'selected' : '' ?>>
                                                            Masih Ada</option>
                                                        <option value="M"
                                                            <?= $data_karyawan['stat_ayah'] == 'M' ? 'selected' : '' ?>>
                                                            Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="bank">Bank <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="bank" required>
                                                        <option value=""> -- PILIH BANK -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="pemilik">Nama
                                                        Pemilik <span class="text-danger">*</span></label>
                                                    <input id="pemilik" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_bank['nama_pemilik'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="rekening">Nomor
                                                        Rekening <span class="text-danger">*</span></label>
                                                    <input id="rekening" type="number" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_bank['no_rek'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-5 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="keterangan">Keterangan Data Bank</label>
                                                    <textarea id='keterangan' class="form-control" value="<?= $data_ec['ket_bank_kary'] ?? '' ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                                <h6>Emergency Contact :</h6>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="nama_ec">Nama <span class="text-danger">*</span></label>
                                                    <input id="nama_ec" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_ec['nama_ec'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="relasi_ec">Relasi <span class="text-danger">*</span></label>
                                                    <input id="relasi_ec" type="text" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_ec['relasi_ec'] ?? '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="hp_ec">Nomor
                                                        HP <span class="text-danger">*</span></label>
                                                    <input id="hp_ec" type="number" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_ec['hp_ec'] || $data_ec['hp_ec'] != '0' ? $data_ec['hp_ec'] : '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label" for="hp_ec_2">Nomor HP
                                                        2</label>
                                                    <input id="hp_ec_2" type="number" autocomplete="off"
                                                        spellcheck="false" class="form-control form-control-user"
                                                        value="<?= $data_ec['hp_ec_2'] || $data_ec['hp_ec_2'] != '0' ? $data_ec['hp_ec_2'] : '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold form-label"
                                                        for="ket_ec">Keterangan</label>
                                                    <textarea id='ket_ec' class="form-control" value="<?= $data_ec['ket_ec'] ?? '' ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <div class="d-flex justify-content-end">
                                                <button type="button" data-toggle="modal" data-target="#addKeluarga" class="tooltips btn btn-primary btn-sm" title="Tambah Keluarga"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="mb-4 col-lg-12 col-md-12 col-sm-12" id="dataKeluarga">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                <button type="submit"
                                                    class="btn btn-primary font-weight-bold text-white">Simpan
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="certificateTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div id="idEditSertifikat" class="col-lg-12 col-md-12 col-sm-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="mcuTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="col-lg-12 col-md-12 col-sm-12" id="dataEditMCU">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vaccineTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div id="idEditVaccine" class="col-lg-12 col-md-12 col-sm-12">
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