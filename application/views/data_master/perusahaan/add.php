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
                                    Tambah Perusahaan
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
                        <form action="javascript:void(0)" id="tambahPerusahaan" method="post" data-parsley-validate>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="kodePerusahaan" class="form-label">Kode Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input id='kodePerusahaan' name='kodePerusahaan' data-parsley-kode-perusahaan-max-length="8" type="text" autocomplete="off"
                                            spellcheck="false" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="Perusahaan" class="form-label">Nama Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input id='Perusahaan' type="text" data-parsley-nama-perusahaan-max-length="100" autocomplete="off" spellcheck="false"
                                            class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="alamatPerusahaan" class="form-label">Alamat <span
                                                class="text-danger">*</span></label>
                                        <input id='alamatPerusahaan' type="text" data-parsley-alamat-max-length="100" autocomplete="off" spellcheck="false"
                                            class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="provPerusahaan" class="form-label">Provinsi <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtprovadd" class="input-group">
                                            <select id='provPerusahaan' name='provPerusahaan' class="form-control"
                                                required>
                                                <option value="">-- Data Provinsi Tidak Ditemukan --</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm feather icon-refresh-ccw refprov"
                                                title="Reload Provinsi"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="kabPerusahaan" class="form-label">Kabupaten/Kota <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkabadd" class="input-group">
                                            <select id='kabPerusahaan' name='kabPerusahaan' class="form-control"
                                                required>
                                                <option value="">-- PILIH PROVINSI TERLEBIH DAHULU --</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkab"
                                                title="Reload Kabupaten"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="kecPerusahaan" class="form-label">Kecamatan <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkecadd" class="input-group">
                                            <select id='kecPerusahaan' name='kecPerusahaan' class="form-control"
                                                required>
                                                <option value="">-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkec"
                                                title="Reload Kecamatan"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="kelPerusahaan" class="form-label">Kelurahan <span
                                                class="text-danger">*</span></label><br>
                                        <div id="txtkeladd" class="input-group">
                                            <select id='kelPerusahaan' name='kelPerusahaan' class="form-control"
                                                required>
                                                <option value="">-- PILIH KECAMATAN TERLEBIH DAHULU --</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkel"
                                                title="Reload Kelurahan"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <label for="ketPerusahaan">Keterangan </label><br>
                                    <textarea id='ketPerusahaan' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr class="mb-2">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                    <button type="button" name="btnBatalPerusahaan" id="btnBatalPerusahaan"
                                        class="btn font-weight-bold btn-danger">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>