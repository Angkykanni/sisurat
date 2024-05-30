<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Verifikasi Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Pengajuan</li>
                <li class="breadcrumb-item active">Verifikasi Surat</li>
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

                        <?php
                        if ($surat_pengajuan['jenis_surat'] == 'Surat Masuk' && ($surat_pengajuan['nomor_surat'] !== null || $surat_pengajuan['nomor_surat'] == null)) {
                            echo '<h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;"><strong>Nomor Surat : ' . $surat_pengajuan['nomor_surat'] . '</strong></h5>';
                        } else {
                            echo '<h5 class="card-title" style="border-bottom: 1px solid #F6F9FF;">Data Pengajuan</h5>';
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tipe Surat</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $surat_pengajuan['jenis_surat']; ?></span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Pengususl</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $surat_pengajuan['pengusul_surat']; ?></span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Nomor Induk</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $surat_pengajuan['id_number']; ?></span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Perihal</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $surat_pengajuan['perihal']; ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tujuan</h6>
                                <span class="card-text" style="font-weight: 600;">
                                    <?php
                                        if ($surat_pengajuan['kepada'] == null && $surat_pengajuan['jenis_surat'] == 'Surat Masuk') {
                                            echo '<span class="text-danger">SURAT MASUK TIDAK ADA TUJUAN SURAT</span>';
                                        } elseif ($surat_pengajuan['kepada'] !== null) {
                                            echo $surat_pengajuan['kepada'];
                                        } elseif ($surat_pengajuan['kepada'] == null && $surat_pengajuan['jenis_surat'] !== 'Surat Masuk') {
                                            echo '-';
                                        }
                                    ?>
                                </span>
                            </div>

                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tanggal Mulai</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= ($surat_pengajuan['tanggal_mulai'] !== null ? $surat_pengajuan['tanggal_mulai'] : '-') ?></span>
                            </div>

                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tanggal Selesai</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= ($surat_pengajuan['tanggal_selesai'] !== null ? $surat_pengajuan['tanggal_selesai'] : '-') ?></span>
                            </div>

                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Tanggal Pengajuan</h6>
                                <span class="card-text"
                                    style="font-weight: 600;"><?= $surat_pengajuan['created_at']; ?></span>
                            </div>
                        </div>

                        <form action="config/c_verifikasi.php" id="form_verifikasi" method="post" class="row">
                            <!-- MASIH HARUS DI PERBAIKI UNTUK FILE WORD BISA DITAMPILKAN -->
                            <?php //if($role == 'Admin') : ?>
                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">
                                    <?= ($surat_pengajuan['jenis_surat'] == 'Surat Masuk' ? 'File Surat' : 'Persyaratan') ?>
                                </h6>
                                <button onclick="lihatDokumen(this)" type="button"
                                    data-src="assets/uploads/files/<?= $surat_pengajuan['file'] ?>"
                                    class="mt-1 btn btn-sm btn-info text-light"><i
                                        class="bi bi-file-earmark-text-fill"></i>&nbsp; Lihat Dokumen</button>
                            </div>

                            <?php //else : ?>
                            <!-- <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">File surat</h6>
                                <button onclick="lihatDokumen(this)" type="button"
                                    data-src="assets/uploads/surat/surat_aktif_belajar_nottd.php?nomor_surat= //urlencode($surat_pengajuan['nomor_surat']) "
                                    class="mt-1 btn btn-sm btn-info text-light"><i
                                        class="bi bi-file-earmark-text-fill"></i>&nbsp; Lihat Dokumen</button>
                            </div> -->
                            <?php //endif; ?>

                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Nomor Surat</h6>
                                <?php
                                if (($role === 'Admin' || $role !== 'Admin') && $surat_pengajuan['jenis_surat'] == 'Surat Masuk' && $surat_pengajuan['nomor_surat'] !== null) {
                                    echo '<input type="text" class="form-control" name="nomor_surat" id="input_nomor_surat" style="border: none; padding-left: 0px; padding-top: 0px; font-weight: 600;" value="'. $surat_pengajuan['nomor_surat'] .'" readonly>';
                                } elseif (($role === 'Admin' || $role !== 'Admin') && $surat_pengajuan['jenis_surat'] == 'Surat Masuk' && $surat_pengajuan['nomor_surat'] == null) {
                                    echo '<span class="card-text text-danger" style="font-weight: 600;">TIDAK ADA NOMOR SURAT</span>';
                                }elseif ($role === 'Admin' && $surat_pengajuan['jenis_surat'] !== 'Surat Masuk') {
                                    echo '<input type="text" class="form-control" name="nomor_surat" id="input_nomor_surat" placeholder="Masukan nomor surat">';
                                } elseif ($role !== 'Admin' && $surat_pengajuan['jenis_surat'] !== 'Surat Masuk') {
                                    echo '<span><strong>'. $surat_pengajuan['nomor_surat'] .'</strong></span> <input type="text" name="nomor_surat" value="'. $surat_pengajuan['nomor_surat'] .'" hidden>';
                                }
                                ?>
                            </div>

                            <div class="col-md-3 mt-3">
                                <h6 class="mb-0" style="font-size: 14px;">Verifikasi</h6>
                                <div class="d-flex justify-content-start mt-1">
                                    <input type="text" id="input_role" name="role" value="<?= $role ?>" hidden>
                                    <?php
                                    if ($role == "Admin"){
                                        echo '
                                        <button type="submit" id="btnTolakSurat" name="tolak_surat_admin" class="btn btn-sm btn-danger me-2"><i
                                            class="bi bi-x"></i>&nbsp; Tolak</button>
                                        ';
                                    } elseif ($role == "Wakasek Kurikulum"){
                                        echo '
                                        <button type="submit" id="btnTolakSurat" name="tolak_surat_wakasek" class="btn btn-sm btn-danger me-2"><i
                                            class="bi bi-x"></i>&nbsp; Tolak</button>
                                        ';
                                    }
                                    ?>

                                    <?php
                                        if (isset($_SESSION['posisi'])) {
                                            if ($_SESSION['posisi']) {
                                                echo '<script>
                                                window.onload = function() {
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Surat diteruskan!",
                                                    }).then(() => {
                                                        window.location.href = "index.php?page=pengajuan-surat";
                                                    });
                                                };
                                                </script>';
                                            } else {
                                                echo "<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Kesalahan',
                                                                text: 'Gagal meneruskan surat!',
                                                            });
                                                        };
                                                    </script>";
                                            }
                                            unset($_SESSION['posisi']);
                                        } elseif (isset($_SESSION['pengajuan_diterima'])) {
                                            if ($_SESSION['pengajuan_diterima']) {
                                                echo '<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                position: "center",
                                                                icon: "success",
                                                                title: "Surat diterima",
                                                                text: "Surat disimpan ke arsip!"
                                                            }).then(() => {
                                                                window.location.href = "index.php?page=pengajuan-surat";
                                                            });
                                                        };
                                                    </script>';
                                            } else {
                                                echo "<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Kesalahan',
                                                                text: 'Gagal verifikasi surat!',
                                                            });
                                                        };
                                                    </script>";
                                            }
                                            unset($_SESSION['pengajuan_diterima']);
                                        } elseif (isset($_SESSION['disposisi_ke_tujuan'])) {
                                            if ($_SESSION['disposisi_ke_tujuan']) {
                                                echo '<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                position: "center",
                                                                icon: "success",
                                                                title: "Surat didisposisi ke tujuan",
                                                                text: "Surat disimpan ke arsip!"
                                                            }).then(() => {
                                                                window.location.href = "index.php?page=pengajuan-surat";
                                                            });
                                                        };
                                                    </script>';
                                            } else {
                                                echo "<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Kesalahan',
                                                                text: 'Gagal disposisi surat!',
                                                            });
                                                        };
                                                    </script>";
                                            }
                                            unset($_SESSION['disposisi_ke_tujuan']);
                                        } elseif ((isset($_SESSION['tolak_pengajuan']))){
                                            if ($_SESSION['tolak_pengajuan']) {
                                                echo '<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                position: "center",
                                                                icon: "success",
                                                                title: "Surat Ditolak"
                                                            }).then(() => {
                                                                window.location.href = "index.php?page=pengajuan-surat";
                                                            });
                                                        };f
                                                    </script>';
                                            } else {
                                                echo "<script>
                                                        window.onload = function() {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Kesalahan',
                                                                text: 'Gagal tolak surat!',
                                                            });
                                                        };
                                                    </script>";
                                            }
                                            unset($_SESSION['tolak_pengajuan']);
                                        }
                                        ?>

                                    <input type="text" name="id_pengajuan" value="<?= $surat_pengajuan['id']; ?>"
                                        hidden>

                                    <?php if ($role == 'Admin') : ?>
                                    <span class="dropdown ms-2">
                                        <?= ($surat_pengajuan['nomor_surat'] == null && $surat_pengajuan['jenis_surat'] == 'Surat Masuk' ? '' : '<button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-check"></i>
                                            Verifikasi
                                        </button>') ?>

                                        <ul class="dropdown-menu">
                                            <li><button type="submit" id="admin_teruskan_wakasek"
                                                    name="posisi_kurikulum" class="dropdown-item text-warning"><i
                                                        class="bi bi-arrow-left-right"></i>&nbsp; Teruskan ke
                                                    Kurikulum</button></li>
                                            <li><button type="submit" id="admin_teruskan_kepsek"
                                                    name="posisi_kepala_sekolah" class="dropdown-item text-danger"><i
                                                        class="bi bi-arrow-left-right"></i>&nbsp; Teruskan ke
                                                    Kepala
                                                    Sekolah</button>
                                            </li>
                                        </ul>
                                    </span>

                                    <?php elseif ($role == 'Wakasek Kurikulum') : ?>
                                    <span class="dropdown ms-2">
                                        <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-check"></i>
                                            Verifikasi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button type="submit" id="wakasek_terima" name="pengajuan_diterima"
                                                    class="dropdown-item text-success"><i class="bi bi-check"></i>&nbsp;
                                                    Terima</button></li>
                                            <li><button type="submit" id="wakasek_teruskan_kepsek"
                                                    name="posisi_kepala_sekolah" class="dropdown-item text-warning"><i
                                                        class="bi bi-arrow-left-right"></i>&nbsp; Teruskan ke
                                                    Kepala
                                                    Sekolah</button>
                                            </li>
                                        </ul>
                                    </span>

                                    <?php elseif ($role == 'Kepala Sekolah' && $surat_pengajuan['jenis_surat'] !== 'Surat Masuk') : ?>
                                    <button type="submit" id="ttd_kepsek" name="pengajuan_diterima"
                                        class="btn btn-sm btn-success"><i class="ri-qr-code-fill"></i>&nbsp;
                                        Tanda tangan surat</button>
                                    <?php elseif ($role == 'Kepala Sekolah' && $surat_pengajuan['jenis_surat'] == 'Surat Masuk') : ?>
                                    <?php if($surat_pengajuan['kepada'] == 'Kepala Sekolah') : ?>
                                    <button type="submit" id="ttd_kepsek" name="pengajuan_diterima"
                                        class="btn btn-sm btn-success"><i class="bi bi-check"></i>&nbsp;
                                        Terima dan arsip</button>
                                    <?php else : ?>
                                    <button type="submit" id="btnDisposisi" name="disposisi_ke_tujuan"
                                        class="btn btn-sm btn-success"><i class="bi bi-arrow-left-right"></i>&nbsp;
                                        Disposisi ke <?= $surat_pengajuan['kepada'] ?></button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <?php if($surat_pengajuan['jenis_surat'] == 'Surat Masuk' && $role == 'Kepala Sekolah') : ?>
                                <h6 class="mb-0" style="font-size: 14px;">Keterangan Disposisi</h6>
                                <textarea class="form-control" name="disposisi" id="disposisiInput"></textarea>
                                <strong><span style="font-size: 12px;"><span class="text-danger">*</span>Abaikan jika
                                        tidak
                                        ada keterangan!</span></strong>
                                <?php else : ?>
                                <h6 class="mb-0" style="font-size: 14px;">Alasan Penolakan</h6>
                                <?= ($surat_pengajuan['nomor_surat'] == null ? '<textarea class="form-control" name="keterangan" id="keteranganInput">Tidak ada nomor surat, mohon ajukan ulang</textarea>'
                                : '<textarea class="form-control" name="keterangan" id="keteranganInput"></textarea>') ?>
                                <strong><span style="font-size: 12px;"><span class="text-danger">*</span>Abaikan jika
                                        tidak
                                        ditolak!</span></strong>
                                <?php endif; ?>
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
                        <h5 class="card-title">Tinjau Berkas</h5>
                        <div id="dokumenViewer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tangkap semua elemen dengan type="submit"
    var submitButtons = document.querySelectorAll(
        '#admin_teruskan_wakasek, #admin_teruskan_kepsek, #wakasek_terima, #wakasek_teruskan_kepsek, #ttd_kepsek'
    );

    // Tambahkan event listener untuk setiap tombol submit
    submitButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Tangkap nilai input nomor_surat
            var nomorSuratInput = document.querySelector('input[name="nomor_surat"]');

            // Cek apakah nilai input nomor_surat kosong
            if (nomorSuratInput.value.trim() === '') {
                // Jika kosong, mencegah proses selanjutnya
                event.preventDefault();
                // Tampilkan pesan kesalahan atau lakukan tindakan lain
                Swal.fire({
                    icon: "info",
                    title: "Harap masukan nomor surat"
                });
            }
        });
    });
});

document.getElementById('btnTolakSurat').addEventListener('click', function(event) {
    var keterangan_tolak = document.getElementById('keteranganInput');

    if (keterangan_tolak.value.trim() === '') {
        event.preventDefault();
        Swal.fire({
            icon: "info",
            title: "Harap masukkan alasan penolakan!"
        });
    }
});

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