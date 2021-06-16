<?php 
// oturumu baslat
session_start();
//eger KullaniciAdi adli oturum degiskeni yok ise login sayfasina yönlendir
if (!isset($_SESSION['KullaniciAdi'])) {
    header("location:giris.html");
    exit();
}
// mysql baglantisi
include("mysqlbaglan.php");

// degiskenleri formdan alma
if (empty($_POST["UyeAdi"]) || empty($_POST["UyeSoyad"]) || empty($_POST["TelefonNumarasi"]) || empty($_POST["Eposta"])) {
    $_SESSION['degisken'] = 2;                   
    header("location:kullanicibilgileri.php");
}
else {

if (isset($_POST["UyeAdi"],$_POST["UyeSoyad"],$_POST["TelefonNumarasi"],$_POST["Eposta"])) {
    
    $UyeAdi=$_POST["UyeAdi"];
    $UyeSoyad=$_POST["UyeSoyad"];
    $TelefonNumarasi=$_POST["TelefonNumarasi"];
    $Eposta=$_POST["Eposta"];

    //sorgu hazirlama
    $sql = "UPDATE uyeler SET UyeAdi='$UyeAdi', UyeSoyad='$UyeSoyad' WHERE UyeNo=".$_GET['id'];
    $sql2 = "UPDATE iletisimbilgileri SET TelefonNumarasi='$TelefonNumarasi', Eposta='$Eposta' WHERE Id=".$_GET['no'];
 
    //Veritabanina sorgu gönderme
    $cevap = mysqli_query($baglanti,$sql);
    $cevap2 = mysqli_query($baglanti,$sql2);

    echo "<html>";
    //türkçe karakter destegi ayari
    echo "<meta http-equiv='Content-Type' "; 
    echo "content='text/html; charset=UTF-8'/>";

    if ( (!$cevap) && (!$cevap2)) {
        echo "<h1>Hata!!</h1>";
    }else { 
            $_SESSION['degisken'] = 1;                   
            header("location:kullanicibilgileri.php");
    }
    echo "</html>";
    //veritabani baglantisi kapatma
    mysqli_close($baglanti);

}
}
?>
