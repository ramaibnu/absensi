$(document).ready(function () {
    // Select Searchable
    $('#perDepart').select2({
        theme: 'bootstrap4'
    });

    // Click
    $("#btnBatalDepart").click(function () {
        $("#perDepart").val('').trigger('change');
        $("#kodeDepart").val('');
        $("#Depart").val('');
        $("#ketDepart").val('');
    });

    // Submit Data
    $("#tambahDepartemen").submit(function () {
        var prs = $("#perDepart").val();
        var kode = $("#kodeDepart").val();
        var depart = $("#Depart").val();
        var ket = $("#ketDepart").val();

        $.ajax({
            type: "POST",
            url: site_url + "Departemen_api/insert",
            data: {
                prs: prs,
                kode: kode.toUpperCase(),
                depart: depart.toUpperCase(),
                ket: ket,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#kodeDepart").val('');
                    $("#Depart").val('');
                    $("#ketDepart").val('');
                } else if (data.statusCode == 201) {
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
                    pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });
})