$(document).ready(function () {
  $.LoadingOverlay("show");
  // SSP Datatables
  function tbKary(prs, ckc = 0) {
    tbmKaryawan = $("#tbmKaryawan").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "desc"]],
      ajax: {
        url: site_url + "Karyawan_api/datatables",
        data: {
          auth_per: prs,
          ck: ckc,
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            $(".err_psn_kary").removeClass("d-none");
            $(".err_psn_kary").css("display", "block");
            $(".err_psn_kary").html(
              "terjadi kesalahan saat melakukan load data karyawan ss, hubungi administrator"
            );
            $("#addTambahKary").addClass("disabled");
            $(".err_psn_kary ")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".err_psn_kary ").slideUp(500);
              });
          }
        },
      },
      deferRender: true,
      aLengthMenu: [
        [10, 25, 50],
        [10, 25, 50],
      ],
      columns: [
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "no",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "no_nik",
          className: "align-middle ",
        },
        {
          data: "nama_lengkap",
          className: " align-middle",
        },
        {
          data: "depart",
          className: "text-wrap align-middle",
        },
        {
          data: "posisi",
          className: "text-wrap align-middle",
        },
        {
          data: "kode_m_perusahaan",
          className: "text-wrap align-middle text-center",
          width: "12%",
        },
        {
          data: "stat_aktif",
          className: "text-wrap align-middle text-center",
          width: "1%",
        },
      ],
    });
    $("#tbmKaryawan").LoadingOverlay("hide");
  }

  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Struktur_api/get_auth",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#perJenisData").val(data.auth).trigger("change");
      } else {
        $("#perJenisData").val("").trigger("change");
      }
    },
    error: function (thrownError) {
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
      }

      swal("Error", pesan, "error");
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataTipeAkses",
    success: function (data) {
      var data = JSON.parse(data);
      $("#tipeAksesUnitnw").html(data.akses);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimpernw").removeClass("d-none");
      $(".errormdlsimpernw").removeClass("alert-info");
      $(".errormdlsimpernw").addClass("alert-danger");
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
    url: site_url + "Karyawan_api/dataUnitSimper",
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisUnitSimpernw").html(data.unit);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimpernw").removeClass("d-none");
      $(".errormdlsimpernw").removeClass("alert-info");
      $(".errormdlsimpernw").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimpernw").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimpernw").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisSIM",
    success: function (data) {
      var data = JSON.parse(data);
      $("#addJenisSIMnew").html(data.siim);
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

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataJenisSertifikasi",
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisSertifikasiNew").html(data.srt);
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
    url: site_url + "Karyawan_api/dataStatusPerjanjian",
    success: function (response) {
      var data = JSON.parse(response);
      $("#addStatusKaryawan").html(data.janji);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status kontrak kerja, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  // Select Searchable
  $("#perJenisData").select2({
    theme: "bootstrap4",
  });
      
  $("#addStatusKaryawan").select2({
    theme: "bootstrap4",
    dropdownParent: $("#kontrakKerja"),
  });
      
  $("#jenisUnitSimpernw").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlunitsimpernw"),
  });
      
  $("#tipeAksesUnitnw").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlunitsimpernw"),
  });
      
  $("#addJenisSIMnew").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlnewSMP"),
  });

  $("#jenisSertifikasiNew").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlnewsertifikat"),
  });

  $("#jenisVaksin").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlnewvaksin"),
  });

  $("#namaVaksin").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlnewvaksin"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perJenisData").select2({
        theme: "bootstrap4",
      });
      
      $("#addStatusKaryawan").select2({
        theme: "bootstrap4",
        dropdownParent: $("#kontrakKerja"),
      });
      
      $("#jenisUnitSimpernw").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlunitsimpernw"),
      });
      
      $("#tipeAksesUnitnw").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlunitsimpernw"),
      });
      
      $("#addJenisSIMnew").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlnewSMP"),
      });
      
      $("#jenisSertifikasiNew").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlnewsertifikat"),
      });

      $("#jenisVaksin").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlnewvaksin"),
      });
    
      $("#namaVaksin").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlnewvaksin"),
      });
    },
    true
  );

  // First Datatables
  tbKary();

  // Click
  $("#krycekNonaktif").click(function () {
    let ckkary = $("#krycekNonaktif");
    let prs = $("#perJenisData").val();

    $("#tbmKaryawan").LoadingOverlay("show");
    if (prs != "") {
      if (ckkary.is(":checked")) {
        ckc = 1;
      } else {
        ckc = 0;
      }
      $("#tbmKaryawan").DataTable().destroy();
      tbKary(prs, ckc);
      $("#tbmKaryawan").LoadingOverlay("hide");
    }
  });

  $("#addRefreshKary").click(function () {
    let prs = $("#perJenisData").val();
    $("#tbmKaryawan").LoadingOverlay("show");
    $("#tbmKaryawan").DataTable().destroy();
    $("#krycekNonaktif").prop("checked", false);
    tbKary(prs);
  });

  $("#refreshJenisSIMnew").click(function () {
    $("#txtizinSIMnew").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisSIM",
      success: function (data) {
        var data = JSON.parse(data);
        $("#addJenisSIMnew").html(data.siim);
        $("#txtizinSIMnew").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat load data jenis SIM, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshtipeAksesUnitnw").click(function () {
    $("#txttipeAksesUnitnw").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataTipeAkses",
      success: function (data) {
        var data = JSON.parse(data);
        $("#tipeAksesUnitnw").html(data.akses);
        $("#txttipeAksesUnitnw").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txttipeAksesUnitnw").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimpernw").removeClass("d-none");
        $(".errormdlsimpernw").removeClass("alert-info");
        $(".errormdlsimpernw").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimpernw").html(
            "Terjadi kesalahan saat load data unit simper, hubungi administrator"
          );
          $("#btnsimpanunitsimpernw").remove();
        }
      },
    });
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
        $("#addTanggalPermanen").attr("disabled", true);
        $("#addTanggalKontrakAwal").attr("disabled", true);
        $("#addTanggalKontrakAkhir").attr("disabled", true);
        $("#addTanggalPermanen").removeAttr("required");
        $("#addTanggalKontrakAwal").removeAttr("required");
        $("#addTanggalKontrakAkhir").removeAttr("required");

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

  $("#addUnitSIMPERnew").click(function () {
    let jenisizin = $("#addJenisIzinnew").val();

    if (jenisizin == 2) {
      let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
      let noreg = $("#addNoRegnew").val();
      let tglexp = $("#addTglExpnew").val();
      let jenissim = $("#addJenisSIMnew").val();
      let tglexpsim = $("#addTglExpSIMnew").val();
      let jenisunit = $("#jenisUnitSimpernew").val();
      let tipeakses = $("#tipeAksesUnitnew").val();
      let filesim = $("#filesimpolisinew").val();
      let filesmp = $("#simpermpnew").val();

      if (auth_kary == "") {
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        $(".errormsgizinnew").html("Data karyawan tidak ditemukan");
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
        $("#mdlunitsimpernw").modal("show");
        $("#refreshjenisUnitSimpernw").removeAttr("disabled");
        $("#refreshtipeAksesUnitnw").removeAttr("disabled");
      } else {
        $(".erroraddJenisIzinnew").html(errjenisizin);
        $(".erroraddNoRegnew").html(errnoreg);
        $(".erroraddJenisSIMnew").html(errjenissim);
        $(".erroraddTglExpSIMnew").html(errtglexpsim);
        $(".erroraddTglExpnew").html(errtglexp);
        $(".errorsimpermpnew").html(errfilesmp);
        $(".errorFilesimpolisinew").html(errfilesim);
      }
    }
  });

  $("#addSimpanIzinUnitnew").click(function () {
    let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();
    let auth_simpol = $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text();
    let jenisizin = $("#addJenisIzinnew").val();
    let noreg = $("#addNoRegnew").val();
    let tglexp = $("#addTglExpnew").val();
    let jenissim = $("#addJenisSIMnew").val();
    let tglexpsim = $("#addTglExpSIMnew").val();
    let filesmp = $("#simpermpnew").val();
    const flsmp = $("#simpermpnew").prop("files")[0];
    let filesim = $("#filesimpolisinew").val();
    const flsim = $("#filesimpolisinew").prop("files")[0];
    let nmsimper = $("#nmfilesimpernew").val();
    let nmsimpol = $("#nmfilesimpolnew").val();
    let filesimnm = $("#nmfilesimpolnew").val();
    let filesimsv = $("#nmfilesimpolsvnew").val();
    let filesmpnm = $("#nmfilesimpernew").val();
    let filesmpsv = $("#nmfilesimpersvnew").val();

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
    formData.append("auth_kary", auth_kary);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_simpol", auth_simpol);
    formData.append("token", token);
    formData.append("nmsimper", nmsimper);
    formData.append("nmsimpol", nmsimpol);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Izin_tambang_api/create_new",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $(".ecb14fe704e08d9df8e343030bbb442344").text("");
          $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
          $("#btnshowsimpolnew").addClass("disabled");
          $("#btnshowsimpernew").addClass("disabled");
          $("#addJenisIzinnew").val("").trigger("change");
          $("#addNoRegnew").val("");
          $("#addJenisSIMnew").val("");
          $("#addTglExpSIMnew").val("");
          $("#nmfilesimpolnew").val("");
          $("#nmfilesimpolsvnew").val("");
          $("#filesimpolisinew").val("");
          $("#simpermpnew").val("");
          $("#nmfilesimpernew").val("");
          $("#nmfilesimpersvnew").val("");
          $("#addTglExpnew").val("");
          $("#lblsimpermpnew").text("Pilih file SIMPER/MINE PERMIT");
          $("#lblsimpolisinew").text("Pilih file SIM Polisi");
          $(".h52k342").text("");
          $(".erroraddJenisIzinnew").text("");
          $(".erroraddNoRegnew").text("");
          $(".erroraddJenisSIMnew").text("");
          $(".erroraddTglExpSIMnew").text("");
          $(".errorFilesimpolisinew").text("");
          $(".erroraddTglExpnew").text("");
          $(".errorsimpermpnew").text("");
          $(".errorFilesimpolisinew").text("");
          $("#mdlnewSMP").modal("hide");
          swal("Berhasil", data.pesan, "success");
          $.LoadingOverlay("hide");
        } else if (data.statusCode == 201) {
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-primary");
          $(".errormsgizinnew").addClass("alert-danger");
          $(".errormsgizinnew").html(data.pesan);
          $.LoadingOverlay("hide");
        } else {
          $(".erroraddJenisIzinnew").html(data.jenisizin);
          $(".erroraddNoRegnew").html(data.noreg);
          $(".erroraddTglExpnew").html(data.tglexp);
          $(".erroraddJenisSIMnew").html(data.jenissim);
          $(".erroraddTglExpSIMnew").html(data.tglexpsim);
          $(".errorsimpermpnew").html(data.filesmp);
          $(".errorFilesimpolisinew").html(data.filesmp);
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data SIMPER/MINE PERMIT.",
            "error"
          );
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat menyimpan data SIMPER/MINE PERMIT, hubungi administrator"
          );
        }
      },
    });
    $.LoadingOverlay("hide");

    $(".errormsgizinnew")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgizinnew").slideUp(500);
        $(".errormsgizinnew").addClass("d-none");
      });
  });

  $("#btnsimpanunitsimpernw").click(function () {
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();
    let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
    let auth_simpol = $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text();
    let jenisizin = $("#addJenisIzinnew").val();
    let noreg = $("#addNoRegnew").val();
    let tglexp = $("#addTglExpnew").val();
    let jenissim = $("#addJenisSIMnew").val();
    let tglexpsim = $("#addTglExpSIMnew").val();
    let jenisunit = $("#jenisUnitSimpernw").val();
    let tipeakses = $("#tipeAksesUnitnw").val();
    let filesim = $("#filesimpolisinew").val();
    const flsim = $("#filesimpolisinew").prop("files")[0];
    let filesmp = $("#simpermpnew").val();
    const flsmp = $("#simpermpnew").prop("files")[0];
    let filesimnm = $("#nmfilesimpolnew").val();
    let filesimsv = $("#nmfilesimpolsvnew").val();
    let filesmpnm = $("#nmfilesimpernew").val();
    let filesmpsv = $("#nmfilesimpersvnew").val();

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
    formData.append("tipeakses", tipeakses);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    $.ajax({
      type: "POST",
      url: site_url + "Izin_tambang_api/add_unit_izin_tambang_new",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#jenisUnitSimpernw").val("").trigger("change");
          $("#tipeAksesUnitnw").val("").trigger("change");
          $("#idizintambangnew").LoadingOverlay("show");
          $(".j8234234b").text(data.auth_simpol);
          $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text(data.auth_izin);
          $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text(data.auth_simpol);
          if (data.auth_unit == "j78uh5yg") {
            $("#nmfilesimpolnew").val(flsim.name);
            $("#nmfilesimpolsvnew").val(data.filesimsv);
            $("#nmfilesimpernew").val(flsmp.name);
            $("#nmfilesimpersvnew").val(data.filesmpsv);
            $("#btnshowsimpernew").attr("href", data.linkizin);
            $("#btnshowsimpolnew").attr("href", data.linksim);
            $("#btnshowsimpolnew").removeClass("disabled");
            $("#btnshowsimpernew").removeClass("disabled");
          }
          $(".errorjenisUnitSimpernw").text("");
          $(".errortipeAksesUnitnw").text("");
          $(".erroraddJenisIzinnew").html("");
          $(".erroraddNoRegnew").html("");
          $(".erroraddJenisSIMnew").html("");
          $(".erroraddTglExpSIMnew").html("");
          $(".errorFilesimpolisinew").html("");
          $(".erroraddTglExpnew").html("");
          $(".errorsimpermpnew").html("");
          $(".errorFilesimpolisinew").html("");
          $("#idizintambangnew").load(
            site_url + "Karyawan_api/izin_tambang?auth_izin=" + data.auth_izin
          );
          swal("Berhasil", data.pesan, "success");
        } else if (data.statusCode == 201) {
          swal("Error", data.message, "error");
        } else {
          $(".errorjenisUnitSimpernw").html(data.jenisunit);
          $(".errortipeAksesUnitnw").html(data.tipeakses);
          swal("Error", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormdlsimpernw").removeClass("d-none");
        $(".errormdlsimpernw").removeClass("alert-info");
        $(".errormdlsimpernw").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimpernw").html(
            "Terjadi kesalahan saat menyimpan unit hubungi administrator"
          );
        }
      },
    });
  });

  $("#btnnewsertifikat").click(function () {
    let auth_kary = $(".8k23jnm89d56jl123mn90bv542ll").text();
    let jenis = $("#jenisSertifikasiNew").val();
    let no_ser = $("#noSertifikatNew").val();
    let lembaga = $("#namaLembagaNew").val();
    let tgl_ser = $("#tanggalSertifikasiNew").val();
    let tgl_akhir_ser = $("#tanggalSertifikasiAkhirNew").val();
    let file_ser = $("#fileSertifikasi").val();
    const fl_ser = $("#fileSertifikasi").prop("files")[0];

    let fileSertifikasiName = file_ser.split(".").pop().toLowerCase();
    let fileSertifikasiSize = fl_ser["size"];

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
      if (auth_kary == "") {
        errkary = "Data karyawan tidak ditemukan";
      } else {
        errkary = "";
      }

      if (jenis == "") {
        errjenis = "Jenis sertifikasi wajib dipilih";
      } else {
        errjenis = "";
      }
      if (no_ser == "") {
        errno_ser = "No. sertifikasi wajib diisi";
      } else {
        errno_ser = "";
      }
      if (lembaga == "") {
        errlembaga = "Lembaga wajib diisi";
      } else {
        errlembaga = "";
      }
      if (tgl_ser == "") {
        errtgl_ser = "Tanggal sertifikasi wajib diisi";
      } else {
        errtgl_ser = "";
      }
      if (tgl_akhir_ser == "") {
        errtgl_akhir_ser = "Jenis sertifikasi wajib diisi";
      } else {
        errtgl_akhir_ser = "";
      }
      if (file_ser == "") {
        errfile_ser = "File sertifikasi wajib diupload";
      } else {
        errfile_ser = "";
      }

      if (
        errkary == "" &&
        errjenis == "" &&
        errno_ser == "" &&
        errlembaga == "" &&
        errtgl_ser == "" &&
        errtgl_akhir_ser == "" &&
        errfile_ser == ""
      ) {
        swal({
          title: "Upload Sertifikasi",
          text: "Yakin data sertifikasi akan di-upload?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("jenis", jenis);
            formData.append("no_ser", no_ser);
            formData.append("lembaga", lembaga);
            formData.append("tgl_ser", tgl_ser);
            formData.append("tgl_akhir_ser", tgl_akhir_ser);
            formData.append("file_ser", file_ser);
            formData.append("fl_ser", fl_ser);
            formData.append("auth_kary", auth_kary);

            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/create_sertifikasi_new",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#mdlnewsertifikat").modal("hide");
                  $(".8k23jnm89d56jl123mn90bv542ll").text("");
                  $("#jenisSertifikasiNew").val("").trigger("change");
                  $("#noSertifikatNew").val("");
                  $("#namaLembagaNew").val("");
                  $("#tanggalSertifikasiNew").val("");
                  $("#tanggalSertifikasiAkhirNew").val("");
                  $("#masaBerlakuSertifikatNew").val("").trigger("change");
                  $("#filePendukung").val("");
                  swal("Berhasil", data.pesan, "success");
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewsertifikat").removeClass("d-none");
                  $(".errnewsertifikat").removeClass("alert-primary]");
                  $(".errnewsertifikat").addClass("alert-danger");
                  $(".errnewsertifikat").html(data.pesan);
                } else {
                  $(".errorjenisSertifikasiNew").html(data.jenis);
                  $(".errorNoSertifikatNew").html(data.no_ser);
                  $(".errorNamaLembagaNew").html(data.lembaga);
                  $(".errorTanggalSertifikasiNew").html(data.tgl_ser);
                  $(".errorTanggalSertifikasiAkhir").html(data.tgl_akhir_ser);
                  $(".errorFileSertifikasi").html(data.filesrt);
                  $.LoadingOverlay("hide");
                }
              },
            });
          } else {
            swal.close();
          }
        });
      } else {
        if (errkary != "") {
          $(".errnewsertifikat").removeClass("d-none");
          $(".errnewsertifikat").removeClass("alert-primary]");
          $(".errnewsertifikat").addClass("alert-danger");
          $(".errnewsertifikat").html(errkary);
        } else {
          $(".errnewsertifikat").addClass("d-none");
          $(".errnewsertifikat").html("");
        }

        $(".errorjenisSertifikasiNew").html(errjenis);
        $(".errorNoSertifikatNew").html(errno_ser);
        $(".errorNamaLembagaNew").html(errlembaga);
        $(".errorTanggalSertifikasiNew").html(errtgl_ser);
        $(".errorTanggalSertifikasiAkhir").html(errtgl_akhir_ser);
        $(".errorFileSertifikasi").html(errfile_ser);
      }

      $(".errnewsertifikat")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errnewsertifikat").slideUp(500);
          $(".errnewsertifikat").addClass("d-none");
        });
    }
  });

  $(document).on("click", ".btnHapusKary", function () {
    let auth_kary = $(this).attr("id");
    let nama_kary = $(this).attr("value");

    swal({
      title: "Hapus Data Karyawan",
      text:
        "Yakin semua data karyawan termasuk file atas nama : " +
        nama_kary +
        " akan dihapus? Data Tidak Dapat Dikembalikan lagi!",
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
          url: site_url + "Karyawan_api/delete_karyawan",
          data: {
            auth_kary: auth_kary,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              tbmKaryawan.draw();
              swal("Berhasil", data.pesan, "success");
            } else {
              swal("Error", data.pesan, "error");
            }
            $.LoadingOverlay("hide");
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $(".errormsg").removeClass("d-none");
            $(".errormsg").removeClass("alert-info");
            $(".errormsg").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
              );
              $("#addSimpanSertifikasi").remove();
              $("#addResetSertifikasi").remove();
              $.LoadingOverlay("hide");
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".btnFotoKaryawan ", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewfotokaryawan").text(
      "Tambah Foto Karyawan - " + nonik + " | " + nama + " | " + prs
    );

    $(".76235ft67gfrubf12").text(auth_kary);
    $("#mdlnewfotokaryawan").modal("show");
  });

  $(document).on("click", ".btnKontrakKerja ", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#titleKontrakKerja").text(
      "Tambah Kontrak Kerja - " + nonik + " | " + nama + " | " + prs
    );

    $(".198627848242hdwaidh").text(auth_kary);
    $("#kontrakKerja").modal("show");
  });

  $(document).on("click", ".btnSIMPER ", function () {
    let auth_kary = $(this).attr("id");
    $(".ecb14fe704e08d9df8e343030bbb442344").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
    $("#btnshowsimpolnew").addClass("disabled");
    $("#btnshowsimpernew").addClass("disabled");
    $("#addJenisIzinnew").val("").trigger("change");
    $("#addNoRegnew").val("");
    $("#addJenisSIMnew").val("");
    $("#addTglExpSIMnew").val("");
    $("#nmfilesimpolnew").val("");
    $("#nmfilesimpolsvnew").val("");
    $("#filesimpolisinew").val("");
    $("#simpermpnew").val("");
    $("#nmfilesimpernew").val("");
    $("#nmfilesimpersvnew").val("");
    $("#addTglExpnew").val("");
    $("#lblsimpermpnew").text("Pilih file SIMPER/MINE PERMIT");
    $("#lblsimpolisinew").text("Pilih file SIM Polisi");
    $(".h52k342").text("");
    $(".erroraddJenisIzinnew").text("");
    $(".erroraddNoRegnew").text("");
    $(".erroraddJenisSIMnew").text("");
    $(".erroraddTglExpSIMnew").text("");
    $(".errorFilesimpolisinew").text("");
    $(".erroraddTglExpnew").text("");
    $(".errorsimpermpnew").text("");
    $(".errorFilesimpolisinew").text("");
    $("#jdlmdlnewSMP").text(
      "Tambah SIMPER/MINE PERMIT - " + nonik + " | " + nama + " | " + prs
    );
    $("#mdlnewSMP").modal("show");
    $("#idizintambangnew").load(
      site_url + "Karyawan_api/izin_tambang?auth_izin=0"
    );
  });

  $(document).on("click", ".btnSertifikasi ", function () {
    let auth_kary = $(this).attr("id");
    $(".8k23jnm89d56jl123mn90bv542ll").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewsertifikat").text(
      "Tambah Sertifikasi - " + nonik + " | " + nama + " | " + prs
    );

    $("#jenisSertifikasiNew").val("").trigger("change");
    $("#noSertifikatNew").val("");
    $("#namaLembagaNew").val("");
    $("#tanggalSertifikasiNew").val("");
    $("#masaBerlakuSertifikatNew").val("").trigger("change");
    $("#tanggalSertifikasiAkhirNew").val("");
    $("#filePendukung").val("");
    $(".errorjenisSertifikasiNew").html("");
    $(".errorNoSertifikatNew").html("");
    $(".errorNamaLembagaNew").html("");
    $(".errorTanggalSertifikasiNew").html("");
    $(".errorTanggalSertifikasiAkhir").html("");
    $(".errorFileSertifikasi").html("");
    $("#mdlnewsertifikat").modal("show");
  });

  $(document).on("click", ".btnMCU ", function () {
    let auth_kary = $(this).attr("id");
    $(".890123hjn34267xcxvbj7234hh").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewmcu").text(
      "Tambah MCU - " + nonik + " | " + nama + " | " + prs
    );

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataJenisMCU",
      data: {},
      success: function (data) {
        var data = JSON.parse(data);
        $("#hasilMCUnew").html(data.jmcu);
        $("#hasilMCUnew").select2({
          theme: "bootstrap4",
          dropdownParent: $("#mdlnewmcu"),
        });
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errnewmcu").removeClass("d-none");
        $(".errnewmcu").removeClass("alert-info");
        $(".errnewmcu").addClass("alert-danger");
        if (thrownError != "") {
          $(".errnewmcu").html(
            "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
          );
        }
      },
    });

    $("#hasilMCUnew").val("").trigger("change");
    $("#tglMCUnew").val("");
    $("#ketMCUnew").val("");
    $("#fileMCUnew").val("");
    $(".errorTglMCUnew").html("");
    $(".errorHasilMCUnew").html("");
    $(".errorKetMCUnew").html("");
    $(".errorFileMCUnew").html("");
    $("#mdlnewmcu").modal("show");
  });

  $(document).on("click", ".btnVaksin", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");
    $(".t9018htg2398th259").text(auth_kary);

    $("#jdlmdlnewvaksin").text(
      "Tambah Data Vaksin - " + nonik + " | " + nama + " | " + prs
    );

    $("#mdlnewvaksin").modal("show");
    // $('#jenisVaksin option[value="0"]').hide();
    // $('#namaVaksin option[value="0"]').hide();
  });

  $(document).on("click", ".btnFilePendukung ", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");
    $(".12390lkjj4234bn12j28j4nc9").text(auth_kary);

    $("#jdlmdlnewfilependukung").text(
      "Update File Pendukung - " + nonik + " | " + nama + " | " + prs
    );
    $("#mdlnewfilependukung").modal("show");
  });

  // Change
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
            $("#addTanggalPermanen").attr("disabled", true);
            $("#addFieldKontrakAwal").removeClass("d-none");
            $("#addFieldKontrakAkhir").removeClass("d-none");
            $("#addTanggalKontrakAwal").removeAttr("disabled");
            $("#addTanggalKontrakAkhir").removeAttr("disabled");
            $("#addTanggalKontrakAwal").attr("required", true);
            $("#addTanggalKontrakAkhir").attr("required", true);
          } else if (data.stat_waktu == "F") {
            $("#addFieldPermanen").removeClass("d-none");
            $("#addTanggalPermanen").removeAttr("disabled");
            $("#addTanggalPermanen").attr("required", true);
            $("#addFieldKontrakAwal").addClass("d-none");
            $("#addFieldKontrakAkhir").addClass("d-none");
            $("#addTanggalKontrakAwal").attr("disabled", true);
            $("#addTanggalKontrakAkhir").attr("disabled", true);
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

  $("#perJenisData").change(function () {
    let prs = $("#perJenisData").val();
    $("#tbmKaryawan").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/detailKodePerusahaan",
      data: {
        prs: prs,
      },
      success: function (data) {
        $("#lblhirarkiper").text(data);
      },
    });
    $("#tbmKaryawan").DataTable().destroy();
    tbKary(prs);
  });

  $("#addJenisIzinnew").change(function () {
    let jenis_izin = $(this).val();
    if (jenis_izin == 2) {
      $("#txtsimnew").removeClass("d-none");
      $("#txtunitnew").removeClass("d-none");
      $(".simperunitnew").collapse("show");
    } else {
      $("#txtsimnew").addClass("d-none");
      $("#txtunitnew").addClass("d-none");
      $(".simperunitnew").collapse("hide");
    }
  });

  // Submit
  $("#gantiFotoKaryawan").submit(function () {
    let auth_kary = $(".76235ft67gfrubf12").text();
    let foto_karyawan = $("#fotoKaryawanNew").val();
    const file_foto = $("#fotoKaryawanNew").prop("files")[0];
    let fileExtension = foto_karyawan.split(".").pop().toLowerCase();
    let sizeFile = file_foto["size"];
    if (fileExtension != "jpg") {
      swal({
        title: "Informasi",
        text: "File foto yang dipilih bukan JPG",
        type: "info",
      });
    } else if (sizeFile > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File foto yang dipilih melebihi 100kb",
        type: "warning",
      });
    } else {
      if (auth_kary == "") {
        errkary = "Data karyawan tidak ditemukan";
      } else {
        errkary = "";
      }

      if (errkary == "") {
        swal({
          title: "Upload Foto Karyawan",
          text: "Yakin foto akan di-upload?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("foto_karyawan", foto_karyawan);
            formData.append("file_foto", file_foto);
            formData.append("auth_kary", auth_kary);
            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/upload_foto_karyawan",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdlnewfotokaryawan").modal("hide");
                  $(".76235ft67gfrubf12").text("");
                  $("#fotoKaryawanNew").val("");
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Berhasil",
                    text: data.pesan,
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000,
                  });
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewfotokaryawan").removeClass("d-none");
                  $(".errnewfotokaryawan").removeClass("alert-primary");
                  $(".errnewfotokaryawan").addClass("alert-danger");
                  $(".errnewfotokaryawan").html(data.pesan);
                }
              },
            });
          }
        });
      } else {
        if (errkary != "") {
          $(".errnewfotokaryawan").removeClass("d-none");
          $(".errnewfotokaryawan").removeClass("alert-primary]");
          $(".errnewfotokaryawan").addClass("alert-danger");
          $(".errnewfotokaryawan").html(errkary);
        } else {
          $(".errnewfotokaryawan").addClass("d-none");
          $(".errnewfotokaryawan").html("");
        }

        $(".errnewfotokaryawan")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewfotokaryawan").slideUp(500);
            $(".errnewfotokaryawan").addClass("d-none");
          });
      }
    }
  });

  $("#addKontrak").submit(function () {
    let authKaryawanKontrak = $(".198627848242hdwaidh").text();
    let statusKontrak = $("#addStatusKaryawan").val();
    let tanggalPermanen = $("#addTanggalPermanen").val();
    let tanggalAwal = $("#addTanggalKontrakAwal").val();
    let tanggalAkhir = $("#addTanggalKontrakAkhir").val();

    if (statusKontrak != '1' && tanggalAkhir < tanggalAwal) {
      swal({
        title: "Tanggal Akhir harus setelah Tanggal Awal!",
        text: "Isi Tanggal Akhir dengan benar!",
        type: "info",
      }).then(function () {
        $("#addTanggalKontrakAkhir").focus();
      });
    } else {
      $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Karyawan_api/create_kontrak",
            data: {
              auth: authKaryawanKontrak,
              status: statusKontrak,
              tanggalPermanen: tanggalPermanen,
              tanggalAwal: tanggalAwal,
              tanggalAkhir: tanggalAkhir,
            },
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $("#kontrakKerja").modal("hide");
                $("#refreshstatkaryawan").click();
                $.LoadingOverlay("hide");
                swal("Berhasil", data.pesan, "success");
              } else {
                $.LoadingOverlay("hide");
                swal("Gagal", data.pesan, "error");
              }
            },
            error: function () {
              $.LoadingOverlay("hide");
              swal("Server Error", "Data Kontrak Kerja gagal ditambahkan!", "error");
            },
          });
    }
  });

  $("#gantiFilePendukung").submit(function () {
    let auth_kary = $(".12390lkjj4234bn12j28j4nc9").text();
    let file_pendukung = $("#filePendukungnew").val();
    const fl_pendukung = $("#filePendukungnew").prop("files")[0];
    let fileExtension = file_pendukung.split(".").pop().toLowerCase();
    let sizeFile = fl_pendukung["size"];

    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "File yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran file yang dipilih melebihi 1000kb/1mb",
        type: "warning",
      });
    } else {
      if (auth_kary == "") {
        errkary = "Data karyawan tidak ditemukan";
      } else {
        errkary = "";
      }

      if (errkary == "") {
        swal({
          title: "Upload File Pendukung",
          text: "Yakin file pendukung akan di-upload?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("file_pendukung", file_pendukung);
            formData.append("fl_pendukung", fl_pendukung);
            formData.append("auth_kary", auth_kary);
            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/upload_file_pendukung",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdlnewfilependukung").modal("hide");
                  $(".12390lkjj4234bn12j28j4nc9").text("");
                  $("#filePendukungnew").val("");
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Berhasil",
                    text: data.pesan,
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000,
                  });
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewfilependukung").removeClass("d-none");
                  $(".errnewfilependukung").removeClass("alert-primary");
                  $(".errnewfilependukung").addClass("alert-danger");
                  $(".errnewfilependukung").html(data.pesan);
                } else {
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                  });
                }
              },
            });
          }
        });
      } else {
        $.LoadingOverlay("hide");
        if (errkary != "") {
          $(".errnewfilependukung").removeClass("d-none");
          $(".errnewfilependukung").removeClass("alert-primary]");
          $(".errnewfilependukung").addClass("alert-danger");
          $(".errnewfilependukung").html(errkary);
        } else {
          $(".errnewfilependukung").addClass("d-none");
          $(".errnewfilependukung").html("");
        }

        $.LoadingOverlay("hide");

        $(".errnewfilependukung")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewfilependukung").slideUp(500);
            $(".errnewfilependukung").addClass("d-none");
          });
      }
    }
  });

  $("#tambahDataVaksin").submit(function () {
    let auth_kary = $(".t9018htg2398th259").text();
    let jenisVaksin = $("#jenisVaksin").val();
    let namaVaksin = $("#namaVaksin").val();
    let tanggalVaksin = $("#tanggalVaksin").val();
    if (auth_kary == "") {
      errkary = "Data karyawan tidak ditemukan";
    } else {
      errkary = "";
    }

    if (errkary == "") {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Karyawan_api/create_vaksin_new",
        data: {
          auth_kary: auth_kary,
          jenisVaksin: jenisVaksin,
          namaVaksin: namaVaksin,
          tanggalVaksin: tanggalVaksin,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#mdlnewvaksin").modal("hide");
            $(".t9018htg2398th259").text("");
            $("#jenisVaksin").val("").trigger("change");
            $("#namaVaksin").val("").trigger("change");
            $("#tanggalVaksin").val("");
            $.LoadingOverlay("hide");
            swal({
              title: "Berhasil",
              text: data.pesan,
              type: "success",
              showConfirmButton: false,
              timer: 2000,
            });
          } else if (data.statusCode == 201) {
            $.LoadingOverlay("hide");
            $(".errornewvaksin").removeClass("d-none");
            $(".errornewvaksin").removeClass("alert-primary]");
            $(".errornewvaksin").addClass("alert-danger");
            $(".errornewvaksin").html(data.pesan);
          } else {
            $.LoadingOverlay("hide");
            swal({
              title: "Error",
              text: data.pesan,
              type: "error",
            });
          }
        },
      });
    } else {
      if (errkary != "") {
        $(".errornewvaksin").removeClass("d-none");
        $(".errornewvaksin").removeClass("alert-primary]");
        $(".errornewvaksin").addClass("alert-danger");
        $(".errornewvaksin").html(errkary);
      } else {
        $(".errornewvaksin").addClass("d-none");
        $(".errornewvaksin").html("");
      }

      $.LoadingOverlay("hide");

      $(".errornewvaksin")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errornewvaksin").slideUp(500);
          $(".errornewvaksin").addClass("d-none");
        });
    }
  });

  $("#tambahDataMCU").submit(function () {
    let auth_kary = $(".890123hjn34267xcxvbj7234hh").text();
    let tglMCU = $("#tglMCUnew").val();
    let hasilMCU = $("#hasilMCUnew").val();
    let ketMCU = $("#ketMCUnew").val();
    let file_MCU = $("#fileMCUnew").val();
    const fl_MCU = $("#fileMCUnew").prop("files")[0];

    if (auth_kary == "") {
      errkary = "Data karyawan tidak ditemukan";
    } else {
      errkary = "";
    }

    let fileExtension = file_MCU.split(".").pop().toLowerCase();
    let sizeFile = fl_MCU["size"];
    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "File MCU yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File MCU yang dipilih melebihi 1000kb",
        type: "warning",
      });
    } else {
      if (errkary == "") {
        swal({
          title: "Upload MCU",
          text: "Yakin data MCU akan di-upload?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("tglMCU", tglMCU);
            formData.append("hasilMCU", hasilMCU);
            formData.append("ketMCU", ketMCU);
            formData.append("file_MCU", file_MCU);
            formData.append("fl_MCU", fl_MCU);
            formData.append("auth_kary", auth_kary);

            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_api/create_mcu_new",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdlnewmcu").modal("hide");
                  $(".890123hjn34267xcxvbj7234hh").text("");
                  $("#hasilMCUnew").val("").trigger("change");
                  $("#ketMCUnew").val("");
                  $("#tglMCUnew").val("");
                  $("#fileMCUnew").val("");
                  swal("Berhasil", data.pesan, "success");
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewmcu").removeClass("d-none");
                  $(".errnewmcu").removeClass("alert-primary]");
                  $(".errnewmcu").addClass("alert-danger");
                  $(".errnewmcu").html(data.pesan);
                } else {
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                  });
                }
              },
            });
          } else {
            swal.close();
          }
        });
      } else {
        if (errkary != "") {
          $(".errnewmcu").removeClass("d-none");
          $(".errnewmcu").removeClass("alert-primary]");
          $(".errnewmcu").addClass("alert-danger");
          $(".errnewmcu").html(errkary);
        } else {
          $(".errnewmcu").addClass("d-none");
          $(".errnewmcu").html("");
        }

        $(".errnewmcu")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewmcu").slideUp(500);
            $(".errnewmcu").addClass("d-none");
          });
      }
    }
  });
});
