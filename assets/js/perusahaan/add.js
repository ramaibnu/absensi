$(document).ready(function () {
  $.LoadingOverlay("show");
  // Function
  function resetaddperusahaan() {
    $("#kodePerusahaan").val("");
    $("#Perusahaan").val("");
    $("#alamatPerusahaan").val("");
    $("#kodeposPerusahaan").val("");
    $("#provPerusahaan").val("").trigger("change");
    $("#telpPerusahaan").val("");
    $("#emailPerusahaan").val("");
    $("#webPerusahaan").val("");
    $("#npwpPerusahaan").val("");
    $("#kegPerusahaan").val("");
    $("#ketPerusahaan").val("");
  }

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

  // Data Provinsi
  $("#txtprovadd").LoadingOverlay("show");
  $.ajax({
    type: "post",
    url: site_url + "Daerah_api/get_prov",
    success: function (response) {
      var data = JSON.parse(response);
      $("#provPerusahaan").html(data.prov);
      $("#txtprovadd").LoadingOverlay("hide");
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data provinsi, hubungi administrator";
        $("#btnTambahPerusahaan").remove();
      } else {
        pesan = "";
      }
      swal("Error", pesan, "error");
    },
  });

  // Change Select
  $("#provPerusahaan").change(function () {
    $("#txtkabadd").LoadingOverlay("show");
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");

    let id_prov = $("#provPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: id_prov,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kabPerusahaan").html(data.kab);
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
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }
        swal("Error", pesan, "error");
      },
    });
  });
  $("#kabPerusahaan").change(function () {
    $("#txtkecadd").LoadingOverlay("show");
    $("#txtkeladd").LoadingOverlay("show");

    let id_kab = $("#kabPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: id_kab,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kecPerusahaan").html(data.kec);
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
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
  $("#kecPerusahaan").change(function () {
    $("#txtkeladd").LoadingOverlay("show");

    let id_kec = $("#kecPerusahaan").val();
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: id_kec,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kelPerusahaan").html(data.kel);
        $("#txtkeladd").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
          $("#btnTambahPerusahaan").remove();
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
      url: site_url + "Daerah_api/get_prov",
      success: function (response) {
        var data = JSON.parse(response);
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
          $("#btnTambahPerusahaan").remove();
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
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: id_prov,
      },
      success: function (response) {
        var data = JSON.parse(response);
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
          $("#btnTambahPerusahaan").remove();
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
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: id_kab,
      },
      success: function (response) {
        var data = JSON.parse(response);
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
          $("#btnTambahPerusahaan").remove();
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
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: id_kec,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#kelPerusahaan").html(data.kel);
        $("#kelPerusahaan").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });

  // Button Click
  $("#btnBatalPerusahaan").click(function () {
    location.reload();
  });
  
  // Submit
  $("#tambahPerusahaan").submit(function () {
    var kode = $("#kodePerusahaan").val();
    var perusahaan = $("#Perusahaan").val();
    var alamat = $("#alamatPerusahaan").val();
    var kodepos = $("#kodeposPerusahaan").val();
    var prov = $("#provPerusahaan").val();
    var kab = $("#kabPerusahaan").val();
    var kec = $("#kecPerusahaan").val();
    var kel = $("#kelPerusahaan").val();
    var telp = $("#telpPerusahaan").val();
    var email = $("#emailPerusahaan").val();
    var web = $("#webPerusahaan").val();
    var npwp = $("#npwpPerusahaan").val();
    var keg = $("#kegPerusahaan").val();
    var ket = $("#ketPerusahaan").val();

    $.ajax({
      type: "POST",
      url: site_url + "Perusahaan_api/insert",
      data: {
        kode: kode,
        perusahaan: perusahaan,
        alamat: alamat,
        kodepos: kodepos,
        prov: prov,
        kab: kab,
        kec: kec,
        kel: kel,
        telp: telp,
        email: email,
        npwp: npwp,
        web: web,
        keg: keg,
        ket: ket,
      },
      timeout: 20000,
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          resetaddperusahaan();
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (xhr.status == 404) {
          pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
        } else {
          pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
