<?php
define('SITE','http://localhost/kripto-alarm/');
@ob_start();
@session_start();
require_once ('inc/class/class.admin.php');
admin_oturum_kontrol_giris();
if (isset($_POST['islem']) && $_POST['islem']=="kayit-ol") {
	$islem = new adminClass;
  $islem->adSoyad=$_POST['ad_soyad'];
	$islem->ePosta=$_POST['eposta'];
  $islem->parola=md5(base64_encode($_POST['parola']));
	$bilgi = $islem->kullanici_UyeOl();
	if($bilgi['sonuc']==1){
	$mesaj='<div class="alert alert-success alert-dismissible fade show" role="alert">Kayıt Başarılı, Giriş Sayfasına Yönlendiriliyorsunuz...<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	echo '<script language="javascript">setTimeout(function(){   
			window.location.assign("login.php");
			}, 3000);</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kayıt Ol</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico">
  <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
  <link id="theme-style" rel="stylesheet" href="assets/plugins/css/bootstrap.min.css">
  <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
  <link id="theme-style" rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app app-signup p-0">
  <div class="row g-0 app-auth-wrapper">
    <div class="align-middle col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <h2 class="auth-heading text-center mb-4">Kayıt Ol</h2>
					<?php if(isset($mesaj)) echo $mesaj; ?>
          <div class="align-middle auth-form-container text-start mx-auto">
            <form class="auth-form auth-signup-form" method="POST">
							<input type="hidden" name="islem" value="kayit-ol">
              <div class="email mb-3">
                <input id="signup-name" name="ad_soyad" type="text" class="form-control signup-name" placeholder="Ad Soyad" required="required">
              </div>
              <div class="email mb-3">
                <input id="signup-email" name="eposta" type="email" class="form-control signup-email" placeholder="E-Posta Adresi" required="required">
              </div>
              <div class="password mb-3">
                <input id="signup-password" name="parola" type="password" class="form-control signup-password" placeholder="Parola" required="required">
              </div>
              <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Kayıt Ol</button>
              </div>
            </form>
            <div class="auth-option text-center pt-5">
              Hesabın var mı? <a class="text-link" href="login.php">Giriş Yap</a>
            </div>
          </div>
        </div>
        <footer class="app-auth-footer"></footer>
      </div>
    </div>
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
      <div class="auth-background-holder"></div>
      <div class="auth-background-mask"></div>
      <div class="auth-background-overlay p-3 p-lg-5"></div>
    </div>
  </div>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>