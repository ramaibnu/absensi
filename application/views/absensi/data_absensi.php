<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Absensi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc1" href="#">
                                    Absensi
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Data Absensi
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
                        <h5>Data Absensi</h5>
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
                                <a href="<?= base_url('kal_absensi'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Kalkulasi Absensi</a>
                                <!-- <a id="addbtn" href="<?= base_url('tambah_golongan'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th style="text-align:center;width:1%;">No.</th>
                                                <th style="text-align:center;">NIK</th>
                                                <th style="text-align:center;">Nama</th>
                                                <th style="text-align:center;">Tgl. Absensi</th>
                                                <th style="text-align:center;">Jam Masuk</th>
                                                <th style="text-align:center;">Jam Keluar</th>
                                                <th style="text-align:center;">Total Jam</th>
                                                <th style="text-align:center;">Ket</th>
                                                <th style="text-align:center;">Jadwal Plan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($absen as $a) {
                                                $df = date_diff(date_create($a->in), date_create($a->out));
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-left"><?= $a->no_nik; ?></td>
                                                    <td class="text-left"><?= $a->nama_lengkap; ?></td>
                                                    <td class="text-center"><?= $a->datea; ?></td>
                                                    <td><?= isset($a->in) && $a->in !== '00:00:00' ? $a->in : '-';  ?></td>
                                                    <td><?= isset($a->out) && $a->out !== '00:00:00' ? $a->out : '-';  ?></td>
                                                    <td class="text-left"><?= $df->format("%h Jam %i Menit") ?></td>
                                                    <td class="text-left"><?= isset($a->in) && $a->in !== '00:00:00' || isset($a->out) && $a->out !== '00:00:00' ? 'Masuk' : 'Tidak Masuk'; ?></td>
                                                    <td class="text-left"><?= $a->nama_shift; ?></td>
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
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>Data Absensi Finger</h5>
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
                                <a href="<?= base_url('absensi'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                                <!-- <a id="addbtn" href="<?= base_url('tambah_golongan'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th style="text-align:center;width:1%;">No.</th>
                                                <th style="text-align:center;">NIK</th>
                                                <th style="text-align:center;">Nama</th>
                                                <th style="text-align:center;">Date Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($absenfinger as $a) {
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-left"><?= !empty($a->no_nik) ? $a->no_nik : "-"  ?></td>
                                                    <td class="text-left"><?= !empty($a->nama_lengkap) ? $a->nama_lengkap : "-"; ?></td>
                                                    <td class="text-center"><?= $a->datetime; ?></td>
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