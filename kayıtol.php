<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="sablon.css"/>
        <title> | Üye Kayıt Formu |</title>
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
          <h2>Açıklama</h2>
          <p><b>Bu proje <font color="red">WEB PROGRAMLAMA</font> dersi kapsamında geliştirilmiştir.</b></p>
          <h2>İletişim</h2>
          <a href="https://github.com/kaansertel"><p><b>Kaan Sertel</a><br>Kaan_Sertel@hotmail.com</b></p>
          <h4>GitHub:</h4>
          <a href="https://github.com/kaansertel/Online-Sikayet-Sistemi"> <img class="img" src="resimler/github.png" alt="Örnek Resim" /></a>
          <p>Proje <font color="blue">detaylarını</font> görmek için resime tıklayınız.</p>
        </div>

        <div class="ana">
        <form class="form" action="<?php $_PHP_SELF ?>" method="POST">
                    <h2> Üye Bilgileri </h2>
                    Kullanıcı Adı:&nbsp
                    <input type="text"name="KullaniciAdi" /> <br/>
                    Şifre:&nbsp
                    <input type="password"name="Sifre" /> <br/>
                    Adınız:&nbsp
                    <input type="text"name="UyeAdi" /> <br/>
                    Soyadınız:&nbsp
                    <input type="text"name="UyeSoyad" /> <br/>
                    <h2> İletişim Bilgileri </h2>
                    Telefon Numarası:&nbsp
                    <input type="text"name="TelefonNumarasi" /> <br/>
                    E-Posta Adresi:&nbsp
                    <input type="email"name="Eposta" /> <br/>
                    <br>


                    <input type="submit" class="buton" value="KAYIT OL" />
                </form>
                <?php
// oturumu baslat
session_start();

if (isset($_SESSION['KullaniciAdi'])) {
    header("location:index.html");
    exit();
}
//mysql baglanti kodunu ekleme
include("mysqlbaglan.php");

//degiskenleri formdan aliyoruz
if (isset($_POST["UyeAdi"],$_POST["UyeSoyad"],$_POST["KullaniciAdi"],$_POST["Sifre"],
$_POST["TelefonNumarasi"],$_POST["Eposta"])) {

    $Sifre=$_POST["Sifre"];
    $Sifre = hash('sha256', $Sifre);
    $UyeAdi=$_POST["UyeAdi"];
    $UyeSoyad=$_POST["UyeSoyad"];
    $KullaniciAdi=$_POST["KullaniciAdi"];
    $TelefonNumarasi=$_POST["TelefonNumarasi"];
    $Eposta=$_POST["Eposta"];


    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
        
    //Uye ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO uyeler".
            "(UyeAdi,UyeSoyad,KullaniciAdi,Sifre)". 
            "VALUES ('$UyeAdi','$UyeSoyad','$KullaniciAdi','$Sifre')"; 
    
    //İletişim bilgisi ekleme sorgusunu hazirliyoruz      
    $sql2= "INSERT INTO iletisimbilgileri". 
            "(TelefonNumarasi,Eposta)". 
            "VALUES ('".$TelefonNumarasi."','".$Eposta."')";
    
    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);
    
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo "<br> <h3>Kullanıcı adı kullanılmaktadır! Lütfen farklı bir kullanıcı adi giriniz.</h3><br>";
    } else {
        $cevap2= mysqli_query($baglanti,$sql2);
        if ($cevap && $cevap2) {
            $sql3 = "SELECT UyeNo FROM uyeler WHERE UyeAdi='$UyeAdi' AND UyeSoyad='$UyeSoyad' AND KullaniciAdi='$KullaniciAdi' AND Sifre='$Sifre'";
            $cevap3 = mysqli_query($baglanti,$sql3);
            $sql4 = "SELECT Id FROM iletisimbilgileri WHERE TelefonNumarasi='$TelefonNumarasi' AND Eposta='$Eposta'";
            $cevap4 = mysqli_query($baglanti,$sql4);
            //veritabanindan gelen degerleri satir satir alma
            $gelen=mysqli_fetch_array($cevap3);
            $No=(int)$gelen['UyeNo'];
            
            $gelen2=mysqli_fetch_array($cevap4);
            $Id=(int)$gelen2['Id'];
    
            $sql5 = "INSERT INTO uyeiletisim". 
                    "(Iletisimbilgileri_Id,Uyeler_UyeNo)". 
                    "VALUES ($Id,$No)";
    
            $cevap5 = mysqli_query($baglanti,$sql5);

            if (!$cevap5) {
                echo "<h1>Hata!!</h1>";
            }
            echo "<h1> Kayıt Olundu.</h1>";
        }
    }

    
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>

            

    </body>
</html>

