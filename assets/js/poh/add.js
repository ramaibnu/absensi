$(document).ready(function () {
    // Function
    function resetaddpoh() {
        $("#kodePoh").val('');
        $("#Poh").val('');
        $("#ketPoh").val('');
    }

    // Click
    $("#btnBatalPoh").click(function () {
        resetaddpoh();
    });

    // Submit
    $("#tambahPoh").submit(function () {
        var kode = $("#kodePoh").val();
        var poh = $("#Poh").val();
        var ket = $("#ketPoh").val();

        $.ajax({
            type: "POST",
            url: site_url + "Poh_api/insert",
            data: {
                kode: kode.toUpperCase(),
                poh: poh.toUpperCase(),
                ket: ket,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    resetaddpoh()
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
        })
    });
});