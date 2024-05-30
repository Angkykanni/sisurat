<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-3">Daftar Surat Masuk</h1>
        <nav class="d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Beranda</a></li>
                <li class="breadcrumb-item">Surat Masuk</li>
                <li class="breadcrumb-item active">Daftar Surat Masuk</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-title">
                        <h5 style="margin-left: 20px; margin-bottom: -10px;">Filter Surat Masuk</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="mulai" class="form-label mb-0">Dari tanggal</label>
                            <input type="date" id="mulai" class="form-control mt-0 mb-3" name="mulai">

                            <label for="selesai" class="form-label mb-0">Sampai tanggal</label>
                            <input type="date" class="form-control mt-0 mb-3" id="selesai" name="selesai">

                            <div class="text-end">
                                <button type="submit" name="filter" class="btn btn-primary"><i
                                        class="bi bi-filter"></i>&nbsp;Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card overflow-auto">
                    <div class="card-body" style="font-size: 14px;">
                        <div class="card-title" style="margin-bottom: -20px;">
                        </div>
                        <table class="table card-table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Surat</th>
                                    <th>&nbsp;</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1; 

                                if (isset($_POST['filter'])) {
                                    $mulai = $_POST['mulai'];
                                    $selesai = $_POST['selesai'];

                                    // Adjusted query to filter letters based on start and end dates and status
                                    $query_surat_masuk = "SELECT surat.id,
                                                                surat.jenis,
                                                                surat.nomor_surat,
                                                                surat.tanggal_surat,
                                                                surat.dari,
                                                                surat.kepada,
                                                                surat.perihal,
                                                                surat.tanggal_mulai,
                                                                surat.tanggal_selesai,
                                                                surat.instansi,
                                                                surat.file,
                                                                surat.status,
                                                                surat.created_at
                                                            FROM 
                                                                surat
                                                            WHERE 
                                                                surat.jenis = 'Masuk' AND
                                                                surat.created_at BETWEEN '$mulai' AND
                                                                DATE_ADD('$selesai', INTERVAL 1 DAY)";

                                    // Execute the adjusted query
                                    $result_get_surat_masuk = mysqli_query($conn, $query_surat_masuk);
                                    $surat_masuk_list = mysqli_fetch_all($result_get_surat_masuk, MYSQLI_ASSOC);
                                } else {
                                    // Fetch all letters if filter is not applied
                                    $surat_masuk_list = $surat_masuk_list;
                                }
                                ?>
                                <?php foreach ($surat_masuk_list as $sml): ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>Nomor Surat: <span class="span-table"><?= $sml['nomor_surat']; ?></span>
                                        <br>
                                        Asal Surat: <span class="span-table"><?= $sml['instansi']; ?></span>
                                        <br>
                                        Kepada: <span class="span-table"><?= $sml['kepada']; ?></span>
                                        <br>
                                        Perihal: <span class="span-table"><?= $sml['perihal']; ?></span>
                                    </td>
                                    <td>
                                        Tanggal Surat: <span class="span-table"><?= $sml['tanggal_surat']; ?></span>
                                        <br>
                                        Tanggal Mulai: <span
                                            class="span-table"><?= ($sml['tanggal_mulai']) !== null ? $sml['tanggal_mulai'] : '-' ?></span>
                                        <br>
                                        Tanggal Selesai: <span
                                            class="span-table"><?= ($sml['tanggal_selesai']) !== null ? $sml['tanggal_selesai'] : '-' ?></span>
                                        <br>
                                        Status:
                                        <?= ($sml['status']) === 'Dalam Proses' ? '<span class="span-table text-warning">Belum Diterima</span>' : '<span class="span-table text-success">Diterima</span>' ?>
                                    </td>

                                    <td class="text-center">
                                        <?php 
                                        $file_name = $sml['file']; 
                                        $file_path = 'assets/uploads/files/' . $file_name;

                                        if ($sml['status'] == 'Dalam Proses') {
                                            echo '<button type="button" class="btn btn-sm mt-2 btn-warning text-light btnTerimaSuratMasuk" data-surat-id="'. $sml['id'] .'">
                                                    <i class="bi bi-check"></i>&nbsp; Terima
                                                </button>

                                                ';
                                        }

                                        if (file_exists($file_path)) {
                                            echo '<a href="pages/download/d_surat.php?file=' . urlencode($file_name) . '"><button
                                                type="button" class="ms-2 mt-2 btn btn-sm btn-success"><i
                                                    class="bi bi-download"></i>&nbsp;
                                                Unduh</button></a>';
                                        } else {
                                            echo '<span class="text-danger">File tidak ditemukan</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
$(document).ready(function() {
    $('.btnTerimaSuratMasuk').click(function() { // Menggunakan kelas CSS sebagai selektor
        var surat_id = $(this).data('surat-id'); // Mengambil atribut data surat_id dari tombol
        // Kirim AJAX request
        $.ajax({
            url: 'config/c_add_surat.php',
            type: 'POST',
            data: {
                surat_id: surat_id
            },
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Surat Diterima",
                    }).then(() => {
                        window.location.href = "index.php?page=surat-masuk";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Surat gagal diterima!',
                    }).then(() => {
                        window.location.href = "index.php?page=surat-masuk";
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan saat mengirim permintaan!',
                });
            }
        });
    });
});
</script>