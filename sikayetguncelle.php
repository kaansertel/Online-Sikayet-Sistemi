<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel="stylesheet" type="text/css" href="sablon.css"/>
    <title>Şikayet Güncelle</title>
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
        <a class="baglan" href= 'kullanicibilgileri.php'> Kullanıcı Bilgilerim</a> <br />
        <br>
        <a class="baglan" href= 'sikayetlerim.php'> Şikayetlerim</a> <br />
        </div>

        <div class="ana">
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
                $sql = "SELECT * FROM sikayetler WHERE SikayetNo=".$_GET['id'];
                $sql2 = "SELECT * FROM sirketler WHERE SirketNo=".$_GET['no'];

                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);
                $cevap2 = mysqli_query($baglanti,$sql2);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap)) {
                    echo "<h1>Hata!!</h1>";
                } else {
                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);
                $gelen2=mysqli_fetch_array($cevap2);

                $id=(int)$_GET['id'];

            }
                ?>

                <form class="form" action="sikayetguncelkaydet.php?id=<?php echo $_GET['id']?>" method="POST">
                <br><?php echo $gelen2['SirketAdi']?> şirketine yaptığınız şikayet aşağıdadır<br>
                <textarea  id="icerik" name="Aciklama" onkeyup="kontrol()" onkeydown="kontrol()" rows="10" cols="50"><?php echo $gelen['Aciklama']?></textarea>
                <div id="uyari"></div>
                <br>
                <input type="submit" class="buton" value="KAYDET"/>&nbsp&nbsp
                <a href="sikayetlerim.php">İPTAL</a>
                </form>
          </div>
    </div>

        <div class="alt">
            © 2021 Tüm Hakları Saklıdır. <b>Kaan Sertel</b>
          </div>



    </body>

</html>    