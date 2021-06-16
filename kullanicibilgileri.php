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

$KullaniciAdi = $_SESSION['KullaniciAdi'];

// sorgu yazma
$sql = " SELECT * FROM ((uyeler INNER JOIN uyeiletisim ON uyeler.UyeNo = uyeiletisim.Uyeler_UyeNo) INNER JOIN iletisimbilgileri ON uyeiletisim.Iletisimbilgileri_Id = iletisimbilgileri.Id)  WHERE uyeler.KullaniciAdi='$KullaniciAdi'";

//sorguyu veritabanina gönderme
$cevap = mysqli_query($baglanti,$sql);

//Eger cevap FALSE ise HATA yazidrma
if ( (!$cevap)) {
    echo "<h1>Hata!!</h1>";
    } else {
    //veritabanindan gelen cevabi alma
    $gelen=mysqli_fetch_array($cevap);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title>Kullanıcı Bilgileri!</title>
    <link rel="stylesheet" type="text/css" href="sablon.css"/>
</head>
<body>
<div class="header">
        <a href="index.html"><h1>Bir Şikayetim Var!</h1></a>
      </div>
    

    <ul>
        <li class="dropdown" style="float:left;"> 
            <a href= 'admin.html'> <h3>Admin Paneli</h3></a> <br />    
        </li>
        <li class="dropdown" style="float:left;">  
            <a href= 'profil.php'> <h3>Profil</h3></a> <br />
        </li>
        <li class="dropdown" style="float:left;"> 
            <a href= 'sikayet.php'> <h3>Şikayet Oluştur</h3></a> <br />
        </li>
        <li class="dropdown"> 
            <a href= '_logout.php'> <h3>Oturumu Kapat</h3></a>    
        </li>
        <li class="dropdown"> 
            <a href= 'giris.html'> <h3>Giriş</h3></a> <br />
        </li>
        <li class="dropdown"> 
            <a href= 'kayıtol.php'> <h3>Kayıt Ol</h3></a> <br />
        </li>
    </ul>

    <div class="satır">
        <div class="alan">
        <a class="baglan" href= 'kullanicibilgileri.php'> Kullanıcı Bilgilerim</a> <br />
        <br>
        <a class="baglan" href= 'sikayetlerim.php'> Şikayetlerim</a> <br />
        </div>

        <div class="ana">
        <form class="form" action="kullanicibilgileriguncelle.php?id=<?php echo $gelen['UyeNo']?>&no=<?php echo $gelen['Id']?>" method="POST">
                    <h2> Üyelik Bilgilerim </h2>
                    Ad 
                    <input type="text" name="UyeAdi" value="<?php echo $gelen['UyeAdi']?>"/> <br>
                    Soyad
                    <input type="text" name="UyeSoyad" value="<?php echo $gelen['UyeSoyad']?>"/> <br>
                    Telefon Numarası
                    <input type="text" name="TelefonNumarasi" value="<?php echo $gelen['TelefonNumarasi']?>"/> <br>
                    E-Posta
                    <input type="email" name="Eposta" value="<?php echo $gelen['Eposta']?>"/> <br><br><br>
                    <input type="submit" class="buton" value="GÜNCELLE" />

                    <?php 
                    if ($_SESSION['degisken'] == 1) {
                        echo "<h2>Kayıt güncellendi!</h2>";
                    } 
                    if ($_SESSION['degisken'] == 2) {
                        echo "<h2>Kayıt güncellenemedi!</h2>";
                    }
                    $_SESSION['degisken'] = 0; 

                    //VeriTabani baglantisini kapatiyoruz.
                     mysqli_close($baglanti);

                    ?>
                </form>  
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>
 
</body>
</html>
