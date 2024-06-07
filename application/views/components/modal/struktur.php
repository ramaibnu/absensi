<!-- View -->
<div class="modal fade" id="mdlDetailStrPer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-asterisk"></i><span
                        id="jdlDetailStrPer"> DETAIL STRUKTUR PERUSAHAAN</span></h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert alert-danger errormsgdetper animate__animated animate__bounce d-none mb-3">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="kodeMperusahaan">Perusahaan Utama :</label>
                            <h5 id="mainCon">Perusahaan Utama</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="kodeMperusahaan">Perusahaan Subcontractor :</label>
                            <h5 id="subCon">Perusahaan Subcontractor</h5>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                        <hr>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="" class="text-danger font-italic font-weight-bold">Rencana Keselamatan, Kesehatan
                            Kerja dan Lingkungan (RK3L) :</label>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="NoRK3L">RK3L :</label>
                                    <h5 id="noRK3L">-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <hr>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="" class="text-danger font-italic font-weight-bold">Izin Usaha Jasa Pertambangan
                            (IUJP) :</label>
                        <div id="tblIUJPDetail" class="data"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 border-right">
                        <label for="" class="text-danger font-italic font-weight-bold">Surat Izin Operasional (SIO)
                            :</label>
                        <div id="tblSIODetail" class="data"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="" class="text-danger font-italic font-weight-bold">Kontrak :</label>
                        <div id="tblKontrakDetail" class="data"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="" class="text-danger font-italic font-weight-bold">Penanggung Jawab Operasional
                            (PJO) :</label>
                        <div id="tblPJODetail" class="data"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="statStr">Status Perusahaan :</label>
                                    <h5 id="statStr">-</h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="tglBuat">Tgl. Dibuat :</label>
                                    <h5 id="tglBuat">-</h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="tglBuat">Tgl. Diedit :</label>
                                    <h5 id="tglEdit">-</h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="namaBuat">Pembuat :</label>
                                    <h5 id="namaBuat">-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUploadRK3L" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Upload Rencana Keselamatan, Kesehatan Kerja
                    dan Lingkungan (RK3L) </h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="updateRK3L" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert alert-danger errormsgRK3L animate__animated animate__bounce d-none mb-3">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConRK3L">Perusahaan Utama :</label>
                                <h5 id="mainConRK3L">Perusahaan Utama</h5>
                                <span class="7c7dj3hn7k2j7n8j3g7j34 d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subConRK3L">Perusahaan Subcontractor :</label>
                                <h5 id="subConRK3L">Perusahaan Subcontractor</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div>
                                <h6 class="text-danger font-italic">Catatan : Upload RK3L dalam format pdf, Ukuran
                                    maksimal
                                    600 kb.</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="uploadRK3L" class="form-label">Upload RK3L :</label>
                                        <input type="file" class="form-control" id="uploadRK3L" name="uploadRK3L" accept=".pdf"
                                            value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Upload</button>
                    <button type="button" name="btnCancelRK3L" id="btnCancelRK3L" data-dismiss="modal"
                        class="btn font-weight-bold btn-success">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUploadIUJP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Upload Izin Usaha Jasa Pertambangan (IUJP)
                </h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="updateIUJP" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert alert-danger errormsgIUJP animate__animated animate__bounce d-none mb-3">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConIUJP">Perusahaan Utama :</label>
                                <h5 id="mainConIUJP">Perusahaan Utama</h5>
                                <span class="7k23n78j23b7l34c77s4f5h7 d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subConIUJP">Perusahaan Subcontractor :</label>
                                <h5 id="subConIUJP">Perusahaan Subcontractor</h5>
                                <small class="errsubcon text-danger font-italic font-weight-bold"></small><br>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div
                                        class="alert alert-danger errormsgiujp animate__animated animate__bounce d-none mb-3">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="NoIUJP" class="form-label">No. IUJP :</label>
                                        <input type="text" class="form-control" id="noIUJPnew" name="noIUJPnew" value=""
                                            required>
                                    </div>
                                    <small class="errnoIUJP text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglIUJPnew" class="form-label">Tgl. Aktif :</label>
                                        <input type="date" class="form-control" id="tglIUJPnew" name="tglIUJPnew"
                                            value="" required>
                                    </div>
                                    <small class="errtglIUJP text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglAkhirIUJPnew" class="form-label">Tgl. Berakhir :</label>
                                        <input type="date" class="form-control" id="tglAkhirIUJPnew"
                                            name="tglAkhirIUJPnew" value="" required>
                                    </div>
                                    <small class="errtglAkhirIUJP text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="ketIUJP">Keterangan :</label>
                                        <textarea id='ketIUJP' name='ketIUJP' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user"
                                            value=""></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div>
                                        <h6 class="text-danger font-italic">Catatan : Upload IUJP dalam format pdf,
                                            Ukuran
                                            maksimal 100 kb.</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="uploadIUJP" class="form-label">Upload IUJP :</label>
                                                <input type="file" class="form-control" id="uploadIUJP" accept=".pdf"
                                                    name="uploadIUJP" value="" required>
                                            </div>
                                            <small
                                                class="erruploadIUJP text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Upload</button>
                <button type="button" name="btnCancelIUJP" id="btnCancelIUJP" data-dismiss="modal"
                    class="btn font-weight-bold btn-success">Selesai</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUploadSIO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Upload Surat Izin Operasional (SIO)</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="updateSIO" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert alert-danger errormsgSIO animate__animated animate__bounce d-none mb-3">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConSIO">Perusahaan Utama :</label>
                                <h5 id="mainConSIO">Perusahaan Utama</h5>
                                <span class="9k7j8h5g4h9j0k2g3b5g3g d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subConSIO">Perusahaan Subcontractor :</label>
                                <h5 id="subConSIO">Perusahaan Subcontractor</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div
                                        class="alert alert-danger errormsgsio animate__animated animate__bounce d-none mb-3">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="NoSIO" class="form-label">No. SIO :</label>
                                        <input type="text" class="form-control" id="noSionew" name="noSionew" value=""
                                            required>
                                    </div>
                                    <small class="errnosionew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglSIO" class="form-label">Tgl. Aktif :</label>
                                        <input type="date" class="form-control" id="tglAktifSIO" name="tglAktifSIO"
                                            value="" required>
                                    </div>
                                    <small
                                        class="errtglawalsionew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglSIO" class="form-label">Tgl. Berakhir :</label>
                                        <input type="date" class="form-control" id="tglAkhirSIO" name="tglAkhirSIO"
                                            value="" required>
                                    </div>
                                    <small
                                        class="errtglakhirsionew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="ketSIO">Keterangan :</label>
                                        <textarea id='ketSIO' name='ketSIO' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user"
                                            value=""></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div>
                                        <h6 class="text-danger font-italic">Catatan : Upload SIO dalam format pdf,
                                            Ukuran
                                            maksimal 100 kb.</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="uploadSIO" class="form-label">Upload SIO :</label>
                                                <input type="file" class="form-control" id="uploadSIO" name="uploadSIO" accept=".pdf"
                                                    value="" required>
                                            </div>
                                            <small
                                                class="erruploadsionew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Upload Data</button>
                <button type="button" name="btnCancelSIO" id="btnCancelSIO" data-dismiss="modal"
                    class="btn font-weight-bold btn-success">Selesai</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUploadKontrak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Upload Kontrak</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="updateKontrak" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div
                                class="alert alert-danger errormsgKontrak animate__animated animate__bounce d-none mb-3">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConKontrak">Perusahaan Utama :</label>
                                <h5 id="mainConKontrak">Perusahaan Utama</h5>
                                <span class="2e3r4t5y6u7i8o0o9i8u7y6t d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subConKontrak">Perusahaan Subcontractor :</label>
                                <h5 id="subConKontrak">Perusahaan Subcontractor</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div
                                        class="alert alert-danger errormsgkontrak animate__animated animate__bounce d-none mb-3">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="NoKontrak" class="form-label">No. Kontrak :</label>
                                        <input type="text" class="form-control" id="noKontraknew" name="noKontraknew"
                                            value="" required>
                                    </div>
                                    <small class="errnokontraknew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglKontrak" class="form-label">Tgl. Aktif :</label>
                                        <input type="date" class="form-control" id="tglAktifKontrak"
                                            name="tglAktifKontrak" value="" required>
                                    </div>
                                    <small
                                        class="errtglkontraknew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tglKontrak" class="form-label">Tgl. Berakhir :</label>
                                        <input type="date" class="form-control" id="tglAkhirKontrak"
                                            name="tglAkhirKontrak" value="" required>
                                    </div>
                                    <small
                                        class="errtglakhirkontraknew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="ketKontrak">Keterangan :</label>
                                        <textarea id='ketKontrak' name='ketKontrak' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user"
                                            value=""></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div>
                                        <h6 class="text-danger font-italic">Catatan : Upload Kontrak dalam format pdf,
                                            Ukuran maksimal 100 kb.</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="uploadKontrak" class="form-label">Upload Kontrak :</label>
                                                <input type="file" class="form-control" id="uploadKontrak" accept=".pdf"
                                                    name="uploadKontrak" value="" required>
                                            </div>
                                            <small
                                                class="erruploadkontraknew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Upload</button>
                <button type="button" name="btnCancelKontrak" id="btnCancelKontrak" data-dismiss="modal"
                    class="btn font-weight-bold btn-success">Selesai</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUploadPJO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Penanggung Jawab Operasional (PJO)</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0)" id="updatePJO" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConPJO">Perusahaan Utama :</label>
                                <h5 id="mainConPJO">Perusahaan Utama</h5>
                                <span class="2d3f4g5h6j7k8j6b4vec5v d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subConPJO">Perusahaan Subcontractor :</label>
                                <h5 id="subConPJO">Perusahaan Subcontractor</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div
                                        class="alert alert-danger errormsgpjo animate__animated animate__bounce d-none mb-3">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="nopjonew" class="form-label">No. Pengesahan :</label>
                                        <input id='nopjonew' name='nopjonew' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user" value="" required>
                                    </div>
                                    <small class="errnopjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="tglakhifpjonew" class="form-label">Tanggal Aktif :</label>
                                        <input id='tglakhifpjonew' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" value="" required>
                                    </div>
                                    <small
                                        class="errtglaktifpjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="tglakhirpjonew" class="form-label">Tanggal Berakhir :</label>
                                        <input id='tglakhirpjonew' type="date" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user" value="" required>
                                    </div>
                                    <small
                                        class="errtglakhirpjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="lokkerpjonew" class="form-label">Lokasi Kerja :</label>
                                        <select id='lokkerpjonew' name='lokkerpjonew' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user" value="" required>
                                            <option value="">-- PILIH LOKASI KERJA --</option>
                                        </select>
                                    </div>
                                    <small class="errlokkerpjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-3">
                                    <label for="caripjonew">Cari Data PJO :</label>
                                    <div class="input-group">
                                        <input id='caripjonew' name='caripjonew' type="text"
                                            placeholder="Ketikkan No. KTP / NIK / Nama Karyawan" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user" value=""><br>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="ktppjonew" class="form-label">No. KTP :</label>
                                        <input id='ktppjonew' name='ktppjonew' type="number" autocomplete="off"
                                            data-parsley-ktp="16" spellcheck="false"
                                            class="form-control form-control-user" value="" required>
                                    </div>
                                    <small class="errktppjonew text-danger font-italic font-weight-bold"></small>
                                    <span class="ccv445bb66n7uj8ikmhg23fsdf d-none"></span><br>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="nikpjonew" class="form-label">NIK :</label>
                                        <input id='nikpjonew' name='nikpjonew' type="number" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user" value="" required>
                                    </div>
                                    <small class="errnikpjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="namapjonew" class="form-label">Nama Lengkap:</label>
                                        <input id='namapjonew' name='namapjonew' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user" value="" required>
                                    </div>
                                    <small class="errnamapjonew text-danger font-italic font-weight-bold"></small><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3" style="margin-top:-5px;">
                                    <a href="#!" id="btnResetKaryNew"
                                        class="btn btn-success font-weight-bold mt-3">Reset
                                        Karyawan</a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <label for="ketpjonew">Keterangan :</label>
                                    <textarea id='ketpjonew' name='ketpjonew' type="text" autocomplete="off"
                                        spellcheck="false" class="form-control form-control-user"
                                        value=""></textarea><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
                                    <div>
                                        <h6 class="text-danger font-italic">Catatan : Upload file pengesahan PJO dalam
                                            format pdf, Ukuran maksimal 100 kb.</h6>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filepjonew" class="form-label">
                                            <b>Upload Pengesahan PJO</b> :
                                        </label>
                                        <input type="file" class="form-control-file" name="filepjonew" id="filepjonew" accept=".pdf"
                                            required>
                                    </div>
                                    <small class="errfilepjonew text-danger font-italic font-weight-bold"></small>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Upload</button>
                <button type="button" name="btnCancelPJO" id="btnCancelPJO" data-dismiss="modal"
                    class="btn font-weight-bold btn-success">Selesai</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlEditStrPer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-project-diagram"></i><span
                        id="jdlEditStrPer">Edit Struktur Perusahaan</span></h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="updateStruktur" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div
                                class="alert alert-danger errormsgStrPerEdit animate__animated animate__bounce d-none mb-3">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mainConStrPerEdit">Perusahaan Utama :</label>
                                <h5 id="mainConStrPerEdit">Perusahaan Utama</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="namaPerEdit" class="form-label">Nama Perusahaan Subcontractor :</label>
                                <input type="text" class="form-control" id="namaPerEdit" name="namaPerEdit" value=""
                                    required>
                                <span class="7uik4gsdm89okl23s6j4h3c d-none"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" name="btnCancelStrPerEdit" id="btnCancelStrPerEdit" data-dismiss="modal"
                        class="btn font-weight-bold btn-success">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="mdlstrperusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:60%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel">Struktur Perusahaan Baru</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="addStruktur" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <div class="alert alert-danger errormsgper animate__animated animate__bounce d-none mb-3">
                            </div>
                            <h6 class="font-italic">Pilih Perusahaan Utama<span class="text-danger">*</span></h6>
                            <select id='perJenis' name='perJenis' class="form-control form-control-user">
                                <option value="">-- PERUSAHAAN UTAMA --</option>
                                <?= $permst . $perstr; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cariMPerusahaan">Cari Perusahaan Subcontractor :</label>
                                <input id='cariMPerusahaan' name='cariMPerusahaan' type="text"
                                    placeholder="Ketikkan Kode Perusahaan / Nama Perusahaan" autocomplete="off"
                                    spellcheck="false" class="form-control form-control-user bg-white" value="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                            <h5>Perusahaan Subcontractor :</h5>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="kodeMperusahaan">Kode Perusahaan <span class="text-danger">*</span> </label>
                                <input id='kodeMperusahaan' name='kodeMperusahaan' type="text" autocomplete="off"
                                    spellcheck="false" class="form-control form-control-user bg-white" value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="namaMperusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input id='namaMperusahaan' name='namaMperusahaan' type="text" autocomplete="off"
                                    spellcheck="false" class="form-control form-control-user bg-white" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>