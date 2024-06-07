$(document).ready(function () {
  $.LoadingOverlay("show");
  // Ajax
  $.ajax({
    type: "POST",
    url: site_url + "Struktur_api/get_auth",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.statusCode == 200) {
        $("#perLanggarData").val(data.auth).trigger("change");
      } else {
        $("#perLanggarData").val("").trigger("change");
      }
    },
    error: function (thrownError) {
      if (thrownError != "") {
        pesan =
          "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
      }

      swal("Error", pesan, "error");
    },
  });

  // SSP Datatables
  function tbLgr(m_per) {
    tbmLanggar = $("#tbmLanggar").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "desc"]],
      ajax: {
        url: site_url + "Pelanggaran_api/datatables",
        data: {
          auth_per: m_per,
        },
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            $(".err_psn_Langgar").removeClass("d-none");
            $(".err_psn_Langgar").css("display", "block");
            $(".err_psn_Langgar").html(
              "terjadi kesalahan saat melakukan load data pelanggaran, hubungi administrator"
            );
            $("#addbtn").addClass("disabled");
            $(".err_psn_Langgar ")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".err_psn_Langgar ").slideUp(500);
              });
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
          name: "id_langgar",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center  align-middle",
          width: "1%",
        },
        {
          data: "no_nik",
          className: "align-middle",
          width: "10%",
        },
        {
          data: "nama_lengkap",
          className: "text-nowrap  align-middle",
          width: "15%",
        },
        {
          data: "depart",
          className: "align-middle",
          width: "15%",
        },
        {
          data: "langgar_jenis",
          className: "text-nowrap  align-middle",
          width: "15%",
        },
        {
          data: "tgl_akhir_langgar",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "stat_langgar",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "kode_perusahaan",
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

    $("#tbmLanggar").LoadingOverlay("hide");
  }
  tbLgr();

  // Select Searchable
  $("#perLanggarData").select2({
    theme: "bootstrap4",
    width: "100%",
  });
  window.addEventListener(
    "resize",
    function (event) {
      $("#perLanggarData").select2({
        theme: "bootstrap4",
        width: "100%",
      });
    },
    true
  );

  // Click Event
  $(document).on("click", ".hapuslanggar", function () {
    var id = $(this).attr("id");
    let prs = $("#perLanggarData").val();

    swal({
      title: "Hapus Data Pelanggaran",
      text: "Yakin data pelanggaran akan dihapus?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus data",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.LoadingOverlay("show");
        $.ajax({
          url: site_url + "Pelanggaran_api/delete",
          data: {
            auth_langgar: id,
          },
          type: "POST",
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $.LoadingOverlay("hide");
              swal({
                title: "Berhasil",
                text: data.pesan,
                type: "success",
                showConfirmButton: false,
                timer: 2000,
              });
              $("#tbmLanggar").LoadingOverlay("show");
              $("#tbmLanggar").DataTable().destroy();
              tbLgr(prs);
            } else {
              $.LoadingOverlay("hide");
              swal({
                title: "Gagal",
                text: data.pesan,
                type: "error",
              });
            }
          },
          error: function () {
            $.LoadingOverlay("hide");
            swal("Error", "Error saat menghapus data pelanggaran", "error");
          },
        });
      }
    });
  });

  $("#btnrefreshLanggar").click(function () {
    $("#tbmLanggar").LoadingOverlay("show");
    tbmLanggar.draw();
    $("#tbmLanggar").LoadingOverlay("hide");
  });

  // Change Event
  $("#perLanggarData").change(function () {
    let prs = $("#perLanggarData").val();

    $("#tbmLanggar").LoadingOverlay("show");
    $("#tbmLanggar").DataTable().destroy();
    tbLgr(prs);
  });
});
