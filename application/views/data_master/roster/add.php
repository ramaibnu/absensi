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
                                <a href="<?= base_url('roster'); ?>">
                                    Roster
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tambah Roster
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
                        <h5>Roster</h5>
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
                                <a href="<?= base_url('roster'); ?>" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh / Data</a>
                            </div>
                        </div>
                        <form action="javascript:void(0);" id="tambahData" method="post" data-parsley-validate>
                            <div class="row ">
                                <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="pilihPerusahaan" class="form-label">Perusahaan <span
                                                class="text-danger">*</span></label><br>
                                        <select id='pilihPerusahaan' class="form-control form-control-user" required>
                                            <option value="">-- PILIH PERUSAHAAN --</option>
                                            <?= $permst . $perstr; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="onsite" class="form-label">Jumlah Mingguan (Onsite) <span
                                                class="text-danger">*</span></label>
                                        <input id='onsite' type="number" min="1" max="99" step="1" autocomplete="off"
                                            spellcheck="false" class="form-control bg-white"
                                            aria-describedby="onsiteAddon" required>
                                        <small id="onsiteAddon" class="form-text text-muted">Isi jumlah berapa minggu
                                            onsite.</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="offsite" class="form-label">Jumlah Mingguan (Offsite) <span
                                                class="text-danger">*</span></label>
                                        <input id='offsite' type="number" min="1" max="99" step="1" autocomplete="off"
                                            spellcheck="false" class="form-control bg-white"
                                            aria-describedby="offsiteAddon" required>
                                        <small id="offsiteAddon" class="form-text text-muted">Isi jumlah berapa minggu
                                            offsite.</small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="keterangan">Keterangan </label><br>
                                    <textarea id='keterangan' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user"></textarea>
                                </div>
                                <div class="mt-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <a href="<?= base_url('roster') ?>"
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