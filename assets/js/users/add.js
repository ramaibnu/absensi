$(document).ready(function () {
  // Select
  $("#aksesUser").select2({
    theme: "bootstrap4",
  });

  $("#perusahaanUser").select2({
    theme: "bootstrap4",
  });

  // Submit
  $("#addUser").submit(function () {
    let nama_user = $("#namaUser").val();
    let email_user = $("#emailUser").val();
    let tgl_aktif = $("#tglAktif").val();
    let tgl_exp = $("#tglExpired").val();
    let sesi = $("#sandiUser").val();
    let id_menu = $("#aksesUser").val();
    let id_m_perusahaan = $("#perusahaanUser").val();

    if (tgl_exp < tgl_aktif) {
      swal({
        title: "Tanggal Expired harus setelah Tanggal Aktif!",
        text: "Isi Tanggal Expired dengan benar!",
        type: "warning",
      }).then(function () {
        $("#tglExpired").focus();
      });
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "User_api/insert",
        data: {
          nama_user: nama_user,
          email_user: email_user,
          tgl_aktif: tgl_aktif,
          tgl_exp: tgl_exp,
          sesi: sesi,
          id_menu: id_menu,
          id_m_perusahaan: id_m_perusahaan,
        },
        timeout: 20000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#namaUser").val("");
            $("#emailUser").val("");
            $("#tglAktif").val("");
            $("#tglExpired").val("");
            $("#sandiUser").val("");
            $("#ulangSandi").val();
            $("#aksesUser").val("");
            $("#perusahaanUser").val("");
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Unit gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Unit gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menambah data user, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });
});
