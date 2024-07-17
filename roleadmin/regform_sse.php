<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Table Update with SSE</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>FOGUEST Data</h2>
                <table id="guestTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>REGCARD</th>
                            <th>NAME</th>
                            <th>FOLIO</th>
                            <th>ROOM</th>
                            <th>ROOMTYPE</th>
                            <th>ROOM STATUS</th>
                            <th>CHECKIN</th>
                            <th>CHECKOUT</th>
                            <th>DATEOFBIRTH</th>
                            <th>PHONE</th>
                            <th>EMAIL</th>
                            <th>GUESTBILL</th>
                            <th>CL / VOUCHER</th>
                            <th>STATUS</th>
                            <th>DATECREATE</th>
                        </tr>
                    </thead>
                    <tbody id="guestTableBody">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    // Event listener untuk SSE
    var eventSource = new EventSource('sse-server.php');
    eventSource.onmessage = function(event) {
        var data = JSON.parse(event.data);
        updateTable(data);
    };

    // Function untuk memperbarui tabel
    function updateTable(data) {
        var tableBody = document.getElementById('guestTableBody');
        tableBody.innerHTML = '';
        data.forEach(function(row) {
            var newRow = `
                <tr>
                    <td>${renderButtons(row.at_regform, row.folio)}</td>
                    <td>${row.fname}</td>
                    <td><a href="https://ecard.dafam.cloud/?folio=${row.folio}" target="_blank">${row.folio}</a></td>
                    <td>${row.room}</td>
                    <td>${row.roomtype}</td>
                    <td>${renderRoomStatus(row.foliostatus)}</td>
                    <td>${row.dateci}</td>
                    <td>${row.dateco}</td>
                    <td>${row.birthday}</td>
                    <td>${row.resv_phone}</td>
                    <td>${row.resv_email}</td>
                    <td>${renderGuestBill(row.g_signature_path, row.at_guestfolio)}</td>
                    <td>${renderCLVoucher(row.at_ota_voucher)}</td>
                    <td>${renderStatus(row.status)}</td>
                    <td>${row.datecreate}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
        });
    }

    // Function untuk menampilkan tombol berdasarkan kondisi
    function renderButtons(at_regform, folio) {
        var buttons = '';
        if (!at_regform) {
            buttons += `<button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal" data-id="${folio}"><i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i></button>`;
        } else {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_regform}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        }
        if (!folio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="regform_edit.php?folio=${folio}"><i class="fa-regular fa-pen-to-square fa-xl"></i></a>`;
        }
        if (!row.rc_signature_path) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
        } else {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan status ruangan
    function renderRoomStatus(foliostatus) {
        switch (foliostatus) {
            case 'I': return '<span style="color: #36BA98;">inHouse</span>';
            case 'O': return '<span style="color: #C80036;">CheckOut</span>';
            case 'C': return '<span style="color: #1679AB;">Confirm</span>';
            case 'G': return '<span style="color: #102C57;">Guarantee</span>';
            case 'T': return '<span style="color: #43919B;">Tentative</span>';
            default: return '<span class="text-muted">Cancel</span>';
        }
    }

    // Function untuk menampilkan tombol Guest Bill
    function renderGuestBill(g_signature_path, at_guestfolio) {
        var buttons = '';
        if (!g_signature_path && at_guestfolio) {
            buttons += `<button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal2" data-id="${folio}">
                <i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i>
            </button>`;
        }
        if (at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_guestfolio}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        }
        if (!at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="guestfolio.php?folio=${folio}">
                <i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #0f97ff;"></i> upload
            </a>`;
        }
        if (!g_signature_path && at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
        }
        if (g_signature_path) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan tombol CL / Voucher
    function renderCLVoucher(at_ota_voucher) {
        var buttons = '';
        if (at_ota_voucher) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_ota_voucher}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        } else {
            buttons += `<a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="Voucher.php?folio=${folio}"><i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #0f97ff;"></i> upload</a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan status
    function renderStatus(status) {
        switch (status) {
            case 'I': return '<span style="color: #36BA98;">CheckIn</span>';
            case 'O': return '<span style="color: #C80036;">CheckOut</span>';
            case 'D': return '<span style="color: #E4E6EB;">DNB</span>';
            default: return '<span class="text-muted">Delete</span>';
        }
    }
    </script>
</body>
</html>