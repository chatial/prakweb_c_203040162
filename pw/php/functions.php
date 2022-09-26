<?php 
//Pengkoneksian menuju database
function koneksi() {
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "prakweb_c_203040162_pw");

    return $conn;
}

//Melakukan query dan memasukannya ke Array
function query($sql) {
    $conn = koneksi();
    $result = mysqli_query($conn, $sql);
    $row = [];
    while ($row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

//fungsi untuk menambahkan data didalam database
function tambah($data) {
    $conn = koneksi();

    // upload gambar
    $img = upload();
    if( !$img ) {
        return false;
    }


    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $terbit = htmlspecialchars($data["terbit"]);
    $dimensi = htmlspecialchars($data["dimensi"]);

    $query = "INSERT INTO buku
                VALUES 
             ('', '$img', '$judul', '$pengarang', '$terbit', '$dimensi')
             ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    
    $namaFile = $_FILES['img']['name'];
    $ukuranFile = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpName = $_FILES['img']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
            return false;
    }

    // cek jika ukuran terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
            return false;
    }
    
    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;

    


}






function hapus($id) {
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function ubah($data) {
    $conn = koneksi();

    $id = $data["id"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    
    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['img']['error'] === 4) {
        $img = $gambarLama;   
    } else {
        $img = upload();
    }


    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $terbit = htmlspecialchars($data["terbit"]);
    $dimensi = htmlspecialchars($data["penerbit"]);

    $query = "UPDATE buku SET
                img = '$img',
                judul = '$judul',
                pengarang = '$pengarang',
                terbit = '$terbit',
                penerbit = '$penerbit'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM buku
            WHERE
            judul LIKE '%$keyword%'
        ";
    return query($query);
}


function registrasi($data) {
    $conn = koneksi();

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // username sudah ada apa belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE 
        username = '$username'");

        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                    alert('username sudah terdaftar!')
            </script>";
        return false;
        }

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT); 
    
    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username'
    , '$password')");

    return mysqli_affected_rows($conn);






}















?>