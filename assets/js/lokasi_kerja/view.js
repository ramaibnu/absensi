$(document).ready(function () {
  // Function
  function reseteditlokker() {
    $("#editLokkerKode").val("");
    $("#editLokker").val("");
    $("#editLokkerKet").val("");
    $("#editLokkerStatus").val("");
  }

  // SSP Datatables
  function tbLokker() {
    tbmLokker = $("#tbmLokker").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "LokasiKerja_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data lokasi kerja, hubungi administrator";
            swal("Error", pesan, "error");
            $("#secadd").remove();
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
          name: "id_lokker",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "kd_lokker",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "lokker",
          className: "text-nowrap  align-middle",
          width: "60%",
        },
        {
          data: "stat_lokker",
          className: "text-center  align-middle",
          width: "1%",
        },
        {
          data: "tgl_buat",
          className: "text-center text-nowrap",
          width: "8%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
      ],
    });
  }
  tbLokker();

  // Click
  $("#tbmLokker").on("click", ".hpslokker", function () {
    let auth_lokker = $(this).attr("id");
    let namaLokker = $(this).attr("value");

    if (auth_lokker == "") {
      swal("Error", "Lokasi kerja tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Lokasi kerja " + namaLokker + " akan dihapus?",
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
            url: site_url + "LokasiKerja_api/delete",
            data: {
              auth_lokker: auth_lokker,
            },
            timeout: 20000,
            success: function (data, textStatus, xhr) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmLokker.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }

              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (xhr.status == 404) {
                pesan =
                  "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
              } else if (xhr.status == 0) {
                pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
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

  $("#tbmLokker").on("click", ".dtllokker", function () {
    let auth_lokker = $(this).attr("id");

    if (auth_lokker == "") {
      swal("Error", "Lokasi kerja tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "LokasiKerja_api/read_specific_data",
        data: {
          auth_lokker: auth_lokker,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#detailLokkerKode").val(data.kode);
            $("#detailLokker").val(data.lokker);
            $("#detailLokkerStatus").val(data.status);
            $("#detailLokkerKet").val(data.ket);
            $("#detailLokkerBuat").val(data.pembuat);
            $("#detailLokkerTglBuat").val(data.tgl_buat);
            $("#detailLokkermdl").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampikan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#tbmLokker").on("click", ".edttlokker", function () {
    let auth_lokker = $(this).attr("id");

    if (auth_lokker == "") {
      swal("Error", "Lokasi kerja tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "LokasiKerja_api/read_specific_data",
        data: {
          auth_lokker: auth_lokker,
        },
        timeout: 15000,
        success: function (data) {
          var dataLokker = JSON.parse(data);
          if (dataLokker.statusCode == 200) {
            reseteditlokker();
            $("#editLokkerKode").val(dataLokker.kode);
            $("#editLokker").val(dataLokker.lokker);
            $("#editLokkerStatus").val(dataLokker.status);
            $("#editLokkerKet").val(dataLokker.ket);
            $("#editLokkermdl").modal("show");
          } else {
            swal(
              dataLokker.kode_pesan,
              dataLokker.pesan,
              dataLokker.tipe_pesan
            );
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampikan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#btnrefreshLokker").click(function () {
    $("#tbmLokker").LoadingOverlay("show");
    tbmLokker.draw();
    $("#tbmLokker").LoadingOverlay("hide");
  });

  // Submit
  $("#updateLokasiKerja").submit(function () {
    let kode = $("#editLokkerKode").val();
    let lokker = $("#editLokker").val();
    let status = $("#editLokkerStatus").val();
    let ket = $("#editLokkerKet").val();

    $.ajax({
      type: "POST",
      url: site_url + "LokasiKerja_api/update",
      data: {
        kode: kode,
        lokker: lokker,
        status: status,
        ket: ket,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#editLokkermdl").modal("hide");
          tbmLokker.draw();
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          reseteditlokker();
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (xhr.status == 404) {
          pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-update data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
