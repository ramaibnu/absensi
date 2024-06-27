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
                                    Data Plan Kehadiran
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
                        <h5>Data Plan Kehadiran</h5>
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
                        <form action="" method="post">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <?php if (isset($dpt)) { ?>
                                        <h4><?= $dpt->depart; ?></h4>
                                        <h5><?= $start; ?> - <?= $end; ?></h5>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="depart" id="" class="form-control">
                                        <option value="">--Pilih Departemen--</option>
                                        <?php foreach ($depart as $a) { ?>
                                            <option value="<?= $a->id_depart ?>"><?= $a->depart; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="start" id="" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="end" id="" class="form-control">
                                </div>
                                <div class="col-md-3 mt-2">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-table"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <?php

                                            $start = new DateTime($start);
                                            $end = new DateTime($end);
                                            $currentDate = clone $start;
                                            ?>
                                            <tr class="font-weight-boldtext-white">
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Posisi</th>
                                                <?php while ($currentDate <= $end) { ?>
                                                    <?php $currentDateValue = $currentDate->format('d/M'); ?>
                                                    <th class="text-center"><?= $currentDateValue; ?></th>
                                                    <?php
                                                    $currentDate->modify('+1 day');
                                                    ?>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <?php foreach ($jadwalgroup as $a) { ?>
                                                <tr>
                                                    <td><?= $a->nik; ?></td>
                                                    <?php foreach ($jadwal as $z) { ?>
                                                        <?php if ($z->nik == $a->nik) { ?>
                                                            <td><?= $z->kode_shift; ?></td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?> -->
                                            <?php foreach ($data as $a) { ?>
                                                <tr>
                                                    <td><?= $a['nama'] ?></td>
                                                    <td><?= $a['depart'] ?></td>
                                                    <td><?= $a['posisi'] ?></td>
                                                    <?php
                                                    $current = clone $start;
                                                    ?>
                                                    <?php
                                                    while ($current <= $end) { ?>
                                                        <?php $currentDateValue = $current->format('Y-m-d'); ?>
                                                        <?php if (isset($a[$currentDateValue])) { ?>
                                                            <td class="text-center"><?= $a[$currentDateValue][1] ?></td>
                                                        <?php } else { ?>
                                                            <td class="text-center">-</td>
                                                        <?php } ?>
                                                        <?php $current->modify('+1 day');
                                                        ?>
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
</div>