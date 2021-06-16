<?php $islem->u_id=$_SESSION['user_id']; ?>
<div id="anasayfa" class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-4 mb-4">
        <div class="col-4 col-lg-4">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Aktif Alarm</h4>
              <div class="stats-figure">
                <?php $k=$islem->kullanici_AktifAlarm(); echo $k->sayi; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4 col-lg-4">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Gerçekleşen Alarm</h4>
              <div class="stats-figure">
              <?php $k=$islem->kullanici_GerceklesenAlarm(); echo $k->sayi; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4 col-lg-4">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Toplam Alarm</h4>
              <div class="stats-figure">
              <?php $k=$islem->kullanici_TumAlarm(); echo $k->sayi; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4 mb-4">
        <div class="col-12 col-lg-12">
          <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <h4 class="app-card-title">Kripto Para Grafiği</h4>
                </div>
                <div class="col-auto">
                  <div class="card-header-action">
                    <a href="index.php?page=grafikler">Daha Fazla</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
              <div class="chart-container">
                <canvas id="canvas-linechart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>