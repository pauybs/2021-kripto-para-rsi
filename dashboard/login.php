<?php
define('SITE','http://localhost/kripto-alarm/');
@ob_start();
@session_start();
require_once ('inc/class/class.db.php');
admin_oturum_kontrol_giris();
if (isset($_POST['islem'])) {
  $kullanici=$_POST['kullanici_adi'];
  $sifre=md5(base64_encode($_POST['parola']));
  $baglan=new db;
  $giriskontrol = $baglan->cek("OBJ","kullanicilar","id,e_posta,parola","where e_posta ='$kullanici' and parola ='$sifre'",array());    
  if ($giriskontrol) { 
      @ob_start();
      @session_start();
      $_SESSION['user_id'] = $giriskontrol->id;
      $_SESSION['username'] = $giriskontrol->e_posta;
      $_SESSION['password'] = $giriskontrol->parola;
      $bilgi = '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Giriş Başarılı!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
     header("Location: index.php");

  } else {
      $bilgi = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Kullanıcı Adı veya Parola Hatalı!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  $baglan->kapat();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tez - Kripto Alarm</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico">
  <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
  <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
</head>
<body class="app app-login p-0">
  <div class="row g-0 app-auth-wrapper">
    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <div class="app-auth-branding mb-4">
            <a class="app-logo" href="index.html"></a>
          </div>
          <h2 class="auth-heading text-center mb-5">Giriş Yap</h2>
          <div>
            <?php if(isset($bilgi)) echo $bilgi; ?>
          </div>
          <div class="auth-form-container text-start">
            <form class="auth-form login-form" method="post">
              <input type="hidden" name="islem">
              <div class="email mb-3">
                <input id="signin-email" name="kullanici_adi" type="email" class="form-control signin-email" placeholder="E-Posta Adresi" required="required">
              </div>
              <div class="password mb-3">
                <input id="signin-password" name="parola" type="password" class="form-control signin-password" placeholder="Parola" required="required">
                <div class="extra mt-3 row justify-content-between">
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="RememberPassword"> <label class="form-check-label" for="RememberPassword">Beni Hatırla</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Giriş Yap</button>
              </div>
            </form>
            <div class="auth-option text-center pt-5">
              Hesabınız yok mu? Hemen <a class="text-link" href="signup.php">kayıt ol</a>.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
      <div class="auth-background-holder"></div>
      <div class="auth-background-mask"></div>
    </div>
  </div>
</body>
</html>