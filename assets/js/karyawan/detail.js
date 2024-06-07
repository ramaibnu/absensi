$(document).ready(function () {
  // Function
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
});
