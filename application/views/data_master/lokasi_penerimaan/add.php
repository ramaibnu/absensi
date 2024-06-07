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
                                <a href="<?= base_url('lokasi_penerimaan'); ?>">
                                    Lokasi Penerimaan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tambah Lokasi Penerimaan
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
                        <h5>Lokasi Penerimaan</h5>
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
                            <div class="mb-5">
                                <a href="<?= base_url('lokasi_penerimaan'); ?>"
                                    class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh /
                                    Data</a>
                            </div>
                        </div>
                        <form action="javascript:void(0);" id="tambahData" method="post" data-parsley-validate>
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="kode" class="form-label">Kode Lokasi Penerimaan <span
                                                class="text-danger">*</span></label>
                                        <input style="text-transform:uppercase" id='kode' type="text" autocomplete="off"
                                            spellcheck="false" aria-describedby="kodeHelp" data-parsley-kode-max-length="8" class="form-control bg-white" required>
                                        <small id="kodeHelp" class="form-text text-muted">Kode Lokasi Penerimaan maksimal 8
                                            karakter.</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="lokasiPenerimaan" class="form-label">Lokasi Penerimaan <span
                                                class="text-danger">*</span></label>
                                        <input style="text-transform:uppercase" id='lokasiPenerimaan' type="text"
                                            autocomplete="off" spellcheck="false" class="form-control bg-white"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="jenisLokasi" class="form-label">Jenis Lokasi <span
                                                class="text-danger">*</span></label><br>
                                        <select class="form-control bg-white" id="jenisLokasi" autocomplete="off"
                                            spellcheck="false" required>
                                            <option value="">-- Pilih Jenis Lokasi</option>
                                            <option value="LOKAL">LOKAL</option>
                                            <option value="NONLOKAL">NONLOKAL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="keterangan">Keterangan </label><br>
                                    <textarea id='keterangan' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control bg-white"></textarea>
                                </div>
                                <div class="mt-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <a href="<?= base_url('lokasi_penerimaan') ?>"
                                            class="btn font-weight-bold btn-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>