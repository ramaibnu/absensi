$(document).ready(function () {
  $.LoadingOverlay("show");
  // Select Searchable
  $("#provPerusahaan").select2({
    theme: "bootstrap4",
  });
  $("#kabPerusahaan").select2({
    theme: "bootstrap4",
  });
  $("#kecPerusahaan").select2({
    theme: "bootstrap4",
  });
  $("#kelPerusahaan").select2({
    theme: "bootstrap4",
  });

  // Data Daerah
  $("#txtprovadd").LoadingOverlay("show");
  $.ajax({
    type: "post",
    url: site_url + "daerah/get_prov?authtoken=" + $("#token").val(),
    success: function (data) {
      var data = JSON.parse(data);
      $("#provPerusahaan").html(data.prov);
      $("#provPerusahaan").val($("#id_prov").val()).trigger("change");
      $("#txtprovadd").LoadingOverlay("hide");
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data provinsi, hubungi administrator";
      } else {
        pesan = "";
      }
      swal("Error", pesan, "error");
    },
  });

  // $("#txtkecadd").LoadingOverlay("show");
  // $.ajax({
  //   type: "post",
  //   url: site_url + "daerah/get_kec?authtoken=" + $("#token").val(),
  //   success: function (data) {
  //     var data = JSON.parse(data);
  //     $("#kecPerusahaan").html(data.kec);
  //     $("#txtkecadd").LoadingOverlay("hide");
  //   },
  //   error: function (xhr, ajaxOptions, thrownError) {
  //     $.LoadingOverlay("hide");
  //     if (thrownError != "") {
  //       pesan =
  //         "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
  //     } else {
  //       pesan = "";
  //     }
  //     swal("Error", pesan, "error");
  //   },
  // });

  // $("#txtkeladd").LoadingOverlay("show");
  // $.ajax({
  //   type: "post",
  //   url: site_url + "daerah/get_kel?authtoken=" + $("#token").val(),
  //   success: function (data) {
  //     var data = JSON.parse(data);
  //     $("#kelPerusahaan").html(data.kel);
  //     $("#txtkeladd").LoadingOverlay("hide");
  //   },
  //   error: function (xhr, ajaxOptions, thrownError) {
  //     $.LoadingOverlay("hide");
  //     if (thrownError != "") {
  //       pesan =
  //         "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
  //     } else {
  //       pesan = "";
  //     }
  //     swal("Error", pesan, "error");
  //   },
  // });

  // Change Select
  let firstProv = true;
  $("#provPerusahaan").change(function () {
    $("#txtkabadd").LoadingOverlay("show");
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");

    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kab?authtoken=" + $("#token").val(),
      data: {
        id_prov: $("#provPerusahaan").val(),
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kabPerusahaan").html(data.kab);
        if (firstProv) {
          $("#kabPerusahaan").val($("#id_kabupaten").val()).trigger("change");
          firstProv = false;
        }
        $("#kecPerusahaan").html(
          "<option value=''>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
        );
        $("#kelPerusahaan").html(
          "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtkabadd").LoadingOverlay("hide");
        $("#txtkecadd").LoadingOverlay("hide");
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
        } else {
          pesan = "";
        }
        swal("Error", pesan, "error");
      },
    });
  });
  
  let firstKab = true;
  $("#kabPerusahaan").change(function () {
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");
    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kec?authtoken=" + $("#token").val(),
      data: {
        id_kab: $("#kabPerusahaan").val(),
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kecPerusahaan").html(data.kec);
        if (firstKab) {
          $("#kecPerusahaan").val($("#id_kecamatan").val()).trigger("change");
          firstKab = false;
        }
        $("#kelPerusahaan").html(
          "<option value=''>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtkecadd").LoadingOverlay("hide");
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });

  let firstKec = true;
  $("#kecPerusahaan").change(function () {
    $("#txtkeladd").LoadingOverlay("show");
    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kel?authtoken=" + $("#token").val(),
      data: {
        id_kec: $("#kecPerusahaan").val(),
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kelPerusahaan").html(data.kel);
        if (firstKec) {
          $("#kelPerusahaan").val($("#id_kelurahan").val()).trigger("change");
          firstKec = false;
        }
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });

  // Refresh Select
  $(".refprov").click(function () {
    $("#txtprovadd").LoadingOverlay("show");
    $("#txtkabadd").LoadingOverlay("show");
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");

    $.ajax({
      type: "post",
      url: site_url + "daerah/get_prov?authtoken=" + $("#token").val(),
      success: function (data) {
        var data = JSON.parse(data);
        $("#provPerusahaan").html(data.prov);
        $("#kabPerusahaan").html(
          "<option value='0000'>-- PILIH PROVINSI TERLEBIH DAHULU --</option>"
        );
        $("#kecPerusahaan").html(
          "<option value='000000'>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
        );
        $("#kelPerusahaan").html(
          "<option value='00000000'>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtprovadd").LoadingOverlay("hide");
        $("#txtkabadd").LoadingOverlay("hide");
        $("#txtkecadd").LoadingOverlay("hide");
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data provinsi, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
  $(".refkab").click(function () {
    $("#txtkabadd").LoadingOverlay("show");
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");

    let id_prov = $("#provPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kab?authtoken=" + $("#token").val(),
      data: {
        id_prov: id_prov,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kabPerusahaan").html(data.kab);
        $("#kecPerusahaan").html(
          "<option value='000000'>-- PILIH KABUPATEN/KOTA TERLEBIH DAHULU --</option>"
        );
        $("#kelPerusahaan").html(
          "<option value='00000000'>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtkabadd").LoadingOverlay("hide");
        $("#txtkecadd").LoadingOverlay("hide");
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
        } else {
          pesan = "";
        }
        swal("Error", pesan, "error");
      },
    });
  });
  $(".refkec").click(function () {
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");
    let id_kab = $("#kabPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kec?authtoken=" + $("#token").val(),
      data: {
        id_kab: id_kab,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kecPerusahaan").html(data.kec);
        $("#kelPerusahaan").html(
          "<option value='00000000'>-- PILIH KECAMATAN TERLEBIH DAHULU --</option>"
        );
        $("#txtkecadd").LoadingOverlay("hide");
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
  $(".refkel").click(function () {
    $("#kelPerusahaan").LoadingOverlay("show");
    let id_kec = $("#kecPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "daerah/get_kel?authtoken=" + $("#token").val(),
      data: {
        id_kec: id_kec,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kelPerusahaan").html(data.kel);
        $("#kelPerusahaan").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
