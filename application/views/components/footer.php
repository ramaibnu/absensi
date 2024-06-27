<!-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->
<script src="<?= base_url('assets/others/js/dataTables.js') ?>"></script>
<script src="<?= base_url('assets/others/js/dataTables.buttons.js') ?>"></script>
<script src="<?= base_url('assets/others/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/others/js/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/others/js/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/others/js/bootstrap-select.min.js') ?>"></script>
<script>
    $('.selectpicker').selectpicker();
    new DataTable('#Texample', {
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        }
    });
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Export Excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Export CSV',
                        text: '<i class="fas fa-file-csv"></i>',
                        titleAttr: 'CSV'
                    },
                ]
            }
        }
    });
    new DataTable('#example2', {
        layout: {
            topStart: {
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Export Excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Export CSV',
                        text: '<i class="fas fa-file-csv"></i>',
                        titleAttr: 'CSV'
                    },
                ]
            }
        }
    });
</script>
</body>

</html>