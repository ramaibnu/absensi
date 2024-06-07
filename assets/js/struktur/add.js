$(document).ready(function () {
  $.LoadingOverlay("hide");
  $("#colPerusahaan").collapse("show");

  $.ajax({
    type: "POST",
    url: site_url + "Struktur_api/lokasiPJO",
    data: {},
    success: function (data) {
      var data = JSON.parse(data);
      $("#lokkerpjo").html(data.pjoo);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsgpjo").removeClass("d-none");
      $(".errormsgpjo").removeClass("alert-info");
      $(".errormsgpjo").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsgpjo").html(
          "Terjadi kesalahan saat load data lokasi PJO, hubungi administrator"
        );
        $("#btnTambahLevel").attr("disabled", true);
      }
    },
  });

  $(document).on("click", ".editPJO", function () {
    let auth_pjo = $(this).attr("id");
    var token = $("#token").val();

    if (auth_pjo != "") {
      $.ajax({
        type: "POST",
        url: site_url + "struktur/get_detail_m_per",
        data: {
          auth_m_per: auth_m_per,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#mainConPJO").text(data.nama_perusahaan);
            $("#subConPJO").text(
              data.nama_m_perusahaan + " | " + data.kode_perusahaan
            );
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
            $("#AddPerusahaan").remove();
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    } else {
      swal("Error", "Data PJO tidak ditemukan", "error");
    }
  });

  $(document).on("click", ".hapusPJO", function () {
    let auth_pjo = $(this).attr("id");
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    var token = $("#token").val();

    if (auth_pjo != "") {
      swal({
        title: "Hapus PJO",
        text: "Yakin data PJO akan dihapus, data tidak dapat dikembalikan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus PJO",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: site_url + "struktur/hapus_pjo",
            data: {
              auth_pjo: auth_pjo,
              auth_m_per: auth_m_per,
              token: token,
            },
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#idpjo").LoadingOverlay("show");
                $("#idpjo").load(
                  site_url + "Struktur_api/pjo?auth_m_per=" + auth_m_per
                );
                $("#idpjo").LoadingOverlay("hide");
                if (data.jml_pjo == 0) {
                  $("#imgPJO").addClass("d-none");
                }
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              } else {
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

  $("#cariMPerusahaan").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: site_url + "Search_api/getPerusahaan",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
        },
        success: function (data) {
          response(data);
          // var perjenis = $("#perJenis").val();

          // if (perjenis !== "") {
          //   response(data);
          // }
        },
      });
    },
    select: function (event, ui) {
      if (ui.item.value != "") {
        $("#namaMperusahaan").val(ui.item.nama);
        $("#kodeMperusahaan").val(ui.item.kode);
        $("#cariMPerusahaan").val("");
        $(".error2str").text("");
        $(".error3str").text("");
      }
      return false;
    },
  });

  $("#cariMPerusahaan").keyup(function () {
    let perutama = $("#perJenis").val();

    if (perutama === "") {
      swal(
        "Perusahaan Utama",
        "Pilih Perusahaan utama terlebih dahulu",
        "warning"
      );
      $("#cariMPerusahaan").val("");
    }
  });

  $("#clRK3L-click").click(function () {
    if ($("#colRK3L").hasClass("show")) {
      $("#colRK3L").collapse("hide");
    } else {
      $("#colRK3L").collapse("show");
    }
  });

  $("#clIUJP-click").click(function () {
    if ($("#colIUJP").hasClass("show")) {
      $("#colIUJP").collapse("hide");
    } else {
      $("#colIUJP").collapse("show");
    }
  });

  $("#clSIO-click").click(function () {
    if ($("#colSIO").hasClass("show")) {
      $("#colSIO").collapse("hide");
    } else {
      $("#colSIO").collapse("show");
    }
  });

  $("#clKontrak-click").click(function () {
    if ($("#colKontrak").hasClass("show")) {
      $("#colKontrak").collapse("hide");
    } else {
      $("#colKontrak").collapse("show");
    }
  });

  $("#clPJO-click").click(function () {
    if ($("#colPJO").hasClass("show")) {
      $("#colPJO").collapse("hide");
    } else {
      $("#colPJO").collapse("show");
    }
  });

  $("#caripjo").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: site_url + "Search_api/getKaryawan",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
          auth_m_per: $(".a67z34ssdh53b45jfasda4").text(),
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      if (ui.item.value != "") {
        $(".8c9l1k4n9d09vm3mn43k8s834kk45").text(ui.item.value);
        $("#ktppjo").val(ui.item.ktp);
        $("#nikpjo").val(ui.item.nik);
        $("#namapjo").val(ui.item.nama);
        $("#ktppjo").attr("disabled", true);
        $("#nikpjo").attr("disabled", true);
        $("#namapjo").attr("disabled", true);
        $("#caripjo").val("");
        $(".error6pjo").text("");
        $(".error7pjo").text("");
        $(".error8pjo").text("");
      }
      return false;
    },
  });

  $("#perJenis").change(function () {
    $("#cariMPerusahaan").focus();
  });

  $("#perJenis").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlstrperusahaan"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#perJenis").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdlstrperusahaan"),
      });
    },
    true
  );

  $("#btnNewStr").click(function () {
    if ($("#btnSelesaiStrPer").length > 0) {
      swal(
        "Error",
        "Tidak dapat membuat data baru, selesaikan data perusahaan",
        "error"
      );
      return false;
    } else {
      $("#mdlstrperusahaan").modal("show");
      $("#perJenis").val("").trigger("change");
      $("#cariMPerusahaan").val("");
      $("#kodeMperusahaan").val("");
      $("#namaMperusahaan").val("");
      $(".error1str").text("");
      $(".error2str").text("");
      $(".error3str").text("");
      $(".8ih3js7h3k8kj42b5n1m5n3").text("");
      $(".b8f9s7sd7f7asj3h4j3k2j").text("");
      $(".a67z34ssdh53b45jfasda4").text("");
    }
  });

  $("#btnResetKary").click(function () {
    $.LoadingOverlay("show");
    $("#ktppjo").val("");
    $("#nikpjo").val("");
    $("#namapjo").val("");
    $("#ktppjo").removeAttr("disabled");
    $("#nikpjo").removeAttr("disabled");
    $("#namapjo").removeAttr("disabled");
    $(".8c9l1k4n9d09vm3mn43k8s834kk").text("");
    $.LoadingOverlay("hide");
  });

  $("#lokkerpjo").select2({
    theme: "bootstrap4",
  });

  $("#addStruktur").submit(function () {
    let idparent = $("#perJenis").val();
    let perutama = $("#perJenis option:selected").text();
    let kodeper = $("#kodeMperusahaan").val();
    let namaper = $("#namaMperusahaan").val();

    swal({
      title: "Buat Struktur Perusahaan",
      text: "Yakin data struktur perusahaan sudah benar, data tidak dapat diubah setelah disimpan?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Buat data",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.LoadingOverlay("show");
        let formData = new FormData();
        formData.append("idparent", idparent);
        formData.append("kodeper", kodeper);
        formData.append("namaper", namaper);

        $.ajax({
          type: "POST",
          url: site_url + "Struktur_api/insert",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function (data) {
            var data = JSON.parse(data);
            $.LoadingOverlay("hide");
            if (data.statusCode == 200) {
              $(".btnselesai").append(
                '<button type="button" id="btnSelesaiStrPer" class="btn btn-success font-weight-bold mt-1 ml-2">Update & Selesai</button>'
              );
              $("#imgPerusahaan").removeClass("d-none");
              $("#colRK3L").collapse("show");
              $("#colIUJP").collapse("hide");
              $("#colSIO").collapse("hide");
              $("#colKontrak").collapse("hide");
              $("#colPJO").collapse("hide");
              $("#txtPerusahaanUtama").text(perutama);
              $("#txtkodeMperusahaan").text(kodeper);
              $("#txtnamaMperusahaan").text(namaper);
              $(".a67z34ssdh53b45jfasda4").text(data.auth_m_per);
              $(".b8f9s7sd7f7asj3h4j3k2j").text(data.auth_parent);
              $(".8ih3js7h3k8kj42b5n1m5n3").text(data.auth_per);
              $("#mdlstrperusahaan").modal("hide");
              aktifRK3L();
              aktifIUJP();
              aktifSIO();
              aktifKontrak();
              aktifPJO();
              swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              $.LoadingOverlay("hide");
              $("#btnSelesaiStrPer").click(function () {
                swal({
                  title: "Simpan Data Perusahaan",
                  text: "Yakin data perusahaan sudah lengkap dan akan disimpan?",
                  type: "question",
                  showCancelButton: true,
                  confirmButtonColor: "#36c6d3",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Ya, simpan",
                  cancelButtonText: "Batalkan",
                }).then(function (result) {
                  if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                      type: "POST",
                      url: site_url + "Struktur_api/selesai",
                      success: function () {
                        $.LoadingOverlay("hide");
                        window.location.href = site_url + "tambah_struktur";
                      },
                    });
                  }
                });
              });
            } else if (data.statusCode == 201) {
              swal(data.kode_pesan, data.pesan, data.tipe_pesan);
              $.LoadingOverlay("hide");
            } else {
              $(".error1str").html(data.idparent);
              $(".error2str").html(data.kodeper);
              $(".error3str").html(data.namaper);
              $.LoadingOverlay("hide");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            if (thrownError != "") {
              pesan =
                "Terjadi kesalahan saat menyimpan data struktur Perusahaan, hubungi administrator";
              $("#AddPerusahaan").remove();
            } else {
              pesan = "";
            }

            swal("Error", pesan, "error");
          },
        });
      }
    });
  });

  $("#btnTabelStr").click(function () {
    if ($("#btnSelesaiStrPer").length) {
      swal(
        "Peringatan!!!",
        "Tidak dapat melanjutkan, selesaikan data perusahaan",
        "warning"
      );
      return false;
    } else {
      let url = site_url + "struktur";
      window.open(url, "_blank");
    }
  });

  function aktifRK3L() {
    $("#filerk3l").removeAttr("disabled");
    $("#btnUploadFileRK3L").removeAttr("disabled");
  }

  function aktifIUJP() {
    $("#fileiujp").removeAttr("disabled");
    $("#noiujp").removeAttr("disabled");
    $("#tglAktifiujp").removeAttr("disabled");
    $("#tglakhiriujp").removeAttr("disabled");
    $("#ketiujp").removeAttr("disabled");
    $("#btnUploadFileIUJP").removeAttr("disabled");
  }

  function aktifSIO() {
    $("#fileSIO").removeAttr("disabled");
    $("#noSIO").removeAttr("disabled");
    $("#tglaktifSIO").removeAttr("disabled");
    $("#tglakhirSIO").removeAttr("disabled");
    $("#ketSIO").removeAttr("disabled");
    $("#btnUploadFileSIO").removeAttr("disabled");
  }

  function aktifKontrak() {
    $("#fileKontrak").removeAttr("disabled");
    $("#nokontrak").removeAttr("disabled");
    $("#tglaktifkontrak").removeAttr("disabled");
    $("#tglakhirkontrak").removeAttr("disabled");
    $("#ketkontrak").removeAttr("disabled");
    $("#btnUploadFileKontrak").removeAttr("disabled");
  }

  function aktifPJO() {
    $("#filePJO").removeAttr("disabled");
    $("#nopjo").removeAttr("disabled");
    $("#tglaktifpjo").removeAttr("disabled");
    $("#tglakhirpjo").removeAttr("disabled");
    $("#lokkerpjo").removeAttr("disabled");
    $("#caripjo").removeAttr("disabled");
    $("#ktppjo").removeAttr("disabled");
    $("#nikpjo").removeAttr("disabled");
    $("#namapjo").removeAttr("disabled");
    $("#ketpjo").removeAttr("disabled");
    $("#refreshPjo").removeAttr("disabled");
    $("#addSimpanPJO").removeAttr("disabled");
  }

  $("#addRK3L").submit(function () {
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    let filerk3l = $("#filerk3l").val();
    const flrk3l = $("#filerk3l").prop("files")[0];

    if (auth_m_per == "") {
      err_auth_m_per = "Perusahaan belum dibuat";
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
    } else if (sizeFile > 600000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File RK3L yang dipilih melebihi 600 kb",
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
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#imgRK3L").removeClass("d-none");
                  $("#colRK3L").collapse("hide");
                  $("#colIUJP").collapse("hide");
                  $("#colSIO").collapse("hide");
                  $("#colKontrak").collapse("hide");
                  $("#colPJO").collapse("hide");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $("#filerk3l").attr("disabled", true);
                  $("#btnUploadFileRK3L").attr("disabled", true);
                  $("#resetFileRK3L").removeAttr("disabled");
                  $("#addBukaFile").attr("href", data.link);
                  $("#addBukaFile").removeClass("disabled");
                  $(".error6rk3l").text("");
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  swal("Error", data.pesan, "error");
                  $.LoadingOverlay("hide");
                } else {
                  $(".error6rk3l").html(data.filerk3l);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat upload data RK3L, hubungi administrator";
                  $("#AddPerusahaan").remove();
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        swal("Error", err_auth_m_per, "error");
      }
    }
  });

  $("#resetFileRK3L").click(function () {
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    let filerk3l = $("#filerk3l").val();

    if (auth_m_per == "") {
      err_auth_m_per = "Perusahaan belum dibuat";
    } else {
      err_auth_m_per = "";
    }

    if (filerk3l == "") {
      err_filerk3l = "RK3L wajib diupload";
    } else {
      err_filerk3l = "";
    }

    if (err_filerk3l == "" && err_auth_m_per == "") {
      swal({
        title: "Reset Data RK3L",
        text: "Yakin data RK3L akan direset?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Reset RK3L",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          let formData = new FormData();
          formData.append("auth_m_per", auth_m_per);
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/reset_RK3L",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#imgRK3L").addClass("d-none");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $("#addBukaFile").addClass("disabled");
                $("#addBukaFile").attr("href", "");
                $("#resetFileRK3L").attr("disabled", true);
                $("#filerk3l").removeAttr("disabled");
                $("#btnUploadFileRK3L").removeAttr("disabled");
                $(".error6rk3l").text("");
                $("#filerk3l").val("");
                $.LoadingOverlay("hide");
              } else if (data.statusCode == 201) {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              } else {
                $(".error6rk3l").html(data.filerk3l);
                if (data.auth_m_per != "") {
                  swal(data.kode_pesan, data.auth_m_per, data.tipe_pesan);
                }
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");

              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat reset data RK3L, hubungi administrator";
                $("#AddPerusahaan").remove();
              } else {
                pesan = "";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    } else {
      $(".error6rk3l").html(err_filerk3l);
      if (err_auth_m_per != "") {
        swal("Error", err_auth_m_per, "error");
      }
    }
  });

  $("#btnUploadFileIUJP").click(function () {
    let no_iujp = $("#noiujp").val();
    let tgl_awal_iujp = $("#tglAktifiujp").val();
    let tgl_akhir_iujp = $("#tglakhiriujp").val();
    let ket_iujp = $("#ketiujp").val();
    let fileiujp = $("#fileiujp").val();
    const fliujp = $("#fileiujp").prop("files")[0];
    let perutama = $("#perUtamaIUJP").val();
    let persub = $("#perSubIUJP").val();
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    let auth_parent = $(".b8f9s7sd7f7asj3h4j3k2j").text();
    let auth_per = $(".8ih3js7h3k8kj42b5n1m5n3").text();
    let auth_iujp = $(".o8s9l3l8n34m7834m22n4w3a").text();

    let urlIUJP = "";

    if (auth_iujp == "") {
      urlIUJP = "Struktur_api/insert_IUJP";
    } else {
      urlIUJP = "Struktur_api/update_IUJP";
    }

    if (no_iujp == "") {
      err_no_iujp = "No. IUJP wajib diisi";
    } else {
      err_no_iujp = "";
    }

    if (tgl_awal_iujp == "") {
      err_tgl_awal_iujp = "Tanggal aktif IUJP wajib diisi";
    } else {
      err_tgl_awal_iujp = "";
    }

    if (tgl_akhir_iujp == "") {
      err_tgl_akhir_iujp = "Tanggal akhir IUJP wajib diisi";
    } else {
      err_tgl_akhir_iujp = "";
    }

    if (fileiujp == "") {
      err_fileiujp = "File IUJP wajib diupload";
    } else {
      err_fileiujp = "";
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
      if (
        err_no_iujp == "" &&
        err_tgl_awal_iujp == "" &&
        err_tgl_akhir_iujp == "" &&
        err_fileiujp == ""
      ) {
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
            formData.append("auth_parent", auth_parent);
            formData.append("auth_per", auth_per);
            formData.append("auth_iujp", auth_iujp);
            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + urlIUJP,
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#imgIUJP").removeClass("d-none");
                  $("#colIUJP").collapse("hide");
                  $("#colSIO").collapse("hide");
                  $("#colKontrak").collapse("hide");
                  $("#colPJO").collapse("hide");
                  $("#perUtamaSIO").val(perutama);
                  $("#perSubSIO").val(persub);
                  $(".o8s9l3l8n34m7834m22n4w3a").text(data.auth_izin);
                  $("#addBukaFileIUJP").attr("href", data.link);
                  $("#addBukaFileIUJP").removeClass("disabled");
                  $("#addResetFileIUJP").removeAttr("disabled");
                  $(".error2iujp").html("");
                  $(".error3iujp").html("");
                  $(".error4iujp").html("");
                  $(".error6iujp").html("");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  swal("Error", data.pesan, "error");
                  $.LoadingOverlay("hide");
                } else {
                  $(".error2iujp").html(data.no_iujp);
                  $(".error3iujp").html(data.tgl_awal_iujp);
                  $(".error4iujp").html(data.tgl_akhir_iujp);
                  $(".error6iujp").html(data.fileiujp);
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
        $(".error2iujp").html(err_no_iujp);
        $(".error3iujp").html(err_tgl_awal_iujp);
        $(".error4iujp").html(err_tgl_akhir_iujp);
        $(".error6iujp").html(err_fileiujp);
        $.LoadingOverlay("hide");
      }
    }
  });

  $("#addResetFileIUJP").click(function () {
    let auth_izin = $(".o8s9l3l8n34m7834m22n4w3a").text();
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();

    if (auth_izin !== "") {
      swal({
        title: "Hapus Data IUJP/Perizinan",
        text: "Yakin data IUJP/Perizinan akan dihapus, data tidak dapat dikembalikan lagi?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          let formData = new FormData();
          formData.append("auth_izin", auth_izin);
          formData.append("auth_m_per", auth_m_per);
          $.ajax({
            type: "POST",
            url: site_url + "Struktur_api/reset_IUJP",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#noiujp").val("");
                $("#tglAktifiujp").val("");
                $("#tglakhiriujp").val("");
                $("#ketiujp").val("");
                $("#fileiujp").val("");
                $("#imgIUJP").addClass("d-none");
                $(".o8s9l3l8n34m7834m22n4w3a").text("");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                swal("Berhasil", "IUJP/Perizinan berhasil dihapus", "success");
                $("#addBukaFileIUJP").addClass("disabled");
                $("#addBukaFileIUJP").attr("href", "");
                $("#addResetFileIUJP").attr("disabled", true);
                $("#btnUploadFileIUJP").removeAttr("disabled");
                $(".error6rk3l").text("");
                $.LoadingOverlay("hide");
              } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              if (thrownError != "") {
                pesan =
                  "Terjadi kesalahan saat reset data RK3L, hubungi administrator";
                $("#AddPerusahaan").remove();
              } else {
                pesan = "";
              }

              swal("Error", pesan, "error");
            },
          });
        }
      });
    } else {
      $(".error6rk3l").html(err_filerk3l);
      if (err_auth_m_per != "") {
        swal("Error", err_auth_m_per, "error");
      }
    }
  });

  $("#btnUploadFileSIO").click(function () {
    let no_sio = $("#noSIO").val();
    let tgl_awal_sio = $("#tglaktifSIO").val();
    let tgl_akhir_sio = $("#tglakhirSIO").val();
    let ket_sio = $("#ketSIO").val();
    let filesio = $("#fileSIO").val();
    const flsio = $("#fileSIO").prop("files")[0];
    let perutama = $("#perUtamaIUJP").val();
    let persub = $("#perSubIUJP").val();
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    let auth_parent = $(".b8f9s7sd7f7asj3h4j3k2j").text();
    let auth_per = $(".8ih3js7h3k8kj42b5n1m5n3").text();
    let auth_sio = $(".2l7k6h9m1v9j3b8k3h8d5d0").text();

    let urlSIO = "";

    if (auth_sio == "") {
      urlSIO = "Struktur_api/insert_SIO";
    } else {
      urlSIO = "Struktur_api/update_SIO";
    }

    if (no_sio == "") {
      err_no_sio = "No. SIO wajib diisi";
    } else {
      err_no_sio = "";
    }

    if (tgl_awal_sio == "") {
      err_tgl_awal_sio = "Tanggal aktif SIO wajib diisi";
    } else {
      err_tgl_awal_sio = "";
    }

    if (tgl_akhir_sio == "") {
      err_tgl_akhir_sio = "Tanggal akhir SIO wajib diisi";
    } else {
      err_tgl_akhir_sio = "";
    }

    if (filesio == "") {
      err_filesio = "File SIO wajib diupload";
    } else {
      err_filesio = "";
    }

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
      if (
        err_no_sio == "" &&
        err_tgl_awal_sio == "" &&
        err_tgl_akhir_sio == "" &&
        err_filesio == ""
      ) {
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
            formData.append("auth_parent", auth_parent);
            formData.append("auth_per", auth_per);
            formData.append("auth_sio", auth_sio);

            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + urlSIO,
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#imgSIO").removeClass("d-none");
                  $("#colSIO").collapse("hide");
                  $("#colKontrak").collapse("hide");
                  $("#colIUJP").collapse("hide");
                  $("#colPJO").collapse("hide");
                  $("#perUtamaKontrak").val(perutama);
                  $("#perSubKontrak").val(persub);
                  $(".2l7k6h9m1v9j3b8k3h8d5d0").text(data.auth_sio);
                  $("#addBukaFileSIO").attr("href", data.link);
                  $("#addBukaFileSIO").removeAttr("disabled");
                  $("#addResetFileSIO").removeAttr("disabled");
                  $(".error2SIO").html("");
                  $(".error3SIO").html("");
                  $(".error4SIO").html("");
                  $(".error6fileSIO").html("");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else {
                  $(".error2SIO").html(data.no_sio);
                  $(".error3SIO").html(data.tgl_awal_sio);
                  $(".error4SIO").html(data.tgl_akhir_sio);
                  $(".error6fileSIO").html(data.filesio);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat menyimpan data SIO, hubungi administrator";
                  $("#AddPerusahaan").remove();
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        $(".error2SIO").html(err_no_sio);
        $(".error3SIO").html(err_tgl_awal_sio);
        $(".error4SIO").html(err_tgl_akhir_sio);
        $(".error6fileSIO").html(err_filesio);
      }
    }
  });

  $("#btnUploadFileKontrak").click(function () {
    let no_kontrak = $("#nokontrak").val();
    let tgl_awal_kontrak = $("#tglaktifkontrak").val();
    let tgl_akhir_kontrak = $("#tglakhirkontrak").val();
    let ket_kontrak = $("#ketkontrak").val();
    let filekontrak = $("#fileKontrak").val();
    const flkontrak = $("#fileKontrak").prop("files")[0];
    let perutama = $("#perUtamaKontrak").val();
    let persub = $("#perSubKontrak").val();
    let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
    let auth_parent = $(".b8f9s7sd7f7asj3h4j3k2j").text();
    let auth_per = $(".8ih3js7h3k8kj42b5n1m5n3").text();
    let auth_kontrak = $(".8jl23m67jsd9lasd0m2n34bn344").text();

    let urlKontrak = "";

    if (auth_kontrak == "") {
      urlKontrak = "Struktur_api/insert_kontrak";
    } else {
      urlKontrak = "Struktur_api/update_kontrak";
    }

    if (no_kontrak == "") {
      err_no_kontrak = "No. kontrak wajib diisi";
    } else {
      err_no_kontrak = "";
    }

    if (tgl_awal_kontrak == "") {
      err_tgl_awal_kontrak = "Tanggal aktif kontrak wajib diisi";
    } else {
      err_tgl_awal_kontrak = "";
    }

    if (tgl_akhir_kontrak == "") {
      err_tgl_akhir_kontrak = "Tanggal akhir kontrak wajib diisi";
    } else {
      err_tgl_akhir_kontrak = "";
    }

    if (filekontrak == "") {
      err_filekontrak = "File kontrak wajib diupload";
    } else {
      err_filekontrak = "";
    }

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
      if (
        err_no_kontrak == "" &&
        err_tgl_awal_kontrak == "" &&
        err_tgl_akhir_kontrak == "" &&
        err_filekontrak == ""
      ) {
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
            formData.append("auth_parent", auth_parent);
            formData.append("auth_per", auth_per);
            formData.append("auth_kontrak", auth_kontrak);

            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + urlKontrak,
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#imgKontrak").removeClass("d-none");
                  $("#colKontrak").collapse("hide");
                  $("#colPJO").collapse("hide");
                  $("#colSIO").collapse("hide");
                  $("#colIUJP").collapse("hide");
                  $("#perUtamaPJO").val(perutama);
                  $("#perSubPJO").val(persub);
                  $(".8jl23m67jsd9lasd0m2n34bn344").text(data.auth_kontrak);
                  $("#addBukaFileKontrak").attr("href", data.link);
                  $("#addBukaFileKontrak").removeAttr("disabled");
                  $("#addResetFileKontrak").removeAttr("disabled");
                  $(".error3kontrak").html("");
                  $(".error4kontrak").html("");
                  $(".error5kontrak").html("");
                  $(".error7kontrak").html("");
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                  $.LoadingOverlay("hide");
                } else {
                  $(".error3kontrak").html(data.no_kontrak);
                  $(".error4kontrak").html(data.tgl_awal_kontrak);
                  $(".error5kontrak").html(data.tgl_akhir_kontrak);
                  $(".error7kontrak").html(data.filekontrak);
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
      } else {
        $(".error3kontrak").html(err_no_kontrak);
        $(".error4kontrak").html(err_tgl_awal_kontrak);
        $(".error5kontrak").html(err_tgl_akhir_kontrak);
        $(".error7kontrak").html(err_filekontrak);
      }
    }
  });

  $("#addSimpanPJO").click(function () {
    let no_pjo = htmlspecialchars($("#nopjo").val());
    let id_lokker = htmlspecialchars($("#lokkerpjo").val());
    let tgl_awal_pjo = $("#tglaktifpjo").val();
    let tgl_akhir_pjo = $("#tglakhirpjo").val();
    let ket_pjo = htmlspecialchars($("#ketpjo").val());
    let ktp_pjo = htmlspecialchars($("#ktppjo").val());
    let jml_ktp_pjo = $("#ktppjo").val().length;
    let nik_pjo = htmlspecialchars($("#nikpjo").val());
    let nama_pjo = htmlspecialchars($("#namapjo").val());
    let auth_kary = $(".8c9l1k4n9d09vm3mn43k8s834kk45").text();
    let filepjo = $("#filePJO").val();
    const flpjo = $("#filePJO").prop("files")[0];
    let perutama = $("#perUtamaPJO").val();
    let persub = $("#perSubPJO").val();
    let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
    let auth_parent = htmlspecialchars($(".b8f9s7sd7f7asj3h4j3k2j").text());
    let auth_per = htmlspecialchars($(".8ih3js7h3k8kj42b5n1m5n3").text());
    var token = $("#token").val();

    let fileExtensionPJO = filepjo.split(".").pop().toLowerCase();
    let sizeFilePJO = flpjo["size"];

    if (no_pjo == "") {
      err_no_pjo = "No. PJO wajib diisi";
    } else {
      err_no_pjo = "";
    }

    if (id_lokker == "") {
      err_id_lokker = "Lokasi kerja wajib dipilih";
    } else {
      err_id_lokker = "";
    }

    if (tgl_awal_pjo == "") {
      err_tgl_awal_pjo = "Tanggal aktif PJO wajib diisi";
    } else {
      err_tgl_awal_pjo = "";
    }

    if (tgl_akhir_pjo == "") {
      err_tgl_akhir_pjo = "Tanggal akhir PJO wajib diisi";
    } else {
      err_tgl_akhir_pjo = "";
    }

    if (filepjo == "") {
      err_filepjo = "File PJO wajib diupload";
    } else {
      err_filepjo = "";
    }

    if (ktp_pjo == "") {
      err_ktp_pjo = "KTP PJO wajib diisi";
    } else {
      if (jml_ktp_pjo < 16 || jml_ktp_pjo > 16) {
        err_ktp_pjo = "No. KTP harus 16 karakter";
      } else {
        err_ktp_pjo = "";
      }
    }

    if (nik_pjo == "") {
      err_nik_pjo = "NIK PJO wajib diisi";
    } else {
      err_nik_pjo = "";
    }

    if (nama_pjo == "") {
      err_nama_pjo = "Nama PJO wajib diisi";
    } else {
      err_nama_pjo = "";
    }

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
      if (
        err_no_pjo == "" &&
        err_tgl_awal_pjo == "" &&
        err_tgl_akhir_pjo == "" &&
        err_filepjo == "" &&
        err_id_lokker == "" &&
        err_ktp_pjo == "" &&
        err_nik_pjo == "" &&
        err_nama_pjo == ""
      ) {
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
            formData.append("auth_parent", auth_parent);
            formData.append("auth_per", auth_per);
            formData.append("ktp_pjo", ktp_pjo);
            formData.append("nik_pjo", nik_pjo);
            formData.append("nama_pjo", nama_pjo);
            formData.append("auth_kary", auth_kary);
            formData.append("token", token);

            $.ajax({
              type: "POST",
              url: site_url + "Struktur_api/insert_PJO",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#nopjo").val("");
                  $("#tglaktifpjo").val("");
                  $("#tglakhirpjo").val("");
                  $("#lokkerpjo").val("").trigger("change");
                  $("#ktppjo").val("");
                  $("#nikpjo").val("");
                  $("#namapjo").val("");
                  $("#ketpjo").val("");
                  $("#filePJO").val("");
                  $(".error2pjo").html("");
                  $(".error3pjo").html("");
                  $(".error4pjo").html("");
                  $(".error5pjo").html("");
                  $(".error6pjo").html("");
                  $(".error7pjo").html("");
                  $(".error8pjo").html("");
                  $(".error10pjo").html("");
                  $("#imgPJO").removeClass("d-none");
                  $(".8jl23m67jsd9lasd0m2n34bn344").text(data.auth_pjo);
                  $("#idpjo").LoadingOverlay("show");
                  $("#idpjo").load(
                    site_url + "Struktur_api/pjo?auth_m_per=" + auth_m_per
                  );
                  $("#idpjo").LoadingOverlay("hide");
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  swal("Error", data.pesan, "error");
                  $.LoadingOverlay("hide");
                } else {
                  $(".error2pjo").html(data.no_pjo);
                  $(".error3pjo").html(data.id_lokker);
                  $(".error4pjo").html(data.tgl_awal_pjo);
                  $(".error5pjo").html(data.tgl_akhir_pjo);
                  $(".error6pjo").html(data.ktp_pjo);
                  $(".error7pjo").html(data.nik_pjo);
                  $(".error8pjo").html(data.nama_pjo);
                  $(".error10pjo").html(data.filepjo);
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (thrownError != "") {
                  pesan =
                    "Terjadi kesalahan saat menyimpan data PJO, hubungi administrator";
                  $("#AddPerusahaan").remove();
                } else {
                  pesan = "";
                }

                swal("Error", pesan, "error");
              },
            });
          }
        });
      } else {
        $(".error2pjo").html(err_no_pjo);
        $(".error3pjo").html(err_id_lokker);
        $(".error4pjo").html(err_tgl_awal_pjo);
        $(".error5pjo").html(err_tgl_akhir_pjo);
        $(".error6pjo").html(err_ktp_pjo);
        $(".error7pjo").html(err_nik_pjo);
        $(".error8pjo").html(err_nama_pjo);
        $(".error10pjo").html(err_filepjo);
      }
    }
  });

  $("#ktppjo").keyup(function (e) {
    let noktp = $("#ktppjo").val().trim();
    let jmlhrf = $("#ktppjo").val().length;

    if (noktp != "") {
      if (jmlhrf > 16) {
        $(".error6pjo").html("<p>No. KTP maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".error6pjo").html("<p>No. KTP minimal 16 karakter</p>");
      } else {
        $(".error6pjo").html("");
      }
    }
  });

  // $("#refreshPjo").click(function () {
  //   let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();

  //   $.LoadingOverlay("show");
  //   $("#nopjo").val("");
  //   $("#tglaktifpjo").val("");
  //   $("#lokkerpjo").val("").trigger("change");
  //   $("#tglakhirpjo").val("");
  //   $("#lokkerpjo").val("");
  //   $("#ktppjo").val("");
  //   $("#nikpjo").val("");
  //   $("#namapjo").val("");
  //   $("#ketpjo").val("");
  //   $("#filePJO").val("");
  //   $(".error2pjo").html("");
  //   $(".error3pjo").html("");
  //   $(".error4pjo").html("");
  //   $(".error5pjo").html("");
  //   $(".error6pjo").html("");
  //   $(".error7pjo").html("");
  //   $(".error8pjo").html("");
  //   $(".error10pjo").html("");
  //   $(".8jl23m67jsd9lasd0m2n34bn344").text("");
  //   $("#idpjo").LoadingOverlay("show");
  //   $("#idpjo").load(
  //     site_url +
  //       "Struktur_api/pjo?auth_m_per=" +
  //       auth_m_per +
  //       "&authtoken=" +
  //       $("#token").val()
  //   );
  //   $("#idpjo").LoadingOverlay("hide");
  //   $.LoadingOverlay("hide");
  // });
});
