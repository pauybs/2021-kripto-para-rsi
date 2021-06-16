<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Bildirimler</h1>
        </div>
        <div class="col-auto"></div>
      </div>
      <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
              <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                  <thead>
                    <tr>
                      <th class="cell"></th>
                      <th class="cell">Bildirim Mesajı</th>
                      <th class="cell">Bildirim Tarihi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                                                              $islem->kullanici_BildirimOku();
                                                              $bildirimler = $islem->kullanici_BildirimlerTumu();
                                                              $i = 1;
                                                              foreach((array)$bildirimler as $b){?>
                    <tr>
                      <td class="cell"><?php echo $i; ?></td>
                      <td class="cell"><?php echo $b->mesaj; ?></td>
                      <td class="cell"><?php echo $b->tarih; ?></td>
                    </tr><?php $i++; } ?>
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