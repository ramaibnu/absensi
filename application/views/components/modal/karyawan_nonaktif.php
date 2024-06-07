<div class="modal fade" id="detailnonaktifkary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Nonaktif Karyawan</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <label for="detailNonaktifPerusahaan">Perusahaan :</label><br>
                                <input id='detailNonaktifPerusahaan' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label for="detailNonaktifKTP">No. KTP :</label><br>
                                <input id='detailNonaktifKTP' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <label for="detailNonaktifNama">Nama Lengkap :</label><br>
                                <input id='detailNonaktifNama' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <label for="detailNonaktifDepart">Departemen :</label><br>
                                <input id='detailNonaktifDepart' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailNonaktifPosisi">Posisi :</label><br>
                                <input id='detailNonaktifPosisi' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="detailNonaktifTanggal">Tanggal Nonaktif :</label><br>
                                <input id='detailNonaktifTanggal' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <label for="detailNonaktifAlasan">Alasan Nonaktif :</label><br>
                                <input id='detailNonaktifAlasan' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailNonaktifKet">Keterangan :</label><br>
                                <textarea id='detailNonaktifKet' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailNonaktifBuat">Pembuat :</label><br>
                                <input id='detailNonaktifBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="detailNonaktifTglBuat">Tanggal Buat :</label><br>
                                <input id='detailNonaktifTglBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="modal-footer">
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
<div class="modal fade" id="editNonaktifmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Karyawan Nonaktif</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="updateKaryawanNonaktif" method="POST" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="text" id="authData" value="" hidden>
                                <input type="text" id="authKaryawan" value="" hidden>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label for="updateNonaktifPerusahaan">Perusahaan :</label><br>
                                    <input id='updateNonaktifPerusahaan' type="text" autocomplete="off"
                                        spellcheck="false" class="form-control form-control-user bg-white" value=""
                                        readonly><br>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label for="updateNonaktifKTP">No. KTP :</label><br>
                                    <input id='updateNonaktifKTP' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value="" readonly><br>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <label for="updateNonaktifNama">Nama Lengkap :</label><br>
                                    <input id='updateNonaktifNama' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value="" readonly><br>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <label for="updateNonaktifDepart">Departemen :</label><br>
                                    <input id='updateNonaktifDepart' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value="" readonly><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="updateNonaktifPosisi">Posisi :</label><br>
                                    <input id='updateNonaktifPosisi' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value="" readonly><br>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="updateNonaktifTanggal" class="form-label">Tanggal Nonaktif :</label><br>
                                    <input id='updateNonaktifTanggal' type="date" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value="" required>
                                        </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="updateNonaktifAlasan" class="form-label">Alasan Nonaktif :</label><br>
                                    <select id='updateNonaktifAlasan' class="form-control" required>
                                        <option value="">-- TIDAK ADA DATA --</option>
                                    </select>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="updateNonaktifKet">Keterangan :</label><br>
                                    <textarea id='updateNonaktifKet' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control form-control-user bg-white" value=""></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div>
                                        <h6 class="text-danger font-italic">Catatan : Upload berkas karyawan dalam
                                            format pdf, ukuran berkas maksimal 100 kb.</h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="fileberkasalasan" class="form-label"><b>Upload Berkas</b> <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" accept=".pdf" id="fileberkasalasan">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                                    <button type="button" data-dismiss="modal"
                                        class="btn font-weight-bold btn-danger">Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>