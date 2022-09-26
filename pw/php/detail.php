<?php 
//mengecek apakah  ada id yang di kirimkan
//jika tidak maka akan di kembalikan ke halaman index.php
if(!isset($_GET['id'])) {
    header("location: ../index.php");
    exit;
}

require 'functions.php';

//Mengambil id dari url
$id = $_GET['id'];

//melakukan query dengan parameter id yang di ambil dari url 
$row = query("SELECT * FROM buku WHERE id= $id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js">
    
</head>
<body>
    <div class="container">
        <h1>Novel</h1>
        <div class="card border border-primary" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4 mt-3 pl-2">
                <img src="../img/<?= $row["img"]; ?>" class="card-img border border-dark">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title m-1"><?= $row["judul"] ?></h5>
                            <ul>
                                <li class="card-text"><?= $row["pengarang"] ?></li>
                                <li class="card-text"><?= $row["terbit"] ?></li>
                                <li class="card-text"><?= $row["penerbit"] ?></li>
                            </ul>
                        <button class="tombol-kembali btn btn-outline-primary"><a href="../index.php">kembali</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>