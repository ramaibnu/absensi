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
                                    Kalender
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Pengajuan
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
                        <?php $judul = 'Data Pengajuan'; ?>
                        <h5><?= $judul; ?></h5>
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
                        <div class="mt-3">
                            <div class="mb-2">
                                <!-- <a href="<?= base_url('absensi'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a> -->
                                <button class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url('addpengajuan') ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="">Nama Pengaju</label>
                                                <select name="pengaju" id="" class="form-control">
                                                    <option value="">--Pilih Nama--</option>
                                                    <?php foreach ($kary as $a) { ?>
                                                        <option value="<?= $a->no_nik ?>"><?= $a->nama_lengkap; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="">Tipe</label>
                                                <select name="tipe" id="" class="form-control">
                                                    <option value="">--Pilih Tipe--</option>
                                                    <option value="1">SPL</option>
                                                    <option value="2">CUTI</option>
                                                    <option value="2">UBAH SHIFT</option>
                                                </select>
                                                <label for="">Date</label>
                                                <input type="date" name="date" id="" class="form-control">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Time Start</label>
                                                        <input type="time" name="timestart" id="" class="form-control">
                                                    </div>
                                                    <div class="col">
                                                        <label for="">Time End</label>
                                                        <input type="time" name="timeend" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <label for="">Nama Atasan</label>
                                                <select name="atasan" id="" class="form-control">
                                                    <option value="">--Pilih Nama--</option>
                                                    <?php foreach ($kary as $a) { ?>
                                                        <option value="<?= $a->no_nik ?>"><?= $a->nama_lengkap; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="">Keterangan</label>
                                                <textarea name="ket" id="" class="form-control"></textarea>
                                                <label for="">Upload File</label>
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                    <thead>
                                        <tr class="font-weight-boldtext-white">
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Date</th>
                                            <th>Time Start</th>
                                            <th>Time End</th>
                                            <th>Atasan</th>
                                            <th>Ket</th>
                                            <th>File</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $a) { ?>
                                            <tr>
                                                <td><?= $a->nm; ?></td>
                                                <?php if ($a->tipe == 1) { ?>
                                                    <td>SPL</td>
                                                <?php } elseif ($a->tipe == 2) { ?>
                                                    <td>CUTI</td>
                                                <?php } else { ?>
                                                    <td>UBAH SHIFT</td>
                                                <?php } ?>
                                                <td><?= $a->date; ?></td>
                                                <?php if ($a->tipe == 2 || $a->tipe == 3) { ?>
                                                    <td>-</td>
                                                    <td>-</td>
                                                <?php } else { ?>
                                                    <td><?= $a->time_start; ?></td>
                                                    <td><?= $a->time_end; ?></td>
                                                <?php } ?>
                                                <td><?= $a->nama; ?></td>
                                                <td><?= $a->ket; ?></td>
                                                <?php if (isset($a->nm_file)) { ?>
                                                    <td class="text-center"><a href="<?= base_url('upload/' . $a->nm_file) ?>"><i class="fas fa-file"></i></a></td>
                                                <?php } else { ?>
                                                    <td class="text-center">-</td>
                                                <?php } ?>
                                                <?php if ($a->status_doc == 0) { ?>
                                                    <td><a href="<?= base_url('updpengajuan/' . $a->id_pengajuan) ?>" onclick="return confirm('Apakah yakin akan approve pengajuan ini?')" class="btn btn-sm btn-secondary">New</a></td>
                                                <?php } else { ?>
                                                    <td><button class="btn btn-sm btn-success">Approve</button></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>