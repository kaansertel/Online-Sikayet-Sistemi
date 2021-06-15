<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel="stylesheet" type="text/css" href="admin.css"/>
        <title> | Şikayetler |</title>
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
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <h1>Firmalar</h1>
        <h3>Lütfen Şikayet Bilgilerinin Listeleneceği Firmayı Seçiniz!!!</h3>
        <?php
                //mysql baglanti kodunu ekleme
                include("mysqlbaglan.php");

                //sorguyu yaziyoruz
                $sql = "SELECT * FROM sirketler";
                
                //sorguyu veritabanina gonderme
                $cevap = mysqli_query($baglanti,$sql);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }


                while($gelen=mysqli_fetch_array($cevap)){
                    echo "<input ";
                    echo "type='radio' ";
                    echo "name=";
                    echo "SirketNo";
                    echo " ";
                    echo "value=";
                    echo $gelen['SirketNo'];
                    echo " />";
                    echo $gelen['SirketAdi'];
                    echo " ";
                }
                //veritabani baglantisini kapama
                mysqli_close($baglanti);
                ?>

                <br>
                <br>
                <input type="submit" class="buton" value="Listele" />
            </form>

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

if (!empty($_POST["SirketNo"])) {

    $No=$_POST["SirketNo"];


        //sorguyu yaziyoruz
        $sql2 = "SELECT sikayetler.SikayetNo, uyeler.UyeNo, uyeler.UyeAdi, uyeler.UyeSoyad, iletisimbilgileri.TelefonNumarasi, iletisimbilgileri.Eposta, sirketler.SirketAdi, sikayetler.Aciklama, uyesikayet.Uye_Sikayet_Gecis_Id
        FROM (((((uyeler 
        INNER JOIN uyesikayet ON uyeler.UyeNo = uyesikayet.Uyeler_UyeNo)
        INNER JOIN sikayetler ON uyesikayet.Sikayetler_SikayetNo = sikayetler.SikayetNo)
        INNER JOIN sirketler ON sirketler.SirketNo = uyesikayet.Sirketler_SirketNo)
        INNER JOIN uyeiletisim ON uyeiletisim.Uyeler_UyeNo = uyeler.UyeNo)
        INNER JOIN iletisimbilgileri ON iletisimbilgileri.Id = uyeiletisim.Iletisimbilgileri_Id) 
        WHERE SirketNo='$No' ORDER BY SikayetNo";

        //sorguyu veritabanina gonderme
        $cevap2 = mysqli_query($baglanti,$sql2);

        // eger cevap FAlSE ise HATA yazdiriyoruz
        if (!$cevap2) {
            echo '<br>Hata:' . mysqli_error($baglanti);
        }

        //sorgudan gelen tüm kayitlari tablo icinde yazdirma
        // tablo basliklari olusturma

        echo "<html>";


        //türkçe karakter destegi ayari
        echo "<meta http-equiv='Content-Type' "; 
        echo "content='text/html; charset=UTF-8'/>";

        echo "<h1>Şikayet Bilgileri</h1>";

        echo "<table border =1px id='tablo'";
        echo "<tr >";
        echo "<th>Şikayet No</th>";
        echo "<th>Uye No</th>";
        echo "<th>Uye Adı</th>";
        echo "<th>Uye Soyadı</th>";
        echo "<th>Telefon Numarası</th>";
        echo "<th>Eposta</th>";
        echo "<th>Şirket Adı</th>";
        echo "<th>Şikayet Açıklaması</th>";
        echo "</tr>";

        while($gelen2=mysqli_fetch_array($cevap2)){
            // veritabanindan gelen değerler ile tablo satirlari olusturalim
            echo "<tr><td>".$gelen2['SikayetNo']." </td>";
            echo "<td>".$gelen2['UyeNo']."</td>";
            echo "<td>".$gelen2['UyeAdi']."</td>";
            echo "<td>".$gelen2['UyeSoyad']."</td>";
            echo "<td>".$gelen2['TelefonNumarasi']."</td>";
            echo "<td>".$gelen2['Eposta']."</td>";
            echo "<td>".$gelen2['SirketAdi']."</td>";
            echo "<td>".$gelen2['Aciklama']."</td>";

            // sil linki olusturma
            echo "<td><a href=sikayetlersil.php?id=";
            echo $gelen2['SikayetNo'];
            echo "&no=";
            echo $gelen2['Uye_Sikayet_Gecis_Id'];
            echo ">Sil</a></td><tr>";

        }
        //tablo kodunu bitirme
        echo "</table>";

}
echo "</html>";

//veritabani baglantisini kapama
mysqli_close($baglanti);
?>