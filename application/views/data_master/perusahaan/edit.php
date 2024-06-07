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
                                <a href="<?= base_url('perusahaan'); ?>">
                                    Perusahaan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Edit Perusahaan
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
                        <h5>Perusahaan</h5>
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
                        <div class="mt-3">
                            <div class="mb-4">
                                <a href="<?= base_url('perusahaan'); ?>" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh / Data</a>
                            </div>
                        </div>
                        <form action="<?= base_url('proses_edit_perusahaan') ?>" method="post" data-parsley-validate>
                            <div class="row">
                                <?php
                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }
                                   ?>
                                <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">
                                <input type="text" name="id" value="<?= $perusahaan['data'][0]['auth_perusahaan'] ?>" hidden>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="kodePerusahaan" class="form-label">Kode Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input id='kodePerusahaan' name='kode' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control"
                                            value="<?= $perusahaan['data'][0]['kode_perusahaan'] ?>" required>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="Perusahaan" class="form-label">Nama Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input id='Perusahaan' type="text" name="perusahaan" autocomplete="off" spellcheck="false"
                                            class="form-control" value="<?= $perusahaan['data'][0]['nama_perusahaan'] ?>"
                                            required>
                                        <small class="error2 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="alamatPerusahaan" class="form-label">Alamat <span
                                                class="text-danger">*</span></label>
                                        <input id='alamatPerusahaan' type="text" name="alamat" autocomplete="off" spellcheck="false"
                                            class="form-control" value="<?= $perusahaan['data'][0]['alamat_perusahaan'] ?>" required>
                                        <small class="error3 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <input type="text" id="id_prov" value="<?= $perusahaan['data'][0]['prov_perusahaan'] ?>"
                                        hidden>
                                    <div class="form-group">
                                        <label for="provPerusahaan" class="form-label">Provinsi <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtprovadd" class="input-group">
                                            <select id='provPerusahaan' name='prov' class="form-control"
                                                required>
                                                <option value="">-- Data Provinsi Tidak Ditemukan --</option>
                                            </select>
                                            <button
                                                class="btn btn-primary btn-sm feather icon-refresh-ccw refprov tooltips"
                                                title="Reload Provinsi"></button>
                                        </div>
                                        <small class="error5 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <input type="text" id="id_kabupaten" value="<?= $perusahaan['data'][0]['kab_perusahaan'] ?>"
                                        hidden>
                                    <div class="form-group">
                                        <label for="kabPerusahaan" class="form-label">Kabupaten/Kota <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkabadd" class="input-group">
                                            <select id='kabPerusahaan' name='kab' class="form-control"
                                                required>
                                                <option value="">-- PILIH PROVINSI TERLEBIH DAHULU --</option>
                                            </select>
                                            <button
                                                class="btn btn-primary btn-sm feather icon-refresh-ccw refkab tooltips"
                                                title="Reload Kabupaten"></button>
                                        </div>
                                        <small class="error6 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <input type="text" id="id_kecamatan" value="<?= $perusahaan['data'][0]['kec_perusahaan'] ?>"
                                        hidden>
                                    <div class="form-group">
                                        <label for="kecPerusahaan" class="form-label">Kecamatan <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkecadd" class="input-group">
                                            <select id='kecPerusahaan' name='kec' class="form-control"
                                                required>
                                                <option value="">-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>
                                            </select>
                                            <button
                                                class="btn btn-primary btn-sm feather icon-refresh-ccw refkec tooltips"
                                                title="Reload Kecamatan"></button>
                                        </div>
                                        <small class="error7 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <input type="text" id="id_kelurahan" value="<?= $perusahaan['data'][0]['kel_perusahaan'] ?>"
                                        hidden>
                                    <div class="form-group">
                                        <label for="kelPerusahaan" class="form-label">Kelurahan <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkeladd" class="input-group">
                                            <select id='kelPerusahaan' name='kel' class="form-control"
                                                required>
                                                <option value="">-- PILIH KECAMATAN TERLEBIH DAHULU --</option>
                                            </select>
                                            <button
                                                class="btn btn-primary btn-sm feather icon-refresh-ccw refkel tooltips"
                                                title="Reload Kelurahan"></button>
                                        </div>
                                        <small class="error8 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="ketPerusahaan" class="form-label">Keterangan </label><br>
                                        <textarea id='ketPerusahaan' type="text" autocomplete="off" name="ket" spellcheck="false"
                                            class="form-control form-control-user"><?= $perusahaan['data'][0]['ket_perusahaan'] ?></textarea>
                                        <small class="error14 text-danger font-italic font-weight-bold"></small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr class="mb-2">
                                    <button type="submit" name="btnTambahPerusahaan" id="btnTambahPerusahaan"
                                        class="btn font-weight-bold btn-primary">Simpan</button>
                                    <a href="<?= base_url('edit_perusahaan') ?>/<?= $perusahaan['data'][0]['auth_perusahaan'] ?>"
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