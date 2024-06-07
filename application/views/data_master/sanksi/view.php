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
                                <a id="bc1" href="#">
                                    Sanksi
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tabel Sanksi
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
                        <h5>Sanksi</h5>
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
                            <div class="mb-2">
                                <a href="<?= base_url('sanksi'); ?>" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh / Data</a>
                                <a href="<?= base_url('tambah_sanksi'); ?>"
                                    class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="dataSanksi"
                                        class="table table-striped table-bordered table-hover text-black"
                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th>No.</th>
                                                <th>Kode</th>
                                                <th>Sanksi</th>
                                                <th>Status</th>
                                                <th>Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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