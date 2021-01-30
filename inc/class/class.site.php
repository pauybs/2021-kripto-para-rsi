<?php
  require_once ("class.db.php");
  date_default_timezone_set('Europe/Istanbul');
  class coinClass extends db{
		
		public $sID; public $status; public $table; public $value; public $grafikName;
		public $coinID; public $coinAdi; public $coinComboAdi; public $coinDurum; public $coinAnlikFiyat; public $algoritmaAdi; public $algoritmaAralik; public $algoritmaDegeri; public $algoritmaTarih; public $logID; public $coinFiyati; public $coinTarih;
		
		public $smaRsiID; public $smaRsiName; public $smaRsiPeriod; public $smaRsiTime; public $smaRsiMinLimit; public $smaRsiMaxLimit; public $smaRsiStatus; public $smaRsiCoinId;
		public $emaRsiID; public $emaRsiName; public $emaRsiPeriod; public $emaRsiTime; public $emaRsiMinLimit; public $emaRsiMaxLimit; public $emaRsiStatus; public $emaRsiCoinId;
		public $williamsRID; public $williamsRName; public $williamsRPeriod; public $williamsRTime; public $williamsRMinLimit; public $williamsRMaxLimit; public $williamsRStatus; public $williamsRCoinId;
		public $adxID; public $adxName; public $adxPeriod; public $adxTime; public $adxMinLimit; public $adxMaxLimit; public $adxStatus; public $adxCoinId;

		public $pID; public $servisCoinAdi; public $servisCoinID; public $servisPeriod; public $servisTime; public $servisMinLimit; public $servisMaxLimit; public $servisAdi;
    function coinListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM coinler",array())->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->coin_adi; $c[]=$key->durum;
        }
        $this->coinID=$a;
        $this->coinAdi=$b;
        $this->coinDurum=$c;	
			}
			else
			{
				
			}
			$bag->kapat();
		}
		function coinComboListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM coinler",array())->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->coin_adi;
        }
        $this->coinComboAdi=$a;
			}
			else
			{
				
			}
			$bag->kapat();
		}
		function coinLogGrafik(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT coin_fiyati,tarih FROM loglar WHERE coin_id=?",array("$this->coinID"))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->coin_fiyati; $b[]=$key->tarih;
        }
        $this->coinFiyati=json_encode($a);
        $this->coinTarih=json_encode($b);
			}
			$bag->kapat();
		}
		function coinAlgoritmagGrafik(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM $this->table WHERE p_id=?",array("$this->pID"))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->value; $b[]=$key->data_time;
        }
        $this->algoritmaDegeri=json_encode($a);
        $this->algoritmaTarih=json_encode($b);
			}
			$bag->kapat();
		}
		function grafikAlgoritmaCek(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM $this->table WHERE coin_id=?",array("$this->coinID"))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->name;
        }
        $this->sID=$a;
				$this->grafikName=$b;
			}
			else
			{
				
			}
			$bag->kapat();
		}
		function coinBul(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT id FROM coinler WHERE coin_adi=?",array("$this->coinAdi"))->fetch(PDO::FETCH_OBJ);
			if($sql)
			{
        $this->coinID=$sql->id;	
			}
			$bag->kapat();
		}
		function coinEkle(){
      $bag = new db;
			$sql = $bag->ekle("coinler","coin_adi,durum",array("$this->coinAdi","0"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Coin Eklendi','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function islemKaldir(){
      $bag = new db;
			$sql = $bag->sil("$this->table", "where id=?", array("$this->sID"));
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
		function islemDurumGuncelle(){
      $bag = new db;
			$sql = $bag->guncelle(0,"$this->table", "durum", "WHERE id=?", array("$this->status", "$this->sID"));
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
		function smaRsiListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM sma_rsi WHERE coin_id=?",array($this->coinID))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->name; $c[]=$key->period; $d[]=$key->time; $e[]=$key->min_limit; $f[]=$key->max_limit; $g[]=$key->durum;
        }
        $this->smaRsiID=$a;
        $this->smaRsiName=$b;
        $this->smaRsiPeriod=$c;	
        $this->smaRsiTime=$d;	
				$this->smaRsiMinLimit=$e;
        $this->smaRsiMaxLimit=$f;	
        $this->smaRsiStatus=$g;	
					
			}
			else{
			}
			$bag->kapat();
		}
		function smaRsiEkle(){
      $bag = new db;
			$sql = $bag->ekle("sma_rsi","coin_id,name,period,time,min_limit,max_limit,durum",array("$this->coinID","$this->smaRsiName"," $this->smaRsiPeriod","$this->smaRsiTime","$this->smaRsiMinLimit","$this->smaRsiMaxLimit","0"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}

		function emaRsiListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM ema_rsi WHERE coin_id=?",array($this->coinID))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->name; $c[]=$key->period; $d[]=$key->time; $e[]=$key->min_limit; $f[]=$key->max_limit; $g[]=$key->durum;
        }
        $this->emaRsiID=$a;
        $this->emaRsiName=$b;
        $this->emaRsiPeriod=$c;	
        $this->emaRsiTime=$d;	
				$this->emaRsiMinLimit=$e;
        $this->emaRsiMaxLimit=$f;	
        $this->emaRsiStatus=$g;	
					
			}
			else{
			}
			$bag->kapat();
		}
		function emaRsiEkle(){
      $bag = new db;
			$sql = $bag->ekle("ema_rsi","coin_id,name,period,time,min_limit,max_limit,durum",array("$this->coinID","$this->emaRsiName"," $this->emaRsiPeriod","$this->emaRsiTime","$this->emaRsiMinLimit","$this->emaRsiMaxLimit","0"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function williamsRListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM williams_r WHERE coin_id=?",array($this->coinID))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->name; $c[]=$key->period; $d[]=$key->time; $e[]=$key->min_limit; $f[]=$key->max_limit; $g[]=$key->durum;
        }
        $this->williamsRID=$a;
        $this->williamsRName=$b;
        $this->williamsRPeriod=$c;	
        $this->williamsRTime=$d;	
				$this->williamsRMinLimit=$e;
        $this->williamsRMaxLimit=$f;	
        $this->williamsRStatus=$g;	
					
			}
			else{
			}
			$bag->kapat();
		}
		function williamsREkle(){
      $bag = new db;
			$sql = $bag->ekle("williams_r","coin_id,name,period,time,min_limit,max_limit,durum",array("$this->coinID","$this->williamsRName"," $this->williamsRPeriod","$this->williamsRTime","$this->williamsRMinLimit","$this->williamsRMaxLimit","0"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}
		function adxListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM adx WHERE coin_id=?",array($this->coinID))->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->name; $c[]=$key->period; $d[]=$key->time; $e[]=$key->min_limit; $f[]=$key->max_limit; $g[]=$key->durum;
        }
        $this->adxID=$a;
        $this->adxName=$b;
        $this->adxPeriod=$c;	
        $this->adxTime=$d;	
				$this->adxMinLimit=$e;
        $this->adxMaxLimit=$f;	
        $this->adxStatus=$g;	
					
			}
			else{
			}
			$bag->kapat();
		}
		function adxEkle(){
      $bag = new db;
			$sql = $bag->ekle("adx","coin_id,name,period,time,min_limit,max_limit,durum",array("$this->coinID","$this->adxName"," $this->adxPeriod","$this->adxTime","$this->adxMinLimit","$this->adxMaxLimit","0"));
			if ($sql){
                $result = array('sonuc'=>'1','baslik'=>'Başarılı!','aciklama'=>'Eklendi','tip'=>'success');
                echo json_encode($result);
			}
			else{
				$result = array('sonuc'=>'0','baslik'=>'Başarısız!','aciklama'=>'İşlem Gerçekleştirilemedi','tip'=>'error');
        echo json_encode($result);
			}
			$bag->kapat();
		}


		function servisCoinListe(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT * FROM coinler WHERE durum='1'",array())->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->id; $b[]=$key->coin_adi; $c[]=$key->durum;
        }
        $this->coinID=$a;
        $this->coinAdi=$b;
			}
			else
			{
				
			}
			$bag->kapat();
		}
		function servisLogKaydet(){
      $bag = new db;
			$sql = $bag->ekle("loglar","coin_id,coin_fiyati", array("$this->coinID","$this->coinAnlikFiyat"));
			if($sql)
			{
				return $sql;
			}
			$bag->kapat();
		}
		function servisAlgoritmaKaydet(){
      $bag = new db;
			$sql = $bag->ekle("$this->table","p_id, coin_id,value", array("$this->pID","$this->coinID","$this->value"));
			$bag->kapat();
		}
		function servisAlgoritmaCek(){
      $bag = new db;
      $sql = $bag->sorgu("SELECT s.*,c.coin_adi FROM $this->table as s INNER JOIN coinler as c ON s.coin_id = c.id WHERE s.durum=1 and c.durum=1",array())->fetchAll(PDO::FETCH_OBJ);
			if($sql)
			{
        foreach ($sql as $key) {
          $a[]=$key->period; $b[]=$key->time; $c[]=$key->min_limit; $d[]=$key->max_limit; $e[]=$key->id; $f[]=$key->coin_id; $g[]=$key->coin_adi; $h[]=$key->name;
        }
        $this->servisPeriod=$a;
				$this->servisTime=$b;
				$this->servisMinLimit=$c;
				$this->servisMaxLimit=$d;
				$this->sID=$e;
				$this->servisCoinID=$f;
				$this->servisCoinAdi=$g;
				$this->servisAdi=$h;
			}
			else
			{
				
			}
			$bag->kapat();
		}
		function bildirim($mesaj){
				$token = "1473691108:AAE8VodYYiGWMkc9qoEks93BazsRp_-lLkY";
				$data = [
					'text' => $mesaj,
					'chat_id' => '-498003389'
			];
			
			file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
		
		}
	}