$(document).ready(function () {
  $.LoadingOverlay("show");
  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Perusahaan_api/get_auth",
    success: function (data) {
      var data = JSON.parse(data);
      if (data.statusCode == 200) {
        $("#perLevelData").val(data.prs).trigger("change");
      } else {
        $("#perLevelData").val("").trigger("change");
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
        $("#btnTambahLevel").remove();
      } else {
        pesan = "";
      }

      swal("Error", pesan, "error");
    },
  });

  // SSP Datatables
  function tbLevel() {
    tbmLevel = $("#tbmLevel").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "Level_api/datatables",
        data: {
          auth_per: $("#perLevelData").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data Level, hubungi administrator";
            $("#secadd").remove();
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
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
          name: "id_Level",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "kd_level",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "level",
          className: "text-nowrap align-middle",
          width: "70%",
        },
        {
          data: "stat_level",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "kode_perusahaan",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "tgl_buat",
          className: "text-center text-nowrap align-middle",
          width: "6%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
      ],
    });
    $("#tbmLevel").LoadingOverlay("hide");
  }

  // Select Searchable
  $("#perLevelData").select2({
    theme: "bootstrap4",
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perLevelData").select2({
        theme: "bootstrap4",
      });
    },
    true
  );

  // Change
  $("#perLevelData").change(function () {
    $("#tbmLevel").LoadingOverlay("show");
    $("#tbmLevel").DataTable().destroy();
    tbLevel();
  });

  // Click
  $("#tbmLevel").on("click", ".hpslevel", function () {
    let authlevel = $(this).attr("id");
    let namaLevel = $(this).attr("value");

    if (authlevel == "") {
      swal("Error", "Level tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Level " + namaLevel + " akan dihapus?",
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
            url: site_url + "Level_api/delete",
            data: {
              authlevel: authlevel
            },
            timeout: 20000,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmLevel.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }

              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");

              if (xhr.status == 404) {
                pesan = "Level gagal diupdate, Link data tidak ditemukan";
              } else if (xhr.status == 0) {
                pesan = "Level gagal diupdate, Waktu koneksi habis";
              } else {
                pesan =
                  "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    }
  });

  $("#tbmLevel").on("click", ".dtllevel", function () {
    let authlevel = $(this).attr("id");

    if (authlevel == "") {
      swal("Error", "Level tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Level_api/read_specific_data",
        data: {
          authlevel: authlevel
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#detailLevelPerusahaan").val(data.nama_perusahaan);
            $("#detailLevelDepart").val(data.depart);
            $("#detailLevelKode").val(data.kode);
            $("#detailLevel").val(data.level);
            $("#detailLevelStatus").val(data.status);
            $("#detailLevelKet").val(data.ket);
            $("#detailLevelBuat").val(data.pembuat);
            $("#detailLevelTglBuat").val(data.tgl_buat);
            $("#detailLevelmdl").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Level gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Level gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#tbmLevel").on("click", ".edttlevel", function () {
    let authlevel = $(this).attr("id");

    if (authlevel == "") {
      swal("Error", "Level tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Level_api/read_specific_data",
        data: {
          authlevel: authlevel
        },
        timeout: 15000,
        success: function (data) {
          var dataLevel = JSON.parse(data);
          if (dataLevel.statusCode == 200) {
            $("#editLevelKode").val(dataLevel.kode);
            $("#editLevel").val(dataLevel.level);
            $("#editLevelStatus").val(dataLevel.status);
            $("#editLevelKet").val(dataLevel.ket);
            $("#editLevelmdl").modal("show");
          } else {
            swal(dataLevel.kode_pesan, dataLevel.pesan, dataLevel.tipe_pesan);
          }
        },
        error: function (xhr) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Level gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Level gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }
          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#btnrefreshLevel").click(function () {
    $("#tbmLevel").LoadingOverlay("show");
    tbmLevel.draw();
    $("#tbmLevel").LoadingOverlay("hide");
  });

  // Submit
  $("#updateLevel").submit(function () {
    let kode = $("#editLevelKode").val();
    let level = $("#editLevel").val();
    let status = $("#editLevelStatus").val();
    let ket = $("#editLevelKet").val();

    $.ajax({
      type: "POST",
      url: site_url + "Level_api/update",
      data: {
        kode: kode,
        level: level,
        status: status,
        ket: ket
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          tbmLevel.draw();
          $("#editLevelmdl").modal("hide");
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $("#editLevelKode").val("");
          $("#editLevel").val("");
          $("#editLevelKet").val("");
          $("#editLevelStatus").val("");
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");

        if (xhr.status == 404) {
          pesan = "Level gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Level gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-update data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
