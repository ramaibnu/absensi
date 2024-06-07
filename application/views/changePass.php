<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Ganti Sandi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('change_password_view'); ?>">
                                    Ganti Sandi
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
                        <h5>Ganti Sandi</h5>
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
                    <div class="card-body mt-4">
                        <form action="javascript:void(0)" id="updatePassword" method="POST" data-parsley-validate>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="lamaSandi" class="form-label">Sandi Lama <span
                                                        class="text-danger">*</span></label>
                                                <input id='lamaSandi' type="password" autocomplete="off"
                                                    spellcheck="false" class="form-control form-control-user" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                            <div class="form-group">
                                                <label for="baruSandi" class="form-label">Sandi Baru <span
                                                        class="text-danger">*</span></label>
                                                <input id='baruSandi' type="password" data-parsley-sandi-min-length="6"
                                                    autocomplete="off" spellcheck="false"
                                                    class="form-control form-control-user" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                            <div class="form-group">
                                                <label for="ulangSandi" class="form-label">Konfirmasi Ulang
                                                    Sandi <span class="text-danger">*</span></label>
                                                <input id='ulangSandi' type="password"
                                                    data-parsley-custom-confirm-password="baruSandi" autocomplete="off"
                                                    spellcheck="false" class="form-control form-control-user" required>
                                            </div>

                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                            <button type="submit"
                                                class="btn font-weight-bold btn-primary">Simpan</button>
                                            <a href='<?= base_url('dashboard_main') ?>'
                                                class="btn font-weight-bold btn-danger">Batal</a>
                                        </div>
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