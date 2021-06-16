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

function durumGuncelle(id,tablo,durum){
  var veriler = new FormData();
  veriler.append("islem","durum-guncelle");
  veriler.append("tablo",tablo);
  veriler.append("id",id);
  veriler.append("durum",durum);
  var getPost = "POST";
  var apiLink = url+"/inc/islemler.php";
  var sonuc = durumGuncelleSonuc;
  ajaxPost(getPost,apiLink,veriler,sonuc);
}
function durumGuncelleSonuc(sonuc){
  console.log(sonuc);
  var veri=(JSON.parse(sonuc));
  const baslik = veri.baslik;
  const aciklama = veri.aciklama;
  const tip = veri.tip;
  Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
}
function Guncelle(tablo){
  var veriler = new FormData(document.getElementById(tablo));
  veriler.append("islem","guncelle");
  var getPost = "POST";
  var apiLink = url+"/inc/islemler.php";
  var sonuc = GuncelleSonuc;
  ajaxPost(getPost,apiLink,veriler,sonuc);
}
function GuncelleSonuc(sonuc){
  console.log(sonuc);
  var veri=(JSON.parse(sonuc));
  const baslik = veri.baslik;
  const aciklama = veri.aciklama;
  const tip = veri.tip;
  Swal.fire({position: 'top-end',icon: tip,title: baslik,showConfirmButton: false,timer: 1500});
}
function ekle(formId){
  var veriler = new FormData(document.getElementById(formId));
  veriler.append("islem","ekle")
  var getPost = "POST";
  var apiLink = url+"/inc/islemler.php";
  var sonuc =ekleSonuc;
  ajaxPost(getPost,apiLink,veriler,sonuc);
}
function ekleSonuc(sonuc){
  var veri=(JSON.parse(sonuc));
  const baslik = veri.baslik;
  const aciklama = veri.aciklama;
  const tip = veri.tip;
  if(veri.sonuc==1)
    Swal.fire(baslik,aciklama,tip).then(yenile);
  else
    Swal.fire(baslik,aciklama,tip);
}
function kaldir(tablo,id){
  var veriler = new FormData();
  veriler.append("islem","veri-kaldir");
  veriler.append("tablo",tablo);
  veriler.append("id",id);
  var getPost = "POST";
  var apiLink = url+"/inc/islemler.php";
  var sonuc = kaldirSonuc;
  ajaxPost(getPost,apiLink,veriler,sonuc);
}
function kaldirSonuc(sonuc){
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

const Sayfa_algoritmaAlarm = document.getElementById('algoritma-alarm');
if(Sayfa_algoritmaAlarm) {
  let kaldirButonlar = document.querySelectorAll('.kaldirButon');
  for (i of kaldirButonlar) {
    i.addEventListener('click', function() {
      var data_id = this.getAttribute("data-id");
      Swal.fire({
        title: 'Emin misiniz?',
        text: "Alarm sistemden tamamen kaldıralacaktır, bunun yerine devre dışı bırakabilirsiniz!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Vazgeç",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, alarmı kaldır!'
      }).then((result) => {
        if (result.isConfirmed) {
          kaldir("alarmlar",data_id);
        }
      })
      
    });
  }
  let guncelleButonlar = document.querySelectorAll('.durumButon');
  for (i of guncelleButonlar) {
    i.addEventListener('click', function() {
      var data_id = this.getAttribute("data-id");
      if(this.checked==true)
      durumGuncelle(data_id,"alarmlar","1");
      else if(this.checked==false)
      durumGuncelle(data_id,"alarmlar","0");
    });
  }

  var period = document.getElementById('period');
  var min = document.getElementById('min');
  var max = document.getElementById('max');
  degerler.value='{"period": "'+period.value+'","min": "'+min.value+'","max":"'+max.value+'"}';
  period.addEventListener('change', (event) => {
    degerler.value='{"period": "'+period.value+'","min": "'+min.value+'","max":"'+max.value+'"}';});
  min.addEventListener('change', (event) => {
    degerler.value='{"period": "'+period.value+'","min": "'+min.value+'","max":"'+max.value+'"}';});
  max.addEventListener('change', (event) => {
      degerler.value='{"period": "'+period.value+'","min": "'+min.value+'","max":"'+max.value+'"}';});


  document.getElementById("alarmEkleButon").addEventListener("click", 
  function(){ekle('alarm_ekle');});
  

}


const Sayfa_Anasayfa = document.getElementById('anasayfa');
if(Sayfa_Anasayfa) {
  function kriptoGrafik(){
    var veriler = new FormData();
    veriler.append("islem","kripto-grafik");
    veriler.append("sembol","btcusdt");
    veriler.append("candle","1m");
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = kriptoGrafikSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function kriptoGrafikSonuc(sonuc){
    var veri=(JSON.parse(sonuc));
    console.log(veri);
    var labels = veri.map(function(e) {
      return e.add_time;
   });
   var data = veri.map(function(e) {
      return e.close;
   });
   new Chart(document.getElementById("canvas-linechart"), {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{ 
          data: data,
          label: "BTCUSDT",
          borderColor: "#3e95cd",
          fill: false
        }
      ]
    },
    options: {
    }
  });
}
kriptoGrafik();
}
const Sayfa_Grafikler = document.getElementById('grafikler');
if(Sayfa_Grafikler) {
  function kriptoGrafik(){
    var veriler = new FormData(document.getElementById("kripto-para-form"));
    veriler.append("islem","kripto-grafik");
    var getPost = "POST";
    var apiLink = url+"/inc/islemler.php";
    var sonuc = kriptoGrafikSonuc;
    ajaxPost(getPost,apiLink,veriler,sonuc);
  }
  function kriptoGrafikSonuc(sonuc){
    var veri=(JSON.parse(sonuc));
    console.log(veri);
    var labels = veri.map(function(e) {
      return e.add_time;
   });
   var data = veri.map(function(e) {
      return e.close;
   });
   var baslik = document.getElementById('kripto-select').value;
   new Chart(document.getElementById("canvas-linechart"), {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{ 
          data: data,
          label: baslik,
          borderColor: "#3e95cd",
          fill: false
        }
      ]
    },
    options: {
    }
  });
}

document.getElementById("grafikButon").addEventListener("click", 
function(){kriptoGrafik();});

}

const Sayfa_Ayarlar = document.getElementById('ayarlar');
if(Sayfa_Ayarlar) {



  var tokenId = document.getElementById('token');
  var chatId = document.getElementById('chat_id');
  var telegram = document.getElementById('telegram_api');
  telegram.value='{"token": "'+tokenId.value+'", "chat_id": "'+chatId.value+'"}';
  tokenId.addEventListener('change', (event) => {
    telegram.value='{"token": "'+tokenId.value+'", "chat_id": "'+chatId.value+'"}';});
  chatId.addEventListener('change', (event) => {
    telegram.value='{"token": "'+tokenId.value+'", "chat_id": "'+chatId.value+'"}';});


  document.getElementById("kaydetButon").addEventListener("click", 
  function(){Guncelle('telegram');});
  

}