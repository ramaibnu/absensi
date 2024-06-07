$(document).ready(function () {
  $.LoadingOverlay("show");
  // Default Variable
  let auth_per_old = "";

  // Inputmask
  $("#noKTPCek").inputmask("9999999999999999", { placeholder: "" });
  $("#noKTP").inputmask("9999999999999999", { placeholder: "" });
  $("#noKK").inputmask("9999999999999999", { placeholder: "" });
  $("#noNPWP").inputmask("99.999.999.9-999.999");
  $("#keluargaNIK").inputmask("9999999999999999", { placeholder: "" });
  $("#updateKeluargaNIK").inputmask("9999999999999999", { placeholder: "" });

  // Load Data
  $("#idizintambang").load(site_url + "Karyawan_api/izin_tambang?auth_izin=0");
  $("#idsertifikat").load(site_url + "Karyawan_api/sertifikasi?auth_person=0");
  $("#idvaksin").load(site_url + "Karyawan_api/vaksin?auth_person=" + 0);

  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Bank_api/options",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#bank").html(data.options);
      } else {
        $("#bank").html(data.options);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data bank, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataAgama",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addagama").html(data.agama);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data agama, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataStatusNikah",
    success: function (response) {
      var data = JSON.parse(response);
      $("#statPernikahan").html(data.statnikah);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status pernikahan, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisMCU",
    success: function (response) {
      var data = JSON.parse(response);
      $("#hasilMCU").html(data.jmcu);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataUnitSimper",
    success: function (response) {
      var data = JSON.parse(response);
      $("#jenisUnitSimper").html(data.unit);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimper").removeClass("d-none");
      $(".errormdlsimper").removeClass("alert-info");
      $(".errormdlsimper").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimper").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimper").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisVaksin",
    success: function (response) {
      var data = JSON.parse(response);
      $("#jenisVaksin").html(data.jvks);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data jenis vaksin, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataNamaVaksin",
    success: function (response) {
      var data = JSON.parse(response);
      $("#namaVaksin").html(data.nvks);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data nama vaksin, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataTipeAkses",
    success: function (response) {
      var data = JSON.parse(response);
      $("#tipeAksesUnit").html(data.akses);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimper").removeClass("d-none");
      $(".errormdlsimper").removeClass("alert-info");
      $(".errormdlsimper").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimper").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimper").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPendidikan",
    success: function (response) {
      var data = JSON.parse(response);
      $("#pendidikanTerakhir").html(data.pdk);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataResident",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addStatusResidence").html(data.tgl);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status tinggal, hubungi administrator"
        );
        $("#editSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataKlasifikasi",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addKlasifikasiKary").html(data.kls);
      $("#addKlasifikasiKary").select2({
        theme: "bootstrap4",
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisSIM",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addJenisSIM").html(data.siim);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data SIM, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPOH",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addPOHKary").html(data.poh);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data POH, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataLokasiKerja",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addLokasiKerja").html(data.lkr);
      $("#addLokasiKerja").select2({
        theme: "bootstrap4",
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataStatusPerjanjian",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addStatusKaryawan").html(data.janji);
      $("#addStatusKaryawan").select2({
        theme: "bootstrap4",
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status karyawan, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataGolongan",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addTipeKaryawan").html(data.tipe);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data tipe karyawan, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisSertifikasi",
    success: function (response) {
      var data = JSON.parse(response);
      $("#jenisSertifikasi").html(data.srt);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
        );
        $("#addSimpanSertifikasi").remove();
        $("#addResetSertifikasi").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisSertifikasi",
    success: function (response) {
      var data = JSON.parse(response);
      $("#jenisSertifikasiEdit").html(data.srt);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
        );
        $("#addSimpanSertifikasi").remove();
        $("#addResetSertifikasi").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataLokasiPenerimaan",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addLokterimaKary").html(data.lkt);
    },
    error: function () {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").removeClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPaybase",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addPaybase").html(data.options);
      $("#addPaybase").select2({
        theme: "bootstrap4",
      });
    },
    error: function () {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").removeClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data paybase, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPajak",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addPajak").html(data.options);
      $("#addPajak").select2({
        theme: "bootstrap4",
      });
    },
    error: function () {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").removeClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status pajak, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  // Functions
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
  }

  function formatIndonesianDate(timestamp) {
    var monthNames = [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember",
    ];

    var date = new Date(timestamp);
    var day = date.getDate();
    var month = monthNames[date.getMonth()];
    var year = date.getFullYear();

    var formattedDate = day + " " + month + " " + year;

    return formattedDate;
  }

  function aktifPersonalNoKTP() {
    $("#namaLengkap").removeAttr("disabled");
    $("#alamatKTP").removeAttr("disabled");
    $("#rtKTP").removeAttr("disabled");
    $("#rwKTP").removeAttr("disabled");
    $("#provData").removeAttr("disabled");
    $("#kotaData").removeAttr("disabled");
    $("#kecData").removeAttr("disabled");
    $("#kelData").removeAttr("disabled");
    $("#tempatLahir").removeAttr("disabled");
    $("#tanggalLahir").removeAttr("disabled");
    $("#statPernikahan").removeAttr("disabled");
    $("#addagama").removeAttr("disabled");
    $("#kewarganegaraan").removeAttr("disabled");
    $("#jenisKelamin").removeAttr("disabled");
    $("#email").removeAttr("disabled");
    $("#noTelp").removeAttr("disabled");
    $("#noBPJSTK").removeAttr("disabled");
    $("#noBPJSKES").removeAttr("disabled");
    $("#noKK").removeAttr("disabled");
    $("#namaIbu").removeAttr("disabled");
    $("#noNPWP").removeAttr("disabled");
    $("#pendidikanTerakhir").removeAttr("disabled");
    $("#sekolah").removeAttr("disabled");
    $("#fakultas").removeAttr("disabled");
    $("#jurusan").removeAttr("disabled");
    $("#pasfoto").removeAttr("disabled");
    $("#refreshProv").removeAttr("disabled");
    $("#refreshKota").removeAttr("disabled");
    $("#refreshKec").removeAttr("disabled");
    $("#refreshKel").removeAttr("disabled");
    $("#refreshStatNikah").removeAttr("disabled");
    $("#refreshDidik").removeAttr("disabled");
    $("#addSimpanPersonal").removeClass("disabled");
  }

  function aktifKaryawan() {
    $("#addPerKary").removeAttr("disabled");
    $("#addNIKKary").removeAttr("disabled");
    $("#addDepartKary").removeAttr("disabled");
    $("#addSectionKary").removeAttr("disabled");
    $("#addPosisiKary").removeAttr("disabled");
    $("#addDOH").removeAttr("disabled");
    $("#addTanggalAktif").removeAttr("disabled");
    $("#addLokasiKerja").removeAttr("disabled");
    $("#addLokterimaKary").removeAttr("disabled");
    $("#addPOHKary").removeAttr("disabled");
    $("#addKlasifikasiKary").removeAttr("disabled");
    $("#addJenisKaryawan").removeAttr("disabled");
    $("#addLevelKary").removeAttr("disabled");
    $("#addGrade").removeAttr("disabled");
    $("#addRoster").removeAttr("disabled");
    $("#addStatusResidence").removeAttr("disabled");
    $("#addStatusKaryawan").removeAttr("disabled");
    $("#addTipeKaryawan").removeAttr("disabled");
    $("#addEmailKantor").removeAttr("disabled");
    $("#addPaybase").removeAttr("disabled");
    $("#addPajak").removeAttr("disabled");
    $("#addTanggalPermanen").removeAttr("disabled");
    $("#addTanggalKontrakAwal").removeAttr("disabled");
    $("#addTanggalKontrakAkhir").removeAttr("disabled");
    $("#refreshDepart").removeAttr("disabled");
    $("#refreshPosisi").removeAttr("disabled");
    $("#refreshKlasifikasi").removeAttr("disabled");
    $("#refreshTipe").removeAttr("disabled");
    $("#refreshLevel").removeAttr("disabled");
    $("#refreshGrade").removeAttr("disabled");
    $("#refreshRoster").removeAttr("disabled");
    $("#refreshPOH").removeAttr("disabled");
    $("#refreshLokterima").removeAttr("disabled");
    $("#refreshLokker").removeAttr("disabled");
    $("#refreshResidence").removeAttr("disabled");
    $("#refreshPaybase").removeAttr("disabled");
    $("#refreshPajak").removeAttr("disabled");
    $("#refreshstatkaryawan").removeAttr("disabled");
    $("#infoKlasifikasi").removeAttr("disabled");
    $("#addKembaliPekerjaan").removeClass("disabled");
    $("#addSimpanPekerjaan").removeClass("disabled");
  }

  function aktifAdditional() {
    $("#namaIbu").removeAttr("disabled");
    $("#statusIbu").removeAttr("disabled");
    $("#namaAyah").removeAttr("disabled");
    $("#statusAyah").removeAttr("disabled");
    $("#bank").removeAttr("disabled");
    $("#pemilik").removeAttr("disabled");
    $("#rekening").removeAttr("disabled");
    $("#keterangan").removeAttr("disabled");
    $("#nama_ec").removeAttr("disabled");
    $("#relasi_ec").removeAttr("disabled");
    $("#hp_ec").removeAttr("disabled");
    $("#hp_ec_2").removeAttr("disabled");
    $("#ket_ec").removeAttr("disabled");
    $("#refreshBank").removeAttr("disabled");
    $("#addbtnkembaliAdditional").removeClass("disabled");
    $("#buttonAdditionalData").removeClass("disabled");
  }

  function aktifSIMPER() {
    $("#addJenisIzin").removeAttr("disabled");
    $("#addNoReg").removeAttr("disabled");
    $("#addTglExp").removeAttr("disabled");
    $("#addJenisSIM").removeAttr("disabled");
    $("#addTglExpSIM").removeAttr("disabled");
    $("#refreshJenisSIM").removeAttr("disabled");
    $("#addKembaliIzinUnit").removeClass("disabled");
    $("#addSimpanIzinUnit").removeClass("disabled");
    $("#filesimpolisi").removeAttr("disabled");
    $("#btnshowsimpol").removeClass("disabled");
    $("#simpermp").removeAttr("disabled");
    $("#btnshowsimper").removeClass("disabled");
  }

  function aktifSertifikat() {
    $("#jenisSertifikasi").removeAttr("disabled");
    $("#noSertifikat").removeAttr("disabled");
    $("#namaLembaga").removeAttr("disabled");
    $("#tanggalSertifikasi").removeAttr("disabled");
    $("#masaBerlakuSertifikat").removeAttr("disabled");
    $("#tanggalSertifikasiAkhir").removeAttr("disabled");
    $("#refreshJenisSertifikat").removeAttr("disabled");
    $("#fileSertifikasi").removeAttr("disabled");
    $("#addSimpanSertifikasi").removeClass("disabled");
    $("#addResetSertifikasi").removeClass("disabled");
    $("#addbtnkembaliSertifikat").removeClass("disabled");
    $("#addLanjutSertifikasi").removeClass("disabled");
  }

  function aktifMCU() {
    $("#tglMCU").removeAttr("disabled");
    $("#hasilMCU").removeAttr("disabled");
    $("#ketMCU").removeAttr("disabled");
    $("#refreshhasilMCU").removeAttr("disabled");
    $("#fileMCU").removeAttr("disabled");
    $("#addbtnkembaliMCU").removeClass("disabled");
    $("#addSimpanMCU").removeClass("disabled");
    $("#addLanjutMCU").removeClass("disabled");
  }

  function aktifVaksin() {
    $("#jenisVaksin").removeAttr("disabled");
    $("#namaVaksin").removeAttr("disabled");
    $("#tanggalVaksin").removeAttr("disabled");
    $("#fileMCU").removeAttr("disabled");
    $("#refreshjenisVaksin").removeAttr("disabled");
    $("#refreshnamaVaksin").removeAttr("disabled");
    $("#addSimpanVaksin").removeClass("disabled");
    $("#addResetVaksin").removeClass("disabled");
    $("#addbtnkembalivaksin").removeClass("disabled");
    $("#addLanjutkanVaksin").removeClass("disabled");
  }

  function aktifFilePendukung() {
    $("#filePasFoto").removeAttr("disabled");
    $("#filePendukung").removeAttr("disabled");
    $("#addbtnkembaliFile").removeClass("disabled");
    $("#addUploadFileSelesai").removeClass("disabled");
    $("#addUploadFilePendukung").removeClass("disabled");
  }

  function daerah_ganti() {
    $("#provData").change(function () {
      let id_prov = $("#provData").val();

      $("#txtkota").LoadingOverlay("show");
      $("#txtkec").LoadingOverlay("show");
      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Daerah_api/get_kab",
        data: {
          id_prov: id_prov,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#kotaData").html(data.kab);
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kotaData").removeAttr("disabled");
            $("#txtkota").LoadingOverlay("hide");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kotaData").html(
              "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kotaData").attr("disabled", true);
            $("#kecData").attr("disabled", true);
            $("#kelData").attr("disabled", true);
            $("#txtkota").LoadingOverlay("hide");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_prov != "") {
            $(".errorProvData").html("");
          } else {
            $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkota").LoadingOverlay("hide");
          $("#txtkec").LoadingOverlay("hide");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });

    $("#kotaData").change(function () {
      let id_kab = $("#kotaData").val();

      $("#txtkec").LoadingOverlay("show");
      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Daerah_api/get_kec",
        data: {
          id_kab: id_kab,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#kecData").html(data.kec);
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").removeAttr("disabled");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").attr("disabled", true);
            $("#kelData").attr("disabled", true);
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_kab != "") {
            $(".errorKotaData").html("");
          } else {
            $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkec").LoadingOverlay("hide");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });

    $("#kecData").change(function () {
      let id_kec = $("#kecData").val();

      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Daerah_api/get_kel",
        data: {
          id_kec: id_kec,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#kelData").html(data.kel);
            $("#kelData").removeAttr("disabled");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").attr("disabled", true);
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_kec != "") {
            $(".errorKecData").html("");
          } else {
            $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });

    $("#kelData").change(function () {
      let id_kel = $("#kelData").val();
      if (id_kel != "") {
        $(".errorKelData").html("");
      } else {
        $(".errorKelData").html("<p>Kelurahan wajib dipilih</p>");
      }
    });
  }

  function get_data_kary(auth_per) {
    $("#txtdepartkary").LoadingOverlay("show");
    $("#txtLevelkary").LoadingOverlay("show");
    $("#txtroster").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Departemen_api/options_struktur",
      data: {
        auth_per: auth_per,
      },
      success: function (response) {
        $("#addPosisiKary").attr("disabled", true);
        $("#addPosisiKary").html(
          '<option value="">-- PILIH DEPARTEMEN --</option>'
        );
        $("#refreshPosisi").attr("disabled", true);
        $("#addSectionKary").attr("disabled", true);
        $("#addSectionKary").html(
          '<option value="">-- PILIH DEPARTEMEN --</option>'
        );
        $("#refreshSection").attr("disabled", true);
        var data = JSON.parse(response);
        $("#addDepartKary").html(data.dprt);
        $("#addDepartKary").removeAttr("disabled");
        $("#refreshDepart").removeAttr("disabled");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data departemen, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $.ajax({
      type: "POST",
      url: site_url + "Level_api/options",
      data: {
        auth_per: auth_per,
      },
      success: function (response) {
        $("#addGrade").attr("disabled", true);
        $("#addGrade").html('<option value="">-- PILIH LEVEL --</option>');
        $("#refreshGrade").attr("disabled", true);
        var data = JSON.parse(response);
        $("#addLevelKary").html(data.lvl);
        $("#addLevelKary").removeAttr("disabled");
        $("#refreshLevel").removeAttr("disabled");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data level, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $.ajax({
      type: "POST",
      url: site_url + "Roster_api/options",
      data: {
        perusahaan: auth_per,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#addRoster").html(data.roster);
        $("#addRoster").removeAttr("disabled");
        $("#refreshRoster").removeAttr("disabled");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data roster, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $("#txtdepartkary").LoadingOverlay("hide");
    $("#txtLevelkary").LoadingOverlay("hide");
    $("#txtroster").LoadingOverlay("hide");
  }

  function lanjutpersonal() {
    $(".btnlanjutpersonal").append(
      '<a id="addSimpanPersonal" data-scroll href="#clKaryawan" class="btn btn-primary font-weight-bold ml-1">Lanjutkan</a>'
    );
    $("#addSimpanPersonal").click(() => {
      //   $.LoadingOverlay("show");
      let auth_per = $("#addPerKary").val();
      let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
      let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
      let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
      let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
      let auth_check = $(".h2344234jfsd").text();
      let noktp = $("#noKTP").val();
      let nama = $("#namaLengkap").val();
      let alamat = $("#alamatKTP").val();
      let rt = $("#rtKTP").val();
      let rw = $("#rwKTP").val();
      let id_prov = $("#provData").val();
      let id_kab = $("#kotaData").val();
      let id_kec = $("#kecData").val();
      let id_kel = $("#kelData").val();
      let tmp_lahir = $("#tempatLahir").val();
      let tgl_lahir = $("#tanggalLahir").val();
      let stat_nikah = $("#statPernikahan").val();
      let id_agama = $("#addagama").val();
      let warga = $("#kewarganegaraan").val();
      let jk = $("#jenisKelamin").val();
      let bpjs_tk = $("#noBPJSTK").val();
      let bpjs_kes = $("#noBPJSKES").val();
      let nokk = $("#noKK").val();
      let npwp = $("#noNPWP").val();
      let email = $("#email").val();
      let notelp = $("#noTelp").val();
      let pddakhir = $("#pendidikanTerakhir").val();
      let sekolah = $("#sekolah").val();
      let fakultas = $("#fakultas").val();
      let jurusan = $("#jurusan").val();
      let cek_log = md5(new Date().toLocaleString());

      // cekfilefoto();

      //   let cekfoto = cekfilefoto();

      //   if (cekfoto) {
      //   } else {
      //   }

      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/create_data_personal",
        data: {
          noktp_old: noktp_old,
          nokk_old: nokk_old,
          no_nik_old: no_nik_old,
          noktp: noktp,
          nama: nama,
          alamat: alamat,
          rt: rt,
          rw: rw,
          id_prov: id_prov,
          id_kab: id_kab,
          id_kec: id_kec,
          id_kel: id_kel,
          tmp_lahir: tmp_lahir,
          tgl_lahir: tgl_lahir,
          email: email,
          notelp: notelp,
          stat_nikah: stat_nikah,
          id_agama: id_agama,
          warga: warga,
          jk: jk,
          bpjs_tk: bpjs_tk,
          bpjs_kes: bpjs_kes,
          npwp: npwp,
          nokk: nokk,
          auth_per: auth_per,
          auth_person: auth_person,
          auth_check: auth_check,
          pddakhir: pddakhir,
          sekolah: sekolah,
          fakultas: fakultas,
          jurusan: jurusan,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#colKaryawan").collapse("show");
            $("#colPersonal").collapse("hide");
            $("#imgPersonal").removeClass("d-none");
            $(".noktpshow").val(noktp);
            $(".namalengkapshow").val(nama);
            $(".89kjm78ujki782m4x787909h3").text(cek_log);
            $.LoadingOverlay("hide");
            aktifKaryawan();
          } else if (data.statusCode == 201) {
            $.LoadingOverlay("hide");
            swal("Error", data.pesan, "error");
          } else {
            $(".errorNoKTP").html(data.noktp);
            $(".errorNamaLengkap").html(data.nama);
            $(".errorAlamatKTP").html(data.alamat);
            $(".errorRtKTP").html(data.rt);
            $(".errorRwKTP").html(data.rw);
            $(".errorProvData").html(data.id_prov);
            $(".errorKotaData").html(data.id_kab);
            $(".errorKecData").html(data.id_kec);
            $(".errorKelData").html(data.id_kel);
            $(".errorTempatLahir").html(data.tmp_lahir);
            $(".errorTanggalLahir").html(data.tgl_lahir);
            $(".errorStatPernikahan").html(data.stat_nikah);
            $(".errorAddAgama").html(data.id_agama);
            $(".erroremail").html(data.email);
            $(".errornoTelp").html(data.notelp);
            $(".errorKewarganegaraan").html(data.warga);
            $(".errorJenisKelamin").html(data.jk);
            $(".errorNoBPJSTK").html(data.bpjs_tk);
            $(".errorNoBPJSKES").html(data.bpjs_kes);
            $(".errorNoNPWP").html(data.npwp);
            $(".errorNoKK").html(data.nokk);
            $(".errorPendidikanAkhir").html(data.pddakhir);
            $(".errorSekolah").html(data.sekolah);
            $(".errorFakultas").html(data.fakultas);
            $(".errorJurusan").html(data.jurusan);
            swal("Error", data.pesan, "error");
            window.scrollTo(0, 0);
            $.LoadingOverlay("hide");
          }
          $.LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat menyimpan data, hubungi administrator"
            );
          }
        },
      });

      $(".errormsg")
        .fadeTo(3000, 500)
        .slideUp(500, function () {
          $(".errormsg").slideUp(500);
          $(".errormsg").addClass("d-none");
        });
    });
  }

  // Select Searchable
  $("#provData").select2({
    theme: "bootstrap4",
  });
  $("#kotaData").select2({
    theme: "bootstrap4",
  });
  $("#kecData").select2({
    theme: "bootstrap4",
  });
  $("#kelData").select2({
    theme: "bootstrap4",
  });
  $("#addPerKary").select2({
    theme: "bootstrap4",
    dropdownParent: $("#addkry"),
  });
  $("#addDepartKary").select2({
    theme: "bootstrap4",
  });
  $("#addSectionKary").select2({
    theme: "bootstrap4",
  });
  $("#addPosisiKary").select2({
    theme: "bootstrap4",
  });
  $("#addLevelKary").select2({
    theme: "bootstrap4",
  });
  $("#addGrade").select2({
    theme: "bootstrap4",
  });
  $("#addKlasifikasiKary").select2({
    theme: "bootstrap4",
  });
  $("#addRoster").select2({
    theme: "bootstrap4",
  });
  $("#addPOHKary").select2({
    theme: "bootstrap4",
  });
  $("#addLokterimaKary").select2({
    theme: "bootstrap4",
  });
  $("#addLokasiKerja").select2({
    theme: "bootstrap4",
  });
  $("#addStatusResidence").select2({
    theme: "bootstrap4",
  });
  $("#addTipeKaryawan").select2({
    theme: "bootstrap4",
  });
  $("#statPernikahan").select2({
    theme: "bootstrap4",
  });
  $("#addagama").select2({
    theme: "bootstrap4",
  });
  $("#kewarganegaraan").select2({
    theme: "bootstrap4",
  });
  $("#jenisKelamin").select2({
    theme: "bootstrap4",
  });
  $("#addJenisSIM").select2({
    theme: "bootstrap4",
  });
  $("#jenisUnitSimper").select2({
    dropdownParent: $("#mdlunitsimper"),
    theme: "bootstrap4",
  });
  $("#jenisUnitSimpernw").select2({
    dropdownParent: $("#mdlunitsimpernw"),
    theme: "bootstrap4",
  });
  $("#tipeAksesUnit").select2({
    dropdownParent: $("#mdlunitsimper"),
    theme: "bootstrap4",
  });
  $("#tipeAksesUnitnw").select2({
    dropdownParent: $("#mdlunitsimpernw"),
    theme: "bootstrap4",
  });
  $("#jenisSertifikasi").select2({
    theme: "bootstrap4",
  });
  $("#pendidikanTerakhir").select2({
    theme: "bootstrap4",
  });
  $("#statusIbu").select2({
    theme: "bootstrap4",
  });
  $("#statusAyah").select2({
    theme: "bootstrap4",
  });
  $("#bank").select2({
    theme: "bootstrap4",
  });
  $("#jenisSertifikasiEdit").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdleditsertifikat"),
  });
  $("#keluargaTipe").select2({
    theme: "bootstrap4",
    dropdownParent: $("#addKeluarga"),
  });
  $("#keluargaJenisKelamin").select2({
    theme: "bootstrap4",
    dropdownParent: $("#addKeluarga"),
  });
  $("#keluargaStatusBPJS").select2({
    theme: "bootstrap4",
    dropdownParent: $("#addKeluarga"),
  });
  $("#updateKeluargaJenisKelamin").select2({
    theme: "bootstrap4",
    dropdownParent: $("#updateKeluarga"),
  });
  $("#updateKeluargaStatusBPJS").select2({
    theme: "bootstrap4",
    dropdownParent: $("#updateKeluarga"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#addJenisSIM").select2({
        theme: "bootstrap4",
      });
      $("#provData").select2({
        theme: "bootstrap4",
      });
      $("#kotaData").select2({
        theme: "bootstrap4",
      });
      $("#kecData").select2({
        theme: "bootstrap4",
      });
      $("#kelData").select2({
        theme: "bootstrap4",
      });
      $("#addPerKary").select2({
        theme: "bootstrap4",
        dropdownParent: $("#addkry"),
      });
      $("#addDepartKary").select2({
        theme: "bootstrap4",
      });
      $("#addSectionKary").select2({
        theme: "bootstrap4",
      });
      $("#addPosisiKary").select2({
        theme: "bootstrap4",
      });
      $("#addLevelKary").select2({
        theme: "bootstrap4",
      });
      $("#addGrade").select2({
        theme: "bootstrap4",
      });
      $("#addKlasifikasiKary").select2({
        theme: "bootstrap4",
      });
      $("#addTipeKaryawan").select2({
        theme: "bootstrap4",
      });
      $("#addRoster").select2({
        theme: "bootstrap4",
      });
      $("#addPOHKary").select2({
        theme: "bootstrap4",
      });
      $("#addLokterimaKary").select2({
        theme: "bootstrap4",
      });
      $("#addLokasiKerja").select2({
        theme: "bootstrap4",
      });
      $("#addStatusResidence").select2({
        theme: "bootstrap4",
      });
      $("#addJenisKaryawan").select2({
        theme: "bootstrap4",
      });
      $("#statPernikahan").select2({
        theme: "bootstrap4",
      });
      $("#addagama").select2({
        theme: "bootstrap4",
      });
      $("#kewarganegaraan").select2({
        theme: "bootstrap4",
      });
      $("#jenisKelamin").select2({
        theme: "bootstrap4",
      });
      $("#jenisUnitSimper").select2({
        dropdownParent: $("#mdlunitsimper"),
        theme: "bootstrap4",
      });
      $("#tipeAksesUnit").select2({
        dropdownParent: $("#mdlunitsimper"),
        theme: "bootstrap4",
      });
      $("#jenisSertifikasi").select2({
        theme: "bootstrap4",
      });
      $("#pendidikanTerakhir").select2({
        theme: "bootstrap4",
      });
      $("#statusIbu").select2({
        theme: "bootstrap4",
      });
      $("#statusAyah").select2({
        theme: "bootstrap4",
      });
      $("#bank").select2({
        theme: "bootstrap4",
      });
      $("#jenisSertifikasiEdit").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdleditsertifikat"),
      });
      $("#keluargaTipe").select2({
        theme: "bootstrap4",
        dropdownParent: $("#addKeluarga"),
      });
      $("#keluargaJenisKelamin").select2({
        theme: "bootstrap4",
        dropdownParent: $("#addKeluarga"),
      });
      $("#keluargaStatusBPJS").select2({
        theme: "bootstrap4",
        dropdownParent: $("#addKeluarga"),
      });
      $("#updateKeluargaJenisKelamin").select2({
        theme: "bootstrap4",
        dropdownParent: $("#updateKeluarga"),
      });
      $("#updateKeluargaStatusBPJS").select2({
        theme: "bootstrap4",
        dropdownParent: $("#updateKeluarga"),
      });
    },
    true
  );

  // Click Event
  $("#clKaryawan-click").click(function () {
    if ($("#colKaryawan").hasClass("show")) {
      $("#colKaryawan").collapse("hide");
    } else {
      $("#colKaryawan").collapse("show");
    }
  });

  $("#clPersonal-click").click(function () {
    if ($("#colPersonal").hasClass("show")) {
      $("#colPersonal").collapse("hide");
    } else {
      $("#colPersonal").collapse("show");
    }
  });

  $("#clAdditional-click").click(function () {
    if ($("#colAdditional").hasClass("show")) {
      $("#colAdditional").collapse("hide");
    } else {
      $("#colAdditional").collapse("show");
    }
  });

  $("#clIzinTambang-click").click(function () {
    if ($("#colIzinTambang").hasClass("show")) {
      $("#colIzinTambang").collapse("hide");
    } else {
      $("#colIzinTambang").collapse("show");
    }
  });

  $("#clSertifikasi-click").click(function () {
    if ($("#colSertifikasi").hasClass("show")) {
      $("#colSertifikasi").collapse("hide");
    } else {
      $("#colSertifikasi").collapse("show");
    }
  });

  $("#clMCU-click").click(function () {
    if ($("#colMCU").hasClass("show")) {
      $("#colMCU").collapse("hide");
    } else {
      $("#colMCU").collapse("show");
    }
  });

  $("#clVaksin-click").click(function () {
    if ($("#colVaksin").hasClass("show")) {
      $("#colVaksin").collapse("hide");
    } else {
      $("#colVaksin").collapse("show");
    }
  });

  $("#clFilePendukung-click").click(function () {
    if ($("#colFilePendukung").hasClass("show")) {
      $("#colFilePendukung").collapse("hide");
    } else {
      $("#colFilePendukung").collapse("show");
    }
  });

  $("#addUnitSIMPER").click(function () {
    let jenisizin = $("#addJenisIzin").val();

    if (jenisizin == 2) {
      let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
      let jenisizin = $("#addJenisIzin").val();
      let noreg = $("#addNoReg").val();
      let tglexp = $("#addTglExp").val();
      let jenissim = $("#addJenisSIM").val();
      let tglexpsim = $("#addTglExpSIM").val();
      let jenisunit = $("#jenisUnitSimper").val();
      let tipeakses = $("#tipeAksesUnit").val();
      let filesim = $("#filesimpolisi").val();
      let filesmp = $("#simpermp").val();

      if (auth_kary == "") {
        $(".errormsgizin").removeClass("d-none");
        $(".errormsgizin").removeClass("alert-info");
        $(".errormsgizin").addClass("alert-danger");
        $(".errormsgizin").html("Data karyawan tidak ditemukan");
      }

      if (filesim == "" || filesim == "Pilih file SIM Polisi") {
        errfilesim = "SIM Polisi Wajib di upload";
      } else {
        errfilesim = "";
      }

      if (filesmp == "" || filesmp == "Pilih file SIMPER/MINE PERMIT") {
        errfilesmp = "SIMPER Wajib di upload";
      } else {
        errfilesmp = "";
      }

      if (jenisizin == "") {
        errjenisizin = "Jenis izin wajib dipilih";
      } else {
        errjenisizin = "";
      }

      if (noreg == "") {
        errnoreg = "No. Registrasi wajib diisi";
      } else {
        errnoreg = "";
      }

      if (jenisizin == 2) {
        if (jenissim == "") {
          errjenissim = "Jenis SIM wajib dipilih";
        } else {
          errjenissim = "";
        }
      } else {
        errjenissim = "";
      }

      if (tglexpsim == "") {
        errtglexpsim = "Tanggal expired SIM wajib diisi";
      } else {
        errtglexpsim = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (
        errjenisizin == "" &&
        errnoreg == "" &&
        errtglexp == "" &&
        errjenissim == "" &&
        errtglexpsim == "" &&
        errfilesim == "" &&
        errfilesmp == ""
      ) {
        $("#mdlunitsimper").modal("show");
        $("#refreshjenisUnitSimper").removeAttr("disabled");
        $("#refreshtipeAksesUnit").removeAttr("disabled");
      } else {
        $(".erroraddJenisIzin").html(errjenisizin);
        $(".erroraddNoReg").html(errnoreg);
        $(".erroraddJenisSIM").html(errjenissim);
        $(".erroraddTglExpSIM").html(errtglexpsim);
        $(".erroraddTglExp").html(errtglexp);
        $(".errorsimpermp").html(errfilesmp);
        $(".errorFilesimpolisi").html(errfilesim);
      }
    }
  });

  $("#btnverifikasiktp").click(function () {
    let noktp = $("#noKTPCek").val();
    let errnoktp = $(".errornoKTPCek").text();

    if (noktp != "") {
      if (errnoktp == "") {
        swal({
          title: "Verifikasi No. KTP",
          text: "Yakin No. KTP : " + noktp + " sudah benar?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, benar",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/checkKTP",
              data: {
                noktp: noktp,
              },
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdlbuatdatakary").modal("hide");
                  $("#noKTP").val(noktp);
                  $(".0c09efa8ccb5e0114e97df31736ce2e3").text(
                    data.auth_personal
                  );
                  $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                  $(".h2344234jfsd").text("");
                  $("#noKTP").removeAttr("disabled");
                  $("#colPersonal").collapse("show");
                  $.ajax({
                    type: "POST",
                    url: site_url + "Daerah_api/get_prov",
                    data: {},
                    success: function (provdata) {
                      var provdata = JSON.parse(provdata);
                      $("#provData").html(provdata.prov);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data provinsi, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });
                  aktifPersonalNoKTP();
                  daerah_ganti();
                  lanjutpersonal();
                  $.LoadingOverlay("hide");
                  swal("Berhasil", data.pesan, "success");
                } else if (data.statusCode == 201) {
                  $("#pesanDet").text(data.pesan);
                  $("#noKTPDet").text(data.no_ktp);
                  $("#namaDet").text(data.nama_lengkap);

                  if (data.tgl_nonaktif == "01-Jan-1970") {
                    $(".tglnonaktif").addClass("d-none");
                    $(".lamanonaktif").addClass("d-none");
                    $(".pelanggaran").addClass("d-none");
                  } else {
                    $(".tglnonaktif").removeClass("d-none");
                    $(".lamanonaktif").removeClass("d-none");
                    $(".pelanggaran").removeClass("d-none");
                    $("#tglNonAktifDet").text(data.tgl_nonaktif);
                    $("#lamaNonAktifDet").text(data.lama_nonaktif);
                  }

                  $("#PerusahaanDet").text(data.perusahaan);

                  if (data.status == "AKTIF") {
                    $("#StatusDet").removeClass("text-danger");
                    $("#StatusDet").addClass("text-success");
                  } else {
                    $("#StatusDet").removeClass("text-success");
                    $("#StatusDet").addClass("text-danger");
                  }

                  $("#StatusDet").text(data.status);
                  $.LoadingOverlay("hide");
                  $("#mdlverifkary").modal("show");
                } else {
                  swal("Berhasil", data.pesan, "success");
                  $.ajax({
                    type: "POST",
                    url: site_url + "Daerah_api/get_prov",
                    async: false,
                    data: {},
                    success: function (provdata) {
                      var provdata = JSON.parse(provdata);
                      $("#provData").html(provdata.prov);
                      $("#provData").val(data.prov).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data provinsi, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url: site_url + "Daerah_api/get_kab",
                    async: false,
                    data: {
                      id_prov: data.prov,
                    },
                    success: function (kabdata) {
                      var kabdata = JSON.parse(kabdata);
                      $("#kotaData").html(kabdata.kab);
                      $("#kotaData").val(data.kab).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kabupaten, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url: site_url + "Daerah_api/get_kec",
                    async: false,
                    data: {
                      id_kab: data.kab,
                    },
                    success: function (kecdata) {
                      var kecdata = JSON.parse(kecdata);
                      $("#kecData").html(kecdata.kec);
                      $("#kecData").val(data.kec).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url: site_url + "Daerah_api/get_kel",
                    async: false,
                    data: {
                      id_kec: data.kec,
                    },
                    success: function (keldata) {
                      var keldata = JSON.parse(keldata);
                      $("#kelData").html(keldata.kel);
                      $("#kelData").val(data.kel).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kelurahan, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $(".0c09efa8ccb5e0114e97df31736ce2e3").text(
                    data.auth_personal
                  );
                  $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                  $(".h2344234jfsd").text(data.auth_personal);
                  $("#noKTP").val(data.no_ktp);
                  $("#namaLengkap").val(data.nama);
                  $("#alamatKTP").val(data.alamat);
                  $("#rtKTP").val(data.rt);
                  $("#rwKTP").val(data.rw);
                  $("#kewarganegaraan")
                    .val(data.warga_negara)
                    .trigger("change");
                  $("#addagama").val(data.agama).trigger("change");
                  $("#jenisKelamin").val(data.jk).trigger("change");
                  $("#statPernikahan").val(data.stat_nikah).trigger("change");
                  $("#tempatLahir").val(data.tmp_lahir);
                  $("#tanggalLahir").val(data.tgl_lahir);
                  $("#noBPJSTK").val(data.no_bpjstk);
                  $("#noBPJSKES").val(data.no_bpjsks);
                  $("#noNPWP").val(data.no_npwp);
                  $("#noKK").val(data.no_kk);
                  $("#email").val(data.email_pribadi);
                  $("#noTelp").val(data.hp_1);
                  $("#pendidikanTerakhir")
                    .val(data.didik_terakhir)
                    .trigger("change");
                  $("#sekolah").val(data.sekolah);
                  $("#fakultas").val(data.fakultas);
                  $("#jurusan").val(data.jurusan);
                  $("#mdlbuatdatakary").modal("hide");
                  $("#colPersonal").collapse("show");
                  aktifPersonalNoKTP();
                  lanjutpersonal();
                  daerah_ganti();
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass("d-none");
                $(".errormsg").removeClass("alert-info");
                $(".errormsg").addClass("alert-danger");
                if (thrownError != "") {
                  $(".errormsg").html(
                    "Terjadi kesalahan saat load data personal, hubungi administrator"
                  );
                }
              },
            });
          } else {
            swal.close();
          }
        });
      } else {
        swal("Error", errnoktp, "error");
      }
    } else {
      swal("Error", "No. KTP tidak boleh kosong", "error");
    }
  });

  $("#addBuatData").click(function () {
    if ($("#addSimpanPersonal").length > 0) {
      swal(
        "Error",
        "Verifikasi tidak dapat dilakukan, selesaikan isi data karyawan",
        "error"
      );
    } else {
      $("#mdlbuatdatakary").modal("show");
      $("#noKTPCek").val("");
    }
  });

  $("#btnsimpanunitsimper").click(function () {
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_simpol = $(".j8234234b").text();
    let jenisizin = $("#addJenisIzin").val();
    let noreg = $("#addNoReg").val();
    let tglexp = $("#addTglExp").val();
    let jenissim = $("#addJenisSIM").val();
    let tglexpsim = $("#addTglExpSIM").val();
    let jenisunit = $("#jenisUnitSimper").val();
    let tipeakses = $("#tipeAksesUnit").val();
    let filesim = $("#filesimpolisi").val();
    const flsim = $("#filesimpolisi").prop("files")[0];
    let filesmp = $("#simpermp").val();
    const flsmp = $("#simpermp").prop("files")[0];
    let filesimnm = $("#nmfilesimpol").val();
    let filesimsv = $("#nmfilesimpolsv").val();
    let filesmpnm = $("#nmfilesimper").val();
    let filesmpsv = $("#nmfilesimpersv").val();

    let fileSimName = filesim.split(".").pop().toLowerCase();
    let fileSimSize = flsim["size"];

    let fileSimperName = filesmp.split(".").pop().toLowerCase();
    let fileSimperSize = flsmp["size"];

    if (fileSimName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Sim Karyawan yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSimSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Sim Karyawan yang dipilih melebihi 100",
        type: "warning",
      });
    } else if (fileSimperName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Simper yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSimperSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Simper yang dipilih melebihi 100",
        type: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("filesimpolisi", flsim);
      formData.append("filesim", filesim);
      formData.append("filesmpkary", flsmp);
      formData.append("filesmp", filesmp);
      formData.append("jenisizin", jenisizin);
      formData.append("noreg", noreg);
      formData.append("tglexpsim", tglexpsim);
      formData.append("tglexp", tglexp);
      formData.append("jenissim", jenissim);
      formData.append("jenisunit", jenisunit);
      formData.append("auth_izin", auth_izin);
      formData.append("auth_kary", auth_kary);
      formData.append("auth_simpol", auth_simpol);
      formData.append("auth_person", auth_person);
      formData.append("tipeakses", tipeakses);
      formData.append("filesimnm", filesimnm);
      formData.append("filesimsv", filesimsv);
      formData.append("filesmpnm", filesmpnm);
      formData.append("filesmpsv", filesmpsv);

      $.ajax({
        type: "POST",
        url: site_url + "Izin_tambang_api/add_unit_izin_tambang",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#jenisUnitSimper").val("").trigger("change");
            $("#tipeAksesUnit").val("").trigger("change");
            $("#idizintambang").LoadingOverlay("show");
            $(".j8234234b").text(data.auth_simpol);
            $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
            if (data.auth_unit == "j78uh5yg") {
              $("#nmfilesimpol").val(flsim.name);
              $("#nmfilesimpolsv").val(data.filesimsv);
              $("#nmfilesimper").val(flsmp.name);
              $("#nmfilesimpersv").val(data.filesmpsv);
              $("#btnshowsimper").attr("href", data.linkizin);
              $("#btnshowsimpol").attr("href", data.linksim);
            }
            $(".errorjenisUnitSimper").text("");
            $(".errortipeAksesUnit").text("");
            $(".erroraddJenisIzin").html("");
            $(".erroraddNoReg").html("");
            $(".erroraddJenisSIM").html("");
            $(".erroraddTglExpSIM").html("");
            $(".errorFilesimpolisi").html("");
            $(".erroraddTglExp").html("");
            $(".errorsimpermp").html("");
            $(".errorFilesimpolisi").html("");
            $("#idizintambang").load(
              site_url + "Karyawan_api/izin_tambang?auth_izin=" + data.auth_izin
            );
            swal("Berhasil", data.pesan, "success");
          } else if (data.statusCode == 201) {
            swal("Error", data.message, "error");
          } else {
            $(".errorjenisUnitSimper").html(data.jenisunit);
            $(".errortipeAksesUnit").html(data.tipeakses);
            swal("Error", data.pesan, "error");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat menyimpan unit hubungi administrator"
            );
          }
        },
      });
    }
  });

  $("#refreshBank").click(function () {
    $("#loadingBank").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Bank_api/options",
      success: function (response) {
        var data = JSON.parse(response);
        $("#bank").html(data.options);
        $("#loadingBank").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#loadingBank").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data bank, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshJenisSIM").click(function () {
    $("#txtizinSIM").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisSIM",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addJenisSIM").html(data.siim);
        $("#txtizinSIM").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis SIM, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshJenisSertifikat").click(function () {
    $("#txtjenisSertifkat").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisSertifikasi",
      success: function (response) {
        var data = JSON.parse(response);
        $("#jenisSertifikasi").html(data.srt);
        $("#txtjenisSertifkat").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisSertifkat").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
          );
          $("#addSimpanSertifikasi").remove();
          $("#addResetSertifikasi").remove();
        }
      },
    });
  });

  $("#refreshhasilMCU").click(function () {
    $("#txthasilMCU").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisMCU",
      success: function (response) {
        var data = JSON.parse(response);
        $("#hasilMCU").html(data.jmcu);
        $("#txthasilMCU").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txthasilMCU").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshjenisVaksin").click(function () {
    $("#txtjenisVaksin").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisVaksin",
      success: function (response) {
        var data = JSON.parse(response);
        $("#jenisVaksin").html(data.jvks);
        $("#txtjenisVaksin").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisVaksin").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshnamaVaksin").click(function () {
    $("#txtnamaVaksin").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataNamaVaksin",
      success: function (response) {
        var data = JSON.parse(response);
        $("#namaVaksin").html(data.nvks);
        $("#txtnamaVaksin").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtnamaVaksin").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data nama vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshtipeAksesUnit").click(function () {
    $("#txttipeAksesUnit").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataTipeAkses",
      success: function (response) {
        var data = JSON.parse(response);
        $("#tipeAksesUnit").html(data.akses);
        $("#txttipeAksesUnit").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txttipeAksesUnit").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimper").removeClass("d-none");
        $(".errormdlsimper").removeClass("alert-info");
        $(".errormdlsimper").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimper").html(
            "Terjadi kesalahan saat load data unit simper, hubungi administrator"
          );
          $("#btnsimpanunitsimper").remove();
        }
      },
    });
  });

  $("#refreshProv").click(function () {
    $("#txtprov").LoadingOverlay("show");
    $("#txtkota").LoadingOverlay("show");
    $("#txtkec").LoadingOverlay("show");
    $("#txtkel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_prov",
      data: {},
      success: function (response) {
        var data = JSON.parse(response);
        $("#provData").html(data.prov);
        $("#kotaData").html(
          "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
        );
        $("#kecData").html(
          "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
        );
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtprov").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#provData").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtprov").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data provinsi, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKota").click(function () {
    let id_prov = $("#provData").val();

    $("#txtkota").LoadingOverlay("show");
    $("#txtkec").LoadingOverlay("show");
    $("#txtkel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: id_prov,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kotaData").html(data.kab);
        $("#kecData").html(
          "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
        );
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");

        if (id_prov != "") {
          $(".errorProvData").html("");
        } else {
          $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKec").click(function () {
    let id_kab = $("#kotaData").val();

    $("#txtkec").LoadingOverlay("show");
    $("#txtkota").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: id_kab,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kecData").html(data.kec);
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        if (id_kab != "") {
          $(".errorKotaData").html("");
        } else {
          $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKel").click(function () {
    let id_kec = $("#kecData").val();

    $("#txtkel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: id_kec,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kelData").html(data.kel);
        $("#txtkel").LoadingOverlay("hide");
        if (id_kab != "") {
          $(".errorKecData").html("");
        } else {
          $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshDidik").click(function () {
    $("#txtDidik").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPendidikan",
      success: function (response) {
        var data = JSON.parse(response);
        $("#pendidikanTerakhir").html(data.pdk);
        $("#txtDidik").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtDidik").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshDepart").click(function () {
    let auth_m_per = $("#addPerKary").val();

    if (auth_m_per != "") {
      $("#txtdepartkary").LoadingOverlay("show");
      $("#txtposisikary").LoadingOverlay("show");
      $("#txtsectionkary").LoadingOverlay("show");

      $.ajax({
        type: "POST",
        url: site_url + "Departemen_api/options_struktur",
        data: {
          auth_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          $("#addDepartKary").html(data.dprt);
          $("#addDepartKary").removeAttr("disabled");
          $("#addSectionKary").attr("disabled", true);
          $("#refreshSection").attr("disabled", true);
          $("#addSectionKary").html(
            '<option value ="">-- PILIH DEPARTEMEN --</option>'
          );
          $("#addPosisiKary").attr("disabled", true);
          $("#refreshPosisi").attr("disabled", true);
          $("#addPosisiKary").html(
            '<option value ="">-- PILIH DEPARTEMEN --</option>'
          );
          $("#txtdepartkary").LoadingOverlay("hide");
          $("#txtsectionkary").LoadingOverlay("hide");
          $("#txtposisikary").LoadingOverlay("hide");

          if (auth_m_per != "") {
            $(".errorAddPerKary").html("");
          } else {
            $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtdepartkary").LoadingOverlay("hide");
          $("#txtsectionkary").LoadingOverlay("hide");
          $("#txtposisikary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data departemen, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      swal("Error", "Pilih perusahaan", "error");
    }
  });

  $("#refreshSection").click(function () {
    let auth_depart = $("#addDepartKary").val();

    $("#txtsectionkary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Section_api/options",
      data: {
        auth_depart: auth_depart,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#addSectionKary").html(data.section);
        $("#txtsectionkary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtsectionkary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data section, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshPosisi").click(function () {
    let auth_depart = $("#addDepartKary").val();

    $("#txtposisikary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Posisi_api/options",
      data: {
        auth_depart: auth_depart,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#addPosisiKary").html(data.posisi);
        $("#txtposisikary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtposisikary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data posisi, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshKlasifikasi").click(function () {
    $("#txtklasifikasikary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataKlasifikasi",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addKlasifikasiKary").html(data.kls);
        $("#txtklasifikasikary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtklasifikasikary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshPOH").click(function () {
    $("#txtPOHKary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPOH",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addPOHKary").html(data.pho);
        $("#txtPOHKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtPOHKary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data POH, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshLokterima").click(function () {
    let auth_per = $("#addPerKary").val();
    $("#txtlokterimakary").LoadingOverlay("show");

    if (auth_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/dataLokasiPenerimaan",
        success: function (response) {
          var data = JSON.parse(response);
          $("#txtlokterimakary").LoadingOverlay("hide");
          $("#addLokterimaKary").removeAttr("disabled");
          $("#addLokterimaKary").html(data.lkt);
          $("#addLokterimaKary").removeAttr("disabled");
          $("#refreshLokterima").removeAttr("disabled");
        },
        error: function () {
          $("#txtlokterimakary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").removeClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    }
  });

  $("#refreshLokker").click(function () {
    $("#txtlokkerkary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataLokasiKerja",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addLokasiKerja").html(data.lkr);
        $("#txtlokkerkary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtlokkerkary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshTipe").click(function () {
    $("#txtjeniskary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataGolongan",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addTipeKaryawan").html(data.tipe);
        $("#txtjeniskary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjeniskary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data tipe karyawan, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshLevel").click(function () {
    let auth_per = $("#addPerKary").val();

    if (auth_per != "") {
      $("#txtLevelkary").LoadingOverlay("show");
      $("#txtgrade").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Level_api/options",
        data: {
          auth_per: auth_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          $("#addLevelKary").html(data.lvl);
          $("#addGrade").attr("disabled", true);
          $("#refreshGrade").attr("disabled", true);
          $("#addGrade").html('<option value ="">-- PILIH LEVEL --</option>');
          $("#txtLevelkary").LoadingOverlay("hide");
          $("#txtgrade").LoadingOverlay("hide");

          if (auth_m_per != "") {
            $(".errorAddPerKary").html("");
          } else {
            $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtLevelkary").LoadingOverlay("hide");
          $("#txtgrade").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data level, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      swal("Error", "Pilih perusahaan", "error");
    }
  });

  $("#refreshGrade").click(function () {
    let auth_level = $("#addLevelKary").val();

    $("#txtgrade").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Grade_api/options",
      data: {
        auth_level: auth_level,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#addGrade").html(data.grade);
        $("#txtgrade").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtgrade").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data grade, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshRoster").click(function () {
    let auth_per = $("#addPerKary").val();
    $("#txtroster").LoadingOverlay("show");
    if (auth_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Roster_api/options",
        data: {
          perusahaan: auth_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          $("#addRoster").html(data.roster);
          $("#txtroster").LoadingOverlay("hide");
          $("#addRoster").removeAttr("disabled");
          $("#refreshRoster").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtroster").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data roster, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    }
  });

  $("#refreshResidence").click(function () {
    $("#txtstatresidence").LoadingOverlay("show");
    $("#addStatusResidence").val("").trigger("change");
    $("#txtstatresidence").LoadingOverlay("hide");
  });

  $("#refreshstatkaryawan").click(function () {
    $("#txtstatkary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataStatusPerjanjian",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addStatusKaryawan").html(data.janji);
        $("#addFieldKontrakAwal").addClass("d-none");
        $("#addFieldKontrakAkhir").addClass("d-none");
        $("#addFieldPermanen").addClass("d-none");

        $("#addTanggalPermanen").val("");
        $("#addTanggalKontrakAwal").val("");
        $("#addTanggalKontrakAkhir").val("");

        $("#txtstatkary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtstatkary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status karyawan, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshPaybase").click(function () {
    $("#txtPaybase").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPaybase",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addPaybase").html(data.options);
        $("#txtPaybase").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtPaybase").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data paybase, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshPajak").click(function () {
    $("#txtPajak").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPajak",
      success: function (response) {
        var data = JSON.parse(response);
        $("#addPajak").html(data.options);
        $("#txtPajak").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtPajak").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status pajak, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#addKembaliPekerjaan").click(function () {
    $("#colKaryawan").collapse("hide");
    $("#colPersonal").collapse("show");
  });

  $("#addSimpanPekerjaan").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_alamat = $(".150b3427b97bb43ac2fb3e5c687e384c").text();
    let auth_ktr = $(".asdas9asd").text();
    let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
    let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
    let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
    let noktp = $("#noKTP").val();
    let nama = $("#namaLengkap").val();
    let alamat = $("#alamatKTP").val();
    let rt = $("#rtKTP").val();
    let rw = $("#rwKTP").val();
    let id_prov = $("#provData").val();
    let id_kab = $("#kotaData").val();
    let id_kec = $("#kecData").val();
    let id_kel = $("#kelData").val();
    let tmp_lahir = $("#tempatLahir").val();
    let tgl_lahir = $("#tanggalLahir").val();
    let stat_nikah = $("#statPernikahan").val();
    let id_agama = $("#addagama").val();
    let warga = $("#kewarganegaraan").val();
    let jk = $("#jenisKelamin").val();
    let email = $("#email").val();
    let telp = $("#noTelp").val();
    let bpjs_tk = $("#noBPJSTK").val();
    let bpjs_kes = $("#noBPJSKES").val();
    let npwp = $("#noNPWP").val();
    let nokk = $("#noKK").val();
    let namaibu = $("#namaIbu").val();
    let id_pendidikan = $("#pendidikanTerakhir").val();
    let sekolah = $("#sekolah").val();
    let fakultas = $("#fakultas").val();
    let jurusan = $("#jurusan").val();
    let no_nik = $("#addNIKKary").val();
    let depart = $("#addDepartKary").val();
    let section = $("#addSectionKary").val();
    let posisi = $("#addPosisiKary").val();
    let doh = $("#addDOH").val();
    let tgl_aktif = $("#addTanggalAktif").val();
    let id_lokker = $("#addLokasiKerja").val();
    let id_lokterima = $("#addLokterimaKary").val();
    let id_poh = $("#addPOHKary").val();
    let id_klasifikasi = $("#addKlasifikasiKary").val();
    let id_tipe = $("#addTipeKaryawan").val();
    let id_level = $("#addLevelKary").val();
    let id_roster = $("#addRoster").val();
    let id_grade = $("#addGrade").val();
    let stat_tinggal = $("#addStatusResidence").val();
    let stat_kerja = $("#addStatusKaryawan").val();
    let email_kantor = $("#addEmailKantor").val();
    let paybase = $("#addPaybase").val();
    let pajak = $("#addPajak").val();
    let tgl_permanen = $("#addTanggalPermanen").val();
    let tgl_mulai_kontrak = $("#addTanggalKontrakAwal").val();
    let tgl_akhir_kontrak = $("#addTanggalKontrakAkhir").val();
    let id_m_perusahaan = $("#addPerKary").val();
    let auth_check = $(".89kjm78ujki782m4x787909h3").text();
    let auth_ver = $(".h2344234jfsd").text();

    if (auth_person != "") {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/create_data_karyawan",
        data: {
          auth_ver: auth_ver,
          auth_person: auth_person,
          auth_kary: auth_kary,
          auth_alamat: auth_alamat,
          auth_ktr: auth_ktr,
          no_nik_old: no_nik_old,
          noktp_old: noktp_old,
          nokk_old: nokk_old,
          noktp: noktp,
          nama: nama,
          alamat: alamat,
          rt: rt,
          rw: rw,
          id_prov: id_prov,
          id_kab: id_kab,
          id_kec: id_kec,
          id_kel: id_kel,
          tmp_lahir: tmp_lahir,
          tgl_lahir: tgl_lahir,
          stat_nikah: stat_nikah,
          id_agama: id_agama,
          warga: warga,
          jk: jk,
          email: email,
          telp: telp,
          bpjs_tk: bpjs_tk,
          bpjs_kes: bpjs_kes,
          npwp: npwp,
          nokk: nokk,
          namaibu: namaibu,
          id_pendidikan: id_pendidikan,
          sekolah: sekolah,
          fakultas: fakultas,
          jurusan: jurusan,
          auth_kary: auth_kary,
          no_nik: no_nik,
          depart: depart,
          section: section,
          posisi: posisi,
          doh: doh,
          tgl_aktif: tgl_aktif,
          id_lokker: id_lokker,
          id_lokterima: id_lokterima,
          id_poh: id_poh,
          id_klasifikasi: id_klasifikasi,
          id_tipe: id_tipe,
          id_level: id_level,
          id_roster: id_roster,
          id_grade: id_grade,
          stat_tinggal: stat_tinggal,
          stat_kerja: stat_kerja,
          email_kantor: email_kantor,
          paybase: paybase,
          pajak: pajak,
          tgl_permanen: tgl_permanen,
          tgl_mulai_kontrak: tgl_mulai_kontrak,
          tgl_akhir_kontrak: tgl_akhir_kontrak,
          id_m_perusahaan: id_m_perusahaan,
          auth_check: auth_check,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $.LoadingOverlay("hide");
            if (auth_ver === "") {
              $(".0c09efa8ccb5e0114e97df31736ce2e3").text(data.auth_person);
              $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
              $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
              $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
            }
            $(".a6b73b5c154d3540919ddf46edf3b84e").text(data.auth_kary);
            $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
            $(".asdas9asd").text(data.auth_kontrak);
            $("#colPersonal").collapse("hide");
            $("#colKaryawan").collapse("hide");
            $("#dataKeluarga").load(site_url + "Keluarga_api/data?auth_personal=" + auth_person);
            $("#colAdditional").collapse("show");
            $("#imgKaryawan").removeClass("d-none");
            aktifAdditional();
            $("#noktpshow").val(noktp);
            $("#namalengkapshow").val(nama);
            swal("Berhasil", data.pesan, "success");
            $.LoadingOverlay("hide");
          } else if (data.statusCode == 201) {
            $(".errmsgKary").removeClass("d-none");
            $(".errmsgKary").removeClass("alert-primary");
            $(".errmsgKary").addClass("alert-danger");
            $(".errmsgKary").html(data.pesan);
            $.LoadingOverlay("hide");
          } else {
            $(".erroraddNIKKary").html(data.no_nik);
            $(".errorAddDepartKary").html(data.depart);
            $(".errorAddSectionKary").html(data.section);
            $(".errorAddPosisiKary").html(data.posisi);
            $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
            $(".erroraddPOHKary").html(data.id_poh);
            $(".erroraddLokterimaKary").html(data.id_lokterima);
            $(".erroraddLokasiKerja").html(data.id_lokker);
            $(".erroraddLevelKary").html(data.id_level);
            $(".erroraddRoster").html(data.id_roster);
            $(".erroraddGrade").html(data.id_grade);
            $(".erroraddStatusResidence").html(data.stat_tinggal);
            $(".erroraddDOH").html(data.doh);
            $(".erroraddTanggalAktif").html(data.tgl_aktif);
            $(".erroraddTipeKaryawan").html(data.id_tipe);
            $(".erroraddJenisKaryawan").html(data.stat_kerja);
            $(".erroraddEmail").html(data.email_kantor);
            $(".erroraddPaybase").html(data.paybase);
            $(".erroraddPajak").html(data.pajak);
            $(".erroraddTanggalPermanen").html(data.pesan);
            $(".erroraddTanggalKontrakAwal").html(data.pesan1);
            $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
            swal("Error", data.pesan3, "error");
            $.LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errmsgKary").removeClass("d-none");
          $(".errmsgKary").addClass("alert-danger");
          if (thrownError != "") {
            $(".errmsgKary").html(
              "Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator"
            );
          }
        },
      });
      $.LoadingOverlay("hide");
    } else {
      swal({
        title: "Simpan Data",
        text:
          "Yakin data karyawan No. KTP : " +
          noktp +
          ", Nama : " +
          nama +
          ", akan disimpan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, simpan",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Karyawan_api/create_data_karyawan",
            data: {
              auth_person: auth_person,
              auth_kary: auth_kary,
              auth_alamat: auth_alamat,
              auth_ktr: auth_ktr,
              no_nik_old: no_nik_old,
              noktp_old: noktp_old,
              nokk_old: nokk_old,
              noktp: noktp,
              nama: nama,
              alamat: alamat,
              rt: rt,
              rw: rw,
              id_prov: id_prov,
              id_kab: id_kab,
              id_kec: id_kec,
              id_kel: id_kel,
              tmp_lahir: tmp_lahir,
              tgl_lahir: tgl_lahir,
              stat_nikah: stat_nikah,
              id_agama: id_agama,
              warga: warga,
              jk: jk,
              email: email,
              telp: telp,
              bpjs_tk: bpjs_tk,
              bpjs_kes: bpjs_kes,
              npwp: npwp,
              nokk: nokk,
              namaibu: namaibu,
              id_pendidikan: id_pendidikan,
              sekolah: sekolah,
              fakultas: fakultas,
              jurusan: jurusan,
              auth_kary: auth_kary,
              no_nik: no_nik,
              depart: depart,
              section: section,
              posisi: posisi,
              doh: doh,
              tgl_aktif: tgl_aktif,
              id_lokker: id_lokker,
              id_lokterima: id_lokterima,
              id_poh: id_poh,
              id_klasifikasi: id_klasifikasi,
              id_tipe: id_tipe,
              id_level: id_level,
              id_roster: id_roster,
              id_grade: id_grade,
              stat_tinggal: stat_tinggal,
              stat_kerja: stat_kerja,
              email_kantor: email_kantor,
              paybase: paybase,
              pajak: pajak,
              tgl_permanen: tgl_permanen,
              tgl_mulai_kontrak: tgl_mulai_kontrak,
              tgl_akhir_kontrak: tgl_akhir_kontrak,
              id_m_perusahaan: id_m_perusahaan,
              auth_check: auth_check,
            },
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $(".0c09efa8ccb5e0114e97df31736ce2e3").text(data.auth_person);
                $(".a6b73b5c154d3540919ddf46edf3b84e").text(data.auth_kary);
                $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
                $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
                $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
                $(".asdas9asd").text(data.auth_kontrak);
                $("#colPersonal").collapse("hide");
                $("#colKaryawan").collapse("hide");
                $("#dataKeluarga").load(site_url + "Keluarga_api/data?auth_personal=" + auth_person);
                $("#colAdditional").collapse("show");
                $("#imgKaryawan").removeClass("d-none");
                aktifAdditional();
                swal("Berhasil", data.pesan, "success");
              } else if (data.statusCode == 201) {
                $(".errmsgKary").removeClass("d-none");
                $(".errmsgKary").removeClass("alert-primary");
                $(".errmsgKary").addClass("alert-danger");
                $(".errmsgKary").html(data.pesan);
              } else {
                $(".erroraddNIKKary").html(data.no_nik);
                $(".errorAddDepartKary").html(data.depart);
                $(".errorAddPosisiKary").html(data.posisi);
                $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
                $(".erroraddPOHKary").html(data.id_poh);
                $(".erroraddLokterimaKary").html(data.id_lokterima);
                $(".erroraddLokasiKerja").html(data.id_lokker);
                $(".erroraddLevelKary").html(data.id_level);
                $(".erroraddRoster").html(data.id_roster);
                $(".erroraddGrade").html(data.id_grade);
                $(".erroraddStatusResidence").html(data.stat_tinggal);
                $(".erroraddDOH").html(data.doh);
                $(".erroraddTanggalAktif").html(data.tgl_aktif);
                $(".erroraddTipeKaryawan").html(data.id_tipe);
                $(".erroraddJenisKaryawan").html(data.stat_kerja);
                $(".erroraddEmail").html(data.email_kantor);
                $(".erroraddPaybase").html(data.paybase);
                $(".erroraddPajak").html(data.pajak);
                $(".erroraddTanggalPermanen").html(data.pesan);
                $(".erroraddTanggalKontrakAwal").html(data.pesan1);
                $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
                swal("Error", data.pesan3, "error");
              }
              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $(".errmsgKary").removeClass("d-none");
              $(".errmsgKary").addClass("alert-danger");
              if (thrownError != "") {
                $(".errmsgKary").html(
                  "Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator"
                );
              }
              $.LoadingOverlay("hide");
            },
          });
        } else {
          swal.close();
        }
      });
    }

    $(".errormsg")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsg").slideUp(500);
        $(".errormsg").addClass("d-none");
      });
  });

  $("#addSimpanAdditional").submit(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let namaIbu = $("#namaIbu").val();
    let statusIbu = $("#statusIbu").val();
    let namaAyah = $("#namaAyah").val();
    let statusAyah = $("#statusAyah").val();
    let bank = $("#bank").val();
    let rekening = $("#rekening").val();
    let pemilik = $("#pemilik").val();
    let keterangan = $("#keterangan").val();
    let nama = $("#nama_ec").val();
    let relasi = $("#relasi_ec").val();
    let hp = $("#hp_ec").val();
    let hp2 = $("#hp_ec_2").val();
    let keteranganEc = $("#ket_ec_2").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/update_data_tambahan",
      data: {
        auth_person: auth_person,
        namaIbu: namaIbu,
        statusIbu: statusIbu,
        namaAyah: namaAyah,
        statusAyah: statusAyah,
        bank: bank,
        rekening: rekening,
        pemilik: pemilik,
        keterangan: keterangan,
        nama: nama,
        relasi: relasi,
        hp: hp,
        hp2: hp2,
        keteranganEc: keteranganEc,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#colPersonal").collapse("hide");
          $("#colKaryawan").collapse("hide");
          $("#colAdditional").collapse("hide");
          $("#colIzinTambang").collapse("show");
          $("#idizintambang").load(
            site_url + "Karyawan_api/izin_tambang?auth_izin=0"
          );
          $("#imgAdditional").removeClass("d-none");
          $("#filesimpolisi").removeAttr("disabled");
          $("#simpermp").removeAttr("disabled");
          aktifSIMPER();
          swal("Berhasil", data.pesan, "success");
          $.LoadingOverlay("hide");
        } else {
          $.LoadingOverlay("hide");
          swal("Gagal", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgadditional").removeClass("d-none");
        if (thrownError != "") {
          $(".errormsgadditional").html(
            "Terjadi kesalahan saat membuat data tambahan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#addbtnkembaliAdditional").click(function () {
    $("#colAdditional").collapse("hide");
    $("#colKaryawan").collapse("show");
  });

  $("#addSimpanIzinUnit").click(function () {
    $.LoadingOverlay("show");
    if ($("#addJenisIzin").val() == '1' || $("#addJenisIzin").val() == '3') {
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let jenisizin = $("#addJenisIzin").val();
    let noreg = $("#addNoReg").val();
    let tglexp = $("#addTglExp").val();
    let filesmp = $("#simpermp").val();
    const flsmp = $("#simpermp").prop("files")[0];
    let nmsimper = $("#nmfilesimper").val();
    let filesmpnm = $("#nmfilesimper").val();
    let filesmpsv = $("#nmfilesimpersv").val();

    // append form data
    let formData = new FormData();
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexp", tglexp);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_kary", auth_kary);
    formData.append("nmsimper", nmsimper);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    let fileSimperName = filesmp.split(".").pop().toLowerCase();
    let fileSimperSize = flsmp["size"];

    if (fileSimperName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Simper yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSimperSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Simper yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Izin_tambang_api/create",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            if (auth_izin == "") {
              $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
            }
            aktifSertifikat();
            $("#colPersonal").collapse("hide");
            $("#colKaryawan").collapse("hide");
            $("#colAdditional").collapse("hide");
            $("#colIzinTambang").collapse("hide");
            $("#colSertifikasi").collapse("show");
            $("#imgIzinTambang").removeClass("d-none");
            $("#nmfilesimper").val(data.filesmp);
            $("#nmfilesimpersv").val(data.filesmpsv);
            $("#btnshowsimper").attr("href", data.linkizin);
            $(".erroraddJenisIzin").html("");
            $(".erroraddNoReg").html("");
            $(".erroraddJenisSIM").html("");
            $(".erroraddTglExpSIM").html("");
            $(".errorFilesimpolisi").html("");
            $(".erroraddTglExp").html("");
            $(".errorsimpermp").html("");
            $(".errorFilesimpolisi").html("");
          } else if (data.statusCode == 201) {
            $(".errormsgizin").removeClass("d-none");
            $(".errormsgizin").removeClass("alert-primary");
            $(".errormsgizin").addClass("alert-danger");
            $(".errormsgizin").html(data.pesan);
          } else {
            $(".erroraddJenisIzin").html(data.jenisizin);
            $(".erroraddNoReg").html(data.noreg);
            $(".erroraddTglExp").html(data.tglexp);
            $(".erroraddJenisSIM").html(data.jenissim);
            $(".erroraddTglExpSIM").html(data.tglexpsim);
            $(".errorsimpermp").html(data.filesmp);
            $(".errorFilesimpolisi").html(data.filesmp);
            swal(
              "Error",
              "Tidak dapat melanjutkan, lengkapi data SIMPER/Mine Permit.",
              "error"
            );
          }
          $.LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizin").html(
              "Terjadi kesalahan saat menyimpan data SIMPER/Mine Permit, hubungi administrator"
            );
          }
          $.LoadingOverlay("hide");
        },
      });

      $(".errormsgizin")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errormsgizin").slideUp(500);
          $(".errormsgizin").addClass("d-none");
        });
    }
    } else {
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_simpol = $(".j8234234b").text();
    let jenisizin = $("#addJenisIzin").val();
    let noreg = $("#addNoReg").val();
    let tglexp = $("#addTglExp").val();
    let jenissim = $("#addJenisSIM").val();
    let tglexpsim = $("#addTglExpSIM").val();
    let filesmp = $("#simpermp").val();
    const flsmp = $("#simpermp").prop("files")[0];
    let filesim = $("#filesimpolisi").val();
    const flsim = $("#filesimpolisi").prop("files")[0];
    let nmsimper = $("#nmfilesimper").val();
    let nmsimpol = $("#nmfilesimpol").val();
    let filesimnm = $("#nmfilesimpol").val();
    let filesimsv = $("#nmfilesimpolsv").val();
    let filesmpnm = $("#nmfilesimper").val();
    let filesmpsv = $("#nmfilesimpersv").val();

    // append form data
    let formData = new FormData();
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("filesimkary", flsim);
    formData.append("filesim", filesim);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexpsim", tglexpsim);
    formData.append("tglexp", tglexp);
    formData.append("jenissim", jenissim);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_kary", auth_kary);
    formData.append("auth_simpol", auth_simpol);
    formData.append("nmsimper", nmsimper);
    formData.append("nmsimpol", nmsimpol);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    let fileSimKaryawanName = filesim.split(".").pop().toLowerCase();
    let fileSimKaryawanSize = flsim["size"];

    let fileSimperName = filesmp.split(".").pop().toLowerCase();
    let fileSimperSize = flsmp["size"];

    if (fileSimKaryawanName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Sim Karyawan yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSimKaryawanSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Sim Karyawan yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else if (fileSimperName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Simper yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSimperSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Simper yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Izin_tambang_api/create",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            if (auth_izin == "") {
              $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
            }
            aktifSertifikat();
            $("#colPersonal").collapse("hide");
            $("#colKaryawan").collapse("hide");
            $("#colAdditional").collapse("hide");
            $("#colIzinTambang").collapse("hide");
            $("#colSertifikasi").collapse("show");
            $("#imgIzinTambang").removeClass("d-none");
            $("#nmfilesimper").val(data.filesmp);
            $("#nmfilesimpersv").val(data.filesmpsv);
            $("#btnshowsimper").attr("href", data.linkizin);
            $(".erroraddJenisIzin").html("");
            $(".erroraddNoReg").html("");
            $(".erroraddJenisSIM").html("");
            $(".erroraddTglExpSIM").html("");
            $(".errorFilesimpolisi").html("");
            $(".erroraddTglExp").html("");
            $(".errorsimpermp").html("");
            $(".errorFilesimpolisi").html("");
          } else if (data.statusCode == 201) {
            $(".errormsgizin").removeClass("d-none");
            $(".errormsgizin").removeClass("alert-primary");
            $(".errormsgizin").addClass("alert-danger");
            $(".errormsgizin").html(data.pesan);
          } else {
            $(".erroraddJenisIzin").html(data.jenisizin);
            $(".erroraddNoReg").html(data.noreg);
            $(".erroraddTglExp").html(data.tglexp);
            $(".erroraddJenisSIM").html(data.jenissim);
            $(".erroraddTglExpSIM").html(data.tglexpsim);
            $(".errorsimpermp").html(data.filesmp);
            $(".errorFilesimpolisi").html(data.filesmp);
            swal(
              "Error",
              "Tidak dapat melanjutkan, lengkapi data SIMPER/Mine Permit.",
              "error"
            );
          }
          $.LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizin").html(
              "Terjadi kesalahan saat menyimpan data SIMPER/Mine Permit, hubungi administrator"
            );
          }
          $.LoadingOverlay("hide");
        },
      });

      $(".errormsgizin")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errormsgizin").slideUp(500);
          $(".errormsgizin").addClass("d-none");
        });
    }
    }
  });

  $("#krycekNonaktif").click(function () {
    let ckkary = $("#krycekNonaktif");
    let prs = $("#perJenisData").val();

    // $('#tbmKaryawan').LoadingOverlay("show");
    if (prs != "") {
      if (ckkary.is(":checked")) {
        ckc = 1;
      } else {
        ckc = 0;
      }
      $("#tbmKaryawan").DataTable().destroy();
      tbKary(prs, ckc);
      // $('#tbmKaryawan').LoadingOverlay("hide");
    }
  });

  $("#addSimpanSertifikasi").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let jenissrt = $("#jenisSertifikasi").val();
    let nosrt = $("#noSertifikat").val();
    let tglsrt = $("#tanggalSertifikasi").val();
    let tglexp = $("#tanggalSertifikasiAkhir").val();
    let namalembaga = $("#namaLembaga").val();
    let filesrt = $("#fileSertifikasi").val();
    const flsert = $("#fileSertifikasi").prop("files")[0];

    let formData = new FormData();
    formData.append("filesertifikat", flsert);
    formData.append("filesrt", filesrt);
    formData.append("jenissrt", jenissrt);
    formData.append("nosrt", nosrt);
    formData.append("tglsrt", tglsrt);
    formData.append("tglexp", tglexp);
    formData.append("namalembaga", namalembaga);
    formData.append("auth_person", auth_person);

    let fileSertifikasiName = filesrt.split(".").pop().toLowerCase();
    let fileSertifikasiSize = flsert["size"];

    if (fileSertifikasiName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Sertifikasi yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSertifikasiSize > 300000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Sertifikasi yang dipilih melebihi 300 kb",
        type: "warning",
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/create_sertifikasi",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#jenisSertifikasi").val("").trigger("change");
            $("#noSertifikat").val("");
            $("#tanggalSertifikasi").val("");
            $("#masaBerlakuSertifikat").val("");
            $("#tanggalSertifikasiAkhir").val("");
            $("#fileSertifikasi").val("");
            $("#namaLembaga").val("");
            $(".errorFileSertifikasi").html("");
            $(".errorjenisSertifikasi").html("");
            $(".errorNoSertifikat").html("");
            $(".errorTanggalSertifikasi").html("");
            $(".errorTanggalSertifikasiAkhir").html("");
            $(".errorFileSertifikasi").html("");
            $(".errorNamaLembaga").html("");
            $("#idsertifikat").LoadingOverlay("show");
            $("#idsertifikat").load(
              site_url + "Karyawan_api/sertifikasi?auth_person=" + auth_person
            );
            swal("Berhasil", "Data sertifikasi berhasil disimpan", "success");
          } else if (data.statusCode == 201) {
            $(".errormsgsertifikasi").removeClass("d-none");
            $(".errormsgsertifikasi").removeClass("alert-primary");
            $(".errormsgsertifikasi").addClass("alert-danger");
            $(".errormsgsertifikasi").html(data.pesan);
          } else {
            $(".errorjenisSertifikasi").html(data.jenissrt);
            $(".errorNoSertifikat").html(data.nosrt);
            $(".errorTanggalSertifikasi").html(data.tglsrt);
            $(".errorTanggalSertifikasiAkhir").html(data.tglexp);
            $(".errorFileSertifikasi").html(data.filesrt);
            $(".errorNamaLembaga").html(data.namalembaga);
            swal(
              "Error",
              "Tidak dapat melanjutkan, lengkapi data sertifikasi.",
              "error"
            );
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgsertifikasi").removeClass("d-none");
          $(".errormsgsertifikasi").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgsertifikasi").html(
              "Terjadi kesalahan saat menyimpan data sertifikat, hubungi administrator"
            );
          }
        },
      });

      $(".errormsgsertifikasi")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errormsgsertifikasi").slideUp(500);
          $(".errormsgsertifikasi").addClass("d-none");
        });
    }
  });

  $("#addKembaliIzinUnit").click(function () {
    $("#colAdditional").collapse("show");
    $("#colIzinTambang").collapse("hide");
  });

  $("#addLanjutSertifikasi").click(function () {
    $.LoadingOverlay("show");
    $("#colPersonal").collapse("hide");
    $("#colKaryawan").collapse("hide");
    $("#colAdditional").collapse("hide");
    $("#colIzinTambang").collapse("hide");
    $("#colSertifikasi").collapse("hide");
    $("#colMCU").collapse("show");
    $("#imgSertifikasi").removeClass("d-none");
    $("#addLanjutMCU").removeClass("disabled");
    aktifMCU();
    $.LoadingOverlay("hide");
  });

  $("#addbtnkembaliSertifikat").click(function () {
    $("#colSertifikasi").collapse("hide");
    $("#colIzinTambang").collapse("show");
  });

  $("#addbtnkembaliMCU").click(function () {
    $("#colMCU").collapse("hide");
    $("#colSertifikasi").collapse("show");
  });

  $("#addUploadMCU").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();
    let tglmcu = $("#tglMCU").val();
    let hasilmcu = $("#hasilMCU").val();
    let ketmcu = $("#ketMCU").val();
    let fileMCU = $("#fileMCU").val();
    const flMCU = $("#fileMCU").prop("files")[0];

    let formData = new FormData();
    formData.append("filemedik", flMCU);
    formData.append("ketmcu", ketmcu);
    formData.append("hasilmcu", hasilmcu);
    formData.append("tglmcu", tglmcu);
    formData.append("auth_person", auth_person);
    formData.append("auth_mcu", auth_mcu);

    let fileMCUName = fileMCU.split(".").pop().toLowerCase();
    let fileMCUSize = flMCU["size"];

    if (fileMCUName != "pdf") {
      swal({
        title: "Informasi",
        text: "File MCU yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileMCUSize > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File MCU yang dipilih melebihi 1000 kb/1mb",
        type: "warning",
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/create_mcu",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $(".errorTglMCU").html("");
            $(".errorHasilMCU").html("");
            $(".errorKetMCU").html("");
            $(".errorFileMCU").html("");
            $("#imgMCU").removeClass("d-none");
            $("#addbtnkembaliMCU").removeClass("disabled");
            $("#addLanjutMCU").removeClass("disabled");
            $("#addTampilkanMCU").removeClass("disabled");
            $("#addTampilkanMCU").attr("href", data.link);
            $("#addHapusMCU").removeClass("disabled");
            $(".90dea748042796037c02b4cf2b388b03").text(data.auth_mcu);
            swal("Berhasil", data.pesan, "success");
          } else if (data.statusCode == 201) {
            $(".errormsgmcu").removeClass("d-none");
            $(".errormsgmcu").removeClass("alert-primary");
            $(".errormsgmcu").addClass("alert-danger");
            $(".errormsgmcu").html(data.pesan);
          } else {
            $(".errorTglMCU").html(data.tglmcu);
            $(".errorHasilMCU").html(data.hasilmcu);
            $(".errorKetMCU").html(data.ketmcu);

            if (fileMCU == "") {
              $(".errorFileMCU").html("File MCU wajib di-upload");
            } else {
              $(".errorFileMCU").html(data.filmcu);
            }

            swal(
              "Error",
              "Tidak dapat melanjutkan, lengkapi data Medical Check Up (MCU).",
              "error"
            );
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgmcu").removeClass("d-none");
          $(".errormsgmcu").addClass("alert-danger");
          if (thrownError != "") {
            $(".errMCU").html(
              "Terjadi kesalahan saat menyimpan data MCU, hubungi administrator"
            );
          }
        },
      });

      $(".errormsgmcu")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errormsgmcu").slideUp(500);
          $(".errormsgmcu").addClass("d-none");
        });
    }
  });

  $("#addLanjutMCU").click(function () {
    $.LoadingOverlay("show");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

    let formData = new FormData();
    formData.append("auth_person", auth_person);
    formData.append("auth_mcu", auth_mcu);

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/check_mcu",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#colVaksin").collapse("show");
          $("#colMCU").collapse("hide");
          aktifVaksin();
        } else {
          $(".errormsgmcu").removeClass("d-none");
          $(".errormsgmcu").removeClass("alert-primary");
          $(".errormsgmcu").addClass("alert-danger");
          $(".errormsgmcu").html(data.pesan);
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsgmcu").removeClass("d-none");
        $(".errormsgmcu").addClass("alert-danger");
        if (thrownError != "") {
          $(".errMCU").html(
            "Terjadi kesalahan saat load data MCU, hubungi administrator"
          );
        }
        $.LoadingOverlay("hide");
      },
    });

    $(".errormsgmcu")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgmcu").slideUp(500);
        $(".errormsgmcu").addClass("d-none");
      });
  });

  $("#addHapusMCU").click(function () {
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

    if (auth_mcu != "") {
      swal({
        title: "Hapus MCU",
        text: "Yakin data MCU akan dihapus? termasuk file yang telah di-upload",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Karyawan_api/delete_mcu",
            data: {
              auth_mcu: auth_mcu,
            },
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $("#tglMCU").val("");
                $("#hasilMCU").val("");
                $("#ketMCU").val("");
                $("#fileMCU").val("");
                $(".errorTglMCU").text("");
                $(".errorHasilMCU").text("");
                $(".errorKetMCU").text("");
                $(".errorFileMCU").text("");
                $("#addTampilkanMCU").attr("href", "#!");
                $("#imgMCU").addClass("d-none");
                $("#addTampilkanMCU").addClass("disabled");
                $("#addHapusMCU").addClass("disabled");
                $(".90dea748042796037c02b4cf2b388b03").text("");
                $.LoadingOverlay("hide");
                swal("Berhasil", data.pesan, "success");
              } else if (data.statusCode == 201) {
                swal("Error", data.pesan, "error");
                $.LoadingOverlay("hide");
              } else {
                $(".errormsgmcu").removeClass("d-none");
                $(".errormsgmcu").removeClass("alert-primary");
                $(".errormsgmcu").addClass("alert-danger");
                $(".errormsgmcu").html(data.pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".errormsgmcu").removeClass("d-none");
              $(".errormsgmcu").addClass("alert-danger");
              if (thrownError != "") {
                $(".errormsgmcu").html(
                  "Terjadi kesalahan saat menghapus data MCU, hubungi administrator"
                );
              }
            },
          });
        } else {
          swal.close();
        }
      });
    } else {
      $(".errormsgmcu").removeClass("d-none");
      $(".errormsgmcu").removeClass("alert-primary");
      $(".errormsgmcu").addClass("alert-danger");
      $(".errormsgmcu").html("Belum ada data MCU yang disimpan");
    }

    $(".errormsgmcu")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgmcu").slideUp(500);
        $(".errormsgmcu").addClass("d-none");
      });
  });

  $("#addbtnkembalivaksin").click(function () {
    $("#colVaksin").collapse("hide");
    $("#colMCU").collapse("show");
  });

  $("#addLanjutkanVaksin").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/check_vaksin",
      data: {
        auth_person: auth_person,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#colVaksin").collapse("hide");
          $("#colFilePendukung").collapse("show");
          $("#imgVaksin").removeClass("d-none");
          aktifFilePendukung();
        } else if (data.statusCode == 201) {
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data vaksin",
            "error"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgvaksin").removeClass("d-none");
        $(".errormsgvaksin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgvaksin").html(
            "Terjadi kesalahan saat load data vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#addResetVaksin").click(function () {
    $("#jnsVaksin").LoadingOverlay("show");
    $("#nmVaksin").LoadingOverlay("show");
    $("#tglVaksin").LoadingOverlay("show");
    $("#jenisVaksin").val("").trigger("change");
    $("#namaVaksin").val("").trigger("change");
    $("#tanggalVaksin").val("");
    $("#jnsVaksin").LoadingOverlay("hide");
    $("#nmVaksin").LoadingOverlay("hide");
    $("#tglVaksin").LoadingOverlay("hide");
  });

  $("#addSimpanVaksin").click(function () {
    $.LoadingOverlay("show");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let jenisvaksin = $("#jenisVaksin").val();
    let namavaksin = $("#namaVaksin").val();
    let tglvaksin = $("#tanggalVaksin").val();

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/create_vaksin",
      data: {
        jenisvaksin: jenisvaksin,
        namavaksin: namavaksin,
        tglvaksin: tglvaksin,
        auth_person: auth_person,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#idvaksin").LoadingOverlay("show");
          $("#idvaksin").load(
            site_url + "Karyawan_api/vaksin?auth_person=" + auth_person
          );
          $("#jenisVaksin").val("").trigger("change");
          $("#namaVaksin").val("").trigger("change");
          $("#tanggalVaksin").val("");
          swal("Berhasil", "Data vaksin berhasil disimpan", "success");
        } else if (data.statusCode == 201) {
          $(".errormsgvaksin").removeClass("d-none");
          $(".errormsgvaksin").removeClass("alert-primary");
          $(".errormsgvaksin").addClass("alert-danger");
          $(".errormsgvaksin").html(data.pesan);
        } else {
          $(".errorJenisVaksin").html(data.jenisvaksin);
          $(".errorNamaVaksin").html(data.namavaksin);
          $(".errorTanggalVaksin").html(data.tglvaksin);
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsgvaksin").removeClass("d-none");
        $(".errormsgvaksin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgvaksin").html(
            "Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator"
          );
        }
        $.LoadingOverlay("hide");
      },
    });

    $(".errormsgvaksin")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgvaksin").slideUp(500);
        $(".errormsgvaksin").addClass("d-none");
      });
  });

  $("#addbtnkembaliFile").click(function () {
    $("#colFilePendukung").collapse("hide");
    $("#colVaksin").collapse("show");
  });

  $("#addUploadFileSelesai").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();
    let filefoto = $("#filePasFoto").val();
    const flfoto = $("#filePasFoto").prop("files")[0];
    let filepdukung = $("#filePendukung").val();
    const fldukung = $("#filePendukung").prop("files")[0];
    let extfoto = filefoto.split(".").pop().toLowerCase();
    let fotoSize = flfoto["size"];
    let extdukung = filepdukung.split(".").pop().toLowerCase();
    let filePendukungSize = fldukung["size"];

    if (extfoto != "jpg") {
      swal("Informasi", "Foto karyawan yang dipilih bukan jpg", "info");
    } else if (extdukung != "pdf") {
      swal("Informasi", "File pendukung yang dipilih bukan pdf", "info");
    } else if (fotoSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran Foto yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else if (filePendukungSize > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Pendukung yang dipilih melebihi 1000 kb/1mb",
        type: "warning",
      });
    } else {
      if (filepdukung == "") {
        $errdukung = "File pendukung wajib di-upload";
      } else {
        $errdukung = "";
      }

      if (filefoto == "") {
        $errfoto = "File foto wajib di-upload";
      } else {
        $errfoto = "";
      }

      if ($errdukung == "" && $errfoto == "") {
        swal({
          title: "Simpan Data",
          text: "Yakin data karyawan telah lengkap dan benar?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("fldukung", fldukung);
            formData.append("filepdukung", filepdukung);
            formData.append("flfoto", flfoto);
            formData.append("filefoto", filefoto);
            formData.append("auth_person", auth_person);
            formData.append("auth_kary", auth_kary);
            formData.append("auth_izin", auth_izin);
            formData.append("auth_mcu", auth_mcu);

            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/check_file",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Sukses",
                    text: "Data karyawan berhasil disimpan",
                    type: "success",
                    confirmButtonColor: "#36c6d3",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok",
                  }).then(function (result) {
                    if (result.value) {
                      $.LoadingOverlay("hide");
                      $(".errorFilePendukung").html("");
                      $("#fileUpload").val("");
                      $(".noktpshow").val("");
                      $(".namalengkapshow").val("");
                      window.location.href = site_url + "tambah_karyawan";
                    } else {
                      $.LoadingOverlay("hide");
                      $(".errorFilePendukung").html("");
                      $("#fileUpload").val("");
                      $(".noktpshow").val("");
                      $(".namalengkapshow").val("");
                      window.location.href = site_url + "tambah_karyawan";
                    }

                    $.LoadingOverlay("hide");
                  });
                } else if (data.statusCode == 202) {
                  $.LoadingOverlay("hide");
                  $(".errorfilePasFoto").text(data.filefoto);
                  $(".errorFilePendukung").text(data.filedukung);
                } else {
                  $.LoadingOverlay("hide");
                  swal("Error", data.pesan, "error");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errmsgfilependukung").removeClass("d-none");
                $(".errmsgfilependukung").addClass("alert-danger");
                if (thrownError != "") {
                  $(".errmsgfilependukung").html(
                    "Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator"
                  );
                }
              },
            });
            $.LoadingOverlay("hide");
          } else {
            swal.close();
          }
        });
      } else {
        $(".errorfilePasFoto").text($errfoto);
        $(".errorFilePendukung").text($errdukung);
      }
    }
  });

  $("#infoKlasifikasi").click(function () {
    $("#mdlinfoklasifikasi").modal("show");
  });

  $("#btnuploadulangser").click(function () {
    let auth_ser = $(".9f7fjmuj8ik2js4n8k66g3hjl323").text();
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let filesrt = $("#fileSertifikasiUlang").val();
    const flsert = $("#fileSertifikasiUlang").prop("files")[0];

    let fileSertifikasiName = filesrt.split(".").pop().toLowerCase();
    let fileSertifikasiSize = flsert["size"];

    if (fileSertifikasiName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Sertifikasi yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileSertifikasiSize > 300000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Sertifikasi yang dipilih melebihi 300 kb",
        type: "warning",
      });
    } else {
      if (filesrt == "") {
        $(".errorFileSertifikasiUlang").text("File sertifikat wajib dipilih");
        return false;
      } else {
        swal({
          title: "Upload Ulang Sertifikat",
          text: "Yakin sertifikat akan di-upload ulang",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            let formData = new FormData();
            formData.append("filesertifikat", flsert);
            formData.append("filesrt", filesrt);
            formData.append("auth_ser", auth_ser);
            formData.append("auth_person", auth_person);
            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/upload_sertifikasi",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdluploadulangser").modal("hide");
                  $("#fileSertifikasiUlang").val("");
                  $(".errorFileSertifikasiUlang").text("");
                  $(".9f7fjmuj8ik2js4n8k66g3hjl323").text("");
                  $.LoadingOverlay("hide");
                  $("#idsertifikat").LoadingOverlay("show");
                  $("#idsertifikat").load(
                    site_url +
                      "Karyawan_api/sertifikasi?auth_person=" +
                      auth_person
                  );
                } else if (data.statusCode == 201) {
                  $(".erruploadulangser").removeClass("d-none");
                  $(".erruploadulangser").removeClass("alert-primary");
                  $(".erruploadulangser").addClass("alert-danger");
                  $(".erruploadulangser").html(data.pesan);
                  $.LoadingOverlay("hide");
                } else {
                  $(".errorFileSertifikasiUlang").html(data.pesan);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".erruploadulangser").removeClass("d-none");
                $(".erruploadulangser").addClass("alert-danger");
                if (thrownError != "") {
                  $(".erruploadulangser").html(
                    "Terjadi kesalahan saat meng-upload data sertifikat, hubungi administrator"
                  );
                }
              },
            });
          } else {
            swal.close();
          }
        });
      }
    }
  });

  $(document).on("click", ".detailKeluarga", function () {
    let auth = $(this).attr("id");

    let splitData = auth.split(",");

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Keluarga_api/detail",
      data: {
        auth: splitData[0],
        tipe: splitData[1],
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          if (splitData[1] == 0) {
            $("#detailDataKeluarga").text("Detail Data Pasangan");
          } else {
            $("#detailDataKeluarga").text(
              `Detail Data Anak Ke ${splitData[1]}`
            );
          }
          $("#detailKeluargaNIK").val(data.nik);
          $("#detailKeluargaNama").val(data.nama);
          $("#detailKeluargaNamaIbu").val(data.ibu);
          $("#detailKeluargaNamaAyah").val(data.ayah);
          if (data.jenis_kelamin == "L") {
            $("#detailKeluargaJenisKelamin").val("Laki-Laki");
          } else {
            $("#detailKeluargaJenisKelamin").val("Perempuan");
          }
          $("#detailKeluargaTempatLahir").val(data.tempat);
          $("#detailKeluargaTanggalLahir").val(
            formatIndonesianDate(data.tanggal)
          );
          $("#detailKeluargaBPJS").val(data.bpjs);
          if (data.status == "T") {
            $("#detailKeluargaStatusBPJS").val("AKTIF");
          } else {
            $("#detailKeluargaStatusBPJS").val("NONAKTIF");
          }
          $("#detailKeluargaELI").val(data.eli);
          $("#detailKeluargaHP").val(data.nohp);
          $("#detailKeluarga").modal("show");
          $.LoadingOverlay("hide");
        } else {
          $.LoadingOverlay("hide");
          swal("Gagal", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat menampilkan data keluarga, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".editKeluarga", function () {
    let auth = $(this).attr("id");

    let splitData = auth.split(",");

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Keluarga_api/detail",
      data: {
        auth: splitData[0],
        tipe: splitData[1],
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          if (splitData[1] == 0) {
            $("#updateTitleKeluarga").text("Edit Data Pasangan");
          } else {
            $("#updateTitleKeluarga").text(`Edit Data Anak Ke ${splitData[1]}`);
          }
          $("#updateKeluargaTipe").val(splitData[1]);
          $("#updateKeluargaNIK").val(data.nik);
          $("#updateKeluargaNama").val(data.nama);
          $("#updateKeluargaNamaIbu").val(data.ibu);
          $("#updateKeluargaNamaAyah").val(data.ayah);
          $("#updateKeluargaJenisKelamin")
            .val(data.jenis_kelamin)
            .trigger("change");
          $("#updateKeluargaTempatLahir").val(data.tempat);
          $("#updateKeluargaTanggalLahir").val(data.tanggal);
          $("#updateKeluargaBPJS").val(data.bpjs);
          $("#updateKeluargaStatusBPJS").val(data.status).trigger("change");
          $("#updateKeluargaELI").val(data.eli);
          $("#updateKeluargaHP").val(data.nohp);
          $("#updateKeluarga").modal("show");
          $.LoadingOverlay("hide");
        } else {
          $.LoadingOverlay("hide");
          swal("Gagal", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat menampilkan data keluarga, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".hapusKeluarga", function () {
    let auth = $(this).attr("id");
    let nama = $(this).attr("value");

    let splitData = auth.split(",");

    swal({
      title: "Hapus Keluarga",
      text: "Yakin data " + nama + " akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#dataKeluarga").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Keluarga_api/delete",
          data: {
            auth: splitData[0],
            tipe: splitData[1],
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#dataKeluarga").load(
                site_url + "Keluarga_api/data?auth=" + splitData[0]
              );
              $("#dataKeluarga").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $("#dataKeluarga").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#dataKeluarga").LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat menghapus data keluarga, hubungi administrator"
              );
            }

            $(".errormsg")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".errormsg").slideUp(500);
                $(".errormsg").addClass("d-none");
              });
          },
        });
      }
    });
  });

  // Change Event
  $("#filesimpolisi").change(function () {
    const filee = $("#filesimpolisi").prop("files")[0];
    if (filee.name === "") {
      $("#lblsimpolisi").text("Pilih file SIM Polisi");
    } else {
      $("#lblsimpolisi").text(filee.name);
    }
  });

  $("#simpermp").change(function () {
    const filee = $("#simpermp").prop("files")[0];
    if (filee.name === "") {
      $("#lblsimpermp").text("Pilih SIMPER/MINE PERMIT");
    } else {
      $("#lblsimpermp").text(filee.name);
    }
  });

  $("#filePasFoto").change(function () {
    const filee = $("#filePasFoto").prop("files")[0];
    if (filee.name === "") {
      $("#lblfilePasFoto").text("Pilih file foto karyawan");
    } else {
      $("#lblfilePasFoto").text(filee.name);
    }
  });

  $("#filePendukung").change(function () {
    const filee = $("#filePendukung").prop("files")[0];
    if (filee.name === "") {
      $("#lblfilePendukung").text("Pilih file pendukung");
    } else {
      $("#lblfilePendukung").text(filee.name);
    }
  });

  $("#addStatusKaryawan").change(function () {
    $("#addTanggalPermanen").val("");
    $("#addTanggalKontrakAwal").val("");
    $("#addTanggalKontrakAkhir").val("");
    let stat_kary = $("#addStatusKaryawan").val();

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/get_stat_waktu",
      data: {
        stat_kary: stat_kary,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          if (data.stat_waktu == "T") {
            $("#addFieldPermanen").addClass("d-none");
            $("#addFieldKontrakAwal").removeClass("d-none");
            $("#addFieldKontrakAkhir").removeClass("d-none");
          } else if (data.stat_waktu == "F") {
            $("#addFieldPermanen").removeClass("d-none");
            $("#addFieldKontrakAwal").addClass("d-none");
            $("#addFieldKontrakAkhir").addClass("d-none");
          }
        } else {
          $("#erroraddStatusKaryawan").html(data.pesan);
          $("#addFieldPermanen").addClass("d-none");
          $("#addFieldKontrakAwal").addClass("d-none");
          $("#addFieldKontrakAkhir").addClass("d-none");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status karyawan hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#addagama").change(function () {
    let agama = $("#addagama").val();

    if (agama != "") {
      $(".errorAddAgama").html("");
    } else {
      $(".errorAddAgama").html("<p>Agama wajib dipilih</p>");
    }
  });

  $("#jenisKelamin").change(function () {
    let jk = $("#jenisKelamin").val();
    if (jk != "") {
      $(".errorJenisKelamin").html("");
    } else {
      $(".errorJenisKelamin").html("<p>Jenis kelamin wajib dipilih</p>");
    }
  });

  $("#statPernikahan").change(function () {
    let stkw = $("#statPernikahan").val();
    if (stkw != "") {
      $(".errorStatPernikahan").html("");
    } else {
      $(".errorStatPernikahan").html("<p>Kelurahan wajib dipilih</p>");
    }
  });

  $("#kewarganegaraan").change(function () {
    let warga = $("#kewarganegaraan").val();
    if (warga != "") {
      $(".errorKewarganegaraan").html("");
    } else {
      $(".errorKewarganegaraan").html("<p>Warga negara wajib dipilih</p>");
    }
  });

  $("#addPerKary").change(function () {
    let auth_per = $("#addPerKary").val();
    let auth_cek = $(".89kjm78ujki782m4x787909h3").text();

    if (auth_per != "") {
      if (auth_per_old != "") {
        if (auth_per != auth_per_old) {
          swal({
            title: "Ganti Perusahaan",
            text: "Mengganti perusahaan akan me-reset beberapa data karyawan, yakin akan diganti?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#36c6d3",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ganti perusahaan",
            cancelButtonText: "Batalkan",
          }).then(function (result) {
            if (result.value) {
              $.LoadingOverlay("show");
              auth_per_old = auth_per;
              get_data_kary(auth_per);

              // Reset Section
              $("#addSectionKary").html(
                '<option value="">-- PILIH DEPARTEMEN --</option>'
              );
              $("#addSectionKary").attr("disabled", true);
              $("#refreshSection").attr("disabled", true);

              // Reset Posisi
              $("#addPosisiKary").html(
                '<option value="">-- PILIH DEPARTEMEN --</option>'
              );
              $("#addPosisiKary").attr("disabled", true);
              $("#refreshPosisi").attr("disabled", true);

              // Reset Grade
              $("#addGrade").html(
                '<option value="">-- PILIH LEVEL --</option>'
              );
              $("#addGrade").attr("disabled", true);
              $("#refreshGrade").attr("disabled", true);

              $.LoadingOverlay("hide");
            } else if (result.dismiss == "cancel") {
              swal(
                "Perusahaan batal diganti!",
                "Silakan isi ulang beberapa data karyawan",
                "info"
              );
              $("#addPerKary").val(auth_per_old).trigger("change");
              get_data_kary(auth_per_old);
            } else {
              swal.close();
            }
          });
        } else {
          $.LoadingOverlay("show");
          get_data_kary(auth_per);

          // Reset Section
          $("#addSectionKary").html(
            '<option value="">-- PILIH DEPARTEMEN --</option>'
          );
          $("#addSectionKary").attr("disabled", true);
          $("#refreshSection").attr("disabled", true);

          // Reset Posisi
          $("#addPosisiKary").html(
            '<option value="">-- PILIH DEPARTEMEN --</option>'
          );
          $("#addPosisiKary").attr("disabled", true);
          $("#refreshPosisi").attr("disabled", true);

          // Reset Grade
          $("#addGrade").html('<option value="">-- PILIH LEVEL --</option>');
          $("#addGrade").attr("disabled", true);
          $("#refreshGrade").attr("disabled", true);

          $.LoadingOverlay("hide");
        }
      } else {
        $.LoadingOverlay("show");
        get_data_kary(auth_per);
        auth_per_old = auth_per;
        if (auth_cek == "") {
          $("#colPersonal").collapse("show");
          $("#colKaryawan").collapse("hide");
          $("#colAdditional").collapse("hide");
          $("#colIzinTambang").collapse("hide");
          $("#colSertifikasi").collapse("hide");
          $("#colMCU").collapse("hide");
          $("#colVaksin").collapse("hide");
          $("#colFilePendukung").collapse("hide");
        }
        $.LoadingOverlay("hide");
      }
    } else {
      $("#addDepartKary").html(
        '<option value="">-- PILIH PERUSAHAAN --</option>'
      );
      $("#addSectionKary").html(
        '<option value="">-- PILIH DEPARTEMEN --</option>'
      );
      $("#addPosisiKary").html(
        '<option value="">-- PILIH DEPARTEMEN --</option>'
      );
      $("#addLevelKary").html(
        '<option value="">-- PILIH PERUSAHAAN --</option>'
      );
      $("#addRoster").html('<option value="">-- PILIH PERUSAHAAN --</option>');
      $("#addGrade").html('<option value="">-- PILIH LEVEL --</option>');
      $("#addDepartKary").attr("disabled", true);
      $("#addSectionKary").attr("disabled", true);
      $("#addPosisiKary").attr("disabled", true);
      $("#addLevelKary").attr("disabled", true);
      $("#addRoster").attr("disabled", true);
      $("#addGrade").attr("disabled", true);
      $("#refreshDepart").attr("disabled", true);
      $("#refreshSection").attr("disabled", true);
      $("#refreshPosisi").attr("disabled", true);
      $("#refreshLevel").attr("disabled", true);
      $("#refreshGrade").attr("disabled", true);
      $("#refreshRoster").attr("disabled", true);
    }
  });

  $("#tanggalLahir").change(function () {
    let tgl_lahir = $("#tanggalLahir").val().trim();

    if (tgl_lahir != "") {
      $(".errorTanggalLahir").html("");
    } else {
      $(".errorTanggalLahir").html("<p>Tanggal lahir wajib diisi</p>");
    }
  });

  $("#addJenisIzin").change(function () {
    let jenisizin = $("#addJenisIzin").val();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

    if (auth_izin != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Izin_tambang_api/check_jenisizin",
        data: {
          auth_izin: auth_izin,
          jenisizin: jenisizin,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            swal({
              title: "Ganti Jenis Izin",
              text: data.pesan,
              type: "question",
              showCancelButton: true,
              confirmButtonColor: "#36c6d3",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, ganti",
              cancelButtonText: "Batalkan",
            }).then(function (result) {
              if (result.value) {
                if (data.auth_izn == 1) {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "Izin_tambang_api/delete_all",
                    data: {
                      auth_izin: auth_izin,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsim").addClass("d-none");
                      $("#txtunit").addClass("d-none");
                      $("#addTglExpSIM").val("");
                      $(".simperunit").collapse("hide");
                      $("#addJenisSIM").val("").trigger("change");
                      $("#idizintambang").LoadingOverlay("show");
                      $("#idizintambang").load(
                        site_url + "Karyawan_api/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343030bbbafcb").text("");
                      $("#addNoReg").val("");
                      $("#addTglExp").val("");
                      $("#addTglExpSIM").val("");
                      $("#nmfilesimpol").val("");
                      $("#nmfilesimpolsv").val("");
                      $("#nmfilesimper").val("");
                      $("#nmfilesimpersv").val("");
                      $("#lblsimpolisi").text(rsdata.filesim);
                      $("#lblsimpermp").text(rsdata.filesmp);
                      $("#nmfilesimpersv").val("");
                      $("#btnshowsimpol").attr("href", "#!");
                      $("#btnshowsimpol").attr("disabled", true);
                      $("#btnshowsimper").attr("href", "#!");
                      $("#btnshowsimper").attr("disabled", true);
                      $(".j8234234b").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizin").removeClass("d-none");
                      $(".errormsgizin").removeClass("alert-info");
                      $(".errormsgizin").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizin").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                } else {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "Izin_tambang_api/delete_all",
                    data: {
                      auth_izin: auth_izin,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsim").addClass("d-none");
                      $("#txtunit").addClass("d-none");
                      $("#addTglExpSIM").val("");
                      $(".simperunit").collapse("hide");
                      $("#addJenisSIM").val("").trigger("change");
                      $("#idizintambang").LoadingOverlay("show");
                      $("#idizintambang").load(
                        site_url + "Karyawan_api/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343030bbbafcb").text("");
                      $("#addNoReg").val("");
                      $("#addTglExp").val("");
                      $("#addTglExpSIM").val("");
                      $("#nmfilesimpol").val("");
                      $("#nmfilesimpolsv").val("");
                      $("#nmfilesimper").val("");
                      $("#nmfilesimpersv").val("");
                      $("#lblsimpolisi").text(rsdata.filesim);
                      $("#lblsimpermp").text(rsdata.filesmp);
                      $("#nmfilesimpersv").val("");
                      $("#btnshowsimpol").attr("href", "#!");
                      $("#btnshowsimpol").attr("disabled", true);
                      $("#btnshowsimper").attr("href", "#!");
                      $("#btnshowsimper").attr("disabled", true);
                      $(".j8234234b").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizin").removeClass("d-none");
                      $(".errormsgizin").removeClass("alert-info");
                      $(".errormsgizin").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizin").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                }
              } else if (result.dismiss == "cancel") {
                swal("Batal", "Jenis izin batal diganti", "info");
                $("#addJenisIzin").val(rsdata.jns).trigger("change");
              }
            });
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").removeClass("alert-info");
          $(".errormsgizin").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizin").html(
              "Terjadi kesalahan saat load data SIM, hubungi administrator"
            );
          }
        },
      });
    }

    if (jenisizin == 2) {
      $("#txtsim").removeClass("d-none");
      $("#txtunit").removeClass("d-none");
      $(".simperunit").collapse("show");
    } else {
      $("#txtsim").addClass("d-none");
      $("#txtunit").addClass("d-none");
      $(".simperunit").collapse("hide");
    }
  });

  $("#addJenisIzinnew").change(function () {
    let jenisizin = $("#addJenisIzinnew").val();
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();

    if (auth_izin != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Izin_tambang_api/check_jenisizin",
        data: {
          auth_izin: auth_izin,
          jenisizin: jenisizin,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            swal({
              title: "Ganti Jenis Izin",
              text: data.pesan,
              type: "question",
              showCancelButton: true,
              confirmButtonColor: "#36c6d3",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, ganti",
              cancelButtonText: "Batalkan",
            }).then(function (result) {
              if (result.value) {
                if (data.auth_izn == 1) {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "Izin_tambang_api/delete_all",
                    data: {
                      auth_izin: auth_izin,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsimnew").addClass("d-none");
                      $("#txtunitnew").addClass("d-none");
                      $("#addTglExpSIMnew").val("");
                      $(".simperunitnew").collapse("hide");
                      $("#addJenisSIMnew").val("").trigger("change");
                      $("#idizintambangnew").LoadingOverlay("show");
                      $("#idizintambangnew").load(
                        site_url + "Karyawan_api/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
                      $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text("");
                      $("#addNoRegnew").val("");
                      $("#addTglExpnew").val("");
                      $("#addTglExpSIMnew").val("");
                      $("#nmfilesimpolnew").val("");
                      $("#nmfilesimpolsvnew").val("");
                      $("#nmfilesimpernew").val("");
                      $("#nmfilesimpersvnew").val("");
                      $("#lblsimpolisinew").text(rsdata.filesim);
                      $("#lblsimpermpnew").text(rsdata.filesmp);
                      $("#nmfilesimpersvnew").val("");
                      $("#btnshowsimpolnew").attr("href", "#!");
                      $("#btnshowsimpolnew").attr("disabled", true);
                      $("#btnshowsimpernew").attr("href", "#!");
                      $("#btnshowsimpernew").attr("disabled", true);
                      $(".n234b5b7").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizinnew").removeClass("d-none");
                      $(".errormsgizinnew").removeClass("alert-info");
                      $(".errormsgizinnew").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizinnew").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                } else {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "Izin_tambang_api/delete_all",
                    data: {
                      auth_izin: auth_izin,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsimnew").addClass("d-none");
                      $("#txtunitnew").addClass("d-none");
                      $("#addTglExpSIMnew").val("");
                      $(".simperunitnew").collapse("hide");
                      $("#addJenisSIMnew").val("").trigger("change");
                      $("#idizintambangnew").LoadingOverlay("show");
                      $("#idizintambangnew").load(
                        site_url + "Karyawan_api/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
                      $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text("");
                      $("#addNoRegnew").val("");
                      $("#addTglExpnew").val("");
                      $("#addTglExpSIMnew").val("");
                      $("#nmfilesimpolnew").val("");
                      $("#nmfilesimpolsvnew").val("");
                      $("#nmfilesimpernew").val("");
                      $("#nmfilesimpersvnew").val("");
                      $("#lblsimpolisinew").text(rsdata.filesim);
                      $("#lblsimpermpnew").text(rsdata.filesmp);
                      $("#nmfilesimpersvnew").val("");
                      $("#btnshowsimpolnew").attr("href", "#!");
                      $("#btnshowsimpolnew").attr("disabled", true);
                      $("#btnshowsimpernew").attr("href", "#!");
                      $("#btnshowsimpernew").attr("disabled", true);
                      $(".n234b5b7").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizinnew").removeClass("d-none");
                      $(".errormsgizinnew").removeClass("alert-info");
                      $(".errormsgizinnew").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizinnew").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                }
              } else if (result.dismiss == "cancel") {
                swal("Batal", "Jenis izin batal diganti", "info");
                $("#addJenisIzinnew").val(rsdata.jns).trigger("change");
              }
            });
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-info");
          $(".errormsgizinnew").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizinnew").html(
              "Terjadi kesalahan saat load data SIM, hubungi administrator"
            );
          }
        },
      });
    }

    if (jenisizin == 2) {
      $("#txtsimnew").removeClass("d-none");
      $("#txtunitnew").removeClass("d-none");
      $(".simperunitnew").collapse("show");
    } else {
      $("#txtsimnew").addClass("d-none");
      $("#txtunitnew").addClass("d-none");
      $(".simperunitnew").collapse("hide");
    }
  });

  $("#addTglExpSIM").change(function () {
    let tglsim = $("#addTglExpSIM").val();

    $.ajax({
      type: "POST",
      url: site_url + "Izin_tambang_api/tgl_exp_izin",
      data: {
        tglsim: tglsim,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#addTglExp").val(data.tglexpizin);
          $("#addTglExp").removeAttr("disabled");
          $(".errormsgizin").addClass("d-none");
        } else {
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").removeClass("alert-info");
          $(".errormsgizin").addClass("alert-danger");
          $(".errormsgizin").html(data.pesan);
          $("#addTglExp").val("");
          $("#addTglExp").attr("disabled", true);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizin").removeClass("d-none");
        $(".errormsgizin").removeClass("alert-info");
        $(".errormsgizin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizin").html(
            "Terjadi kesalahan saat membuat tanggal izin"
          );
        }
      },
    });
  });

  $("#addTglExpSIMnew").change(function () {
    let tglsim = $("#addTglExpSIMnew").val();

    $.ajax({
      type: "POST",
      url: site_url + "Izin_tambang_api/tgl_exp_izin",
      data: {
        tglsim: tglsim,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#addTglExpnew").val(data.tglexpizin);
          $("#addTglExpnew").removeAttr("disabled");
          $(".errormsgizinnew").addClass("d-none");
        } else {
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-info");
          $(".errormsgizinnew").addClass("alert-danger");
          $(".errormsgizinnew").html(data.pesan);
          $("#addTglExpnew").val("");
          $("#addTglExpnew").attr("disabled", true);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat membuat tanggal expired izin"
          );
        }
      },
    });

    $(".errormsgizinnew")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgizinnew").slideUp(500);
        $(".errormsgizinnew").addClass("d-none");
      });
  });

  $("#addDepartKary").change(function () {
    let auth_depart = $("#addDepartKary").val();

    if (auth_depart != "") {
      $("#txtsectionkary").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Section_api/options",
        data: {
          auth_depart: auth_depart,
        },
        success: function (response) {
          $("#addSectionKary").removeAttr("disabled");
          $("#refreshSection").removeAttr("disabled");
          var data = JSON.parse(response);
          $("#addSectionKary").html(data.section);
          $("#txtsectionkary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtsectionkary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data section, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });

      $("#txtposisikary").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Posisi_api/options",
        data: {
          auth_depart: auth_depart,
        },
        success: function (response) {
          $("#addPosisiKary").removeAttr("disabled");
          $("#refreshPosisi").removeAttr("disabled");
          var data = JSON.parse(response);
          $("#addPosisiKary").html(data.posisi);
          $("#txtposisikary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtposisikary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data posisi, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      $("#addSectionKary").html(
        '<option value="">-- PILIH DEPARTEMEN --</option>'
      );
      $("#addSectionKary").attr("disabled", true);
      $("#refreshSection").attr("disabled", true);
      $("#addPosisiKary").html(
        '<option value="">-- PILIH DEPARTEMEN --</option>'
      );
      $("#addPosisiKary").attr("disabled", true);
      $("#refreshPosisi").attr("disabled", true);
    }
  });

  $("#addLevelKary").change(function () {
    let auth_level = $("#addLevelKary").val();

    if (auth_level != "") {
      $("#txtgrade").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Grade_api/options",
        data: {
          auth_level: auth_level,
        },
        success: function (response) {
          $("#addGrade").removeAttr("disabled");
          $("#refreshGrade").removeAttr("disabled");
          var data = JSON.parse(response);
          $("#addGrade").html(data.grade);
          $("#txtgrade").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtgrade").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data grade, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      $("#addGrade").html('<option value="">-- PILIH LEVEL --</option>');
      $("#addGrade").attr("disabled", true);
      $("#refreshGrade").attr("disabled", true);
    }
  });

  $("#masaBerlakuSertifikat").change(function () {
    let tglsrt = $("#tanggalSertifikasi").val();
    let masa = parseInt($("#masaBerlakuSertifikat").val());

    let tglsrtDate = new Date(tglsrt);

    tglsrtDate.setFullYear(tglsrtDate.getFullYear() + masa);

    let tglexp = tglsrtDate.toISOString().split("T")[0];
    $("#tanggalSertifikasiAkhir").val(tglexp);
  });

  $("#tanggalSertifikasi").change(function () {
    let tglsrt = $("#tanggalSertifikasi").val();
    let masa = parseInt($("#masaBerlakuSertifikat").val());

    let tglsrtDate = new Date(tglsrt);

    tglsrtDate.setFullYear(tglsrtDate.getFullYear() + masa);

    let tglexp = tglsrtDate.toISOString().split("T")[0];
    $("#tanggalSertifikasiAkhir").val(tglexp);
  });

  $("#keluargaTipe").change(function () {
    let tipeValue = $(this).val();
    let gender = $("#jenisKelamin").val();
    if (tipeValue == "0") {
      if (gender == "LK") {
        $("#keluargaJenisKelamin").val("P").trigger("change");
      } else {
        $("#keluargaJenisKelamin").val("L").trigger("change");
      }
    } else {
      $("#keluargaJenisKelamin").val("").trigger("change");
    }
  });

  // Submit Event
  $("#addDataKeluarga").submit(function () {
    let auth_personal = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let tipe = $("#keluargaTipe").val();
    let nik = $("#keluargaNIK").val();
    let nama = $("#keluargaNama").val();
    let ibu = $("#keluargaNamaIbu").val();
    let ayah = $("#keluargaNamaAyah").val();
    let jenisKelamin = $("#keluargaJenisKelamin").val();
    let tempatLahir = $("#keluargaTempatLahir").val();
    let tanggalLahir = $("#keluargaTanggalLahir").val();
    let bpjs = $("#keluargaBPJS").val();
    let statusBpjs = $("#keluargaStatusBPJS").val();
    let eli = $("#keluargaELI").val();
    let nohp = $("#keluargaHP").val();

    swal({
      title: "Simpan Data",
      text: "Yakin data keluarga akan disimpan?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, simpan",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Keluarga_api/update",
          data: {
            auth_personal: auth_personal,
            tipe: tipe,
            nik: nik,
            nama: nama.toUpperCase(),
            ibu: ibu.toUpperCase(),
            ayah: ayah.toUpperCase(),
            jenisKelamin: jenisKelamin,
            tempatLahir: tempatLahir,
            tanggalLahir: tanggalLahir,
            bpjs: bpjs,
            statusBpjs: statusBpjs,
            eli: eli,
            nohp: nohp,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#dataKeluarga").LoadingOverlay("show");
              $("#dataKeluarga").load(
                site_url + "Keluarga_api/data?auth_personal=" + auth_personal
              );
              $("#dataKeluarga").LoadingOverlay("hide");
              $("#addKeluarga").modal("hide");
              $("#addDataKeluarga").trigger("reset");
              $.LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $.LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            $(".errormsg").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat memperbarui data keluarga, hubungi administrator"
              );
            }
          },
        });
      }
    });
  });

  $("#updateDataKeluarga").submit(function () {
    let auth_personal = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let tipe = $("#updateKeluargaTipe").val();
    let nik = $("#updateKeluargaNIK").val();
    let nama = $("#updateKeluargaNama").val();
    let ibu = $("#updateKeluargaNamaIbu").val();
    let ayah = $("#updateKeluargaNamaAyah").val();
    let jenisKelamin = $("#updateKeluargaJenisKelamin").val();
    let tempatLahir = $("#updateKeluargaTempatLahir").val();
    let tanggalLahir = $("#updateKeluargaTanggalLahir").val();
    let bpjs = $("#updateKeluargaBPJS").val();
    let statusBpjs = $("#updateKeluargaStatusBPJS").val();
    let eli = $("#updateKeluargaELI").val();
    let nohp = $("#updateKeluargaHP").val();

    swal({
      title: "Simpan Data",
      text: "Yakin data keluarga akan disimpan?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, simpan",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Keluarga_api/update",
          data: {
            auth_personal: auth_personal,
            tipe: tipe,
            nik: nik,
            nama: nama.toUpperCase(),
            ibu: ibu.toUpperCase(),
            ayah: ayah.toUpperCase(),
            jenisKelamin: jenisKelamin,
            tempatLahir: tempatLahir,
            tanggalLahir: tanggalLahir,
            bpjs: bpjs,
            statusBpjs: statusBpjs,
            eli: eli,
            nohp: nohp,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#dataKeluarga").LoadingOverlay("show");
              $("#dataKeluarga").load(
                site_url + "Keluarga_api/data?auth_personal=" + auth_personal
              );
              $("#dataKeluarga").LoadingOverlay("hide");
              $("#updateKeluarga").modal("hide");
              $.LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $.LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            $(".errormsg").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat memperbarui data keluarga, hubungi administrator"
              );
            }
          },
        });
      }
    });
  });

  // Keyup Event
  $("#namaLengkap").keyup(function (e) {
    let nama = $("#namaLengkap").val().trim();

    if (nama != "") {
      $(".errorNamaLengkap").html("");
    } else {
      $(".errorNamaLengkap").html("<p>Nama lengkap wajib diisi</p>");
    }
  });

  $("#tempatLahir").keyup(function (e) {
    let tmp_lahir = $("#tempatLahir").val().trim();

    if (tmp_lahir != "") {
      $(".errorTempatLahir").html("");
    } else {
      $(".errorTempatLahir").html("<p>Tempat lahir wajib diisi</p>");
    }
  });

  $("#tanggalLahir").keyup(function (e) {
    let tgl_lahir = $("#tanggalLahir").val().trim();

    if (tgl_lahir != "") {
      $(".errorTanggalLahir").html("");
    } else {
      $(".errorTanggalLahir").html("<p>Tanggal lahir wajib diisi</p>");
    }
  });

  $("#addNIKKary").keyup(function (e) {
    let nikkary = $("#addNIKKary").val().trim();

    if (nikkary != "") {
      $(".erroraddNIKKary").html("");
    } else {
      $(".erroraddNIKKary").html("<p>NIK wajib diisi</p>");
    }
  });

  $("#noNPWP").keyup(function (e) {
    let nonpwp = $("#noNPWP").val().trim();

    if (nonpwp != "") {
      jmlnpwp = nonpwp.replace(/['.'|_|-]/g, "");
      jml = jmlnpwp.length;

      if (jml < 15) {
        $(".errorNoNPWP").html("<p>No. NPWP minimal 15 karakter</p>");
      } else {
        $(".errorNoNPWP").html("");
      }
    } else {
      $(".errorNoNPWP").html("");
    }
  });

  $("#noKTP").keyup(function (e) {
    let noktp = $("#noKTP").val().trim();

    if (noktp != "") {
      jmlktp = noktp.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlktp.length;

      if (jmlhrf > 16) {
        $(".errorNoKTP").html("<p>No. KTP maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".errorNoKTP").html("<p>No. KTP minimal 16 karakter</p>");
      } else {
        $(".errorNoKTP").html("");
      }
    }
  });

  $("#noKTPCek").keyup(function (e) {
    let noKTPCek = $("#noKTPCek").val().trim();

    if (noKTPCek != "") {
      jmlktp = noKTPCek.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlktp.length;

      if (jmlhrf > 16) {
        $(".errornoKTPCek").html("<p>No. KTP maksimal 16 karakter</p>");
        $("#btnverifikasiktp").attr("disabled", true);
      } else if (jmlhrf < 16) {
        $(".errornoKTPCek").html("<p>No. KTP minimal 16 karakter</p>");
        $("#btnverifikasiktp").attr("disabled", true);
      } else {
        $(".errornoKTPCek").html("");
        $("#btnverifikasiktp").removeAttr("disabled");
      }
    } else {
      $(".errornoKTPCek").html("<p>No. KTP tidak boleh kosong</p>");
      $("#btnverifikasiktp").attr("disabled", true);
    }
  });

  $("#noKK").keyup(function (e) {
    let noKK = $("#noKK").val().trim();

    if (noKK != "") {
      jmlkk = noKK.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlkk.length;

      if (jmlhrf > 16) {
        $(".errorNoKK").html("<p>No. KK maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".errorNoKK").html("<p>No. KK minimal 16 karakter</p>");
      } else {
        $(".errorNoKK").html("");
      }
    }
  });

  $("#alamatKTP").keyup(function (e) {
    let alamat = $("#alamatKTP").val().trim();

    if (alamat != "") {
      $(".errorAlamatKTP").html("");
    } else {
      $(".errorAlamatKTP").html("<p>Alamat wajib diisi</p>");
    }
  });

  $("#noTelp").keyup(function (e) {
    let notelp = $("#noTelp").val().trim();

    if (notelp == "") {
      $(".errornoTelp").html("");
    }
  });

  $("#addEmailKantor").keyup(function (e) {
    let EmailKantor = $("#addEmailKantor").val().trim();

    if (EmailKantor == "") {
      $(".erroraddEmail").html("");
    } else {
      if (!validateEmail(EmailKantor)) {
        $(".erroraddEmail").html("<p>Format email salah</p>");
      } else {
        $(".erroraddEmail").html("");
      }
    }
  });

  $("#email").keyup(function (e) {
    let email = $("#email").val().trim();

    if (email == "") {
      $(".erroremail").html("");
    } else {
      if (!validateEmail(email)) {
        $(".erroremail").html("<p>Format email salah</p>");
      } else {
        $(".erroremail").html("");
      }
    }
  });

  // Other Event
  $("#noKTP").focusout(function () {
    let noktp = $("#noKTP").val();
    let validktp = $(".9d56835ae6e4d20993874daf592f6aca d-none").val();
    let errktp = $(".errorNoKTP").text();

    if (errktp != "") {
      swal("Error", errktp, "error");
      return false;
    }

    if (validktp !== noktp) {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_api/checkKTP",
        data: {
          noktp: noktp,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $.LoadingOverlay("hide");
            if ($("#addSimpanPersonal").length == 0) {
              lanjutpersonal();
            }
          } else {
            $.LoadingOverlay("hide");
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $(".errorNoKTP").text(data.pesan);
            $("#addSimpanPersonal").remove();
            $("#addSimpanPekerjaan").remove();
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data personal, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $(document).on("click", ".hapus_unit", function () {
    let id_unit = $(this).attr("id");
    let jenis_unit = $(this).attr("value");
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

    swal({
      title: "Hapus unit",
      text: "Yakin data unit " + jenis_unit + " akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: site_url + "Izin_tambang_api/delete_unit",
          data: {
            id_unit: id_unit,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#idizintambang").LoadingOverlay("show");
              $("#idizintambang").load(
                site_url + "Karyawan_api/izin_tambang?auth_izin=" + auth_izin
              );
              $("#idizintambang").LoadingOverlay("hide");
            } else {
              $(".errormsgizin").removeClass("d-none");
              $(".errormsgizin").removeClass("alert-info");
              $(".errormsgizin").addClass("alert-danger");
              $(".errormsgizin").html(data.pesan);

              $(".errormsgizin")
                .fadeTo(3000, 500)
                .slideUp(500, function () {
                  $(".errormsgizin").slideUp(500);
                });
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsgizin").removeClass("d-none");
            $(".errormsgizin").removeClass("alert-info");
            $(".errormsgizin").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsgizin").html(
                "Terjadi kesalahan saat menghapus unit, hubungi administrator"
              );
            }

            $(".errormsgizin")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".errormsgizin").slideUp(500);
                $(".errormsgizin").addClass("d-none");
              });
          },
        });
      } else if (result.dismiss == "cancel") {
        swal("Batal", "Data unit batal disimpan", "warning");
        return false;
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".hapus_sertifikasi", function () {
    let auth_Sertifikat = $(this).attr("id");
    let no_sertifikat = $(this).attr("value");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    swal({
      title: "Hapus Sertifikasi",
      text: "Yakin data No. Sertifikat " + no_sertifikat + " akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#idsertifikat").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Karyawan_api/delete_sertifikasi",
          data: {
            auth_Sertifikat: auth_Sertifikat,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#idsertifikat").load(
                site_url + "Karyawan_api/sertifikasi?auth_person=" + auth_person
              );
              $("#idsertifikat").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $("#idsertifikat").LoadingOverlay("hide");
              $(".errMsgSertifikasi").removeClass("d-none");
              $(".errMsgSertifikasi").removeClass("alert-info");
              $(".errMsgSertifikasi").addClass("alert-danger");
              $(".errMsgSertifikasi").html(data.pesan);
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#idsertifikat").LoadingOverlay("hide");
            $(".errMsgSertifikasi").removeClass("d-none");
            $(".errMsgSertifikasi").removeClass("alert-info");
            $(".errMsgSertifikasi").addClass("alert-danger");
            if (thrownError != "") {
              $(".errMsgSertifikasi").html(
                "Terjadi kesalahan saat menghapus sertifikat, hubungi administrator"
              );
            }

            $(".errMsgSertifikasi")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".errMsgSertifikasi").slideUp(500);
                $(".errMsgSertifikasi").addClass("d-none");
              });
          },
        });
      } else if (result.dismiss == "cancel") {
        swal("Batal", "Data sertifikasi batal disimpan", "warning");
        return false;
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".edit_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#mdleditsertifikat").modal("show");
        $(".7u67u834hs7dg4haj231hh67ju7a2").text(data.auth_sertifikat);
        $("#jenisSertifikasiEdit")
          .val(data.id_jenis_sertifikasi)
          .trigger("change");
        $("#noSertifikatEdit").val(data.no_sertifikasi);
        $("#namaLembagaEdit").val(data.lembaga);
        $("#tanggalSertifikasiEdit").val(data.tgl_sertifikasi);
        $("#masaBerlakuSertifikatEdit").val("");
        $("#tanggalSertifikasiAkhirEdit").val(data.tgl_berakhir_sertifikasi);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erreditsertifikat").removeClass("d-none");
        $(".erreditsertifikat").removeClass("alert-info");
        $(".erreditsertifikat").addClass("alert-danger");
        if (thrownError != "") {
          $(".erreditsertifikat").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".upload_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#mdluploadulangser").modal("show");
        $("#jdluploadulangser").text(
          "Upload Ulang File Sertifikat - " + data.no_sertifikasi
        );
        $(".9f7fjmuj8ik2js4n8k66g3hjl323").text(data.auth_sertifikat);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erreditsertifikat").removeClass("d-none");
        $(".erreditsertifikat").removeClass("alert-info");
        $(".erreditsertifikat").addClass("alert-danger");
        if (thrownError != "") {
          $(".erreditsertifikat").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".detail_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#mdldetailsertifikat").modal("show");
        $("#jdldetailsertifikat").text(
          "Detail Sertifikasi - " + data.no_sertifikasi
        );
        $("#jenisSertifikasiDetail").val(data.jenis_sertifikasi);
        $("#noSertifikatDetail").val(data.no_sertifikasi);
        $("#namaLembagaDetail").val(data.lembaga);
        $("#tanggalSertifikasiDetail").val(data.tgl_sertifikasi_show);
        $("#tanggalSertifikasiAkhirDetail").val(
          data.tgl_berakhir_sertifikasi_show
        );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errsertifikatdetail").removeClass("d-none");
        $(".errsertifikatdetail").removeClass("alert-info");
        $(".errsertifikatdetail").addClass("alert-danger");
        if (thrownError != "") {
          $(".errsertifikatdetail").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".editHapusVaccine", function () {
    let auth_vaksin = $(this).attr("id");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    swal({
      title: "Sukses",
      text: "Hapus data vaksin?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#idvaksin").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Karyawan_api/delete_vaksin",
          data: {
            auth_vaksin: auth_vaksin,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#idvaksin").load(
                site_url + "Karyawan_api/vaksin?auth_person=" + auth_person
              );
              $("#idvaksin").LoadingOverlay("hide");
            } else if (data.statusCode == 201) {
              $("#idvaksin").LoadingOverlay("hide");
              swal("Error", data.pesan, "error");
            } else {
              $("#idvaksin").LoadingOverlay("hide");
              $(".errormsgvaksin").removeClass("d-none");
              $(".errormsgvaksin").removeClass("alert-info");
              $(".errormsgvaksin").addClass("alert-danger");
              $(".errormsgvaksin").html(data.pesan);
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#idvaksin").LoadingOverlay("hide");
            $(".errormsgvaksin").removeClass("d-none");
            $(".errormsgvaksin").removeClass("alert-info");
            $(".errormsgvaksin").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsgvaksin").html(
                "Terjadi kesalahan saat menghapus vaksin, hubungi administrator"
              );
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });
});
