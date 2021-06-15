# Online Şikayet Sistemi (MySQL-PHP)
Web tabanlı programlama dersi kapsamında, MySQL-PHP kullanarak geliştiriğim bir Web sitesidir.
Bünyemizde bulunan firmalar hakkında şikayet oluşturabilirsiniz. 
Bünyemize admin panelinden firma oluşturabilirsiniz.

## Açıklama
Üyemizin kayıt olabilmesi için `kayıtol.php` sayfasını erişilebilir yaptım. Diğer php sayfalarına uye girişi ya da admin girişi yapmadan erişmek mümkün değildir.`kayıtol.php` sayfasına uye girişi yaptıktan sonra erişmek mümkün değildir, oturumun kapatılması gerekiyor.Aynı işlemi şuanki adı `giris.html`, eski adı `giris.php` olan sayfa içinde yapmıştım ama herhangi bir `php` sayfasına şifresiz erişim puan kaybı olacağı için `html` ye çevirip bu şekilde bıraktım.

- İki ayrı oturum mevcuttur ve birbirlerinden bağımsızdır. `Uye` ve `Admin`.
- Uye girişi yapılmadan profil ve şikayet oluştur kısımlarına giriş yapılmamaktadır.
- Uye'nin kayıt olabilmesi için `kayıtol.php` sayfasına şifresiz erişim mümkündür.
- Admin panel kısmına, admin girişi yapılmadan erişim mümkün değildir. Eğer admin girişi yapıp oturumu kapatmadan anasayfaya geçiş yaparsanız, daha sonra da anasayfa üzerinden `admin.html` sayfasına geçerseniz `GİRİŞ YAP` butonuna herhangi bir bilgi girmeden basmanız, admin paneline geçmenizi sağlayacaktır. `PHP` uzantılı sayfalara şifresiz erişim puan kaybı olacağı için böyle bir yol izlenmiştir.


## Kullanılan Teknolojiler
- HTML5
- CSS
- JavaScript
- PHP
- MySQL

## Demo:
- <http://birsikayetimvar.eu5.org/>

## Admin Giriş Bilgisi
```sh
Kullanıcıadı: admin
Şifre: 123123
```
## Üye Giriş Bilgisi
Eğer kayıt olmak istemezseniz, üye girişi için bu bilgileri kullanarak şikayet oluşturabilir, şikayetlerinizi güncelleyebilir ve kullanıcı bilgilerinizi güncelleyebilirsiniz.
```sh
Kullanıcıadı: Deneme123
Şifre: 123456
```

## SQL Script
<https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/sikayet.sql>
`Tablo Yapısı:`
![TabloYapısı](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/VeriTaban%C4%B1Tablo.png)

## Ekran Görüntüleri Ve Yapılabilen İşlemler
`Anasayfa ekran görüntüsü:`
![AnaSayfa](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/Anasayfa.png)

`Kayıt Ol ekran görüntüsü:`
![KayıtOl](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/Kay%C4%B1tOl.png)

`Kullanıcı Girisi ekran görüntüsü:`
![KullanıcıGirisi](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/Giris.png)

`Profil bölümü kullanıcı bilgileri ekran görüntüsü:`
Bu bölümde kullanıcı bilgilerini görebilir ve güncelleyebilirsiniz.
![KullanıcıBilgileri](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/Kullan%C4%B1c%C4%B1Bilgileri.png)

`Olusturduğunuz şikayetlerin ekran görüntüsü:`
![Sikayetlerim](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/Sikayetlerim.png)

`Seçtiğiniz şikayeti güncelleyen ekran görüntüsü:`
![ŞikayetGüncelleme](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/SikayetG%C3%BCncelleme.png)

`Admin girişi ekran görüntüsü:`
![AdminGiris](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/AdminGiris.png)

`Admin paneli şirket ekleme ekran görüntüsü:`
![AdminSirketEkleme](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/AdminPaneliSirketEkle.png)

`Admin paneli şirketleri listeleme ekran görüntüsü:`
![AdminSirketListele](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/AdminPaneliSirketListele.png)

`Admin paneli şirketleri listeleme,silme ve güncelleme ekran görüntüsü:`
Uyeler, şirketler hakkında o kadar şikayet oluşturmuş. O firma hakkındaki şikayetleri değerlendirmeden (Silmeden), şirketi silmeniz mümkün değildir. Bilerek böyle yapılmıştır.
![AdminSirketSilVeGüncelle](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/AdminPaneliSirketSilVeG%C3%BCncelle.png)

`Admin paneli şikayetleri firma ismine göre listeleme ve silme ekran görüntüsü:`
![AdminSikayetListele](https://github.com/kaansertel/Online-Sikayet-Sistemi/blob/main/resimler/AdminPaneli%C5%9EikayetlerinFirmalaraG%C3%B6reListelenmesi.png)

