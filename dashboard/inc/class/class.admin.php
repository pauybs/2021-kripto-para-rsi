<?php
  require_once ("class.db.php");
  date_default_timezone_set('Europe/Istanbul');
  class adminClass extends db{
    public $tablo; public $veriler; public $id; public $listele; public $sorgu; public $m_id; public $u_id;

		public $token; public $chat_id; public $mesaj;
		
		public $symbol; public $candle_interval; public $open_time;public $open;public $high;public $low;public $close;public $volume;public $close_time; public $period;

		public $adSoyad; public $ePosta; public $parola; public $algoritma;

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
      $sql = $bag->sorgu("SELECT * FROM alarmlar WHERE sembol=? and candle_interval=?",array("$this->symbol","$this->candle_interval"))->fetchAll(PDO::FETCH_OBJ);
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

		function kullanici_UyeOl(){
      $bag = new db;
			$sql = $bag->ekleNormal("kullanicilar","ad_soyad,e_posta,parola",array("$this->adSoyad","$this->ePosta","$this->parola"));
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Kayıt Başarılı, Giriş Sayfasın Yönlendiriliyorsunuz...','tip'=>'success');
        return $result;
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'Kayıt Gerçekleştirilemedi','tip'=>'error');
        return $result;
			}
			$bag->kapat();
		}
		function kullanici_AlarmListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM alarmlar WHERE kullanici_id=? and algoritma=? and sembol=?",array("$this->u_id","$this->algoritma","$this->symbol"))->fetchAll(PDO::FETCH_OBJ);
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

		function durumGuncelle(){
      $bag = new db;
			$sql = $bag->guncelleNormal(0,"$this->table", "durum", "WHERE id=?", array("$this->status", "$this->id"));
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Coin Güncellendi','tip'=>'success');
        echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function veriKaldir(){
      $bag = new db;
			$sql = $bag->sil("$this->table", "where id=?", array("$this->id"));
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Kaldırıldı','tip'=>'success');
        echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}

    function adminEkle(){
      $bag = new db;
			$sql = $bag->ekle("$this->tablo",$this->veriler);
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

		function kullanici_AktifAlarm(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT COUNT(id) as sayi FROM alarmlar WHERE kullanici_id=? and durum=1",array("$this->u_id"))->fetch(PDO::FETCH_OBJ);
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
		function kullanici_TumAlarm(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT COUNT(id) as sayi FROM alarmlar WHERE kullanici_id=?",array("$this->u_id"))->fetch(PDO::FETCH_OBJ);
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
		function kullanici_GerceklesenAlarm(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT COUNT(id) as sayi FROM bildirimler WHERE kullanici_id=?",array("$this->u_id"))->fetch(PDO::FETCH_OBJ);
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
		function kullanici_Bildirimler(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM bildirimler WHERE kullanici_id=? ORDER BY id DESC LIMIT 3",array("$this->u_id"))->fetchAll(PDO::FETCH_OBJ);
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
		function kullanici_BildirimlerTumu(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM bildirimler WHERE kullanici_id=?",array("$this->u_id"))->fetchAll(PDO::FETCH_OBJ);
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
		function kullanici_OkunmamisBildirimler(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT COUNT(id) as sayi FROM bildirimler WHERE kullanici_id=? and durum=0",array("$this->u_id"))->fetch(PDO::FETCH_OBJ);
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
		function kullanici_BildirimOku(){
      $bag = new db;
			$sql = $bag->guncelleNormal(0,"bildirimler","durum","WHERE durum=0",array(1));
			$bag->kapat();
		}
		function kriptoGrafik(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT close,add_time FROM kp_candlestick_data WHERE symbol=? and candle_interval=?",array($this->symbol,$this->candle_interval))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        echo json_encode($sql);
			}
			else
			{
				return null;
			}
			$bag->kapat();
		}
		function adminGuncelle(){
      $bag = new db;
			$sql = $bag->guncelle($this->tablo,$this->veriler,"WHERE id=?");
			if ($sql){
        $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Güncellendi!','tip'=>'success');
        echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function adminKaldir(){
      $bag = new db;
			$sql = $bag->sil("$this->tablo", "where id=?", array("$this->id"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Kaldırıldı','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function veriCek(){
			$bag = new db;
			$sql = $bag->cek("OBJ","$this->tablo","*","WHERE id=?",array("$this->id"));
			if($sql){
				return $sql;
			}
			$bag->kapat();
		}
    function musteriListele(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT id,ad,soyad,eposta,uyelik_tarihi,ulke FROM musteriler ORDER BY uyelik_tarihi DESC",array())->fetchAll(PDO::FETCH_OBJ);
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
		function urunListele(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT id,urun_adi,stok_kodu,fiyat FROM urunler ORDER BY id DESC",array())->fetchAll(PDO::FETCH_OBJ);
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




		

	}
