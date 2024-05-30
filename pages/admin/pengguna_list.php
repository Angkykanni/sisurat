<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Pengguna SISURAT</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengaturan</li>
                <li class="breadcrumb-item active">Pengguna SISURAT</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-auto">
                    <div class="card-body" style="font-size: 14px;">
                        <div class="card-title" style="margin-bottom: -20px;">
                        </div>

                        <table class="table table-hover table-borderless" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor ID</th>
                                    <th>Nama</th>
                                    <th>Waktu dibuat</th>
                                    <th>Waktu diubah</th>
                                    <th>Hak Akses</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['id_number']; ?></td>
                                    <td><?= $user['nama']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td><?= $user['updated_at']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($role === 'Admin') {
                                            echo '
                                            <div class="dropdown-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-gear-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li style="border-bottom: 1px solid #D8D8D8;">
                                                        <button class="hapusPenggunaButton dropdown-item" data-id="' . $user['id_number'] . '">
                                                            <i class="bi bi-trash-fill text-danger"></i>Hapus
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="index.php?page=detail-pengguna&id_number=' . $user['id_number'] . '">
                                                            <i class="bi bi-eye-fill text-info"></i> Detail
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            ';
                                        } else {
                                            echo '<button class="btn btn-sm btn-info"><a class="text-light" href="index.php?page=detail-pengguna&id_number=' . $user['id_number'] . '"><i class="bi-eye-fill text-light"></i>&nbsp;Detail</a></button>';
                                        }
                                        ?>

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