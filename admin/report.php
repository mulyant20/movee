<?php
    include '../utils/connection.php';
    require('../utils/fpdf/fpdf.php');
    
    $usersDetail = mysqli_query(
        $conn, 
        "SELECT users.*, packages.name AS namePackages 
            FROM users 
         LEFT JOIN 
            packages ON packages.id = users.hasSubscribe
    ");

    $subscriberDetail = mysqli_query(
        $conn,
        "SELECT
            packages.name, count(users.hasSubscribe) as count from packages
         LEFT JOIN
            users ON users.hasSubscribe = packages.id
         GROUP BY
            packages.name
    ");
    
    $countUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) AS allUser from users"));
    $countPackages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as allPackages from packages"));

    $pdf = new FPDF('P', 'mm', 'A5');

    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(130, 7, 'LAPORAN BULAN JANUARI 2022', 0, 1, 'C');
    $pdf->Cell(20, 8, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 7, 'Jumlah users : '.$countUsers['allUser'], 0, 1);
    
    $pdf->Cell(10, 4, '', 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(8, 8, 'No', 1, 0);
    $pdf->Cell(32, 8, 'Username', 1, 0);
    $pdf->Cell(48, 8, 'Email', 1, 0);
    $pdf->Cell(40, 8, 'Jenis Langganan', 1, 1);
    $num = 0;

    while ($row = mysqli_fetch_array($usersDetail)) {
        $pdf->Cell(8, 6, ++$num, 1, 0);
        $pdf->Cell(32, 6, $row['username'], 1, 0);
        $pdf->Cell(48, 6, $row['email'], 1, 0);
        $pdf->Cell(40, 6, $row['namePackages'], 1, 1);
    }

    $pdf->Cell(20, 8, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 7, 'Jumlah paket tersedia : '.$countPackages['allPackages'], 0, 1);

    $pdf->Cell(10, 4, '', 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(8, 8, 'No', 1, 0);
    $pdf->Cell(52, 8, 'Nama paket', 1, 0);
    $pdf->Cell(48, 8, 'Jumlah Pelanggan', 1, 1);
    $num = 0;
    while ($row = mysqli_fetch_array($subscriberDetail)) {
        $pdf->Cell(8, 6, ++$num, 1, 0);
        $pdf->Cell(52, 6, $row['name'], 1, 0);
        $pdf->Cell(48, 6, $row['count'], 1, 1);
    }

    $pdf->Output();