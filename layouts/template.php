<?php
require 'config/config.php';
require 'config/c_session.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= isset($title) ? $title . ' | SISURAT SMAN12 KUPANG' : 'SISURAT SMAN12 KUPANG'; ?></title>

    <link href="assets/img/sman12_favicon.png" rel="icon">
    <link href="assets/img/sman12_favicon.png" rel="sman12_favicon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">

    <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendors/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendors/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendors/remixicon/remixicon.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- <link href="assets/datatable/datatables.min.css" rel="stylesheet"> -->

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/loader.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- <link href="assets/vendors/simple-datatables/style.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet"> -->
    <!-- Include DataTables Responsive CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> -->
    <!-- <link href="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.css" rel="stylesheet"> -->

    <style>
    .modal {
        z-index: 1050 !important;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    .dt-buttons .btn {
        margin-right: 5px;
        padding: 5px 10px;
        border-radius: 5px;
        border: 0.1px solid white;
    }

    .dt-buttons .btn-copy {
        background-color: #2FDDF8;
        color: white;
    }

    .dt-buttons .btn-excel {
        background-color: #31E0C4;
        color: white;
    }

    .dt-buttons .btn-pdf {
        background-color: #FF5A8D;
        color: white;
    }

    .dt-buttons .btn:hover {
        color: black;
        border: 1px solid white;
    }

    .dataTables_filter input {
        border: 1px solid #ccc;
    }

    .dataTables_filter input[type="search"] {
        color: #333;
        background-color: #f9f9f9;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .dataTables_wrapper table.dataTable {
        border: 0.1px solid transparent;
        margin-bottom: 20px;
        padding-right: 20px;
    }

    .dataTables_length select {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f8f9fa;
        color: #333;
    }

    .dataTables_length label {
        color: #333;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        margin-left: 10px;
        gap: 5px;
    }
    </style>

</head>

<body>
    <div class="dim-overlay"></div>
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
    </div>

    <?php include 'partials/header.php'; ?>

    <?php include 'partials/sidebar.php'; ?>

    <?php include $content; ?>

    <?php include 'partials/footer.php'; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/echarts/echarts.min.js"></script>
    <script src="assets/vendors/quill/quill.min.js"></script>
    <!-- <script src="assets/datatable/datatables.min.js"></script> -->
    <script src="assets/vendors/tinymce/tinymce.min.js"></script>
    <script src="assets/vendors/php-email-form/validate.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script>
    $('#myTable').DataTable({
        dom: 'Blftip',

        layout: {
            topStart: 'buttons'
        },
        buttons: [{
                extend: 'copy',
                className: 'btn btn-copy'
            },
            {
                extend: 'excel',
                className: 'btn btn-excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-pdf'
            }
        ]
    });
    </script>

    <script>
    document.addEventListener("contextmenu", function(event) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "Tindakan anda tidak diperkenankan!",
            showConfirmButton: false,
            timer: 2500
        })
        event.preventDefault();
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#modal-panduan-user').on('shown.bs.modal', function() {
            $(this).appendTo('body');
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#modal-panduan-admin').on('shown.bs.modal', function() {
            $(this).appendTo('body');
        });
    });
    </script>

    <!-- <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script> -->
    <!-- <script src="assets/vendors/simple-datatables/simple-datatables.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- Include DataTables Buttons JS -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> -->
    <!-- Include JSZip for Excel export -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
    <!-- Include pdfmake for PDF export -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
    <!-- Include Buttons HTML5 export JS -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->
    <!-- Include DataTables Responsive JS -->
    <!-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> -->

    <!-- <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: '<"top"Bfl>rt<"bottom"ip><"clear">',
            // responsive: true,
            buttons: [{
                    extend: 'copy',
                    text: 'Copy',
                    className: 'btn btn-copy'
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-excel'
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn btn-pdf'
                }
            ]
        });
    });
    </script> -->

    <?php
    if ($title === 'Pengguna') {
        echo '
    <script src="assets/js/pengguna_delete.js"></script>
        ';
    }
    ?>

</body>

</html>