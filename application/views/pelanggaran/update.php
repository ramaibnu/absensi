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
                                <a href="<?= base_url('pelanggaran'); ?>">
                                    Pelanggaran
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Edit Pelanggaran
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
                    <div class="card-header">
                        <h5>Edit Pelanggaran</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                Perbesar</span><span style="display: none"><i
                                                    class="feather icon-minimize"></i> Restore</span></a>
                                    </li>
                                    <li class="dropdown-item minimize-card">
                                        <a href="#!"><span><i class="feather icon-minus"></i>
                                                collapse</span><span style="display: none"><i
                                                    class="feather icon-plus"></i> expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="<?= base_url('Pelanggaran_api/update') ?>" method="POST"
                        data-parsley-validate>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="authLgrEdit" name="authLgrEdit"
                                    value="<?= $langgar['auth_langgar']; ?>">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                            <label for="">Perusahaan :</label><br>
                                            <input type="text" autocomplete="off" spellcheck="false"
                                                class="form-control bg-white"
                                                value="<?= $langgar['kode_perusahaan'] . " | " . $langgar['nama_perusahaan']; ?>"
                                                readonly><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <label for="">No. KTP :</label><br>
                                            <input id="txtKTPKaryLgrEdit" name="txtKTPKaryLgrEdit" type="text"
                                                autocomplete="off" spellcheck="false" class="form-control"
                                                value="<?= $langgar['no_ktp']; ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <label for="">NIK :</label><br>
                                            <input id="txtNIKKaryLgrEdit" name="txtNIKKaryLgrEdit" type="text"
                                                autocomplete="off" spellcheck="false" class="form-control"
                                                value="<?= $langgar['no_nik']; ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="">Nama Karyawan :</label><br>
                                            <input id="txtNamaKaryLgrEdit" name="txtNamaKaryLgrEdit" type="text"
                                                autocomplete="off" spellcheck="false" class="form-control"
                                                value="<?= $langgar['nama_lengkap']; ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="">Departemen :</label><br>
                                            <input id="txtDepartKaryLgrEdit" name="txtDepartKaryLgrEdit" type="text"
                                                autocomplete="off" spellcheck="false" class="form-control"
                                                value="<?= $langgar['depart']; ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="">Posisi :</label><br>
                                            <input id="txtPosisiKaryLgrEdit" name="txtPosisiKaryLgrEdit" type="text"
                                                autocomplete="off" spellcheck="false" class="form-control"
                                                value="<?= $langgar['posisi']; ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="tglLgrEdit" class="form-label"><span
                                                        class="text-danger font-weight-bold font-italic">*
                                                    </span>Tgl Pelanggaran :</label><br>
                                                <input type="date" id="tglLgrEdit" name="tglLgrEdit" autocomplete="off"
                                                    spellcheck="false" class="form-control"
                                                    value="<?= $langgar['tgl_langgar']; ?>" required><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="tglPunishLgrEdit" class="form-label"><span
                                                        class="text-danger font-weight-bold font-italic">*
                                                    </span>Tgl. Berlaku Disciplinary Action
                                                    :</label><br>
                                                <input type="date" id="tglPunishLgrEdit" name="tglPunishLgrEdit"
                                                    autocomplete="off" spellcheck="false" class="form-control"
                                                    value="<?= $langgar['tgl_punishment']; ?>" required><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="tglAkhirPunishLgrEdit" class="form-label"><span
                                                        class="text-danger font-weight-bold font-italic">*
                                                    </span>Tgl. Akhir Disciplinary Action
                                                    :</label><br>
                                                <input type="date" id="tglAkhirPunishLgrEdit"
                                                    name="tglAkhirPunishLgrEdit" autocomplete="off" spellcheck="false"
                                                    class="form-control bg-white"
                                                    value="<?= $langgar['tgl_akhir_langgar']; ?>" required><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="jenisLgrEdit" style="margin-bottom:15px;"
                                                    class="form-label"><span
                                                        class="text-danger font-weight-bold font-italic">*
                                                    </span>Jenis
                                                    Disciplinary Action :</label><br>
                                                <select id="jenisLgrEdit" name="jenisLgrEdit" class="form-control"
                                                    required>
                                                    <option value=''>-- PILIH DISCIPLINARY ACTION --</option>
                                                    <?php
                                                if (!empty($langgar_jenis)) {
                                                    foreach ($langgar_jenis as $data) {
                                                        echo "<option value='" . $data['auth_langgar_jenis'] . "' " . ($langgar['auth_langgar_jenis'] == $data['auth_langgar_jenis'] ? 'selected' : '') . ">" . $data['langgar_jenis'] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>-- DISCIPLINARY ACTION TIDAK ADA --</option>";
                                                }
                                                ?>
                                                </select><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                            <div class="form-group">
                                                <label for="ketLgrEdit" class="form-label"><span
                                                        class="text-danger font-weight-bold font-italic">*
                                                    </span>Keterangan :</label><br>
                                                <textarea id="ketLgrEdit" name="ketLgrEdit" autocomplete="off"
                                                    spellcheck="false" class="form-control bg-white"
                                                    required><?= $langgar['ket_langgar']; ?></textarea><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <a href="<?= $langgar['url_berkas'] ?>" target="_blank" id="btnBerkasTampil"
                                                name="btnBerkasTampil" type="button"
                                                class="btn font-weight-bold btn-primary">Berkas
                                                Disciplinary Action</a>
                                            <button id="btnGantiBerkas" type="button"
                                                class="btn font-weight-bold btn-success">Ganti Berkas
                                                Disciplinary Action</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-align-content-end p-2" style="margin-top:5px;">
                            <button type="submit" class="btn font-weight-bold btn-primary">Update</button>
                            <button id="btnSelesai" name="btnSelesai" type="button"
                                class="btn font-weight-bold btn-danger">Selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>