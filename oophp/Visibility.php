<?php 

class Produk {
    public $judul, 
           $penulis,
           $penerbit;
           
           protected $diskon = 0;
           private $harga;

    public function __construct( $judul = "judul", $penulis = "penulis", $penerbit = "penerbit", $harga = 0 ) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
    }

    public function getHarga() {
        return $this->harga - ( $this->harga * $this->diskon / 100 );
    }

    public function getLabel() {
        return "$this->penulis, $this->penerbit";
    }

    public function getInfoProduk() {
        $str = "{$this->judul} | {$this->getLabel()} (Rp. {$this->harga})";

        return $str;
    }

}


class Komik extends Produk {
    public $jmlHalaman;

    public function __construct( $judul = "judul", $penulis = "penulis", $penerbit = "penerbit", $harga = 0, $jmlHalaman = 0 ) {

        parent::__construct( $judul, $penulis, $penerbit, $harga );

        $this->jmlHalaman = $jmlHalaman;
    }

    public function getInfoProduk() {
        $str = "Komik : " . parent::getInfoProduk() . " - {$this->jmlHalaman} Halaman.";
        return $str;
    }
}


class asal extends Produk {
    public $waktuMain;

    public function __construct( $judul = "judul", $penulis = "penulis", $penerbit = "penerbit", $harga = 0, $asal = 0 ) {
        parent::__construct( $judul, $penulis, $penerbit, $harga );

        $this->asal = $asal;
    }

    public function setDiskon( $diskon ) {
        $this->diskon = $diskon;
    }

    public function getInfoProduk() {
        $str = "jam : " . parent::getInfoProduk() . " ~ {$this->asal} jam.";
        return $str;
    }
}


class CetakInfoProduk {
    public function cetak( Produk $produk ) {
        $str = "{$produk->judul} | {$produk->getLabel()} (Rp. {$produk->harga})";
        return $str;
    }
}


$produk1 = new Komik("Naruto", "Masashi Kishimoto", "Shonen Jump", 30000,100,0 ,"Komik");
$produk2 = new asal("Uncharted","Neil Druckmann","Sony Computer", 250000, 120, 50, "Game");

echo $produk1->getInfoProduk();
echo "<Hr>";
echo $produk2->getInfoProduk();