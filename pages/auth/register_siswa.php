<div class="card mb-3">
    <div class="card-body" style="min-width: 350px;">
        <div class="pt-2 pb-2">
            <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 600;">DAFTAR AKUN TAMU
            </h5>
        </div>

        <form action="" method="post" class="row g-3 needs-validation">
            <input type="text" value="Tamu" name="role" hidden>
            <div class="col-12">
                <label class="form-label">NIP/NIK</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-file-binary-fill"
                            style="color: #012970;"></i></span>
                    <input type="number" name="idNumber" class="form-control" placeholder="NIP/NIK anda" required>
                    <div class="invalid-feedback">Mohon masukan NIP/Email yang
                        valid!</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Instansi/Bidang</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-bank"
                            style="color: #012970;"></i></span>
                    <input type="text" name="instansi" class="form-control" placeholder="Instansi/bidang anda" required>
                    <div class="invalid-feedback">Mohon masukan instansi atau bidang anda</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"
                            style="color: #012970;"></i></span>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap anda" required>
                    <div class="invalid-feedback">Mohon masukan nama lengkap anda</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-at"
                            style="color: #012970;"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email aktif anda" required>
                    <div class="invalid-feedback">Mohon masukan email yang valid!</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Password</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password anda" required>
                    <div class="invalid-feedback">Mohon masukan password!</div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key-fill"
                            style="color: #012970;"></i></span>
                    <input type="password" name="password_confirm" class="form-control"
                        placeholder="Konfirmasi password anda" required>
                    <div class="invalid-feedback">Mohon masukan password!</div>
                </div>
            </div>

            <div class="col-12">
                <button class="btn w-100 text-light" type="submit"
                    style="border-radius: 5px; background-color: #012970;">Daftar Akun</button>
            </div>
        </form>

        <div class="col-12 text-center mt-2" style="font-size: small;">
            <p class="mb-0">Sudah punya akun? <a style="color: #012970;" href="index.php?page=login">Masuk</a>
            </p>
        </div>
    </div>
</div>