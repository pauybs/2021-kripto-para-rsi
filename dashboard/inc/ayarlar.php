<?php 
$islem->id = $_SESSION['user_id'];
$kullanici = $islem->Cek_kullanici(); 
$telegram = json_decode($kullanici->telegram_api,true);
?>
<div id="ayarlar" class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <h1 class="app-page-title">Ayarlar</h1>
      <hr class="mb-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Telegram Bildirim</h3>
          <div class="section-intro">
            Telegram üzerinden bildirim almak için Telegram Bot API bilgilerinizi girin. <a href="#">Yardım</a>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
              <div class="mb-3">
                <label for="setting-input-2" class="form-label">Token</label> <input type="text" class="form-control" id="token" value="<?php if($telegram!=NULL) echo $telegram['token']; ?>">
              </div>
              <div class="mb-3">
                <label for="setting-input-3" class="form-label">Chat ID</label> <input type="text" class="form-control" id="chat_id" value="<?php if($telegram!=NULL) echo $telegram['chat_id']; ?>">
              </div>
              <form id="telegram" name="telegram">
                <input type="hidden" name="tablo" value="kullanicilar"> <input type="hidden" id="telegram_api" name="telegram_api"> <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>">
              </form><button id="kaydetButon" type="submit" class="btn app-btn-primary">Kaydet</button>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-4">
    </div>
  </div>
</div>


