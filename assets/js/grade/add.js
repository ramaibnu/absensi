$(document).ready(function () {
    // Function
    $("#grade").on("input", function () {
      // Remove non-numeric characters
      $(this).val($(this).val().replace(/\D/g, ""));
    });

    // Select Searchable
    $('#pilihPerusahaan').select2({
        theme: 'bootstrap4'
    });
    $('#level').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#pilihPerusahaan').select2({
            theme: 'bootstrap4'
        });
        $('#level').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Change
    $('#pilihPerusahaan').change(function () {
        let auth_per = $("#pilihPerusahaan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Level_api/options",
            data: {
                auth_per: auth_per
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $('#level').removeAttr('disabled');
                    $("#level").html(data.lvl);
                } else {
                    $("#level").html('<option value="">-- LEVEL TIDAK DITEMUKAN --</option>');
                    $("#level").attr('disabled', true);
                }
                $.LoadingOverlay("hide");
            }
        })
    });

    // Submit
    $("#tambahData").submit(function () {
        let perusahaan = $("#pilihPerusahaan").val();
        let level = $("#level").val();
        let grade = $("#grade").val();
        let keterangan = $("#keterangan").val();

        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: site_url + "Grade_api/insert",
            data: {
                perusahaan: perusahaan,
                level: level,
                grade: grade,
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
                swal("Error", "Terjadi kesalahan saat membuat data grade, hubungi administrator", 'error');
            }
        });
    });
});