<div class="modal fade" id="mdlDetLanggarAktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i>
                    Data Pelanggaran Aktif</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <label for="perDetLgrAktif">Perusahaan :</label><br>
                        <select id="perDetLgrAktif" name="perDetLgrAktif" class="form-control">
                            <option value="0">-- SEMUA PERUSAHAAN --</option>
                            <?=$permst . $perstr;?>
                        </select><br>
                    </div>

                    <div class="col-lg-12">
                        <div id="tbLanggarAktif" class="data"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end p-2" style="margin-top:10px;">
                <button type="button" id="btnSelesaiDetLanggar" id="btnSelesaiDetLanggar" data-dismiss="modal"
                    class="btn font-weight-bold btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>