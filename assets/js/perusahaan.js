
     //========================================== Perusahaan ========================================================
     $(document).ready(function() {

          $("#txtprovadd").LoadingOverlay("show");
          $("#txtkabadd").LoadingOverlay("show");
          $("#txtkecadd").LoadingOverlay("show");
          $("#txtkeladd").LoadingOverlay("show");

          $("#logout").click(function() {
               $("#logoutmdl").modal("show");
          });

          $(function() {
               $("#provPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kabPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kecPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kelPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanProv").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKab").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKec").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKel").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });

               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_prov?authtoken=" + $("#token").val(),
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#provPerusahaan").html(data.prov);
                         $("#txtprovadd").LoadingOverlay("hide");
                         $("#txtkabadd").LoadingOverlay("hide");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data provinsi, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });

          $("#provPerusahaan").change(function() {
               $("#txtkabadd").LoadingOverlay("show");
               $("#txtkecadd").LoadingOverlay("show");
               $("#txtkeladd").LoadingOverlay("show");

               let id_prov = $("#provPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kab?authtoken="+$("#token").val(),
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kabPerusahaan").html(data.kab);
                         $("#kecPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#txtkabadd").LoadingOverlay("hide");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $("#kabPerusahaan").change(function() {
               $("#txtkecadd").LoadingOverlay("show");
               $("#txtkeladd").LoadingOverlay("show");

               let id_kab = $("#kabPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kec?authtoken="+$("#token").val(),
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kecPerusahaan").html(data.kec);
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $("#kecPerusahaan").change(function() {
               $("#txtkeladd").LoadingOverlay("show");

               let id_kec = $("#kecPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kel?authtoken="+$("#token").val(),
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kelPerusahaan").html(data.kel);
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $("#editPerusahaanProv").change(function() {
               let id_prov = $("#editPerusahaanProv").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kab?authtoken="+$("#token").val(),
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKab").html(data.kab);
                         $("#editPerusahaanKec").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                         $("#editPerusahaanKel").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });

          $("#editPerusahaanKab").change(function() {
               let id_kab = $("#editPerusahaanKab").val();

               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kec?authtoken="+$("#token").val(),
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKec").html(data.kec);
                         $("#editPerusahaanKel").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $("#editPerusahaanKec").change(function() {
               let id_kec = $("#editPerusahaanKec").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kel?authtoken="+$("#token").val(),
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKel").html(data.kel);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });

          $(".refprov").click(function() {
               $("#txtprovadd").LoadingOverlay("show");
               $("#txtkabadd").LoadingOverlay("show");
               $("#txtkecadd").LoadingOverlay("show");
               $("#txtkeladd").LoadingOverlay("show");

               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_prov?authtoken="+$("#token").val(),
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#provPerusahaan").html(data.prov);
                         $("#kabPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kecPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#txtprovadd").LoadingOverlay("hide");
                         $("#txtkabadd").LoadingOverlay("hide");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data provinsi, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });

          $(".refkab").click(function() {
               $("#txtkabadd").LoadingOverlay("show");
               $("#txtkecadd").LoadingOverlay("show");
               $("#txtkeladd").LoadingOverlay("show");

               let id_prov = $("#provPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kab?authtoken="+$("#token").val(),
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kabPerusahaan").html(data.kab);
                         $("#kecPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#txtkabadd").LoadingOverlay("hide");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $(".refkec").click(function() {
               $("#txtkecadd").LoadingOverlay("show");
               $("#txtkeladd").LoadingOverlay("show");
               let id_kab = $("#kabPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kec?authtoken="+$("#token").val(),
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kecPerusahaan").html(data.kec);
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#txtkecadd").LoadingOverlay("hide");
                         $("#txtkeladd").LoadingOverlay("hide");

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $(".refkel").click(function() {
               $("#kelPerusahaan").LoadingOverlay("show");
               let id_kec = $("#kecPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kel?authtoken="+$("#token").val(),
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kelPerusahaan").html(data.kel);
                         $("#kelPerusahaan").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
                              $("#btnTambahPerusahaan").remove();
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');
                    }
               });
          });
          $('#btnupdatePerusahaan').click(function() {
               let kode = $('#editPerusahaanKode').val();
               let perusahaan = $('#editPerusahaan').val();
               let alamat = $('#editPerusahaanAlamat').val();
               let kodepos = $('#editPerusahaanKodepos').val();
               let kel = $('#editPerusahaanKel').val();
               let kec = $('#editPerusahaanKec').val();
               let kab = $('#editPerusahaanKab').val();
               let prov = $('#editPerusahaanProv').val();
               let telp = $('#editPerusahaanTelp').val();
               let email = $('#editPerusahaanEmail').val();
               let web = $('#editPerusahaanWeb').val();
               let npwp = $('#editPerusahaanNpwp').val();
               let kegiatan = $('#editPerusahaanKeg').val();
               let status = $('#editPerusahaanStatus').val();
               let ket = $('#editPerusahaanKet').val();
               var token = $("#token").val();

               $.ajax({
                    type: "POST",
                    url: site_url+"perusahaan/edit_perusahaan",
                    data: {
                         kode: kode,
                         perusahaan: perusahaan,
                         alamat: alamat,
                         kodepos: kodepos,
                         kel: kel,
                         kec: kec,
                         kab: kab,
                         prov: prov,
                         telp: telp,
                         email: email,
                         web: web,
                         npwp: npwp,
                         status: status,
                         keg: kegiatan,
                         ket: ket,
                         token:token
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              tbmPerusahaan.draw();
                              $("#editPerusahaanmdl").modal("hide");
                              swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                              $("#editPerusahaanKode").val('');
                              $("#editPerusahaan").val('');
                              $("#editPerusahaanKet").val('');
                              $("#editPerusahaanStatus").val('');
                              $("#error1el").html('');
                              $("#error2el").html('');
                              $("#error3el").html('');
                              $("#error4el").html('');
                         } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                              swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                              $("#error1eper").html('');
                              $("#error2eper").html('');
                              $("#error3eper").html('');
                              $("#error4eper").html('');
                              $("#error5eper").html('');
                              $("#error6eper").html('');
                              $("#error7eper").html('');
                              $("#error8eper").html('');
                              $("#error9eper").html('');
                              $("#error10eper").html('');
                              $("#error11eper").html('');
                              $("#error12eper").html('');
                              $("#error13eper").html('');
                              $("#error14eper").html('');
                              $("#error15eper").html('');
                         } else if (data.statusCode == 202) {
                              $("#error1eper").html(data.kode);
                              $("#error2eper").html(data.perusahaan);
                              $("#error3eper").html(data.alamat);
                              $("#error4eper").html(data.kodepos);
                              $("#error5eper").html(data.prov);
                              $("#error6eper").html(data.kab);
                              $("#error7eper").html(data.kec);
                              $("#error8eper").html(data.kel);
                              $("#error9eper").html(data.telp);
                              $("#error10eper").html(data.email);
                              $("#error11eper").html(data.web);
                              $("#error12eper").html(data.npwp);
                              $("#error13eper").html(data.keg);
                              $("#error14eper").html(data.ket);
                              $("#error15eper").html(data.status);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         if (xhr.status == 404) {
                              pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
                          } else if (xhr.status == 0) {
                             pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
                          } else {
                             pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
                          }
      
                          swal("Error",pesan,'error');
                    }
               })
          });

          $.LoadingOverlay("hide");

          function resetaddperusahaan() {
               $("#kodePerusahaan").val('');
               $("#Perusahaan").val('');
               $("#alamatPerusahaan").val('');
               $("#kodeposPerusahaan").val('');
               $("#provPerusahaan").val('').trigger('change');
               $("#telpPerusahaan").val('');
               $("#emailPerusahaan").val('');
               $("#webPerusahaan").val('');
               $("#npwpPerusahaan").val('');
               $("#kegPerusahaan").val('');
               $("#ketPerusahaan").val('');
               $(".error1").html('');
               $(".error2").html('');
               $(".error3").html('');
               $(".error4").html('');
               $(".error5").html('');
               $(".error6").html('');
               $(".error7").html('');
               $(".error8").html('');
               $(".error9").html('');
               $(".error10").html('');
               $(".error11").html('');
               $(".error12").html('');
               $(".error13").html('');
               $(".error14").html('');
          }

          $("#btnBatalPerusahaan").click(function() {
               location.reload();
          });

          $("#btnTambahPerusahaan").click(function() {
               var kode = $("#kodePerusahaan").val();
               var perusahaan = $("#Perusahaan").val();
               var alamat = $("#alamatPerusahaan").val();
               var kodepos = $("#kodeposPerusahaan").val();
               var prov = $("#provPerusahaan").val();
               var kab = $("#kabPerusahaan").val();
               var kec = $("#kecPerusahaan").val();
               var kel = $("#kelPerusahaan").val();
               var telp = $("#telpPerusahaan").val();
               var email = $("#emailPerusahaan").val();
               var web = $("#webPerusahaan").val();
               var npwp = $("#npwpPerusahaan").val();
               var keg = $("#kegPerusahaan").val();
               var ket = $("#ketPerusahaan").val();
               var token = $("#token").val();

               $.ajax({
                    type: "POST",
                    url: site_url+"perusahaan_api/insert",
                    data: {
                         kode: kode,
                         perusahaan: perusahaan,
                         alamat: alamat,
                         kodepos: kodepos,
                         prov: prov,
                         kab: kab,
                         kec: kec,
                         kel: kel,
                         telp: telp,
                         email: email,
                         npwp: npwp,
                         web: web,
                         keg: keg,
                         ket: ket,
                         token:token,
                    },
                    timeout: 20000,
                    success: function(data) {
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                              resetaddperusahaan()
                         } else if (data.statusCode == 201) {
                              swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                         } else if (data.statusCode == 202) {
                              $(".error1").html(data.kode);
                              $(".error2").html(data.perusahaan);
                              $(".error3").html(data.alamat);
                              $(".error4").html(data.kodepos);
                              $(".error5").html(data.prov);
                              $(".error6").html(data.kab);
                              $(".error7").html(data.kec);
                              $(".error8").html(data.kel);
                              $(".error9").html(data.telp);
                              $(".error10").html(data.email);
                              $(".error11").html(data.web);
                              $(".error12").html(data.npwp);
                              $(".error13").html(data.keg);
                              $(".error14").html(data.ket);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (xhr.status == 404) {
                              pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
                          } else if (xhr.status == 0) {
                             pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
                          } else {
                             pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                          }
      
                          swal("Error",pesan,'error');
                    }
               })
          });

          $(document).on('click', '.hpsperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               let namaPerusahaan = $(this).attr('value');
               var token = $("#token").val();

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    swal({
                         title: "Hapus",
                         text: "Yakin Perusahaan " + namaPerusahaan + " akan dihapus?",
                         type: 'question',
                         showCancelButton: true,
                         confirmButtonColor: '#36c6d3',
                         cancelButtonColor: '#d33',
                         confirmButtonText: 'Ya, hapus',
                         cancelButtonText: 'Batalkan'
                    }).then(function(result) {
                         if (result.value) {
                              $.ajax({
                                   type: "POST",
                                   url: site_url+"perusahaan_api/delete",
                                   data: {
                                        auth_perusahaan: auth_perusahaan,
                                        token:token
                                   },
                                   timeout: 20000,
                                   success: function(data, textStatus, xhr) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                             tbmPerusahaan.draw();
                                             swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                                        } else {
                                             swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                                        }

                                        $.LoadingOverlay("hide");
                                   },
                                   error: function(xhr, ajaxOptions, thrownError) {
                                        $.LoadingOverlay("hide");
                                        if (xhr.status == 404) {
                                             pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
                                         } else if (xhr.status == 0) {
                                            pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
                                         } else {
                                            pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                                         }
                     
                                         swal("Error",pesan,'error');
                                   }
                              });
                         }
                    });
               }
          });

          $(document).on('click', '.dtlperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               let namaPerusahaan = $(this).attr('value');
               var token = $("#token").val();

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: site_url+"perusahaan/detail_perusahaan",
                         data: {
                              auth_perusahaan: auth_perusahaan,
                              token:token
                         },
                         timeout: 15000,
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#detailPerusahaanKode").val(data.kode);
                                   $("#detailPerusahaan").val(data.perusahaan);
                                   $("#detailPerusahaanAlamat").val(data.alamat);
                                   $("#detailPerusahaanKodepos").val(data.kodepos);
                                   $("#detailPerusahaanTelp").val(data.perusahaatelp);
                                   $("#detailPerusahaanEmail").val(data.email);
                                   $("#detailPerusahaanWeb").val(data.web);
                                   $("#detailPerusahaanNpwp").val(data.npwp);
                                   $("#detailPerusahaanKeg").val(data.keg);
                                   $("#detailPerusahaanStatus").val(data.status);
                                   $("#detailPerusahaanKet").val(data.ket);
                                   $("#detailPerusahaanBuat").val(data.pembuat);
                                   $("#detailPerusahaanTglBuat").val(data.tgl_buat);
                                   $("#detailPerusahaanTglEdit").val(data.tgl_edit);
                                   $("#detailPerusahaanmdl").modal("show");
                              } else {
                                   swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              if (xhr.status == 404) {
                                   pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
                               } else if (xhr.status == 0) {
                                  pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
                               } else {
                                  pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                               }
           
                               swal("Error",pesan,'error');
                         }
                    });
               }
          });

          function edit_alamat(id_prov, id_kab, id_kec, id_kel) {
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_prov?authtoken="+$("#token").val(),
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanProv").html(data.prov);
                         $("#editPerusahaanProv").val(id_prov);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         if (thrownError != "") {
                             pesan = "Terjadi kesalahan saat load data provinsi, hubungi administrator";
                         } else {
                              pesan = "";
                         }

                         swal("Error",pesan,'error');

                    }
               });
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kab?authtoken="+$("#token").val(),
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKab").html(data.kab);
                         $("#editPerusahaanKab").val(id_kab);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kabupaten, hubungi administrator";
                          } else {
                               pesan = "";
                          }
 
                          swal("Error",pesan,'error');
                    }
               });
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kec?authtoken="+$("#token").val(),
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKec").html(data.kec);
                         $("#editPerusahaanKec").val(id_kec);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kecamatan, hubungi administrator";
                          } else {
                               pesan = "";
                          }
 
                          swal("Error",pesan,'error');
                    }
               });
               $.ajax({
                    type: "post",
                    url: site_url+"daerah/get_kel?authtoken="+$("#token").val(),
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKel").html(data.kel);
                         $("#editPerusahaanKel").val(id_kel);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         if (thrownError != "") {
                              pesan = "Terjadi kesalahan saat load data kelurahan, hubungi administrator";
                          } else {
                               pesan = "";
                          }
 
                          swal("Error",pesan,'error');
                    }
               });
          }

          $(document).on('click', '.edttperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               var token = $("#token").val();

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: site_url+"perusahaan/edit_detail_perusahaan",
                         data: {
                              auth_perusahaan: auth_perusahaan,
                              token:token
                         },
                         timeout: 15000,
                         success: function(data) {
                              var dataPerusahaan = JSON.parse(data);
                              if (dataPerusahaan.statusCode == 200) {
                                   $("#jdleditPerusahaan").text(dataPerusahaan.judul);
                                   $("#editPerusahaanKode").val(dataPerusahaan.kode);
                                   $("#editPerusahaan").val(dataPerusahaan.perusahaan);
                                   $("#editPerusahaanAlamat").val(dataPerusahaan.alamat);
                                   edit_alamat(dataPerusahaan.prov, dataPerusahaan.kab, dataPerusahaan.kec, dataPerusahaan.kel);
                                   $("#editPerusahaanKodepos").val(dataPerusahaan.kodepos);
                                   $("#editPerusahaanTelp").val(dataPerusahaan.perusahaatelp);
                                   $("#editPerusahaanEmail").val(dataPerusahaan.email);
                                   $("#editPerusahaanWeb").val(dataPerusahaan.web);
                                   $("#editPerusahaanNpwp").val(dataPerusahaan.npwp);
                                   $("#editPerusahaanKeg").val(dataPerusahaan.keg);
                                   $("#editPerusahaanStatus").val(dataPerusahaan.status);
                                   $("#editPerusahaanKet").val(dataPerusahaan.ket);
                                   $("#editPerusahaanmdl").modal("show");
                                   $("#error1el").html('');
                                   $("#error2el").html('');
                                   $("#error3el").html('');
                                   $("#error4el").html('');
                              } else {
                                   swal(dataPerusahaan.kode_pesan,dataPerusahaan.pesan,dataPerusahaan.tipe_pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              if (xhr.status == 404) {
                                   pesan = "Perusahaan gagal diupdate, Link data tidak ditemukan";
                               } else if (xhr.status == 0) {
                                  pesan = "Perusahaan gagal diupdate, Waktu koneksi habis";
                               } else {
                                  pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                               }
           
                               swal("Error",pesan,'error');
                         }
                    });
               }
          });

          $("#btnrefreshPerusahaan").click(function() {
               $('#tbmPerusahaan').LoadingOverlay("show");
               tbPerusahaan();
               $('#tbmPerusahaan').LoadingOverlay("hide");
          });

          tbPerusahaan();

          function tbPerusahaan(){
               var token = $("#token").val();

               $.ajax ({
                   type:"POST",
                   url : site_url + "dash/Oauth",
                   data : {
                       token : token,
                   },
                   success : function(data){
                       var data = JSON.parse(data);
                       if(data.statusCode==200) {
                         tbmPerusahaan = $('#tbmPerusahaan').DataTable({
                              "processing": true,
                              "responsive": true,
                              "serverSide": true,
                              "ordering": true,
                              "order": [
                                   [1, 'asc'],
                              ],
                              "ajax": {
                                   "url": site_url+"perusahaan/ajax_list?authtoken=" + $("#token").val(),
                                   "type": "POST",
                                   "error": function(xhr, error, code) {
                                        if (code != "") {
                                             pesan = "Terjadi kesalahan saat melakukan load data perusahaan, hubungi administrator";
                                             $("#secadd").remove();
                                             swal("Error",pesan,'error');
                                        }
                                   }
                              },
                              "deferRender": true,
                              "aLengthMenu": [
                                   [10, 25, 50],
                                   [10, 25, 50]
                              ],
                              "columns": [{
                                        data: 'no',
                                        name: 'id_perusahaan',
                                        render: function(data, type, row, meta) {
                                             return meta.row + meta.settings._iDisplayStart + 1;
                                        },
                                        "className": "text-center align-middle",
                                        "width": "1%"
                                   },
                                   {
                                        "data": 'kode_perusahaan',
                                        "className": "text-nowrap  align-middle",
                                        "width": "10%"
                                   },
                                   {
                                        "data": 'nama_perusahaan',
                                        "className": "text-nowrap  align-middle",
                                        "width": "30%"
                                   },
                                   {
                                        "data": 'alamat_perusahaan',
                                        "className": "text-nowrap  align-middle",
                                        "width": "35%"
                                   },
                                   {
                                        "data": 'stat_perusahaan',
                                        "className": "text-center align-middle",
                                        "width": "1%"
                                   },
                                   {
                                        "data": 'proses',
                                        "className": "text-center text-nowrap  align-middle",
                                        "width": "1%"
                                   }
                              ]
                         });
                       } else {
                           swal(data.kode_pesan,data.pesan,data.tipe_pesan);
                       }
                   },
                   error: function(xhr, ajaxOptions, thrownError) {
                       $.LoadingOverlay("hide");
   
                       if (xhr.status == 404) {
                           pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                       } else if (xhr.status == 0) {
                           pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                       } else {
                           pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                       }
   
                       swal("Error",pesan,'error');
                   }
               });
          }
     });
