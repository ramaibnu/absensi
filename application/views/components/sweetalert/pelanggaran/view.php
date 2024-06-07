<?php if ($this->session->flashdata('update_success')) { ?>
<script>
swal({
    title: "Berhasil",
    text: "Data Pelanggaran Berhasil diupdate",
    type: "success",
    showConfirmButton: false,
    timer: 2000,
});
</script>
<?php } ?>
<?php if ($this->session->flashdata('not_found')) { ?>
<script>
swal({
    title: "Error",
    text: "Data Pelanggaran tidak ditemukan",
    type: "error",
});
</script>
<?php } ?>