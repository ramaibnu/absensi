$(document).ready(function () {
  // Select Searchable
  $("#lstperusahaandatabaru").select2({
    "theme": "bootstrap4",
    "width": "100%",
})
$("#lstuserdataterbaru").select2({
    "theme": "bootstrap4",
    "width": "100%",
})
$("#lstprsuserdataterbaru").select2({
    "theme": "bootstrap4",
    "width": "100%",
})

// SSP Datatables
  function tbDataBaru() {
    $("#tbmdataterbaru").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[1, "desc"]],
      ajax: {
        url: site_url + "Dashboard_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            $(".err_psn_databaru").removeClass("d-none");
            $(".err_psn_databaru").css("display", "block");
            $(".err_psn_databaru").html(
              "terjadi kesalahan saat melakukan load data data karyawan terbaru, hubungi administrator"
            );
            $(".err_psn_databaru ")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".err_psn_databaru ").slideUp(500);
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
          name: "id_kary",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "no_ktp",
          className: "align-middle",
          width: "10%",
        },
        {
          data: "no_nik",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "nama_lengkap",
          className: "text-nowrap align-middle",
          width: "35%",
        },
        {
          data: "depart",
          className: "text-nowrap align-middle",
          width: "35%",
        },
        {
          data: "kode_perusahaan",
          className: "text-nowrap align-middle",
          width: "9%",
        },
        {
          data: "nama_user",
          className: "text-nowrap align-middle",
          width: "9%",
        },
        {
          data: "tgl_buat",
          className: "text-center text-nowrap align-middle",
          width: "10%",
        },
      ],
    });
  }

  function tbUserBaru() {
    $("#tbmterbaruuser").DataTable();
  }

  function tbPrsBaru() {
    $("#tbmterbaruprs").DataTable();
  }

  tbDataBaru();
  tbUserBaru();
  tbPrsBaru();s
});
