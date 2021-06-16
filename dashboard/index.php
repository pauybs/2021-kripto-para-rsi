<?php
define('SITE','http://localhost/kripto-alarm/');
@ob_start();
@session_start();
require_once ("inc/class/class.admin.php");
$islem = new adminClass;
admin_oturum_kontrol_panel();
require_once ("inc/header.php");

if($_GET && !empty($_GET["page"])){
  $sayfa="inc/".$_GET["page"].".php";
  if(file_exists($sayfa)){
    include_once($sayfa);
  }
  else{
    include_once("inc/home.php");
  }
  
}
else{
  include_once("inc/home.php");
}

require_once ("inc/footer.php");
?>
