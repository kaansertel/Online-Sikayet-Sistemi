<?php 
session_start();
require ('mysqlbaglan.php');

if (isset($_POST['KullaniciAdi']) and isset($_POST['Sifre'])) {
    extract($_POST);

    //sifreleme
    $Sifre = hash('sha256', $Sifre);
    $sql = "SELECT * FROM uyeler WHERE KullaniciAdi='$KullaniciAdi' and Sifre='$Sifre'";
    
    $cevap = mysqli_query($baglanti,$sql);
    // eger cevap FALSE ise HATA yazdiriyoruz.
    if (!$cevap) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }
    //veritabanindan dönen satir sayisini bulma
    $say = mysqli_num_rows($cevap);
    if ($say == 1) {
        $_SESSION['KullaniciAdi'] = $KullaniciAdi;
    }else{
        $mesaj="<h1>Hatali kullanici adi veya şifre! </h1>";
    }
    
} 

if (isset($_SESSION['KullaniciAdi'])) {
    header("location:index.html");
}else {
    header("location:giris2.html");
} 
?>