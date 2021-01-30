<?php
require_once ("inc/header.php");

if($_GET && !empty($_GET["sayfa"])){
  $sayfa=$_GET["sayfa"].".php";
  if(file_exists($sayfa)){
    include_once($sayfa);
  }
  else{
    include_once("anasayfa.php");
  }
  
}
else{
  include_once("anasayfa.php");
}

require_once ("inc/footer.php");
?>


