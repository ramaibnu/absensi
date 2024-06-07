$(document).ready(function () {
  $.LoadingOverlay("show");
  // Function
  $("#updateGrade").on("input", function () {
    // Remove non-numeric characters
    $(this).val($(this).val().replace(/\D/g, ""));
  });

  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Perusahaan_api/get_auth",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#optionPerusahaan").val(data.prs).trigger("change");
      } else {
        $("#optionPerusahaan").val("").trigger("change");
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
      }

      swal("Error", pesan, "error");
    },
  });

  // SSP Datatables
  function tbGrade() {
    tbmGrade = $("#tbmGrade").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "Grade_api/datatables",
        data: {
          auth_per: $("#optionPerusahaan").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data grade, hubungi administrator";
            swal("Error", pesan, "error");
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
          name: "id_grade",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
        },
        {
          data: "grade",
          className: "text-nowrap align-middle",
        },
        {
          data: "level",
          className: "text-nowrap align-middle",
        },
        {
          data: "stat_grade",
          className: "text-center text-nowrap align-middle",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
        },
      ],
    });
  }

  // Select Searchable
  $("#optionPerusahaan").select2({
    theme: "bootstrap4",
  });

  $("#updateLevel").select2({
    theme: "bootstrap4",
    dropdownParent: $("#updateModal"),
  });

  $("#updateStatus").select2({
    theme: "bootstrap4",
    dropdownParent: $("#updateModal"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#optionPerusahaan").select2({
        theme: "bootstrap4",
      });

      $("#updateLevel").select2({
        theme: "bootstrap4",
        dropdownParent: $("#updateModal"),
      });

      $("#updateStatus").select2({
        theme: "bootstrap4",
        dropdownParent: $("#updateModal"),
      });
    },
    true
  );

  // Change
  $("#optionPerusahaan").change(function () {
    $("#tbmGrade").LoadingOverlay("show");
    $("#tbmGrade").DataTable().destroy();
    tbGrade();
    $("#tbmGrade").LoadingOverlay("hide");
  });

  // Click
  $(document).on("click", ".detailGrade", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Grade tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Grade_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#perusahaan").val(data.nama_perusahaan);
            $("#level").val(data.level);
            $("#grade").val(data.grade);
            $("#keterangan").val(data.keterangan);
            $("#status").val(data.status);
            $("#user").val(data.pembuat);
            $("#tanggal_buat").val(data.tgl_buat);
            $("#detailModal").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
          $.LoadingOverlay("hide");
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat menampilkan data, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".updateGrade", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Grade tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Grade_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var dataUpdate = JSON.parse(data);
          if (dataUpdate.statusCode == 200) {
            $.ajax({
              type: "POST",
              url: site_url + "Level_api/option",
              data: {
                auth_per: dataUpdate.auth_perusahaan,
              },
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#updateLevel").html(data.level);
                  $("#updateLevel")
                    .val(dataUpdate.auth_level)
                    .trigger("change");
                  $("#updateGrade").val(dataUpdate.grade);
                  $("#updateStatus").val(dataUpdate.status).trigger("change");
                  $("#updateKeterangan").val(dataUpdate.keterangan);
                  $("#updateModal").modal("show");
                } else {
                  $("#updateLevel").html(data.level);
                  swal("Gagal", "Level gagal ditampilkan", "error");
                }
                $.LoadingOverlay("hide");
              },
              error: function () {
                $.LoadingOverlay("hide");
                swal(
                  "Error",
                  "Terjadi kesalahan saat menampilkan data level!, hubungi administrator",
                  "error"
                );
              },
            });
          } else {
            swal(
              dataUpdate.kode_pesan,
              dataUpdate.pesan,
              dataUpdate.tipe_pesan
            );
          }
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat menampilkan data grade!, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".deleteGrade", function () {
    let auth = $(this).attr("id");
    let grade = $(this).attr("value");

    if (auth == "") {
      swal("Error", "Grade tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Grade " + grade + " akan dihapus?",
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
            url: site_url + "Grade_api/delete",
            data: {
              auth: auth,
            },
            timeout: 20000,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmGrade.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }
              $.LoadingOverlay("hide");
            },
            error: function () {
              $.LoadingOverlay("hide");
              swal(
                "Error",
                "Terjadi kesalahan saat menghapus data grade, hubungi administrator",
                "error"
              );
            },
          });
        }
      });
    }
  });

  // Submit
  $("#updateData").submit(function () {
    let level = $("#updateLevel").val();
    let grade = $("#updateGrade").val();
    let status = $("#updateStatus").val();
    let keterangan = $("#updateKeterangan").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Grade_api/update",
      data: {
        level: level,
        grade: grade,
        status: status,
        keterangan: keterangan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          tbmGrade.draw();
          $("#updateModal").modal("hide");
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
        $.LoadingOverlay("hide");
      },
      error: function () {
        $.LoadingOverlay("hide");
        swal(
          "Error",
          "Terjadi kesalahan saat mengedit data grade, hubungi administrator",
          "error"
        );
      },
    });
  });
});
