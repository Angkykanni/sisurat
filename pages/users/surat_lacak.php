<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Lacak Pengajuan Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan Surat</li>
                <li class="breadcrumb-item active">Lacak Surat</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                    if (isset($_GET['id'])) {
                        // Ambil ID surat dari URL
                        $id_pengajuan = $_GET['id'];

                        // Query untuk mengambil data surat berdasarkan ID, termasuk tipe surat dan asal surat
                        $query_select_pengajuan_surat = "SELECT pengajuan.*, tipe_surat.nama_tipe AS jenis_surat, users.nama AS pengusul_surat, users.id_number
                                    FROM pengajuan
                                    JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                                    JOIN users ON pengajuan.asal_surat = users.id_number
                                    WHERE pengajuan.id = $id_pengajuan";
                        $result_select_pengajuan_surat = mysqli_query($conn, $query_select_pengajuan_surat);

                        // Query untuk mengambil data verifikasi berdasarkan id_pengajuan
                        $query_select_pengajuan_verifikasi = "SELECT * FROM verifikasi WHERE id_pengajuan = $id_pengajuan";
                        $result_select_pengajuan_verifikasi = mysqli_query($conn, $query_select_pengajuan_verifikasi);

                        if ($result_select_pengajuan_surat && mysqli_num_rows($result_select_pengajuan_surat) > 0) {
                            if ($result_select_pengajuan_verifikasi && mysqli_num_rows($result_select_pengajuan_verifikasi) > 0) {
                                $surat_pengajuan = mysqli_fetch_assoc($result_select_pengajuan_surat);
                    ?>
                        <h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">
                            <?= $surat_pengajuan['jenis_surat']; ?>
                        </h5>
                        <div class="row">
                            <?php
                                while ($verifikasi_pengajuan = mysqli_fetch_assoc($result_select_pengajuan_verifikasi)) {
                                    ?>
                            <div class="col-md-4 mt-3">
                                <?php if ($verifikasi_pengajuan['status'] == 'Dalam Proses' && $verifikasi_pengajuan['posisi'] == 'Admin') { ?>
                                <span style="font-size: 12px;" class="badge bg-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Staff Surat</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Diterima' && $verifikasi_pengajuan['posisi'] == 'Admin') { ?>
                                <span style="font-size: 12px;" class="badge bg-success mb-2" style="font-size: 16px;"><i
                                        class="bi bi-check"></i>&nbsp;
                                    Diterima</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Staff Surat</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Ditolak' && $verifikasi_pengajuan['posisi'] == 'Admin') { ?>
                                <span style="font-size: 12px;" class="badge bg-danger mb-2" style="font-size: 16px;"><i
                                        class="bx bx-x"></i>&nbsp;
                                    Ditolak</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Staff Surat</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>
                                <?php } ?>

                                <?php if ($verifikasi_pengajuan['status'] == 'Dalam Proses' && $verifikasi_pengajuan['posisi'] == 'Wakasek Kurikulum') { ?>
                                <span style="font-size: 12px;" class="badge bg-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Wakasek Kurikulum</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Diterima' && $verifikasi_pengajuan['posisi'] == 'Wakasek Kurikulum') { ?>
                                <span style="font-size: 12px;" class="badge bg-success mb-2" style="font-size: 16px;"><i
                                        class="bi bi-check"></i>&nbsp;
                                    Diterima</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Wakasek Kurikulum</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Ditolak' && $verifikasi_pengajuan['posisi'] == 'Wakasek Kurikulum') { ?>
                                <span style="font-size: 12px;" class="badge bg-danger mb-2" style="font-size: 16px;"><i
                                        class="bx bx-x"></i>&nbsp;
                                    Ditolak</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Wakasek Kurikulum</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>
                                <?php } ?>

                                <?php if ($verifikasi_pengajuan['status'] == 'Dalam Proses' && $verifikasi_pengajuan['posisi'] == 'Kepala Sekolah') { ?>
                                <span style="font-size: 12px;" class="badge bg-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Kepala Sekolah</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Diterima' && $verifikasi_pengajuan['posisi'] == 'Kepala Sekolah') { ?>
                                <span style="font-size: 12px;" class="badge bg-success mb-2" style="font-size: 16px;"><i
                                        class="bi bi-check"></i>&nbsp;
                                    Diterima</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Kepala Sekolah</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>

                                <?php } elseif ($verifikasi_pengajuan['status'] == 'Ditolak' && $verifikasi_pengajuan['posisi'] == 'Kepala Sekolah') { ?>
                                <span style="font-size: 12px;" class="badge bg-danger mb-2" style="font-size: 16px;"><i
                                        class="bx bx-x"></i>&nbsp;
                                    Ditolak</span>
                                <br>
                                <span class="card-text" style="font-weight: 600;">Kepala Sekolah</span><br>
                                <span style="font-size: 13px"><?= $verifikasi_pengajuan['created_at']; ?></span><br>
                                <?php if ($verifikasi_pengajuan['keterangan'] !== null && $verifikasi_pengajuan['keterangan'] !== '-') { ?>
                                <span>Keterangan: <strong><?= $verifikasi_pengajuan['keterangan']; ?></strong></span>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <?php
                                }
                    ?>
                        </div>
                        <?php
                            } else {
                                echo 'Tidak ada data verifikasi untuk id_pengajuan ini';
                                echo 'Error:'. mysqli_error($conn);
                                exit;
                            }
                        } else {
                            echo "Tidak ada surat pengajuan di tabel pengajuan";
                            echo 'Error:'. mysqli_error($conn);
                            exit;
                        }
                    } else {
                        echo "Tidak ada ID pengajuan yang dikirim";
                        echo 'Error:'. mysqli_error($conn);
                        exit;
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>