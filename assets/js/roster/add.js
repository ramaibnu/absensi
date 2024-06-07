$(document).ready(function () {
    // Select Searchable
    $('#pilihPerusahaan').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#pilihPerusahaan').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Submit
    $("#tambahData").submit(function () {
        let onsite = $("#onsite").val();
        let offsite = $("#offsite").val();
        let keterangan = $("#keterangan").val();
        let perusahaan = $("#pilihPerusahaan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Roster_api/insert",
            data: {
                onsite: onsite,
                offsite: offsite,
                keterangan: keterangan,
                perusahaan: perusahaan,
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
                swal("Error", "Terjadi kesalahan saat membuat data roster, hubungi administrator", 'error');
            }
        });
    });
});