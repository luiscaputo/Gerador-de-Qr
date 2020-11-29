<?php
include "qrcode.php";
    $x = new QrCode();
    $y-> pegarTexto('qr');
    //$y = $_GET['qr'];
    // Include qrcode.php file.
    
    // Create object
    $qc = new QRCODE();
    // Create Text Code
    $qc->TEXT("$y");
    // Save QR Code
    $qc->QRCODE(400,$y.".png");
    echo 'this Qr are to - $y';
?>