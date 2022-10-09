<?php

class produk{
    public $judul= "Judul",
    $penulis="penulis",
    $penerbit="penerbit",
    $harga=0;

    public function __construct( $judul= "judul", $penulis = "penulis",$penerbit = "penerbit",$harga = "harga")
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
    }

    public function getLabel(){
        return "$this->judul,$this->penulis, $this->penerbit";
    }
}


class CetakInfoProduk {
    public function cetak(produk $produk){
        $str = "{$produk->judul} | {$produk->getLabel()} Rp. {$produk->harga}";
        return $str;
    }
}



$produk1 = new produk("Naruto", "Masashi kishimoto", "Shonen jump", 33333);
$produk2 = new produk("Uncharted","Neil Druckmann","Sony Computer",200000);
$produk3 = new produk("Dragon Ball","Goku", "Saitama",9999);

 echo "komik : " .$produk1->getLabel();
 echo "<hr>";
 echo "orang : " .$produk2->getLabel();
echo "<hr>";
 $infoProduk1 = new CetakInfoProduk();
 echo $infoProduk1->cetak($produk2);

?>