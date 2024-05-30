<div class="card mb-3">

    <div class="card-body">

        <div class="pt-2 pb-2">
            <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 600;">LUPA KATA SANDI
            </h5>
            <p class="small text-justify">Masukkan NIP/NIS dan Email anda untuk dapat mengatur ulang kata sandi. Jika
                ada kendala dalam mengatur ulang kata sandi anda, anda dapat menghubungi Staf Surat.</p>
        </div>

        <form action="config/c_forgot_password.php" method="post" class="row g-3">
            <?php
            if (isset($_SESSION['password_reset_message'])) {
                if ($_SESSION['password_reset_message']) {
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Kata sandi berhasil diatur ulang. Silahkan masuk!",
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
                                    text: 'Gagal mengatur ulang kata sandi',
                                });
                            };
                        </script>";
                }
                unset($_SESSION['password_reset_message']);
            }

            if (isset($_SESSION['password_not_match'])) {
                if ($_SESSION['password_not_match']) {
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Gagal!",
                                    text: "Kata sandi tidak sama!"
                                });
                            };
                        </script>';
                }
                unset($_SESSION['password_not_match']);
            }

            if (isset($_SESSION['idNumber_not_found'])) {
                if ($_SESSION['idNumber_not_found']) {
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Gagal!",
                                    text: "NIP/NIS yang anda masukan tidak terdaftar"
                                });
                            };
                        </script>';
                }
                unset($_SESSION['idNumber_not_found']);
            }

            if (isset($_SESSION['email_not_found'])) {
                if ($_SESSION['email_not_found']) {
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Gagal!",
                                    text: "Email yang anda masukan salah!"
                                });
                            };
                        </script>';
                }
                unset($_SESSION['email_not_found']);
            }
            ?>

            <div class="col-12">
                <label class="form-label mb-0">NIP/NIS/NIK</label>
                <div class="input-group has-validation">
                    <span class="input-group-text mb-2" id="inputGroupPrepend"><i class="bi bi-file-binary"
                            style="color: #012970;"></i></span>
                    <input type="number" name="id_number" class="form-control mb-2" placeholder="NIP/NIS/NIK anda"
                        required>
                    <div class="invalid-feedback">Mohon masukan NIP/NIS/NIK anda</div>
                </div>

                <label class="form-label mb-0">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text mb-2" id="inputGroupPrepend"><i class="bi bi-at"
                            style="color: #012970;"></i></span>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email anda" required>
                    <div class="invalid-feedback">Mohon masukan email!</div>
                </div>

                <label class="form-label mb-0">Kata sandi baru</label>
                <div class="input-group has-validation">
                    <span class="input-group-text mb-2" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Kata sandi baru anda"
                        required>
                    <div class="invalid-feedback">Mohon kata sandi Baru email!</div>
                </div>

                <label class="form-label mb-0">Konfirmasi kata sandi baru</label>
                <div class="input-group has-validation">
                    <span class="input-group-text mb-2" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="repassword" class="form-control mb-2" placeholder="Ulangi kata sandi"
                        required>
                    <div class="invalid-feedback">Mohon konfirmasi kata sandi!</div>
                </div>
            </div>

            <div class="col-12">
                <button class="btn w-100 text-light" type="submit"
                    style="border-radius: 5px; background-color: #012970;"><i class="bi bi-key"></i>&nbsp;
                    Atur Ulang Kata Sandi</button>
            </div>
        </form>

        <div class="col-12 text-center mt-2" style="font-size: small;">
            <p class="mb-0">Kembali ke halaman <a style="color: #012970;" href="index.php?page=login"> login</a> akun
            </p>
        </div>
    </div>
</div>