<?php
session_start();
unset($_SESSION['KullaniciAdi']);
header('location:index.html');
?>