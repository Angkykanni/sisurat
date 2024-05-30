<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Daftar Pengajuan Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan Surat</li>
                <li class="breadcrumb-item active">Daftar Pengajuan Surat</li>
            </ol>
        </nav>
    </div>
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

                            <select name="status" class="form-control mb-2" required id="status">
                                <option value="" disabled hidden selected>Status surat</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                            </select>

                            <select name="kategori" class="form-control mb-3" required id="kategori">
                                <option value="" disabled hidden selected>Jenis surat</option>
                                <option value="Keluar">Keluar</option>
                                <option value="Masuk">Masuk</option>
                            </select>

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

                        <table class="table table-hover table-striped text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>Pengusul</th>
                                    <th>Tanggal Pengajuan</th>

                                    <?php if ($role == 'Admin') : ?>
                                    <th>Posisi surat</th>
                                    <?php else : ?>
                                    <?php endif; ?>

                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1; 

                                if (isset($_POST['filter'])) {
                                    $mulai = $_POST['mulai'];
                                    $selesai = $_POST['selesai'];
                                    $status = $_POST['status'];
                                    $kategori = $_POST['kategori'];

                                    if ($kategori == 'Masuk') {
                                        // Adjusted query to filter letters based on start and end dates and status
                                        $query_surat_pengajuan = "SELECT pengajuan.id,
                                                                        tipe_surat.nama_tipe AS jenis_surat, 
                                                                        users.nama AS pengusul_surat, 
                                                                        pengajuan.kepada,
                                                                        pengajuan.perihal, 
                                                                        pengajuan.tanggal_mulai, 
                                                                        pengajuan.tanggal_selesai, 
                                                                        pengajuan.file, 
                                                                        pengajuan.status, 
                                                                        pengajuan.created_at, 
                                                                        pengajuan.updated_at,
                                                                        pengajuan.asal_surat,
                                                                        pengajuan.posisi
                                                                    FROM pengajuan
                                                                    JOIN users ON pengajuan.asal_surat = users.id_number
                                                                    JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                                                                    WHERE pengajuan.tipe_surat = 4 AND pengajuan.status = '$status' AND pengajuan.created_at BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)";
                                    } else {
                                        // Adjusted query to filter letters based on start and end dates and status
                                        $query_surat_pengajuan = "SELECT pengajuan.id,
                                                                        tipe_surat.nama_tipe AS jenis_surat, 
                                                                        users.nama AS pengusul_surat, 
                                                                        pengajuan.kepada,
                                                                        pengajuan.perihal, 
                                                                        pengajuan.tanggal_mulai, 
                                                                        pengajuan.tanggal_selesai, 
                                                                        pengajuan.file, 
                                                                        pengajuan.status, 
                                                                        pengajuan.created_at, 
                                                                        pengajuan.updated_at,
                                                                        pengajuan.asal_surat,
                                                                        pengajuan.posisi
                                                                    FROM pengajuan
                                                                    JOIN users ON pengajuan.asal_surat = users.id_number
                                                                    JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                                                                    WHERE pengajuan.tipe_surat != 4 AND pengajuan.status = '$status' AND pengajuan.created_at BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)";
                                    }

                                    if ($role == 'Kepala Sekolah') {
                                        $query_surat_pengajuan .= " AND pengajuan.posisi = 'Kepala Sekolah'";
                                    } elseif ($role == 'Wakasek Kurikulum') {
                                        $query_surat_pengajuan .= " AND pengajuan.posisi = 'Wakasek Kurikulum'";
                                    }

                                    // Execute the adjusted query
                                    $result_get_surat_pengajuan = mysqli_query($conn, $query_surat_pengajuan);
                                    $pengajuan_surat = mysqli_fetch_all($result_get_surat_pengajuan, MYSQLI_ASSOC);
                                } else {
                                    // Fetch all letters if filter is not applied
                                    $pengajuan_surat = $pengajuan_surat;
                                }
                                ?>

                                <?php foreach ($pengajuan_surat as $pengajuan) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="<?= ($pengajuan['jenis_surat'] == 'Surat Masuk' ? 'text-success' : '') ?>"
                                        style="<?= ($pengajuan['jenis_surat'] == 'Surat Masuk' ? 'font-weight: 600' : '') ?>">
                                        <?= $pengajuan['jenis_surat']; ?></td>
                                    <td><?= $pengajuan['pengusul_surat']; ?></td>
                                    </td>
                                    <td><?= $pengajuan['created_at']; ?></td>

                                    <?php if ($role == 'Admin' && $pengajuan['posisi'] !== null) : ?>
                                    <td><?php
                                        if ($pengajuan['posisi'] == 'Admin') {
                                            echo 'Staf Surat';
                                        } else {
                                            echo $pengajuan['posisi'];
                                        }
                                        ?></td>
                                    <?php elseif ($role == 'Admin') : ?>
                                    <td class="text-danger">Tidak diteruskan</td>
                                    <?php endif; ?>

                                    <td class="<?php
                                    if ($pengajuan['status'] === 'Ditolak') {
                                        echo 'text-danger';
                                    } elseif ($pengajuan['status'] === 'Diterima') {
                                        echo 'text-success';
                                    } else {
                                        echo 'text-warning';
                                    }
                                    ?>">
                                        <i class="<?php
                                        if ($pengajuan['status'] === 'Ditolak') {
                                            echo 'bx bx-x';
                                        } elseif ($pengajuan['status'] === 'Diterima') {
                                            echo 'bi bi-check2';
                                        } else {
                                            echo 'bi bi-arrow-repeat';
                                        }
                                        ?>"></i>&nbsp;<?= $pengajuan['status']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($role === 'Admin') : ?>

                                        <?php if ($pengajuan['status'] === 'Dalam Proses' && ($pengajuan['posisi'] === 'Kepala Sekolah' XOR $pengajuan['posisi'] === 'Wakasek Kurikulum')) : ?>
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            disabled>Menunggu...</button>

                                        <?php elseif ($pengajuan['status'] === 'Dalam Proses' && $pengajuan['posisi'] === null) : ?>
                                        <a href="index.php?page=verifikasi-surat&id=<?= $pengajuan['id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success"><i
                                                    class="ri-mail-open-line"></i>&nbsp;Verifikasi</button>
                                        </a>

                                        <?php else : ?>
                                        <a href="index.php?page=detail-pengajuan&id=<?= $pengajuan['id']; ?>">
                                            <button type="button" style="width: 80px;"
                                                class="btn btn-sm btn-info text-light"><i
                                                    class="bi bi-eye-fill"></i>&nbsp;&nbsp;Lihat</button>
                                        </a>

                                        <?php endif; ?>

                                        <?php else : ?>

                                        <?php if ($pengajuan['status'] === 'Dalam Proses') : ?>
                                        <a href="index.php?page=verifikasi-surat&id=<?= $pengajuan['id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success"><i
                                                    class="ri-mail-open-line"></i>&nbsp;Verifikasi</button>
                                        </a>

                                        <?php else : ?>
                                        <a href="index.php?page=detail-pengajuan&id=<?= $pengajuan['id']; ?>">
                                            <button type="button" style="width: 80px;"
                                                class="btn btn-sm btn-info text-light"><i
                                                    class="bi bi-eye-fill"></i>&nbsp;&nbsp;Lihat</button>
                                        </a>

                                        <?php endif; ?>

                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>