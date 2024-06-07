$(document).ready(function () {
    // Select Searchable
    $('#status_waktu').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#status_waktu').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Submit
    $("#tambahData").submit(function () {
        let status_perjanjian = $("#status_perjanjian").val();
        let status_waktu = $("#status_waktu").val();
        let keterangan = $("#keterangan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "StatusPerjanjian_api/insert",
            data: {
                status_perjanjian: status_perjanjian.toUpperCase(),
                status_waktu: status_waktu,
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
                swal("Error", "Terjadi kesalahan saat membuat data status perjanjian, hubungi administrator", 'error');
            }
        });
    });
});