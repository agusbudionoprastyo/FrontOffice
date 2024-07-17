/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */
$(document).ready(function() {
    syncDataOnPageLoad(); // Panggil fungsi untuk menampilkan SweetAlert pada page load
    
    // Modal
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

    // Filter
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

function syncDataOnPageLoad() {
    // Ambil timestamp terakhir dari database
    $.ajax({
        url: '../roleadmin/get_last_sync.php',
        method: 'GET',
        dataType: 'json', // Mengharapkan respons JSON
        success: function(response) {
            var lastSyncTime = response.lastSyncTime;
            var lastSyncTimeObj = new Date(lastSyncTime);
            var now = new Date();

            if (lastSyncTime) {
                // Hitung selisih waktu dalam menit
                var diffMinutes = Math.floor((now - lastSyncTimeObj) / (1000 * 60));

                // Menampilkan SweetAlert dialog berdasarkan selisih waktu
                var htmlContent = '';
                if (diffMinutes < 5) {
                    htmlContent = 'Last Sync <strong>' + lastSyncTime + '</strong>';

                    Swal.fire({
                        title: 'Sync Data Powerpro Successfull',
                        html: htmlContent,
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                } else {
                    htmlContent = 'Last Sync <strong>' + lastSyncTime + '</strong><br><br>Do you want to sync data now?';

                    Swal.fire({
                        title: 'Sync Data Powerpro',
                        html: htmlContent,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Sync Now',
                        cancelButtonText: 'Later',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            syncData(); // Panggil fungsi syncData jika dikonfirmasi
                        }
                    });
                    }
            } else {
                console.error('Last sync time is undefined or null.');
                // Menampilkan SweetAlert dialog jika lastSyncTime tidak terdefinisi
                Swal.fire({
                    title: 'Sync Data Powerpro',
                    text: 'Error: Last sync time is undefined or null. Do you want to sync data now?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Sync Now',
                    cancelButtonText: 'Later',
                }).then((result) => {
                    if (result.isConfirmed) {
                        syncData(); // Panggil fungsi syncData jika dikonfirmasi
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error getting last sync time from database:', error);
            
            // Menampilkan SweetAlert dialog jika terjadi kesalahan
            Swal.fire({
                title: 'Sync Data',
                text: 'Error retrieving last sync time. Do you want to sync data now?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Sync Now',
                cancelButtonText: 'Later',
            }).then((result) => {
                if (result.isConfirmed) {
                    syncData(); // Panggil fungsi syncData jika dikonfirmasi
                }
            });
        }
    });
}

function syncData() {
    showLoading();

    $.ajax({
        url: 'https://103.236.201.34:3000/replicate',
        method: 'GET',
        success: function(response) {
            console.log('Response from server:', response);
            hideLoading();
            
            // Simpan timestamp terakhir sync data ke dalam database
            $.ajax({
                url: '../roleadmin/save_last_sync.php', // endpoint untuk menyimpan ke database
                method: 'POST',
                data: { lastSyncTime: Math.floor(Date.now() / 1000) }, // Mengirim timestamp saat ini dalam UNIX format
                success: function(response) {
                    console.log('Last sync time saved to database:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error saving last sync time to database:', error);
                }
            });
            
            location.reload(); // Reload halaman setelah iziToast ditutup (opsional)
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            hideLoading();
        }
    });
};


// Function to get selected rows
function getSelectedRows() {
    var selectedRows = [];
    var checkboxes = document.querySelectorAll('.rowCheckbox:checked');

    checkboxes.forEach(function(checkbox) {
        var row = checkbox.closest('tr');
        selectedRows.push({
            room: row.querySelector('td:nth-child(4)').textContent.trim(), // Adjust based on your table structure
            folio: checkbox.value // Assuming 'folio' is the value you want to collect
        });
    });

    return selectedRows;
}

// Function to print selected QR codes
function printSelectedQRCode() {
    var selectedRows = getSelectedRows();

    if (selectedRows.length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'Please select at least one row to print.',
            position: 'topCenter'
        });
        return;
    }

    // Membuat iframe element
    var iframe = document.createElement('iframe');

    // Menetapkan beberapa gaya untuk iframe
    iframe.style.position = 'absolute';
    iframe.style.left = '-9999px'; // Mengatur posisi di luar layar
    iframe.style.width = '50mm'; // Menetapkan lebar iframe sesuai gaya label
    iframe.style.height = '25mm'; // Menetapkan tinggi iframe sesuai gaya label
    iframe.style.border = 'none'; // Menghapus border iframe

    // Menambahkan iframe ke dalam body dokumen
    document.body.appendChild(iframe);

    // Mendapatkan dokumen di dalam iframe
    var iframeDocument = iframe.contentWindow.document;

    // Menuliskan HTML, CSS, dan konten label ke dalam dokumen iframe
    iframeDocument.open();
    iframeDocument.write('<html><head><style>' +
                        '@page { size: 50mm 25mm; margin: 0; } ' +
                        'body { font-family: Arial, sans-serif; margin: 0; padding: 0; } ' +
                        '.label-container { width: 50mm; height: 25mm; padding: 0; box-sizing: border-box; page-break-after: always; display: flex; flex-direction: row; align-items: center; justify-content: space-between; overflow: hidden; position: relative; } ' +
                        '.text-container { width: 25mm; height: 25mm; padding: 2mm; box-sizing: border-box; display: flex; flex-direction: column; justify-content: center; } ' +
                        '.qrcode-container { width: 25mm; height: 25mm; padding: 2mm; box-sizing: border-box; display: flex; justify-content: center; align-items: center; } ' +
                        '.qrcode img { max-width: 100%; max-height: 100%;} ' +
                        '.text { font-size: 8pt; text-align: left; } ' +
                        '.textRoom { font-size: 14pt; text-align: left; } ' +
                        '</style>' +
                        '<script src="https://kit.fontawesome.com/3595b79eb9.js" crossorigin="anonymous"></script>' + // Tambahkan link untuk FontAwesome di sini
                        '</head><body>');

    // Iterasi untuk setiap baris yang dipilih
    selectedRows.forEach(function(row) {
        var qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=https://ecard.dafam.cloud/?folio=' + encodeURIComponent(row.folio) + '&size=80x80';

        iframeDocument.write('<div class="label-container">' +
                            '<div class="text-container">' + 
                            '<div class="textRoom"><b><i class="fa-solid fa-bed"></i> ' + row.room + '</b><br></div>' +
                            '<div class="text"><b>WiFi</b><br>dafamsemarang<br><b>PASSWORD</b><br>krasansare</div>' +
                            '</div>' +
                            '<div class="qrcode-container"><div class="qrcode"><img src="' + qrCodeUrl + '"></div></div>' +
                            '</div>');
    });

    // Menutup dokumen iframe setelah menulis semua konten
    iframeDocument.write('</body></html>');
    iframeDocument.close();


    iframe.onload = function() {
        iframe.contentWindow.print();
        setTimeout(function() {
            document.body.removeChild(iframe);
        }, 100);
    };
}

function printRow(button) {
    var row = button.closest('tr');
    var folio = row.querySelector('td:nth-child(3)').textContent.trim(); // Adjust based on your table structure
    var room = row.querySelector('td:nth-child(4)').textContent.trim(); // Adjust based on your table structure

    printQRCode(folio, room);
}

function printQRCode(folio, room) {
    var iframe = document.createElement('iframe');

    // CSS dan HTML untuk label QR code dan informasi
    iframe.style.position = 'absolute';
    iframe.style.left = '-9999px';
    iframe.style.width = '50mm';
    iframe.style.height = '25mm';
    iframe.style.border = 'none';

    document.body.appendChild(iframe);

    var iframeDocument = iframe.contentWindow.document;

    iframeDocument.open();
    iframeDocument.write('<html><head><style>' +
                        '@page { size: 50mm 25mm; margin: 0; } ' +
                        'body { font-family: Arial, sans-serif; margin: 0; padding: 0; } ' +
                        '.label-container { width: 50mm; height: 25mm; padding: 0; box-sizing: border-box; page-break-after: always; display: flex; flex-direction: row; align-items: center; justify-content: space-between; overflow: hidden; position: relative; } ' +
                        '.text-container { width: 25mm; height: 25mm; padding: 2mm; box-sizing: border-box; display: flex; flex-direction: column; justify-content: center; } ' +
                        '.qrcode-container { width: 25mm; height: 25mm; padding: 2mm; box-sizing: border-box; display: flex; justify-content: center; align-items: center; } ' +
                        '.qrcode img { max-width: 100%; max-height: 100%;} ' +
                        '.text { font-size: 8pt; text-align: left; } ' +
                        '.textRoom { font-size: 14pt; text-align: left; } ' +
                        '</style>' +
                        '<script src="https://kit.fontawesome.com/3595b79eb9.js" crossorigin="anonymous"></script>' + // Tambahkan link untuk FontAwesome di sini
                        '</head><body>');

    var qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=https://ecard.dafam.cloud/?folio=' + encodeURIComponent(folio) + '&size=80x80';

    iframeDocument.write('<div class="label-container">' +
                        '<div class="text-container">' +
                        '<div class="textRoom"><b><i class="fa-solid fa-bed"></i> ' + room + '</b><br></div>' +
                        '<div class="text"><b>WiFi</b><br>dafamsemarang<br><b>PASSWORD</b><br>krasansare</div>' +
                        '</div>' +
                        '<div class="qrcode-container"><div class="qrcode"><img src="' + qrCodeUrl + '"></div></div>' +
                        '</div>');

    iframeDocument.write('</body></html>');
    iframeDocument.close();

    iframe.onload = function() {
        iframe.contentWindow.print();
        setTimeout(function() {
            document.body.removeChild(iframe);
        }, 100);
    };
}

// Function to handle Select All checkbox
document.getElementById('selectAllCheckbox').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('.rowCheckbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('selectAllCheckbox').checked;
    });
});


"use strict";