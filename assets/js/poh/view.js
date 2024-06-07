$(document).ready(function () {
  // SSP Datatables
  function tbPOH() {
    tbmPoh = $("#tbmPoh").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[2, "asc"]],
      ajax: {
        url: site_url + "Poh_api/datatables",
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            pesan =
              "terjadi kesalahan saat melakukan load data Poh, hubungi administrator";
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
          name: "id_poh",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "kd_poh",
          className: "text-nowrap align-middle",
          width: "10%",
        },
        {
          data: "poh",
          className: "text-nowrap align-middle",
          width: "50%",
        },
        {
          data: "stat_poh",
          className: "text-center align-middle",
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
  }
  tbPOH();

// Function
function reseteditpoh() {
    $("#editPohKode").val('');
    $("#editPoh").val('');
    $("#editPohKet").val('');
    $("#editPohStatus").val('');
}

// Click
$('#tbmPoh').on('click', '.hpspoh', function () {
    let auth_poh = $(this).attr('id');
    let namaPoh = $(this).attr('value');

    if (auth_poh == "") {
        $(".err_psn_poh").removeClass("alert-primary");
        $(".err_psn_poh").addClass("alert-danger");
        $(".err_psn_poh").removeClass('d-none');
        $(".err_psn_poh").html("Point of hire tidak ditemukan");
    } else {
        swal({
            title: "Hapus",
            text: "Yakin " + namaPoh + " akan dihapus?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#36c6d3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batalkan'
        }).then(function (result) {
            if (result.value) {
                $.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: site_url + "Poh_api/delete",
                    data: {
                        auth_poh: auth_poh,
                    },
                    timeout: 20000,
                    success: function (data, textStatus, xhr) {
                        $.LoadingOverlay("hide");
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            tbmPoh.draw();
                            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                        } else {
                            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (xhr.status == 404) {
                            pesan = "Point of hire gagal diupdate, Link data tidak ditemukan";
                        } else if (xhr.status == 0) {
                            pesan = "Point of hire gagal diupdate, Waktu koneksi habis";
                        } else {
                            pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                        }

                        swal("Error", pesan, 'error');
                    }
                });
            }
        });
    }
});

$('#tbmPoh').on('click', '.dtlpoh', function () {
    let auth_poh = $(this).attr('id');

    if (auth_poh == "") {
        $(".err_psn_poh").removeClass("alert-primary");
        $(".err_psn_poh").addClass("alert-danger");
        $(".err_psn_poh").removeClass('d-none');
        $(".err_psn_poh").html("Point of hire tidak ditemukan");
    } else {
        $.ajax({
            type: "post",
            url: site_url + "Poh_api/read_specific_data",
            data: {
                auth_poh: auth_poh,
            },
            timeout: 15000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $("#detailPohKode").val(data.kode);
                    $("#detailPoh").val(data.poh);
                    $("#detailPohStatus").val(data.status);
                    $("#detailPohKet").val(data.ket);
                    $("#detailPohBuat").val(data.pembuat);
                    $("#detailPohTglBuat").val(data.tgl_buat);
                    $("#detailPohmdl").modal("show");
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Point of hire gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Point of hire gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }
});

$('#tbmPoh').on('click', '.edttpoh', function () {
    let auth_poh = $(this).attr('id');

    if (auth_poh == "") {
        $(".err_psn_poh").removeClass("alert-primary");
        $(".err_psn_poh").addClass("alert-danger");
        $(".err_psn_poh").removeClass('d-none');
        $(".err_psn_poh").html("Point of hire tidak ditemukan");
    } else {
        $.ajax({
            type: "post",
            url: site_url + "Poh_api/read_specific_data",
            data: {
                auth_poh: auth_poh,
            },
            timeout: 15000,
            success: function (data) {
                var dataPoh = JSON.parse(data);
                if (dataPoh.statusCode == 200) {
                    $("#editPohKode").val(dataPoh.kode);
                    $("#editPoh").val(dataPoh.poh);
                    $("#editPohStatus").val(dataPoh.status);
                    $("#editPohKet").val(dataPoh.ket);
                    $("#editPohmdl").modal("show");
                } else {
                    swal(dataPoh.kode_pesan, dataPoh.pesan, dataPoh.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Point of hire gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Point of hire gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }
});

// Submit
$('#updatePoh').submit(function () {
    let kode = $('#editPohKode').val();
    let poh = $('#editPoh').val();
    let status = $('#editPohStatus').val();
    let ket = $('#editPohKet').val();

    $.ajax({
        type: "POST",
        url: site_url + "Poh_api/update",
        data: {
            kode: kode,
            poh: poh,
            status: status,
            ket: ket
        },
        success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
                tbmPoh.draw();
                $("#editPohmdl").modal("hide");
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                reseteditpoh();
            } else {
                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");

            if (xhr.status == 404) {
                pesan = "Point of hire gagal diupdate, Link data tidak ditemukan";
            } else if (xhr.status == 0) {
                pesan = "Point of hire gagal diupdate, Waktu koneksi habis";
            } else {
                pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
            }
            swal("Error", pesan, 'error');
            $("#editPohmdl").modal("hide");
        }
    })
});
});
