<nav class="pcoded-navbar menu-light position-fixed">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="<?= base_url(); ?>assets/assets/images/user/avatar-2.jpg" alt="User-Profile-Image" />
                    <div class="user-details mt-2">
                        <div id="per-detail">
                            <h5><?= $nama_per; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <input type="text" class="txt_csrfname d-none" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
            <ul class="nav pcoded-inner-navbar mt-3">
                <li class="nav-item pcoded-menu-caption">
                    <label>Home</label>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == 'dashboard_datatables' ? 'active' : '' ?>">
                    <a href="<?= base_url('dashboard_main') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-<?= $this->session->userdata('akses_apps_hcdata') == 'ALL' ? 'globe' : 'tablet' ?>"></i></span><span class="pcoded-mtext"><?= $this->session->userdata('akses_apps_hcdata') == 'ALL' ? 'Dashboard' : 'Beranda' ?></span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Data Master</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link has-ripple"><span class="pcoded-micon"><i class="feather icon-arrow-up-right"></i></span><span class="pcoded-mtext">Shortcut</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?= base_url('tambah_karyawan') ?>">Tambah Karyawan</a></li>
                        <li><a href="javascript:void(0);" id="checkDataKTP">Verifikasi KTP</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'perusahaan' ||
                                                        $this->uri->segment(1) == 'tambah_perusahaan' ||
                                                        $this->uri->segment(1) == 'edit_perusahaan' ||
                                                        $this->uri->segment(1) == 'struktur' ||
                                                        $this->uri->segment(1) == 'tambah_struktur' ? 'active pcoded-trigger' : '' ?>">
                    <a href="javascript:void(0);" class="nav-link has-ripple"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Data
                            Perusahaan</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'perusahaan' ||
                                $this->uri->segment(1) == 'tambah_perusahaan' ||
                                $this->uri->segment(1) == 'edit_perusahaan' ? 'class="active"' : '' ?>><a href="<?= base_url('perusahaan') ?>">Perusahaan</a></li>
                        <li <?= $this->uri->segment(1) == 'struktur' ||
                                $this->uri->segment(1) == 'tambah_struktur' ? 'class="active"' : '' ?>><a href="<?= base_url('struktur') ?>">Struktur Perusahaan</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'tambah_section' ||
                                                        $this->uri->segment(1) == 'tambah_departemen' ||
                                                        $this->uri->segment(1) == 'tambah_posisi' ||
                                                        $this->uri->segment(1) == 'tambah_level' ||
                                                        $this->uri->segment(1) == 'tambah_golongan' ||
                                                        $this->uri->segment(1) == 'tambah_grade' ||
                                                        $this->uri->segment(1) == 'tambah_status_perjanjian' ||
                                                        $this->uri->segment(1) == 'tambah_roster' ||
                                                        $this->uri->segment(1) == 'tambah_bank' ||
                                                        $this->uri->segment(1) == 'tambah_sanksi' ||
                                                        $this->uri->segment(1) == 'tambah_jenis_sertifikasi' ? 'active pcoded-trigger' : '' ?>">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-share-2"></i></span><span class="pcoded-mtext">Data
                            Pekerjaan</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'departemen' ||
                                $this->uri->segment(1) == 'tambah_departemen' ? 'class="active"' : '' ?>><a href="<?= base_url('departemen') ?>">Departemen</a></li>
                        <li <?= $this->uri->segment(1) == 'section' ||
                                $this->uri->segment(1) == 'tambah_section' ? 'class="active"' : '' ?>><a href="<?= base_url('section') ?>">Section</a></li>
                        <li <?= $this->uri->segment(1) == 'posisi' ||
                                $this->uri->segment(1) == 'tambah_posisi' ? 'class="active"' : '' ?>><a href="<?= base_url('posisi') ?>">Posisi</a></li>
                        <li <?= $this->uri->segment(1) == 'level' ||
                                $this->uri->segment(1) == 'tambah_level' ? 'class="active"' : '' ?>><a href="<?= base_url('level') ?>">Level</a></li>
                        <li <?= $this->uri->segment(1) == 'grade' ||
                                $this->uri->segment(1) == 'tambah_grade' ? 'class="active"' : '' ?>><a href="<?= base_url('grade') ?>">Grade</a></li>
                        <li <?= $this->uri->segment(1) == 'golongan' ||
                                $this->uri->segment(1) == 'tambah_golongan' ? 'class="active"' : '' ?>><a href="<?= base_url('golongan') ?>">Golongan</a></li>
                        <li <?= $this->uri->segment(1) == 'status_perjanjian' ||
                                $this->uri->segment(1) == 'tambah_status_perjanjian' ? 'class="active"' : '' ?>><a href="<?= base_url('status_perjanjian') ?>">Status Perjanjian</a></li>
                        <li <?= $this->uri->segment(1) == 'roster' ||
                                $this->uri->segment(1) == 'tambah_roster' ? 'class="active"' : '' ?>><a href="<?= base_url('roster') ?>">Roster</a></li>
                        <li <?= $this->uri->segment(1) == 'bank' ||
                                $this->uri->segment(1) == 'tambah_bank' ? 'class="active"' : '' ?>><a href="<?= base_url('bank') ?>">Bank</a></li>
                        <li <?= $this->uri->segment(1) == 'sanksi' ||
                                $this->uri->segment(1) == 'tambah_sanksi' ? 'class="active"' : '' ?>><a href="<?= base_url('sanksi') ?>">Sanksi</a></li>
                        <li <?= $this->uri->segment(1) == 'jenis_sertifikasi' ||
                                $this->uri->segment(1) == 'tambah_jenis_sertifikasi' ? 'class="active"' : '' ?>><a href="<?= base_url('jenis_sertifikasi') ?>">Jenis Sertifikasi</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'tambah_lokasi_kerja' ||
                                                        $this->uri->segment(1) == 'tambah_lokasi_penerimaan' ||
                                                        $this->uri->segment(1) == 'tambah_poh' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Data
                            Daerah</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'lokasi_kerja' ||
                                $this->uri->segment(1) == 'tambah_lokasi_kerja' ? 'class="active"' : '' ?>><a href="<?= base_url('lokasi_kerja') ?>">Lokasi Kerja</a>
                        </li>
                        <li <?= $this->uri->segment(1) == 'lokasi_penerimaan' ||
                                $this->uri->segment(1) == 'tambah_lokasi_penerimaan' ? 'class="active"' : '' ?>><a href="<?= base_url('lokasi_penerimaan') ?>">Lokasi Penerimaan</a>
                        </li>
                        <li <?= $this->uri->segment(1) == 'poh' ||
                                $this->uri->segment(1) == 'tambah_poh' ? 'class="active"' : '' ?>><a href="<?= base_url('poh') ?>">Point of Hire</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'tambah_sim' ||
                                                        $this->uri->segment(1) == 'tambah_unit' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Data
                            SIMPER</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'sim' ||
                                $this->uri->segment(1) == 'tambah_sim' ? 'class="active"' : '' ?>><a href="<?= base_url('sim') ?>">Jenis SIM Polisi</a></li>
                        <li <?= $this->uri->segment(1) == 'unit' ||
                                $this->uri->segment(1) == 'tambah_unit' ? 'class="active"' : '' ?>><a href="<?= base_url('unit') ?>">Unit</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Data Utama</label>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'karyawan' ||
                                                        $this->uri->segment(1) == 'tambah_karyawan' ||
                                                        $this->uri->segment(1) == 'edit_karyawan' ||
                                                        $this->uri->segment(1) == 'detail_karyawan' ||
                                                        $this->uri->segment(1) == 'nonaktif_karyawan' ||
                                                        $this->uri->segment(1) == 'absensi' ||
                                                        $this->uri->segment(1) == 'tambah_nonaktif_karyawan' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Data
                            Karyawan</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'karyawan' ||
                                $this->uri->segment(1) == 'edit_karyawan' ||
                                $this->uri->segment(1) == 'detail_karyawan' ||
                                $this->uri->segment(1) == 'tambah_karyawan' ? 'class="active"' : '' ?>><a href="<?= base_url('karyawan') ?>">Karyawan</a></li>
                        <li <?= $this->uri->segment(1) == 'viewkaryawan' ? 'class="active"' : '' ?>><a href="<?= base_url('viewkaryawan') ?>">Karyawan View</a></li>
                        <li <?= $this->uri->segment(1) == 'nonaktif_karyawan' ||
                                $this->uri->segment(1) == 'tambah_nonaktif_karyawan' ? 'class="active"' : '' ?>><a href="<?= base_url('nonaktif_karyawan') ?>">Non-Aktif
                                Karyawan</a></li>
                        <li <?= $this->uri->segment(1) == 'absensi' ? 'class="active"' : '' ?>><a href="<?= base_url('absensi') ?>">Absensi
                                Karyawan</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?=
                                                    $this->uri->segment(1) == 'set_plan' ||
                                                        $this->uri->segment(1) == 'plan' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-calendar"></i></span><span class="pcoded-mtext">Kalender Roster</span></a>
                    <ul class="pcoded-submenu">
                        <li <?=
                            $this->uri->segment(1) == 'plan' ? 'class="active"' : '' ?>><a href="<?= base_url('plan') ?>">Data Plan Kehadiran</a></li>
                        <li <?=
                            $this->uri->segment(1) == 'set_plan' ? 'class="active"' : '' ?>><a href="<?= base_url('set_plan') ?>">Setting Plan Kehadiran</a></li>
                        <li <?=
                            $this->uri->segment(1) == 'pengajuan' ? 'class="active"' : '' ?>><a href="<?= base_url('pengajuan') ?>">Data Pengajuan</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'pelanggaran' ||
                                                        $this->uri->segment(1) == 'tambah_pelanggaran' ||
                                                        $this->uri->segment(1) == 'detail_pelanggaran' ||
                                                        $this->uri->segment(1) == 'update_pelanggaran' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-alert-triangle"></i></span><span class="pcoded-mtext">Data
                            Pelanggaran</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'pelanggaran' ||
                                $this->uri->segment(1) == 'tambah_pelanggaran' ||
                                $this->uri->segment(1) == 'detail_pelanggaran' ||
                                $this->uri->segment(1) == 'update_pelanggaran' ? 'class="active"' : '' ?>><a href="<?= base_url('pelanggaran') ?>">Pelanggaran</a></li>
                    </ul>
                </li>
                <?php
                if ($this->session->userdata('nama_hcdata') == 'Ihfan Noifara' || $this->session->userdata('nama_hcdata') == 'Normandia Akbar' || $this->session->userdata('nama_hcdata') == 'Kresna Vespri Wijaya') { ?>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Authority</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu <?= $this->uri->segment(1) == 'users' ||
                                                            $this->uri->segment(1) == 'tambah_user' ? 'active pcoded-trigger' : '' ?>"><a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Sistem</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="javascript:void(0)">Audit</a></li>
                            <li><a href="javascript:void(0)">Akses Menu</a></li>
                            <li><a href="<?= base_url('users'); ?>">User</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Verifikasi/Check KTP -->
<div class="modal fade" id="verifikasiKTP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-id-card"></i> Verifikasi No.
                    KTP</h5>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="checkingKTP">Ketikkan No. KTP</label>
                            <input id='checkingKTP' name='checkingKTP' autocomplete="off" spellcheck="false" class="checkingKTP form-control bg-white" value="">
                            <small class="errornoKTPCek text-danger font-italic font-weight-bold"></small><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" id="verifDataKTP" class="btn font-weight-bold btn-primary" disabled>Verifikasi
                    Data</button>
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- Detail KTP -->
<div class="modal fade" id="detailVerificationKTP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-id-card"></i> Verifikasi Data
                </h5>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <div class="form-group">
                            <h5 id="dataPesan" class="text-danger"></h5>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -5px;">
                        <hr>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dataKTP">No. KTP</label>
                                    <h5 id="dataKTP"></h5>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="dataNama">Nama Lengkap</label>
                                    <h5 id="dataNama"></h5>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="dataPerusahaan">Perusahaan</label>
                                    <h5 id="dataPerusahaan"></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dataStatus">Status</label>
                                    <h5 id="dataStatus"></h5>
                                </div>
                            </div>
                            <div class="tglnonaktifSidebar col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dataTanggalNonAktif">Tanggal NonAktif</label>
                                    <h5 id="dataTanggalNonAktif"></h5>
                                </div>
                            </div>
                            <div class="lamanonaktifSidebar col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dataLamaNonaktif">Lama NonAKtif</label>
                                    <h5 id="dataLamaNonaktif"></h5>
                                </div>
                            </div>
                            <div class="pelanggaranSidebar col-lg-12 col-md-12 col-sm-12">
                                <hr>
                                <h5 class="text-center text-danger">Data Pelanggaran/Incident/Accident : </h5>
                                <table id="tbmViolation" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                    <thead>
                                        <tr>
                                            <td style="width:1%;text-align:center;">NO.</td>
                                            <td style="width:20%;font-style:bold;">HUKUMAN</td>
                                            <td style="width:79%;font-style:bold;">KETERANGAN</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>