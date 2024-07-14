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
        alert('Please select at least one row to print.');
        return;
    }

    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.left = '-9999px'; // Position off-screen
    iframe.style.width = '50mm'; // Set iframe width as per label style
    iframe.style.height = '25mm'; // Set iframe height as per label style
    iframe.style.border = 'none'; // Remove iframe border
    document.body.appendChild(iframe);

    var iframeDocument = iframe.contentWindow.document;
    iframeDocument.open();
    iframeDocument.write('<html><head><style>' +
                         '@page { size: 50mm 25mm; margin: 0; } ' +
                         'body { font-family: Arial, sans-serif; margin: 0; padding: 0; } ' +
                         '.label { width: 50mm; height: 25mm; padding: 5mm; box-sizing: border-box; ' +
                         'page-break-after: always; display: flex; flex-direction: row; align-items: center; ' +
                         'justify-content: center; overflow: hidden; position: relative; } ' +
                         '.qrcode { width: 15mm; height: 15mm; display: flex; justify-content: center; ' +
                         'align-items: center; } ' +
                         '.text { font-size: 8pt; text-align: left; margin-right: 10mm; } ' +
                         '</style></head><body>');

    selectedRows.forEach(function(row) {
        var qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=https://ecard.dafam.cloud/?folio=' + encodeURIComponent(row.folio) + '&size=80x80';

        iframeDocument.write('<div class="label">' +
                             '<div class="text"><b>Room</b> ' + row.room + '<br><br><b>Wifi</b><br> dafam<br><b>Password</b><br> krasansare</div>' +
                             '<div class="qrcode"><img src="' + qrCodeUrl + '"></div>' +
                             '</div>');
    });

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