<div class="card mb-3">
    <div class="card-body">
        <div class="pt-2 pb-2">
            <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 600;">SISURAT
                SMAN 12 KUPANG
            </h5>
            <p class="text-center">Sistem Informasi Surat Menyurat SMA Negeri 12
                Kupang</p>
        </div>

        <form action="config/c_login.php" method="post" class="row g-3 needs-validation">
            <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php echo $_SESSION['login_error']; ?>
            </div>
            <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <div class="col-12">
                <label class="form-label">NIP/NIS/Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="id_number" class="form-control" placeholder="NIP/NIS/Email anda" required>
                    <div class="invalid-feedback">Mohon masukan NIP/NISN/Email yang
                        terdaftar!</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Kata sandi</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Kata sandi anda" required>
                    <div class="invalid-feedback">Mohon masukan kata sandi!</div>
                </div>
            </div>

            <span class="text-end" style="font-size: small;"><a href="index.php?page=forgot_password"
                    style="color: #012970;">Lupa
                    kata sandi?</a></span>

            <div class="col-12">
                <button class="btn w-100 text-light" type="submit" name="login"
                    style="border-radius: 5px; background-color: #012970;">Masuk</button>
            </div>

            <span class="text-center" style="font-size: small;">Atau</span>

            <div class="col-12">
                <a href="index.php?page=register"><button class="btn btn-secondary w-100 text-light" type="button"
                        style="border-radius: 5px">Daftar Akun</button></a>
            </div>
        </form>

        <div class="col-12 text-center mt-2" style="font-size: small;">
            <p class="mb-0">Instansi diluar SMAN 12 Kupang?</p>
            <span><a style="color: #012970;" href="index.php?page=register_guest">Daftar akun tamu</a></span>
        </div>
    </div>
</div>