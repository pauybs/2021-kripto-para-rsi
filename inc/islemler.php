<?php
require_once ('class/class.site.php');
$coinler = new coinClass;
switch($_REQUEST['islem']){
  case 'coin-ekle':
    if($_REQUEST["coin"]){
      $coinler->coinAdi = $_REQUEST["coin"];
      $coinler->coinEkle();
    }
  break;
  case 'kaldir':
    if($_REQUEST["id"]){
      $coinler->table=$_REQUEST["tablo"];
      $coinler->sID = $_REQUEST["id"];
      $coinler->islemKaldir();
    }
  break;
  case 'durum-guncelle':
    if($_REQUEST["id"]){
      $coinler->table=$_REQUEST["tablo"];
      $coinler->sID = $_REQUEST["id"];
      $coinler->status = $_REQUEST["durum"];
      $coinler->islemDurumGuncelle();
    }
    break;
    
  case 'sma-rsi-ekle':
        $coinler->coinID = $_REQUEST["id"];
        $coinler->smaRsiName = $_REQUEST["name"];
        $coinler->smaRsiPeriod = $_REQUEST["period"];
        $coinler->smaRsiTime = $_REQUEST["time"];
        $coinler->smaRsiMinLimit = $_REQUEST["min"];
        $coinler->smaRsiMaxLimit = $_REQUEST["max"];
        $coinler->smaRsiEkle();
  break;
  case 'ema-rsi-ekle':
    $coinler->coinID = $_REQUEST["id"];
    $coinler->emaRsiName = $_REQUEST["name"];
    $coinler->emaRsiPeriod = $_REQUEST["period"];
    $coinler->emaRsiTime = $_REQUEST["time"];
    $coinler->emaRsiMinLimit = $_REQUEST["min"];
    $coinler->emaRsiMaxLimit = $_REQUEST["max"];
    $coinler->emaRsiEkle();
break;
case 'williams-r-ekle':
  $coinler->coinID = $_REQUEST["id"];
  $coinler->williamsRName = $_REQUEST["name"];
  $coinler->williamsRPeriod = $_REQUEST["period"];
  $coinler->williamsRTime = $_REQUEST["time"];
  $coinler->williamsRMinLimit = $_REQUEST["min"];
  $coinler->williamsRMaxLimit = $_REQUEST["max"];
  $coinler->williamsREkle();
break;
case 'adx-ekle':
  $coinler->coinID = $_REQUEST["id"];
  $coinler->adxName = $_REQUEST["name"];
  $coinler->adxPeriod = $_REQUEST["period"];
  $coinler->adxTime = $_REQUEST["time"];
  $coinler->adxMinLimit = $_REQUEST["min"];
  $coinler->adxMaxLimit = $_REQUEST["max"];
  $coinler->adxEkle();
break;
}
?>