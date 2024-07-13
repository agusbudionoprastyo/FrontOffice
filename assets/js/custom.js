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
    var selectedRows = document.querySelectorAll('#dataTable tbody tr input.rowCheckbox:checked');
    var rowsData = [];

    selectedRows.forEach(function(row) {
        var room = row.getAttribute('data-room');
        var folio = row.getAttribute('data-folio');
        rowsData.push({
            room: room,
            folio: folio
        });
    });

    printQRCode(rowsData);
}

function printQRCode(rowsData) {
    var qrCodeDiv = document.getElementById('qrcode');
    if (qrCodeDiv) {
        qrCodeDiv.innerHTML = '';
    } else {
        qrCodeDiv = document.createElement('div');
        qrCodeDiv.id = 'qrcode';
        qrCodeDiv.style.display = 'none';
        document.body.appendChild(qrCodeDiv);
    }

    var qrTexts = [];

    rowsData.forEach(function(data) {
        var room = data.room;
        var folio = data.folio;

        generateQRCode(folio, function(qrText) {
            qrTexts.push({
                room: room,
                qrText: qrText
            });

            if (qrTexts.length === rowsData.length) {
                printSelectedDocuments(qrTexts);
            }
        });
    });
}

function generateQRCode(folio, callback) {
    const url = 'https://ecard.dafam.cloud/';
    var qrText = url + '?folio=' + folio;

    var qrcode = new QRCode('qrcode', {
        text: qrText,
        width: 80,
        height: 80
    });

    qrcode.makeCode(qrText);

    if (typeof callback === 'function') {
        callback(qrText);
    }
}

function printSelectedDocuments(qrTexts) {
    var printDocument = '<html><head><title>Cetak Label</title>';
    printDocument += '<style>@page { size: 50mm 25mm; margin: 0; }</style>'; // Set ukuran kertas label
    printDocument += '<style>body { font-family: Arial, sans-serif; font-size: 6pt; }</style>'; // Ganti sesuai kebutuhan
    printDocument += '</head><body>';

    qrTexts.forEach(function(item) {
        var room = item.room;
        var qrText = item.qrText;

        printDocument += '<div style="float: left; margin-right: 5mm;">';
        printDocument += '<div id="qrcodeContainer"></div>';

        printDocument += '<h3 style="margin: 0;">Scan Me!</h3>';
        printDocument += '<h3 style="margin: 0;">ROOM ' + room + '</h3>';
        printDocument += '<br><br>';
        printDocument += '<i style="margin: 0;">Wifi</i>';
        printDocument += '<h3 style="margin: 0;">dafamsemarang</h3>';
        printDocument += '<i style="margin: 0;">Password</i>';
        printDocument += '<h3 style="margin: 0;">krasansare</h3>';
        printDocument += '</div>';
    });

    printDocument += '</body></html>';

    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);

    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(printDocument);
    doc.close();

    var qrCodeInPrint = document.getElementById('qrcode');

    if (qrCodeInPrint) {
        var qrImage = new Image();
        qrImage.src = qrCodeInPrint.firstChild.toDataURL();
        doc.body.appendChild(qrImage);
    }

    setTimeout(function() {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();

        setTimeout(function() {
            document.body.removeChild(iframe);
            document.body.removeChild(qrCodeDiv);
        }, 1000);
    }, 500);
}

"use strict";