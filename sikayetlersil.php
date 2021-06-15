<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="admin.css"/>
        <title> | Şikayet Sil |</title>
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
// mysql baglantisi
include("mysqlbaglan.php");


// sorgu yazma
$sql = "DELETE FROM sikayetler WHERE SikayetNo=".$_GET['id'];
$sql2 = "DELETE FROM uyesikayet WHERE Uye_Sikayet_Gecis_Id=".$_GET['no'];


// sorguyu veritabanina gönderme
$cevap2 = mysqli_query($baglanti,$sql2);

echo "<html>";
//türkçe karakter destegi ayari
 echo "<meta http-equiv='Content-Type' "; 
echo "content='text/html; charset=UTF-8'/>";

if ((!$cevap2) ) {
    echo '<br>Hata:' . mysqli_error($baglanti);
}else {
    $cevap = mysqli_query($baglanti,$sql);
    if (($cevap)) {
        echo "<h2>Şikayet Silindi.</h2>";
    }
}
echo "</html>";
//veritabani baglantisi kapatma
mysqli_close($baglanti);

?>