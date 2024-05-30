<div class="card mb-3">
    <div class="card-body" style="min-width: 350px;">
        <div class="pt-2 mb-3" style="text-align:justify; margin-left: 5px; margin-right: 5px;">
            <?php
            if ($title == 'Registrasi Tamu') {
                echo '
                <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 600;">DAFTAR AKUN TAMU</h5>
                <span>Daftar akun tamu untuk pengunjung yang ingin mengirim surat ke SMA Negeri 12 tanpa harus mengantar surat fisik secara langsung</span>
                ';
            } else {
                echo '
                <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 600;">DAFTAR AKUN</h5>
                <span>Daftar akun internal untuk siswa dan tenaga kependidikan yang ingin mengajukan surat tanpa harus bertemu dengan staf administrasi dan pimpinan</span>
                ';
            }
            ?>
        </div>

        <form action="config/c_register.php" method="post" class="row g-3 needs-validation">
            <?php
            if (isset($_SESSION['registration_success'])) {
                if ($_SESSION['registration_success']) {
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Akun berhasil dibuat. Silahkan masuk!",
                                    confirmButtonText: `<a href="index.php?page=login" style="color: white;">OK</a>`
                                });
                            };
                        </script>';
                } else {
                    echo "<script>
                            window.onload = function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan',
                                    text: 'Gagal membuat akun. Silahkan coba beberapa saat lagi!
                                            Jika kesalahan terus terjadi, silahkan hubungi Admin.',
                                });
                            };
                        </script>";
                }
                unset($_SESSION['registration_success']);
            }

            if (isset($_SESSION['registration_error_message'])) {
                echo "<div class='alert alert-warning alert-dismissible fade show mt-2 mb-1' role='alert'>" 
                    . $_SESSION['registration_error_message'] .
                        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                unset($_SESSION['registration_error_message']);
            }
            ?>


            <?php
            if ($title === 'Registrasi Tamu') {
                echo "<input type='text' value='Tamu' name='role' hidden>";
            } else {
                echo '<div class="col-12 mb-0">
                <label class="form-label mb-0">Anda Sebagai?</label>
                <select name="role" id="roleSelect" class="form-control mb-3" required>
                    <option value="" selected disabled hidden>-- Pilih hak akses</option>
                    <option value="GTK">Guru dan Tenaga Pendidik</option>
                    <option value="Siswa">Siswa</option>
                </select>
            </div>';
            }
            ?>

            <div class="col-12 mb-0">
                <label
                    class="form-label mb-0"><?= ($title ?? '') === 'Registrasi Tamu' ? 'NIP/NIK' : 'NIP/NIS'; ?></label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-file-binary-fill"
                            style="color: #012970;"></i></span>
                    <input type="number" name="id_number" class="form-control"
                        placeholder="<?= ($title ?? '') === 'Registrasi Tamu' ? 'NIP/NIK anda' : 'NIP/NIS anda'; ?>"
                        required>
                    <div class="invalid-feedback">Mohon masukan NIP/NIS yang
                        valid!</div>
                </div>
            </div>

            <div class="col-12 mb-0">
                <label class="form-label mb-0">Nama Lengkap</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap anda" required>
                    <div class="invalid-feedback">Mohon masukan nama lengkap anda</div>
                </div>
            </div>

            <div class="col-12 mb-0" id="tempatTanggalLahir" style="display: none;">
                <label class="form-label mb-0">Tempat Tanggal Lahir</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-star-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="ttl" class="form-control" placeholder="Kupang, 30 Maret 2002" required>
                    <div class="invalid-feedback">Mohon masukan tempat dan tanggal lahir anda</div>
                </div>
            </div>

            <div class="col-12 mb-0" id="jenisKelamin" style="display: none;">
                <label class="form-label mb-0">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="Laki-laki"
                        checked>
                    <label class="form-check-label" for="gridRadios1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2"
                        value="Perempuan">
                    <label class="form-check-label" for="gridRadios2">
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="col-12 mb-0" id="kelas" style="display: none;">
                <label class="form-label mb-0">Kelas</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="kelas" class="form-control" placeholder="10 IPS 3" required>
                    <div class="invalid-feedback">Mohon masukan kelas anda</div>
                </div>
            </div>

            <div class="col-12 mb-0" id="namaOrangTua" style="display: none;">
                <label class="form-label mb-0">Nama Orang Tua/Wali</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-file-person-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="orangtua" class="form-control" placeholder="Masukan nama ayah/ibu/wali"
                        required>
                    <div class="invalid-feedback">Mohon masukan nama orang tua/wali anda</div>
                </div>
            </div>


            <?php 
            if ($title === 'Registrasi Tamu') {
                echo "<div class='col-12'>
                        <label class='form-label'>Instansi/Bidang</label>
                        <div class='input-group has-validation mb-2'>
                            <span class='input-group-text' id='inputGroupPrepend'><i class='bi bi-bank'
                                    style='color: #012970;'></i></span>
                            <input type='text' name='instansi' class='form-control' placeholder='Instansi/bidang anda' required>
                            <div class='invalid-feedback'>Mohon masukan instansi atau bidang anda</div>
                        </div>
                    </div>";
            } else {
                echo "<input type='text' name='instansi' value='SMA Negeri 12 Kota Kupang' hidden>";
            }
            ?>

            <div class="col-12 mb-0">
                <label class="form-label mb-0">Email</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-at"
                            style="color: #012970;"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email aktif anda" required>
                    <div class="invalid-feedback">Mohon masukan email yang valid!</div>
                </div>
            </div>

            <div class="col-12 mb-0">
                <label class="form-label mb-0">Password</label>
                <div class="input-group has-validation mt-0 mb-2">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password anda" required>
                    <div class="invalid-feedback">Mohon masukan password!</div>
                </div>
            </div>

            <div class="col-12 mb-0">
                <button class="btn w-100 text-light" type="submit" name="register"
                    style="border-radius: 5px; background-color: #012970;">Daftar Akun</button>
            </div>
        </form>

        <div class="col-12 text-center mt-2" style="font-size: small;">
            <p class="mb-0">Sudah punya akun? <a style="color: #012970;" href="index.php?page=login">Masuk</a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var roleSelect = document.getElementById("roleSelect");
    var tempatTanggalLahir = document.getElementById("tempatTanggalLahir");
    var jenisKelamin = document.getElementById("jenisKelamin");
    var namaOrangTua = document.getElementById("namaOrangTua");
    var kelas = document.getElementById("kelas");

    roleSelect.addEventListener("change", function() {
        var selectedRole = roleSelect.value;
        if (selectedRole === "Siswa") {
            tempatTanggalLahir.style.display = "block";
            jenisKelamin.style.display = "block";
            namaOrangTua.style.display = "block";
            kelas.style.display = "block";
        } else {
            tempatTanggalLahir.style.display = "none";
            jenisKelamin.style.display = "none";
            namaOrangTua.style.display = "none";
            kelas.style.display = "none";
        }
    });

    // Trigger the change event to check default value on page load
    var event = new Event('change');
    roleSelect.dispatchEvent(event);
});
</script>