<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Plan Kehadiran</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc1" href="#">
                                    Plan Kehadiran
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Setting Plan Kehadiran
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
                        <h5>Setting Plan Kehadiran</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                Perbesar</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                    </li>
                                    <li class="dropdown-item minimize-card">
                                        <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('sukses')) { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong><?= $this->session->flashdata('sukses'); ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="mt-3">
                            <div class="mb-2">
                                <!-- <a href="<?= base_url('absensi'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a> -->
                                <!-- <a id="addbtn" href="<?= base_url('tambah_golongan'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a> -->
                            </div>
                        </div>
                        <form action="<?php base_url() ?>export" method="post">
                            <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Ubah Hari Shift</button>
                            <h5 class="text-left mt-4">DOWNLOAD PLAN</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" name="start" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="end" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Departemen</label>
                                    <select name="depart" id="" class="form-control" required>
                                        <option value="">--Pilih Departemen--</option>
                                        <?php foreach ($depart as $a) { ?>
                                            <option value="<?= $a->id_depart; ?>"><?= $a->depart; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-success" style="margin-top:40px">
                                        <i class="feather icon-download"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?= base_url('updjadwal') ?>" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="">Nama Pengaju</label>
                                            <select name="nik" id="" class="form-control">
                                                <option value="">--Pilih Nama--</option>
                                                <?php foreach ($kary as $a) { ?>
                                                    <option value="<?= $a->no_nik ?>"><?= $a->nama_lengkap; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="">Date</label>
                                            <input type="date" name="date" id="" class="form-control">
                                            <label for="">Tipe Shift</label>
                                            <select name="tipe" id="" class="form-control">
                                                <option value="">--Pilih Tipe--</option>
                                                <option value="D">DAY</option>
                                                <option value="N">NIGHT</option>
                                                <option value="O">OFF</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <form action="<?= base_url() ?>import" method="post" enctype="multipart/form-data">
                            <h5 class="text-left">UPLOAD PLAN</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" name="start" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="end" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Upload File Plan Kehadiran</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-success" style="margin-top:40px">
                                        <i class="feather icon-upload"></i>
                                    </button>
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