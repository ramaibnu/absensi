<!-- Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Roster</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="kode">Kode :</label><br>
                                <input id='kode' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="roster">Roster :</label><br>
                                <input id='roster' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="onsite">Jumlah Hari (Onsite) :</label><br>
                                <input id='onsite' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="offsite">Jumlah Hari (Offsite) :</label><br>
                                <input id='offsite' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="keterangan">Keterangan :</label><br>
                                <textarea id='keterangan' type="text" class="form-control form-control-user bg-white"
                                    readonly></textarea><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="status">Status :</label><br>
                                <input id='status' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="user">Pembuat :</label><br>
                                <input id='user' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="tanggal_buat">Tanggal Buat :</label><br>
                                <input id='tanggal_buat' type="text" class="form-control form-control-user bg-white"
                                    readonly><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Update/Edit -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Roster</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="updateData" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateOnsite" class="form-label">Jumlah Minggu (Onsite) <span
                                                class="text-danger">*</span></label><br>
                                        <input id='updateOnsite' type="number" min="1" max="99" step="1"
                                            autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white"
                                            aria-describedby="onsiteAddon" required>
                                        <small id="onsiteAddon" class="form-text text-muted">Isi jumlah berapa minggu
                                            onsite.</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateOffsite" class="form-label">Jumlah Minggu (Offsite) <span
                                                class="text-danger">*</span></label><br>
                                        <input id='updateOffsite' type="number" min="1" max="99" step="1"
                                            autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white"
                                            aria-describedby="offsiteAddon" required>
                                        <small id="offsiteAddon" class="form-text text-muted">Isi jumlah berapa minggu
                                            offsite.</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateStatus" class="form-label">Status Data <span
                                                class="text-danger">*</span></label><br>
                                        <select id='updateStatus' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white" value="" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="updateKeterangan">Keterangan</label><br>
                                    <textarea id='updateKeterangan' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Update</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>