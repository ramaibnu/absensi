$(document).ready(function () {
    // Select Searchable
    $('#perLevel').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#perLevel').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Click
    $("#btnBatalLevel").click(function () {
        $("#perLevel").val('').trigger('change');
        $("#kodeLevel").val('');
        $("#Level").val('');
        $("#ketLevel").val('');
    });

    // Submit
    $("#tambahLevel").submit(function () {
        var prs = $("#perLevel").val();
        var kode = $("#kodeLevel").val();
        var level = $("#Level").val();
        var ket = $("#ketLevel").val();

        $.ajax({
            type: "POST",
            url: site_url + "Level_api/insert",
            data: {
                prs: prs,
                kode: kode.toUpperCase(),
                level: level.toUpperCase(),
                ket: ket,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#kodeLevel").val('');
                    $("#Level").val('');
                    $("#ketLevel").val('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Level gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Level gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                }
                swal("Error", pesan, 'error');
            }
        })
    });
}); 