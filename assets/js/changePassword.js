$(document).ready(function () {
  $("#updatePassword").submit(function () {
    $.LoadingOverlay("show");
    let oldPassword = $("#lamaSandi").val();
    let newPassword = $("#baruSandi").val();

    $.ajax({
      type: "POST",
      url: site_url + "ChangePassword_api/process",
      data: {
        oldPassword: oldPassword,
        newPassword: newPassword,
      },
      timeout: 20000,
      success: function (response) {
        var data = JSON.parse(response);
        $.LoadingOverlay("hide");
        if (data.statusCode == 200) {
          $("#lamaSandi").val('');
          $("#baruSandi").val('');
          $("#ulangSandi").val('');
        }
        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
      },
      error: function (xhr) {
        $.LoadingOverlay("hide");
        swal(
          "Error",
          "Terjadi kesalahan saat ganti kata sandi, hubungi administrator",
          "error"
        );
      },
    });
  });
});
