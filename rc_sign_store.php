<?php
header("Access-Control-Allow-Origin: https://rc.dafam.cloud");

// Memuat file connection.php untuk koneksi database
require_once 'helper/connection.php';
require_once 'vendor/autoload.php'; // Memuat TCPDF dan FPDI

use setasign\Fpdi\Tcpdf\Fpdi;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui POST
    $signatureData = $_POST['signature'];
    $folio = $_POST['folio'];
    $room = $_POST['room'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dateci = $_POST['dateci'];
    $dateco = $_POST['dateco'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $roomtype = $_POST['roomtype'];
    $email = $_POST['email'];
    $pdfFile = $_POST['pdfFile'];

    // Dekode data tanda tangan dari base64 menjadi gambar
    $decodedSignature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
    $signatureFilename = 'signature_' . uniqid() . '.png';
    $signatureFilePath = __DIR__ . '/signature/' . $signatureFilename;

    // Memastikan direktori 'signature' tersedia, jika tidak, buat direktori tersebut
    if (!is_dir(__DIR__ . '/signature')) {
        mkdir(__DIR__ . '/signature', 0775, true);
    }

    // Menyimpan tanda tangan ke direktori server
    file_put_contents($signatureFilePath, $decodedSignature);

    // Path file PDF yang akan diolah dan path untuk menyimpan hasil PDF yang ditandatangani
    $inputPdfFilename = __DIR__ . '/attachment_pdf/' . $pdfFile;
    $outputPdfFilename = 'regform_' . $folio . '_signed.pdf';
    $outputPdfFilePath = __DIR__ . '/signed_doc/' . $outputPdfFilename;
    $at_regform = '../signed_doc/' . $outputPdfFilename;

    // Memastikan direktori 'signed_doc' tersedia, jika tidak, buat direktori tersebut
    if (!is_dir(__DIR__ . '/signed_doc')) {
        mkdir(__DIR__ . '/signed_doc', 0775, true);
    }

    // Memanggil fungsi untuk menambahkan tanda tangan ke PDF
    addSignatureToPdf($inputPdfFilename, $signatureFilePath, $outputPdfFilePath, $name, $phone);

    // Memeriksa koneksi ke database (gunakan $connection dari connection.php)
    if (!$connection) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Memulai transaksi database
    $connection->begin_transaction();

    try {
        // Persiapan statement SQL untuk memperbarui tabel FOGUEST
        $stmt = $connection->prepare("UPDATE FOGUEST SET rc_signature_path = ?, at_regform = ?, resv_phone = ?, resv_email = ? WHERE folio = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $connection->error);
        }

        // Bind parameter ke statement SQL
        $stmt->bind_param("sssss", $signatureFilename, $at_regform, $phone, $email, $folio);

        // Eksekusi statement SQL
        if (!$stmt->execute()) {
            throw new Exception("Gagal menyimpan data: " . $stmt->error);
        }

        // Komit transaksi
        $connection->commit();

        // Memberikan respons HTTP 200 (OK) ke client
        http_response_code(200);
        echo "Data berhasil disimpan";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $connection->rollback();
        http_response_code(500);
        echo "Gagal menyimpan data" . $e->getMessage();
    }

    // Menutup statement dan koneksi database
    if (isset($stmt)) {
        $stmt->close();
    }
    $connection->close();
} else {
    // Jika bukan metode POST, kirim respons HTTP 405 (Method Not Allowed)
    http_response_code(405);
    echo "Metode tidak diizinkan.";
}

// Fungsi untuk menambahkan tanda tangan ke PDF menggunakan library FPDI
function addSignatureToPdf($inputPdfPath, $signatureImagePath, $outputPdfPath, $name, $phone) {
    $pdf = new Fpdi();

    // Mengambil jumlah halaman dari file PDF
    $pageCount = $pdf->setSourceFile($inputPdfPath);

    // Iterasi setiap halaman
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        // Jika sudah pada halaman terakhir, tambahkan tanda tangan dan informasi lainnya
        if ($pageNo == $pageCount) {
            $pdf->Image($signatureImagePath, 150, 235, 40, 20, 'PNG');
            $pdf->SetFont('', '', 9); // Set ukuran font ke 9
            $pdf->Text(137, 56, 'NAME       ' . $name);
            $pdf->Text(137, 61, 'MOBILE     ' . $phone);
        }
    }

    // Simpan PDF ke path yang ditentukan
    $pdf->Output($outputPdfPath, 'F');
}

// header("Access-Control-Allow-Origin: https://rc.dafam.cloud");

// // Memuat file connection.php untuk koneksi database
// require_once 'helper/connection.php';
// require_once 'vendor/autoload.php'; // Memuat TCPDF dan FPDI

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Mengambil data yang dikirimkan melalui POST
//     $folio = $_POST['folio'];
//     $room = $_POST['room'];
//     $name = $_POST['name'];
//     $phone = $_POST['phone'];
//     $dateci = $_POST['dateci'];
//     $dateco = $_POST['dateco'];
//     $birthday = $_POST['birthday'];
//     $address = $_POST['address'];
//     $roomtype = $_POST['roomtype'];
//     $email = $_POST['email']; // Menambahkan variabel email dari POST data

//     // Memeriksa koneksi ke database (gunakan $connection dari connection.php)
//     if (!$connection) {
//         die("Koneksi gagal: " . mysqli_connect_error());
//     }

//     // Memulai transaksi database
//     $connection->begin_transaction();

//     try {
//         // Persiapan statement SQL untuk memperbarui tabel FOGUEST
//         $stmt = $connection->prepare("UPDATE FOGUEST SET resv_phone = ?, resv_email = ? WHERE folio = ?");
//         if ($stmt === false) {
//             throw new Exception("Prepare failed: " . $connection->error);
//         }

//         // Bind parameter ke statement SQL
//         $stmt->bind_param("sss", $phone, $email, $folio);

//         // Eksekusi statement SQL
//         if (!$stmt->execute()) {
//             throw new Exception("Gagal menyimpan data: " . $stmt->error);
//         }

//         // Komit transaksi
//         $connection->commit();

//         // Memberikan respons HTTP 200 (OK) ke client
//         http_response_code(200);
//         echo "Data berhasil disimpan";
//     } catch (Exception $e) {
//         // Rollback transaksi jika terjadi kesalahan
//         $connection->rollback();
//         http_response_code(500);
//         echo "Gagal menyimpan data: " . $e->getMessage();
//     }

//     // Menutup statement dan koneksi database
//     if (isset($stmt)) {
//         $stmt->close();
//     }
//     $connection->close();
// } else {
//     // Jika bukan metode POST, kirim respons HTTP 405 (Method Not Allowed)
//     http_response_code(405);
//     echo "Metode tidak diizinkan.";
// }

?>