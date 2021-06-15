<?php 
// oturumu baslat
session_start();
$_SESSION['degisken'] = 0; 
//eger KullaniciAdi adli oturum degiskeni yok ise login sayfasina yönlendir
if (!isset($_SESSION['KullaniciAdi'])) {
    header("location:giris.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel="stylesheet" type="text/css" href="sablon.css"/>
    <title>Profil</title>
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
            <h1>Bir Şikayetim Var!</h1>
            <h3>Şikayetiniz mi var?</h3>
            <p>O zaman bünyemizde bulunan firmaları şikayet edebilirsiniz...</p>
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>
    
</body>
</html>