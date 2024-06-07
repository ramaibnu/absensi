$(document).ready(function () {
  // Function
  function clearForm() {
    $("#perLanggar").val("").trigger("change");
    $("#txtCariKaryLanggar").val("");
    $("#txtKTPKaryLanggar").val("");
    $("#authKTPKaryLanggar").val("");
    $("#txtNIKKaryLanggar").val("");
    $("#txtNamaKaryLanggar").val("");
    $("#txtDepartKaryLanggar").val("");
    $("#txtPosisiKaryLanggar").val("");
    $("#tglLanggar").val("");
    $("#tglPunish").val("");
    $("#tglAkhirPunish").val("");
    $("#jenisPunish").val("").trigger("change");
    $("#ketLanggar").val("");
    $("#berkasPunish").val("");
  }
  // Select Searchable
  $("#perLanggar").select2({
    theme: "bootstrap4",
    width: "100%",
  });

  $("#jenisPunish").select2({
    theme: "bootstrap4",
    width: "100%",
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#jenisPunish").select2({
        theme: "bootstrap4",
        width: "100%",
      });

      $("#perLanggar").select2({
        theme: "bootstrap4",
        width: "100%",
      });
    },
    true
  );

  // Change Event
  $("#perLanggar").change(function () {
    auth_m_prs = $("#perLanggar").val();
    $("#authKTPKaryLanggar").val("");
    $("#txtKTPKaryLanggar").text("");
    $("#txtNIKKaryLanggar").text("");
    $("#txtNamaKaryLanggar").text("");
    $("#txtDepartKaryLanggar").text("");
    $("#txtPosisiKaryLanggar").text("");
    $("#txtCariKaryLanggar").val("");

    $("#txtCariKaryLanggar").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: site_url + "Search_api/getKaryawan",
          type: "POST",
          dataType: "json",
          data: {
            search: request.term,
            auth_m_per: auth_m_prs,
          },
          success: function (data) {
            response(data);
          },
        });
      },
      select: function (event, ui) {
        if (ui.item.value != "") {
          $("#authKTPKaryLanggar").val(ui.item.value);
          $("#txtKTPKaryLanggar").val(ui.item.ktp);
          $("#txtNIKKaryLanggar").val(ui.item.nik);
          $("#txtNamaKaryLanggar").val(ui.item.nama);
          $("#txtDepartKaryLanggar").val(ui.item.depart);
          $("#txtPosisiKaryLanggar").val(ui.item.posisi);
          $("#txtCariKaryLanggar").val("");
        }
        return false;
      },
    });
  });

  // Submit Event
  $("#createPelanggaran").on("submit", function () {
    let authKaryawan = $("#authKTPKaryLanggar").val();
    let tanggalPelanggaran = $("#tglLanggar").val();
    let tanggalHukuman = $("#tglPunish").val();
    let tanggalAkhirHukuman = $("#tglAkhirPunish").val();
    let jenisPelanggaran = $("#jenisPunish").val();
    let keterangan = $("#ketLanggar").val();
    let fileName = $("#berkasPunish").val();
    const filePelanggaran = $("#berkasPunish").prop("files")[0];
    let fileExtension = fileName.split(".").pop().toLowerCase();
    let sizeFile = filePelanggaran["size"];
    if (authKaryawan == "") {
      swal({
        title: "Karyawan masih kosong!",
        text: "Pilih Karyawan terlebih dahulu!",
        type: "warning",
      }).then(function (result) {
        $("#txtCariKaryLanggar").focus();
      });
    } else if (fileExtension != "pdf") {
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
      swal({
        title: "Buat Data Pelanggaran",
        text: "Yakin pelanggaran akan dibuat?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, buat data",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          let formData = new FormData();
          formData.append("authKaryawan", authKaryawan);
          formData.append("tanggalPelanggaran", tanggalPelanggaran);
          formData.append("tanggalHukuman", tanggalHukuman);
          formData.append("tanggalAkhirHukuman", tanggalAkhirHukuman);
          formData.append("jenisPelanggaran", jenisPelanggaran);
          formData.append("keterangan", keterangan);
          formData.append("fileName", fileName);
          formData.append("filePelanggaran", filePelanggaran);
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Pelanggaran_api/create",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                swal({
                  title: "Berhasil",
                  text: data.pesan,
                  type: "success",
                  showConfirmButton: false,
                  timer: 2000,
                });
                clearForm();
                $.LoadingOverlay("hide");
              } else {
                swal({
                  title: "Gagal",
                  text: data.pesan,
                  type: "error",
                });
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, status, error) {
              $.LoadingOverlay("hide");
              swal({
                title: "Hubungi Administrator",
                text: error + "",
                type: "error",
              });
            },
          });
        } else {
          swal.close();
        }
      });
    }
  });
});
