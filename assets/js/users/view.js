$(document).ready(function () {
  // Functions
  function formatIndonesianDate(timestamp) {
    var monthNames = [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember",
    ];

    var date = new Date(timestamp);
    var day = date.getDate();
    var month = monthNames[date.getMonth()];
    var year = date.getFullYear();

    var formattedDate = day + " " + month + " " + year;

    return formattedDate;
  }

  // SSP Datatables
  function tbUser() {
    tbmUser = $("#tbmUser").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "asc"]],
      ajax: {
        url: site_url + "User_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data user, hubungi administrator";
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
          name: "id_user",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "nama_user",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "email_user",
          className: "text-nowrap align-middle",
          width: "50%",
        },
        {
          data: "stat_user",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
      ],
    });
  }
  tbUser();

  // Click
  $(document).on("click", ".hapusUser", function () {
    let auth_user = $(this).attr("id");
    let nama_user = $(this).attr("value");

    swal({
      title: "Hapus data user!",
      text: "Yakin data user atas nama " + nama_user + " akan dihapus?",
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
          url: site_url + "User_api/delete",
          data: {
            auth_user: auth_user,
          },
          timeout: 20000,
          success: function (response) {
            var data = JSON.parse(response);
            if (data.statusCode == 200) {
              tbmUser.draw();
              swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              $.LoadingOverlay("hide");
            } else {
              swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              $.LoadingOverlay("hide");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");

            if (xhr.status == 404) {
              pesan = "User gagal diupdate, Link data tidak ditemukan";
            } else if (xhr.status == 0) {
              pesan = "User gagal diupdate, Waktu koneksi habis";
            } else {
              pesan =
                "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
            }

            swal("Error", pesan, "error");
          },
        });
      }
    });
  });

  $(document).on("click", ".detailUser", function () {
    let auth_user = $(this).attr("id");

    if (auth_user == "") {
      swal("Error", "User tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "User_api/read_specific_data",
        data: {
          auth_user: auth_user,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#namaUser").val(data.nama_user);
            $("#emailUser").val(data.email_user);
            $("#tglAktif").val(formatIndonesianDate(data.tgl_aktif));
            $("#tglExpired").val(formatIndonesianDate(data.tgl_exp));
            $("#aksesUser").val(data.menu);
            $("#perusahaanUser").val(data.perusahaan);
            $("#detailUsermdl").modal("show");
            $.LoadingOverlay("hide");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          }
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat menampilkan data user!",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".editUser", function () {
    let auth_user = $(this).attr("id");

    if (auth_user == "") {
      swal("Error", "User tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "User_api/read_specific_data",
        data: {
          auth_user: auth_user,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#updateNamaUser").val(data.nama_user);
            $("#updateEmailUser").val(data.email_user);
            $("#updateTglAktif").val(data.tgl_aktif);
            $("#updateTglExpired").val(data.tgl_exp);
            let aksesOption = $("#updateAksesUser").find(
              'option:contains("' + data.menu + '")'
            );
            $("#updateAksesUser").select2({
              theme: "bootstrap4",
              dropdownParent: $("#editUsermdl"),
            });
            $("#updateAksesUser").val(aksesOption.val()).trigger("change");
            let perusahaanOption = $("#updatePerusahaanUser").find(
              'option:contains("' + data.struktur + '")'
            );
            $("#updatePerusahaanUser").select2({
              theme: "bootstrap4",
              dropdownParent: $("#editUsermdl"),
            });
            $("#updatePerusahaanUser")
              .val(perusahaanOption.val())
              .trigger("change");
            $("#editUsermdl").modal("show");
            $.LoadingOverlay("hide");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          }
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat menampilkan data user!",
            "error"
          );
        },
      });
    }
  });

  $(document).on("click", ".resetPassword", function () {
    let auth_user = $(this).attr("id");

    if (auth_user == "") {
      swal("Error", "User tidak ditemukan", "error");
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "User_api/read_specific_data",
        data: {
          auth_user: auth_user,
        },
        timeout: 15000,
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#resetPasswordmdl").modal("show");
            $.LoadingOverlay("hide");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          }
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal("Error", "Terjadi kesalahan saat mengambil data user!", "error");
        },
      });
    }
  });

  $(document).on("click", ".aktifUser", function () {
    let auth_user = $(this).attr("id");
    let nama_user = $(this).attr("value");

    if (auth_user == "") {
      swal("Error", "User tidak ditemukan", "error");
    } else {
      swal({
        title: "Aktifkan User!",
        text: "Yakin user atas nama " + nama_user + " akan diaktifkan kembali?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, aktifkan!",
        cancelButtonText: "Batalkan!",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "post",
            url: site_url + "User_api/aktif",
            data: {
              auth_user: auth_user,
            },
            timeout: 15000,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                tbmUser.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function () {
              $.LoadingOverlay("hide");
              swal(
                "Error",
                "Terjadi kesalahan saat meengaktifkan user!",
                "error"
              );
            },
          });
        }
      });
    }
  });

  $(document).on("click", ".nonaktifUser", function () {
    let auth_user = $(this).attr("id");
    let nama_user = $(this).attr("value");

    if (auth_user == "") {
      swal("Error", "User tidak ditemukan", "error");
    } else {
      swal({
        title: "Nonaktifkan User!",
        text: "Yakin user atas nama " + nama_user + " akan dinonaktifkan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, nonaktifkan!",
        cancelButtonText: "Batalkan!",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "post",
            url: site_url + "User_api/nonaktif",
            data: {
              auth_user: auth_user,
            },
            timeout: 15000,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                tbmUser.draw();
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function () {
              $.LoadingOverlay("hide");
              swal(
                "Error",
                "Terjadi kesalahan saat menonaktifkan user!",
                "error"
              );
            },
          });
        }
      });
    }
  });

  // Submit
  $("#updateUser").submit(function () {
    let nama_user = $("#updateNamaUser").val();
    let email_user = $("#updateEmailUser").val();
    let tgl_aktif = $("#updateTglAktif").val();
    let tgl_exp = $("#updateTglExpired").val();
    let id_menu = $("#updateAksesUser").val();
    let id_m_perusahaan = $("#updatePerusahaanUser").val();

    if (tgl_exp < tgl_aktif) {
      swal({
        title: "Tanggal Expired harus setelah Tanggal Aktif!",
        text: "Isi Tanggal Expired dengan benar!",
        type: "warning",
      }).then(function () {
        $("#updateTglExpired").focus();
      });
    } else {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "User_api/update",
        data: {
          nama_user: nama_user,
          email_user: email_user,
          tgl_aktif: tgl_aktif,
          tgl_exp: tgl_exp,
          id_menu: id_menu,
          id_m_perusahaan: id_m_perusahaan,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            tbmUser.draw();
            $("#editUsermdl").modal("hide");
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $.LoadingOverlay("hide");
          }
        },
        error: function () {
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Terjadi kesalahan saat meng-update data, hubungi administrator",
            "error"
          );
        },
      });
    }
  });

  $("#resetSandi").submit(function () {
    let newPassword = $("#newPassword").val();

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "User_api/reset_password",
      data: {
        newPassword: newPassword,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#resetPasswordmdl").modal("hide");
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $.LoadingOverlay("hide");
        } else {
          swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          $.LoadingOverlay("hide");
        }
      },
      error: function () {
        $.LoadingOverlay("hide");
        swal(
          "Error",
          "Terjadi kesalahan saat mereset password user, hubungi administrator",
          "error"
        );
      },
    });
  });
});
