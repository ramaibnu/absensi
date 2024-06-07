$(document).ready(function () {
    // Select Searchable
    $('#pilihPerusahaan').select2({
        theme: 'bootstrap4'
    });
    $('#departemen').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#pilihPerusahaan').select2({
            theme: 'bootstrap4'
        });
        $('#departemen').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Change
    $('#pilihPerusahaan').change(function () {
        let auth_per = $("#pilihPerusahaan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Departemen_api/options_struktur",
            data: {
                auth_per: auth_per
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $('#departemen').removeAttr('disabled');
                    $("#departemen").html(data.dprt);
                } else {
                    $("#departemen").html('<option value="">-- DEPARTEMEN TIDAK DITEMUKAN --</option>');
                    $("#departemen").attr('disabled', true);
                }
                $.LoadingOverlay("hide");
            }
        })
    });

    // Submit
    $("#tambahData").submit(function () {
        let perusahaan = $("#pilihPerusahaan").val();
        let departemen = $("#departemen").val();
        let kode = $("#kode").val();
        let section = $("#section").val();
        let keterangan = $("#keterangan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Section_api/insert",
            data: {
                perusahaan: perusahaan,
                departemen: departemen,
                kode: kode.toUpperCase(),
                section: section.toUpperCase(),
                keterangan: keterangan,
            },
            timeout: 20000,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.statusCode == 200) {
                    $("#tambahData").trigger("reset");
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $.LoadingOverlay("hide");
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $.LoadingOverlay("hide");
                }
            },
            error: function () {
                $.LoadingOverlay("hide");
                swal("Error", "Terjadi kesalahan saat membuat data section, hubungi administrator", 'error');
            }
        });
    });
});