/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */
// Modal
$(document).ready(function(){
    $('#deviceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var recipientId = button.data('id'); // Ekstrak info dari atribut data-id
        var modal = $(this);
        modal.find('.modal-body form').attr('action', 'regform_sign_update.php');
        modal.find('.modal-body form').append('<input type="hidden" name="regform_id" value="' + recipientId + '">');
    });

    // Event listener untuk tombol kedua
    $('#deviceModal2').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var recipientId = button.data('id'); // Ekstrak info dari atribut data-id
        var modal = $(this);
        modal.find('.modal-body form').attr('action', 'guestfolio_sign_update.php');
        modal.find('.modal-body form').append('<input type="hidden" name="guestfolio_id" value="' + recipientId + '">');
    });
});

// Filter
$(document).ready(function(){
    $('.custom-datepicker-input').datepicker({
        format: 'yyyy-mm-dd', // Format Tanggal (YYYY-MM-DD)
        autoclose: true,
        todayHighlight: true,
        clearBtn: true // Tampilkan tombol hapus
    });

    // Ketika nilai input berubah, serahkan formulir
    $('.custom-datepicker-input').on('change', function() {
        $('#filter').submit();
    });

    // Hapus inisialisasi DataTable sebelumnya
    if ($.fn.DataTable.isDataTable('#table-2')) {
        $('#table-2').DataTable().destroy();
    }

    // Inisialisasi DataTables
    var table = $('#table-2').DataTable({
            // Pengaturan-pengaturan DataTables lainnya
        });
            // Event listener untuk tombol "Enter" pada #search-input
    $('#search-input').keypress(function(event) {
        if (event.which === 13) {
            // Ambil nilai pencarian dari #search-input
            var searchText = $(this).val();

            // Lakukan pencarian pada tabel
            table.search(searchText).draw();
        }
    });

    // Handler untuk tombol reset filter
    $('#reset-filter').click(function() {
        $('.custom-datepicker-input').datepicker('setDate', null); // Mengatur tanggal datepicker ke null
        $('#filter').submit(); 
    });
});

// JavaScript
function showLoading() {
    document.getElementById('loading-overlay').style.display = 'block';
}

function hideLoading() {
    document.getElementById('loading-overlay').style.display = 'none';
}

function syncData() {
    showLoading();

    $.ajax({
        url: 'https://103.236.201.34:3000/replicate', // Ganti dengan URL sesuai dengan endpoint server Anda
        method: 'GET',
        success: function(response) {
            console.log('Response from server:', response);
            hideLoading();
            location.reload(); // Reload halaman setelah iziToast ditutup (opsional)
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            hideLoading();
        }
    });
};

// // Function untuk mencetak QR code
// function printQRCode(button) {
//     // Dapatkan nilai data dari tombol cetak yang ditekan
//     var room = button.getAttribute('data-room');
//     var folio = button.getAttribute('data-folio');

//     // Hapus isi dari div dengan id 'qrcode' jika ada
//     var qrCodeDiv = document.getElementById('qrcode');
//     if (qrCodeDiv) {
//         qrCodeDiv.innerHTML = ''; // Menghapus semua elemen yang ada di dalamnya
//     } else {
//         // Jika qrCodeDiv belum ada, buat elemennya
//         qrCodeDiv = document.createElement('div');
//         qrCodeDiv.id = 'qrcode';
//         qrCodeDiv.style.display = 'none'; // Sembunyikan elemen QR code di dokumen asli
//         document.body.appendChild(qrCodeDiv);
//     }

//     // Panggil fungsi untuk menghasilkan QR code dan mencetak
//     generateQRCode(folio, function(qrText) {
//         // Setelah QR code dibuat, panggil fungsi untuk mencetak
//         printDocumentWithQR(room, qrText);
//     });
// }


// // Function untuk menghasilkan QR code
// function generateQRCode(folio, callback) {
//     const url = 'https://ecard.dafam.cloud/';

//     // Menyiapkan teks untuk QR code dengan informasi tambahan
//     var qrText = url + '?folio=' + folio;

//     // Menggunakan QRCode.js untuk menghasilkan QR code dengan teks yang disiapkan
//     var qrcode = new QRCode('qrcode', {
//         text: qrText,
//         width: 80,
//         height: 80
//     });

//     // Memanggil makeCode() untuk menghasilkan QR code dengan teks yang diberikan
//     qrcode.makeCode(qrText);

//     // Memanggil callback dengan qrText setelah QR code selesai dibuat
//     if (typeof callback === 'function') {
//         callback(qrText);
//     }
// }

// function printDocumentWithQR(room, qrText) {
//     // Membuat elemen untuk QR code
//     var qrCodeDiv = document.createElement('div');
//     qrCodeDiv.id = 'qrcode';
//     qrCodeDiv.style.display = 'none'; // Sembunyikan elemen QR code di dokumen asli
//     document.body.appendChild(qrCodeDiv);

//     // Menyiapkan dokumen untuk pencetakan
//     var printDocument = '<html><head><title>Cetak Label</title>';
//     printDocument += '<style>@page { size: 50mm 25mm; margin: 0; }</style>'; // Set ukuran kertas label
//     printDocument += '<style>body { font-family: Arial, sans-serif; font-size: 6pt; }</style>'; // Ganti sesuai kebutuhan
//     printDocument += '</head><body>';

//     // Container untuk QR code dan detail ROOM, WIFI, PASSWORD dalam satu baris
//     printDocument += '<div style="float: left; margin-right: 5mm;">';
//     printDocument += '<div id="qrcodeContainer"></div>'; // Letakkan QR code di dalam container ini

//     printDocument += '<h3 style="margin: 0;">Scan Me!</h3>';
//     printDocument += '<h3 style="margin: 0;">ROOM ' + room + '</h3>';
//     printDocument += '<br><br>';
//     printDocument += '<i style="margin: 0;">Wifi</i>';
//     printDocument += '<h3 style="margin: 0;">dafamsemarang</h3>';
//     printDocument += '<i style="margin: 0;">Password</i>';
//     printDocument += '<h3 style="margin: 0;">krasansare</h3>';
//     printDocument += '</div>';

//     printDocument += '</body></html>';


//     // Membuat elemen iframe untuk mencetak dokumen
//     var iframe = document.createElement('iframe');
//     iframe.style.position = 'absolute';
//     iframe.style.width = '0px';
//     iframe.style.height = '0px';
//     iframe.style.border = 'none';
//     document.body.appendChild(iframe);

//     // Menulis dokumen pencetakan ke dalam iframe
//     var doc = iframe.contentWindow.document;
//     doc.open();
//     doc.write(printDocument);
//     doc.close();

//     // Ambil elemen QR code yang sudah di-generate sebelumnya
//     var qrCodeInPrint = document.getElementById('qrcode');

//     // Salin QR code yang sudah di-generate ke dalam dokumen pencetakan di iframe
//     if (qrCodeInPrint) {
//         var qrImage = new Image();
//         qrImage.src = qrCodeInPrint.firstChild.toDataURL();
//         doc.body.appendChild(qrImage);
//     }

//     // Melakukan pencetakan setelah QR code dan dokumen selesai disiapkan
//     setTimeout(function() {
//         iframe.contentWindow.focus();
//         iframe.contentWindow.print();

//         // Hapus elemen iframe setelah pencetakan selesai
//         setTimeout(function() {
//             document.body.removeChild(iframe);
//             document.body.removeChild(qrCodeDiv); // Hapus elemen QR code dari dokumen asli setelah pencetakan
//         }, 1000); // Menunggu 1 detik sebelum menghapus iframe
//     }, 500); // Menunggu 0.5 detik sebelum melakukan pencetakan
// }

function printSelectedQRCode() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    var printList = [];

    // Loop melalui setiap checkbox yang dipilih
    checkboxes.forEach(function(checkbox) {
        var room = checkbox.getAttribute('data-room');
        var folio = checkbox.getAttribute('data-folio');
        var item = {
            room: room,
            folio: folio
        };
        printList.push(item);
    });

    // Jika tidak ada item yang dipilih, beri pesan atau lakukan apa yang diperlukan
    if (printList.length === 0) {
        alert('Pilih setidaknya satu item untuk mencetak QR code.');
        return;
    }

    // Untuk setiap item yang dipilih, buat QR code dan lakukan pencetakan
    printList.forEach(function(item) {
        generateAndPrintQRCode(item);
    });
}

function generateAndPrintQRCode(item) {
    const url = 'https://ecard.dafam.cloud/';
    var qrText = url + '?folio=' + item.folio;

    // Buat elemen canvas baru untuk QR code
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    // Menggunakan QRCode.js untuk menghasilkan QR code
    new QRCode(canvas, {
        text: qrText,
        width: 80,
        height: 80
    });

    // Setelah QR code dihasilkan, buat dokumen pencetakan
    var printDocument = '<html><head><title>Cetak Label</title>';
    printDocument += '<style>@page { size: 50mm 25mm; margin: 0; }</style>';
    printDocument += '<style>body { font-family: Arial, sans-serif; font-size: 6pt; }</style>';
    printDocument += '</head><body>';

    printDocument += '<div style="float: left; margin-right: 5mm;">';
    printDocument += '<div id="qrcodeContainer-' + item.folio + '"></div>'; // ID unik berdasarkan folio

    printDocument += '<h3 style="margin: 0;">Scan Me!</h3>';
    printDocument += '<h3 style="margin: 0;">ROOM ' + item.room + '</h3>';
    printDocument += '<br><br>';
    printDocument += '<i style="margin: 0;">Wifi</i>';
    printDocument += '<h3 style="margin: 0;">dafamsemarang</h3>';
    printDocument += '<i style="margin: 0;">Password</i>';
    printDocument += '<h3 style="margin: 0;">krasansare</h3>';
    printDocument += '</div>';

    printDocument += '</body></html>';

    // Membuat elemen iframe untuk mencetak dokumen
    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);

    // Menulis dokumen pencetakan ke dalam iframe
    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(printDocument);
    doc.close();

    // Tunggu sebentar sebelum menambahkan QR code ke dokumen
    setTimeout(function() {
        // Temukan qrcodeContainer yang sesuai di dokumen pencetakan
        var qrcodeContainer = doc.getElementById('qrcodeContainer-' + item.folio);

        // Buat elemen canvas untuk QR code yang sudah ditampilkan
        var canvasCopy = canvas.cloneNode(true);

        // Salin QR code yang sudah ditampilkan ke dalam dokumen pencetakan di iframe
        qrcodeContainer.appendChild(canvasCopy);

        // Setelah QR code ditambahkan, lakukan pencetakan
        setTimeout(function() {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            // Hapus elemen iframe setelah pencetakan selesai
            setTimeout(function() {
                document.body.removeChild(iframe);
            }, 1000); // Tunggu sebentar sebelum menghapus iframe
        }, 500); // Tunggu sebentar sebelum melakukan pencetakan
    }, 100); // Tunggu sebentar sebelum menambahkan QR code ke dokumen
}



"use strict";