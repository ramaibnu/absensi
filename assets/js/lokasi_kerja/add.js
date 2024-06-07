$(document).ready(function () {
  // Function
  function resetaddlokker() {
    $("#kodeLokker").val("");
    $("#Lokker").val("");
    $("#ketLokker").val("");
  }
  // Click
  $("#btnBatalLokker").click(function () {
    resetaddlokker();
  });

  // Submit
  $("#tambahLokasiKerja").submit(function () {
    var kode = $("#kodeLokker").val();
    var lokker = $("#Lokker").val();
    var ket = $("#ketLokker").val();

    $.ajax({
      type: "POST",
      url: site_url + "LokasiKerja_api/insert",
      data: {
        kode: kode.toUpperCase(),
        lokker: lokker.toUpperCase(),
        ket: ket,
      },
      timeout: 20000,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          resetaddlokker();
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (xhr.status == 404) {
          pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
