    <!-- Header -->
    <header id="header" style="background-color: #012970;" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="assets/img/sman12_favicon.png" alt="">
                <span class="ms-2" style="font-size: 20px; color: white;">SISURAT</span>
            </a>
            <i class="ri-menu-line toggle-sidebar-btn text-light"></i></button>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <?php if($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') : ?>
                <button class="btn text-light me-3" style="font-size: 20px;" data-bs-toggle="modal"
                    data-bs-target="#modal-panduan-admin" data-bs-placement="bottom" title="Panduan aplikasi"><i
                        class="bi bi-question-circle"></i></button>
                <?php else : ?>
                <button class="btn text-light me-3" style="font-size: 20px;" data-bs-toggle="modal"
                    data-bs-target="#modal-panduan-user" data-bs-placement="bottom" title="Panduan aplikasi"><i
                        class="bi bi-question-circle"></i></button>
                <?php endif; ?>

                <div class="modal fade" id="modal-panduan-user" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>PANDUAN APLIKASI SISURAT</strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ol type="1">
                                    <li class="mb-2">Klik ikon <strong><i class="ri-menu-line bold"></i></strong>
                                        dibagian
                                        kiri atas untuk
                                        menampilkan menu.</li>
                                    <li class="mb-2">Anda dapat mengajukan surat melalui menu <strong><a
                                                href="index.php?page=ajukan-surat" class="text-decoration-none">ajukan
                                                surat</a></strong>. Setelah
                                        itu, Anda dapat memilih tipe surat untuk diajukan.</li>
                                    <li class="mb-2">Lihat daftar surat yang Anda ajukan melalui menu <strong><a
                                                href="index.php?page=list-pengajuan-user">daftar pengajuan</a></strong>.
                                    </li>
                                    <li class="mb-2">Jika
                                        Anda menggunakan <strong><a
                                                href="https://dianisa.com/pengertian-smartphone/#google_vignette"
                                                target="_blank" class="text-decoration-none">smartphone</a></strong>,
                                        Anda dapat
                                        menggeser ke sebelah
                                        kiri <i class="bi bi-arrow-left"></i> pada halaman <strong><a
                                                href="index.php?page=list-pengajuan-user">daftar pengajuan</a></strong>
                                        untuk melihat
                                        status pengajuan surat.</li>
                                    <li class="mb-2">Jika status pengajuan Anda adalah <i
                                            class="bi bi-clock text-warning"></i> <span
                                            class="text-warning">Menunggu</span>, artinya pengajuan Anda <strong>belum
                                            diverifikasi</strong> oleh staf surat.</li>
                                    <li class="mb-2">Jika status pengajuan Anda adalah <i
                                            class="bi bi-arrow-repeat text-warning"></i> <span
                                            class="text-warning">Dalam proses</span>, artinya pengajuan Anda
                                        <strong>sudah
                                            diverifikasi</strong> oleh staf surat tetapi masih dalam proses verifikasi
                                        oleh
                                        pimpinan.
                                    </li>
                                    <li class="mb-2">Anda dapat melihat detail pengajuan surat <strong>setelah</strong>
                                        pengajuan Anda
                                        diverifikasi oleh staf surat. Klik tombol <button type="button"
                                            class="btn btn-sm btn-info text-light"><i
                                                class="bi bi-eye-fill"></i>&nbsp;&nbsp;Lihat</button> pada halaman
                                        <strong><a href="index.php?page=list-pengajuan-user"
                                                class="text-decoration-none">daftar pengajuan</a></strong> untuk beralih
                                        ke
                                        halaman
                                        detail pengajuan.
                                    </li>
                                    <li class="mb-2">Anda dapat melacak posisi surat <strong>setelah</strong> pengajuan
                                        Anda diverifikasi
                                        oleh staf surat. Klik tombol <button type="button"
                                            class="btn btn-sm btn-success text-light"><i
                                                class="bi bi-graph-up"></i>&nbsp;&nbsp;Lacak</button> pada halaman
                                        <strong><a href="index.php?page=list-pengajuan-user"
                                                class="text-decoration-none">daftar pengajuan</a></strong> untuk beralih
                                        ke
                                        halaman
                                        lacak posisi surat.
                                    </li>
                                    <li class="mb-2">Jika hak akses anda adalah <strong>GTK</strong> atau
                                        <strong>Siswa</strong> dengan
                                        status pengajuan surat telah <span class="text-success"><i
                                                class="bi bi-check"></i>Diterima</span> sepenuhnya, Anda dapat mengunduh
                                        surat di menu <strong><a href="index.php?page=surat-masuk"
                                                class="text-decoration-none">surat
                                                masuk</a></strong>.
                                    </li>
                                    <li class="mb-2">Semua halaman yang memuat tabel daftar, terdapat tombol <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #2FDDF8;">Copy</button> <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #31E0C4">Excel</button> <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #FF5A8D;">PDF</button> yang masing-masing berfungsi
                                        untuk
                                        menyalin data dalam tabel, mengunduh data dalam
                                        tabel dengan format .excel/.xlsx dan mengunduh data dalam
                                        tabel dengan format PDF.
                                    </li>
                                    <li class="mb-2">Anda dapat mengubah foto profil dan mengatur ulang kata sandi di
                                        menu <strong><a href="index.php?page=profile"
                                                class="text-decoration-none">profile</a></strong>.</li>
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-panduan-admin" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>PANDUAN APLIKASI UNIT VERIFIKASI</strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ol type="1">
                                    <li class="mb-2">Klik ikon <strong><i class="ri-menu-line bold"></i></strong>
                                        dibagian
                                        kiri atas untuk
                                        menyembunyikan atau menampilkan menu.</li>
                                    <li class="mb-2">Anda dapat melihat dafatar pengajuan surat melalui menu <strong><a
                                                href="index.php?page=pengajuan-surat"
                                                class="text-decoration-none">pengajuan
                                                surat</a></strong>.</li>
                                    <li class="mb-2">Untuk hak akses <strong>Wakasek Kurikulum</strong> dan
                                        <strong>Kepala Sekolah</strong>, hanya dapat melihat pengajuan surat yang
                                        <strong>telah</strong> diteruskan oleh Staf Surat.
                                    </li>
                                    <li class="mb-2">Fitur <strong>filter surat</strong> untuk menampilkan surat
                                        berdasarkan <strong>rentang tanggal</strong> dan <strong>status surat</strong>
                                        yang dipilih.
                                    </li>
                                    <li class="mb-2">Jika
                                        Anda menggunakan <strong><a
                                                href="https://dianisa.com/pengertian-smartphone/#google_vignette"
                                                target="_blank" class="text-decoration-none">smartphone</a></strong>,
                                        Anda dapat
                                        menggeser ke sebelah
                                        kiri <i class="bi bi-arrow-left"></i> pada halaman <strong><a
                                                href="index.php?page=pengajuan-surat">pengajuan surat</a></strong>
                                        untuk memverifikasi pengajuan surat.</li>
                                    <li class="mb-2">Semua halaman yang memuat tabel daftar, terdapat tombol <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #2FDDF8;">Copy</button> <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #31E0C4">Excel</button> <button
                                            class="btn btn-sm text-light"
                                            style="background-color: #FF5A8D;">PDF</button> yang masing-masing berfungsi
                                        untuk
                                        menyalin data dalam tabel, mengunduh data dalam
                                        tabel dengan format .excel/.xlsx dan mengunduh data dalam
                                        tabel dengan format PDF.
                                    </li>
                                    <li class="mb-2">Untuk hak akses <strong>Staf Surat</strong>, pada halaman
                                        <strong><a href="index.php?page=pengajuan-surat"
                                                class="text-decoration-none">pengajuan
                                                surat</a></strong>, Anda akan melihat tombol <button
                                            class="btn btn-sm btn-secondary text-light">Menunggu...</button>
                                        <strong>setelah</strong>
                                        Anda meneruskan pengajuan surat ke pimpinan. Tombol akan berubah menjadi <button
                                            class="btn btn-sm btn-info text-light"><i class="bi bi-eye-fill"></i>&nbsp;
                                            Lihat</button> jika pengajuan surat <strong>telah</strong> diverifikasi oleh
                                        pimpinan.
                                    </li>
                                    <li class="mb-2"><strong>Staf Surat</strong> dapat menyimpan data <strong>surat
                                            masuk</strong> yang
                                        diterima secara langsung melalui menu <strong><a
                                                href="index.php?page=tambah-surat-masuk"
                                                class="text-decoration-none">tambah
                                                surat masuk</a></strong>.</li>
                                    <li class="mb-2"><strong>Staf Surat</strong> dapat mengeluarkan surat melalui menu
                                        <strong><a href="index.php?page=keluarkan-surat"
                                                class="text-decoration-none">keluarkan surat</a></strong> tanpa harus
                                        melalui tahap verifikasi.
                                    </li>
                                    <li class="mb-2"><strong>Staf Surat</strong> dapat menyimpan data <strong>surat
                                            keluar</strong> yang
                                        dikeluarkan tanpa melalui aplikasi pada menu <strong><a
                                                href="index.php?page=keluarkan-surat"
                                                class="text-decoration-none">keluarkan surat</a></strong> dan pilih
                                        <strong><a href="index.php?page=keluarkan-surat"
                                                class="text-decoration-none">arsip surat keluar</a></strong>.
                                    </li>
                                    <li class="mb-2">Anda dapat melihat seluruh data surat masuk dan surat keluar di
                                        menu <strong><a href="index.php?page=arsip-surat"
                                                class="text-decoration-none">arsip</a></strong>.
                                    </li>
                                    <li class="mb-2">Anda dapat mengubah foto profil dan mengatur ulang kata sandi di
                                        menu <strong><a href="index.php?page=profile"
                                                class="text-decoration-none">profile</a></strong>.</li>
                                    <li class="mb-2">Anda dapat melihat seluruh data pengguna aplikasi di menu
                                        <strong><a href="index.php?page=pengguna"
                                                class="text-decoration-none">pengguna</a></strong>.
                                    </li>
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifikasi section  -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell text-light"></i> -->
                <?php
                        // if ($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') {
                        //     if ($pengajuan_DP) {
                        //         echo '<span class="badge bg-danger badge-number">'. $total_dalam_proses['total_dalam_proses'] .'</span>';
                        //     } else {
                        //         echo '';
                        //     }
                        // }
                        ?>

                <!-- </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header"> -->
                <?php
                            // if ($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') {
                            //     if ($pengajuan_DP) {
                            //         echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $total_dalam_proses['total_dalam_proses'] .'&nbsp; notifikasi terbaru&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            //     } else {
                            //         echo 'Tidak ada notifikasi terbaru';
                            //     }
                            // }
                            ?>

                <!-- </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#" class="text-decoration-none" style="color: #012970;">Tampilkan semua
                                notifikasi</a>
                        </li>
                    </ul>
                </li> -->
                <!-- end notification section  -->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/<?= $photo_path; ?>" alt="Profile">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-light">
                            <?php 
                            if ($display_name == null) {
                                header("Location:". BASE_URL);
                            } else {
                                echo $display_name;
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        <?php
                        if ($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') {
                            echo '<li class="dropdown-header">
                            <h6>'. $user['id_number'] .'</h6>
                            <span>'. $user['role'] .'</span>
                        </li>';
                        } else {
                            echo '<li class="dropdown-header">
                            <h6>'. $users[0]['id_number'] .'</h6>
                            <span>'. $users[0]['role'] .'</span>
                        </li>';
                        }
                        ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?page=profile">
                                <i class="bi bi-person"></i>
                                <span>Profil saya</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="config/c_logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Header End -->