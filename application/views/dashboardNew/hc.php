<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="font-italic font-weight-bold text-white">Selamat Datang,</h5>
                            <h2 class="font-weight-bold text-white" style="margin-top:-10px;"><?=$nama;?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5"></div>
            <div class="row">
                <div class="col-lg-12 col-md-12" style="margin-top:-20px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-yellow" id="jumlahKaryawan"><?=$jml_karyawan?></h4>
                                            <h6 class="text-muted m-b-0">Karyawan</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-user f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-yellow">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <a href="#!" onclick="tabelUser()"
                                                class="d-flex justify-content-start text-white m-b-0">Detail</a>
                                        </div>
                                        <!-- <?php
                                    $current = $this->session->userdata('id_user_hcdata');
                                    $allowed = [106, 1, 27, 60, 59, 24];
                                    if (in_array($current, $allowed)) { ?>
                                    <div class="col-6">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#downloadDataKaryawan"
                                            class="d-flex justify-content-end text-white m-b-0">Download</a>
                                    </div>
                                    <?php } ?> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green" id="jumlahPerusahaan"><?=$jml_perusahaan?></h4>
                                            <h6 class="text-muted m-b-0">Perusahaan</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-home f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <a href="#" class="text-white m-b-0 onprocess">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red" id="jumlahPelanggaran"><?=$jml_lgr_aktif?></h4>
                                            <h6 class="text-muted m-b-0">Pelanggaran</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-upload-cloud f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <a href='javascript:void(0)' id='detLanggar' name='detLanggar'
                                                class="d-flex justify-content-start text-white m-b-0">Detail</a>
                                        </div>
                                        <!-- <?php
                                    $current = $this->session->userdata('id_user_hcdata');
                                    $allowed = [106, 1, 27, 60, 59, 24];
                                    if (in_array($current, $allowed)) { ?>
                                    <div class="col-6">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#downloadDataPelanggaran" class="d-flex justify-content-end text-white m-b-0">Download</a>
                                    </div>
                                    <?php } ?> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-blue"><?=$new_kry?></h4>
                                            <h6 class="text-muted m-b-0">Data Terbaru</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-file-plus f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-blue">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <a href="<?=base_url('dashboard_datatables');?>" target="_blank"
                                                class="text-white m-b-0">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Jumlah Karyawan Tanggal (Contractor + Sub Contractor): <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartPerusahaan">
                            <div id="bar-chart-1" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="chartKaryawanKeluar">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>
                                Karyawan Keluar di tahun <span id="perbandinganTahun"><?=date("Y");?></span>
                            </h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartPerbandingan">
                            <div id="bar-chart-8" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Jenis Kelamin : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i>
                                                reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartJenisKelamin">
                            <div id="bar-chart-2" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Lokasi Penerimaan : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i>
                                                reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartLokasiPenerimaan">
                            <div id="bar-chart-3" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Residence : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartResidence">
                            <div id="bar-chart-6" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Sertifikasi : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartSertifikasi">
                            <div id="bar-chart-7" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Klasifikasi : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartKlasifikasi">
                            <div id="bar-chart-4" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Pendidikan : <?=date("d-M-Y");?></h5>
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
                                                        class="feather icon-minimize"></i>
                                                    Restore</span></a>
                                        </li>
                                        <li class="dropdown-item minimize-card">
                                            <a href="#!"><span><i class="feather icon-minus"></i>
                                                    collapse</span><span style="display: none"><i
                                                        class="feather icon-plus"></i>
                                                    expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card">
                                            <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mainChart" id="chartPendidikan">
                            <div id="bar-chart-5" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Data Karyawan -->
    <div class="modal fade" id="downloadDataKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document"
            style="margin-left: auto; margin-right: auto;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Download Data Karyawan</h5>
                    <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <form action="<?= base_url("download_karyawan") ?>" method="post" data-parsley-validate>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="jenisData" class="form-label">Jenis Data :</label><br>
                                            <select class="form-control" id="jenisData" name="jenisData" required>
                                                <option value="">-- PILIH JENIS DATA --</option>
                                                <option value="AKTIF">DATA KARYAWAN AKTIF</option>
                                                <option value="NONAKTIF">DATA KARYAWAN NONAKTIF</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group d-none" id="jenisPerusahaan">
                                            <label for="perusahaan" class="form-label">Perusahaan :</label><br>
                                            <select class="form-control" id="perusahaan" name="perusahaan">
                                                <option value="">-- PILIH PERUSAHAAN --</option>
                                                <?= $permst . $perstr; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer p-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Download</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Data Pelanggaran -->
    <div class="modal fade" id="downloadDataPelanggaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document"
            style="margin-left: auto; margin-right: auto;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Download Data Pelanggaran</h5>
                    <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <form action="<?= base_url("download_pelanggaran") ?>" method="post" data-parsley-validate>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="jenisData2" class="form-label">Jenis Data :</label><br>
                                            <select class="form-control" id="jenisData2" name="jenisData" required>
                                                <option value="">-- PILIH JENIS DATA --</option>
                                                <option value="AKTIF">DATA PELANGGARAN AKTIF</option>
                                                <option value="NONAKTIF">DATA PELANGGARAN NONAKTIF</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer p-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Download</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Dashboard Modal -->
    <div class="modal fade" id="filterDashboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Filter Data Dashboard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterData" data-parsley-validate>
                        <div class="form-group">
                            <label class="font-weight-bold form-label" for="perusahaanFilter">Perusahaan
                                <span class="text-danger">*</span></label>
                            <select class="form-control bg-white" name="perusahaanFilter" id="perusahaanFilter" required>
                                <?php if (!empty($perusahaan)) { ?>
                                        <option value="">PILIH PERUSAHAAN</option>
                                        <option value="0" selected>SEMUA PERUSAHAAN(ALL DATA)</option>
                                    <?php foreach ($perusahaan as $data) { ?>
                                        <option value="<?= $data['auth_m_perusahaan'] ?>"><?= $data['nama_perusahaan'] ?></option>
                                    <?php } ?> 
                                <?php } else { ?>
                                    <option value="">Data tidak ditemukan...</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group d-none" id="tipeData">
                            <label class="font-weight-bold form-label" for="tipeFilter">Tipe Data
                                <span class="text-danger">*</span></label>
                            <select class="form-control bg-white" name="tipeFilter" id="tipeFilter">
                                <option value="">PILIH TIPE DATA</option>
                                <option value="0">DATA PERUSAHAAN</option>
                                <option value="1">DENGAN CONTRACTOR</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="tipeData2">
                            <label class="font-weight-bold form-label" for="tipeFilter2">Tipe Data
                                <span class="text-danger">*</span></label>
                            <select class="form-control bg-white" name="tipeFilter2" id="tipeFilter2">
                                <option value="">PILIH TIPE DATA</option>
                                <option value="0">DATA PERUSAHAAN</option>
                                <option value="2">DENGAN SUBCONTRACTOR</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="tahunField">
                            <label class="font-weight-bold form-label" for="tahun">Tahun
                                <span class="text-danger">*</span></label>
                            <select class="form-control bg-white" name="tahun" id="tahun">
                                <option value="">PILIH TAHUN</option>
                                <?php
                                foreach ($year as $list) { ?>
                                    <option value="<?= $list['tahun'] ?>" <?= date("Y") == $list['tahun'] ? 'selected' : '' ?>><?= $list['tahun'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer d-flex justify-content-right m-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>