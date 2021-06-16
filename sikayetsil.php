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


// sorgu yazma
$sql = "DELETE FROM sikayetler WHERE SikayetNo=".$_GET['no'];
$sql2 = "DELETE FROM uyesikayet WHERE Uye_Sikayet_Gecis_Id=".$_GET['id'];


// sorguyu veritabanina gönderme
$cevap2 = mysqli_query($baglanti,$sql2);

echo "<html>";
//türkçe karakter destegi ayari
 echo "<meta http-equiv='Content-Type' "; 
echo "content='text/html; charset=UTF-8'/>";

if ((!$cevap2) ) {
    echo "<h1>Hata!!</h1>";
}else {
    $cevap = mysqli_query($baglanti,$sql);
    if (($cevap)) {
        header("location:sikayetlerim.php");
    }
}
echo "</html>";
//veritabani baglantisi kapatma
mysqli_close($baglanti);

?>