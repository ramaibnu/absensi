<!-- Update data -->
<div class="modal fade" id="editBerkasPunishment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:60%;">
        <form action="javascript:void(0)" id="updateFile" method="post" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ganti Berkas Disciplinary Action</h5>
                    <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="alert alert-danger err_psn_edit_berkas animate__animated animate__bounce d-none">
                        </div>
                        <input id='authlanggarberkas' name='authlanggarberkas' type="hidden"
                            value="<?= $langgar['auth_langgar']; ?>">
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <label for="">Perusahaan :</label><br>
                            <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white"
                                value="<?= $langgar['kode_perusahaan'] . " | " . $langgar['nama_perusahaan']; ?>"
                                readonly><br>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="">No. KTP :</label><br>
                            <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white"
                                value="<?= $langgar['no_ktp']; ?>" readonly><br>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="">NIK :</label><br>
                            <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white"
                                value="<?= $langgar['no_nik']; ?>" readonly><br>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="">Nama Karyawan :</label><br>
                            <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white"
                                value="<?= $langgar['nama_lengkap']; ?>" readonly><br>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="berkasPunishEdit" class="form-label"><span
                                        class="text-danger font-weight-bold font-italic">* </span>Berkas
                                    Disciplinary Action :</label>
                                <span class="text-danger font-weight-bold font-italic">(Berkas
                                    dalam
                                    format pdf, ukuran maksimal 300 kb)</span>
                                <input id='berkasPunishEdit' name='berkasPunishEdit' type="file"
                                    class="form-control-file" accept=".pdf" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end p-2" style="margin-top:10px;">
                    <button type="submit" class="btn font-weight-bold btn-primary">Upload Berkas</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>