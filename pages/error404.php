<?php require 'config/c_session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title . ' | SISURAT SMAN12 KUPANG' : 'SISURAT SMAN12 KUPANG'; ?></title>
    <link href="assets/img/sman12_favicon.png" rel="icon">
    <link href="assets/img/sman12_favicon.png" rel="sman12_favicon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">

    <style>
    .page_404 {
        padding: 40px 0;
        background: #fff;
        font-family: "Poppins", sans-serif;
    }

    .page_404 img {
        width: 100%;
    }

    .four_zero_four_bg {

        background-image: url("assets/img/error404.gif");
        height: 400px;
        background-position: center;
    }

    .four_zero_four_bg h1 {
        font-size: 80px;
        font-weight: 600;
    }

    .four_zero_four_bg h3 {
        font-size: 80px;
    }

    .link_404 {
        color: #fff !important;
        padding: 10px 20px;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;
        border-radius: 5px;
    }

    .contant_box_404 {
        margin-top: -50px;
    }
    </style>

</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel='stylesheet'
            href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel="stylesheet" href="./style.css">

    </head>

    <body>
        <section class="page_404">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="col-sm-10 col-sm-offset-1  text-center">
                            <div class="four_zero_four_bg">
                                <h1 class="text-center ">404</h1>
                            </div>

                            <div class="contant_box_404">
                                <h3 class="h3">
                                    Masalah sambungan atau halaman yang anda cari tidak ada!
                                </h3>

                                <div style="font-size: 20px;">
                                    <p></p>
                                </div>

                                <a href="config/c_logout.php" class="link_404">Kembali ke halaman login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

    </html>
</body>

</html>