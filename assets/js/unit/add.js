$(document).ready(function () {
  // Click
  $("#btnBatalUnit").click(function () {
    $("#KodeUnit").val("");
    $("#Unit").val("");
    $("#ketUnit").val("");
  });

  // Submit
  $("#tambahUnit").submit(function () {
    var kode_unit = $("#KodeUnit").val();
    var unit = $("#Unit").val();
    var ket = $("#ketUnit").val();

    $.ajax({
      type: "POST",
      url: site_url + "Unit_api/insert",
      data: {
        kode_unit: kode_unit.toUpperCase(),
        unit: unit.toUpperCase(),
        ket: ket,
      },
      timeout: 20000,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $("#KodeUnit").val("");
          $("#Unit").val("");
          $("#ketUnit").val("");
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
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
            "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
