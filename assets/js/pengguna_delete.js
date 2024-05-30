document.addEventListener('DOMContentLoaded', function() {
    // Menangani setiap tombol hapus
    const hapusPenggunaButtons = document.querySelectorAll('.hapusPenggunaButton');
    hapusPenggunaButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            Swal.fire({
                title: "Hapus pengguna?",
                text: "Tindakan ini akan menghapus pengguna secara permanen",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: "#012970",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan AJAX untuk menghapus pengguna
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'config/c_delete.php', true);
                    xhr.setRequestHeader('Content-type',
                        'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Tampilkan Sweet Alert bahwa pengguna berhasil dihapus
                            Swal.fire({
                                title: "Terhapus!",
                                text: "Pengguna telah dihapus permanen.",
                                icon: "success",
                                timer: 1500, // Tampilkan selama 1.5 detik
                                timerProgressBar: true
                            }).then(() => {
                                // Refresh halaman setelah Sweet Alert ditutup
                                window.location.reload();
                            });
                        } else {
                            // Tampilkan Sweet Alert bahwa terjadi kesalahan
                            Swal.fire({
                                title: "Kesalahan!",
                                text: "Gagal menghapus pengguna.",
                                icon: "error"
                            });
                        }
                    };
                    xhr.send(`userId=${userId}`);
                }
            });
        });
    });
});