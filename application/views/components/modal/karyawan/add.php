<div class="modal fade" id="mdlinfoklasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:60%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Informasi Klasifikasi</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row p-2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="text-danger font-italic font-weight-bold">Pilih klasifikasi karyawan sesuai dengan
                            keterangan berikut :</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul>
                            <li><b>Manajemen</b> : Board of Director, Manager.</li>
                            <li><b>Profesional</b> : Advisor, Specialist dan lain-lain.</li>
                            <li><b>Teknisi</b> : Superintendent, Supervisor, Head/Chief, Foreman, Maintenance,
                                Technician.</li>
                            <li><b>Administrasi</b> : Accounting, Scretary, HR Staff/Officer dan lain-lain</li>
                            <li><b>Terampil</b> : Operator</li>
                            <li><b>Tidak terampil</b> : Tenaga informal, Pekerja harian lepas dan lain-lain</li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlbuatdatakary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-blue">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-id-card"></i> Verifikasi No.
                    KTP</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="noKTPCek">Ketikkan No. KTP</label>
                            <input id='noKTPCek' name='noKTPCek' autocomplete="off" spellcheck="false"
                                class="noKTPCek form-control bg-white" value="">
                            <small class="errornoKTPCek text-danger font-italic font-weight-bold"></small><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnverifikasiktp" id="btnverifikasiktp"
                    class="btn font-weight-bold btn-primary" disabled>Verifikasi Data</button>
                <button name="btnbatalverktp" id="btnbatalverktp" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlverifkary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-id-card"></i> Verifikasi Data</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                              <div class="form-group">
                                   <h5 id="pesanDet" class="text-danger"></h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -5px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="noKTPDet">No. KTP</label>
                                             <h5 id="noKTPDet"></h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="form-group">
                                             <label for="namaDet">Nama Lengkap</label>
                                             <h5 id="namaDet"></h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="PerusahaanDet">Perusahaan</label>
                                             <h5 id="PerusahaanDet"></h5>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="StatusDet">Status</label>
                                             <h5 id="StatusDet"></h5>
                                        </div>
                                   </div>
                                   <div class="tglnonaktif col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglNonAktifDet">Tanggal NonAktif</label>
                                             <h5 id="tglNonAktifDet"></h5>
                                        </div>
                                   </div>
                                   <div class="lamanonaktif col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="lamaNonAktifDet">Lama NonAKtif</label>
                                             <h5 id="lamaNonAktifDet"></h5>
                                        </div>
                                   </div>
                                   <div class="pelanggaran col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <h5 class="text-center text-danger">Data Pelanggaran/Incident/Accident : </h5>
                                        <table id="tbmViolation" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                             <thead>
                                                  <tr>
                                                       <td style="width:1%;text-align:center;">NO.</td>
                                                       <td style="width:20%;font-style:bold;">HUKUMAN</td>
                                                       <td style="width:79%;font-style:bold;">KETERANGAN</td>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-primary">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlunitsimper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Unit SIMPER</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert errormdlsimper alert-danger animate__animated animate__bounce d-none"
                            role="alert"></div>
                        <div class="row p-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="jenisUnitSimper">Unit :</label><br>
                                <div id="txtjenisUnitSimper" class="input-group">
                                    <select id='jenisUnitSimper' class="form-control form-control-user" required>
                                        <option value="">-- WAJIB DIPILIH --</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <button id="refreshjenisUnitSimper" name="refreshjenisUnitSimper"
                                            class="btn btn-primary btn-sm" disabled><i
                                                class="fas fa-sync-alt"></i></button>
                                    </div>
                                </div>
                                <small
                                    class="errorjenisUnitSimper text-danger font-italic font-weight-bold"></small><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="tipeAksesUnit">Izin Akses Unit :</label><br>
                                <div id="txttipeAksesUnit" class="input-group">
                                    <select id='tipeAksesUnit' class="form-control form-control-user" required>
                                        <option value="">-- WAJIB DIPILIH --</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <button id="refreshtipeAksesUnit" name="refreshtipeAksesUnit"
                                            class="btn btn-primary btn-sm" disabled><i
                                                class="fas fa-sync-alt"></i></button>
                                    </div>
                                </div>
                                <small class="errortipeAksesUnit text-danger font-italic font-weight-bold"></small><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnsimpanunitsimper" id="btnsimpanunitsimper"
                    class="btn font-weight-bold btn-primary">Simpan Data</button>
                <button name="btnbatalunitsimper" id="btnbatalunitsimper" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdleditsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Sertifikat</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert erreditsertifikat alert-danger animate__animated animate__bounce d-none"
                            role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="jenisSertifikasiEdit">Jenis Sertifikasi :</label>
                            <div id="txtjenisSertifikasiEdit" class="input-group">
                                <select id='jenisSertifikasiEdit' name='jenisSertifikasiEdit' autocomplete="off"
                                    spellcheck="false" class="form-control" value="" required>
                                    <option value="">-- WAJIB DIPILIH --</option>
                                </select>
                                <div class="input-group-prepend">
                                    <button id="refreshjenisSertifikasiEdit" name="refreshjenisSertifikasiEdit"
                                        class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                </div>
                            </div>
                            <small class="errorjenisSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                            <span class="7u67u834hs7dg4haj231hh67ju7a2 d-none"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="noSertifikatEdit">No. Sertifikasi :</label>
                            <input id='noSertifikatEdit' name='noSertifikatEdit' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" required>
                            <small class="errorNoSertifikatEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="namaLembagaEdit">Nama Lembaga :</label>
                            <input id='namaLembagaEdit' name='namaLembagaEdit' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" required>
                            <small class="errorNamaLembagaEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiEdit">Tanggal Sertifikasi :</label>
                            <input id='tanggalSertifikasiEdit' name='tanggalSertifikasiEdit' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorTanggalSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="masaBerlakuSertifikatEdit">Masa Berlaku (Tahun) :</label>
                            <select id='masaBerlakuSertifikatEdit' name='masaBerlakuSertifikatEdit' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                <option value="">-- PILIH MASA BERLAKU --</option>
                                <option value="1">1 TAHUN</option>
                                <option value="2">2 TAHUN</option>
                                <option value="3">3 TAHUN</option>
                                <option value="4">4 TAHUN</option>
                                <option value="5">5 TAHUN</option>
                                <option value="6">6 TAHUN</option>
                                <option value="7">7 TAHUN</option>
                                <option value="8">8 TAHUN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiAkhirEdit">Tanggal Expired :</label>
                            <input id='tanggalSertifikasiAkhirEdit' name='tanggalSertifikasiAkhirEdit' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small
                                class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btneditsertifikat" id="btneditsertifikat"
                    class="btn font-weight-bold btn-primary">Update Data</button>
                <button name="btnbatalsertifikat" id="btnbatalsertifikat" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdldetailsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="jdldetailsertifikat">Detail Sertifikat</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert errsertifikatdetail alert-danger animate__animated animate__bounce d-none"
                            role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="jenisSertifikasiDetail">Jenis Sertifikasi :</label>
                            <input id='jenisSertifikasiDetail' name='jenisSertifikasiDetail' autocomplete="off"
                                spellcheck="false" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="noSertifikatDetail">No. Sertifikasi :</label>
                            <input id='noSertifikatDetail' name='noSertifikatDetail' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="namaLembagaDetail">Nama Lembaga :</label>
                            <input id='namaLembagaDetail' name='namaLembagaDetail' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiDetail">Tanggal Sertifikasi :</label>
                            <input id='tanggalSertifikasiDetail' name='tanggalSertifikasiDetail' type="text"
                                autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiAkhirDetail">Tanggal Expired :</label>
                            <input id='tanggalSertifikasiAkhirDetail' name='tanggalSertifikasiAkhirEdit' type="text"
                                autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button name="btnselesaidetailser" id="btnselesaidetailser" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdluploadulangser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="jdluploadulangser">Upload Ulang Sertifikat</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert erruploadulangser alert-danger animate__animated animate__bounce d-none"
                            role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <div>
                            <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf,
                                ukuran file Sertifikat maksimal 300 kb.</h6>
                        </div>
                        <div class="form-group">
                            <label for="fileSertifikasiUlang"><b>Upload file sertifikat</b> :</label>
                            <input type="file" class="form-control-file" id="fileSertifikasiUlang" accept=".pdf">
                            <small class="errorFileSertifikasiUlang text-danger font-italic font-weight-bold"></small>
                            <span class="9f7fjmuj8ik2js4n8k66g3hjl323 d-none"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnuploadulangser" id="btnuploadulangser"
                    class="btn font-weight-bold btn-primary">Upload File</button>
                <button name="btnbataluploadulangser" id="btnbataluploadulangser" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Keluarga -->
<div class="modal fade" id="addKeluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Keluarga</h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0);" id="addDataKeluarga" method="post" data-parsley-validate>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keluargaTipe" class="form-label">Kategori Tipe Keluarga <span
                                                class="text-danger">*</span></label><br>
                                        <select class="form-control form-control-user" id="keluargaTipe" required>
                                            <option value="">-- PILIH KATEGORI --</option>
                                            <option value="0">PASANGAN (ISTRI/SUAMI)</option>
                                            <option value="1">ANAK KE 1</option>
                                            <option value="2">ANAK KE 2</option>
                                            <option value="3">ANAK KE 3</option>
                                            <option value="4">ANAK KE 4</option>
                                            <option value="5">ANAK KE 5</option>
                                            <option value="6">ANAK KE 6</option>
                                            <option value="7">ANAK KE 7</option>
                                            <option value="8">ANAK KE 8</option>
                                            <option value="9">ANAK KE 9</option>
                                            <option value="10">ANAK KE 10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaNIK" class="form-label">Nomor Induk Kependudukan(NIK)</label><br>
                                        <input type="text" class="form-control form-control-user bg-white"
                                            id="keluargaNIK" autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaNama" class="form-label">Nama <span
                                                class="text-danger">*</span></label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="keluargaNama"
                                            autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaNamaIbu" class="form-label">Nama Ibu</label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="keluargaNamaIbu"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaNamaAyah" class="form-label">Nama Ayah</label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="keluargaNamaAyah"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaJenisKelamin" class="form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label><br>
                                        <select class="form-control form-control-user bg-white"
                                            id="keluargaJenisKelamin" required>
                                            <option value="">-- PILIH JENIS KELAMIN --</option>
                                            <option value="L">LAKI-LAKI</option>
                                            <option value="P">PEREMPUAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaTempatLahir" class="form-label">Tempat Lahir <span
                                                class="text-danger">*</span></label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="keluargaTempatLahir"
                                            autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaTanggalLahir" class="form-label">Tanggal Lahir <span
                                                class="text-danger">*</span></label><br>
                                        <input type="date" class="form-control form-control-user bg-white"
                                            id="keluargaTanggalLahir" autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaBPJS" class="form-label">No BPJS</label><br>
                                        <input type="text" class="form-control form-control-user bg-white"
                                            id="keluargaBPJS" autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaStatusBPJS" class="form-label">Status BPJS</label><br>
                                        <select id='keluargaStatusBPJS' type="text" autocomplete="off"
                                            spellcheck="false" class="form-control form-control-user bg-white">
                                            <option value="">-- PILIH STATUS BPJS --</option>
                                            <option value="T">AKTIF</option>
                                            <option value="F">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaELI" class="form-label">No ELI</label><br>
                                        <input type="text" class="form-control form-control-user bg-white"
                                            id="keluargaELI" autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="keluargaHP" class="form-label">No HP</label><br>
                                        <input type="text" class="form-control form-control-user bg-white"
                                            id="keluargaHP" autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer p-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Keluarga -->
<div class="modal fade" id="detailKeluarga" tabindex="-1" role="dialog" aria-labelledby="detailDataKeluarga"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="detailDataKeluarga"></h5>
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
                                    <label for="detailKeluargaNIK" class="form-label">Nomor Induk
                                        Kependudukan(NIK)</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaNIK" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaNama" class="form-label">Nama</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaNama" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaNamaIbu" class="form-label">Nama Ibu</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaNamaIbu" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaNamaAyah" class="form-label">Nama Ayah</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaNamaAyah" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaJenisKelamin" class="form-label">Jenis Kelamin</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaJenisKelamin" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaTempatLahir" class="form-label">Tempat Lahir</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaTempatLahir" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaTanggalLahir" class="form-label">Tanggal Lahir</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaTanggalLahir" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaBPJS" class="form-label">No BPJS</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaBPJS" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaStatusBPJS" class="form-label">Status BPJS</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaStatusBPJS" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaELI" class="form-label">No ELI</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaELI" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="detailKeluargaHP" class="form-label">No HP</label><br>
                                    <input type="text" class="form-control form-control-user bg-white"
                                        id="detailKeluargaHP" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-secondary">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Keluarga -->
<div class="modal fade" id="updateKeluarga" tabindex="-1" role="dialog" aria-labelledby="updateTitleKeluarga"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="updateTitleKeluarga"></h5>
                <button type="button" class="close" title="Tutup" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <form action="javascript:void(0);" id="updateDataKeluarga" method="post" data-parsley-validate>
                    <input type="text" id="updateKeluargaTipe" hidden>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaNIK" class="form-label">Nomor Induk Kependudukan(NIK)</label><br>
                                        <input type="text" class="form-control form-control-user bg-white" id="updateKeluargaNIK"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaNama" class="form-label">Nama <span
                                                class="text-danger">*</span></label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="updateKeluargaNama"
                                            autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaNamaIbu" class="form-label">Nama Ibu</label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="updateKeluargaNamaIbu"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaNamaAyah" class="form-label">Nama Ayah</label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="updateKeluargaNamaAyah"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaJenisKelamin" class="form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label><br>
                                        <select class="form-control form-control-user bg-white" id="updateKeluargaJenisKelamin"
                                            required>
                                            <option value="">-- PILIH JENIS KELAMIN --</option>
                                            <option value="L">LAKI-LAKI</option>
                                            <option value="P">PEREMPUAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaTempatLahir" class="form-label">Tempat Lahir <span
                                                class="text-danger">*</span></label><br>
                                        <input style="text-transform:uppercase" type="text"
                                            class="form-control form-control-user bg-white" id="updateKeluargaTempatLahir"
                                            autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaTanggalLahir" class="form-label">Tanggal Lahir <span
                                                class="text-danger">*</span></label><br>
                                        <input type="date" class="form-control form-control-user bg-white"
                                            id="updateKeluargaTanggalLahir" autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaBPJS" class="form-label">No BPJS</label><br>
                                        <input type="text" class="form-control form-control-user bg-white" id="updateKeluargaBPJS"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaStatusBPJS" class="form-label">Status BPJS</label><br>
                                        <select id='updateKeluargaStatusBPJS' type="text" autocomplete="off" spellcheck="false"
                                            class="form-control form-control-user bg-white">
                                            <option value="">-- PILIH STATUS BPJS --</option>
                                            <option value="T">AKTIF</option>
                                            <option value="F">NONAKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaELI" class="form-label">No ELI</label><br>
                                        <input type="text" class="form-control form-control-user bg-white" id="updateKeluargaELI"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="updateKeluargaHP" class="form-label">No HP</label><br>
                                        <input type="text" class="form-control form-control-user bg-white" id="updateKeluargaHP"
                                            autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer p-3">
                <button type="submit" class="btn font-weight-bold btn-primary">Simpan</button>
                <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>