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
                                <a href="<?= base_url('level'); ?>">
                                    Level
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tambah Level
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
                        <h5>Level</h5>
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
                                <a href="<?= base_url('level'); ?>" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh / Data</a>
                            </div>
                        </div>
                        <form action="javascript:void(0)" id="tambahLevel" method="post" data-parsley-validate>
                            <div class="row ">
                                <?php
                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }
                                   ?>
                                <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="perLevel" class="form-label">Perusahaan <span
                                                class="text-danger">*</span></label><br>
                                        <select id='perLevel' name='perLevel' class="form-control form-control-user" required>
                                            <option value="">-- PILIH PERUSAHAAN --</option>
                                            <?= $permst . $perstr; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="kodeLevel" class="form-label">Kode <span
                                                class="text-danger">*</span></label>
                                        <input style="text-transform:uppercase" id='kodeLevel' name='kodeLevel'
                                            type="text" autocomplete="off" spellcheck="false"
                                            data-parsley-kode-max-length="8" class="form-control form-control-user"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="Level" class="form-label">Level <span
                                                class="text-danger">*</span></label>
                                        <input style="text-transform:uppercase" id='Level' type="text"
                                            autocomplete="off" spellcheck="false" class="form-control form-control-user"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="ketLevel">Keterangan </label><br>
                                    <textarea id='ketLevel' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr class="mb-2">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                    <button type="button" name="btnBatalLevel" id="btnBatalLevel"
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