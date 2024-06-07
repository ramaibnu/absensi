$(document).ready(function () {
    // Submit
    $("#tambahData").submit(function () {
        let sim = $("#sim").val();
        let keterangan = $("#keterangan").val();
        
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "SIM_api/insert",
            data: {
                sim: sim.toUpperCase(),
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
                swal("Error", "Terjadi kesalahan saat membuat data jenis sim polisi!, hubungi administrator", 'error');
            }
        });
    });
});