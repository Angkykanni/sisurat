<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Arsip Surat</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item active">Arsip</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-auto">
                    <div class="card-body" style="font-size: 14px;">
                        <div class="card-title" style="margin-bottom: -20px;">
                        </div>

                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Surat</th>
                                    <th>Data Surat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($surat_keluar as $sk) :
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        Tipe Surat: <span class="span-table"><?= $sk['jenis_surat']; ?></span>
                                        <br>
                                        Nomor Surat: <span class="span-table"><?= $sk['nomor_surat']; ?></span>
                                        <br>
                                        Kepada: <span
                                            class="span-table"><?= ($sk['kepada']) !== null ? $sk['kepada'] : '-' ?></span>
                                        <br>
                                        Perihal: <span class="span-table"><?= $sk['perihal']; ?></span>
                                        <?php if($sk['tanggal_mulai'] !== null && $sk['tanggal_selesai'] !== null) : ?>
                                        <br>
                                        Tanggal Mulai: <span class="span-table"><?= $sk['tanggal_mulai'];  ?></span>
                                        <br>
                                        Tanggal Selesai: <span class="span-table"><?= $sk['tanggal_selesai']; ?></span>
                                        <?php endif; ?>
                                        <br>
                                        Tanggal Surat: <span class="span-table"><?= $sk['created_at']; ?></span>
                                    </td>
                                    <td>
                                        <span class="span-table">
                                            <?php
                                                    if ($sk['peran_pengguna'] === 'GTK') {
                                                        echo 'GTK';
                                                    } elseif ($sk['peran_pengguna'] === 'Siswa') {
                                                        echo 'SISWA';
                                                    } elseif ($sk['peran_pengguna'] === 'Tamu') {
                                                        echo 'TAMU';
                                                    } else {
                                                        echo '<strong>INTERNAL SEKOLAH</strong>';
                                                    }
                                                    ?>
                                        </span>
                                        <br>
                                        Nomor Induk: <span class="span-table"><?= $sk['dari']; ?></span>
                                        <br>
                                        Nama Lengkap: <span class="span-table"><?= $sk['pengusul_surat']; ?></span>
                                        <br>
                                        <span class="span-table text-success">Surat <?= $sk['jenis']; ?></span>
                                    </td>

                                    <?php if($sk['jenis_surat'] !== 'Surat lainnya') : ?>
                                    <td class="text-center">
                                        <?php 
                                        $file_name = $sk['file']; 
                                        $file_path = 'assets/uploads/surat/' . $file_name;
                                        $nomor_surat = $sk['nomor_surat'];
                                        $url_surat_aktif_belajar = 'assets/uploads/surat/surat_aktif_belajar.php?nomor_surat=' . urlencode($nomor_surat);

                                        if (file_exists($file_path)) {
                                            echo '<a href="'. $url_surat_aktif_belajar .'"><button
                                                type="button" class="btn btn-sm btn-success"><i
                                                    class="bi bi-download"></i>&nbsp;
                                                Unduh</button></a>';
                                        } else {
                                            echo '<span class="text-danger">File tidak ditemukan</span>';
                                        }
                                        ?>
                                    </td>
                                    <?php else : ?>
                                    <td class="text-center">
                                        <?php 
                                        $file_name = $sk['file']; 
                                        $file_path = 'assets/uploads/files/' . $file_name;
                                        $url_surat_lainnya = 'assets/uploads/files/' . $file_name;

                                        if (file_exists($file_path)) {
                                            echo '<a href="'. $url_surat_lainnya .'" target="_blank"><button
                                                type="button" class="btn btn-sm btn-success"><i
                                                    class="bi bi-eye"></i>&nbsp;
                                                Lihat</button></a>';
                                        } else {
                                            echo '<span class="text-danger">File tidak ditemukan</span>';
                                        }
                                        ?>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php
                                    endforeach;

                                    // Lakukan perulangan terhadap surat masuk
                                    foreach ($surat_masuk_arsip as $sma) :
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>Nomor Surat: <span class="span-table"><?= $sma['nomor_surat']; ?></span>
                                        <br>
                                        Asal Surat: <span class="span-table"><?= $sma['instansi']; ?></span>
                                        <br>
                                        Kepada: <span class="span-table"><?= $sma['kepada']; ?></span>
                                        <br>
                                        Perihal: <span class="span-table"><?= $sma['perihal']; ?></span>
                                    </td>
                                    <td>
                                        Tanggal Surat: <span class="span-table"><?= $sma['tanggal_surat']; ?></span>
                                        <?php if($sma['tanggal_mulai'] !== null && $sma['tanggal_selesai'] !== null) : ?>
                                        <br>
                                        Tanggal Mulai: <span class="span-table"><?= $sma['tanggal_mulai'];  ?></span>
                                        <br>
                                        Tanggal Selesai: <span class="span-table"><?= $sma['tanggal_selesai']; ?></span>
                                        <?php endif; ?>
                                        <br>
                                        Jenis : <span class="span-table text-info"><?= $sma['jenis']; ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $file_name = $sma['file']; 
                                        $file_path = 'assets/uploads/files/' . $file_name;

                                        if (file_exists($file_path)) {
                                            echo '<a href="pages/download/d_surat.php?file=' . urlencode($file_name) . '"><button
                                                type="button" class="btn btn-sm btn-info text-light"><i
                                                    class="bi bi-download"></i>&nbsp;
                                                Unduh</button></a>';
                                        } else {
                                            echo '<span class="text-danger">File tidak ditemukan</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>