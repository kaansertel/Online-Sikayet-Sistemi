<html>
    <head>
    </head>

    <body>
        <?php
            // oturumu baslat
            session_start();
            //eger KullaniciAdi adli oturum degiskeni yok ise login sayfasina yönlendir
            if (!isset($_SESSION['KullaniciAdi'])) {
                header("location:giris.html");
                exit();
            }
            // mysql baglanma
            include("mysqlbaglan.php");

            // degiskenleri formdan alma
            if (!empty($_POST["Aciklama"])) {
                
                $Aciklama=$_POST["Aciklama"];
                
                //sorgu hazirlama
                $sql = "UPDATE sikayetler SET Aciklama='$Aciklama' WHERE SikayetNo=".$_GET['id'];

                //Veritabanina sorgu gönderme
                $cevap = mysqli_query($baglanti,$sql);

                echo "<html>";
                //türkçe karakter destegi ayari
                echo "<meta http-equiv='Content-Type' "; 
                echo "content='text/html; charset=UTF-8'/>";

                if ( (!$cevap)) {
                    echo "<h1>Hata!!</h1>";
                }else {
                    echo "<h1>Şikayet Güncellendi!</h1>";
                    header("location:sikayetlerim.php");
                }
            } else {
                echo "<h1>Şikayet Güncellenemedi!</h1>";
            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);

        ?>
    </body>

</html>
