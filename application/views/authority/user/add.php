<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Sistem</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('users'); ?>">
                                    User
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tambah User
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
                        <h5>Tambah User</h5>
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
                                <a href="<?= base_url('users'); ?>" class="btn btn-primary font-weight-bold">Refresh /
                                    Data</a>
                            </div>
                        </div>
                        <form action="javascript:void(0)" id="addUser" method="post" data-parsley-validate>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="namaUser" class="form-label">Nama User <span
                                                class="text-danger">*</span></label>
                                        <input id='namaUser' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="emailUser" class="form-label">Email User <span
                                                class="text-danger">*</span></label>
                                        <input id='emailUser' type="text" autocomplete="off" spellcheck="false"
                                            data-parsley-valid-email="true" class="form-control form-control-user"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="sandiUser" class="form-label">Sandi <span
                                                class="text-danger">*</span></label>
                                        <input id='sandiUser' type="password" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="ulangSandi" class="form-label">Konfirmasi Ulang Sandi <span
                                                class="text-danger">*</span></label>
                                        <input id='ulangSandi' type="password" autocomplete="off" spellcheck="false" data-parsley-custom-confirm-password="sandiUser"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglAktif" class="form-label">Tanggal Aktif <span
                                                class="text-danger">*</span></label>
                                        <input id='tglAktif' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglExpired" class="form-label">Tanggal Expired <span
                                                class="text-danger">*</span></label>
                                        <input id='tglExpired' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="aksesUser" class="mb-3 form-label">Akses Menu <span
                                                class="text-danger">*</span></label>
                                        <select id='aksesUser' autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                            <option value="">-- Pilih Akses Menu --</option>
                                            <?php
                                            if (!empty($data_menu)) {
                                                foreach ($data_menu as $list) {
                                                    echo "<option value='" . $list['auth_menu'] . "'>" . $list['NamaMenu'] . "</option>";
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="perusahaanUser" class="mb-3 form-label">Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <select id='perusahaanUser' autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                            <option value="">-- Pilih Perusahaan --</option>
                                            <?= $permst . $perstr; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                    <a href="<?= base_url('tambah_user'); ?>"
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
</div>