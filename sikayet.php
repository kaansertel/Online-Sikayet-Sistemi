<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title>Bir Şikayetim Var!</title>
    <link rel="stylesheet" type="text/css" href="sablon.css"/>
    <script language=javascript>
    function kontrol() {
    var maxKarakter = 500;
    var icerik = document.getElementById("icerik");
    var icerikUzunlugu = icerik.value.length;

  if (icerikUzunlugu > maxKarakter) {
    icerik.value = icerik.value.substring(0, maxKarakter);
    document.getElementById("uyari").innerHTML = "<span style='color:black;'><b>UYARI:</b></span> <span style='color:red;'> <b> En fazla " + maxKarakter + " karakter girebilirsiniz!</b></span>";
  }
}
</script>
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
                    
                    <h1>Bir Şikayetim Var! </h1>
    
                    <h3>Şikayet etmek istediğiniz firmayı seçiniz.</h3>
                    Firma:
                    <?php
                    //mysql baglanti kodunu ekleme
                    include("mysqlbaglan.php");
    
                    //sorguyu yaziyoruz
                    $sql = "SELECT * FROM sirketler";
                    
                    //sorguyu veritabanina gonderme
                    $cevap = mysqli_query($baglanti,$sql);
    
                    // eger cevap FAlSE ise HATA yazdiriyoruz
                    if (!$cevap) {
                        echo "<h1>Hata!!</h1>";
                    }
    
                    echo "<select name='SirketNo'>";
                    echo "<option ";
                    echo "value='-1' selected>";
                    echo "";
                    echo "</option>";
                    while($gelen=mysqli_fetch_array($cevap)){
                    echo "<option ";
                    echo "value=";
                    echo $gelen['SirketNo'];
                    echo ">";
                    echo $gelen['SirketAdi'];
                    echo "</option>";
                    }
                    echo "</select>";
                    echo "<br>";
    
                    //veritabani baglantisini kapama
                    mysqli_close($baglanti);
                    
                    ?>
                    <br>
                    <b>Şikayetinizi detaylandırınız</b>
                    <br>
                    <textarea id="icerik" name="Aciklama" onkeyup="kontrol()" onkeydown="kontrol()" rows="10" cols="50"></textarea>
                    <div id="uyari"></div>
                    <br>
                    <input type="submit" class="buton" value="KAYDET" />
                    </form>
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
    
    //degiskenleri formdan aliyoruz
    
if (isset($_POST["SirketNo"],$_POST["Aciklama"])) {

    $SirketNo=$_POST["SirketNo"];
    $Aciklama=$_POST["Aciklama"];

    if (!($SirketNo == -1)) {
        echo "<html>";
        //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
        echo "<meta http-equiv='Content-Type' ";
        echo "content='text/html; charset=UTF-8' />";
        
            
        //Şikayet ekleme sorgusunu hazirliyoruz
        $sql = "INSERT INTO sikayetler".
                "(Aciklama)". 
                "VALUES ('$Aciklama')"; 
            
        //Sorgulari veritabanina gönderiyoruz
        $cevap = mysqli_query($baglanti,$sql);
        
        //Eger cevap FALSE ise HATA yazdiriyoruz
        if ((!$cevap)) {
            echo "<br> <h3>Sikayet Olusturulamadı!</h3><br>";
            echo "<a href='index.html'>Geri Dön</a>";
        } else {
    
            $sql2 = "SELECT UyeNo FROM uyeler WHERE KullaniciAdi='$KullaniciAdi'";
            $sql3 = "SELECT SikayetNo FROM sikayetler WHERE Aciklama='$Aciklama'";
    
            $cevap2 = mysqli_query($baglanti,$sql2);
            $cevap3 = mysqli_query($baglanti,$sql3);
    
            $gelen=mysqli_fetch_array($cevap2);
            $gelen2=mysqli_fetch_array($cevap3);
    
            $UyeNo=$gelen['UyeNo'];
            $SikayetNo=$gelen2['SikayetNo'];
    
    
            $sql4= "INSERT INTO uyesikayet". 
            "(Uyeler_UyeNo,Sikayetler_SikayetNo,Sirketler_SirketNo)". 
            "VALUES ('".$UyeNo."','".$SikayetNo."','".$SirketNo."')";
    
            $cevap4 = mysqli_query($baglanti,$sql4);
    
            if (!$cevap4) {
                echo "<br> <h3>Sikayet Olusturulamadı!</h3><br>";
            }else{
                echo "<h1> Şikayet Oluşturuldu.</h1>";
            }
    
        }
    } else {
        echo "<br> <h3>Sikayet Olusturulamadı!</h3><br>";
    }



}   
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);


?>
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>

</body>
</html>

