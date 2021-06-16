<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="admin.css"/>
        <title> | Şirket Güncelle |</title>
    </head>

    <body>
    <div class="header">
        <h1>Admin Paneli</h1>
    </div>
<ul>
        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Şirket İşlemleri</h3> </a>
                <div class="dropdown-content">
                <a href= 'sirket.php'> Şirket Ekle</a> <br />
                <a href= 'sirketlistesi.php'> Şirket Listesi</a> <br />
                <a href= 'sirketislem.php'> Şirket Silme ve Güncelleme</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Şikayet İşlemleri</h3> </a>
                <div class="dropdown-content">
                <a href= 'sikayetler.php'> Şikayetler</a> <br />
                </div>
        </li>

        <li class="dropdown" style="float:right;"> 
                <a href= 'logout.php'> <h3>Oturumu Kapat</h3></a> <br /> 
        </li>
</ul>
        <?php
            // oturumu baslat
            session_start();
            //eger username adli oturum degiskeni yok ise login sayfasina yönlendir
            if (!isset($_SESSION['username'])) {
                header("location:admin.html");
                exit();
            }
            // mysql baglanma
            include("mysqlbaglan.php");

            // degiskenleri formdan alma
            if (!empty($_POST["SirketAdi"])) {
                
                $SirketAdi=$_POST["SirketAdi"];
                
                //sorgu hazirlama
                $sql = "UPDATE sirketler SET SirketAdi='$SirketAdi' WHERE SirketNo=".$_GET['id'];

                //Veritabanina sorgu gönderme
                $cevap = mysqli_query($baglanti,$sql);

                echo "<html>";
                //türkçe karakter destegi ayari
                echo "<meta http-equiv='Content-Type' "; 
                echo "content='text/html; charset=UTF-8'/>";

                if ( (!$cevap)) {
                    echo "<h1>Hata!!</h1>";
                }else {
                    echo "<h1>Kayıt Güncellendi!</h1>";
                    echo "<br>";
                    echo "<a href='sirketislem.php'>Listele</a>";

                }
            } else {
                echo "<h1>Kayıt Güncellenemedi!</h1>";
                echo "<br>";
                echo "<a href='sirketislem.php'>Listele</a>";

            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);

        ?>
    </body>

</html>
