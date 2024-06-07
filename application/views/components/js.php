<script src="<?=base_url();?>assets/assets/js/jquery-3.5.1.js"></script>
<script src="<?=base_url();?>assets/js/popper.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor-all.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/ripple.js"></script>
<script src="<?=base_url();?>assets/assets/js/pcoded.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/tooltips.js"></script>
<script src="<?=base_url();?>assets/assets/js/select2.full.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/md5.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/loadingoverlay.min.js"></script>
<script src="<?=base_url();?>assets/assets/others/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/assets/others/jquery-ui.min.js"></script>
<script src="<?=base_url();?>assets/assets/others/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/assets/others/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>assets/assets/others/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/jquery.inputmask.bundle.js"></script>
<script>
// Notif Maintenance Feature
$(document).on('click', '.onprocess', function() {
    swal("On Process", "Fitur masih dikerjakan", 'info');
});
let site_url = '<?=base_url()?>';
let aksesType = "<?=$this->session->userdata('akses_apps_hcdata')?>";
$("#searchingKaryawan").on("keypress", function(e) {
    let txt = $("#searchingKaryawan").val().replace(/' '/g, "_");
    if (txt !== null && txt.trim() !== "") {
        if (e.which == 13) {
            window.open(site_url + "Search_api/global?value=" + txt, "_blank");
        }
    }
});

// Inputmask
$("#checkingKTP").inputmask("9999999999999999", {
    placeholder: ""
});

$("#checkDataKTP").click(function() {
    $("#verifikasiKTP").modal("show");
    $("#checkingKTP").val("");
});

$("#verifDataKTP").click(function() {
    let noktp = $("#checkingKTP").val();
    let errnoktp = $(".errornoKTPCek").text();

    if (noktp != "") {
        if (errnoktp == "") {
            swal({
                title: "Verifikasi No. KTP",
                text: "Yakin No. KTP : " + noktp + " sudah benar?",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#36c6d3",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, benar",
                cancelButtonText: "Batalkan",
            }).then(function(result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url + "Karyawan_api/checkKTP",
                        data: {
                            noktp: noktp,
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                swal("Berhasil", "Data KTP belum pernah digunakan!",
                                    "success");
                            } else if (data.statusCode == 201) {
                                $("#dataPesan").text(data.pesan);
                                $("#dataKTP").text(data.no_ktp);
                                $("#dataNama").text(data.nama_lengkap);

                                if (data.tgl_nonaktif == '01-Jan-1970') {
                                    $(".tglnonaktifSidebar").addClass("d-none");
                                    $(".lamanonaktifSidebar").addClass("d-none");
                                    $(".pelanggaranSidebar").addClass("d-none");
                                } else {
                                    $(".tglnonaktifSidebar").removeClass("d-none");
                                    $(".lamanonaktifSidebar").removeClass("d-none");
                                    $(".pelanggaranSidebar").removeClass("d-none");
                                    $("#dataTanggalNonAktif").text(data.tgl_nonaktif);
                                    $("#dataLamaNonaktif").text(data.lama_nonaktif);
                                }

                                $("#dataPerusahaan").text(data.perusahaan);

                                if (data.status == "AKTIF") {
                                    $("#dataStatus").removeClass("text-danger");
                                    $("#dataStatus").addClass("text-success");
                                } else {
                                    $("#dataStatus").removeClass("text-success");
                                    $("#dataStatus").addClass("text-danger");
                                }

                                $("#dataStatus").text(data.status);
                                $.LoadingOverlay("hide");
                                $("#detailVerificationKTP").modal("show");
                            } else {
                                $.LoadingOverlay("hide");
                                swal("Berhasil", "Data KTP belum pernah digunakan!",
                                    "success");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errormsg").removeClass("d-none");
                            $(".errormsg").removeClass("alert-info");
                            $(".errormsg").addClass("alert-danger");
                            if (thrownError != "") {
                                $(".errormsg").html(
                                    "Terjadi kesalahan saat verifikasi KTP, hubungi administrator"
                                );
                            }
                        },
                    });
                } else {
                    swal.close();
                }
            });
        } else {
            swal("Error", errnoktp, "error");
        }
    } else {
        swal("Error", "No. KTP tidak boleh kosong", "error");
    }
});

$("#checkingKTP").keyup(function(e) {
    let dataKTP = $("#checkingKTP").val().trim();

    if (dataKTP != "") {
        jmlktp = dataKTP.replace(/['.'|_|-]/g, "");
        jmlhrf = jmlktp.length;

        if (jmlhrf > 16) {
            $(".errornoKTPCek").html("<p>No. KTP maksimal 16 karakter</p>");
            $("#verifDataKTP").attr("disabled", true);
        } else if (jmlhrf < 16) {
            $(".errornoKTPCek").html("<p>No. KTP minimal 16 karakter</p>");
            $("#verifDataKTP").attr("disabled", true);
        } else {
            $(".errornoKTPCek").html("");
            $("#verifDataKTP").removeAttr("disabled");
        }
    } else {
        $(".errornoKTPCek").html("<p>No. KTP tidak boleh kosong</p>");
        $("#verifDataKTP").attr("disabled", true);
    }
});

// AjaxStop
$(document).ajaxStop(function() {
    $.LoadingOverlay("hide");
});
</script>