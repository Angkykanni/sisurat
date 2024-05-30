<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo isset($title) ? $title . ' | SISURAT SMAN12 KUPANG' : 'SISURAT SMAN12 KUPANG'; ?></title>

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
    <link href="assets/vendors/remixicon/remixicon.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/loader.css" rel="stylesheet">
</head>

<body>
    <div class="dim-overlay"></div>
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
    </div>
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/sman12_favicon.png"
                                        style="max-height: 100px; margin-bottom: 10px;" alt="">
                                    <!-- <span class="d-none d-lg-block">SMA Negeri 12 Kupang</span> -->
                                </a>
                            </div><!-- End Logo -->

                            <?php include $content; ?>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendors JS Files -->
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>

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

</body>

</html>