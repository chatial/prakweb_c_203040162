<?php
/*
    Ahmad Reyhan Ronaldo
    203040162
    Jumat,13.00
*/
?>

<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("location: login.php");
  exit;
}
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data buku berdasarkan id
$row = query("SELECT * FROM buku WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil di ubahkan atau tidak
    if (ubah($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'admin.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'admin.php';
			</script>
		";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Data Buku</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>

    <div class="form">
        <h1>Form Ubah Data Buku</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $row["img"]; ?>">
            <ul>
                <li>
                    <label for="img">Gambar : </label>  <br>
                    <img src="../img/<?= $row["img"]; ?>" width="50"> <br>
                    <input type="file" name="img" id="img"> <br>
                </li>
                <li>
                    <label for="judul">Judul : </label> <br>
                    <input type="text" name="judul" id="judul" required 
                    value="<?= $row["judul"]; ?>"> <br>
                </li>
                <li>
                    <label for="pengarang">Pengarang : </label> <br>
                    <input type="text" name="pengarang" id="pengarang" required
                    value="<?= $row["pengarang"]; ?>"> <br>
                </li>
                <li>
                    <label for="terbit">Terbit : </label> <br>
                    <input type="date" name="terbit" id="terbit" required
                    value="<?= $row["terbit"]; ?>"> <br>
                </li>
                <li>
                    <label for="penerbit">Dimensi : </label> <br>
                    <input type="text" name="penerbit" id="penerbit" required
                    value="<?= $row["penerbit"]; ?>"> <br>
                </li>
                <li>
                    <button type="submit" name="ubah">Ubah Data!</button>
                    <button type="submit">
                        <a href="admin.php" style="text-decoration: none; color:black;">Kembali</a>
                    </button>
                </li>
            </ul>
        </form>
    </div>

</body>

</html>
