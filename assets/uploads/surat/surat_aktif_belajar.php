<?php
require_once '../../../vendor/autoload.php';
require_once '../../../config/config.php';

if(isset($_GET['nomor_surat'])){
    $nomor_surat = $_GET['nomor_surat'];

    // Query database untuk mendapatkan data surat berdasarkan nomor surat
    $query_surat = "SELECT 
                        surat.id,
                        surat.jenis,
                        surat.nomor_surat,
                        tipe_surat.nama_tipe AS jenis_surat,
                        tipe_surat.template AS file_template,
                        users.nama AS pengusul_surat,
                        surat.dari,
                        surat.kepada,
                        surat.perihal,
                        surat.tanggal_mulai,
                        surat.tanggal_selesai,
                        surat.status,
                        surat.created_at,
                        role.roleName AS peran_pengguna
                    FROM 
                        surat
                    JOIN 
                        users ON surat.dari = users.id_number
                    JOIN 
                        tipe_surat ON surat.tipe_surat = tipe_surat.id
                    JOIN 
                        role ON users.role = role.roleName
                    WHERE 
                        surat.nomor_surat = '$nomor_surat'";

    $result_surat = mysqli_query($conn, $query_surat);
    $surat_data = mysqli_fetch_assoc($result_surat);

    if ($surat_data) {
        // Mendapatkan data pengusul dari pengajuan surat
        $pengusul_id = $surat_data['dari'];
        $query_pengusul = "SELECT * FROM users WHERE id_number = '$pengusul_id'";
        $result_pengusul = mysqli_query($conn, $query_pengusul);
        $pengusul_data = mysqli_fetch_assoc($result_pengusul);

        $query_cek_kepsek = "SELECT id_number, nama FROM users WHERE role = 'Kepala Sekolah'";
        $result_cek_kepsek = mysqli_query($conn, $query_cek_kepsek);

        if ($result_cek_kepsek) {
            if (mysqli_num_rows($result_cek_kepsek) > 0) {
                $row_kepsek = mysqli_fetch_assoc($result_cek_kepsek);
                $nama_kepsek = $row_kepsek['nama'];
                $nip_kepsek = $row_kepsek['id_number'];

                $query_system_settings = "SELECT * FROM settings WHERE nip_kepsek = $nip_kepsek";
                $result_system_settings = mysqli_query($conn, $query_system_settings);
                $data_settings = mysqli_fetch_assoc($result_system_settings);

                // Pastikan path ke template surat sesuai
                $template_path = 'aktif_belajar.docx';

                if (file_exists($template_path)) {
                    // Isi template dengan data
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('aktif_belajar.docx');

                    $templateProcessor->setValues(
                        [
                            'nomor_surat' => $surat_data['nomor_surat'],
                            'nis' => $pengusul_data['id_number'],
                            'nama_lengkap' => $pengusul_data['nama'],
                            'ttl' => $pengusul_data['ttl'],
                            'jenis_kelamin' => $pengusul_data['jenis_kelamin'],
                            'kelas' => $pengusul_data['kelas'],
                            'orangtua' => $pengusul_data['orangtua'],
                            'tahun_pelajaran' => $data_settings['tahun_pelajaran'],
                            'tanggal_surat' => $surat_data['created_at'],
                            'kepala_sekolah' => $nama_kepsek,
                            'nip_kepsek' => $nip_kepsek
                        ]
                    );

                    // Isi gambar tanda tangan
                    $templateProcessor->setImageValue(
                        'ttd',
                        [
                            'path' => 'ttd_kepsek.png',
                            'width' => 200,
                            'height' => 100,
                            'ratio' => false
                        ]
                    );

                    // Tentukan nama file output
                    $file_name = 'surat_aktif_belajar.docx';

                    // Unduh file
                    header('Content-Description: File Transfer');
                    header('Content-Disposition: attachment; filename='.$file_name);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

                    $templateProcessor->saveAs('php://output');
                    exit;
                } else {
                    echo 'Template surat tidak ditemukan.';
                }
            } else {
                echo 'KEPALA SEKOLAH TIDAK';
            }
        } else {
            echo 'Error:' . mysqli_error($conn);
        }
    } else {
        echo 'Surat dengan nomor ' . $nomor_surat . ' tidak ditemukan.';
    }
} else {
    echo 'Parameter nomor surat tidak ditemukan dalam URL.';
}

?>