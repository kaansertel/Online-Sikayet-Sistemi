<?php 
session_start();
require ('mysqlbaglan.php');

if (isset($_POST['username']) and isset($_POST['password'])) {
    extract($_POST);
    
    //sifreleme
    $password = hash('sha256', $password);
    $sql = "SELECT * FROM adminler WHERE KullaniciAdi='$username' and Sifre='$password'";
    
    $cevap = mysqli_query($baglanti,$sql);
    // eger cevap FALSE ise HATA yazdiriyoruz.
    if (!$cevap) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }
    //veritabanindan dönen satir sayisini bulma
    $say = mysqli_num_rows($cevap);
    if ($say == 1) {
        $_SESSION['username'] = $username;
    }else{
        $mesaj="<h1>Hatali kullanici adi veya şifre! </h1>";
    }
    
} 

if (isset($_SESSION['username'])) {
    header("location:panel.php");
}else {
    header("location:admin2.html");
} 
?>