$(document).ready(function () {
  $.LoadingOverlay("show");
  // Ajax
  $.ajax({
    type: "POST",
    url: site_url + "Struktur_api/get_auth",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#perNonaktifData").val(data.auth).trigger("change");
      } else {
        $("#perNonaktifData").val("").trigger("change");
      }
    },
    error: function (thrownError) {
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
      }

      swal("Error", pesan, "error");
    },
  });

  // SSP Datatables
  function tb_nakary(m_per) {
    tbmNonaktifKary = $("#tbmNonaktif").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[2, "asc"]],
      ajax: {
        url: site_url + "Karyawan_nonaktif_api/datatables",
        data: {
          auth_per: m_per,
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            $(".err_psn_nonaktifKary").removeClass("d-none");
            $(".err_psn_nonaktifKary").css("display", "block");
            $(".err_psn_nonaktifKary").html(
              "terjadi kesalahan saat melakukan load data nonaktif karyawan, hubungi administrator"
            );
            $("#secadd").addClass("disabled");
          }
        },
      },
      deferRender: true,
      aLengthMenu: [
        [10, 25, 50],
        [10, 25, 50],
      ],
      columns: [
        {
          data: "no",
          name: "id_NonaktifKary",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "no_ktp",
          className: "text-nowrap align-middle",
          width: "15%",
        },
        {
          data: "nama_lengkap",
          className: "text-nowrap align-middle",
          width: "20%",
        },
        {
          data: "depart",
          className: "text-nowrap align-middle",
          width: "20%",
        },
        {
          data: "tgl_nonaktif",
          className: "text-nowrap align-middle",
          width: "9%",
        },
        {
          data: "alasan_nonaktif",
          className: "text-nowrap align-middle",
          width: "15%",
        },
        {
          data: "kode_perusahaan",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
      ],
    });

    $("#tbmNonaktif").LoadingOverlay("hide");
  }
  tb_nakary();

  // Select Searchable
  $("#perNonaktifData").select2({
    theme: "bootstrap4",
  });
  window.addEventListener(
    "resize",
    function (event) {
      $("#perNonaktifData").select2({
        theme: "bootstrap4",
      });
    },
    true
  );

  // Click Event
  $(document).on("click", ".dtlnonaktif", function () {
    let authNonaktifKary = $(this).attr("id");

    if (authNonaktifKary == "") {
      swal("Error", "Karyawan tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Karyawan_nonaktif_api/detail",
        data: {
          authNonaktifKary: authNonaktifKary,
        },
        timeout: 20000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#detailNonaktifPerusahaan").val(data.nama_perusahaan);
            $("#detailNonaktifDepart").val(data.depart);
            $("#detailNonaktifKTP").val(data.no_ktp);
            $("#detailNonaktifNama").val(data.nama_lengkap);
            $("#detailNonaktifTanggal").val(
              $.datepicker.formatDate("dd-M-yy", new Date(data.tgl_nonaktif))
            );
            $("#detailNonaktifAlasan").val(data.alasan_nonaktif);
            $("#detailNonaktifTglBuat").val(
              $.datepicker.formatDate("dd-M-yy", new Date(data.tgl_buat)) +
                " " +
                new Date(data.tgl_buat).toLocaleTimeString([], {
                  hour: "2-digit",
                  minute: "2-digit",
                  second: "2-digit",
                  hour12: false,
                })
            );
            $("#detailNonaktifKet").val(data.ket_nonaktif);
            $("#detailNonaktifBuat").val(data.nama_user);
            $("#detailNonaktifPosisi").val(data.posisi);
            $("#detailnonaktifkary").modal("show");
          } else {
            $(".err_psn_NonaktifKary").css("display", "block");
            $(".err_psn_NonaktifKary").html(data.pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".err_psn_NonaktifKary").removeClass("alert-primary");
          $(".err_psn_NonaktifKary").addClass("alert-danger");
          $(".err_psn_NonaktifKary").css("display", "block");
          if (xhr.status == 404) {
            $(".err_psn_NonaktifKary").html(
              "NonaktifKary gagal ditampilkan, Link data tidak ditemukan"
            );
          } else if (xhr.status == 0) {
            $(".err_psn_NonaktifKary").html(
              "NonaktifKary gagal ditampilkan, Waktu koneksi habis"
            );
          } else {
            $(".err_psn_NonaktifKary").html(
              "Terjadi kesalahan saat menampilkan data, hubungi administrator"
            );
          }
          $(".err_psn_NonaktifKary ")
            .fadeTo(3000, 500)
            .slideUp(500, function () {
              $(".err_psn_NonaktifKary ").slideUp(500);
            });
        },
      });
    }
  });

  $(document).on("click", ".edtnonaktif", function () {
    let authNonaktifKary = $(this).attr("id");

    if (authNonaktifKary == "") {
      swal("Error", "Karyawan tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Karyawan_nonaktif_api/detail",
        data: {
          authNonaktifKary: authNonaktifKary,
        },
        timeout: 20000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#authData").val(data.auth_kary_nonaktif);
            $("#authKaryawan").val(data.auth_karyawan);
            $("#updateNonaktifPerusahaan").val(data.nama_perusahaan);
            $("#updateNonaktifDepart").val(data.depart);
            $("#updateNonaktifKTP").val(data.no_ktp);
            $("#updateNonaktifNama").val(data.nama_lengkap);
            $("#updateNonaktifTanggal").val(data.tgl_nonaktif);
            $("#updateNonaktifKet").val(data.ket_nonaktif);
            $("#updateNonaktifPosisi").val(data.posisi);
            $.ajax({
              type: "POST",
              url: site_url + "Karyawan_nonaktif_api/dataAlasan",
              success: function (response2) {
                var dataAlasan = JSON.parse(response2);
                $("#updateNonaktifAlasan").html(dataAlasan.alasan);
                $("#updateNonaktifAlasan").val(data.auth_alasan_nonaktif).trigger("change");
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
            $("#editNonaktifmdl").modal("show");
          } else {
            $(".err_psn_NonaktifKary").css("display", "block");
            $(".err_psn_NonaktifKary").html(data.pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".err_psn_NonaktifKary").removeClass("alert-primary");
          $(".err_psn_NonaktifKary").addClass("alert-danger");
          $(".err_psn_NonaktifKary").css("display", "block");
          if (xhr.status == 404) {
            $(".err_psn_NonaktifKary").html(
              "Karyawan gagal ditampilkan, Link data tidak ditemukan"
            );
          } else if (xhr.status == 0) {
            $(".err_psn_NonaktifKary").html(
              "Karyawan gagal ditampilkan, Waktu koneksi habis"
            );
          } else {
            $(".err_psn_NonaktifKary").html(
              "Terjadi kesalahan saat menampilkan data, hubungi administrator"
            );
          }

          $(".err_psn_NonaktifKary ")
            .fadeTo(3000, 500)
            .slideUp(500, function () {
              $(".err_psn_NonaktifKary ").slideUp(500);
            });
        },
      });
    }
  });

  $(document).on("click", ".hpsnonaktif", function () {
    let authNonaktifKary = $(this).attr("id");
    let namaNonaktifKary = $(this).attr("value");

    if (authNonaktifKary == "") {
      swal("Error", "Data Nonaktif karyawan tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text:
          "Yakin data nonaktif karyawan " + namaNonaktifKary + " akan dihapus?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Karyawan_nonaktif_api/delete",
            data: {
              authNonaktifKary: authNonaktifKary,
            },
            timeout: 20000,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                let m_prs = $("#perNonaktifData").val();
                $("#tbmNonaktif").LoadingOverlay("hide");
                $("#tbmNonaktif").DataTable().destroy();
                tb_nakary(m_prs);
                $(".err_psn_nonaktifKary").removeClass("d-none");
                $(".err_psn_nonaktifKary").removeClass("alert-danger");
                $(".err_psn_nonaktifKary").addClass("alert-primary");
                $(".err_psn_nonaktifKary").html(data.pesan);
              } else {
                $(".err_psn_nonaktifKary").removeClass("d-none");
                $(".err_psn_nonaktifKary").removeClass("alert-primary");
                $(".err_psn_nonaktifKary").addClass("alert-danger");
                $(".err_psn_nonaktifKary").html(data.pesan);
              }

              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".err_psn_nonaktifKary").removeClass("d-none");
              $(".err_psn_nonaktifKary").removeClass("alert-primary");
              $(".err_psn_nonaktifKary").addClass("alert-danger");

              if (xhr.status == 404) {
                $(".err_psn_nonaktifKary").html(
                  "Data nonaktif karyawan gagal dihapus, , Link data tidak ditemukan"
                );
              } else if (xhr.status == 0) {
                $(".err_psn_nonaktifKary").html(
                  "Data nonaktif karyawan gagal dihapus, Waktu koneksi habis"
                );
              } else {
                $(".err_psn_nonaktifKary").html(
                  "Terjadi kesalahan saat menghapus data, hubungi administrator"
                );
              }
            },
          });

          $(".err_psn_nonaktifKary")
            .fadeTo(4000, 500)
            .slideUp(500, function () {
              $(".err_psn_nonaktifKary").slideUp(500);
            });
        }
      });
    }
  });

  // Change Event
  $("#perNonaktifData").change(function () {
    let m_prs = $("#perNonaktifData").val();

    $("#tbmNonaktif").LoadingOverlay("show");
    $("#tbmNonaktif").DataTable().destroy();
    tb_nakary(m_prs);
  });

  $("#updateNonaktifAlasan").change(function () {
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

  // Submit
  $("#updateKaryawanNonaktif").submit(function () {
    var auth_data = $("#authData").val();
    var auth_karyawan = $("#authKaryawan").val();
    var tglnonaktif = $("#updateNonaktifTanggal").val();
    var auth_alasan = $("#updateNonaktifAlasan").val();
    var ket_alasan = $("#updateNonaktifKet").val();
    let file_nonaktif = $("#fileberkasalasan").val();
    const fl_nonaktif = $("#fileberkasalasan").prop("files")[0];

    let formData = new FormData();
    formData.append("file_nonaktif", file_nonaktif);
    formData.append("fl_nonaktif", fl_nonaktif);
    formData.append("auth_alasan", auth_alasan);
    formData.append("tglnonaktif", tglnonaktif);
    formData.append("ket_alasan", ket_alasan);
    formData.append("auth_karyawan", auth_karyawan);
    formData.append("auth_data", auth_data);

    let fileNonaktifName;
    let fileNonaktifSize;
    if (file_nonaktif != "") {
      fileNonaktifName = file_nonaktif.split(".").pop().toLowerCase();
      fileNonaktifSize = fl_nonaktif["size"];
    } else {
      fileNonaktifName = "pdf";
      fileNonaktifSize = 100000;
    }

    if (fileNonaktifName != "pdf") {
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
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "Karyawan_nonaktif_api/update",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            swal("Berhasil", data.pesan, "success");
            $("#editNonaktifmdl").modal("hide");
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
              "Terjadi kesalahan saat update data nonaktif karyawan, hubungi administrator",
              "error"
            );
          }
        },
      });
    }
  })
});
