<?php
require_once ("class/class.db.php");
require_once ('class/class.site.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tez</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" ></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Tez</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?sayfa=anasayfa">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?sayfa=coinler">Coinler</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?sayfa=grafikler&coin=BTCUSDT">Grafikler</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container main-container">