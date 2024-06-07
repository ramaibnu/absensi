$(document).ready(function () {
    // Input Mask
    $('#durasi').inputmask("99999", { "placeholder": "" });

    // Submit
    $("#tambahData").submit(function () {
        let kode = $("#kode").val();
        let sanksi = $("#sanksi").val();
        let durasi = $("#durasi").val();
        let keterangan = $("#keterangan").val();
        
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Sanksi_api/insert",
            data: {
                kode: kode.toUpperCase(),
                sanksi: sanksi.toUpperCase(),
                durasi: durasi,
                keterangan: keterangan,
            },
            timeout: 20000,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                    $("#tambahData").trigger("reset");
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan)
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
                $.LoadingOverlay("hide");
            },
            error: function () {
                $.LoadingOverlay("hide");
                swal("Error", "Terjadi kesalahan saat membuat data sanksi!, hubungi administrator", 'error');
            }
        });
    });
});