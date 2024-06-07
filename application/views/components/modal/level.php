<!-- Detail -->
<div class="modal fade" id="detailLevelmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Level</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailLevelPerusahaan">Perusahaan :</label><br>
                                <input id='detailLevelPerusahaan' name='detailLevelPerusahaan' type="text"
                                    autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <label for="detailLevelKode">Kode :</label><br>
                                <input id='detailLevelKode' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <label for="detailLevel">Level :</label><br>
                                <input id='detailLevel' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailLevelKet">Keterangan :</label><br>
                                <textarea id='detailLevelKet' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailLevelStatus">Status :</label><br>
                                <input id='detailLevelStatus' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailLevelBuat">Pembuat :</label><br>
                                <input id='detailLevelBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailLevelTglBuat">Tanggal Buat :</label><br>
                                <input id='detailLevelTglBuat' type="text" autocomplete="off" spellcheck="false"
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
<div class="modal fade" id="editLevelmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Level</h5>
            </div>
            <form action="javascript:void(0)" id="updateLevel" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger err_psn_edit_Level animate__animated animate__bounce d-none">
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLevelKode" class="form-label">Kode</label><br>
                                        <input id='editLevelKode' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" data-parsley-kode-max-length="8" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLevel" class="form-label">Level</label><br>
                                        <input id='editLevel' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLevelStatus" class="form-label">Status</label><br>
                                        <select id='editLevelStatus' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="editLevelKet">Keterangan :</label><br>
                                    <textarea id='editLevelKet' type="text" autocomplete="off" spellcheck="false"
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