<?php
require_once '../../config/helper.php';
require_once '../../vendor/autoload.php';
require_once '../../config/c_session.php';

$mpdf = new \Mpdf\Mpdf();


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR PENGGUNA</title>

    <link rel="stylesheet" href="list.css">
</head>
<body>
    <div class="kop-surat">
        <img src="../../assets/img/sman12_favicon.png" class="logo">
        <div class="nama-perusahaan">SMA NEGERI 12 KOTA KUPANG</div>
        <div class="alamat-perusahaan">Kelurahan Nitneno, Kecamatan Alak, Kabupaten Kupang, Nusa Tenggara Timur</div>
        <div class="kontak">Telepon: 123-456-7890 | Email: sman12kupang@gmail.com</div>
        <div class="judul">DATA PENGGUNA SISURAT SMA NEGERI 12 KOTA KUPANG</div>

        <div class="konten">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor ID</th>
                        <th>Nama</th>
                        <th>Hak Akses</th>
                    </tr>
                </thead>
                <tbody>';

// Proses pengisian data pengguna ke dalam tabel
$no = 1;
foreach ($users as $user) {
    $html .= '
                    <tr>
                        <td>'. $no++ .'</td>
                        <td>'. $user['id_number'] .'</td>
                        <td>'. $user['nama'] .'</td>
                        <td>'. $user['role'] .'</td>
                    </tr>';
    }

$html .= '
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>';

// Menambahkan HTML ke PDF
$mpdf->WriteHTML($html);

// Output PDF
$mpdf->Output('pengguna-sisurat.pdf', \Mpdf\Output\Destination::DOWNLOAD);