    <?php $link_dashboard = switchLinkDashboard($role); ?>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <?php if ($role !== 'Tamu') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Dashboard Admin', 'Dashboard Kepsek', 'Dashboard Kurikulum', 'Dashboard']) ? '' : 'collapsed'; ?>"
                    href="<?= $link_dashboard; ?>"><i class="bi bi-columns-gap"></i>
                    <span>Beranda</span>
                </a>
            </li>

            <li class="nav-heading mt-4">Surat</li>

            <?php endif; ?>

            <?php if ($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Daftar Pengajuan', 'Verifikasi Surat']) ? '' : 'collapsed'; ?>"
                    data-bs-target="#pengajuan-nav"
                    data-bs-toggle="<?= ($title ?? '') === 'Verifikasi Surat' ? 'collapse' : ''; ?>"
                    href="index.php?page=pengajuan-surat">
                    <i class="ri-file-copy-2-line"></i>
                    <span>Pengajuan Surat&nbsp;&nbsp;&nbsp;</span>
                    <?php
                    if($pengajuan_DP) {
                        echo '<i class="bi bi-circle-fill" style="font-size: 10px; color: #FF5A8D;"></i>';
                    }
                    ?>
                </a>
                <ul id="pengajuan-nav"
                    class="nav-content collapse <?= ($title ?? '') === 'Verifikasi Surat' ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="index.php?page=pengajuan-surat"
                            class="<?= ($title ?? '') === 'Daftar Pengajuan' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Daftar Pengajuan</span>
                        </a>
                    </li>

                    <?php 
                        if ($title === 'Verifikasi Surat') {
                            echo '
                            <li>
                                <a href="" class="active">
                                    <i class="bi bi-circle"></i><span>'. $title .'</span>
                                </a>
                            </li>
                                ';
                        } else {
                            
                        }
                        ?>
                </ul>
            </li>

            <?php elseif ($role == 'GTK' || $role == 'Siswa' || $role == 'Tamu') : ?>
            <li class="nav-item">
                <a class="nav-link <?= ($title ?? '') === 'Ajukan Surat' ? '' : 'collapsed'; ?>"
                    href="index.php?page=ajukan-surat">
                    <i class="ri-file-copy-2-line"></i>
                    <span>Ajukan Surat</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?page=list-pengajuan-user"
                    class="nav-link <?= ($title ?? '') === 'Daftar Pengajuan' ? '' : 'collapsed'; ?>">
                    <i class="ri-mail-send-line"></i><span>Daftar Pengajuan</span>
                </a>
            </li>

            <?php endif; ?>

            <?php if($role == 'Admin') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Surat Masuk', 'Tambah Surat Masuk', 'Detail Surat Masuk']) ? '' : 'collapsed'; ?>"
                    data-bs-target="#surat-masuk-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-mail-download-line"></i><span>Surat Masuk</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="surat-masuk-nav"
                    class="nav-content collapse <?= in_array($title ?? '', ['Surat Masuk', 'Tambah Surat Masuk', 'Detail Surat Masuk']) ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="index.php?page=surat-masuk"
                            class="<?= ($title ?? '') === 'Surat Masuk' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Daftar Surat Masuk</span>
                        </a>
                    </li>

                    <li>
                        <a href="index.php?page=tambah-surat-masuk"
                            class="<?= ($title ?? '') === 'Tambah Surat Masuk' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Tambah Surat Masuk</span>
                        </a>
                    </li>

                    <?php
                    if ($title === 'Detail Surat Masuk') {
                        echo '<li>
                                <a href="" class="active">
                                    <i class="bi bi-circle"></i><span>Detail Surat Masuk</span>
                                </a>
                            </li>';
                    } else {
                    }
                    ?>
                </ul>
            </li>

            <?php elseif ($role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Surat Masuk', 'Detail Surat Masuk']) ? '' : 'collapsed'; ?>"
                    <?= in_array($title ?? '', ['Detail Surat Masuk']) ? 'data-bs-target="#surat-masuk-nav" data-bs-toggle="collapse"' : ''; ?>
                    href="index.php?page=surat-masuk">
                    <i class="ri-mail-download-line"></i><span>Surat Masuk</span><i
                        class="<?= ($title ?? '') === 'Detail Surat Masuk' ? 'bi bi-chevron-down ms-auto' : ''; ?>"></i>
                </a>
                <ul id="surat-masuk-nav"
                    class="nav-content collapse <?= in_array($title ?? '', ['Detail Surat Masuk']) ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="index.php?page=surat-masuk"
                            class="<?= ($title ?? '') === 'Surat Masuk' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Daftar Surat Masuk</span>
                        </a>
                    </li>

                    <?php
                    if ($title === 'Detail Surat Masuk') {
                        echo '<li>
                                <a href="" class="active">
                                    <i class="bi bi-circle"></i><span>Detail Surat Masuk</span>
                                </a>
                            </li>';
                    } else {
                    }
                    ?>
                </ul>
            </li>

            <?php else : ?>
            <li class="nav-item">
                <a class="nav-link <?= ($title ?? '') === 'Surat Masuk Pengusul' ? '' : 'collapsed'; ?>"
                    href="index.php?page=surat-masuk-pengusul">
                    <i class="ri-mail-download-line"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Surat Keluar', 'Lihat Surat Keluar', 'Jenis Surat Keluar']) ? '' : 'collapsed'; ?>"
                    data-bs-target="#surat-keluar-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-mail-send-line"></i><span>Surat Keluar</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="surat-keluar-nav"
                    class="nav-content collapse <?= in_array($title ?? '', ['Surat Keluar', 'Lihat Surat Keluar', 'Keluarkan Surat', 'Jenis Surat Keluar']) ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="index.php?page=surat-keluar"
                            class="<?= ($title ?? '') === 'Surat Keluar' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Daftar Surat Keluar</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="index.php?page=jenis-surat-keluar"
                            class="($title ?? '') === 'Jenis Surat Keluar' ? 'active' : '';">
                            <i class="bi bi-circle"></i><span>Jenis Surat Keluar</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="index.php?page=keluarkan-surat"
                            class="<?= ($title ?? '') === 'Keluarkan Surat' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Keluarkan Surat</span>
                        </a>
                    </li>
                    <?php 
                    if ($title === 'Lihat Surat Keluar') {
                        echo '
                        <li>
                        <a href="" class="active">
                            <i class="bi bi-circle"></i><span>Lihat Surat Keluar</span>
                        </a>
                    </li>
                        ';
                    } else {
                        
                    }
                    ?>
                </ul>
            </li>
            <?php else : ?>
            <?php endif; ?>

            <?php if($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') : ?>
            <li class="nav-item">
                <a class="nav-link <?= ($title ?? '') === 'Arsip' ? '' : 'collapsed'; ?>"
                    href="index.php?page=arsip-surat">
                    <i class="bi bi-archive-fill"></i>
                    <span>Arsip</span>
                </a>
            </li>
            <?php else : ?>
            <?php endif; ?>

            <li class="nav-heading mt-4">Pengaturan</li>

            <li class="nav-item">
                <a class="nav-link <?= ($title ?? '') === 'Profile' ? '' : 'collapsed'; ?>"
                    href="index.php?page=profile">
                    <i class="bi bi-person-fill"></i>
                    <span>Profile</span>
                </a>
            </li>

            <?php if($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') : ?>
            <li class="nav-item">
                <a class="nav-link <?= in_array($title ?? '', ['Pengguna', 'Detail Pengguna']) ? '' : 'collapsed'; ?>"
                    href="index.php?page=pengguna">
                    <i class="bi bi-people-fill"></i>
                    <span>Pengguna</span>
                </a>
                <ul id="pengguna-nav"
                    class="nav-content collapse <?= ($title ?? '') === 'Detail Pengguna' ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="index.php?page=pengguna" class="<?= ($title ?? '') === 'Pengguna' ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Daftar Pengguna</span>
                        </a>
                    </li>

                    <?php 
                    if ($title === 'Detail Pengguna') {
                        echo '
                        <li>
                            <a href="" class="active">
                                <i class="bi bi-circle"></i><span>Detail Pengguna</span>
                            </a>
                        </li>
                            ';
                    } else {
                        
                    }
                    ?>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($title ?? '') === 'Pengaturan Sistem' ? '' : 'collapsed'; ?>"
                    href="index.php?page=sistem">
                    <i class="bi bi-gear-fill"></i>
                    <span>Sistem</span>
                </a>
            </li>
            <?php else : ?>
            <?php endif; ?>

            <li class="nav-item mt-4">
                <a class="nav-link collapsed" href="config/c_logout.php">
                    <i class="ri-shut-down-line"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- Sidebar End -->