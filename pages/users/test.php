<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sisurat");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data verifikasi dengan id_pengajuan yang sama
$sql = "SELECT id_pengajuan, jenis, posisi, status, created_at FROM verifikasi WHERE id_pengajuan = 1";
$result = mysqli_query($conn, $sql);

// Buat tabel HTML untuk menampilkan data
echo "<table border='1'>
<tr>
<th>ID Pengajuan</th>
<th>Jenis</th>
<th>Posisi</th>
<th>Status</th>
<th>Created At</th>
</tr>";

// Tampilkan data dalam tabel
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_pengajuan'] . "</td>";
        echo "<td>" . $row['jenis'] . "</td>";
        echo "<td>" . $row['posisi'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
}

echo "</table>";

// Tutup koneksi
mysqli_close($conn);
?>