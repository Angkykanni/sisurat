<?php
if (isset($_GET['id_number'])) {
    $id_number = $_GET['id_number'];

    $user = getUserByIdNumber($id_number);
    if ($user) {
        $id_number = $user['id_number'];
        $nama = $user['nama'];
        $ttl = $user['ttl'];
        $jenis_kelamin = $user['jenis_kelamin'];
        $orangtua = $user['orangtua'];
        $kelas = $user['kelas'];
        $email = $user['email'];
        $instansi = $user['instansi'];
        $role_pengguna = $user['role'];

        if (!empty($user)) {
            $profile_pict = $user['photo'];
            if (!empty($profile_pict)) {
                $profile_pict_path = "uploads/" . $profile_pict;
            } else {
                $profile_pict_path = "../assets/uploads/userLogin.png";
            }
        } else {
            $profile_pict_path = "../assets/uploads/userLogin.png";
        }

    } else {
        echo "<p>Pengguna tidak ditemukan.</p>";
    }
    
} else {
    echo "<p>Parameter nomor induk tidak ditemukan.</p>";
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Biodata Pengguna</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=admin-dashboard">Admin</a></li>
                <li class="breadcrumb-item">Daftar Pengguna</li>
                <li class="breadcrumb-item active">Detail Pengguna</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body pt-4 d-flex flex-column align-items-center">
                        <img src="assets/<?= $profile_pict_path ?>" style="height: 200px; width: 200px;">
                    </div>

                    <div class="text-center mt-1" style="margin-bottom: 20px;">
                        <a href="index.php?page=pengguna"><button class="btn btn-secondary"><i
                                    class="bi bi-arrow-left"></i>&nbsp;Kembali</button></a>
                        <a href="<?= BASE_URL .'pages/download/d_pengguna_detail.php?id_number='. $id_number ?>"
                            target="_blank"><button type="button" class="btn btn-icon btn-info text-light"><i
                                    class="bi bi-printer-fill"></i>
                                Cetak
                                biodata</button></a>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane show active profile-overview" id="profile-overview">
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-4 label ">Nomor Induk</div>
                                <div class="col-lg-9 col-md-8"><?= $id_number ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8"><?= $nama ?></div>
                            </div>

                            <?php
                            if ($role_pengguna === 'Siswa') :
                            ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8"><?= $jenis_kelamin ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8"><?= $ttl ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kelas</div>
                                <div class="col-lg-9 col-md-8"><?= $kelas ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Orang Tua/Wali</div>
                                <div class="col-lg-9 col-md-8"><?= $orangtua ?></div>
                            </div>
                            <?php
                            endif;
                            ?>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $email ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Instansi</div>
                                <div class="col-lg-9 col-md-8"><?= $instansi ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Hak Akses</div>
                                <div class="col-lg-9 col-md-8"><?= $role ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>