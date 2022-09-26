<?php
/*
    Ahmad Reyhan Ronaldo
    203040162
    Jumat,13.00
*/
?>

<?php 
//Menghubungkan dengan file phplainnya
require 'php/functions.php';
//Melakukan query dari database
$books = query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOVEL</title>
    <link rel="stylesheet" href="img/css/bootstrap.min.css">
    
</head>
<body>

<div class="container mt-3">
  <h1>Daftar Novel</h1>
  <div class="card" style="width: 45rem">
    <div class="card-body">
      <div class="row">
        <div class="col md-6">
          <?php foreach( $books as $row ) : ?>
            <p class="judul">
              <a href="php/detail.php?id=<?= $row['id'] ?>">
                <img src="img/<?= $row["img"]; ?>">
              </a>
            </p>  
          <?php endforeach;  ?>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>