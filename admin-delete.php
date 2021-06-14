<?php

include 'common.php';

$hash = $_GET['hash'] ?? '';
$file = session_save_path() . '/sess_' . $hash;

if (empty($hash)) {
    $sessionHashes = scandir(session_save_path());

    foreach ($sessionHashes as $sessionHash) {

        if (strpos($sessionHash, "sess_") !== false) {
            unlink(session_save_path() . '/' . $sessionHash);
        }
    }

    header('location: admin.php');
    exit();
}

if ($file && file_exists($file)) {
    unlink($file);

    header('location: admin.php');
    exit();
}
