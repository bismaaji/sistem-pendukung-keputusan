<?php
//koneksi
session_start();
include("koneksi.php");

$alternatif = $_POST['alter'];
$kriteria   = $_POST['krit'];
$poin       = $_POST['nilai'];



  $masuk = "INSERT INTO tab_topsis (id_alternatif, id_kriteria, nilai) VALUES ('".$alternatif."','".$kriteria."','".$poin."')";
  $buat  = $koneksi->query($masuk);

  echo "<script>alert('Input Data Berhasil') </script>";
  echo "<script>window.location.href = \"nilmat.php\" </script>";


 ?>
