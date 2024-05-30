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

                            $query_select_pengajuan_verifikasi = "SELECT v1.*
                                                                    FROM verifikasi v1
                                                                    JOIN (
                                                                        SELECT id_pengajuan
                                                                        FROM verifikasi
                                                                        WHERE id_pengajuan = '$id_pengajuan'
                                                                        GROUP BY id_pengajuan
                                                                        HAVING COUNT(DISTINCT status) > 1 AND COUNT(DISTINCT posisi) > 1
                                                                    ) AS v2 ON v1.id_pengajuan = v2.id_pengajuan;
                                                                    ";
                            $result_select_pengajuan_verifikasi = mysqli_query($conn, $query_select_pengajuan_verifikasi);

                            if ($result_select_pengajuan_surat && mysqli_num_rows($result_select_pengajuan_surat) > 0) {
                                if ($result_select_pengajuan_verifikasi) {
                                    $surat_pengajuan = mysqli_fetch_assoc($result_select_pengajuan_surat);
                                    $verifikasi_pengajuan = mysqli_fetch_assoc($result_select_pengajuan_verifikasi);
                                ?>
                        <h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">
                            <?= $surat_pengajuan['jenis_surat']; ?></h5>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <?php if ($surat_pengajuan['status'] == 'Dalam Proses' && $surat_pengajuan['posisi'] == null) { ?>
                                <h6 class="text-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</h6>
                                <?php   } elseif ($surat_pengajuan['status'] == 'Dalam Proses' && $surat_pengajuan['posisi'] !== null) { ?>
                                <h6 class="text-success mb-2" style="font-size: 16px;"><i class="bi bi-check"></i>&nbsp;
                                    Diterima</h6>

                                <?php   } else { ?>
                                <h6 class="text-danger mb-2" style="font-size: 16px;"><i class="bx bx-x"></i>&nbsp;
                                    Ditolak</h6>
                                <?php } ?>

                                <span class="card-text" style="font-weight: 600;">Staff Surat</span>
                                <br>
                                <span style="font-size: 13px"><?= $surat_pengajuan['created_at']; ?></span>
                                <br>

                                <?php
                                if ($verifikasi_pengajuan['keterangan'] !== null) {             
                                    echo '
                                    <span>Keterangan:
                                    <strong>'.$verifikasi_pengajuan['keterangan'].'</strong></span>
                                    ';
                                }
                                ?>
                            </div>
                            <div class="col-md-3 mt-3">
                                <?php if ($verifikasi_pengajuan['posisi'] == 'Wakasek Kurikulum') {
                                        if ($verifikasi_pengajuan['status'] == 'Dalam Proses') { ?>
                                <h6 class="text-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</h6>
                                <?php   } elseif ($verifikasi_pengajuan['status'] == 'Ditolak') { ?>
                                <h6 class="text-danger mb-2" style="font-size: 16px;"><i class="bx bx-x"></i>&nbsp;
                                    Ditolak</h6>

                                <?php   } else { ?>
                                <h6 class="text-success mb-2" style="font-size: 16px;"><i class="bi bi-check"></i>&nbsp;
                                    Diterima</h6>

                                <?php } ?>

                                <span class="card-text" style="font-weight: 600;">Wakasek Kurikulum</span>
                                <br>
                                <span style="font-size: 13px;"><?= $verifikasi_pengajuan['created_at']; ?></span>

                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-md-3 mt-3">
                                <?php if ($verifikasi_pengajuan['posisi'] == 'Kepala Sekolah') {
                                        if ($verifikasi_pengajuan['status'] == 'Dalam Proses') { ?>
                                <h6 class="text-warning mb-2" style="font-size: 16px;"><i
                                        class="bi bi-arrow-repeat"></i>&nbsp; Dalam Proses</h6>
                                <?php   } elseif ($verifikasi_pengajuan['status'] == 'Ditolak') { ?>
                                <h6 class="text-danger mb-2" style="font-size: 16px;"><i class="bx bx-x"></i>&nbsp;
                                    Ditolak</h6>

                                <?php   } else { ?>
                                <h6 class="text-success mb-2" style="font-size: 16px;"><i class="bi bi-check"></i>&nbsp;
                                    Diterima</h6>
                                <?php } ?>

                                <span class="card-text" style="font-weight: 600;">Kepala Sekolah</span>
                                <br>
                                <span style="font-size: 13px;"><?= $verifikasi_pengajuan['created_at']; ?></span>

                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-md-3 mt-3">
                                <?php if ($verifikasi_pengajuan['posisi'] == 'Kepala Sekolah' || $verifikasi_pengajuan['posisi'] == 'Wakasek Kurikulum') {
                                        if ($verifikasi_pengajuan['status'] == 'Diterima') { ?>
                                <h6 class="text-success mb-2" style="font-size: 16px;"><i class="bi bi-check"></i>&nbsp;
                                    Pengajuan surat telah disetujui</h6>
                                <span class="card-text" style="font-weight: 600;">Silahkan unduh surat di menu surat
                                    masuk!</span>
                                <br>
                                <span style="font-size: 13px;"><?= $verifikasi_pengajuan['created_at']; ?></span>
                                <?php } 
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            } else {
                                echo "Tidak ada id pengajuan di tabel verifikasi";
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