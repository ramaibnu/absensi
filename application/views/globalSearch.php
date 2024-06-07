<div class="pcoded-main-container" style="margin-top:-53px;">
    <div class="pcoded-content">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>Pencarian Data </h5>
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
                                        <a href="#!"><span><i class="feather icon-minus"></i>
                                                collapse</span><span style="display: none"><i
                                                    class="feather icon-plus"></i> expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 mb-3">
                                <h4 id="lbldatacari">Hasil pencarian data : <?=$textcari?></h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table id="tbmCariData"
                                    class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap"
                                    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;width: 1%;">NO.
                                            </th>
                                            <th style="width: 15%;">No. KTP</th>
                                            <th style="width: 9%;">NIK</th>
                                            <th style="width: 20%;">Nama Karyawan</th>
                                            <th style="width: 20%;">Departemen</th>
                                            <th style="width: 25%;">Posisi</th>
                                            <th style="width: 9%;">Perusahaan</th>
                                            <th style="width: 1%;">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            if ($status == 200) {
                                                foreach ($data_kry as $list) {
                                                    echo '<tr>';
                                                    echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                    echo '<td class="align-middle text-nowrap" style="width: 15%;">' . $list['no_ktp'] . '</td>';
                                                    echo '<td class="align-middle text-nowrap" style="width: 9%;">' . $list['no_nik'] . '</td>';
                                                    echo '<td class="align-middle text-nowrap" style="width: 20%;">' . $list['nama_lengkap'] . '</td>';
                                                    echo '<td class="align-middle" style="width: 20%;">' . $list['depart'] . '</td>';
                                                    echo '<td class="align-middle" style="width: 25%;">' . $list['posisi'] . '</td>';
                                                    echo '<td class="align-middle text-nowrap" style="width: 9%;">' . $list['kode_perusahaan'] . '</td>';
                                                    echo '<td class="align-middle text-nowrap text-center" style="width: 1%;"><a href="javascript:void(0)" class="btn btn-primary btn-sm onprocess"><i class="fas fa-asterisk"></i></a></td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr>';
                                                echo '<td colspan=7 class=" align-middle text-center">Data tidak ada</td>';
                                                echo '</tr>';
                                            }
                                        ?>
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