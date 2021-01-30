var url = document.URL.split('/').slice(0, -1).join('/');
function yenile(){location.reload();}
function ajaxPost(getPost,apiLink,veriler,sonuc){
  var xhr = new XMLHttpRequest();
  xhr.open(getPost, apiLink,true);
  xhr.onload = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      sonuc(xhr.responseText);
    }
    else if (xhr.status !== 200) {
      alert('Request failed.  Returned status of ' + xhr.status);
    }
  };
  xhr.send(veriler);
}

const coinlerSayfa = document.querySelector('.coinler');
if(coinlerSayfa) {
  function coinKaydet(){
    var veriler = new FormData(document.getElementById("coinEkle"));
    veriler.append("islem","coin-ekle")
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = coinEkleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function coinEkleSonuc(sonuc){
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  document.getElementById("coinKaydetButon").addEventListener("click", coinKaydet);

  function coinKaldir(coinID){
    var veriler = new FormData();
    veriler.append("islem","kaldir");
    veriler.append("tablo","coinler");
    veriler.append("id",coinID);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = coinKaldirSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function coinKaldirSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  let kaldirButonlar = document.querySelectorAll('#coinKaldirButon');
  for (i of kaldirButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      coinKaldir(coin_id);
    });
  }

  function coinGuncelle(coinID,coinDurum){
    var veriler = new FormData();
    veriler.append("islem","durum-guncelle");
    veriler.append("tablo","coinler");
    veriler.append("id",coinID);
    veriler.append("durum",coinDurum);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = coinGuncelleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function coinGuncelleSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
  }
  let guncelleButonlar = document.querySelectorAll('#coinGuncelleButon');
  for (i of guncelleButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      if(this.checked==true)
      coinGuncelle(coin_id,"1");
      else if(this.checked==false)
      coinGuncelle(coin_id,"0");
    });
  }
}

const algoritmalarSayfa = document.querySelector('.algoritmalar');
if(algoritmalarSayfa) {

  //SMA RSI
  function smaRsiKaydet(){
    var veriler = new FormData(document.getElementById("smaRsiEkle"));
    veriler.append("islem","sma-rsi-ekle")
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = smaRsiEkleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function smaRsiEkleSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  document.getElementById("smaRsiKaydetButon").addEventListener("click", smaRsiKaydet);

  function smaRsiKaldir(coinID){
    var veriler = new FormData();
    veriler.append("islem","kaldir");
    veriler.append("tablo","sma_rsi");
    veriler.append("id",coinID);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = smaRsiKaldirSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function smaRsiKaldirSonuc(sonuc){
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  let kaldirButonlar = document.querySelectorAll('#smaRsiKaldirButon');
  for (i of kaldirButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      smaRsiKaldir(coin_id);
    });
  }

  function smaRsiGuncelle(coinID,coinDurum){
    var veriler = new FormData();
    veriler.append("islem","durum-guncelle");
    veriler.append("tablo","sma_rsi");
    veriler.append("id",coinID);
    veriler.append("durum",coinDurum);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = smaRsiGuncelleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function smaRsiGuncelleSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
  }
  let guncelleButonlar = document.querySelectorAll('#smaRsiGuncelleButon');
  for (i of guncelleButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      if(this.checked==true)
      smaRsiGuncelle(coin_id,"1");
      else if(this.checked==false)
      smaRsiGuncelle(coin_id,"0");
    });
  }
  //
  //EMA RSI
  function emaRsiKaydet(){
    var veriler = new FormData(document.getElementById("emaRsiEkle"));
    veriler.append("islem","ema-rsi-ekle")
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = emaRsiEkleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function emaRsiEkleSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  document.getElementById("emaRsiKaydetButon").addEventListener("click", emaRsiKaydet);

  function emaRsiKaldir(coinID){
    var veriler = new FormData();
    veriler.append("islem","kaldir");
    veriler.append("tablo","ema_rsi");
    veriler.append("id",coinID);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = emaRsiKaldirSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function emaRsiKaldirSonuc(sonuc){
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    if(veri.sonuc==1)
      Swal.fire(baslik,aciklama,tip).then(yenile);
    else
      Swal.fire(baslik,aciklama,tip);
  }
  let emakaldirButonlar = document.querySelectorAll('#emaRsiKaldirButon');
  for (i of emakaldirButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      emaRsiKaldir(coin_id);
    });
  }

  function emaRsiGuncelle(coinID,coinDurum){
    var veriler = new FormData();
    veriler.append("islem","durum-guncelle");
    veriler.append("tablo","ema_rsi");
    veriler.append("id",coinID);
    veriler.append("durum",coinDurum);
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = emaRsiGuncelleSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function emaRsiGuncelleSonuc(sonuc){
    console.log(sonuc);
    var veri=(JSON.parse(sonuc));
    const baslik = veri.baslik;
    const aciklama = veri.aciklama;
    const tip = veri.tip;
    Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
  }
  let emaguncelleButonlar = document.querySelectorAll('#emaRsiGuncelleButon');
  for (i of emaguncelleButonlar) {
    i.addEventListener('click', function() {
      var coin_id = this.getAttribute("coin-id");
      if(this.checked==true)
      emaRsiGuncelle(coin_id,"1");
      else if(this.checked==false)
      emaRsiGuncelle(coin_id,"0");
    });
  }

        //Williams R
    function williamsRKaydet(){
      var veriler = new FormData(document.getElementById("williamsREkle"));
      veriler.append("islem","williams-r-ekle")
      var getPost = "POST";
      var apiLink = url+"/inc/islemler.php";
      var sonuc = williamsREkleSonuc;
      ajaxPost(getPost,apiLink,veriler,sonuc);
    }
    function williamsREkleSonuc(sonuc){
      console.log(sonuc);
      var veri=(JSON.parse(sonuc));
      const baslik = veri.baslik;
      const aciklama = veri.aciklama;
      const tip = veri.tip;
      if(veri.sonuc==1)
        Swal.fire(baslik,aciklama,tip).then(yenile);
      else
        Swal.fire(baslik,aciklama,tip);
    }
    document.getElementById("williamsRKaydetButon").addEventListener("click", williamsRKaydet);
  
    function williamsRKaldir(coinID){
      var veriler = new FormData();
      veriler.append("islem","kaldir");
      veriler.append("tablo","williams_r");
      veriler.append("id",coinID);
      var getPost = "POST";
      var apiLink = url+"/inc/islemler.php";
      var sonuc = williamsRKaldirSonuc;
      ajaxPost(getPost,apiLink,veriler,sonuc);
    }
    function williamsRKaldirSonuc(sonuc){
      var veri=(JSON.parse(sonuc));
      const baslik = veri.baslik;
      const aciklama = veri.aciklama;
      const tip = veri.tip;
      if(veri.sonuc==1)
        Swal.fire(baslik,aciklama,tip).then(yenile);
      else
        Swal.fire(baslik,aciklama,tip);
    }
    let williamsrkaldirButonlar = document.querySelectorAll('#williamsRKaldirButon');
    for (i of williamsrkaldirButonlar) {
      i.addEventListener('click', function() {
        var coin_id = this.getAttribute("coin-id");
        williamsRKaldir(coin_id);
      });
    }
  
    function williamsRGuncelle(coinID,coinDurum){
      var veriler = new FormData();
      veriler.append("islem","durum-guncelle");
      veriler.append("tablo","williams_r");
      veriler.append("id",coinID);
      veriler.append("durum",coinDurum);
      var getPost = "POST";
      var apiLink = url+"/inc/islemler.php";
      var sonuc = williamsRGuncelleSonuc;
      ajaxPost(getPost,apiLink,veriler,sonuc);
    }
    function williamsRGuncelleSonuc(sonuc){
      console.log(sonuc);
      var veri=(JSON.parse(sonuc));
      const baslik = veri.baslik;
      const aciklama = veri.aciklama;
      const tip = veri.tip;
      Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
    }
    let williamsrguncelleButonlar = document.querySelectorAll('#williamsRGuncelleButon');
    for (i of williamsrguncelleButonlar) {
      i.addEventListener('click', function() {
        var coin_id = this.getAttribute("coin-id");
        if(this.checked==true)
        williamsRGuncelle(coin_id,"1");
        else if(this.checked==false)
        williamsRGuncelle(coin_id,"0");
      });
    }
      //ADX
      function adxKaydet(){
        var veriler = new FormData(document.getElementById("adxEkle"));
        veriler.append("islem","adx-ekle")
        var getPost = "POST";
        var apiLink = url+"/inc/islemler.php";
        var sonuc = adxEkleSonuc;
        ajaxPost(getPost,apiLink,veriler,sonuc);
      }
      function adxEkleSonuc(sonuc){
        console.log(sonuc);
        var veri=(JSON.parse(sonuc));
        const baslik = veri.baslik;
        const aciklama = veri.aciklama;
        const tip = veri.tip;
        if(veri.sonuc==1)
          Swal.fire(baslik,aciklama,tip).then(yenile);
        else
          Swal.fire(baslik,aciklama,tip);
      }
      document.getElementById("adxKaydetButon").addEventListener("click", adxKaydet);
    
      function adxKaldir(coinID){
        var veriler = new FormData();
        veriler.append("islem","kaldir");
        veriler.append("tablo","adx");
        veriler.append("id",coinID);
        var getPost = "POST";
        var apiLink = url+"/inc/islemler.php";
        var sonuc = adxKaldirSonuc;
        ajaxPost(getPost,apiLink,veriler,sonuc);
      }
      function adxKaldirSonuc(sonuc){
        var veri=(JSON.parse(sonuc));
        const baslik = veri.baslik;
        const aciklama = veri.aciklama;
        const tip = veri.tip;
        if(veri.sonuc==1)
          Swal.fire(baslik,aciklama,tip).then(yenile);
        else
          Swal.fire(baslik,aciklama,tip);
      }
      let adxkaldirButonlar = document.querySelectorAll('#adxKaldirButon');
      for (i of adxkaldirButonlar) {
        i.addEventListener('click', function() {
          var coin_id = this.getAttribute("coin-id");
          adxKaldir(coin_id);
        });
      }
    
      function adxGuncelle(coinID,coinDurum){
        var veriler = new FormData();
        veriler.append("islem","durum-guncelle");
        veriler.append("tablo","adx");
        veriler.append("id",coinID);
        veriler.append("durum",coinDurum);
        var getPost = "POST";
        var apiLink = url+"/inc/islemler.php";
        var sonuc = adxGuncelleSonuc;
        ajaxPost(getPost,apiLink,veriler,sonuc);
      }
      function adxGuncelleSonuc(sonuc){
        console.log(sonuc);
        var veri=(JSON.parse(sonuc));
        const baslik = veri.baslik;
        const aciklama = veri.aciklama;
        const tip = veri.tip;
        Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
      }
      let adxguncelleButonlar = document.querySelectorAll('#adxGuncelleButon');
      for (i of adxguncelleButonlar) {
        i.addEventListener('click', function() {
          var coin_id = this.getAttribute("coin-id");
          if(this.checked==true)
          adxGuncelle(coin_id,"1");
          else if(this.checked==false)
          adxGuncelle(coin_id,"0");
        });
      }
}