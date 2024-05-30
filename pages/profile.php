<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Pengaturan Profile</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Pengaturan Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/<?= $photo_path; ?>" alt="Profile">
                        <?php
                        if ($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') {
                            echo '<h2 class="text-center mb-2">'. $user['nama'] .'</h2>
                            <h4>'. $user['id_number'] .'</h4>
                            <h3>'. $user['role'] .'</h3>';
                        } else {
                            echo '<h2 class="text-center mb-2">'. $users[0]['nama'] .'</h2>
                            <h4>'. $users[0]['id_number'] .'</h4>
                            <h3>'. $users[0]['role'] .'</h3>';
                        }
                        ?>
                    </div>
                    <div class=" text-center mb-4">
                        <button type="button" name="" class="btn btn-icon btn-info text-light"><i
                                class="bi bi-download"></i> Unduh profile</button>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                    id="showBiodata">Biodata</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                    id="ubahPassword">Ubah
                                    Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <div class="tab-pane profile-overview" id="profile-overview">
                                <div class="row mt-4">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['nama'] : $users[0]['nama']; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['email'] : $users[0]['email']; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Instansi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['instansi'] : $users[0]['instansi']; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Daftar</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['created_at'] : $users[0]['created_at']; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Update</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['updated_at'] : $users[0]['updated_at']; ?>
                                    </div>
                                </div>


                                <div class="text-end">
                                    <button name="ubahProfile" class="btn btn-warning text-light"
                                        id="toggleEditProfile"><i class="bi bi-pencil-square"></i>&nbsp; Ubah
                                        Profile</button>
                                </div>
                            </div>

                            <div class="tab-pane profile-edit pt-3" id="profile-edit" style="display: none;">
                                <form enctype="multipart/form-data" action="config/c_update.php" method="POST"
                                    id="editProfileForm">

                                    <?php
                                    if (isset($_SESSION['update_success'])) {
                                        if ($_SESSION['update_success']) {
                                            echo '<script>
                                                    window.onload = function() {
                                                        Swal.fire({
                                                            position: "center",
                                                            icon: "success",
                                                            title: "Profile berhasil diubah",
                                                            showConfirmButton: false,
                                                            timer: 2500
                                                        });
                                                    };
                                                </script>';
                                        } else {
                                            echo "<script>
                                                    window.onload = function() {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Kesalahan',
                                                            text: 'Gagal ubah profile!',
                                                        });
                                                    };
                                                </script>";
                                        }
                                        unset($_SESSION['update_success']);
                                    }
                                    ?>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profil</label>
                                        <div class="col-md-8 col-lg-9 text-center">
                                            <img src="assets/<?= $photo_path; ?>" alt="Profile">
                                            <div class="pt-2">
                                                <label for="profilePict" id="fileInputLabelProfilePict"
                                                    class="custom-file-upload mb-2 text-light"
                                                    style="font-weight: 400;">
                                                    <i class="bi bi-upload"></i> <span id="fileNameProfilePict">Ubah
                                                        foto profile</span>
                                                </label>
                                                <input id="profilePict" type="file" name="photo" style="display: none;"
                                                    onchange="updateFileNameProfilePict(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="idNumber" class="col-md-4 col-lg-3 col-form-label">Nomor
                                            Induk</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="id_number" class="form-control" id="idNumber"
                                                value="<?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['id_number'] : $users[0]['id_number']; ?>"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="namaLengkap" class="col-md-4 col-lg-3 col-form-label">Nama
                                            Lengkap</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="namaLengkap"
                                                value="<?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['nama'] : $users[0]['nama']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="email" class="form-control" id="email"
                                                value="<?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['email'] : $users[0]['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="instansi" class="col-md-4 col-lg-3 col-form-label">Instansi</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instansi" type="text" class="form-control" id="instansi"
                                                value="<?= ($role === 'Admin' || $role === 'Kepala Sekolah' || $role === 'Wakasek Kurikulum') ? $user['instansi'] : $users[0]['instansi']; ?>"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" name="updateProfile" class="btn btn-primary btn-icon"
                                            id="toggleToProfile"><i class="bi bi-file-earmark-check-fill"></i>
                                            Simpan
                                            Perubahan</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane pt-3" id="profile-change-password">
                                <form action="config/c_update.php" method="POST">

                                    <?php
                                    if (isset($_SESSION['password_update_message'])) {
                                        echo '<script>
                                                window.onload = function() {
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "' . ($_SESSION['password_update_message'] == "Password berhasil diubah" ? "success" : "error") . '",
                                                        title: "' . $_SESSION['password_update_message'] . '",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    });
                                                };
                                            </script>';
                                        unset($_SESSION['password_update_message']);
                                    }
                                    ?>

                                    <input type="text" name="id_number" value="<?= $user['id_number']; ?>" hidden>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                            Sekarang</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                            Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newPassword" type="password" class="form-control"
                                                id="newPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi
                                            Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="reNewPassword" type="password" class="form-control"
                                                id="renewPassword" required>
                                        </div>
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" name="updatePassword" class="btn btn-primary"><i
                                                class="bi bi-key-fill"></i>
                                            Ubah
                                            Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function updateFileNameProfilePict(input) {
    var fileName = input.files[0].name;
    document.getElementById("fileNameProfilePict").textContent = fileName;
}

var profileOverview = document.getElementById('profile-overview');
var profileEdit = document.getElementById('profile-edit');

function showProfileOverview() {
    profileOverview.style.display = 'block';
    profileEdit.style.display = 'none';
}

function showProfileEdit() {
    profileOverview.style.display = 'none';
    profileEdit.style.display = 'block';
}

document.getElementById('toggleEditProfile').addEventListener('click', showProfileEdit);
document.getElementById('toggleToProfile').addEventListener('click', showProfileOverview);

document.getElementById('tandaTangan').addEventListener('click', function() {
    profileEdit.style.display = 'none';
    profileOverview.style.display = 'none';
});

document.getElementById('showBiodata').addEventListener('click', showProfileOverview);
document.getElementById('ubahPassword').addEventListener('click', function() {
    profileEdit.style.display = 'none';
    profileOverview.style.display = 'none';
});
</script>