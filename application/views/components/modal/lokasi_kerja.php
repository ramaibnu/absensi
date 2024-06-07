<!-- Detail -->
<div class="modal fade" id="detailLokkermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Lokasi Kerja</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <label for="detailLokkerKode">Kode :</label><br>
                                <input id='detailLokkerKode' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <label for="detailLokker">Lokasi Kerja :</label><br>
                                <input id='detailLokker' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailLokkerKet">Keterangan :</label><br>
                                <textarea id='detailLokkerKet' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailLokkerStatus">Status :</label><br>
                                <input id='detailLokkerStatus' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailLokkerBuat">Pembuat :</label><br>
                                <input id='detailLokkerBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailLokkerTglBuat">Tanggal Buat :</label><br>
                                <input id='detailLokkerTglBuat' type="text" autocomplete="off" spellcheck="false"
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
<div class="modal fade" id="editLokkermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Lokasi Kerja</h5>
            </div>
            <form action="javascript:void(0)" id="updateLokasiKerja" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div
                                class="alert alert-danger err_psn_edit_lokker animate__animated animate__bounce d-none">
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLokkerKode" class="form-label">Kode</label><br>
                                        <input id='editLokkerKode' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" data-parsley-kode-max-length="8" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLokker" class="form-label">Lokasi Kerja</label><br>
                                        <input id='editLokker' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="editLokkerStatus" class="form-label">Status</label><br>
                                        <select id='editLokkerStatus' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="editLokkerKet">Keterangan :</label><br>
                                    <textarea id='editLokkerKet' type="text" autocomplete="off" spellcheck="false"
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