<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Keluarkan Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan</li>
                <li class="breadcrumb-item active">Keluarkan Surat</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">Data Pengajuan</h5>
                        <!-- <h2></h2> -->
                        <?php
                        if (isset($_GET['id'])) {
                            // Ambil ID surat dari URL
                            $id_pengajuan = $_GET['id'];

                            // Query untuk mengambil data surat berdasarkan ID, termasuk tipe surat dan asal surat
                            $query = "SELECT pengajuan.*, tipe_surat.nama_tipe AS jenis_surat, users.nama AS pengusul_surat, users.id_number
                                        FROM pengajuan
                                        JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                                        JOIN users ON pengajuan.asal_surat = users.id_number
                                        WHERE pengajuan.id = $id_pengajuan";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                // Jika data surat ditemukan, tampilkan detailnya
                                $surat_pengajuan = mysqli_fetch_assoc($result);
                                ?>
                        <form action="config/c_nomor_surat.php" method="post">

                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Tipe Surat</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= $surat_pengajuan['jenis_surat']; ?></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Asal Surat</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= $surat_pengajuan['pengusul_surat']; ?></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Nomor Induk</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= $surat_pengajuan['id_number']; ?></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Keperluan</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= $surat_pengajuan['perihal']; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Tujuan</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= ($surat_pengajuan['kepada'] !== null) ? $surat_pengajuan['kepada'] : '-'; ?></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Tanggal Mulai</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= ($surat_pengajuan['tanggal_mulai'] !== null) ? $surat_pengajuan['tanggal_mulai'] : '-'; ?></span>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Tanggal Selesai</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= ($surat_pengajuan['tanggal_selesai'] !== null) ? $surat_pengajuan['tanggal_selesai'] : '-'; ?></span>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Tanggal Pengajuan</h6>
                                    <span class="card-text"
                                        style="font-weight: 600;"><?= $surat_pengajuan['created_at']; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Persyaratan</h6>
                                    <button onclick="lihatDokumen(this)" type="button"
                                        data-src="assets/uploads/files/<?= $surat_pengajuan['file'] ?>"
                                        class="mt-1 btn btn-sm btn-info text-light"><i
                                            class="bi bi-file-earmark-text-fill"></i>&nbsp; Lihat Dokumen</button></a>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <h6 class="mb-0" style="font-size: 14px;">Nomor Surat</h6>
                                    <div class="mt-1">
                                        <input type="text" name="id_pengajuan" value="<?= $surat_pengajuan['id']; ?>"
                                            hidden>
                                        <input type="text" name="nomor_surat" class="form-control"
                                            placeholder="Masukan nomor surat" required autofocus>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <div class="text-start">
                                        <button type="submit" class="btn btn-success" style="margin-top: 20px;"
                                            name="keluarkan_surat"><i class="ri-mail-send-line"></i>&nbsp;
                                            Keluarkan Surat</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php
                            } else {
                                echo "Surat tidak ditemukan.";
                            }
                        } else {
                            echo "ID surat tidak ditemukan.";
                        }
                        ?>

                    </div>
                </div>

                <div id="dokumenCard" class="card" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title">Tinjau Persyaratan</h5>
                        <div id="dokumenViewer"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">Data Pengajuan</h5>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tipe Surat</h6>
                                <span class="card-text" style="font-weight: 600;">pendampingan_siswa</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Asal Surat</h6>
                                <span class="card-text" style="font-weight: 600;">nama_pengusul</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Nomor Induk</h6>
                                <span class="card-text" style="font-weight: 600;">id_number</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tanggal Pengajuan</h6>
                                <span class="card-text" style="font-weight: 600;">tanggal_pengajuan</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Kegiatan</h6>
                                <span class="card-text" style="font-weight: 600;">kegiatan</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Nama Siswa</h6>
                                <span class="card-text" style="font-weight: 600;">nama_siswa</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Bukti Kegiatan</h6>
                                <a href=""><button type="button" class="mt-1 btn btn-sm btn-info text-light"><i
                                            class="bi bi-file-earmark-text-fill"></i>&nbsp; Lihat Dokumen</button></a>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Verifikasi</h6>
                                <div class="mt-1">
                                    <button type="button" name="tolak" class="btn btn-sm btn-danger"><i
                                            class="bi bi-x"></i>&nbsp; Tolak</button>
                                    <button type="button" name="terima" class="ms-1 btn btn-sm btn-success"><i
                                            class="bi bi-check"></i>&nbsp; Terima</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
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