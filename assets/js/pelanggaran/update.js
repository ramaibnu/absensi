$(document).ready(function () {
  // Click Event
  $("#btnSelesai").click(function () {
    window.top.close();
  });

  $("#btnGantiBerkas").click(function () {
    let authlgr = $("#authLgrEdit").val();
    $("#editBerkasPunishment").modal("show");
    $("#authlanggarberkas").val(authlgr);
  });

  $("#updateFile").on("submit", function () {
    let authlgr = $("#authlanggarberkas").val();
    let berkaslgr = $("#berkasPunishEdit").val();
    const fllgr = $("#berkasPunishEdit").prop("files")[0];

    let fileExtension = berkaslgr.split(".").pop().toLowerCase();
    let sizeFile = fllgr["size"];

    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "Berkas/File yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran Berkas/File yang dipilih melebihi 100kb",
        type: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("berkasPunishEdit", fllgr);
      formData.append("berkaslgr", berkaslgr);
      formData.append("authlgr", authlgr);

      $.ajax({
        type: "POST",
        url: site_url + "Pelanggaran_api/upload_file",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#editBerkasPunishment").modal("hide");
            $("#btnBerkasTampil").attr("href", data.brks);
            $("#berkasPunishEdit").val("");
            swal("Berhasil", data.pesan, "success");
          } else {
            swal("Error", data.pesan, "error");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          swal("Error", "Terjadi kesalahan saat mengupload file", "error");
        },
      });
    }
  });

  // Select Searchable
  $("#jenisLgrEdit").select2({
    theme: "bootstrap4",
    width: "100%",
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#jenisLgrEdit").select2({
        theme: "bootstrap4",
        width: "100%",
      });
    },
    true
  );
});
