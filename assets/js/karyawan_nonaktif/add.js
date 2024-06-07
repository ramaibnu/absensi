$(document).ready(function () {
  $.LoadingOverlay("show");
  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Karyawan_nonaktif_api/dataAlasan",
    success: function (response) {
      var data = JSON.parse(response);
      $("#alasanNonaktif").html(data.alasan);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".err_psn_nonaktifkary").removeClass("d-none");
      if (thrownError != "") {
        $(".err_psn_nonaktifkary").html(
          "Terjadi kesalahan saat load alasan nonaktif, hubungi administrator"
        );
        $("#btnNonaktifkanKary").remove();
      }

      $(".err_psn_nonaktifkary")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".err_psn_nonaktifkary").slideUp(500);
          $(".err_psn_nonaktifkary").addClass("d-none");
        });
    },
  });

  // Select Searchable
  $("#perNonkatifKary").select2({
    theme: "bootstrap4",
  });

  $("#alasanNonaktif").select2({
    theme: "bootstrap4",
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perNonkatifKary").select2({
        theme: "bootstrap4",
      });

      $("#alasanNonaktif").select2({
        theme: "bootstrap4",
      });
    },
    true
  );

  // Change Event
  $("#alasanNonaktif").change(function () {
    let auth_alasan = $(this).val();

    let formData = new FormData();
    formData.append("auth_alasan", auth_alasan);

    $.ajax({
      type: "POST",
      url: site_url + "Karyawan_nonaktif_api/check_alasan",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (response) {
        var data = JSON.parse(response);
        if (data.status == false) {
          $("#fileberkasalasan").removeAttr("required");
        } else if (data.status == true) {
          $("#fileberkasalasan").prop("required", true);
        } else {
          $("#fileberkasalasan").prop("required", true);
        }
      },
    });
  });

  // Submit Event
  $("#addKaryawanNonaktif").submit(function () {
    var auth_m_per = $("#perNonkatifKary").val();
    var auth_kary = $(".aj48ajg").text();
    var tglnonaktif = $("#tglNonaktif").val();
    var auth_alasan = $("#alasanNonaktif").val();
    var ket_alasan = $("#ketalasanNonaktif").val();
    var no_ktp = $("#noKTPNonaktif").val();
    var nama = $("#namaKarytglNonaktif").val();
    let file_nonaktif = $("#fileberkasalasan").val();
    const fl_nonaktif = $("#fileberkasalasan").prop("files")[0];

    let formData = new FormData();
    formData.append("file_nonaktif", file_nonaktif);
    formData.append("fl_nonaktif", fl_nonaktif);
    formData.append("auth_m_per", auth_m_per);
    formData.append("auth_alasan", auth_alasan);
    formData.append("tglnonaktif", tglnonaktif);
    formData.append("ket_alasan", ket_alasan);
    formData.append("auth_kary", auth_kary);

    let fileNonaktifName;
    let fileNonaktifSize;
    if (file_nonaktif != "") {
      fileNonaktifName = file_nonaktif.split(".").pop().toLowerCase();
      fileNonaktifSize = fl_nonaktif["size"];
    } else {
      fileNonaktifName = "pdf";
      fileNonaktifSize = 100000;
    }

    if (no_ktp == "") {
      swal({
        title: "Karyawan masih kosong!",
        text: "Pilih Karyawan terlebih dahulu!",
        type: "warning",
      }).then(function () {
        $("#cariKaryNonaktif").focus();
      });
    } else if (fileNonaktifName != "pdf") {
      swal({
        title: "Informasi",
        text: "File Nonaktif Karyawan yang dipilih bukan PDF",
        type: "info",
      });
    } else if (fileNonaktifSize > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Nonaktif Karyawan yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      swal({
        title: "Non-Aktifkan Karyawan",
        text:
          "Yakin karyawan No. KTP : " +
          no_ktp +
          ", Nama : " +
          nama +
          ", akan di-Nonaktifkan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, nonaktfikan",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Karyawan_nonaktif_api/create",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $(".aj48ajg").text("");
                $("#perNonkatifKary").val("").trigger("change");
                $("#cariKaryNonaktif").val("");
                $("#noKTPNonaktif").val("");
                $("#noNIKNonaktif").val("");
                $("#namaKarytglNonaktif").val("");
                $("#DepttglNonaktif").val("");
                $("#tglNonaktif").val("");
                $("#alasanNonaktif").val("").trigger("change");
                $("#ketNonaktif").val("");
                $("#fileberkasalasan").val("");
                $("#ketalasanNonaktif").val("");
                swal("Berhasil", data.pesan, "success");
              } else {
                swal("Gagal", data.pesan, "error");
              }
              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (thrownError != "") {
                swal(
                  "Gagal",
                  "Terjadi kesalahan saat menyimpan data nonaktif karyawan, hubungi administrator",
                  "error"
                );
              }
            },
          });
        }
      });
    }
  });

  // Autocomplete Event
  $("#cariKaryNonaktif").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: site_url + "Search_api/getKaryawan",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
          auth_m_per: $("#perNonkatifKary").val(),
        },
        success: function (data) {
          if ($("#perNonkatifKary").val() == "") {
            swal("Error", "Pilih perusahaan", "error");
            $("#cariKaryNonaktif").val("");
          } else {
            response(data);
          }
        },
      });
    },
    select: function (event, ui) {
      if (ui.item.value != "") {
        $(".aj48ajg").text(ui.item.value);
        $("#noKTPNonaktif").val(ui.item.ktp);
        $("#noNIKNonaktif").val(ui.item.nik);
        $("#namaKarytglNonaktif").val(ui.item.nama);
        $("#DepttglNonaktif").val(ui.item.depart);
        $("#cariKaryNonaktif").val("");
      }
      return false;
    },
  });
});
