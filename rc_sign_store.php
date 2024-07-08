<?php

header("Access-Control-Allow-Origin: https://rc.dafam.cloud");

// Memuat file connection.php untuk koneksi database
require_once 'helper/connection.php';
require_once 'vendor/autoload.php'; // Memuat TCPDF dan FPDI

use setasign\Fpdi\Tcpdf\Fpdi;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui POST
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
    $signatureData = $_POST['signature'];



   // Dekode data tanda tangan dari base64 menjadi gambar
   $decodedSignature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
   $signatureFilename = 'signature_' . uniqid() . '.png';
   $signatureFilePath = __DIR__ . '/signature/' . $signatureFilename;

   // Cek apakah direktori 'signature' ada, jika tidak, buat direktori tersebut
   if (!is_dir(__DIR__ . '/signature')) {
       mkdir(__DIR__ . '/signature', 0775, true);
   }

   // Simpan tanda tangan ke direktori server
   file_put_contents($signatureFilePath, $decodedSignature);

   $inputPdfFilename = __DIR__ . '/RegcardPDF/' . $pdfFile;
   $outputPdfFilename = 'regcard_' . $folio . '_signed.pdf';
   $outputPdfFilePath = __DIR__ . '/signed_doc/' . $outputPdfFilename;
   $at_regform = '../signed_doc/' . $outputPdfFilename;

   // Cek apakah direktori 'signed_doc' ada, jika tidak, buat direktori tersebut
   if (!is_dir(__DIR__ . '/signed_doc')) {
       mkdir(__DIR__ . '/signed_doc', 0775, true);
   }

   // Tambahkan tanda tangan ke PDF
   addSignatureToPdf($inputPdfFilename, $signatureFilePath, $outputPdfFilePath, $name, $phone, $email, $dateci, $dateco, $birthday, $address, $roomtype, $folio, $room);

   // Memeriksa koneksi (gunakan $connection dari connection.php)
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
        echo "Gagal menyimpan data: " . $e->getMessage();
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

function addSignatureToPdf($inputPdfPath, $signatureImagePath, $outputPdfPath, $name, $phone, $email, $dateci, $dateco, $birthday, $address, $roomtype, $folio, $room) {
    $pdf = new FPDI();
    $pageCount = $pdf->setSourceFile($inputPdfPath);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        // Jika sudah pada halaman terakhir, tambahkan tanda tangan dan informasi lainnya
        if ($pageNo == $pageCount) {
            $pdf->Image($signatureImagePath, 139, 238, 57, 19, 'PNG');
            $pdf->SetFont('', '', 8); // Set ukuran font ke 9
            $pdf->Text(148, 50, $name);
            $pdf->Text(116, 154, $phone);
            $pdf->Text(137, 57, 'EMAIL  ' . $email);
            $pdf->Text(53, 50, $dateci);
            $pdf->Text(53, 55, $dateco);
            $pdf->Text(125, 165, $birthday);
            $pdf->Text(36, 134, $address);
            $pdf->Text(80, 108, $roomtype);
            $pdf->Text(35, 89, $folio);
            $pdf->Text(53, 40, $room);
        }

    }

    // Simpan PDF ke jalur output
    $pdf->Output($outputPdfPath, 'F');
}

?>