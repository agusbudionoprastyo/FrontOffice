<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Updates using Server-Sent Events (SSE)</title>
    <!-- Tambahkan link CSS Bootstrap dan jQuery jika diperlukan -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Live Updates using Server-Sent Events (SSE)</h1>
        <table class="table table-hover">
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
            <tbody id="table-body">
                <!-- Isi tabel akan diperbarui secara dinamis -->
            </tbody>
        </table>
    </div>

    <script>
        // Fungsi untuk menangani SSE
        function handleSSE(event) {
            const sseData = JSON.parse(event.data); // Mendapatkan data dari pesan SSE
            const tableBody = document.getElementById('table-body');

            // Membuat baris baru untuk data yang diterima
            const newRow = `
                <tr>
                    <td>${getRegcardButtons(sseData)}</td>
                    <td>${sseData.fname}</td>
                    <td><a href="https://ecard.dafam.cloud/?folio=${sseData.folio}" target="_blank">${sseData.folio}</a></td>
                    <td>${getRoomInfo(sseData)}</td>
                    <td>${sseData.roomtype}</td>
                    <td>${getFoliostatus(sseData)}</td>
                    <td>${sseData.dateci}</td>
                    <td>${sseData.dateco}</td>
                    <td>${sseData.birthday}</td>
                    <td>${sseData.resv_phone}</td>
                    <td>${sseData.resv_email}</td>
                    <td>${getGuestbillButtons(sseData)}</td>
                    <td>${getOtaVoucherButtons(sseData)}</td>
                    <td>${getStatus(sseData)}</td>
                    <td>${sseData.datecreate}</td>
                </tr>
            `;

            // Menambahkan baris baru ke tabel
            tableBody.insertAdjacentHTML('afterbegin', newRow);
        }

        // Menghubungkan ke script SSE di server
        const eventSource = new EventSource('sse-server.php');

        // Menangkap dan menampilkan data dari SSE
        eventSource.addEventListener('message', handleSSE);

        // Fungsi untuk menampilkan tombol pada kolom REGCARD
        function getRegcardButtons(data) {
            let buttons = '';

            if (data.at_regform === null) {
                buttons += `<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#deviceModal" data-id="${data.folio}"><i class="fa-solid fa-paper-plane" style="color: #f82b85;"></i></button>`;
            } else {
                buttons += `<a class="btn btn-sm btn-default" href="${data.at_regform}" target="_blank"><i class="fa-solid fa-file-pdf" style="color: #B5120C;"></i></a>`;
            }

            if (data.room === null) {
                buttons += `<a class="btn btn-sm btn-default" href="regform_edit.php?folio=${data.folio}"><i class="fa-regular fa-pen-to-square"></i></a>`;
            }

            if (data.rc_signature_path === null) {
                buttons += `<a class="btn btn-sm btn-default">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
            } else {
                buttons += `<a class="btn btn-sm btn-default">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
            }

            return buttons;
        }

        // Fungsi untuk menampilkan informasi kamar pada kolom ROOM
        function getRoomInfo(data) {
            if (data.room !== null) {
                return `<input type="checkbox" class="btn rowCheckbox" name="selectedRows[]" value="${data.folio}" data-room="${data.room}" data-folio="${data.folio}">
                        <button class="btn btn-default rounded-pill" onclick="printRow(this)"><i class="fa-solid fa-print"></i></button>
                        ${data.room}`;
            } else {
                return '';
            }
        }

        // Fungsi untuk menampilkan status pada kolom ROOM STATUS
        function getFoliostatus(data) {
            let status = '';

            switch (data.foliostatus) {
                case 'I':
                    status = `<span style="color: #36BA98;">inHouse</span>`;
                    break;
                case 'O':
                    status = `<span style="color: #C80036;">CheckOut</span>`;
                    break;
                case 'C':
                    status = `<span style="color: #1679AB;">Confirm</span>`;
                    break;
                case 'G':
                    status = `<span style="color: #102C57;">Guarantee</span>`;
                    break;
                case 'T':
                    status = `<span style="color: #43919B;">Tentative</span>`;
                    break;
                default:
                    status = `<span class="text-muted">Cancel</span>`;
                    break;
            }

            return status;
        }

        // Fungsi untuk menampilkan tombol pada kolom GUESTBILL
        function getGuestbillButtons(data) {
            let buttons = '';

            if (data.g_signature_path === null && data.at_guestfolio !== null) {
                buttons += `<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#deviceModal2" data-id="${data.folio}"><i class="fa-solid fa-paper-plane" style="color: #f82b85;"></i></button>`;
            }

            if (data.at_guestfolio !== null) {
                buttons += `<a class="btn btn-sm btn-default" href="${data.at_guestfolio}" target="_blank"><i class="fa-solid fa-file-pdf" style="color: #B5120C;"></i></a>`;
            }

            if (data.at_guestfolio === null) {
                buttons += `<a class="btn btn-sm btn-light rounded-pill" href="guestfolio.php?folio=${data.folio}"><i class="fa-solid fa-cloud-arrow-up" style="color: #0f97ff;"></i> upload</a>`;
            }

            if (data.g_signature_path === null && data.at_guestfolio !== null) {
                buttons += `<a class="btn btn-sm btn-default">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
            } else {
                buttons += `<a class="btn btn-sm btn-default">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
            }

            return buttons;
        }

        // Fungsi untuk menampilkan tombol pada kolom CL / VOUCHER
        function getOtaVoucherButtons(data) {
            let buttons = '';

            if (data.voucher_path !== null) {
                buttons += `<a class="btn btn-sm btn-default" href="${data.voucher_path}" target="_blank"><i class="fa-solid fa-file-pdf" style="color: #B5120C;"></i></a>`;
            }

            if (data.voucher_path === null && data.status === 'F') {
                buttons += `<button class="btn btn-sm btn-light rounded-pill" data-toggle="modal" data-target="#deviceModal1" data-id="${data.folio}"><i class="fa-solid fa-cloud-arrow-up" style="color: #0f97ff;"></i> upload</button>`;
            }

            return buttons;
        }

        // Fungsi untuk menampilkan status pada kolom STATUS
        function getStatus(data) {
            let status = '';

            switch (data.status) {
                case 'A':
                    status = `<span style="color: #36BA98;">active</span>`;
                    break;
                case 'F':
                    status = `<span style="color: #C80036;">inactive</span>`;
                    break;
                case 'T':
                    status = `<span style="color: #43919B;">tentative</span>`;
                    break;
                default:
                    status = `<span class="text-muted">cancelled</span>`;
                    break;
            }

            return status;
        }

        // Fungsi untuk mencetak baris kamar yang dipilih
        function printRow(button) {
            const room = button.parentNode.querySelector('input').getAttribute('data-room');
            const folio = button.parentNode.querySelector('input').getAttribute('data-folio');

            console.log(`Print room ${room} with folio ${folio}`);
            // Implementasikan logika pencetakan di sini
        }
    </script>
</body>
</html>