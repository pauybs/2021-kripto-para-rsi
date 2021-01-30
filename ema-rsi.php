<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">İsim</th>
      <th scope="col">Periyot</th>
      <th scope="col">Aralık</th>
      <th scope="col">Alarm Min.</th>
      <th scope="col">Alarm Maks.</th>
      <th scope="col">Durum</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php error_reporting(0); $algoritma->emaRsiListe(); 
    for ($i=0; $i < count($algoritma->emaRsiID) ; $i++) { ?>
    <tr>
      <th scope="row"><?php echo $i+1; ?></th>
      <td><?php echo $algoritma->emaRsiName[$i]; ?></td>
      <td><?php echo $algoritma->emaRsiPeriod[$i]; ?></td>
      <td><?php echo $algoritma->emaRsiTime[$i]; ?></td>
      <td><?php echo $algoritma->emaRsiMinLimit[$i]; ?></td>
      <td><?php echo $algoritma->emaRsiMaxLimit[$i]; ?></td>
      <td>
        <div class="form-check form-switch">
          <input class="form-check-input" coin-id="<?php echo $algoritma->emaRsiID[$i]; ?>" type="checkbox" id="emaRsiGuncelleButon" <?php if($algoritma->emaRsiStatus[$i]==1){ echo "checked";} ?>>
        </div>
      </td>
      <td class="text-end">
        <button coin-id="<?php echo $algoritma->emaRsiID[$i]; ?>" type="button" class="btn btn-outline-danger btn-sm" id="emaRsiKaldirButon">Kaldır</button>
      </td>
    <?php } ?>
    </tr>
  </tbody>
</table>
<div class="row"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#emaModal">EMA RSI Ekle</button></div>


<div class="modal fade" id="emaModal" tabindex="-1" aria-labelledby="emaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emaModalLabel">EMA RSI Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="emaRsiEkle" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $algoritma->coinID; ?>">
        <label class="form-label">İsim</label>
        <input name="name" class="form-control" type="text" placeholder="EMA RSI 14">
        <label class="form-label">Periyot</label>
        <input name="period" class="form-control" type="number" placeholder="14">
        <label class="form-label">Veri Aralığı</label>
        <select name="time" class="form-select" name="coin">
          <option>5m</option>
          <option>15m</option>
          <option>30m</option>
          <option>1h</option>
          <option>4h</option>
        </select>
        <label class="form-label">Alarm için Minimum Limit</label>
        <input name="min" class="form-control" type="number" placeholder="30">
        <label class="form-label">Alarm için Maksimum Limit</label>
        <input name="max" class="form-control" type="number" placeholder="70">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="emaRsiKaydetButon">Kaydet</button>
      </div>
    </div>
  </div>
</div>