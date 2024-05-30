<?php
require_once '../../config/helper.php';
require_once '../../vendor/autoload.php';
require_once '../../config/c_session.php';

$mpdf = new \Mpdf\Mpdf();

$getIdNumber = $_GET['id_number'];
$query = "SELECT * FROM users WHERE id_number = $getIdNumber";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $userDetails = mysqli_fetch_array($result);

    $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CETAK DETAIL GTK</title>
            <link rel="stylesheet" href="detail.css">
            <style>
                th, td {
                    padding: 10px;
                }
            </style>
        </head>
        <body>
            <div class="kop-surat">
            <img src="../../assets/img/sman12_favicon.png" class="logo">
            <div class="nama-perusahaan">SMA NEGERI 12 KOTA KUPANG</div>
            <div class="alamat-perusahaan">Kelurahan Nitneno, Kecamatan Alak, Kabupaten Kupang, Nusa Tenggara Timur</div>
            <div class="kontak">Telepon: 123-456-7890 | Email: sman12kupang@gmail.com</div>
                <div class="kontent">
                    <h4>PENGGUNA SISURAT SMA NEGERI 12 KOTA KUPANG</h4>
                    <div class="siswa-info">
                        <div class="left">
                            <table>';

    $html .= '<tr>
                                            <td>Nomor Induk</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['id_number'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['nama'] . '</td>
                                        </tr>';
    $html .= '<tr>
                                            <td>Jenis Kelamin</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['jenis_kelamin'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat, Tanggal Lahir</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['ttl'] . '</td>
                                        </tr>';
    $html .= '<tr>
                                            <td>Nama Orang Tua/Wali</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['orangtua'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['kelas'] . '</td>
                                        </tr>';
    $html .= '<tr>
                                            <td>Email</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['email'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Instansi</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['instansi'] . '</td>
                                        </tr>';
    $html .= '<tr>
                                            <td>Hak Akses</td>
                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                            <td>' . $userDetails['role'] . '</td>
                                        </tr>';
                                        
    $html .= '</table>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>';

    $mpdf->WriteHTML($html);
    $mpdf->Output('pengguna-'. $userDetails['nama'] .'.pdf', 'I');
}