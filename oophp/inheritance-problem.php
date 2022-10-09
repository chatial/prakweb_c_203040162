<?php

class produk{
    public $judul= "Judul",
    $penulis="penulis",
    $penerbit="penerbit",
    $harga=0,
    $jmlHalaman="jmlHalaman",
    $asal="asal",
    $tipe;

    public function __construct( $judul= "judul", $penulis = "penulis",$penerbit = "penerbit",$harga = "harga", $jmlHalaman =0, $asal="", $tipe)
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga; 
        $this->jmlHalaman= $jmlHalaman;
        $this->asal= $asal;
        $this->tipe = $tipe;
    }

    public function getLabel(){
        return "$this->judul,$this->penulis, $this->penerbit";
    }

     public function getInfoLengkap(){
        $str = "{$this->tipe} : {$this->judul} | {$this->getLabel()} Rp. {$this->harga}";
        if ($this->tipe == "Komik") {
            $str .= "- {$this->jmlHalaman} halaman.";
        } else if ($this->tipe == "Game") {
            $str .= "- {$this->asal} jam.";
        }
        return $str;
     }


}


class CetakInfoProduk {
    public function cetak(produk $produk){
        $str = "{$produk->judul} | {$produk->getLabel()} Rp. {$produk->harga}";
        return $str;
    }
}



$produk1 = new produk("Naruto", "Masashi Kishimoto", "Shonen Jump", 30000,100,0 ,"Komik");
$produk2 = new produk("Uncharted","Neil Druckmann","Sony Computer", 250000, 0, 50, "Game");

 echo $produk1->getInfoLengkap();
 echo "<hr>";
 echo $produk2->getInfoLengkap();

?>