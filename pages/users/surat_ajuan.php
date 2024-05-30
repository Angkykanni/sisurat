<style>
button.list-group-item.active-button {
    background-color: #012970;
    border-color: #012970;
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Buat Pengajuan Surat</h1>
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
                                data-bs-target="#surat-masuk-form"
                                onclick="updateSelectedSuratTitle('Surat Masuk'); showPersyaratanTab('#surat-masuk-form'); setButtonActive(this);">
                                Surat Masuk
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card" id="kartu-persyaratan" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title">Formulir Pengajuan Surat</h5>

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
                                                    confirmButtonText: `<a href="index.php?page=list-pengajuan-user" style="color: white;">OK</a>`
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
                                        <span style="font-size: 14px;"><span class="text-danger">&nbsp;*</span>
                                            Wajib
                                            mengunggah nilai semester
                                            sebelumnya dengan format dokumen <strong>PDF</strong></span>
                                    </div>

                                    <input type="text" name="tipe_surat" value="1" hidden>
                                    <input type="text" name="asal_surat" value="<?= $users[0]['id_number']; ?>" hidden>

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
                                                    confirmButtonText: `<a href="index.php?page=list-pengajuan-user" style="color: white;">OK</a>`
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

                                        <span style="font-size: 14px;"><span class="text-danger">&nbsp;*</span>
                                            Wajib
                                            mengunggah berkas pendukung</span>

                                        <input type="text" name="tipe_surat" value="2" hidden>
                                        <input type="text" name="asal_surat" value="<?= $users[0]['id_number']; ?>"
                                            hidden>
                                    </div>

                                    <div class="text-start mt-4">
                                        <button type="submit" name="pendampingan_siswa" class="btn btn-success"><i
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
                            if (isset($_SESSION['surat_masuk_message'])) {
                                if ($_SESSION['surat_masuk_message']) {
                                    echo '<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Surat telah diajukan",
                                                    text: "Silahkan menunggu verifikasi surat masuk dari staf surat",
                                                    confirmButtonText: `<a href="index.php?page=list-pengajuan-user" style="color: white;">OK</a>`
                                                });
                                            };
                                        </script>';
                                } else {
                                    echo "<script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagak mengajukan surat',
                                                    text: 'Periksa ulang formulir anda!',
                                                });
                                            };
                                        </script>";
                                }
                                unset($_SESSION['surat_masuk_message']);
                            }
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="surat-masuk-form">
                                    <div class="col-12">
                                        <label for="nomor_surat">Nomor surat<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <input id="nomor_surat" type="text" class="form-control mb-3" name="nomor_surat"
                                            placeholder="Masukan nomor surat" required>

                                        <label for="perihal">Perihal<span class="text-danger">&nbsp;*</span></label>
                                        <textarea id="perihal" name="perihal" class="form-control mb-3"
                                            placeholder="Perihal surat masuk" cols="30" rows="2" required></textarea>

                                        <label for="kepada">Untuk<span class="text-danger">&nbsp;*</span></label>
                                        <select name="kepada" id="kepada" class="form-control mb-3">
                                            <option hidden selected disabled>Pilih tujuan surat</option>
                                            <?php
                                            $get_GTK = "SELECT * FROM users WHERE role IN ('Kepala Sekolah', 'Wakasek Kurikulum', 'Admin', 'GTK') ORDER BY FIELD(role, 'Kepala Sekolah', 'Wakasek Kurikulum', 'Admin', 'GTK')";
                                            $result_get_GTK = mysqli_query($conn, $get_GTK);

                                            while ($tujuan_surat = mysqli_fetch_array($result_get_GTK)) {
                                                ?>
                                            <option value="<?= htmlspecialchars($tujuan_surat['nama']); ?>">
                                                <?= htmlspecialchars($tujuan_surat['nama']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <label for="keterangan">Keperluan<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <textarea id="keterangan" name="keterangan" class="form-control mb-3" cols="30"
                                            rows="2" required></textarea>

                                        <label for="fileInputSuratMasuk" id="fileInputLabelSuratMasuk"
                                            class="custom-file-upload"><i class="bi bi-upload"></i>&nbsp;&nbsp;Unggah
                                            file surat</label>
                                        <input id="fileInputSuratMasuk" type="file" name="file" accept="application/pdf"
                                            style="display: none;" onchange="updateFileNameSuratMasuk(this)" required>

                                        <br>

                                        <span style="font-size: 14px;"><span class="text-danger">&nbsp;*</span>
                                            Wajib
                                            mengunggah file surat masuk format <strong>.PDF</strong></span>

                                        <input type="text" name="asal_surat" value=" <?= $users[0]['id_number']; ?>"
                                            hidden>
                                        <!-- <input type="text" name="tipe_surat" value="4" hidden> -->
                                        <!-- <input type="text" name="status" value="Dalam Proses" hidden> -->
                                    </div>

                                    <div class="text-start mt-4">
                                        <button type="submit" name="surat_masuk" class="btn btn-success"><i
                                                class="ri-mail-send-line"></i>
                                            Ajukan</button>
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