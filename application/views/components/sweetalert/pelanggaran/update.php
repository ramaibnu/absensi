<?php if ($this->session->flashdata('update_fail')) { ?>
<script>
swal({
    title: "Gagal",
    text: "Data Pelanggaran Gagal diupdate",
    type: "error",
});
</script>
<?php } ?>