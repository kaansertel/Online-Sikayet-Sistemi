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
$sql =" SELECT uyesikayet.Uye_Sikayet_Gecis_Id, sirketler.SirketAdi, sirketler.SirketNo, uyeler.UyeNo, sikayetler.SikayetNo FROM (((uyeler INNER JOIN uyesikayet ON uyeler.UyeNo = uyesikayet.Uyeler_UyeNo) INNER JOIN sikayetler ON uyesikayet.Sikayetler_SikayetNo = sikayetler.SikayetNo) INNER JOIN sirketler ON sirketler.SirketNo = uyesikayet.Sirketler_SirketNo) WHERE uyeler.KullaniciAdi='$KullaniciAdi' ORDER BY SikayetNo";

//sorguyu veritabanina gönderme
$cevap = mysqli_query($baglanti,$sql);

?>

<html>
    <head>
    <title>Şikayetlerim</title>
    <link rel="stylesheet" type="text/css" href="sablon.css"/>
    <style>
body{
    background-color: #fffafa;
}

.button{
    width :130px;
    color :red;
    font-weight: bold;
    font-size: 15px;
    text-decoration: none;
    font-family:cursive;
}

.bttn{
    background-color:#deb887;
    border: solid thin ;
    color: #8b4513;
    padding: 10px;
    text-decoration: none;
    display: inline-block;
    margin-top: 100px;
    font-weight: bold;
    font-size: 18px;
                
}

    #tablo{
    border-collapse: collapse;
    width: 100%;
    
}
#tablo td, #tablo th{
    border: 1px solid black;
    padding: 8px;
    font-weight:bold;

}
#tablo tr:nth-child(even){background-color: #e9ddcfd5;}

#tablo tr:hover {
    background-color: #2ecc71;
    color:black;
    font-weight:bold;
}

#tablo th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
   background-color: #87ceeb;
    color: white;
    font-weight:bold;
   
}

    </style>
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
        <?php
            // eger cevap FAlSE ise HATA yazdiriyoruz
            if (!$cevap) {
                echo "<h1>Hata!!</h1>";
            }

            //sorgudan gelen tüm kayitlari tablo icinde yazdirma
            // tablo basliklari olusturma

            echo "<html>";
            //türkçe karakter destegi ayari
            echo "<meta http-equiv='Content-Type' "; 
            echo "content='text/html; charset=UTF-8'/>";

            echo "<h1>Sikayetlerim</h1>";

            echo "<table border=1 id='tablo'>";
            echo "<tr>";
            echo "<th>Sikayet No</th>";
            echo "<th>Sirket Adı</th>";
            echo "</tr>";

            while($gelen=mysqli_fetch_array($cevap)){
                // veritabanindan gelen değerler ile tablo satirlari olusturalim
                echo "<tr><td>".$gelen['Uye_Sikayet_Gecis_Id']." </td>";
                echo "<td>".$gelen['SirketAdi']."</td>";
                // sil linki olusturma
                echo "<td><a class='button' href=sikayetsil.php?id=";
                echo $gelen['Uye_Sikayet_Gecis_Id'];
                echo "&no=";
                echo $gelen['SikayetNo'];
                echo ">Sil</a></td>";
                // Guncellestirme
                echo "<td><a class='button' href=sikayetguncelle.php?id=";
                echo $gelen['SikayetNo'];
                echo "&no=";
                echo $gelen['SirketNo'];
                echo ">Güncelle</a></td></tr>";
            }
            //tablo kodunu bitirme
            echo "</table>";
            echo "</html>";

            //veritabani baglantisini kapama
            mysqli_close($baglanti);
            ?>
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>
    </body>

</html>