<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="admin.css"/>
        <title> | Şirket Ekleme |</title>
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
<div class="form">
              <form action="<?php $_PHP_SELF ?>" method="POST">
                    <h2> Şirket Bilgileri </h2>
                    Şirket Adı:&nbsp
                    <input type="text"name="SirketAdi" placeholder="*Doldurulması zorunludur" /> <br/>
                    <br>
                    <input type="submit" class="buton" value="KAYDET" />
                </form>
</div>

    </body>
</html>


<?php
// oturumu baslat
session_start();
//eger username adli oturum degiskeni yok ise login sayfasina yönlendir
if (!isset($_SESSION['username'])) {
    header("location:admin.html");
    exit();
}
//mysql baglanti kodunu ekleme
include("mysqlbaglan.php");

//degiskenleri formdan aliyoruz
if (!empty($_POST["SirketAdi"])) {


    $SirketAdi=$_POST["SirketAdi"];

    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
        
    //Şirket ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO sirketler".
            "(SirketAdi)". 
            "VALUES ('$SirketAdi')"; 
    
    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);
   
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo "<h1>Hata!!</h1>";
    }
    else {
        echo "<h1> Şirket Eklendi.</h1>";
    }
    
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>