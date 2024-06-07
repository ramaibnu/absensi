$(document).ready(function () {
  $.LoadingOverlay("show");
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
  function initializeDatatables() {
    datatable = $("#dataRoster").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "Roster_api/datatables",
        data: {
          auth_per: $("#optionPerusahaan").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data roster, hubungi administrator";
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
          data: "kd_roster",
          className: "text-nowrap align-middle",
        },
        {
          data: "roster",
          className: "text-nowrap align-middle",
        },
        {
          data: "stat_roster",
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
      $("#optionPerusahaan").select2({
        theme: "bootstrap4",
      });
      
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

  // Change
  $("#optionPerusahaan").change(function () {
    $("#dataRoster").LoadingOverlay("show");
    $("#dataRoster").DataTable().destroy();
    initializeDatatables();
    $("#dataRoster").LoadingOverlay("hide");
  });

  // Click
  $(document).on("click", ".detailRoster", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Roster tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Roster_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#kode").val(data.kode);
            $("#roster").val(data.roster);
            $("#onsite").val(data.jumlah_onsite);
            $("#offsite").val(data.jumlah_offsite);
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

  $(document).on("click", ".updateRoster", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Roster tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Roster_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#updateOnsite").val(data.onsite);
            $("#updateOffsite").val(data.offsite);
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
            "Terjadi kesalahan saat menampilkan data roster!, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".deleteRoster", function () {
    let auth = $(this).attr("id");
    let roster = $(this).attr("value");

    if (auth == "") {
      swal("Error", "Roster tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Roster " + roster + " akan dihapus?",
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
            url: site_url + "Roster_api/delete",
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
                "Terjadi kesalahan saat menghapus data roster, hubungi administrator",
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
    let onsite = $("#updateOnsite").val();
    let offsite = $("#updateOffsite").val();
    let status = $("#updateStatus").val();
    let keterangan = $("#updateKeterangan").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Roster_api/update",
      data: {
        onsite: onsite,
        offsite: offsite,
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
          "Terjadi kesalahan saat mengedit data roster, hubungi administrator",
          "error"
        );
      },
    });
  });
});
