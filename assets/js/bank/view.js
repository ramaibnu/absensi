$(document).ready(function () {
  // Select Searchable
  $("#updateStatus").select2({
    theme: "bootstrap4",
    dropdownParent: $("#updateModal"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#updateStatus").select2({
        theme: "bootstrap4",
        dropdownParent: $("#updateModal"),
      });
    },
    true
  );

  // SSP Datatables
  function initializeDatatables() {
    datatable = $("#dataBank").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "Bank_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data bank, hubungi administrator";
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
          data: "bank",
          className: "text-nowrap align-middle",
        },
        {
          data: "stat_bank",
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

  // Click
  $(document).on("click", ".detailBank", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Bank tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Bank_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#bank").val(data.bank);
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

  $(document).on("click", ".updateBank", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Bank tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Bank_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#updateBank").val(data.bank);
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
            "Terjadi kesalahan saat menampilkan data bank!, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".deleteBank", function () {
    let auth = $(this).attr("id");
    let bank = $(this).attr("value");

    if (auth == "") {
      swal("Error", "Bank tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Bank " + bank + " akan dihapus?",
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
            url: site_url + "Bank_api/delete",
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
                "Terjadi kesalahan saat menghapus data bank, hubungi administrator",
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
    let bank = $("#updateBank").val();
    let status = $("#updateStatus").val();
    let keterangan = $("#updateKeterangan").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Bank_api/update",
      data: {
        bank: bank.toUpperCase(),
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
          "Terjadi kesalahan saat mengedit data bank, hubungi administrator",
          "error"
        );
      },
    });
  });
});
