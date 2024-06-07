$(document).ready(function () {
  $.LoadingOverlay("show");
  /* Data Personal */
  // Functions
  function checkAge(tgl_lahir) {
    // Convert tgl_lahir to a Date object
    let birthDate = new Date(tgl_lahir);

    // Get the current date
    let currentDate = new Date();

    // Calculate the age
    let ageInMilliseconds = currentDate - birthDate;
    let ageInYears = Math.floor(
      ageInMilliseconds / (365.25 * 24 * 60 * 60 * 1000)
    );

    return ageInYears;
  }

  function pageHeader(newData) {
    var currentContent = $("#pageHeader").text();
    var existingMPerusahaan = currentContent.split("(")[1].split(")")[0];

    var newContent = `Edit Karyawan - ${newData} (${existingMPerusahaan})`;

    return newContent;
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

  // Variable
  let flagProv = true;
  let flagKab = true;
  let flagKec = true;
  let flagKel = true;
  let idProvinsi = $("#valueProvinsi").val();
  let idKabupaten = $("#valueKabupaten").val();
  let idKecamatan = $("#valueKecamatan").val();
  let idKelurahan = $("#valueKelurahan").val();
  let wargaNegara = $("#valueWargaNegara").val();
  let agama = $("#valueAgama").val();
  let jenisKelamin = $("#valueJenisKelamin").val();
  let statPernikahan = $("#valueStatNikah").val();
  let statPendidikan = $("#valueStatPendidikan").val();

  // Input Mask
  $("#editNoKTP").inputmask("9999999999999999", { placeholder: "" });
  $("#editNoKK").inputmask("9999999999999999", { placeholder: "" });
  $("#editNoNPWP").inputmask("99.999.999.9-999.999");

  // Select Searchable
  $("#editProvData").select2({
    theme: "bootstrap4",
  });
  $("#editKotaData").select2({
    theme: "bootstrap4",
  });
  $("#editKecData").select2({
    theme: "bootstrap4",
  });
  $("#editKelData").select2({
    theme: "bootstrap4",
  });

  $("#editKewarganegaraan").select2({
    theme: "bootstrap4",
  });

  $("#editAgama").select2({
    theme: "bootstrap4",
  });

  $("#editJenisKelamin").select2({
    theme: "bootstrap4",
  });

  $("#editStatPernikahan").select2({
    theme: "bootstrap4",
  });

  $("#editPendidikanTerakhir").select2({
    theme: "bootstrap4",
  });

  // Trigger Change
  $("#editJenisKelamin").val(jenisKelamin).trigger("change");
  $("#editKewarganegaraan").val(wargaNegara).trigger("change");

  // Ajax
  $.ajax({
    type: "POST",
    url: site_url + "Daerah_api/get_prov",
    success: function (response) {
      var data = JSON.parse(response);
      $("#editProvData").html(data.prov);
      if (idProvinsi != "" && flagProv) {
        $("#editProvData").val(idProvinsi).trigger("change");
        flagProv = !flagProv;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data provinsi, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "GET",
    url: site_url + "Karyawan_api/dataAgama",
    success: function (response) {
      var data = JSON.parse(response);
      $("#editAgama").html(data.agama);
      $("#editAgama").val(agama).trigger("change");
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data agama, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "GET",
    url: site_url + "Karyawan_api/dataStatusNikah",
    success: function (response) {
      var data = JSON.parse(response);
      $("#editStatPernikahan").html(data.statnikah);
      $("#editStatPernikahan").val(statPernikahan).trigger("change");
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status pernikahan, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPendidikan",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editPendidikanTerakhir").html(data.pdk);
        $("#editPendidikanTerakhir").val(statPendidikan).trigger("change");
      } else {
        $("#editPendidikanTerakhir").html(data.pdk);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
        );
      }
    },
  });

  // Change Event
  $("#editProvData").change(function () {
    idProvinsi = $("#editProvData").val();
    $("#txtEditKota").LoadingOverlay("show");
    $("#txtEditKec").LoadingOverlay("show");
    $("#txtEditKel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: idProvinsi,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editKotaData").html(data.kab);
          if (idKabupaten != "" && flagKab) {
            $("#editKotaData").val(idKabupaten).trigger("change");
            flagKab = !flagKab;
          }
          $("#editKecData").html(
            "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKotaData").removeAttr("disabled");
          $("#refreshEditKota").removeAttr("disabled");
          $("#txtEditKota").LoadingOverlay("hide");
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKotaData").html(
            "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
          );
          $("#editKecData").html(
            "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKotaData").attr("disabled", true);
          $("#editKecData").attr("disabled", true);
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKota").attr("disabled", true);
          $("#refreshEditKec").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKota").LoadingOverlay("hide");
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKota").LoadingOverlay("hide");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
          );
        }
      },
    });
  });

  $("#editKotaData").change(function () {
    idKabupaten = $("#editKotaData").val();
    $("#txtEditKec").LoadingOverlay("show");
    $("#txtEditKel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: idKabupaten,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editKecData").html(data.kec);
          if (idKecamatan != "" && flagKec) {
            $("#editKecData").val(idKecamatan).trigger("change");
            flagKec = !flagKec;
          }
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKecData").removeAttr("disabled");
          $("#refreshEditKec").removeAttr("disabled");
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKecData").html(
            "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKecData").attr("disabled", true);
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKec").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#editKecData").change(function () {
    idKecamatan = $("#editKecData").val();
    $("#txtEditKel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: idKecamatan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editKelData").html(data.kel);
          if (idKelurahan != "" && flagKel) {
            $("#editKelData").val(idKelurahan).trigger("change");
            flagKel = !flagKel;
          }
          $("#editKelData").removeAttr("disabled");
          $("#refreshEditKel").removeAttr("disabled");
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKelData").html(
            "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
          );
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator"
          );
        }
      },
    });
  });

  // Click Event
  $("#refreshEditProv").click(function () {
    $("#txtEditProv").LoadingOverlay("show");
    $("#txtEditKota").LoadingOverlay("show");
    $("#txtEditKec").LoadingOverlay("show");
    $("#txtEditKel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_prov",
      success: function (response) {
        idProvinsi = "";
        idKabupaten = "";
        idKecamatan = "";
        idKelurahan = "";
        var data = JSON.parse(response);
        $("#editProvData").html(data.prov);
        $("#editKotaData").html(
          "<option value=''>-- PILIH PROVINSI TERLEBIH DAHULU --</option>"
        );
        $("#editKecData").html(
          "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
        );
        $("#editKelData").html(
          "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtEditProv").LoadingOverlay("hide");
        $("#txtEditKota").LoadingOverlay("hide");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        $("#editKotaData").attr("disabled", true);
        $("#editKecData").attr("disabled", true);
        $("#editKelData").attr("disabled", true);
        $("#refreshEditKota").attr("disabled", true);
        $("#refreshEditKec").attr("disabled", true);
        $("#refreshEditKel").attr("disabled", true);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditProv").LoadingOverlay("hide");
        $("#txtEditKota").LoadingOverlay("hide");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data provinsi, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditKota").click(function () {
    $("#txtEditKota").LoadingOverlay("show");
    $("#txtEditKec").LoadingOverlay("show");
    $("#txtEditKel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: $("#editProvData").val(),
      },
      success: function (response) {
        idKabupaten = "";
        idKecamatan = "";
        idKelurahan = "";
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editKotaData").html(data.kab);
          $("#editKecData").html(
            "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKecData").attr("disabled", true);
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKec").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKota").LoadingOverlay("hide");
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKotaData").html(
            "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
          );
          $("#editKecData").html(
            "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKecData").attr("disabled", true);
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKec").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKota").LoadingOverlay("hide");
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKota").LoadingOverlay("hide");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditKec").click(function () {
    $("#txtEditKec").LoadingOverlay("show");
    $("#txtEditKel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: $("#editKotaData").val(),
      },
      success: function (response) {
        idKecamatan = "";
        idKelurahan = "";
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editKecData").html(data.kec);
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKecData").html(
            "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
          );
          $("#editKelData").html(
            "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
          );
          $("#editKelData").attr("disabled", true);
          $("#refreshEditKel").attr("disabled", true);
          $("#txtEditKec").LoadingOverlay("hide");
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKec").LoadingOverlay("hide");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditKel").click(function () {
    $("#txtEditKel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: $("#editKecData").val(),
      },
      success: function (data) {
        idKelurahan = "";
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#editKelData").html(data.kel);
          $("#txtEditKel").LoadingOverlay("hide");
        } else {
          $("#editKelData").html(
            "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
          );
          $("#txtEditKel").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditStatNikah").click(function () {
    $("#txtEditNikah").LoadingOverlay("show");
    $.ajax({
      type: "GET",
      url: site_url + "Karyawan_api/dataStatusNikah",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editStatPernikahan").html(data.statnikah);
        $("#txtEditNikah").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditNikah").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status pernikahan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditDidik").click(function () {
    $("#txtEditDidik").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPendidikan",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editPendidikanTerakhir").html(data.pdk);
        $("#txtEditDidik").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditDidik").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
          );
        }
      },
    });
  });

  // Submit
  $("#updateDataPersonal").submit(function () {
    // Data Personal
    let id_personal = $("#valuePersonal").val();
    let no_ktp_old = $("#valueKTP").val();
    let new_no_ktp = $("#editNoKTP").val();
    let no_kk = $("#editNoKK").val();
    let nama_lengkap = $("#editNamaLengkap").val();
    let jk = $("#editJenisKelamin").val();
    let tmp_lahir = $("#editTempatLahir").val();
    let tgl_lahir = $("#editTanggalLahir").val();
    let id_stat_nikah = $("#editStatPernikahan").val();
    let id_agama = $("#editAgama").val();
    let warga_negara = $("#editKewarganegaraan").val();
    let email_pribadi = $("#editEmail").val();
    let no_hp = $("#editNoTelp").val();
    let no_bpjstk = $("#editNoBPJSTK").val();
    let no_bpjskes = $("#editNoBPJSKES").val();
    let no_npwp = $("#editNoNPWP").val();
    let id_pendidikan = $("#editPendidikanTerakhir").val();
    let sekolah = $("#editSekolah").val();
    let fakultas = $("#editFakultas").val();
    let jurusan = $("#editJurusan").val();
    // Data Alamat
    let id_alamat = $("#valueAlamat").val();
    let alamat = $("#editAlamatKTP").val();
    let rt = $("#editRtKTP").val();
    let rw = $("#editRwKTP").val();
    let id_prov = $("#editProvData").val();
    let id_kab = $("#editKotaData").val();
    let id_kec = $("#editKecData").val();
    let id_kel = $("#editKelData").val();

    if (checkAge(tgl_lahir) <= 15) {
      swal({
        title: "Usia tidak boleh kurang dari 15 tahun!",
        text: "Isi Usia dengan benar!",
        type: "info",
      }).then(function (result) {
        $("#editTanggalLahir").focus();
      });
    } else if (checkAge(tgl_lahir) >= 75) {
      swal({
        title: "Usia tidak boleh lebih dari 75 tahun!",
        text: "Isi Usia dengan benar!",
        type: "info",
      }).then(function (result) {
        $("#editTanggalLahir").focus();
      });
    } else {
      swal({
        title: "Simpan Data",
        text: "Data personal yang baru akan disimpan. Anda yakin?",
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
            url: site_url + "Karyawan_api/update_data_personal",
            data: {
              // Data Personal
              id_personal: id_personal,
              no_ktp_old: no_ktp_old,
              no_ktp: new_no_ktp,
              no_kk: no_kk,
              nama_lengkap: nama_lengkap,
              jk: jk,
              tmp_lahir: tmp_lahir,
              tgl_lahir: tgl_lahir,
              id_stat_nikah: id_stat_nikah,
              id_agama: id_agama,
              warga_negara: warga_negara,
              email_pribadi: email_pribadi,
              no_hp: no_hp,
              no_bpjstk: no_bpjstk,
              no_bpjskes: no_bpjskes,
              no_npwp: no_npwp,
              id_pendidikan: id_pendidikan,
              sekolah: sekolah,
              fakultas: fakultas,
              jurusan: jurusan,
              // Data Alamat
              id_alamat_ktp: id_alamat,
              alamat_ktp: alamat,
              rt_ktp: rt,
              rw_ktp: rw,
              kel_ktp: id_kel,
              kec_ktp: id_kec,
              kab_ktp: id_kab,
              prov_ktp: id_prov,
            },
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $("#pageHeader").html(pageHeader(nama_lengkap));
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
                  "Terjadi kesalahan saat menyimpan data personal, hubungi administrator"
                );
                $(".errormsg")
                  .fadeTo(3000, 500)
                  .slideUp(500, function () {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                  });
              } else {
                swal(
                  "Gagal",
                  "Terjadi kesalahan saat menyimpan data personal, hubungi administrator",
                  "error"
                );
              }
            },
          });
        }
      });
    }
  });

  /* Data Karyawan */
  // Variable
  let struktur_perusahaan = $("#valueStruktur").val();
  let flagSection = true;
  let flagPosisi = true;
  let flagGrade = true;
  let departemen = $("#valueDepartemen").val();
  let section = $("#valueSection").val();
  let posisi = $("#valuePosisi").val();
  let klasifikasi = $("#valueKlasifikasi").val();
  let golongan = $("#valueGolongan").val();
  let level = $("#valueLevel").val();
  let grade = $("#valueGrade").val();
  let roster = $("#valueRoster").val();
  let poh = $("#valuePointofHire").val();
  let lokasiPenerimaan = $("#valueLokasiPenerimaan").val();
  let lokasiKerja = $("#valueLokasiKerja").val();
  let statusResidence = $("#valueStatusResidence").val();
  let authKaryawan = $("#authKaryawan").val();
  let paybase = $("#valuePaybase").val();
  let pajak = $("#valuePajak").val();

  // Select Searchable
  $("#editDepartKary").select2({
    theme: "bootstrap4",
  });

  $("#editSectionKary").select2({
    theme: "bootstrap4",
  });

  $("#editPosisiKary").select2({
    theme: "bootstrap4",
  });

  $("#editKlasifikasiKary").select2({
    theme: "bootstrap4",
  });

  $("#editTipeKary").select2({
    theme: "bootstrap4",
  });

  $("#editLevelKary").select2({
    theme: "bootstrap4",
  });

  $("#editGradeKary").select2({
    theme: "bootstrap4",
  });

  $("#editRosterKary").select2({
    theme: "bootstrap4",
  });

  $("#editPOHKary").select2({
    theme: "bootstrap4",
  });

  $("#editLokterimaKary").select2({
    theme: "bootstrap4",
  });

  $("#editLokkerKary").select2({
    theme: "bootstrap4",
  });

  $("#editStatusResidence").select2({
    theme: "bootstrap4",
  });

  $("#editPaybase").select2({
    theme: "bootstrap4",
  });

  $("#editPajak").select2({
    theme: "bootstrap4",
  });

  // Ajax
  $.ajax({
    type: "POST",
    url: site_url + "Departemen_api/options_struktur",
    data: {
      auth_per: struktur_perusahaan,
    },
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editDepartKary").html(data.dprt);
        $("#editDepartKary").val(departemen).trigger("change");
      } else {
        $("#editDepartKary").html(data.dprt);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data departemen, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Level_api/options",
    data: {
      auth_per: struktur_perusahaan,
    },
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editLevelKary").html(data.lvl);
        $("#editLevelKary").val(level).trigger("change");
      } else {
        $("#editLevelKary").html(data.lvl);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data level, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataKlasifikasi",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editKlasifikasiKary").html(data.kls);
        $("#editKlasifikasiKary").val(klasifikasi).trigger("change");
      } else {
        $("#editKlasifikasiKary").html(data.kls);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataGolongan",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editTipeKary").html(data.tipe);
        $("#editTipeKary").val(golongan).trigger("change");
      } else {
        $("#editTipeKary").html(data.tipe);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data golongan, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Roster_api/options",
    data: {
      perusahaan: struktur_perusahaan,
    },
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editRosterKary").html(data.roster);
        $("#editRosterKary").val(roster).trigger("change");
      } else {
        $("#editRosterKary").html(data.roster);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data roster, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPOH",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editPOHKary").html(data.poh);
        $("#editPOHKary").val(poh).trigger("change");
      } else {
        $("#editPOHKary").html(data.poh);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data golongan, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataLokasiPenerimaan",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editLokterimaKary").html(data.lkt);
        $("#editLokterimaKary").val(lokasiPenerimaan).trigger("change");
      } else {
        $("#editLokterimaKary").html(data.lkt);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataLokasiKerja",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editLokkerKary").html(data.lkr);
        $("#editLokkerKary").val(lokasiKerja).trigger("change");
      } else {
        $("#editLokkerKary").html(data.lkr);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataResident",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#editStatusResidence").html(data.tgl);
        $("#editStatusResidence").val(statusResidence).trigger("change");
      } else {
        $("#editStatusResidence").html(data.tgl);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status residence, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPaybase",
    success: function (response) {
      var data = JSON.parse(response);
      $("#editPaybase").html(data.options);
      if (paybase != "0" && paybase != "") {
        $("#editPaybase").val(paybase).trigger("change");
      }
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
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_api/dataPajak",
    success: function (response) {
      var data = JSON.parse(response);
      $("#editPajak").html(data.options);
      if (pajak != "0" && pajak != "") {
        $("#editPajak").val(pajak).trigger("change");
      }
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
      }
    },
  });

  // Change Event
  $("#editDepartKary").change(function () {
    let selectedDepartemen = $("#editDepartKary").val();
    $("#txtEditPosisiKary").LoadingOverlay("show");
    $("#txtEditSectionKary").LoadingOverlay("show");

    if (flagSection) {
      $.ajax({
        type: "POST",
        url: site_url + "Section_api/options",
        data: {
          auth_depart: departemen,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editSectionKary").html(data.section);
            $("#editSectionKary").val(section).trigger("change");
            $("#editSectionKary").removeAttr("disabled");
            $("#refreshEditSection").removeAttr("disabled");
            $("#txtEditSectionKary").LoadingOverlay("hide");
            flagSection = !flagSection;
          } else {
            $("#editSectionKary").html(data.section);
            $("#editSectionKary").attr("disabled", true);
            $("#refreshEditSection").attr("disabled", true);
            $("#txtEditSectionKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditSectionKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data section, hubungi administrator"
            );
          }
        },
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Section_api/options",
        data: {
          auth_depart: selectedDepartemen,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editSectionKary").html(data.section);
            if (departemen == selectedDepartemen) {
              $("#editSectionKary").val(section).trigger("change");
            }
            $("#editSectionKary").removeAttr("disabled");
            $("#refreshEditSection").removeAttr("disabled");
            $("#txtEditSectionKary").LoadingOverlay("hide");
          } else {
            $("#editSectionKary").html(data.section);
            $("#editSectionKary").attr("disabled", true);
            $("#refreshEditSection").attr("disabled", true);
            $("#txtEditSectionKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditSectionKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data section, hubungi administrator"
            );
          }
        },
      });
    }

    if (flagPosisi) {
      $.ajax({
        type: "POST",
        url: site_url + "Posisi_api/options",
        data: {
          auth_depart: departemen,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editPosisiKary").html(data.posisi);
            $("#editPosisiKary").val(posisi).trigger("change");
            $("#editPosisiKary").removeAttr("disabled");
            $("#refreshEditPosisi").removeAttr("disabled");
            $("#txtEditPosisiKary").LoadingOverlay("hide");
            flagPosisi = !flagPosisi;
          } else {
            $("#editPosisiKary").html(data.posisi);
            $("#editPosisiKary").attr("disabled", true);
            $("#refreshEditPosisi").attr("disabled", true);
            $("#txtEditPosisiKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditPosisiKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data posisi, hubungi administrator"
            );
          }
        },
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Posisi_api/options",
        data: {
          auth_depart: selectedDepartemen,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editPosisiKary").html(data.posisi);
            if (departemen == selectedDepartemen) {
              $("#editPosisiKary").val(posisi).trigger("change");
            }
            $("#editPosisiKary").removeAttr("disabled");
            $("#refreshEditPosisi").removeAttr("disabled");
            $("#txtEditPosisiKary").LoadingOverlay("hide");
          } else {
            $("#editPosisiKary").html(data.posisi);
            $("#editPosisiKary").attr("disabled", true);
            $("#refreshEditPosisi").attr("disabled", true);
            $("#txtEditPosisiKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditPosisiKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data posisi, hubungi administrator"
            );
          }
        },
      });
    }
  });

  $("#editLevelKary").change(function () {
    let selectedLevel = $("#editLevelKary").val();
    $("#txtEditGradeKary").LoadingOverlay("show");

    if (flagGrade) {
      $.ajax({
        type: "POST",
        url: site_url + "Grade_api/options",
        data: {
          auth_level: level,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editGradeKary").html(data.grade);
            $("#editGradeKary").val(grade).trigger("change");
            $("#editGradeKary").removeAttr("disabled");
            $("#refreshEditGrade").removeAttr("disabled");
            $("#txtEditGradeKary").LoadingOverlay("hide");
            flagGrade = !flagGrade;
          } else {
            $("#editGradeKary").html(data.grade);
            $("#editGradeKary").attr("disabled", true);
            $("#refreshEditGrade").attr("disabled", true);
            $("#txtEditGradeKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditGradeKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data grade, hubungi administrator"
            );
          }
        },
      });
    } else {
      $.ajax({
        type: "POST",
        url: site_url + "Grade_api/options",
        data: {
          auth_level: selectedLevel,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#editGradeKary").html(data.grade);
            if (level == selectedLevel) {
              $("#editGradeKary").val(grade).trigger("change");
            }
            $("#editGradeKary").removeAttr("disabled");
            $("#refreshEditGrade").removeAttr("disabled");
            $("#txtEditGradeKary").LoadingOverlay("hide");
          } else {
            $("#editGradeKary").html(data.grade);
            $("#editGradeKary").attr("disabled", true);
            $("#refreshEditGrade").attr("disabled", true);
            $("#txtEditGradeKary").LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtEditGradeKary").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data grade, hubungi administrator"
            );
          }
        },
      });
    }
  });

  // Click Event
  $("#refreshEditDepart").click(function () {
    $("#txtEditDepartKary").LoadingOverlay("show");
    $("#txtEditSectionKary").LoadingOverlay("show");
    $("#txtEditPosisiKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Departemen_api/options_struktur",
      data: {
        auth_per: struktur_perusahaan,
      },
      success: function (response) {
        departemen = "";
        posisi = "";
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editDepartKary").html(data.dprt);
          $("#editSectionKary").html(
            "<option value=''>-- PILIH DEPARTEMEN TERLEBIH DAHULU --</option>"
          );
          $("#editPosisiKary").html(
            "<option value=''>-- PILIH DEPARTEMEN TERLEBIH DAHULU --</option>"
          );
          $("#txtEditDepartKary").LoadingOverlay("hide");
          $("#txtEditSectionKary").LoadingOverlay("hide");
          $("#txtEditPosisiKary").LoadingOverlay("hide");
          $("#editSectionKary").attr("disabled", true);
          $("#refreshEditSection").attr("disabled", true);
          $("#editPosisiKary").attr("disabled", true);
          $("#refreshEditPosisi").attr("disabled", true);
        } else {
          $("#editDepartKary").html(data.dprt);
          $("#editSectionKary").html(
            "<option value=''>-- PILIH DEPARTEMEN TERLEBIH DAHULU --</option>"
          );
          $("#editPosisiKary").html(
            "<option value=''>-- PILIH DEPARTEMEN TERLEBIH DAHULU --</option>"
          );
          $("#txtEditDepartKary").LoadingOverlay("hide");
          $("#txtEditSectionKary").LoadingOverlay("hide");
          $("#txtEditPosisiKary").LoadingOverlay("hide");
          $("#editSectionKary").attr("disabled", true);
          $("#refreshEditSection").attr("disabled", true);
          $("#editPosisiKary").attr("disabled", true);
          $("#refreshEditPosisi").attr("disabled", true);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditDepartKary").LoadingOverlay("hide");
        $("#txtEditSectionKary").LoadingOverlay("hide");
        $("#txtEditPosisiKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data departemen, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditSection").click(function () {
    $("#txtEditSectionKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Section_api/options",
      data: {
        auth_depart: $("#editDepartKary").val(),
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editSectionKary").html(data.section);
          $("#editSectionKary").removeAttr("disabled");
          $("#refreshEditSection").removeAttr("disabled");
          $("#txtEditSectionKary").LoadingOverlay("hide");
        } else {
          $("#editSectionKary").html(data.section);
          $("#editSectionKary").attr("disabled", true);
          $("#refreshEditSection").attr("disabled", true);
          $("#txtEditSectionKary").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditSectionKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data section, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditPosisi").click(function () {
    $("#txtEditPosisiKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Posisi_api/options",
      data: {
        auth_depart: $("#editDepartKary").val(),
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editPosisiKary").html(data.posisi);
          $("#editPosisiKary").removeAttr("disabled");
          $("#refreshEditPosisi").removeAttr("disabled");
          $("#txtEditPosisiKary").LoadingOverlay("hide");
        } else {
          $("#editPosisiKary").html(data.posisi);
          $("#editPosisiKary").attr("disabled", true);
          $("#refreshEditPosisi").attr("disabled", true);
          $("#txtEditPosisiKary").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditPosisiKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data posisi, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditKlasifikasi").click(function () {
    $("#txtEditKlasifikasiKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataKlasifikasi",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editKlasifikasiKary").html(data.kls);
        $("#txtEditKlasifikasiKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditKlasifikasiKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditTipe").click(function () {
    $("#txtEditJeniskary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataGolongan",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editTipeKary").html(data.tipe);
        $("#txtEditJeniskary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditJeniskary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data golongan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditLevel").click(function () {
    $("#txtEditLevelKary").LoadingOverlay("show");
    $("#txtEditGradeKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Level_api/options",
      data: {
        auth_per: struktur_perusahaan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#editLevelKary").html(data.lvl);
        $("#editGradeKary").html(
          "<option value=''>-- PILIH LEVEL TERLEBIH DAHULU --</option>"
        );
        $("#txtEditLevelKary").LoadingOverlay("hide");
        $("#txtEditGradeKary").LoadingOverlay("hide");
        $("#editGradeKary").attr("disabled", true);
        $("#refreshEditGrade").attr("disabled", true);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditLevelKary").LoadingOverlay("hide");
        $("#txtEditGradeKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data level, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditGrade").click(function () {
    $("#txtEditGradeKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Grade_api/options",
      data: {
        auth_level: $("#editLevelKary").val(),
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#editGradeKary").html(data.grade);
          $("#editGradeKary").removeAttr("disabled");
          $("#refreshEditGrade").removeAttr("disabled");
          $("#txtEditGradeKary").LoadingOverlay("hide");
        } else {
          $("#editGradeKary").html(data.grade);
          $("#editGradeKary").attr("disabled", true);
          $("#refreshEditGrade").attr("disabled", true);
          $("#txtEditGradeKary").LoadingOverlay("hide");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditGradeKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data grade, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditRoster").click(function () {
    $("#txtEditRosterKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Roster_api/options",
      data: {
        perusahaan: struktur_perusahaan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#editRosterKary").html(data.roster);
        $("#txtEditRosterKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditRosterKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data roster, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditPOH").click(function () {
    $("#txtEditPOHKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPOH",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editPOHKary").html(data.poh);
        $("#txtEditPOHKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditPOHKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data point of hire, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditLokterima").click(function () {
    $("#txtEditLokterimaKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataLokasiPenerimaan",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editLokterimaKary").html(data.lkt);
        $("#txtEditLokterimaKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditLokterimaKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditLokker").click(function () {
    $("#txtEditLokkerKary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataLokasiKerja",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editLokkerKary").html(data.lkr);
        $("#txtEditLokkerKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditLokkerKary").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditResidence").click(function () {
    $("#txtEditStatResidence").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataResident",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editStatusResidence").html(data.tgl);
        $("#txtEditStatResidence").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtEditStatResidence").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status residence, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditPaybase").click(function () {
    $("#txtEditPaybase").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPaybase",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editPaybase").html(data.options);
        $("#txtEditPaybase").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtEditPaybase").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data paybase, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshEditPajak").click(function () {
    $("#txtEditPajak").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_api/dataPajak",
      success: function (response) {
        var data = JSON.parse(response);
        $("#editPajak").html(data.options);
        $("#txtEditPajak").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtEditPajak").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status pajak, hubungi administrator"
          );
        }
      },
    });
  });

  // Load Data
  $("#dataKontrakKaryawan").load(
    site_url + "Karyawan_api/kontrak?auth_karyawan=" + authKaryawan
  );

  // Click Event
  $(document).on("click", ".hapusKontrak", function () {
    let auth = $(this).attr("id");

    swal({
      title: "Hapus Kontrak Kerja",
      text: "Yakin data kontrak kerja akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#dataKontrakKaryawan").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Karyawan_api/delete_kontrak",
          data: {
            auth: auth,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#dataKontrakKaryawan").load(
                site_url + "Karyawan_api/kontrak?auth_karyawan=" + authKaryawan
              );
              $("#dataKontrakKaryawan").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $("#dataKontrakKaryawan").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#dataKontrakKaryawan").LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat menghapus kontrak kerja, hubungi administrator"
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

  // Submit
  $("#updateDataKaryawan").submit(function () {
    let id_karyawan = $("#valueKaryawan").val();
    let no_nik = $("#editNIKKary").val();
    let auth_departemen = $("#editDepartKary").val();
    let auth_section = $("#editSectionKary").val();
    let auth_posisi = $("#editPosisiKary").val();
    let id_klasifikasi = $("#editKlasifikasiKary").val();
    let id_tipe = $("#editTipeKary").val();
    let auth_level = $("#editLevelKary").val();
    let auth_grade = $("#editGradeKary").val();
    let auth_roster = $("#editRosterKary").val();
    let auth_poh = $("#editPOHKary").val();
    let auth_lokterima = $("#editLokterimaKary").val();
    let auth_lokker = $("#editLokkerKary").val();
    let stat_tinggal = $("#editStatusResidence").val();
    let doh = $("#editDOH").val();
    let tgl_aktif = $("#editTanggalAktif").val();
    let email_kantor = $("#editEmailKantor").val();
    let paybase = $("#editPaybase").val();
    let pajak = $("#editPajak").val();

    swal({
      title: "Simpan Data",
      text: "Yakin data karyawan akan disimpan?",
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
          url: site_url + "Karyawan_api/update_data_karyawan",
          data: {
            id_karyawan: id_karyawan,
            no_nik: no_nik,
            auth_departemen: auth_departemen,
            auth_section: auth_section,
            auth_posisi: auth_posisi,
            auth_lokker: auth_lokker,
            auth_lokterima: auth_lokterima,
            auth_poh: auth_poh,
            id_tipe: id_tipe,
            auth_level: auth_level,
            auth_grade: auth_grade,
            auth_roster: auth_roster,
            id_klasifikasi: id_klasifikasi,
            doh: doh,
            tgl_aktif: tgl_aktif,
            stat_tinggal: stat_tinggal,
            email_kantor: email_kantor,
            paybase: paybase,
            pajak: pajak,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
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
                "Terjadi kesalahan saat memperbarui data karyawan, hubungi administrator"
              );
            }
          },
        });
      }
    });
  });

  /* Data Tambahan */
  // Variable
  let bankID = $("#authBank").val();
  let id_personal = $("#valuePersonal").val();

  // Inputmask
  $("#keluargaNIK").inputmask("9999999999999999", { placeholder: "" });
  $("#updateKeluargaNIK").inputmask("9999999999999999", { placeholder: "" });

  // Select Searchable
  $("#statusIbu").select2({
    theme: "bootstrap4",
  });
  $("#statusAyah").select2({
    theme: "bootstrap4",
  });
  $("#bank").select2({
    theme: "bootstrap4",
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

  // Ajax
  $.ajax({
    type: "POST",
    url: site_url + "Bank_api/options",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#bank").html(data.options);
        $("#bank").val(bankID).trigger("change");
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

  // Load Data
  $("#dataKeluarga").load(site_url + "Keluarga_api/data?auth=" + id_personal);

  // Change
  $("#keluargaTipe").change(function () {
    let tipeValue = $(this).val();
    if (tipeValue == "0") {
      if (jenisKelamin == "LK") {
        $("#keluargaJenisKelamin").val("P").trigger("change");
      } else {
        $("#keluargaJenisKelamin").val("L").trigger("change");
      }
    } else {
      $("#keluargaJenisKelamin").val("").trigger("change");
    }
  });

  // Click Event
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

  // Submit
  $("#addDataKeluarga").submit(function () {
    let auth = $("#valuePersonal").val();
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
            auth: auth,
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
                site_url + "Keluarga_api/data?auth=" + id_personal
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
    let auth = $("#valuePersonal").val();
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
            auth: auth,
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
                site_url + "Keluarga_api/data?auth=" + id_personal
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

  $("#updateDataTambahan").submit(function () {
    let id_personal = $("#valuePersonal").val();
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

    swal({
      title: "Simpan Data",
      text: "Yakin data tambahan karyawan akan disimpan?",
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
          url: site_url + "Karyawan_api/update_data_tambahan",
          data: {
            id_personal: id_personal,
            namaIbu: namaIbu.toUpperCase(),
            statusIbu: statusIbu,
            namaAyah: namaAyah.toUpperCase(),
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
                "Terjadi kesalahan saat memperbarui data tambahan, hubungi administrator"
              );
            }
          },
        });
      }
    });
  });

  /* Data Sertifikasi */
  // Variable
  let auth_personal = $("#authPersonal").val();

  // Load Data
  $("#idEditSertifikat").load(
    site_url + "Karyawan_api/sertifikasi_update?auth_person=" + auth_personal
  );

  // Click Event
  $(document).on("click", ".hapus_sertifikasi", function () {
    let auth_Sertifikat = $(this).attr("id");
    let no_sertifikat = $(this).attr("value");

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
        $("#idEditSertifikat").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Karyawan_api/delete_sertifikasi",
          data: {
            auth_Sertifikat: auth_Sertifikat,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#idEditSertifikat").load(
                site_url +
                  "Karyawan_api/sertifikasi_update?auth_person=" +
                  auth_personal
              );
              $("#idEditSertifikat").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $("#idEditSertifikat").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#idEditSertifikat").LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat menghapus sertifikat, hubungi administrator"
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

  /* Data MCU */
  // Load Data
  $("#dataEditMCU").load(
    site_url + "Karyawan_api/data_mcu?auth_person=" + auth_personal
  );

  // Click Event
  $(document).on("click", ".hapusMCU ", function () {
    let auth_mcu = $(this).attr("id");
    swal({
      title: "Hapus MCU",
      text: "Yakin data MCU akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#dataEditMCU").LoadingOverlay("show");
        $.ajax({
          type: "post",
          url: site_url + "Karyawan_api/delete_mcu",
          data: {
            auth_mcu: auth_mcu,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#dataEditMCU").load(
                site_url + "Karyawan_api/data_mcu?auth_person=" + auth_personal
              );
              $("#dataEditMCU").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else if (data.statusCode == 201) {
              $("#dataEditMCU").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            } else if (data.statusCode == 202) {
              $("#dataEditMCU").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#dataEditMCU").LoadingOverlay("hide");
            swal(
              "Gagal",
              "Terjadi error saat hapus data mcu, hubungi administrator",
              "error"
            );
          },
        });
      } else {
        swal.close();
      }
    });
  });

  /* Data Vaksin */
  $("#idEditVaccine").load(
    site_url + "Karyawan_api/vaksin?auth_person=" + auth_personal
  );

  // Click Event
  $(document).on("click", ".editHapusVaccine", function () {
    let auth_vaksin = $(this).attr("id");

    swal({
      title: "Hapus Vaksin",
      text: "Yakin data vaksin ini akan dihapus ?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $("#idEditVaccine").LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "Karyawan_api/delete_vaksin",
          data: {
            auth_vaksin: auth_vaksin,
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              $("#idEditVaccine").load(
                site_url + "Karyawan_api/vaksin?auth_person=" + auth_personal
              );
              $("#idEditVaccine").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $("#idEditVaccine").LoadingOverlay("hide");
              swal("Gagal", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("#idEditVaccine").LoadingOverlay("hide");
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
