<style>
@media screen and (max-width: 768px) {
    #pdfViewer embed {
        width: 100%;
        height: 500px;
    }
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Pengaturan Sistem</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item active">Sistem</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="config/c_add_surat.php" method="post" enctype="multipart/form-data">

                            <?php
                            if (isset($_SESSION['arsip_surat'])) {
                                if ($_SESSION['arsip_surat']) {
                                    $message = "";
                                    if ($role == 'Tamu') {
                                        $message = "Surat telah dikirim";
                                        $redirect = "masukan-surat";
                                    } else {
                                        $message = "Surat disimpan ke arsip";
                                        $redirect = "tambah-surat-masuk";
                                    }
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "' . $message . '",
                                                }).then(() => {
                                                    window.location.href = "index.php?page='. $redirect .'";
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Kesalahan',
                                                    text: 'Gagal ";
                                    if ($role == 'Tamu') {
                                        echo "kirim surat";
                                    } else {
                                        echo "tambah surat masuk";
                                    }
                                    echo "!',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['arsip_surat']);
                            }
                            ?>

                            <div class="row mb-3 mt-4">
                                <label for="nomorSurat" class="form-label">Nomor</label>
                                <div class="col-sm-12">
                                    <input type="text" id="nomorSurat" class="form-control" name="nomor_surat"
                                        placeholder="Nomor surat" autofocus required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <div class="col-sm-12">
                                    <input type="text" id="perihal" class="form-control" name="perihal"
                                        placeholder="Perihal" required>
                                </div>
                            </div>
                            <?php if ($role == 'Tamu') : ?>
                            <div class="row mb-3">
                                <label for="dari" class="form-label">Dari</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="dari" name="instansi"
                                        value="<?= $users[0]['instansi']; ?>" readonly>
                                </div>
                            </div>

                            <?php else: ?>
                            <div class="row mb-3">
                                <label for="dari" class="form-label">Dari</label>
                                <div class="col-sm-12">
                                    <input type="text" id="dari" class="form-control" name="instansi"
                                        placeholder="Asal surat" required>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="row mb-3">
                                <label for="kepada" class="form-label">Kepada</label>
                                <div class="col-sm-12">
                                    <input type="text" id="kepada" class="form-control" name="kepada"
                                        placeholder="Tujuan surat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggalSurat" class="form-label">Tanggal Surat</label>
                                <div class="col-sm-6">
                                    <input type="date" id="tanggalSurat" class="form-control" name="tanggal_surat"
                                        required>
                                </div>
                            </div>

                            <label for="pdf-file" id="fileInputLabelSuratMasuk" class="custom-file-upload mb-2"><i
                                    class="bi bi-upload"></i>&nbsp;&nbsp;Unggah berkas surat</label>
                            <input id="pdf-file" type="file" name="file" accept=".pdf" style="display: none;"
                                onchange="updateFileNameSuratMasuk(this)" required>
                            <br>
                            <span style="font-size: 14px;"><span class="text-danger">*</span> Wajib
                                mengunggah file surat masuk yang sudah di-scann PDF</span>

                            <input type="text" name="status"
                                value="<?= ($role) === 'Tamu' ? 'Dalam Proses' : 'Diterima' ?>" hidden>

                            <div class="text-start mt-4">
                                <button type="reset" class="btn btn-secondary"><i
                                        class="bi bi-x"></i>&nbsp;Reset</button>
                                <button type="submit" class="btn btn-success" name="arsipkan"><i
                                        class="<?= ($role) === 'Tamu' ? 'ri-mail-download-line' : 'bi bi-archive-fill' ?>"></i>&nbsp;<?= ($role) === 'Tamu' ? 'Masukan Surat' : 'Arsipkan' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" id="pdfPreviewCard" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title">Preview Surat Masuk</h5>
                        <div id="pdfViewer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>