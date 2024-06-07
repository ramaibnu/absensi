$(document).ready(function () {
  $(function () {
    let auth_perusahaan = $("#session_perusahaan").val();
    $("#data_struktur").LoadingOverlay("show");
    $.ajax({
      type: "post",
      url: site_url + "Struktur_api/datatables",
      data: {
        id: auth_perusahaan,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
          $("#data_struktur").html(data.data);
          $("#tbmStruktur").DataTable({
            ordering: false,
            searching: true,
            paging: true,
          });
        } else {
          swal("Error", data.pesan, "error");
        }
        $("#data_struktur").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#data_struktur").LoadingOverlay("hide");
        if (thrownError != "") {
          pesan =
            "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
        } else {
          pesan = "";
        }
        swal("Error", pesan, "error");
      },
    });
  });

  $("#caripjonew").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: site_url + "Search_api/getKaryawan",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
          auth_m_per: $(".2d3f4g5h6j7k8j6b4vec5v").text(),
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      if (ui.item.value != "") {
        $(".ccv445bb66n7uj8ikmhg23fsdf").text(ui.item.value);
        $("#ktppjonew").val(ui.item.ktp);
        $("#nikpjonew").val(ui.item.nik);
        $("#namapjonew").val(ui.item.nama);
        $("#ktppjonew").attr("disabled", true);
        $("#nikpjonew").attr("disabled", true);
        $("#namapjonew").attr("disabled", true);
        $("#caripjonew").val("");
        $(".errktppjonew").text("");
        $(".errnikpjonew").text("");
        $(".errnamapjonew").text("");
      }
      return false;
    },
  });

  $("#btnResetKaryNew").click(function () {
    $.LoadingOverlay("show");
    $("#ktppjonew").val("");
    $("#nikpjonew").val("");
    $("#namapjonew").val("");
    $("#ktppjonew").removeAttr("disabled");
    $("#nikpjonew").removeAttr("disabled");
    $("#namapjonew").removeAttr("disabled");
    $(".ccv445bb66n7uj8ikmhg23fsdf").text("");
    $.LoadingOverlay("hide");
  });

  $("#ktppjonew").keyup(function (e) {
    let noktp = $("#ktppjonew").val().trim();
    let jmlhrf = $("#ktppjonew").val().length;

    if (noktp != "") {
      if (jmlhrf > 16) {
        $(".errktppjonew").html("<p>No. KTP maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".errktppjonew").html("<p>No. KTP minimal 16 karakter</p>");
      } else {
        $(".errktppjonew").html("");
      }
    }
  });

  $(document).on("click", ".btnDetailStrPer", function () {
    $.LoadingOverlay("show");
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#mainCon").text(data.nama_perusahaan);
            $("#subCon").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $("#noRK3L").text(data.stat_RK3L);
            $("#noIUJP").text(data.no_izin_perusahaan);
            $("#tglIUJP").text(data.tgl_izin);
            $("#ketIUJP").text(data.ket_izin_perusahaan);
            $("#noSIO").text(data.no_sio_perusahaan);
            $("#tglSIO").text(data.tgl_sio);
            $("#ketSIO").text(data.ket_sio);
            $("#noKontrak").text(data.no_kontrak_perusahaan);
            $("#tglKontrak").text(data.tgl_kontrak);
            $("#ketKontrak").text(data.ket_kontrak_perusahaan);
            $("#statStr").text(data.stat_m_perusahaan);
            $("#tglEdit").text(data.tgl_edit);
            $("#tglBuat").text(data.tgl_buat);
            $("#namaBuat").text(data.nama_buat);
            $.post(
              site_url + "Struktur_api/pjodetail",
              { auth_m_per: auth_m_per },
              function (data) {
                $("#tblPJODetail").html(data);
              }
            );
            $.post(
              site_url + "Struktur_api/iujpdetail",
              { auth_m_per: auth_m_per },
              function (data) {
                $("#tblIUJPDetail").html(data);
              }
            );
            $.post(
              site_url + "Struktur_api/siodetail",
              { auth_m_per: auth_m_per },
              function (data) {
                $("#tblSIODetail").html(data);
              }
            );
            $.post(
              site_url + "Struktur_api/kontrakdetail",
              { auth_m_per: auth_m_per },
              function (data) {
                $("#tblKontrakDetail").html(data);
              }
            );
            $("#mdlDetailStrPer").modal("show");
            $.LoadingOverlay("hide");
          } else {
            $.LoadingOverlay("hide");
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
            $("#AddPerusahaan").remove();
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".btnRK3LStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#mainConRK3L").text(data.nama_perusahaan);
            $(".7c7dj3hn7k2j7n8j3g7j34").text(auth_m_per);
            $("#subConRK3L").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $("#mdlUploadRK3L").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".btnIUJPStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#mainConIUJP").text(data.nama_perusahaan);
            $("#subConIUJP").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $(".7k23n78j23b7l34c77s4f5h7").text(auth_m_per);
            $("#noIUJPnew").val("");
            $("#tglIUJPnew").val("");
            $("#tglAkhirIUJPnew").val("");
            $("#ketIUJP").val("");
            $("#uploadIUJP").val("");
            $(".errnoIUJP").html("");
            $(".errtglIUJP").html("");
            $(".errtglAkhirIUJP").html("");
            $(".erruploadIUJP").html("");
            $(".errsubcon").html("");
            $("#mdlUploadIUJP").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
            $("#AddPerusahaan").remove();
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".btnSIOStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#mainConSIO").text(data.nama_perusahaan);
            $(".errormsgsio").text("");
            $(".errnosionew").text("");
            $(".errtglawalsionew").text("");
            $(".errtglakhirsionew").text("");
            $(".erruploadsionew").text("");
            $(".noSIO").text("");
            $(".tglAktifSIO").text("");
            $(".tglAkhirSIO").text("");
            $(".ketSIO").text("");
            $(".uploadSIO").text("");
            $(".9k7j8h5g4h9j0k2g3b5g3g").text(auth_m_per);
            $("#subConSIO").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $("#mdlUploadSIO").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".btnKontrakStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#mainConKontrak").text(data.nama_perusahaan);
            $("#subConKontrak").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $(".2e3r4t5y6u7i8o0o9i8u7y6t").text(auth_m_per);
            $("#noKontraknew").val("");
            $("#tglAktifKontrak").val("");
            $("#tglAkhirKontrak").val("");
            $("#ketKontrak").val("");
            $("#uploadKontrak").val("");
            $(".errnokontraknew").text("");
            $(".errtglkontraknew").text("");
            $(".errtglakhirkontraknew").text("");
            $(".erruploadkontraknew").text("");
            $("#mdlUploadKontrak").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".btnPJOStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $.ajax({
              type: "POST",
              url: site_url + "Struktur_api/lokasiPJO",
              success: function (response) {
                var data = JSON.parse(response);
                $("#lokkerpjonew").html(data.pjoo);
                $("#lokkerpjonew").select2({
                  theme: "bootstrap4",
                  dropdownParent: $("#mdlUploadPJO"),
                });
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat load data lokasi kerja PJO, hubungi administrator";
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });

            $("#mainConPJO").text(data.nama_perusahaan);
            $("#subConPJO").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
            $(".2d3f4g5h6j7k8j6b4vec5v").text(auth_m_per);
            $(".errnopjonew").text("");
            $(".errtglaktifpjonew").text("");
            $(".errtglakhirpjonew").text("");
            $(".errlokkerpjonew").text("");
            $(".ccv445bb66n7uj8ikmhg23fsdf").text("");
            $(".errktppjonew").text("");
            $(".errnikpjonew").text("");
            $(".errnamapjonew").text("");
            $("#nopjonew").val("");
            $("#tglakhifpjonew").val("");
            $("#tglakhirpjonew").val("");
            $("#lokkerpjonew").val("").trigger("");
            $("#caripjonew").val("");
            $("#ktppjonew").val("");
            $("#nikpjonew").val("");
            $("#namapjonew").val("");
            $("#ketpjonew").val("");
            $("#filepjonew").val("");
            $("#mdlUploadPJO").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".hpsStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      swal({
        title: "Hapus Perusahaan",
        text: "Yakin data perusahaan ini akan dihapus, data tidak dapat dikembalikan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus Perusahaan",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/delete",
            data: {
              auth_m_per: auth_m_per,
            },
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $.LoadingOverlay("hide");
                window.location.href = site_url + "struktur";
              } else {
                $.LoadingOverlay("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat menghapus PJO, hubungi administrator";
              } else {
                pesan = "";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    } else {
      swal("Error", "Data PJO tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".editStrPer", function () {
    let auth_m_per = $(this).attr("id");

    if (auth_m_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "Struktur_api/read_specific_data",
        data: {
          auth_m_per: auth_m_per,
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.statusCode == 200) {
            $("#jdlEditStrPer").text(
              " EDIT STRUKTUR PERUSAHAAN | " + data.nama_m_perusahaan
            );
            $(".7uik4gsdm89okl23s6j4h3c").text(data.auth_m_per);
            $("#mainConStrPerEdit").text(data.nama_perusahaan);
            $("#namaPerEdit").val(data.nama_m_perusahaan);
            $("#mdlEditStrPer").modal("show");
          } else {
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
            $("#AddPerusahaan").remove();
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $("#updateStruktur").submit(function () {
    let auth_m_per = $(".7uik4gsdm89okl23s6j4h3c").text();
    let namaper = $("#namaPerEdit").val();

    if (auth_m_per != "") {
      if (namaper != "") {
        swal({
          title: "Ganti Nama Perusahaan",
          text: "Yakin nama perusahaan ini akan diganti, data tidak dapat dikembalikan?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Ganti",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + "Struktur_api/update",
              data: {
                auth_m_per: auth_m_per,
                namaper: namaper,
              },
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $("#mdlEditStrPer").modal("hide");
                  $.LoadingOverlay("hide");
                  window.location.href = site_url + "struktur";
                } else {
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat meng-update nama perusahaan, hubungi administrator";
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        $(".errornamaperedit").text("Nama perusahaan wajib diisi");
      }
    } else {
      swal("Error", "Data perusahaan tidak ditemukan", "error");
    }
  });

  $("#updateRK3L").submit(function () {
    let auth_m_per = $(".7c7dj3hn7k2j7n8j3g7j34").text();
    let filerk3l = $("#uploadRK3L").val();
    const flrk3l = $("#uploadRK3L").prop("files")[0];

    if (auth_m_per == "") {
      err_auth_m_per = "Perusahaan tidak ditemukan";
    } else {
      err_auth_m_per = "";
    }

    let fileExtension = filerk3l.split(".").pop().toLowerCase();
    let sizeFile = flrk3l["size"];

    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "File RK3L yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 500000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File RK3L yang dipilih melebihi 500 kb",
        type: "warning",
      });
    } else {
      if (err_auth_m_per == "") {
        swal({
          title: "Upload Data RK3L",
          text: "Yakin data RK3L sudah benar?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Upload file",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("flrk3l", flrk3l);
            formData.append("filerk3l", filerk3l);
            formData.append("auth_m_per", auth_m_per);

            $.ajax({
              type: "POST",
              url: site_url + "Struktur_api/update_RK3L",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $.LoadingOverlay("hide");
                  $("#uploadRK3L").val("");
                  $(".erruploadRK3L").text("");
                  $("#mdlUploadRK3L").modal("hide");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan).then(
                    (value) => {
                      if (value) {
                        location.reload();
                      }
                    }
                  );
                } else if (data.statusCode == 201) {
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else {
                  $(".erruploadRK3L").html(data.filerk3l);
                  $.LoadingOverlay("hide");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat upload data RK3L, hubungi administrator";
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        $(".errormsgRK3L").removeClass("d-none");
        $(".errormsgRK3L").addClass("alert-danger");
        $(".errormsgRK3L").html(err_auth_m_per);

        $(".errormsgRK3L ")
          .fadeTo(3000, 500)
          .slideUp(500, function () {
            $(".errormsgRK3L ").slideUp(500);
            $(".errormsgRK3L ").addClass("d-none");
          });
      }
    }
  });

  $("#updateIUJP").submit(function () {
    let no_iujp = $("#noIUJPnew").val();
    let tgl_awal_iujp = $("#tglIUJPnew").val();
    let tgl_akhir_iujp = $("#tglAkhirIUJPnew").val();
    let ket_iujp = $("#ketIUJP").val();
    let fileiujp = $("#uploadIUJP").val();
    const fliujp = $("#uploadIUJP").prop("files")[0];
    let auth_m_per = $(".7k23n78j23b7l34c77s4f5h7").text();

    if (auth_m_per == "") {
      err_auth_m_per = "Perusahaan tidak ditemukan";
    } else {
      err_auth_m_per = "";
    }

    let fileExtensionIUJP = fileiujp.split(".").pop().toLowerCase();
    let sizeFileIUJP = fliujp["size"];

    if (fileExtensionIUJP != "pdf") {
      swal({
        title: "Informasi",
        text: "File IUJP yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFileIUJP > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File IUJP yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      if (err_auth_m_per == "") {
        swal({
          title: "Simpan IUJP",
          text: "Yakin data IUJP akan disimpan?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Simpan IUJP",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            let formData = new FormData();
            formData.append("fliujp", fliujp);
            formData.append("fileiujp", fileiujp);
            formData.append("no_iujp", no_iujp);
            formData.append("tgl_awal_iujp", tgl_awal_iujp);
            formData.append("tgl_akhir_iujp", tgl_akhir_iujp);
            formData.append("ket_iujp", ket_iujp);
            formData.append("auth_m_per", auth_m_per);

            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + "Struktur_api/insert_IUJP",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                  $(".7k23n78j23b7l34c77s4f5h7").text("");
                  $("#noIUJP").val("");
                  $("#tglIUJP").val("");
                  $("#tglAkhirIUJP").val("");
                  $("#ketIUJP").val("");
                  $("#uploadIUJP").val("");
                  $(".errnoIUJP").html("");
                  $(".errtglIUJP").html("");
                  $(".errtglAkhirIUJP").html("");
                  $(".erruploadIUJP").html("");
                  $("#mdlUploadIUJP").modal("hide");
                  $.LoadingOverlay("hide");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan).then(
                    (value) => {
                      if (value) {
                        location.reload();
                      }
                    }
                  );
                } else if (data.statusCode == 201) {
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else {
                  $(".errsubcon").html(data.auth_m_per);
                  $(".errnoIUJP").html(data.no_iujp);
                  $(".errtglIUJP").html(data.tgl_awal_iujp);
                  $(".errtglAkhirIUJP").html(data.tgl_akhir_iujp);
                  $(".erruploadIUJP").html(data.fileiujp);
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat menyimpan data IUJP, hubungi administrator";
                  $("#addIUJP").remove();
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        $(".errsubcon").html(err_auth_m_per);
      }
    }
  });

  $("#updateSIO").submit(function () {
    let no_sio = $("#noSionew").val();
    let tgl_awal_sio = $("#tglAktifSIO").val();
    let tgl_akhir_sio = $("#tglAkhirSIO").val();
    let ket_sio = $("#ketSIO").val();
    let filesio = $("#uploadSIO").val();
    const flsio = $("#uploadSIO").prop("files")[0];
    let auth_m_per = $(".9k7j8h5g4h9j0k2g3b5g3g").text();

    let fileExtensionSIO = filesio.split(".").pop().toLowerCase();
    let sizeFileSIO = flsio["size"];

    if (fileExtensionSIO != "pdf") {
      swal({
        title: "Informasi",
        text: "File SIO yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFileSIO > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File SIO yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      swal({
        title: "Simpan SIO",
        text: "Yakin data SIO akan disimpan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan SIO",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          let formData = new FormData();
          formData.append("flsio", flsio);
          formData.append("filesio", filesio);
          formData.append("no_sio", no_sio);
          formData.append("tgl_awal_sio", tgl_awal_sio);
          formData.append("tgl_akhir_sio", tgl_akhir_sio);
          formData.append("ket_sio", ket_sio);
          formData.append("auth_m_per", auth_m_per);

          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/insert_SIO",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $(".9k7j8h5g4h9j0k2g3b5g3g").text("");
                $(".errnosionew").html("");
                $(".errtglawalsionew").html("");
                $(".errtglakhirsionew").html("");
                $(".erruploadsionew").html("");
                $("#noSIO").val("");
                $("#tglAktifSIO").val("");
                $("#tglAkhirSIO").val("");
                $("#ketSIO").val("");
                $("#uploadSIO").val("");
                $("#mdlUploadSIO").modal("hide");
                $.LoadingOverlay("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan).then(
                  (value) => {
                    if (value) {
                      location.reload();
                    }
                  }
                );
              } else if (data.statusCode == 201) {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
                $(".errnosionew").html(data.no_sio);
                $(".errtglawalsionew").html(data.tgl_awal_sio);
                $(".errtglakhirsionew").html(data.tgl_akhir_sio);
                $(".erruploadsionew").html(data.filesio);
                $.LoadingOverlay("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat menyimpan data SIO, hubungi administrator";
              } else {
                pesan = "";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    }
  });

  $("#updateKontrak").submit(function () {
    let no_kontrak = $("#noKontraknew").val();
    let tgl_awal_kontrak = $("#tglAktifKontrak").val();
    let tgl_akhir_kontrak = $("#tglAkhirKontrak").val();
    let ket_kontrak = $("#ketKontrak").val();
    let filekontrak = $("#uploadKontrak").val();
    const flkontrak = $("#uploadKontrak").prop("files")[0];
    let auth_m_per = $(".2e3r4t5y6u7i8o0o9i8u7y6t").text();

    let fileExtensionKontrak = filekontrak.split(".").pop().toLowerCase();
    let sizeFileKontrak = flkontrak["size"];

    if (fileExtensionKontrak != "pdf") {
      swal({
        title: "Informasi",
        text: "File Kontrak yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFileKontrak > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File Kontrak yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      swal({
        title: "Simpan Kontrak",
        text: "Yakin data Kontrak akan disimpan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan Kontrak",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          let formData = new FormData();
          formData.append("flkontrak", flkontrak);
          formData.append("filekontrak", filekontrak);
          formData.append("no_kontrak", no_kontrak);
          formData.append("tgl_awal_kontrak", tgl_awal_kontrak);
          formData.append("tgl_akhir_kontrak", tgl_akhir_kontrak);
          formData.append("ket_kontrak", ket_kontrak);
          formData.append("auth_m_per", auth_m_per);
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/insert_kontrak",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $(".2e3r4t5y6u7i8o0o9i8u7y6t").text("");
                $("#noKontraknew").val("");
                $("#tglAktifKontrak").val("");
                $("#tglAkhirKontrak").val("");
                $("#ketKontrak").val("");
                $("#uploadKontrak").val("");
                $(".errnokontraknew").text("");
                $(".errtglkontraknew").text("");
                $(".errtglakhirkontraknew").text("");
                $(".erruploadkontraknew").text("");
                $("#mdlUploadKontrak").modal("hide");
                $.LoadingOverlay("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan).then(
                  (value) => {
                    if (value) {
                      location.reload();
                    }
                  }
                );
              } else if (data.statusCode == 201) {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              } else {
                $(".errnokontraknew").html(data.no_kontrak);
                $(".errtglkontraknew").html(data.tgl_awal_kontrak);
                $(".errtglakhirkontraknew").html(data.tgl_akhir_kontrak);
                $(".erruploadkontraknew").html(data.filekontrak);
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");

              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat menyimpan data kontrak, hubungi administrator";
              } else {
                pesan = "";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    }
  });

  $("#updatePJO").submit(function () {
    let no_pjo = $("#nopjonew").val();
    let id_lokker = $("#lokkerpjonew").val();
    let tgl_awal_pjo = $("#tglakhifpjonew").val();
    let tgl_akhir_pjo = $("#tglakhirpjonew").val();
    let ket_pjo = $("#ketpjonew").val();
    let ktp_pjo = $("#ktppjonew").val();
    let nik_pjo = $("#nikpjonew").val();
    let nama_pjo = $("#namapjonew").val();
    let auth_kary = $(".ccv445bb66n7uj8ikmhg23fsdf").text();
    let filepjo = $("#filepjonew").val();
    const flpjo = $("#filepjonew").prop("files")[0];
    let auth_m_per = $(".2d3f4g5h6j7k8j6b4vec5v").text();

    let fileExtensionPJO = filepjo.split(".").pop().toLowerCase();
    let sizeFilePJO = flpjo["size"];

    if (fileExtensionPJO != "pdf") {
      swal({
        title: "Informasi",
        text: "File PJO yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFilePJO > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File PJO yang dipilih melebihi 100 kb",
        type: "warning",
      });
    } else {
      swal({
        title: "Simpan PJO",
        text: "Yakin data PJO akan disimpan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan PJO",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          let formData = new FormData();
          formData.append("flpjo", flpjo);
          formData.append("filepjo", filepjo);
          formData.append("no_pjo", no_pjo);
          formData.append("id_lokker", id_lokker);
          formData.append("tgl_awal_pjo", tgl_awal_pjo);
          formData.append("tgl_akhir_pjo", tgl_akhir_pjo);
          formData.append("ket_pjo", ket_pjo);
          formData.append("auth_m_per", auth_m_per);
          formData.append("ktp_pjo", ktp_pjo);
          formData.append("nik_pjo", nik_pjo);
          formData.append("nama_pjo", nama_pjo);
          formData.append("auth_kary", auth_kary);
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/insert_PJO",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
              var data = JSON.parse(response);
              if (data.statusCode == 200) {
                $(".2d3f4g5h6j7k8j6b4vec5v").text("");
                $(".ccv445bb66n7uj8ikmhg23fsdf").text("");
                $("#mdlUploadPJO").modal("hide");
                $.LoadingOverlay("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan).then(
                  (value) => {
                    if (value) {
                      location.reload();
                    }
                  }
                );
              } else if (data.statusCode == 201) {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              } else {
                $(".errnopjonew").html(data.no_pjo);
                $(".errlokkerpjonew").html(data.id_lokker);
                $(".errtglaktifpjonew").html(data.tgl_awal_pjo);
                $(".errtglakhirpjonew").html(data.tgl_akhir_pjo);
                $(".errktppjonew").html(data.ktp_pjo);
                $(".errnikpjonew").html(data.nik_pjo);
                $(".errnamapjonew").html(data.nama_pjo);
                $(".errfilepjonew").html(data.filepjo);
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat menyimpan data kontrak, hubungi administrator";
              } else {
                pesan = "";
              }
              swal("Error", pesan, "error");
            },
          });
        }
      });
    }
  });
});
