<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Detail Pengajuan</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan</li>
                <li class="breadcrumb-item active">Detail Pengajuan</li>
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
                            $query = "SELECT 
                                        pengajuan.*, 
                                        tipe_surat.nama_tipe AS jenis_surat, 
                                        users.nama AS pengusul_surat, 
                                        users.id_number
                                    FROM 
                                        pengajuan
                                        JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                                        JOIN users ON pengajuan.asal_surat = users.id_number
                                    WHERE 
                                        pengajuan.id = $id_pengajuan;
                                    ";
                            $result = mysqli_query($conn, $query);

                            $query_select_pengajuan_verifikasi = "SELECT * FROM verifikasi WHERE id_pengajuan = $id_pengajuan AND status = 'Ditolak'";
                            $result_select_pengajuan_verifikasi = mysqli_query($conn, $query_select_pengajuan_verifikasi);

                            $query_get_disposisi = "SELECT * FROM verifikasi WHERE id_pengajuan = $id_pengajuan AND disposisi IS NOT NULL";
                            $result_get_disposisi = mysqli_query($conn, $query_get_disposisi);
                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Jika data surat ditemukan, tampilkan detailnya
                                $detail_pengajuan = mysqli_fetch_assoc($result);
                                ?>

                        <h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">
                            <?= ($detail_pengajuan['tipe_surat'] == 4 ? '<strong>Nomor Surat : ' . $detail_pengajuan['nomor_surat'] . '<strong>': 'Data Pengajuan') ?>
                        </h5>
                        <div class="row mt-2">
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tipe Surat</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $detail_pengajuan['jenis_surat']; ?></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Pengusul</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $detail_pengajuan['pengusul_surat']; ?></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Nomor Induk</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $detail_pengajuan['id_number']; ?></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tanggal Pengajuan</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $detail_pengajuan['created_at']; ?></span>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tujuan Surat</h6>
                                <?php
                                if ($detail_pengajuan['kepada'] == null && $detail_pengajuan['tipe_surat'] == 4) {
                                    echo '<span class="card-text text-danger" style="font-weight: 600;">TIDAK ADA TUJUAN SURAT</span>';
                                } elseif ($detail_pengajuan['kepada'] == null && $detail_pengajuan['tipe_surat'] !== 4) {
                                    echo '<span class="card-text" style="font-weight: 600;">-</span>';
                                } else {
                                    echo $detail_pengajuan['kepada'];
                                }
                                ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Perihal</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $detail_pengajuan['perihal']; ?></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Status</h6>
                                <span
                                    class="card-text <?= ($detail_pengajuan['status'] === 'Dalam Proses') ? 'text-warning' : (($detail_pengajuan['status'] === 'Diterima') ? 'text-success' : 'text-danger') ?>"
                                    style="font-weight: 600;"><?= ($detail_pengajuan['posisi'] !== null) ? ($detail_pengajuan['status'] == 'Diterima' && $detail_pengajuan['tipe_surat'] == 4 && $detail_pengajuan['posisi'] == 'Kepala Sekolah' ? 'Didisposisi' : $detail_pengajuan['status'])  : 'Belum diperiksa' ?>
                                    oleh
                                    <?php 
                                    if ($detail_pengajuan['posisi'] == "Admin" || $detail_pengajuan['posisi'] == null) {
                                        echo 'Staf Surat';
                                    } else {
                                        echo $detail_pengajuan['posisi']; 
                                    }
                                    ?></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">
                                    <?= ($detail_pengajuan['jenis_surat'] == 'Surat Masuk') ? 'File Surat' : 'Persyaratan' ?>
                                </h6>
                                <button onclick="lihatDokumen(this)" type="button"
                                    data-src="assets/uploads/files/<?= $detail_pengajuan['file'] ?>"
                                    class="mt-1 btn btn-sm btn-info text-light"><i
                                        class="bi bi-file-earmark-text-fill"></i>&nbsp; Lihat Dokumen</button>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 mb-3">
                                <h6 class="mb-0" style="font-size: 14px;">Keterangan</h6>
                                <?php
                                if ($result_select_pengajuan_verifikasi && mysqli_num_rows($result_select_pengajuan_verifikasi) > 0) {
                                    $get_keterangan = mysqli_fetch_assoc($result_select_pengajuan_verifikasi);
                                    echo '<span class="card-text text-danger" style="font-weight: 600;">' . htmlspecialchars($get_keterangan['keterangan']) . '</span>';
                                } elseif ($result_get_disposisi && mysqli_num_rows($result_get_disposisi) > 0) {
                                    $get_disposisi = mysqli_fetch_assoc($result_get_disposisi);
                                    if (isset($detail_pengajuan['tipe_surat']) && $detail_pengajuan['tipe_surat'] == 4) {
                                        echo '<span class="card-text text-success" style="font-weight: 600;">' . htmlspecialchars($get_disposisi['disposisi']) . '</span>';
                                    }
                                } else {
                                    echo '<span class="card-text" style="font-weight: 600;"><i>Tidak ada keterangan</i></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            } else {
                                echo '<div style="margin-top: 20px"><strong class="text-center text-danger">Surat tidak ditemukan, silahkan kembali.</strong></div>';
                            }
                        } else {
                            echo '<strong class="text-center text-danger" style="margin-top: 30px">ID surat tidak ditemukan, silahkan kembali.</strong>';
                        }
                        ?>
                    </div>
                </div>

                <div id="dokumenCard" class="card" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title">Dokumen Persyaratan</h5>
                        <div id="dokumenViewer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function lihatDokumen(button) {
    var path = button.getAttribute("data-src");
    var ext = path.split('.').pop().toLowerCase();
    var dokumenViewer = document.getElementById("dokumenViewer");
    dokumenViewer.innerHTML = "";

    if (ext === 'pdf') {
        var embedTag = document.createElement('embed');
        embedTag.setAttribute('type', 'application/pdf');
        embedTag.setAttribute('src', path);
        embedTag.setAttribute('width', '100%');
        embedTag.setAttribute('height', '1000px');
        dokumenViewer.appendChild(embedTag);
    } else if (ext === 'jpg' || ext === 'jpeg' || ext === 'png') {
        var imgTag = document.createElement('img');
        imgTag.setAttribute('src', path);
        imgTag.setAttribute('width', '100%');
        dokumenViewer.appendChild(imgTag);
    } else {
        dokumenViewer.innerHTML = "Format file tidak didukung. Ekstensi file: " + ext;
    }
    document.getElementById("dokumenCard").style.display = "block";
}
</script>