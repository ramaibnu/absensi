<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Karyawan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard_main'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc1" href="#">
                                    Karyawan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Data Karyawan
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
                        <h5>Data Karyawan</h5>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <!-- <table id="example" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:10px;"> -->
                                    <table id="example" class="table-striped table-bordered text-black display" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:0.9em">
                                        <thead style="background-color:lightgrey">
                                            <tr class=" font-weight-boldtext-white">
                                                <th style="text-align:center;width:1%;">#</th>
                                                <th style="text-align:center; width:5%">NIK</th>
                                                <th style="text-align:center;">Nama</th>
                                                <th style="text-align:center;">Departemen</th>
                                                <th style="text-align:center;">Posisi</th>
                                                <th style="text-align:center;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($karyawan as $a) {
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-left"><?= $a->no_nik; ?></td>
                                                    <td class="text-left"><?= $a->nama_lengkap; ?></td>
                                                    <td class="text-left"><?= $a->depart; ?></td>
                                                    <td class="text-left"><?= $a->posisi; ?></td>
                                                    <td class="text-center"><?= $a->tipe; ?></td>
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