$(document).ready(function () {
    // Select Searchable
    $('#perPosisi').select2({
        theme: 'bootstrap4'
    });
    $('#depPosisi').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#perPosisi').select2({
            theme: 'bootstrap4'
        });
        $('#depPosisi').select2({
            theme: 'bootstrap4'
        });
    }, true);

    // Click
    $("#btnBatalPosisi").click(function () {
        $("#perPosisi").val('').trigger('change');
        $("#depPosisi").val('').trigger('change');
        $("#kodSPosisi").val('');
        $("#Posisi").val('');
        $("#ketPosisi").val('');
        $(".error1").html('');
        $(".error2").html('');
        $(".error3").html('');
        $(".error4").html('');
        $(".error5").html('');
    });

    // Change
    $('#perPosisi').change(function () {
        let auth_per = $("#perPosisi").val();

        $.ajax({
            type: "POST",
            url: site_url + "Departemen_api/options_struktur",
            data: {
                auth_per: auth_per
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $('#depPosisi').removeAttr('disabled');
                    $("#depPosisi").html(data.dprt);
                } else {
                    $("#depPosisi").html('<option value="">-- DEPARTEMEN TIDAK DITEMUKAN --</option>');
                    $("#depPosisi").attr('disabled', true);
                }
            }
        })
    });

    // Submit
    $("#tambahPosisi").submit(function () {
        var prs = $("#perPosisi").val();
        var depart = $("#depPosisi").val();
        var posisi = $("#Posisi").val();
        var ket = $("#ketPosisi").val();

        $.ajax({
            type: "POST",
            url: site_url + "Posisi_api/insert",
            data: {
                prs: prs,
                posisi: posisi.toUpperCase(),
                depart: depart,
                ket: ket
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#Posisi").val('');
                    $("#ketPosisi").val('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                }
                swal("Error", pesan, 'error');
            }
        });
    });
});