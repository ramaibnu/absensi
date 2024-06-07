<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Laporan Data Terbaru</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('dashboard_main');?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">
                                    Data Terbaru
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
                    <div class="card-header align-items-center">
                        <h5>Data Karyawan Terbaru : <?=date("d-M-Y H:i");?></h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                FullScreen</span><span style="display: none"><i
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
                        <div class="row mt-3">
                            <div class="alert alert-danger err_psn_databaru animate__animated animate__bounce d-none">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="lstperusahaandatabaru" class="mb-4">Perusahaan</label><br>
                                <select name="lstperusahaandatabaru" id="lstperusahaandatabaru" class="form-control">
                                    <option value="IC">PT UNGGUL DINAMIKA UTAMA</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="txttglprsdataterbaru">Tanggal</label><br>
                                <input name="txttglprsdataterbaru" id="txttglprsdataterbaru" type="date"
                                    class="form-control form-check-input">
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table id="tbmdataterbaru"
                                        class="table table-striped table-bordered table-hover text-black"
                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th class="text-nowrap" style="text-align:center;width:1%;">No.</th>
                                                <th class="text-nowrap" style="width:10%;">No. KTP</th>
                                                <th style="width:10%;">NIK</th>
                                                <th style="width:25%;">Nama Lengkap</th>
                                                <th style="width:35%;">Departemen</th>
                                                <th class="text-nowrap" style="text-align:center;width:9%;">Perusahaan
                                                </th>
                                                <th class="text-nowrap" style="text-align:center;width:9%;">Pembuat</th>
                                                <th class="text-nowrap" style="text-align:center;width:10%;">Tgl. Dibuat
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-right p-3 text-right d-none">
                        <button name="btnexportdataterbaru" id="btnexportdataterbaru"
                            class="btn btn-primary font-weight-bold">Export</button>
                        <button name="btnrefreshdataterbaru" id="btnrefreshdataterbaru"
                            class="btn btn-success font-weight-bold">Refresh</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card latest-update-card">
                    <div class="card-header align-items-center">
                        <h5>Data Bardasarkan User : <?=date("d-M-Y H:i");?></h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                FullScreen</span><span style="display: none"><i
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
                        <div class="row mt-3">
                            <div class="col-8 mb-5">
                                <label for="txttgluserdataterbaru">Tanggal</label><br>
                                <input name="txttgluserdataterbaru" id="txttgluserdataterbaru" type="date"
                                    class="form-control form-check-input">
                            </div><br>
                            <div class="col-12 mt-2 mb-2">
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tbmterbaruuser"
                                        class="table table-striped table-bordered table-hover text-black"
                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th class="text-nowrap" style="text-align:center;width:1%;">No.</th>
                                                <th class="text-nowrap" style="width:25%;">Nama User</th>
                                                <th style="width:25%;">Perusahaan</th>
                                                <th style="width:10%;">Jml. Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$no = 1;
foreach ($data_by_user as $data) {
    echo "<tr>";
    echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no++ . "</td>";
    echo "<td class='align-middle' style='width:50%;'>" . $data['nama'] . "</td>";
    echo "<td class='align-middle' style='width:10%;'>" . $data['kode'] . "</td>";
    echo "<td class='align-middle' style='text-align:center;width:10%;'>" . $data['jml'] . "</td>";
    echo "</tr>";
}

?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-right p-3 text-right d-none">
                        <button name="btnexportuserdataterbaru" id="btnexportuserdataterbaru"
                            class="btn btn-primary font-weight-bold">Export</button>
                        <button name="btnrefreshuserdataterbaru" id="btnrefreshuserdataterbaru"
                            class="btn btn-success font-weight-bold">Refresh</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card latest-update-card">
                    <div class="card-header align-items-center">
                        <h5>Data Bardasarkan Perusahaan : <?=date("d-M-Y H:i");?></h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                FullScreen</span><span style="display: none"><i
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
                        <div class="row mt-3">
                            <div class="col-8 mb-5 align-items-center">
                                <label for="txttgluserdataterbaru">Tanggal</label><br>
                                <input name="txttgluserdataterbaru" id="txttgluserdataterbaru" type="date"
                                    class="form-control form-check-input">
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tbmterbaruprs"
                                        class="table table-striped table-bordered table-hover text-black"
                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th class="text-nowrap" style="text-align:center;width:1%;">No.</th>
                                                <th class="text-nowrap" style="width:10%;">Perusahaan</th>
                                                <th class="text-nowrap" style="width:5%;">Kode Perusahaan</th>
                                                <th style="width:5%;">Jml. Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$no = 1;
foreach ($data_by_perusahaan as $data) {
    echo "<tr>";
    echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no++ . "</td>";
    echo "<td class='align-middle' style='width:50%;'>" . $data['nama'] . "</td>";
    echo "<td class='align-middle' style='text-align:center;width:10%;'>" . $data['kode'] . "</td>";
    echo "<td class='align-middle' style='text-align:center;width:10%;'>" . $data['jml'] . "</td>";
    echo "</tr>";
}
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-right p-3 text-right d-none">
                        <button name="btnexportprsdataterbaru" id="btnexportprsdataterbaru"
                            class="btn btn-primary font-weight-bold">Export</button>
                        <button name="btnrefreshprsdataterbaru" id="btnrefreshprsdataterbaru"
                            class="btn btn-success font-weight-bold">Refresh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>