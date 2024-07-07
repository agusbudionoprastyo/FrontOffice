<?php
session_start();
require_once '../helper/connection.php';

$tokenId = isset($_GET['token_id']) ? $_GET['token_id'] : null;
$regformId = isset($_GET['regform_id']) ? $_GET['regform_id'] : null;

if ($tokenId === null || $regformId === null || !is_numeric($tokenId) || !is_numeric($regformId)) {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'ID tidak valid atau tidak lengkap'
    ];
    header('Location: regform.php');
    exit;
}

// Query untuk update gf_device_token di regform
$queryRegform = "UPDATE FOGUEST SET rc_device_token = ? WHERE folio = ?";

// Query untuk update folio_id di token_device
$queryTokenDevice = "UPDATE token_device SET regcard_id = ? WHERE token_id = ?";

// Persiapan statement untuk regform
if ($stmtRegform = mysqli_prepare($connection, $queryRegform)) {
    mysqli_stmt_bind_param($stmtRegform, "ii", $tokenId, $regformId);
    mysqli_stmt_execute($stmtRegform);

    if (mysqli_stmt_affected_rows($stmtRegform) > 0) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Token device berhasil dikirim'
        ];
    } else {
        // Jika tidak ada perubahan data di regform, tetap set status ke success tapi ubah pesannya
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Token device berhasil dikirim'
        ];
    }

    mysqli_stmt_close($stmtRegform);
} else {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Kesalahan saat menyiapkan query regform: ' . mysqli_error($connection)
    ];
}

// Persiapan statement untuk token_device
if ($stmtTokenDevice = mysqli_prepare($connection, $queryTokenDevice)) {
    mysqli_stmt_bind_param($stmtTokenDevice, "ii", $regformId, $tokenId);
    mysqli_stmt_execute($stmtTokenDevice);

    if (mysqli_stmt_affected_rows($stmtTokenDevice) > 0) {
        $_SESSION['info']['message'] .= ' dan siap untuk di tandatangani';
    } else {
        $_SESSION['info']['message'] .= ' Tidak ada perubahan data';
    }

    mysqli_stmt_close($stmtTokenDevice);
} else {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Kesalahan saat menyiapkan query token_device: ' . mysqli_error($connection)
    ];
}

header('Location: regform.php');
exit;