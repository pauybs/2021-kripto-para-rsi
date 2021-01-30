<?php
require_once ('inc/class/class.site.php');
require_once ('inc/algoritmalar.php');
$alg = new coinClass;
$algK = new coinClass;
$algoritmalar = ['sma_rsi','ema_rsi','williams_r','adx'];
for ($i=0; $i < count($algoritmalar); $i++) { 
  $alg->table=$algoritmalar[$i];
  echo $alg->table;
  $alg->servisAlgoritmaCek();
  for ($k=0; $k < count($alg->sID); $k++) {
    
    $algoritmaID=$alg->sID[$k];
    $coinID= $alg->servisCoinID[$k];
    $coinAdi= $alg->servisCoinAdi[$k];

    $period=$alg->servisPeriod[$k];
    $time=$alg->servisTime[$k];
    $alertmin=$alg->servisMinLimit[$k];
    $alertmax=$alg->servisMaxLimit[$k];
    echo $algoritmaID."<br>";

    if($i==0){
      $value=SMA_RSI($coinAdi,$period,$time);
      echo $coinAdi."|||".$value;
    }
    else if($i==1){
      $value=EMA_RSI($coinAdi,$period,$time);
      echo $coinAdi."|||".$value;
    }
    else if($i==2){
      $value=WILLAMS_R($coinAdi,$period,$time);
      echo $coinAdi."|||".$value;
    }
    else if($i==3){
      $value=ADX($coinAdi,$period,$time);
      echo $coinAdi."|||".$value;
    }
  
    
  
    $algK->pID=$algoritmaID;
    $algK->coinID=$coinID;
    $algK->value=$value;
    $algK->table=$algoritmalar[$i]."_logs";
    $algK->servisAlgoritmaKaydet();
  
    if($value<$alertmin || $value>$alertmax){
      $anlikfiyat = PRICE($coinAdi);
      $mesaj=$alg->servisAdi[$k]." Alert\n$coinAdi Value: $value\nFiyat: $anlikfiyat";
     // $alg->bildirim($mesaj);
    }
  }

}



