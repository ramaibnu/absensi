<!-- Detail -->
<div class="modal fade" id="detailUsermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail User</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="namaUser" class="form-label">Nama User</label>
                                    <input id='namaUser' type="text" class="form-control form-control-user bg-white"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="emailUser" class="form-label">Email User</label>
                                    <input id='emailUser' type="text" class="form-control form-control-user bg-white"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="perusahaanUser" class="form-label">Perusahaan</label>
                                    <input id='perusahaanUser' type="text"
                                        class="form-control form-control-user bg-white" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="tglAktif" class="form-label">Tanggal Aktif</label>
                                    <input id='tglAktif' type="text" class="form-control form-control-user bg-white"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="tglExpired" class="form-label">Tanggal Expired</label>
                                    <input id='tglExpired' type="text" class="form-control form-control-user bg-white"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="aksesUser" class="form-label">Tipe Akses</label>
                                    <input id='aksesUser' type="text" class="form-control form-control-user bg-white"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top:10px;">
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Update/Edit -->
<div class="modal fade" id="editUsermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="updateUser" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger err_psn_edit_unit animate__animated animate__bounce d-none">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateNamaUser" class="form-label">Nama User <span
                                                class="text-danger">*</span></label>
                                        <input id='updateNamaUser' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateEmailUser" class="form-label">Email User <span
                                                class="text-danger">*</span></label>
                                        <input id='updateEmailUser' type="text" autocomplete="off" spellcheck="false"
                                            data-parsley-valid-email="true" class="form-control form-control-user"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="updatePerusahaanUser" class="form-label">Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <select id='updatePerusahaanUser' autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                            <option value="">-- Pilih Perusahaan --</option>
                                            <?= $permst . $perstr; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateTglAktif" class="form-label">Tanggal Aktif <span
                                                class="text-danger">*</span></label>
                                        <input id='updateTglAktif' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateTglExpired" class="form-label">Tanggal Expired <span
                                                class="text-danger">*</span></label>
                                        <input id='updateTglExpired' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateAksesUser" class="form-label">Akses Menu <span
                                                class="text-danger">*</span></label>
                                        <select id='updateAksesUser' autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" required>
                                            <option value="">-- Pilih Akses Menu --</option>
                                            <?php
                                            if (!empty($data_menu)) {
                                                foreach ($data_menu as $list) {
                                                    echo "<option value='" . $list['auth_menu'] . "'>" . $list['NamaMenu'] . "</option>";
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="modal-footer" style="margin-top:10px;">
                                <button type="submit" class="btn font-weight-bold btn-primary">Update</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn font-weight-bold btn-danger">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Reset Password -->
<div class="modal fade" id="resetPasswordmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Reset Sandi User</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="resetSandi" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="newPassword" class="form-label">Sandi Baru <span
                                                class="text-danger">*</span></label>
                                        <input id='newPassword' type="password"
                                            class="form-control form-control-user bg-white" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="konfirmasiPassword" class="form-label">Konfirmasi Ulang Sandi <span class="text-danger">*</span></label>
                                        <input id='konfirmasiPassword' type="password"
                                            class="form-control form-control-user bg-white"
                                            data-parsley-custom-confirm-password="newPassword" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer mb-3 mt-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Reset</button>
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>