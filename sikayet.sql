-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Haz 2021, 22:33:06
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sikayet`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adminler`
--

CREATE TABLE `adminler` (
  `Id` int(11) NOT NULL,
  `KullaniciAdi` varchar(45) NOT NULL,
  `Sifre` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `adminler`
--

INSERT INTO `adminler` (`Id`, `KullaniciAdi`, `Sifre`) VALUES
(1, 'admin', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisimbilgileri`
--

CREATE TABLE `iletisimbilgileri` (
  `Id` int(11) NOT NULL,
  `TelefonNumarasi` varchar(45) NOT NULL,
  `Eposta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `iletisimbilgileri`
--

INSERT INTO `iletisimbilgileri` (`Id`, `TelefonNumarasi`, `Eposta`) VALUES
(15, '5555555555', 'deneme@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sikayetler`
--

CREATE TABLE `sikayetler` (
  `SikayetNo` int(11) NOT NULL,
  `Aciklama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sikayetler`
--

INSERT INTO `sikayetler` (`SikayetNo`, `Aciklama`) VALUES
(16, 'Şikayet'),
(18, 'Kolay');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirketler`
--

CREATE TABLE `sirketler` (
  `SirketNo` int(11) NOT NULL,
  `SirketAdi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sirketler`
--

INSERT INTO `sirketler` (`SirketNo`, `SirketAdi`) VALUES
(14, 'Bir Şikayetim Var'),
(15, 'Kolay Pazarlama'),
(16, 'Ne Ararsan Var'),
(17, 'KolaySatış');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeiletisim`
--

CREATE TABLE `uyeiletisim` (
  `Uye_Iletisim_Gecis_Id` int(11) NOT NULL,
  `Uyeler_UyeNo` int(11) NOT NULL,
  `Iletisimbilgileri_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeiletisim`
--

INSERT INTO `uyeiletisim` (`Uye_Iletisim_Gecis_Id`, `Uyeler_UyeNo`, `Iletisimbilgileri_Id`) VALUES
(5, 18, 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `UyeNo` int(11) NOT NULL,
  `UyeAdi` varchar(45) NOT NULL,
  `UyeSoyad` varchar(45) NOT NULL,
  `KullaniciAdi` varchar(50) NOT NULL,
  `Sifre` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`UyeNo`, `UyeAdi`, `UyeSoyad`, `KullaniciAdi`, `Sifre`) VALUES
(18, 'Kaan', 'Sertel', 'Deneme123', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyesikayet`
--

CREATE TABLE `uyesikayet` (
  `Uye_Sikayet_Gecis_Id` int(11) NOT NULL,
  `Uyeler_UyeNo` int(11) NOT NULL,
  `Sikayetler_SikayetNo` int(11) NOT NULL,
  `Sirketler_SirketNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyesikayet`
--

INSERT INTO `uyesikayet` (`Uye_Sikayet_Gecis_Id`, `Uyeler_UyeNo`, `Sikayetler_SikayetNo`, `Sirketler_SirketNo`) VALUES
(16, 18, 16, 15),
(18, 18, 18, 17);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adminler`
--
ALTER TABLE `adminler`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `iletisimbilgileri`
--
ALTER TABLE `iletisimbilgileri`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `sikayetler`
--
ALTER TABLE `sikayetler`
  ADD PRIMARY KEY (`SikayetNo`);

--
-- Tablo için indeksler `sirketler`
--
ALTER TABLE `sirketler`
  ADD PRIMARY KEY (`SirketNo`);

--
-- Tablo için indeksler `uyeiletisim`
--
ALTER TABLE `uyeiletisim`
  ADD PRIMARY KEY (`Uye_Iletisim_Gecis_Id`),
  ADD KEY `Uyeler_UyeNo` (`Uyeler_UyeNo`,`Iletisimbilgileri_Id`),
  ADD KEY `Iletisimbilgileri_Id` (`Iletisimbilgileri_Id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`UyeNo`),
  ADD UNIQUE KEY `KullaniciAdi` (`KullaniciAdi`);

--
-- Tablo için indeksler `uyesikayet`
--
ALTER TABLE `uyesikayet`
  ADD PRIMARY KEY (`Uye_Sikayet_Gecis_Id`),
  ADD KEY `Uyeler_UyeNo` (`Uyeler_UyeNo`,`Sikayetler_SikayetNo`,`Sirketler_SirketNo`),
  ADD KEY `Sirketler_SirketNo` (`Sirketler_SirketNo`),
  ADD KEY `Sikayetler_SikayetNo` (`Sikayetler_SikayetNo`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adminler`
--
ALTER TABLE `adminler`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `iletisimbilgileri`
--
ALTER TABLE `iletisimbilgileri`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `sikayetler`
--
ALTER TABLE `sikayetler`
  MODIFY `SikayetNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `sirketler`
--
ALTER TABLE `sirketler`
  MODIFY `SirketNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `uyeiletisim`
--
ALTER TABLE `uyeiletisim`
  MODIFY `Uye_Iletisim_Gecis_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `UyeNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `uyesikayet`
--
ALTER TABLE `uyesikayet`
  MODIFY `Uye_Sikayet_Gecis_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `uyeiletisim`
--
ALTER TABLE `uyeiletisim`
  ADD CONSTRAINT `uyeiletisim_ibfk_1` FOREIGN KEY (`Uyeler_UyeNo`) REFERENCES `uyeler` (`UyeNo`),
  ADD CONSTRAINT `uyeiletisim_ibfk_2` FOREIGN KEY (`Iletisimbilgileri_Id`) REFERENCES `iletisimbilgileri` (`Id`);

--
-- Tablo kısıtlamaları `uyesikayet`
--
ALTER TABLE `uyesikayet`
  ADD CONSTRAINT `uyesikayet_ibfk_1` FOREIGN KEY (`Uyeler_UyeNo`) REFERENCES `uyeler` (`UyeNo`),
  ADD CONSTRAINT `uyesikayet_ibfk_2` FOREIGN KEY (`Sirketler_SirketNo`) REFERENCES `sirketler` (`SirketNo`),
  ADD CONSTRAINT `uyesikayet_ibfk_3` FOREIGN KEY (`Sikayetler_SikayetNo`) REFERENCES `sikayetler` (`SikayetNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
