<!DOCTYPE html>
<html lang="en">

<head>
    <title>1DBsys - Main</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(); ?>assets/assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/css/select2.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/jquery-ui.css">
    <!-- Sweetalert -->
    <link rel='stylesheet' href='<?= base_url(); ?>assets/assets/css/sweetalert2.min.css'>
    <script src="<?= base_url(); ?>assets/assets/js/sweetalert2.all.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css"> -->
    <link rel="stylesheet" href="<?= base_url('assets/others/css/dataTables.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"> -->
    <link rel="stylesheet" href="<?= base_url('assets/others/css/buttons.dataTables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/others/css/bootstrap-select.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/css/style.css" />

    <style>
        .swal2-container {
            z-index: 2000000000000 !important;
        }

        .ui-front {
            z-index: 99999999999 !important;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        .center_img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }

        .parsley-error {
            color: red;
        }

        .buttons-excel {
            background-color: green !important;
            color: white !important;
        }

        .buttons-csv {
            background-color: goldenrod !important;
            color: white !important;
        }
    </style>
</head>

<body class=" bg-c-blue">