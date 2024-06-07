<!-- Detail -->
<div class="modal fade" id="detailTipemdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Golongan</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="detailTipe">Golongan :</label><br>
                        <input id='detailTipe' type="text" autocomplete="off" spellcheck="false"
                            class="form-control form-control-user bg-white" value="" readonly><br>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="detailTipeKet">Keterangan :</label><br>
                        <textarea id='detailTipeKet' type="text" autocomplete="off" spellcheck="false"
                            class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="detailTipeStatus">Status :</label><br>
                        <input id='detailTipeStatus' type="text" autocomplete="off" spellcheck="false"
                            class="form-control form-control-user bg-white" value="" readonly><br>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="detailTipeBuat">Pembuat :</label><br>
                        <input id='detailTipeBuat' type="text" autocomplete="off" spellcheck="false"
                            class="form-control form-control-user bg-white" value="" readonly><br>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="detailTipeTglBuat">Tanggal Buat :</label><br>
                        <input id='detailTipeTglBuat' type="text" autocomplete="off" spellcheck="false"
                            class="form-control form-control-user bg-white" value="" readonly><br>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <hr>
                    </div>
                    <div class="modal-footer" style="margin-top:10px;">
                        <button type="button" data-dismiss="modal"
                            class="btn font-weight-bold btn-danger">Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Update/Edit -->
<div class="modal fade" id="editTipemdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Golongan</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="updateGolongan" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger err_psn_edit_tipe animate__animated animate__bounce d-none">
                            </div>
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="form-group">
                                        <label for="editTipe" class="form-label">Golongan</label><br>
                                        <input id='editTipe' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="editTipeStatus" class="form-label">Status</label><br>
                                        <select id='editTipeStatus' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="editTipeKet">Keterangan :</label><br>
                                    <textarea id='editTipeKet' type="text" autocomplete="off" spellcheck="false"
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