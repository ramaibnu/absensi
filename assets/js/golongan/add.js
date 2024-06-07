$(document).ready(function () {
    // Click
    $("#btnBatalTipe").click(function () {
        $("#Tipe").val('');
        $("#ketTipe").val('');
    });

    // Submit
    $("#tambahGolongan").submit(function () {
        var tipe = $("#Tipe").val();
        var ket = $("#ketTipe").val();

        $.ajax({
            type: "POST",
            url: site_url + "Golongan_api/insert",
            data: {
                tipe: tipe.toUpperCase(),
                ket: ket,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#Tipe").val('');
                    $("#ketTipe").val('');
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Golongan gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });
});