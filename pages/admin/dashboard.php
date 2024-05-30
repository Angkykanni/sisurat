<?php
//All Pengajuan
$sql_pengajuan = "SELECT COUNT(*) AS total_pengajuan FROM pengajuan";
$result_pengajuan = mysqli_query($conn, $sql_pengajuan);
$pengajuan = mysqli_fetch_assoc($result_pengajuan);

//Pengajuan Status
$sql_dalam_proses = "SELECT COUNT(*) AS total_dalam_proses FROM pengajuan WHERE status = 'Dalam Proses'";
$sql_diverifikasi = "SELECT COUNT(*) AS total_diverifikasi FROM pengajuan WHERE status = 'Diterima'";
$sql_ditolak = "SELECT COUNT(*) AS total_ditolak FROM pengajuan WHERE status = 'Ditolak'";

$result_dalam_proses = mysqli_query($conn, $sql_dalam_proses);
$result_diverifikasi = mysqli_query($conn, $sql_diverifikasi);
$result_ditolak = mysqli_query($conn, $sql_ditolak);

$dalam_proses = mysqli_fetch_assoc($result_dalam_proses);
$diverifikasi = mysqli_fetch_assoc($result_diverifikasi);
$ditolak = mysqli_fetch_assoc($result_ditolak);

//Jenis Surat Masuk dan Keluar
$sql_masuk = "SELECT COUNT(*) AS total_masuk FROM surat WHERE jenis = 'Masuk'";
$sql_keluar = "SELECT COUNT(*) AS total_keluar FROM surat WHERE jenis = 'Keluar'";

$result_masuk = mysqli_query($conn, $sql_masuk);
$result_keluar = mysqli_query($conn, $sql_keluar);

$masuk = mysqli_fetch_assoc($result_masuk);
$keluar = mysqli_fetch_assoc($result_keluar);
?>
<!-- Dashboard -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Beranda <?php 
        if ($title === 'Dashboard Kepsek') {
            echo 'Kepala Sekolah';
        } elseif ($title === 'Dashboard Kurikulum') {
            echo 'Kurikulum';
        } elseif ($title === 'Dashboard') {
            echo '';
        } else {
            echo 'Administrator';
        }
        ?></h1>

        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <?php 
                    if ($title === 'Dashboard Kepsek') {
                        echo '<a href="index.php?page=kepsek-dashboard">Kepala Sekolah</a>';
                    } elseif ($title === 'Dashboard Kurikulum') {
                        echo '<a href="index.php?page=wakasek-dashboard">Kurikulum</a>';
                    } elseif ($title === 'Dashboard') {
                        echo '<a href="index.php?page=dashboard">Pengguna</a>';
                    } else {
                        echo '<a href="index.php?page=admin-dashboard">Admin</a>';
                    }
                    ?>
                </li>
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard" style="margin-bottom: 150px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card male-card">
                            <a href="index.php?page=pengajuan-surat">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Semua Pengajuan</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-file-copy-2-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $pengajuan['total_pengajuan']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card female-card">
                            <a href="#">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Pengajuan Diterima</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-check-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $diverifikasi['total_diverifikasi']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card pns-card">
                            <a href="#">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Pengajuan Ditolak</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-close-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $ditolak['total_ditolak']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card kelas-card">
                            <a href="#">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Pengajuan Dalam Proses</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-settings-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $dalam_proses['total_dalam_proses']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card suratmasuk-card">
                            <a href="index.php?page=surat-masuk">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Surat Masuk</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-download-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $masuk['total_masuk']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php if ($title !== 'Dashboard') : ?>
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card nonpns-card">
                            <a href="index.php?page=surat-keluar">
                                <div class="card-body">
                                    <h5 class="card-title-dashboard">Surat Keluar</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-send-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $keluar['total_keluar']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($role == 'Siswa' || $role == 'GTK' || $role == 'Tamu') :?>
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card male-card">
                            <div class="card-body" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#modal-panduan-user" data-bs-placement="bottom">
                                <h5 class="card-title-dashboard">Panduan penggunaan aplikasi</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Panduan</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card male-card">
                            <div class="card-body" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#modal-panduan-admin" data-bs-placement="bottom">
                                <h5 class="card-title-dashboard">Panduan penggunaan aplikasi</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Unit verifikasi</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Dashboard  -->
<script>
function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
}

function showSweetAlertOncePerHour() {
    if (isMobileDevice()) {
        var lastAlertTime = localStorage.getItem('lastAlertTime');
        var currentTime = new Date().getTime();

        if (!lastAlertTime || (currentTime - lastAlertTime > 450000)) {
            Swal.fire({
                title: "Selamat Datang",
                text: "Anda dapat melihat panduan penggunaan aplikasi di bagian bawah halaman ini!",
                icon: "info"
            });

            localStorage.setItem('lastAlertTime', currentTime);
        }
    }
}

window.onload = showSweetAlertOncePerHour;
</script>