    // Fungsi untuk menampilkan loader
    function showLoader() {
        document.querySelector('.dim-overlay').style.display = 'block';
        document.querySelector('.loader').style.display = 'block';
    }

    // Fungsi untuk menyembunyikan loader
    function hideLoader() {
        document.querySelector('.dim-overlay').style.display = 'none';
        document.querySelector('.loader').style.display = 'none';
    }

    // Menangani perubahan halaman
    document.addEventListener('DOMContentLoaded', function () {
        // Semua tautan dengan kelas "loader-trigger" akan menampilkan loader saat diklik
        var loaderTriggers = document.querySelectorAll('.loader-trigger');
        loaderTriggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                showLoader();
            });
        });

        // Semua formulir dengan kelas "loader-form" akan menampilkan loader saat dikirim
        var loaderForms = document.querySelectorAll('.loader-form');
        loaderForms.forEach(function (form) {
            form.addEventListener('submit', function () {
                showLoader();
            });
        });

        // Semua tautan dengan kelas "loader-trigger" akan menyembunyikan loader saat diklik
        var loaderHideTriggers = document.querySelectorAll('.loader-hide-trigger');
        loaderHideTriggers.forEach(function (hideTrigger) {
            hideTrigger.addEventListener('click', function () {
                hideLoader();
            });
        });
    });

    // Semua halaman baru akan menyembunyikan loader saat selesai dimuat
    window.addEventListener('load', function () {
        hideLoader();
    });

    function updateSelectedSuratTitle(title) {
        document.getElementById('selected-surat-title').innerText = title;
    }

    // Menangani perubahan saat tombol diklik
    document.querySelectorAll('.list-group-item').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetId = this.getAttribute('data-bs-target');
            var targetForm = document.querySelector(targetId);

            // Menampilkan formulir yang sesuai dengan data-bs-target
            var tab = new bootstrap.Tab(targetForm);
            tab.show();

            // Mengupdate judul kartu sesuai dengan tombol yang diklik
            updateSelectedSuratTitle(this.innerText);
        });
    });

    // Panggil fungsi hideAllPersyaratanTabs saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        hideAllPersyaratanTabs();
    });

    // Menyembunyikan semua tab persyaratan
    function hideAllPersyaratanTabs() {
        document.querySelectorAll('.tab-pane').forEach(function (tab) {
            tab.classList.remove('show', 'active');
        });
    }

    // Menampilkan tab persyaratan saat jenis surat dipilih
    function showPersyaratanTab(tabId) {
        var targetTab = document.querySelector(tabId);
        targetTab.classList.add('show', 'active');

        // Menampilkan kartu persyaratan
        document.getElementById('kartu-persyaratan').style.display = 'block';
    }

    document.querySelector('.custom-file-upload').addEventListener('click', function () {
        document.getElementById('fileInput').click();
    });

    function updateFileNameAktifBelajar(input) {
        var fileInputLabelAktifBelajar = document.getElementById('fileInputLabelAktifBelajar');
        if (input.files && input.files.length > 0) {
            fileInputLabelAktifBelajar.textContent = input.files[0].name;
        } else {
            fileInputLabelAktifBelajar.textContent = 'Unggah nilai semester sebelumnya';
        }
    }

    function updateFileNameSuratLainnya(input) {
        var fileInputLabelAktifBelajar = document.getElementById('fileInputLabelSuratLainnya');
        if (input.files && input.files.length > 0) {
            fileInputLabelSuratLainnya.textContent = input.files[0].name;
        } else {
            fileInputLabelSuratLainnya.textContent = 'Unggah file surat';
        }
    }

    function updateFileNamePendampinganSiswa(input) {
        var fileInputLabelPendampinganSiswa = document.getElementById('fileInputLabelPendampinganSiswa');
        if (input.files && input.files.length > 0) {
            fileInputLabelPendampinganSiswa.textContent = input.files[0].name;
        } else {
            fileInputLabelPendampinganSiswa.textContent = 'Unggah bukti pendampingan siswa';
        }
    }

    function updateFileNameSuratMasuk(input) {
        var fileInputLabelSuratMasuk = document.getElementById('fileInputLabelSuratMasuk');
        var pdfPreviewCard = document.getElementById('pdfPreviewCard');

        if (input.files && input.files.length > 0) {
            fileInputLabelSuratMasuk.textContent = input.files[0].name;
            pdfPreviewCard.style.display = 'block';

            var file = input.files[0];
            var fileReader = new FileReader();

            fileReader.onload = function () {
                var fileURL = URL.createObjectURL(file);
                displayPDF(fileURL);
            };

            fileReader.readAsDataURL(file);
        } else {
            fileInputLabelSuratMasuk.textContent = 'Unggah file surat';
            pdfPreviewCard.style.display = 'none';
        }
    }

    function displayPDF(pdfURL) {
        var embedTag = document.createElement('embed');
        embedTag.setAttribute('type', 'application/pdf');
        embedTag.setAttribute('src', pdfURL);
        embedTag.setAttribute('width', '100%');
        embedTag.setAttribute('height', '500px');

        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.innerHTML = ''; // Clear previous content
        pdfViewer.appendChild(embedTag);
    }