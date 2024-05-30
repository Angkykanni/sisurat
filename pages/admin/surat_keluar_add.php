<style>
button.list-group-item.active-button {
    background-color: #012970;
    border-color: #012970;
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Pengajuan surat keluar</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan Surat</li>
                <li class="breadcrumb-item active">Ajukan Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" id="selected-surat-title">Pilih Jenis Surat</h5>
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action" aria-current="true"
                                data-bs-toggle="pill" data-bs-target="#aktif-belajar-form"
                                onclick="updateSelectedSuratTitle('Surat Aktif Belajar'); showPersyaratanTab('#aktif-belajar-form'); setButtonActive(this);">
                                Aktif Belajar
                            </button>
                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="pill"
                                data-bs-target="#pendampingan-siswa-form"
                                onclick="updateSelectedSuratTitle('Surat Pendampingan Siswa'); showPersyaratanTab('#pendampingan-siswa-form'); setButtonActive(this);">
                                Pendampingan Siswa
                            </button>
                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="pill"
                                data-bs-target="#arsip_surat_keluar"
                                onclick="updateSelectedSuratTitle('Arsip Surat Keluar'); showPersyaratanTab('#arsip_surat_keluar'); setButtonActive(this);">
                                Arsip Surat Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card" id="kartu-persyaratan" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title">Formulir surat keluar</h5>

                        <form class="row g-3" action="config/c_pengajuan.php" method="post"
                            enctype="multipart/form-data">
                            <input type="text" name="role" value="<?= $role ?>" hidden readonly>
                            <?php
                            if (isset($_SESSION['aktif_belajar_message'])) {
                                if ($_SESSION['aktif_belajar_message']) {
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Surat telah diajukan",
                                                    text: "Silahkan menunggu verifikasi surat dari staf surat dan pimpinan",
                                                    confirmButtonText: `<a href="index.php?page=pengajuan-surat" style="color: white;">OK</a>`
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Kesalahan',
                                                    text: 'Gagal mengajukan surat!',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['aktif_belajar_message']);
                            }
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="aktif-belajar-form">
                                    <div class="col-12">
                                        <label for="select_pengusul">Pengusul surat<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <select class="form-control mb-3" name="asal_surat" id="select_pengusul"
                                            required>
                                            <option value="" hidden selected disabled>Pilih pengusul surat</option>
                                            <?php
                                            foreach ($users as $user) {
                                                echo '<option value="'. $user['id_number'] .'">' . $user['nama'] . ' - '. $user['role'] .'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label>Keperluan Aktif Belajar<span class="text-danger">&nbsp;*</span></label>
                                        <input type="text" class="form-control mb-3" name="perihal"
                                            placeholder="Contoh: Keperluan BPJS" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="fileInputAktifBelajar" id="fileInputLabelAktifBelajar"
                                            class="custom-file-upload"><i class="bi bi-upload"></i>&nbsp;&nbsp;Unggah
                                            nilai semester sebelumnya</label>
                                        <input id="fileInputAktifBelajar" required type="file" name="file"
                                            accept="application/pdf" style="display: none;"
                                            onchange="updateFileNameAktifBelajar(this)">

                                        <br>
                                        <span style="font-size: 14px;" class="mb-4"><span
                                                class="text-danger">&nbsp;*</span> Wajib
                                            mengunggah nilai semester
                                            sebelumnya dengan format dokumen <strong>PDF</strong></span>
                                    </div>

                                    <input type="text" name="tipe_surat" value="1" hidden readonly>
                                    <input type="text" name="status" value="Dalam Proses" hidden readonly>

                                    <div class="text-start mt-4">
                                        <button type="submit" name="aktifBelajar" class="btn btn-success"><i
                                                class="ri-mail-send-line"></i>
                                            Ajukan</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form class="row g-3" action="config/c_pengajuan.php" method="post"
                            enctype="multipart/form-data">
                            <input type="text" name="role" value="<?= $role ?>" hidden readonly>
                            <?php
                            if (isset($_SESSION['pendampingan_siswa_message'])) {
                                if ($_SESSION['pendampingan_siswa_message']) {
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Surat telah diajukan",
                                                    text: "Silahkan menunggu verifikasi surat dari staf surat dan pimpinan",
                                                    confirmButtonText: `<a href="index.php?page=pengajuan-surat" style="color: white;">OK</a>`
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Kesalahan',
                                                    text: 'Gagal mengajukan surat!',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['pendampingan_siswa_message']);
                            }
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="pendampingan-siswa-form">
                                    <div class="col-12">
                                        <label>Kegiatan dan nama siswa<span class="text-danger">&nbsp;*</span></label>
                                        <!-- <input type="text" class="form-control mb-3" name="perihal"
                                            placeholder="Nama kegiatan untuk pendampingan siswa" required> -->
                                        <textarea name="perihal" class="form-control mb-3"
                                            placeholder="Nama kegiatan, nama siswa1; nama siswa2;" cols="30"
                                            rows="5"></textarea>

                                        <label>Tanggal Mulai<span class="text-danger">&nbsp;*</span></label>
                                        <input type="date" class="form-control mb-3" name="tanggal_mulai" required>

                                        <label>Tanggal Selesai<span class="text-danger">&nbsp;*</span></label>
                                        <input type="date" class="form-control mb-3" name="tanggal_selesai" required>

                                        <label for="fileInputPendampinganSiswa" id="fileInputLabelPendampinganSiswa"
                                            class="custom-file-upload"><i class="bi bi-upload"></i>&nbsp;&nbsp;Unggah
                                            berkas pendukung</label>
                                        <input id="fileInputPendampinganSiswa" type="file" name="file"
                                            style="display: none;" onchange="updateFileNamePendampinganSiswa(this)"
                                            required>

                                        <br>

                                        <span style="font-size: 14px;"><span class="text-danger">&nbsp;*</span> Wajib
                                            mengunggah berkas pendukung</span>

                                        <input type="text" name="tipe_surat" value="2" hidden readonly>
                                        <input type="text" name="asal_surat" value="<?= $id_number ?>" hidden readonly>
                                        <input type="text" name="status" value="Dalam Proses" hidden readonly>
                                    </div>

                                    <div class="text-start mt-4">
                                        <button type="submit" name="pendampingan_siswa" class="btn btn-success"><i
                                                class="ri-mail-send-line"></i>
                                            Ajukan</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form class="row g-3" action="config/c_add_surat.php" method="post"
                            enctype="multipart/form-data">
                            <?php
                            if (isset($_SESSION['arsip_surat_keluar'])) {
                                if ($_SESSION['arsip_surat_keluar']) {
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Surat keluar disimpan",
                                                    text: "Surat keluar telah disimpan ke arsip",
                                                    confirmButtonText: `<a href="index.php?page=keluarkan-surat" style="color: white;">OK</a>`
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Kesalahan',
                                                    text: 'Gagal menyimpan surat keluar',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['arsip_surat_keluar']);
                            }
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="arsip_surat_keluar">
                                    <div class="col-12">
                                        <label for="select_pengusul">Pengusul surat<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <select class="form-control mb-3" name="dari" id="select_pengusul" required>
                                            <option value="" hidden selected disabled>Pilih pengusul surat</option>
                                            <?php
                                            foreach ($users as $user) {
                                                echo '<option value="'. $user['id_number'] .'">' . $user['nama'] . ' - '. $user['role'] .'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="tipe_surat">Tipe surat <span
                                                class="text-danger">&nbsp;*</span></label>
                                        <select name="tipe_surat" id="tipe_surat" class="form-control mb-3" required>
                                            <option value="" disabled selected hidden>Pilih tipe surat</option>
                                            <?php
                                            foreach ($ts as $tipe_surat) {
                                                if ($tipe_surat['nama_tipe'] == 'Surat Masuk') {
                                                    echo '<option value="'. $tipe_surat['id'] .'" disabled>'. $tipe_surat['nama_tipe'] .'</option>';
                                                } else {
                                                    echo '<option value="'. $tipe_surat['id'] .'">'. $tipe_surat['nama_tipe'] .'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="perihal">Perihal<span class="text-danger">&nbsp;*<span></label>
                                        <textarea id="perihal" class="form-control mb-3" name="perihal"
                                            placeholder="Masukan perihal surat" required></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label for="tujuan_surat">Tujuan surat</label>
                                        <input type="text" id="tujuan_surat" class="form-control mb-3" name="kepada"
                                            placeholder="Tujuan surat (optional)">
                                    </div>

                                    <div class="col-12">
                                        <label for="nomor_surat">Nomor surat<span
                                                class="text-danger">&nbsp;*<span></label>
                                        <input type="text" id="nomor_surat" class="form-control mb-3" name="nomor_surat"
                                            placeholder="Masukan nomor surat" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="tanggal_surat">Tanggal surat<span
                                                class="text-danger">&nbsp;*<span></label>
                                        <input type="date" id="tanggal_surat" class="form-control mb-3"
                                            name="tanggal_surat" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="fileInputSuratLainnya" id="fileInputLabelSuratLainnya"
                                            class="custom-file-upload"><i class="bi bi-upload"></i>&nbsp;&nbsp;Unggah
                                            berkas surat</label>
                                        <input id="fileInputSuratLainnya" required type="file" name="file"
                                            style="display: none;" onchange="updateFileNameSuratLainnya(this)">

                                        <br>
                                        <span style="font-size: 14px;" class="mb-4"><span
                                                class="text-danger">&nbsp;*</span> Wajib
                                            mengunggah berkas surat</span>
                                    </div>

                                    <div class="text-start mt-4">
                                        <button type="submit" name="arsip_surat_keluar" class="btn btn-success"><i
                                                class="ri-mail-send-line"></i>
                                            Arsip surat</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function setButtonActive(clickedButton) {
    // Menghapus kelas 'active-button' dari semua tombol
    var buttons = document.querySelectorAll(".list-group-item");
    buttons.forEach(function(button) {
        button.classList.remove("active-button");
    });

    // Menambahkan kelas 'active-button' pada tombol yang ditekan
    clickedButton.classList.add("active-button");
}
</script>