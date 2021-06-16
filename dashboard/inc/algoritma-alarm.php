<div id="algoritma-alarm" class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0"><?php echo $_GET['coin']; ?></h1>
        </div>
        <div class="col-auto">
          <button class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#alarmEkleModal">Yeni Alarm Ekle</button>
        </div>
      </div>
      <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a class="flex-sm-fill text-sm-center nav-link active" id="sma-rsi-tab" data-bs-toggle="tab" href="#sma-rsi" role="tab" aria-controls="sma-rsi" aria-selected="true">SMA RSI</a>
				<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">EMA RSI</a>
				<a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Williams R</a>
				<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">ADX</a>
      </nav>
      <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="sma-rsi" role="tabpanel" aria-labelledby="sma-rsi-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
              <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                  <thead>
                    <tr>
                      <th class="cell">#</th>
                      <th class="cell">İsim</th>
                      <th class="cell">Aralık</th>
                      <th class="cell">Periyot</th>
                      <th class="cell">Alarm Min.</th>
                      <th class="cell">Alarm Maks</th>
                      <th class="cell">Durum</th>
                      <th class="cell"></th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
										$islem->u_id=$_SESSION['user_id'];
										$islem->algoritma = "SMA_RSI";
										$islem->symbol = $_GET['coin'];
										$alarm = $islem->kullanici_AlarmListe();
										$i = 1;
										if($alarm==NULL){echo "<tr><td class='text-center' colspan='8'>Hiç alarm oluşturulmamış.</td></tr>";}
										foreach((array)$alarm as $a){
											$param =json_decode($a->degerler,true);
										?>
                    <tr>
                      <td class="cell"><?php echo $i; ?></td>
                      <td class="cell"><span class="truncate"><?php echo $a->isim; ?></span></td>
                      <td class="cell"><?php echo $a->candle_interval; ?></td>
                      <td class="cell"><?php echo $param['period']; ?></td>
                      <td class="cell"><?php echo $param['min']; ?></td>
                      <td class="cell"><?php echo $param['max']; ?></td>
                      <td class="cell">
                        <div class="form-check form-switch">
                          <input data-id="<?php echo $a->id; ?>" class="form-check-input durumButon" type="checkbox" <?php if($a->durum==1){echo 'checked';} ?>>
                        </div>
                      </td>
                      <td class="cell">
                        <a data-id="<?php echo $a->id; ?>" class="btn-sm app-btn-secondary kaldirButon" href="#">Kaldır</a>
                      </td>
                    </tr>
										<?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
              <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                  <thead>
                    <tr>
                      <th class="cell">#</th>
                      <th class="cell">İsim</th>
                      <th class="cell">Aralık</th>
                      <th class="cell">Periyot</th>
                      <th class="cell">Alarm Min.</th>
                      <th class="cell">Alarm Maks</th>
                      <th class="cell">Durum</th>
                      <th class="cell"></th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
										$islem->u_id=$_SESSION['user_id'];
										$islem->algoritma = "EMA_RSI";
										$islem->symbol = $_GET['coin'];
										$alarm = $islem->kullanici_AlarmListe();
										$i = 1;
										if($alarm==NULL){echo "<tr><td class='text-center' colspan='8'>Hiç alarm oluşturulmamış.</td></tr>";}
										foreach((array)$alarm as $a){
											$param =json_decode($a->degerler,true);
										?>
                    <tr>
                      <td class="cell"><?php echo $i; ?></td>
                      <td class="cell"><span class="truncate"><?php echo $a->isim; ?></span></td>
                      <td class="cell"><?php echo $a->candle_interval; ?></td>
                      <td class="cell"><?php echo $param['period']; ?></td>
                      <td class="cell"><?php echo $param['min']; ?></td>
                      <td class="cell"><?php echo $param['max']; ?></td>
                      <td class="cell">
                        <div class="form-check form-switch">
                          <input data-id="<?php echo $a->id; ?>" class="form-check-input durumButon" type="checkbox" <?php if($a->durum==1){echo 'checked';} ?>>
                        </div>
                      </td>
                      <td class="cell">
                        <a data-id="<?php echo $a->id; ?>" class="btn-sm app-btn-secondary kaldirButon" href="#">Kaldır</a>
                      </td>
                    </tr>
										<?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
              <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                  <thead>
                    <tr>
                      <th class="cell">#</th>
                      <th class="cell">İsim</th>
                      <th class="cell">Aralık</th>
                      <th class="cell">Periyot</th>
                      <th class="cell">Alarm Min.</th>
                      <th class="cell">Alarm Maks</th>
                      <th class="cell">Durum</th>
                      <th class="cell"></th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
										$islem->u_id=$_SESSION['user_id'];
										$islem->algoritma = "Williams_R";
										$islem->symbol = $_GET['coin'];
										$alarm = $islem->kullanici_AlarmListe();
										$i = 1;
										if($alarm==NULL){echo "<tr><td class='text-center' colspan='8'>Hiç alarm oluşturulmamış.</td></tr>";}
										foreach((array)$alarm as $a){
											$param =json_decode($a->degerler,true);
										?>
                    <tr>
                      <td class="cell"><?php echo $i; ?></td>
                      <td class="cell"><span class="truncate"><?php echo $a->isim; ?></span></td>
                      <td class="cell"><?php echo $a->candle_interval; ?></td>
                      <td class="cell"><?php echo $param['period']; ?></td>
                      <td class="cell"><?php echo $param['min']; ?></td>
                      <td class="cell"><?php echo $param['max']; ?></td>
                      <td class="cell">
                        <div class="form-check form-switch">
                          <input data-id="<?php echo $a->id; ?>" class="form-check-input durumButon" type="checkbox" <?php if($a->durum==1){echo 'checked';} ?>>
                        </div>
                      </td>
                      <td class="cell">
                        <a data-id="<?php echo $a->id; ?>" class="btn-sm app-btn-secondary kaldirButon" href="#">Kaldır</a>
                      </td>
                    </tr>
										<?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
              <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                  <thead>
                    <tr>
                      <th class="cell">#</th>
                      <th class="cell">İsim</th>
                      <th class="cell">Aralık</th>
                      <th class="cell">Periyot</th>
                      <th class="cell">Alarm Min.</th>
                      <th class="cell">Alarm Maks</th>
                      <th class="cell">Durum</th>
                      <th class="cell"></th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
										$islem->u_id=$_SESSION['user_id'];
										$islem->algoritma = "ADX";
										$islem->symbol = $_GET['coin'];
										$alarm = $islem->kullanici_AlarmListe();
										$i = 1;
										if($alarm==NULL){echo "<tr><td class='text-center' colspan='8'>Hiç alarm oluşturulmamış.</td></tr>";}
										foreach((array)$alarm as $a){
											$param =json_decode($a->degerler,true);
										?>
                    <tr>
                      <td class="cell"><?php echo $i; ?></td>
                      <td class="cell"><span class="truncate"><?php echo $a->isim; ?></span></td>
                      <td class="cell"><?php echo $a->candle_interval; ?></td>
                      <td class="cell"><?php echo $param['period']; ?></td>
                      <td class="cell"><?php echo $param['min']; ?></td>
                      <td class="cell"><?php echo $param['max']; ?></td>
                      <td class="cell">
                        <div class="form-check form-switch">
                          <input data-id="<?php echo $a->id; ?>" class="form-check-input durumButon" type="checkbox" <?php if($a->durum==1){echo 'checked';} ?>>
                        </div>
                      </td>
                      <td class="cell">
                        <a data-id="<?php echo $a->id; ?>" class="btn-sm app-btn-secondary kaldirButon" href="#">Kaldır</a>
                      </td>
                    </tr>
										<?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alarmEkleModal" tabindex="-1" aria-labelledby="alarmEkleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alarmEkleModalLabel">Yeni Alarm Ekle</h5>
      </div>
      <div class="modal-body">
      <form id="alarm_ekle">
        <input type="hidden" name="tablo" value="alarmlar">
        <input type="hidden" name="sembol" value="<?php echo $_GET['coin']; ?>">
        <input type="hidden" name="kullanici_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" class="form-control" id="degerler" name="degerler">
        <div class="row">
          <div class="col-12">
            <label class="form-label">Algoritma</label> 
            <select class="form-select" name="algoritma">
              <option selected value="SMA_RSI">
                SMA RSI (Simple Moving Average Relative Strength Index)
              </option>
              <option value="EMA_RSI">
                EMA RSI (Exponential Moving Average Relative Strength Index)
              </option>
              <option value="WILLIAMS_R">
                Williams %R
              </option>
              <option value="ADX">
                ADX (Average Directional Index)
              </option>
            </select>
          </div>
          <div class="col-6 mt-2">
            <label class="form-label">Mum Kapanışı Veri Aralığı</label> 
            <select class="form-select" name="candle_interval">
              <option selected value="5m">5 Dakika (5m)</option>
              <option value="15m">15 Dakika (15m)</option>
              <option value="30m">30 Dakika (30m)</option>
              <option value="4h">4 Saat (4h)</option>
            </select>
          </div>
          <div class="col-6 mt-2">
            <label class="form-label">Geçmiş Kapanış Mumları Sayısı (Periyot)</label>
            <input type="text" class="form-control degerler" value="14" id="period">
          </div>
          <div class="col-12 mt-2">
            <label class="form-label">Alarm İsmi</label> <input name="isim" type="text" class="form-control">
          </div>
          <div class="col-6 mt-2">
            <label class="form-label">Alarm Minimum Değeri</label> <input type="text" class="form-control" id="min">
          </div>
          <div class="col-6 mt-2">
            <label class="form-label">Alarm Maksimum Değeri</label> <input type="text" class="form-control" id="max">
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button> <button id="alarmEkleButon" type="button" class="btn app-btn-primary">Alarm Ekle</button>
      </div>
    </div>
  </div>
</div>