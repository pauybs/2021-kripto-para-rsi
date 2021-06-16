<?php
@ob_start();
@session_start();
require_once ('class/class.admin.php');
admin_oturum_kontrol_panel();
$islem = new adminClass;

if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="durum-guncelle"){
	$islem->table=$_REQUEST["tablo"];
  $islem->id = $_REQUEST["id"];
  $islem->status = $_REQUEST["durum"];
  $islem->durumGuncelle();
}

if(isset($_POST['islem']) && $_POST['islem']=="veri-kaldir"){
	$islem->table=$_POST["tablo"];
	$islem->id = $_POST["id"];
	$islem->veriKaldir();
}
if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="kripto-grafik"){
	$islem->symbol=$_REQUEST["sembol"];
	$islem->candle_interval = $_REQUEST["candle"];
	$islem->kriptoGrafik();
}

if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="ekle"){
	$veriler=$_REQUEST;
	$tablo=$veriler['tablo'];
	unset($veriler['islem']);
	unset($veriler['tablo']);
	if(isset($veriler['parola'])){
		$parola = md5(base64_encode($veriler['parola']));
		$veriler['parola']=$parola;
	}
  $islem->tablo=$tablo;
  $islem->veriler=$veriler;
  $islem->adminEkle();
}
if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="guncelle"){
	$veriler=$_REQUEST;
	$tablo=$veriler['tablo'];
	unset($veriler['islem']);
	unset($veriler['tablo']);
	if(isset($veriler['parola'])){
		$parola = md5(base64_encode($veriler['parola']));
		$veriler['parola']=$parola;
	}
  $islem->tablo=$tablo;
  $islem->veriler=$veriler;
  $islem->adminGuncelle();
}


?>