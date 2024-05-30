<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Daftar Pengajuan Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=dashboard">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Pengajuan Surat</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-auto">
                    <div class="card-body" style="font-size: 14px;">
                        <div class="card-title" style="margin-bottom: -20px;">

                        </div>

                        <table class="table table-hover table-borderless text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pengajuan_surat as $pengajuan): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pengajuan['jenis_surat']; ?></td>
                                    <td><?= $pengajuan['perihal']; ?></td>
                                    <?php
                                    if ($pengajuan['kepada'] == null && $role == 'Tamu') {
                                        echo '<td><span class="text-danger">TIDAK ADA TUJUAN SURAT</span></td>';
                                    } elseif ($pengajuan['kepada'] == null && $role !== 'Tamu') {
                                        echo '<td>-</td>';
                                    } else {
                                        echo '<td>'.$pengajuan['kepada'] .'</td>';
                                    }
                                    ?>
                                    </td>
                                    <td><?= $pengajuan['created_at']; ?></td>

                                    <td class="<?php
                                            if ($pengajuan['status'] === 'Ditolak') {
                                                echo 'text-danger';
                                            } elseif ($pengajuan['status'] === 'Diterima') {
                                                echo 'text-success';
                                            } else {
                                                echo 'text-warning';
                                            }
                                            ?>">
                                        <i
                                            class="<?php
                                                if ($pengajuan['status'] === 'Ditolak') {
                                                    echo 'bx bx-x';
                                                } elseif ($pengajuan['status'] === 'Diterima') {
                                                    echo 'bi bi-check2';
                                                } elseif ($pengajuan['posisi'] === null) {
                                                    echo 'bi bi-clock';
                                                } else {
                                                    echo 'bi bi-arrow-repeat';
                                                }
                                                ?>"></i>&nbsp;<?= ($pengajuan['posisi'] == null ? 'Menunggu' : $pengajuan['status']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($pengajuan['posisi'] == null) {
                                            echo '<button type="button" style="width: 100px;"
                                                class="btn btn-sm btn-info text-light" disabled><i
                                                    class="bi bi-clock"></i></button>';
                                        } else {
                                            echo '<a href="index.php?page=detail-pengajuan&id='.$pengajuan['id'].'">
                                            <button type="button" style="width: 100px;"
                                                class="btn btn-sm btn-info text-light"><i
                                                    class="bi bi-eye-fill"></i>&nbsp;&nbsp;Lihat</button>
                                        </a>';
                                        }
                                        ?>
                                        <br>
                                        <?php
                                        if ($pengajuan['posisi'] == null) {
                                            echo '
                                            <button type="button" style="width: 100px;"
                                                    class="btn btn-sm btn-success mt-2" disabled><i
                                                        class="bi bi-clock"></i></button>
                                            ';
                                        } else {
                                            echo '
                                            <a href="index.php?page=lacak-surat&id='. $pengajuan['id'] .'">
                                                <button type="button" style="width: 100px;"
                                                    class="btn btn-sm btn-success mt-2"><i
                                                        class="bi bi-graph-up"></i>&nbsp;&nbsp;Lacak</button>
                                            </a>
                                            ';
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