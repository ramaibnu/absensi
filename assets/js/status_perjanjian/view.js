$(document).ready(function () {
  // SSP Datatables
  function initializeDatatables() {
    datatable = $("#dataStatusPerjanjian").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "StatusPerjanjian_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data status perjanjian, hubungi administrator";
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
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
        },
        {
          data: "stat_perjanjian",
          className: "text-nowrap align-middle",
        },
        {
          data: "stat_stat_perjanjian",
          className: "text-center text-nowrap align-middle",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
        },
      ],
    });
  }
  initializeDatatables();

  // Select Searchable
  $("#updateJangkaWaktu").select2({
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
      $("#updateJangkaWaktu").select2({
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

  // Click
  $(document).on("click", ".detailStatusPerjanjian", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Status Perjanjian tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "StatusPerjanjian_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#statusPerjanjian").val(data.status_perjanjian);
            $("#jangkaWaktu").val(data.jangka_waktu);
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

  $(document).on("click", ".updateStatusPerjanjian", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Status Perjanjian tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "StatusPerjanjian_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#updateStatusPerjanjian").val(data.status_perjanjian);
            $("#updateJangkaWaktu").val(data.option_waktu).trigger('change');
            $("#updateStatus").val(data.status).trigger('change');
            $("#updateKeterangan").val(data.keterangan);
            $("#updateModal").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
          $.LoadingOverlay("hide");
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat menampilkan data status perjanjian!, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".deleteStatusPerjanjian", function () {
    let auth = $(this).attr("id");
    let status_perjanjian = $(this).attr("value");

    if (auth == "") {
      swal("Error", "Status Perjanjian tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Status Perjanjian " + status_perjanjian + " akan dihapus?",
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
            url: site_url + "StatusPerjanjian_api/delete",
            data: {
              auth: auth,
            },
            timeout: 20000,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                datatable.draw();
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
                "Terjadi kesalahan saat menghapus data status perjanjian, hubungi administrator",
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
    let status_perjanjian = $("#updateStatusPerjanjian").val();
    let status_waktu = $("#updateJangkaWaktu").val();
    let status = $("#updateStatus").val();
    let keterangan = $("#updateKeterangan").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "StatusPerjanjian_api/update",
      data: {
        status_perjanjian: status_perjanjian.toUpperCase(),
        status_waktu: status_waktu,
        status: status,
        keterangan: keterangan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          datatable.draw();
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
          "Terjadi kesalahan saat mengedit data status perjanjian, hubungi administrator",
          "error"
        );
      },
    });
  });
});
