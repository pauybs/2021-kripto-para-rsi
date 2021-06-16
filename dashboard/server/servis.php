<?php 

require_once ('inc/class/class.admin.php');
require_once ('inc/algoritmalar.php');

$islem = new adminClass;

if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="candle_stick"){
  print_r($_REQUEST);
  $islem->symbol=$_REQUEST['symbol'];
  $islem->candle_interval=$_REQUEST['candle_interval'];
  $islem->open_time=$_REQUEST['open_time'];
  $islem->open=$_REQUEST['open'];
  $islem->high=$_REQUEST['high'];
  $islem->low=$_REQUEST['low'];
  $islem->close=$_REQUEST['close'];
  $islem->close_time=$_REQUEST['close_time'];
  $islem->Ekle_kp_candlestick_data();
}

if(isset($_REQUEST['islem']) && $_REQUEST['islem']=="alarm"){
  $islem->symbol=$_REQUEST['symbol'];
  $islem->candle_interval=$_REQUEST['candle_interval'];
  $data = $islem->Cek_alarm();
  print_r($data);
  foreach ((array) $data as $d) {
    $kullaniciId=$d->kullanici_id;
    $degerler=json_decode($d->degerler,true);
    $period = $degerler['period'];
    $min = $degerler['min'];
    $max = $degerler['max'];
    $islem->period=$period;
    $data = $islem->Cek_kp_candlestick_data();
    $result=algoritma($d->algoritma,$data,$period);
    if($result<$min || $result>$max){
      $islem->id = $kullaniciId;
      $kullanici = $islem->Cek_kullanici();
      $telegram=json_decode($kullanici->telegram_api,true);
      $islem->token = $telegram['token'];
      $islem->chat_id = $telegram['chat_id'];
      $islem->mesaj = $d->isim." Alarm\n".$islem->symbol." : ".$data[0]->close."\n".$d->algoritma." : ".$result;
      $islem->u_id =  $kullaniciId;
      $islem->bildirim();
      $islem->Ekle_bildirim();
    }
  }
}