<!-- Detail -->
<div class="modal fade" id="detailPosisimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Posisi</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailPosisiPerusahaan">Perusahaan :</label><br>
                                <input id='detailPosisiPerusahaan' name='detailPosisiPerusahaan' type="text"
                                    autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailPosisiDepart">Departemen :</label><br>
                                <input id='detailPosisiDepart' name='detailPosisiDepart' type="text" autocomplete="off"
                                    spellcheck="false" class="form-control form-control-user bg-white" value=""
                                    readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-8 col-sm-12">
                                <label for="detailPosisi">Posisi :</label><br>
                                <input id='detailPosisi' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailPosisiKet">Keterangan :</label><br>
                                <textarea id='detailPosisiKet' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailPosisiStatus">Status :</label><br>
                                <input id='detailPosisiStatus' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailPosisiBuat">Pembuat :</label><br>
                                <input id='detailPosisiBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailPosisiTglBuat">Tanggal Buat :</label><br>
                                <input id='detailPosisiTglBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                <button type="button" data-dismiss="modal"
                                    class="btn font-weight-bold btn-danger">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Update/Edit -->
<div class="modal fade" id="editPosisimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Posisi</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="updatePosisi" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger err_psn_edit_posisi animate__animated animate__bounce"
                                style="display:none;"></div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="editPosisiDepart" class="form-label">Departemen :</label><br>
                                        <select id='editPosisiDepart' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" required>
                                            <option value="">-- Departemen tidak ditemukan --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="editPosisi" class="form-label">Posisi :</label><br>
                                        <input id='editPosisi' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="editPosisiStatus" class="form-label">Status :</label><br>
                                        <select id='editPosisiStatus' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="editPosisiKet">Keterangan :</label><br>
                                    <textarea id='editPosisiKet' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value=""></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Update</button>
                                    <button type="button" data-dismiss="modal"
                                        class="btn font-weight-bold btn-danger">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>