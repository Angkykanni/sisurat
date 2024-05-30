<main id="main" class="main">
    <div class="pagetitle">
        <?php if($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') : ?>
        <h1 class="mb-3">Daftar Surat Keluar</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Surat Keluar</li>
                <li class="breadcrumb-item active">Daftar Surat Keluar</li>
            </ol>
        </nav>
        <?php else : ?>
        <h1 class="mb-3">Daftar Surat Masuk</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Daftar Surat Masuk</li>
            </ol>
        </nav>
        <?php endif; ?>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-title">
                        <h5 style="margin-left: 20px; margin-bottom: -10px;">Filter Surat</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="mulai" class="form-label mb-0">Dari tanggal</label>
                            <input type="date" id="mulai" class="form-control mt-0 mb-3" name="mulai" required>

                            <label for="selesai" class="form-label mb-0">Sampai tanggal</label>
                            <input type="date" class="form-control mt-0 mb-3" id="selesai" name="selesai" required>

                            <div class="text-end">
                                <button type="submit" name="filter" class="btn btn-primary"><i
                                        class="bi bi-filter"></i>&nbsp;Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card overflow-auto">
                    <div class="card-body" style="font-size: 14px;">
                        <div class="card-title" style="margin-bottom: -20px;">
                        </div>

                        <?php
                            if (isset($_SESSION['penomoran_surat'])) {
                                if ($_SESSION['penomoran_surat']) {
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Surat Diterima",
                                                    text: "Surat telah dikirim ke pengusul dan tersimpan ke arsip",
                                                }).then(() => {
                                                    window.location.href = "index.php?page=surat-keluar";
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Kesalahan',
                                                    text: 'Penomoran surat gagal!',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['penomoran_surat']);
                            }
                        ?>

                        <table class="table table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Surat</th>
                                    <th>Data Pengajuan</th>
                                    <th class="text-center" style="width: 70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                $no = 1;

                                if (isset($_POST['filter'])) {
                                    $mulai = $_POST['mulai'];
                                    $selesai = $_POST['selesai'];

                                    // Adjusted query to filter letters based on start and end dates and status
                                    $query_surat_keluar_filter = "SELECT 
                                                                    surat.id,
                                                                    surat.jenis,
                                                                    surat.nomor_surat,
                                                                    tipe_surat.nama_tipe AS jenis_surat,
                                                                    tipe_surat.template AS file_template,
                                                                    users.nama AS pengusul_surat,
                                                                    surat.dari,
                                                                    surat.kepada,
                                                                    surat.perihal,
                                                                    surat.tanggal_mulai,
                                                                    surat.tanggal_selesai,
                                                                    surat.file,
                                                                    surat.instansi,
                                                                    surat.status,
                                                                    surat.created_at,
                                                                    role.roleName AS peran_pengguna
                                                                FROM 
                                                                    surat
                                                                JOIN 
                                                                    users ON surat.dari = users.id_number
                                                                JOIN 
                                                                    tipe_surat ON surat.tipe_surat = tipe_surat.id
                                                                JOIN 
                                                                    role ON users.role = role.roleName
                                                                WHERE 
                                                                    surat.jenis = 'Keluar' AND surat.created_at BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)";

                                    // Execute the adjusted query
                                    $result_surat_keluar_filter = mysqli_query($conn, $query_surat_keluar_filter);
                                    if ($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') {
                                        $surat_keluar = mysqli_fetch_all($result_surat_keluar_filter, MYSQLI_ASSOC);
                                    } else {
                                        $surat_masuk_pengusul = mysqli_fetch_all($result_surat_keluar_filter, MYSQLI_ASSOC);
                                    }
                                } else {
                                    if ($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') {
                                        $surat_keluar = $surat_keluar;
                                    } else {
                                        $surat_masuk_pengusul = $surat_masuk_pengusul;
                                    }
                                }

                                if ($role == 'Admin' || $role == 'Wakasek Kurikulum' || $role == 'Kepala Sekolah') {
                                ?>
                                <?php foreach ($surat_keluar as $sk): ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>Nomor: <span class="span-table"><?= $sk['nomor_surat']; ?></span>
                                        <br>
                                        Perihal: <span class="span-table"><?= $sk['perihal']; ?></span>
                                        <br>
                                        Kepada: <span
                                            class="span-table"><?= ($sk['kepada']) !== null ? $sk['kepada'] : '-' ?></span>
                                        <?php if($sk['tanggal_mulai'] !== null && $sk['tanggal_selesai'] !== null) : ?>
                                        <br>
                                        Tanggal Mulai: <span class="span-table"><?= $sk['tanggal_mulai'];  ?></span>
                                        <br>
                                        Tanggal Selesai: <span class="span-table"><?= $sk['tanggal_selesai']; ?></span>
                                        <?php endif; ?>
                                        <br>
                                        Tanggal Surat: <span class="span-table"><?= $sk['created_at']; ?></span>
                                    </td>
                                    <td>
                                        <span class="span-table">
                                            <?php
                                                if ($sk['peran_pengguna'] === 'GTK') {
                                                    echo 'GTK';
                                                } elseif ($sk['peran_pengguna'] === 'Siswa') {
                                                    echo 'SISWA';
                                                } elseif ($sk['peran_pengguna'] === 'Tamu') {
                                                    echo 'TAMU';
                                                } else {
                                                    echo '<span style="font-weight: 600">INTERNAL SEKOLAH</span>';
                                                }
                                            ?>
                                        </span>

                                        <br>
                                        Nomor Induk: <span class="span-table"><?= $sk['dari']; ?></span>
                                        <br>
                                        Nama Lengkap: <span class="span-table"><?= $sk['pengusul_surat']; ?></span>
                                    </td>

                                    <?php if($sk['jenis_surat'] == 'Aktif Belajar') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $sk['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $sk['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_aktif_belajar = 'assets/uploads/surat/surat_aktif_belajar.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_aktif_belajar . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php elseif($sk['jenis_surat'] == 'Pendampingan Siswa') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $sk['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $sk['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_pendampingan_siswa = 'assets/uploads/surat/surat_pendampingan_siswa.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_pendampingan_siswa . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php elseif($sk['jenis_surat'] == 'Tugas Keluar') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $sk['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $sk['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_tugas_keluar = 'assets/uploads/surat/surat_tugas_keluar.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_tugas_keluar . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php else : ?>
                                    <td class="text-center">
                                        <?php
                                        $url_surat_lainnya = 'assets/uploads/files/' . $sk['file'];
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_lainnya . '" target="_blank"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-eye"></i>&nbsp; Lihat</button></a>';
                                        ?>
                                    </td>
                                    <?php endif; ?>
                                    <!-- <td class="text-center"> -->
                                    <?php 
                                        // $template_name = $sk['file_template']; 
                                        // $template_path = 'assets/uploads/surat/' . $template_name;

                                        // if (file_exists($template_path)) {
                                        //     echo '<a href="assets/uploads/surat/surat_aktif_belajar.php?file_template=' . urlencode($template_name) . '"><button
                                        //         type="button" class="btn btn-sm btn-success"><i
                                        //             class="bi bi-download"></i>&nbsp;
                                        //         Unduh</button></a>';
                                        // } else {
                                        //     echo '<span class="text-danger">File tidak ditemukan</span>';
                                        // }
                                        ?>
                                    <!-- </td> -->
                                </tr>
                                <?php endforeach; ?>
                                <?php } else { 
                                foreach ($surat_masuk_pengusul as $smp): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>Nomor: <span class="span-table"><?= $smp['nomor_surat']; ?></span>
                                        <br>
                                        Perihal: <span class="span-table"><?= $smp['perihal']; ?></span>
                                        <?php if($smp['kepada'] !== null) : ?>
                                        <br>
                                        Kepada: <span class="span-table"><?= $smp['kepada']; ?></span>
                                        <?php endif; ?>
                                        <?php if($smp['tanggal_mulai'] !== null && $smp['tanggal_selesai'] !== null) : ?>
                                        <br>
                                        Tanggal Mulai: <span class="span-table"><?= $smp['tanggal_mulai'];  ?></span>
                                        <br>
                                        Tanggal Selesai: <span class="span-table"><?= $smp['tanggal_selesai']; ?></span>
                                        <?php endif; ?>
                                        <br>
                                        Tanggal Surat: <span class="span-table"><?= $smp['created_at']; ?></span>
                                    </td>
                                    <td>
                                        <span class="span-table">
                                            <?php
                                                if ($smp['peran_pengguna'] === 'GTK') {
                                                    echo 'GTK';
                                                } elseif ($smp['peran_pengguna'] === 'Siswa') {
                                                    echo 'SISWA';
                                                } elseif ($smp['peran_pengguna'] === 'Tamu') {
                                                    echo 'TAMU';
                                                } else {
                                                    echo '<span style="font-weight: 600">INTERNAL SEKOLAH</span>';
                                                }
                                            ?>
                                        </span>

                                        <br>
                                        Nomor Induk: <span class="span-table"><?= $smp['dari']; ?></span>
                                        <br>
                                        Nama Lengkap: <span class="span-table"><?= $smp['pengusul_surat']; ?></span>
                                        <?php if($smp['kelas_pengusul'] !== null) : ?>
                                        <br>
                                        Kelas : <span class="span-table"><?= $smp['kelas_pengusul']; ?></span>
                                        <?php endif; ?>
                                        <br>
                                        Tahun pelajaran : <span
                                            class="span-table"><?= $settings['tahun_pelajaran'] ?></span>
                                    </td>

                                    <?php if($smp['jenis_surat'] == 'Aktif Belajar') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $smp['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $smp['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_aktif_belajar = 'assets/uploads/surat/surat_aktif_belajar.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_aktif_belajar . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php elseif($smp['jenis_surat'] == 'Pendampingan Siswa') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $smp['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $smp['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_pendampingan_siswa = 'assets/uploads/surat/surat_pendampingan_siswa.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_pendampingan_siswa . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php elseif($smp['jenis_surat'] == 'Tugas Keluar') : ?>
                                    <td class="text-center">
                                        <?php 
                                        // Menggunakan $smp['nomor_surat'] sebagai nomor surat
                                        $nomor_surat = $smp['nomor_surat'];
                                        
                                        // Membuat URL dengan nomor surat sebagai parameter
                                        $url_surat_tugas_keluar = 'assets/uploads/surat/surat_tugas_keluar.php?nomor_surat=' . urlencode($nomor_surat);
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_tugas_keluar . '"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i>&nbsp; Unduh</button></a>';
                                        ?>
                                    </td>
                                    <?php else : ?>
                                    <td class="text-center">
                                        <?php
                                        $url_surat_lainnya = 'assets/uploads/files/' . $smp['file'];
                                        
                                        // Membuat link untuk mengunduh surat
                                        echo '<a href="' . $url_surat_lainnya . '" target="_blank"><button type="button" class="btn btn-sm btn-success"><i class="bi bi-eye"></i>&nbsp; Lihat</button></a>';
                                        ?>
                                    </td>
                                    <?php endif; ?>
                                    <!-- <td class="text-center"> -->
                                    <?php 
                                        // $template_name = $smp['file_template']; 
                                        // $template_path = 'assets/uploads/surat/' . $template_name;

                                        // if (file_exists($template_path)) {
                                        //     echo '<a href="assets/uploads/surat/surat_aktif_belajar.php?file_template=' . urlencode($template_name) . '"><button
                                        //         type="button" class="btn btn-sm btn-success"><i
                                        //             class="bi bi-download"></i>&nbsp;
                                        //         Unduh</button></a>';
                                        // } else {
                                        //     echo '<span class="text-danger">File tidak ditemukan</span>';
                                        // }
                                        ?>
                                    <!-- </td> -->
                                </tr>
                                <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>