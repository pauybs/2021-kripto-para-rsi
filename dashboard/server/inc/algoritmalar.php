<?php 
function algoritma($algoritmaAdi,$data,$period){
  if($algoritmaAdi=="SMA_RSI"){
    $change_array = array();
    $rsi=0;
    for ($i=0; $i<$period-1; $i++) 
    { 
      $change = $data[$i]->close-$data[$i+1]->close;
      array_unshift($change_array, $change);
      if(count($change_array) > $period)
      {
        array_pop($change_array);
      }
      $res = array_reduce($change_array, function($result, $item) {
        if($item >= 0)
          $result['sum_gain'] += $item;
        if($item < 0)
          $result['sum_loss'] += abs($item);
          return $result; 
      }, array('sum_gain' => 0, 'sum_loss' => 0)); 
  
  
      $avg_gain = $res['sum_gain'] / $period;
      $avg_loss = $res['sum_loss'] / $period;
      if($avg_loss == 0){
        $rsi = 100; 
      } 
      else {
        $rs = $avg_gain / $avg_loss;				
        $rsi = 100 - (100 / ( 1 + $rs));
      }
    }
    return $rsi;
  }
  if($algoritmaAdi=="EMA_RSI"){
    $change_array = array();
    $rsi=0;
    $gain_array = array();
    $loss_array = array();
  
    for ($i=0; $i <$period-1 ; $i++) 
    { 
      $change = $data[$i]->close-$data[$i+1]->close;
      
      if($change >= 0){
       array_push($gain_array,$change);
       array_push($loss_array,0);
      }
      if($change < 0){
        array_push($loss_array,abs($change));
        array_push($gain_array,0);
      }
  }
  
  $up=EMA($gain_array,14);
  $down=EMA($loss_array,14);
  
  for ($i=0; $i <14 ; $i++) { 
    if($down[$i] == 0){
      $rsi = 100;
    } else {
      $rs = $up[$i] / $down[$i];				
      $rsi = 100 - (100 / ( 1 + $rs));
    }
  }
  return $rsi;
  }
  if($algoritmaAdi=="WILLIAMS_R"){
    $ozeldizi=array();
  for ($i=0; $i <$period ; $i++) 
  { 
    array_push($ozeldizi,$data[$i]->close);
  }

  $enyuksek = max($ozeldizi);
  $endusuk = min($ozeldizi);
  $sonkapanis = $ozeldizi[0];

  $williamR= -100*($enyuksek-$sonkapanis)/($enyuksek-$endusuk);
  return abs($williamR);
  }
}
function EMA(array $numbers, int $n): array
{
     $m   = count($numbers);
     $α   = 2 / ($n + 1);
     $EMA = [];

    
     $EMA[] = $numbers[0];

     for ($i = 1; $i < $m; $i++) {
        $EMA[] = ($α * $numbers[$i]) + ((1 - $α) * $EMA[$i - 1]);
     }

     return $EMA;
}
// function SMA_RSI($data,$period){
//   $change_array = array();
//   $rsi=0;
//   for ($i=0; $i<$period-1; $i++) 
//   { 
//     $change = $data[$i]->close-$data[$i+1]->close;
//     array_unshift($change_array, $change);
//     if(count($change_array) > $period)
//     {
//       array_pop($change_array);
//     }
//     $res = array_reduce($change_array, function($result, $item) {
//       if($item >= 0)
//         $result['sum_gain'] += $item;
//       if($item < 0)
//         $result['sum_loss'] += abs($item);
//         return $result; 
//     }, array('sum_gain' => 0, 'sum_loss' => 0)); 


//     $avg_gain = $res['sum_gain'] / $period;
//     $avg_loss = $res['sum_loss'] / $period;
//     if($avg_loss == 0){
//       $rsi = 100; 
//     } 
//     else {
//       $rs = $avg_gain / $avg_loss;				
//       $rsi = 100 - (100 / ( 1 + $rs));
//     }
//   }
//   return $rsi;
// }
// function EMA_RSI($data,$period){
//   $change_array = array();
//   $rsi=0;
//   $gain_array = array();
//   $loss_array = array();

//   for ($i=0; $i <$period-1 ; $i++) 
//   { 
//     $change = $data[$i]->close-$data[$i+1]->close;
    
//     if($change >= 0){
//      array_push($gain_array,$change);
//      array_push($loss_array,0);
//     }
//     if($change < 0){
//       array_push($loss_array,abs($change));
//       array_push($gain_array,0);
//     }
// }

// $up=EMA($gain_array,14);
// $down=EMA($loss_array,14);

// for ($i=0; $i <14 ; $i++) { 
//   if($down[$i] == 0){
//     $rsi = 100;
//   } else {
//     $rs = $up[$i] / $down[$i];				
//     $rsi = 100 - (100 / ( 1 + $rs));
//   }
// }
// return $rsi;
// }
// function WILLAMS_R($data,$period){

//   $ozeldizi=array();
//   for ($i=0; $i <$period ; $i++) 
//   { 
//     array_push($ozeldizi,$data[$i]->close);
//   }

//   $enyuksek = max($ozeldizi);
//   $endusuk = min($ozeldizi);
//   $sonkapanis = $ozeldizi[0];

//   $williamR= -100*($enyuksek-$sonkapanis)/($enyuksek-$endusuk);
//   return abs($williamR);
// }
// function ADX($symbol,$period,$time){
//   $apiLink="https://www.binance.com/api/v3/klines?symbol=".$symbol."&interval=".$time;
//   $fgc = file_get_contents($apiLink);
//   $json=json_decode($fgc,true);
//   $veri=array_reverse($json);
//   $change_array = array();
//   $DIu = array();
//   $DId = array();
//   $rsi=0;
//   for ($i=0; $i <$period ; $i++) 
//   { 
//     $UpMove = $veri[$i][2]-$veri[$i+1][2];
//     $DownMove = $veri[$i+1][3] - $veri[$i][3];
//     if($UpMove>$DownMove && $UpMove > 0){
//       array_push($DIu,$UpMove);
//     }
//     else{
//       array_push($DIu,0);
//     }
//     if($DownMove > $UpMove && $DownMove > 0){
//       array_push($DId,$DownMove);
//     }
//     else{
//       array_push($DId,0);
//     }
   
//   }
//   for ($i=0; $i < 14 ; $i++) {
//     $top = $DIu[$i]+$DId[$i];
//     if($top==0){
//       $top=1;
//     }
//     $dx= abs($DIu[$i] - $DId[$i]) / ($top);
//     array_push($change_array,$dx);
//   }
//   $ADX = (array_sum($change_array)/14)*100;
//   return $ADX;
// }
?>