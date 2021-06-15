<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="admin.css"/>
        <title> | Şirket Bilgileri |</title>
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
        //mysql baglanti kodunu ekliyoruz
        include("mysqlbaglan.php");

        //sorguyu yaziyoruz
        $sql = " SELECT * FROM sirketler";

        //sorguyu veritabanina gonderme
        $cevap = mysqli_query($baglanti,$sql);

        // eger cevap FAlSE ise HATA yazdiriyoruz
        if (!$cevap) {
            echo '<br>Hata:' . mysqli_error($baglanti);
        }else {

        //sorgudan gelen tüm kayitlari tablo icinde yazdirma
        // tablo basliklari olusturma

        echo "<html>";


        //türkçe karakter destegi ayari
        echo "<meta http-equiv='Content-Type' "; 
        echo "content='text/html; charset=UTF-8'/>";

        echo "<h1>Şirket Bilgileri</h1>";

        echo "<table border =1px id='tablo'>";
        echo "<tr >";
        echo "<th>Şirket No</th>";
        echo "<th>Şirket Adı</th>";
        echo "</tr>";

        while($gelen=mysqli_fetch_array($cevap)){
            // veritabanindan gelen değerler ile tablo satirlari olusturalim
            echo "<tr><td>".$gelen['SirketNo']." </td>";
            echo "<td>".$gelen['SirketAdi']."</td>";
    
            // sil linki olusturma
            echo "<td><a href=sirketsil.php?id=";
            echo $gelen['SirketNo'];
            echo ">Sil</a></td>";
            // Guncellestirme
            echo "<td><a href=sirketguncelle.php?id=";
            echo $gelen['SirketNo'];
            echo ">Güncelle</a></td></tr>";
        }
        //tablo kodunu bitirme
        echo "</table>";
    }
        echo "</html>";

        //veritabani baglantisini kapama
        mysqli_close($baglanti);
?>
