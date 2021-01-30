<?php 
$algoritma = new coinClass;
$algoritma->coinAdi=$_GET['coin'];
$algoritma->coinBul();
?>
<h1 class="algoritmalar"><?php echo $algoritma->coinAdi; ?></h1>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">SMA RSI</a>
    <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">EMA RSI</a>
    <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Williams R</a>
    <a class="nav-link" id="nav-adx-tab" data-bs-toggle="tab" href="#nav-adx" role="tab" aria-controls="nav-adx" aria-selected="false">ADX</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><?php include_once('sma-rsi.php'); ?></div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><?php include_once('ema-rsi.php'); ?></div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><?php include_once('williams_r.php'); ?></div>
  <div class="tab-pane fade" id="nav-adx" role="tabpanel" aria-labelledby="nav-adx-tab"><?php include_once('adx.php'); ?></div>
</div>