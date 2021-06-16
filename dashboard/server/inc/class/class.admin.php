<?php
  require_once ("class.db.php");
  date_default_timezone_set('Europe/Istanbul');
  class adminClass extends db{
		public $tablo; public $veriler; public $id;

		public $token; public $chat_id; public $mesaj;
		
		public $symbol; public $candle_interval; public $open_time;public $open;public $high;public $low;public $close; public $close_time; public $period;

		function Ekle_kp_candlestick_data(){
			$bag = new db;
			$sql = $bag->ekleNormal("kp_candlestick_data","symbol,candle_interval,open_time,open,high,low,close,close_time",array("$this->symbol","$this->candle_interval","$this->open_time","$this->open","$this->high","$this->low","$this->close","$this->close_time"));
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi!','tip'=>'success');
        echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function Cek_kp_candlestick_data(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM kp_candlestick_data WHERE symbol=? and candle_interval=? ORDER BY id DESC LIMIT $this->period",array("$this->symbol","$this->candle_interval"))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        return $sql;
			}
			else
			{
				return null;
			}
			$bag->kapat();
		}
		function Cek_alarm(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM alarmlar WHERE sembol=? and candle_interval=? and durum=1",array("$this->symbol","$this->candle_interval"))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        return $sql;
			}
			else
			{
				return null;
			}
			$bag->kapat();
		}
		function Cek_kullanici(){
			$bag = new db;
			$sql = $bag->cek("OBJ","kullanicilar","*","WHERE id=?",array("$this->id"));
			if($sql){
				return $sql;
			}
			$bag->kapat();
		}
		function bildirim(){
			$token = "$this->token";
			$data = ['text' => $this->mesaj, 'chat_id' => $this->chat_id];
			file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
		}
		function Ekle_bildirim(){
			$bag = new db;
			$sql = $bag->ekleNormal("bildirimler","mesaj,kullanici_id",array("$this->mesaj","$this->u_id"));
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi!','tip'=>'success');
        echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
	

	}
