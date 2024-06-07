$(document).ready(function () {
    // Select Searchable
    $('#jenisLokasi').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#jenisLokasi').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Submit
    $("#tambahData").submit(function () {
        let kode = $("#kode").val();
        let lokasiPenerimaan = $("#lokasiPenerimaan").val();
        let jenisLokasi = $("#jenisLokasi").val();
        let keterangan = $("#keterangan").val();
        
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "LokasiPenerimaan_api/insert",
            data: {
                kode: kode.toUpperCase(),
                lokasiPenerimaan: lokasiPenerimaan.toUpperCase(),
                jenisLokasi: jenisLokasi,
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
                swal("Error", "Terjadi kesalahan saat membuat data lokasi penerimaan!, hubungi administrator", 'error');
            }
        });
    });
});