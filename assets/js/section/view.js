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
  function tbSection() {
    tbmSection = $("#tbmSection").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[2, "asc"]],
      ajax: {
        url: site_url + "Section_api/datatables",
        data: {
          auth_per: $("#optionPerusahaan").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data section, hubungi administrator";
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
          name: "id_section",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
        },
        {
          data: "kd_section",
          className: "text-nowrap align-middle",
        },
        {
          data: "section",
          className: "text-nowrap align-middle",
        },
        {
          data: "depart",
          className: "text-nowrap align-middle",
        },
        {
          data: "stat_section",
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

  $("#updateDepartemen").select2({
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

      $("#updateDepartemen").select2({
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
    $("#tbmSection").LoadingOverlay("show");
    $("#tbmSection").DataTable().destroy();
    tbSection();
    $("#tbmSection").LoadingOverlay("hide");
  });

  // Click
  $(document).on("click", ".detailSection", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Section tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Section_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#perusahaan").val(data.nama_perusahaan);
            $("#departemen").val(data.depart);
            $("#kode").val(data.kode);
            $("#section").val(data.section);
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

  $(document).on("click", ".updateSection", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Section tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "Section_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var dataUpdate = JSON.parse(data);
          if (dataUpdate.statusCode == 200) {
            $.ajax({
              type: "POST",
              url: site_url + "Departemen_api/options",
              data: {
                auth_per: dataUpdate.auth_perusahaan,
              },
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#updateDepartemen").html(data.dprt);
                  $("#updateDepartemen")
                    .val(dataUpdate.auth_depart)
                    .trigger("change");
                  $("#updateKode").val(dataUpdate.kode);
                  $("#updateSection").val(dataUpdate.section);
                  $("#updateStatus").val(dataUpdate.status).trigger("change");
                  $("#updateKeterangan").val(dataUpdate.keterangan);
                  $("#updateModal").modal("show");
                } else {
                  $("#updateDepartemen").html(data.dprt);
                  swal("Gagal", "Departemen gagal ditampilkan", "error");
                }
                $.LoadingOverlay("hide");
              },
              error: function () {
                $.LoadingOverlay("hide");
                swal(
                  "Error",
                  "Terjadi kesalahan saat menampilkan data departemen!, hubungi administrator",
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
            "Terjadi kesalahan saat menampilkan data section!, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".deleteSection", function () {
    let auth = $(this).attr("id");
    let section = $(this).attr("value");

    if (auth == "") {
      swal("Error", "Section tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Section " + section + " akan dihapus?",
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
            url: site_url + "Section_api/delete",
            data: {
              auth: auth,
            },
            timeout: 20000,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmSection.draw();
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
                "Terjadi kesalahan saat menghapus data section, hubungi administrator",
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
    let departemen = $("#updateDepartemen").val();
    let kode = $("#updateKode").val();
    let section = $("#updateSection").val();
    let status = $("#updateStatus").val();
    let keterangan = $("#updateKeterangan").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "Section_api/update",
      data: {
        departemen: departemen,
        kode: kode.toUpperCase(),
        section: section.toUpperCase(),
        status: status,
        keterangan: keterangan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          tbmSection.draw();
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
          "Terjadi kesalahan saat mengedit data section, hubungi administrator",
          "error"
        );
      },
    });
  });
});
