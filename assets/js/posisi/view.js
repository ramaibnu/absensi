$(document).ready(function () {
  $.LoadingOverlay("show");
  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Perusahaan_api/get_auth",
    success: function (data) {
      var data = JSON.parse(data);
      if (data.statusCode == 200) {
        $("#perPosisiData").val(data.prs).trigger("change");
      } else {
        $("#perPosisiData").val("").trigger("change");
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
        $("#btnTambahPosisi").remove();
      }

      swal("Error", pesan, "error");
    },
  });
  // SSP Datatables
  function tbPosisi() {
    tbmPosisi = $("#tbmPosisi").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[2, "asc"]],
      ajax: {
        url: site_url + "Posisi_api/datatables",
        data: {
          auth_per: $("#perPosisiData").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data posisi, hubungi administrator";
            $("#secadd").remove();
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
          name: "id_posisi",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "posisi",
          className: "text-nowrap align-middle",
          width: "25%",
        },
        {
          data: "depart",
          className: "text-nowrap align-middle",
          width: "42%",
        },
        {
          data: "stat_posisi",
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
          width: "8%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
      ],
    });
    $("#tbmPosisi").LoadingOverlay("hide");
  }

  // Select Searchable
  $("#perPosisiData").select2({
    theme: "bootstrap4",
  });
  $("#editPosisiDepart").select2({
    theme: "bootstrap4",
    dropdownParent: $("#editPosisimdl"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perPosisiData").select2({
        theme: "bootstrap4",
      });
      $("#editPosisiDepart").select2({
        theme: "bootstrap4",
        dropdownParent: $("#editPosisimdl"),
      });
    },
    true
  );

  // Change
  $("#perPosisiData").change(function () {
    $("#tbmPosisi").LoadingOverlay("show");
    $("#tbmPosisi").DataTable().destroy();
    tbPosisi();
  });

  // Click
  $("#tbmPosisi").on("click", ".hpsposisi", function () {
    let authposisi = $(this).attr("id");
    let namaPosisi = $(this).attr("value");

    if (authposisi == "") {
      swal("Error", "Posisi tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Posisi " + namaPosisi + " akan dihapus?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: site_url + "Posisi_api/delete",
            data: {
              authposisi: authposisi,
            },
            timeout: 20000,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmPosisi.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }

              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");

              if (xhr.status == 404) {
                pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
              } else if (xhr.status == 0) {
                pesan = "Posisi gagal diupdate, Waktu koneksi habis";
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

  $("#tbmPosisi").on("click", ".dtlposisi", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Posisi tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Posisi_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#detailPosisiPerusahaan").val(data.nama_perusahaan);
            $("#detailPosisiDepart").val(data.depart);
            $("#detailPosisi").val(data.posisi);
            $("#detailPosisiStatus").val(data.status);
            $("#detailPosisiKet").val(data.ket);
            $("#detailPosisiBuat").val(data.pembuat);
            $("#detailPosisiTglBuat").val(data.tgl_buat);
            $("#detailPosisimdl").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (xhr.status == 404) {
            pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Posisi gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }
          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#tbmPosisi").on("click", ".edttposisi", function () {
    let auth = $(this).attr("id");

    if (auth == "") {
      swal("Error", "Posisi tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Posisi_api/read_specific_data",
        data: {
          auth: auth,
        },
        timeout: 15000,
        success: function (data) {
          var dataPosisi = JSON.parse(data);
          if (dataPosisi.statusCode == 200) {
            $.ajax({
              type: "POST",
              url: site_url + "Departemen_api/options",
              data: {
                auth_per: dataPosisi.auth_perusahaan,
              },
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#editPosisiDepart").html(data.dprt);
                  $.LoadingOverlay("hide");
                } else {
                  $("#editPosisiDepart").html(data.dprt);
                  $.LoadingOverlay("hide");
                  swal("Gagal", "Departemen gagal ditampilkan", "error");
                }
                $("#editPosisiDepart").val(dataPosisi.auth_depart);
                $("#editPosisi").val(dataPosisi.posisi);
                $("#editPosisiStatus").val(dataPosisi.status);
                $("#editPosisiKet").val(dataPosisi.ket);
                $("#editPosisimdl").modal("show");
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                  pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                  pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                } else {
                  pesan =
                    "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }
                swal("Error", pesan, "error");
              },
            });
          } else {
            swal(
              dataPosisi.kode_pesan,
              dataPosisi.pesan,
              dataPosisi.tipe_pesan
            );
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Posisi gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#btnrefreshPosisi").click(function () {
    $("#tbmPosisi").LoadingOverlay("show");
    tbmPosisi.draw();
    $("#tbmPosisi").LoadingOverlay("hide");
  });

  // Submit
  $("#updatePosisi").submit(function () {
    let posisi = $("#editPosisi").val();
    let depart = $("#editPosisiDepart").val();
    let status = $("#editPosisiStatus").val();
    let ket = $("#editPosisiKet").val();

    $.ajax({
      type: "POST",
      url: site_url + "Posisi_api/update",
      data: {
        posisi: posisi,
        depart: depart,
        status: status,
        ket: ket,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          tbmPosisi.draw();
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $("#editPosisi").val("");
          $("#editPosisiKet").val("");
          $("#editPosisiStatus").val("");
          $("#editPosisimdl").modal("hide");
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (xhr.status == 404) {
          pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Posisi gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-update data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
