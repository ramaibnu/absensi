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
                                    Tambah Pelanggaran
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
                        <h5>Pelanggaran</h5>
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
                    <div class="card-body">
                        <div class="mt-3">
                            <div class="mb-4">
                                <a href="<?= base_url('pelanggaran'); ?>" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh / Data</a>
                            </div>
                            <div
                                class="alert alert-danger err_psn_langgar_add animate__animated animate__bounce d-none">
                            </div>
                            <?= $this->session->flashdata('msg'); ?>
                            <?= $this->session->unset_userdata('msg'); ?>
                        </div>

                        <form action="javascript:void(0)" id="createPelanggaran" method="post"
                            enctype="multipart/form-data" data-parsley-validate>
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="perLanggar" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>
                                            Perusahaan :</label><br>
                                        <select id='perLanggar' name='perLanggar' class="form-control form-control-user"
                                            required>
                                            <option value="">-- PILIH PERUSAHAAN --</option>
                                            <?= $permst . $perstr; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="txtCariKaryLanggar"><span
                                            class="text-danger font-weight-bold font-italic">* </span> Cari
                                        Karyawan (Ketikkan No. KTP/ NIK / Nama Karyawan) :</label>
                                    <input id='txtCariKaryLanggar' name='txtCariKaryLanggar' type="text"
                                        autocomplete="off" spellcheck="false" class="form-control"
                                        placeholder="Ketikkan No. KTP/ NIK / Nama Karyawan" value="">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <label for=" txtKTPKaryLanggar">No. KTP :</label>
                                    <input id='txtKTPKaryLanggar' name='txtKTPKaryLanggar' class="form-control"
                                        readonly>
                                    <input id='authKTPKaryLanggar' name='authKTPKaryLanggar' type="hidden">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <label for="txtNIKKaryLanggar">NIK :</label>
                                    <input id='txtNIKKaryLanggar' name='txtNIKKaryLanggar' class="form-control"
                                        readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <label for="txtNamaKaryLanggar">Nama Karyawan :</label>
                                    <input id='txtNamaKaryLanggar' name='txtNamaKaryLanggar' class="form-control"
                                        readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <label for="txtDepartKaryLanggar">Departemen :</label>
                                    <input id='txtDepartKaryLanggar' name='txtDepartKaryLanggar' class="form-control"
                                        readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <label for="txtPosisiKaryLanggar">Posisi :</label>
                                    <input id='txtPosisiKaryLanggar' name='txtPosisiKaryLanggar' class="form-control"
                                        readonly>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="tglLanggar" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>Tgl.
                                            Pelanggaran :</label>
                                        <input id='tglLanggar' name='tglLanggar' type="date" autocomplete="off"
                                            spellcheck="false" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="tglPunish" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>Tgl.
                                            berlaku Disciplinary Action :</label>
                                        <input id='tglPunish' name='tglPunish' type="date" autocomplete="off"
                                            spellcheck="false" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="tglAkhirPunish" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>Tgl.
                                            Berakhir Disciplinary Action :</label>
                                        <input id='tglAkhirPunish' name='tglAkhirPunish' type="date" autocomplete="off"
                                            spellcheck="false" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="jenisPunish" style="margin-bottom:15px;" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">* </span>Jenis
                                            Disciplinary Action :</label>
                                        <select id='jenisPunish' name='jenisPunish' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control" required>
                                            <?php
                                        echo "<option value=''>-- PILIH DISCIPLINARY ACTION --</option>";
                                        if (!empty($langgar_jenis)) {
                                             foreach ($langgar_jenis as $list) {
                                                  echo "<option value='" . $list['auth_langgar_jenis'] . "'>" . $list['langgar_jenis'] . "</option>";
                                             }
                                        } else {
                                             echo "<option value=''>-- DISCIPLINARY ACTION TIDAK ADA --</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="ketLanggar" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>Keterangan Pelanggaran :</label><br>
                                        <textarea id='ketLanggar' name='ketLanggar' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="berkasPunish" class="form-label"><span
                                                class="text-danger font-weight-bold font-italic">*
                                            </span>Berkas Disciplinary Action :</label>
                                        <span class="text-danger font-weight-bold font-italic">(Berkas dengan
                                            format pdf, ukuran maksimal 100 kb)</span>
                                        <input id='berkasPunish' name='berkasPunish' type="file"
                                            class="form-control-file" accept=".pdf" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr class="mb-3">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Buat Data</button>
                                    <a href='<?= base_url('tambah_pelanggaran') ?>'
                                        class="btn font-weight-bold btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>