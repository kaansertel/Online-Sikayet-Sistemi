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
                // mysql baglantisi
                include("mysqlbaglan.php");

                // sorgu yazma
                $sql = "SELECT * FROM sirketler WHERE SirketNo=".$_GET['id'];

                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap)) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                } else {
                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);

                $id=(int)$_GET['id'];

            }
                ?>
            <div class="form">
                <form action="sirketguncelkaydet.php?id=<?php echo $_GET['id']?>" method="POST">
                <br> Şirket Adı:&nbsp;
                <input type="text" name="SirketAdi" value="<?php echo $gelen['SirketAdi']?>"/>
                <br>
                <input type="submit" class="buton" value="KAYDET"/>&nbsp&nbsp
                <a href="sirketislem.php">İPTAL</a>
                </form>
        </div>


    </body>

</html>    




