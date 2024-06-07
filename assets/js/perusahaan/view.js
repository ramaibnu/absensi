$(document).ready(function () {
  // Function
  function edit_alamat(id_prov, id_kab, id_kec, id_kel) {
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_prov",
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanProv").html(data.prov);
        $("#editPerusahaanProv").val(id_prov);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data provinsi, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: id_prov,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKab").html(data.kab);
        $("#editPerusahaanKab").val(id_kab);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: id_kab,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKec").html(data.kec);
        $("#editPerusahaanKec").val(id_kec);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: id_kec,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKel").html(data.kel);
        $("#editPerusahaanKel").val(id_kel);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  }

  // Select Searchable
  $("#editPerusahaanProv").select2({
    dropdownParent: $("#editPerusahaanmdl"),
    theme: "bootstrap4",
  });
  $("#editPerusahaanKab").select2({
    dropdownParent: $("#editPerusahaanmdl"),
    theme: "bootstrap4",
  });
  $("#editPerusahaanKec").select2({
    dropdownParent: $("#editPerusahaanmdl"),
    theme: "bootstrap4",
  });
  $("#editPerusahaanKel").select2({
    dropdownParent: $("#editPerusahaanmdl"),
    theme: "bootstrap4",
  });

  // SSP Datatables
  function tbPerusahaan() {
    tbmPerusahaan = $("#tbmPerusahaan").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "Perusahaan_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "Terjadi kesalahan saat melakukan load data perusahaan, hubungi administrator";
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
          name: "id_perusahaan",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "kode_perusahaan",
          className: "text-nowrap  align-middle",
          width: "10%",
        },
        {
          data: "nama_perusahaan",
          className: "text-nowrap  align-middle",
          width: "30%",
        },
        {
          data: "alamat_perusahaan",
          className: "text-nowrap  align-middle",
          width: "35%",
        },
        {
          data: "stat_perusahaan",
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap  align-middle",
          width: "1%",
        },
      ],
    });
  }
  tbPerusahaan();

  // Click
  $("#tbmPerusahaan").on("click", ".hpsperusahaan", function () {
    let namaPerusahaan = $(this).attr("value");
    let auth_perusahaan = $(this).attr("id");

    if (auth_perusahaan == "") {
      swal("Error", "Perusahaan tidak ditemukan", "error");
    } else {
      swal({
        title: "Hapus",
        text: "Yakin Perusahaan " + namaPerusahaan + " akan dihapus?",
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
            url: site_url + "Perusahaan_api/delete",
            data: {
              auth_perusahaan: auth_perusahaan,
            },
            timeout: 20000,
            success: function (response, textStatus, xhr) {
              $.LoadingOverlay("hide");
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                tbmPerusahaan.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (xhr.status == 404) {
                pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
              } else if (xhr.status == 0) {
                pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
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
  $("#tbmPerusahaan").on("click", ".dtlperusahaan", function () {
    let auth_perusahaan = $(this).attr("id");

    if (auth_perusahaan == "") {
      swal("Error", "Perusahaan tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Perusahaan_api/read_specific_data",
        data: {
          auth_perusahaan: auth_perusahaan,
        },
        timeout: 15000,
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#detailPerusahaanKode").val(data.kode);
            $("#detailPerusahaan").val(data.perusahaan);
            $("#detailPerusahaanAlamat").val(data.alamat);
            $("#detailPerusahaanKodepos").val(data.kodepos);
            $("#detailPerusahaanTelp").val(data.perusahaatelp);
            $("#detailPerusahaanEmail").val(data.email);
            $("#detailPerusahaanWeb").val(data.web);
            $("#detailPerusahaanNpwp").val(data.npwp);
            $("#detailPerusahaanKeg").val(data.keg);
            $("#detailPerusahaanStatus").val(data.status);
            $("#detailPerusahaanKet").val(data.ket);
            $("#detailPerusahaanBuat").val(data.pembuat);
            $("#detailPerusahaanTglBuat").val(data.tgl_buat);
            $("#detailPerusahaanTglEdit").val(data.tgl_edit);
            $("#detailPerusahaanmdl").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });
  $("#tbmPerusahaan").on("click", ".edttperusahaan", function () {
    let auth_perusahaan = $(this).attr("id");

    if (auth_perusahaan == "") {
      swal("Error", "Perusahaan tidak ditemukan", "error");
    } else {
      $.ajax({
        type: "post",
        url: site_url + "Perusahaan_api/read_specific_data2",
        data: {
          auth_perusahaan: auth_perusahaan,
        },
        timeout: 15000,
        success: function (data) {
          var dataPerusahaan = JSON.parse(data);
          if (dataPerusahaan.statusCode == 200) {
            $("#jdleditPerusahaan").text(dataPerusahaan.judul);
            $("#editPerusahaanKode").val(dataPerusahaan.kode);
            $("#editPerusahaan").val(dataPerusahaan.perusahaan);
            $("#editPerusahaanAlamat").val(dataPerusahaan.alamat);
            edit_alamat(
              dataPerusahaan.prov,
              dataPerusahaan.kab,
              dataPerusahaan.kec,
              dataPerusahaan.kel
            );
            $("#editPerusahaanKodepos").val(dataPerusahaan.kodepos);
            $("#editPerusahaanTelp").val(dataPerusahaan.perusahaatelp);
            $("#editPerusahaanEmail").val(dataPerusahaan.email);
            $("#editPerusahaanWeb").val(dataPerusahaan.web);
            $("#editPerusahaanNpwp").val(dataPerusahaan.npwp);
            $("#editPerusahaanKeg").val(dataPerusahaan.keg);
            $("#editPerusahaanStatus").val(dataPerusahaan.status);
            $("#editPerusahaanKet").val(dataPerusahaan.ket);
            $("#editPerusahaanmdl").modal("show");
          } else {
            swal(
              dataPerusahaan.kode_pesan,
              dataPerusahaan.pesan,
              dataPerusahaan.tipe_pesan
            );
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (xhr.status == 404) {
            pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
          } else if (xhr.status == 0) {
            pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
          } else {
            pesan =
              "Terjadi kesalahan saat menampilkan data, hubungi administrator";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  // Change
  $("#editPerusahaanProv").change(function () {
    let id_prov = $("#editPerusahaanProv").val();
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kab",
      data: {
        id_prov: id_prov,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKab").html(data.kab);
        $("#editPerusahaanKec").html(
          "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
        );
        $("#editPerusahaanKel").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
  $("#editPerusahaanKab").change(function () {
    let id_kab = $("#editPerusahaanKab").val();

    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kec",
      data: {
        id_kab: id_kab,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKec").html(data.kec);
        $("#editPerusahaanKel").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });
  $("#editPerusahaanKec").change(function () {
    let id_kec = $("#editPerusahaanKec").val();
    $.ajax({
      type: "post",
      url: site_url + "Daerah_api/get_kel",
      data: {
        id_kec: id_kec,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#editPerusahaanKel").html(data.kel);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
          $("#btnTambahPerusahaan").remove();
        } else {
          pesan = "";
        }

        swal("Error", pesan, "error");
      },
    });
  });

  // Submit
  $("#updatePerusahaan").submit(function () {
    let kode = $("#editPerusahaanKode").val();
    let perusahaan = $("#editPerusahaan").val();
    let alamat = $("#editPerusahaanAlamat").val();
    let kel = $("#editPerusahaanKel").val();
    let kec = $("#editPerusahaanKec").val();
    let kab = $("#editPerusahaanKab").val();
    let prov = $("#editPerusahaanProv").val();
    let status = $("#editPerusahaanStatus").val();
    let ket = $("#editPerusahaanKet").val();

    $.ajax({
      type: "POST",
      url: site_url + "Perusahaan_api/update",
      data: {
        kode: kode,
        perusahaan: perusahaan,
        alamat: alamat,
        kel: kel,
        kec: kec,
        kab: kab,
        prov: prov,
        status: status,
        ket: ket,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          tbmPerusahaan.draw();
          $("#editPerusahaanmdl").modal("hide");
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        if (xhr.status == 404) {
          pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
        } else if (xhr.status == 0) {
          pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
        } else {
          pesan =
            "Terjadi kesalahan saat meng-update data, hubungi administrator";
        }

        swal("Error", pesan, "error");
      },
    });
  });
});
