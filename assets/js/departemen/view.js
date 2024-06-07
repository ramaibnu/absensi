$(document).ready(function () {
  $.LoadingOverlay("show");
  // AJAX
  $.ajax({
    type: "POST",
    url: site_url + "Perusahaan_api/get_auth",
    success: function (data) {
      var data = JSON.parse(data);
      if (data.statusCode == 200) {
        $("#perDepartData").val(data.prs).trigger("change");
      } else {
        $("#perDepartData").val("").trigger("change");
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
        $("#btnTambahDepart").remove();
      }

      swal("Error", pesan, "error");
    },
  });

  // SSP Datatables
  function tbDepart() {
    tbmdepart = $("#tbmDepart").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[2, "asc"]],
      ajax: {
        url: site_url + `Departemen_api/datatables`,
        data: {
          auth_per: $("#perDepartData").val(),
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data departemen, hubungi administrator";
            swal("Error", pesan, "error");
            $("#addbtn").remove();
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
          name: "id_kary",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "kd_depart",
          className: "align-middle",
          width: "10%",
        },
        {
          data: "depart",
          className: "text-nowrap align-middle",
          width: "67%",
        },
        {
          data: "stat_depart",
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
    $("#tbmDepart").LoadingOverlay("hide");
  }
  
  // Select Searchable
  $("#perDepartData").select2({
    theme: "bootstrap4",
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perDepartData").select2({
        theme: "bootstrap4",
      });
    },
    true
  );

  // Change
  $("#perDepartData").change(function () {
    $("#tbmDepart").LoadingOverlay("show");
    $("#tbmDepart").DataTable().destroy();
    tbDepart();
  });

  // Click
  $("#tbmDepart").on("click", ".hpsdepart", function () {
    let authdepart = $(this).attr("id");
    let namadepart = $(this).attr("value");

    if (authdepart == "") {
      swal("Error", "Departemen tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin departemen " + namadepart + " akan dihapus?",
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
            url: site_url + "Departemen_api/delete",
            data: {
              authdepart: authdepart,
            },
            timeout: 20000,
            success: function (data, textStatus, xhr) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                tbmdepart.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }

              $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
              if (xhr.status == 404) {
                pesan = "Departemen gagal diupdate, Link data tidak ditemukan";
              } else if (xhr.status == 0) {
                pesan = "Departemen gagal diupdate, Waktu koneksi habis";
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

  $("#tbmDepart").on("click", ".dtldepart", function () {
    let authdepart = $(this).attr("id");
    var token = $("#token").val();

    if (authdepart == "") {
      swal("Error", "Departemen tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "departemen_api/read_specific_data",
        data: {
          authdepart: authdepart,
          token: token,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#detailDepartPerusahaan").val(data.nama_perusahaan);
            $("#detailDepartKode").val(data.kode);
            $("#detailDepart").val(data.depart);
            $("#detailDepartStatus").val(data.status);
            $("#detailDepartKet").val(data.ket);
            $("#detailDepartBuat").val(data.pembuat);
            $("#detailDepartTglBuat").val(data.tgl_buat);
            $("#detaildepartmdl").modal("show");
          } else if (data.statusCode == 201) {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          } else {
            window.location.href = data.url_err;
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Departemen gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Departemen gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#tbmDepart").on("click", ".edttdepart", function () {
    let authdepart = $(this).attr("id");

    if (authdepart == "") {
      swal("Error", "Departemen tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Departemen_api/read_specific_data",
        data: {
          authdepart: authdepart,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#editDepartKode").val(data.kode);
            $("#editDepart").val(data.depart);
            $("#editDepartStatus").val(data.status);
            $("#editDepartKet").val(data.ket);
            $("#editdepartmdl").modal("show");
            $("#error1ed").html("");
            $("#error2ed").html("");
            $("#error3ed").html("");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Departemen gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Departemen gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#btnrefreshdepart").click(function () {
    $("#tbmDepart").LoadingOverlay("show");
    tbmdepart.draw();
    $("#tbmDepart").LoadingOverlay("hide");
  });

  // Submit
  $("#updateDepartemen").submit(function () {
    let kode = $("#editDepartKode").val();
    let depart = $("#editDepart").val();
    let status = $("#editDepartStatus").val();
    let ket = $("#editDepartKet").val();
    
    $.ajax({
      type: "POST",
      url: site_url + "Departemen_api/update",
      data: {
        kode: kode.toUpperCase(),
        depart: depart.toUpperCase(),
        status: status,
        ket: ket,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          tbmdepart.draw();
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $("#editDepartKode").val("");
          $("#editDepart").val("");
          $("#editDepartKet").val("");
          $("#editDepartStatus").val("");
          $("#error1ed").html("");
          $("#error2ed").html("");
          $("#error3ed").html("");
          $("#editdepartmdl").modal("hide");
        } else if (
          data.statusCode == 201 ||
          data.statusCode == 203 ||
          data.statusCode == 204 ||
          data.statusCode == 205
        ) {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        } else if (data.statusCode == 202) {
          $("#error1ed").html(data.kode);
          $("#error2ed").html(data.depart);
          $("#error3ed").html(data.status);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        if (xhr.status == 404) {
          pesan = "Departemen gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Departemen gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-update data, hubungi administrator";
        }

        swal("Error", pesan, "error");
        $("#editdepartmdl").modal("hide");
      },
    });
  });
});
