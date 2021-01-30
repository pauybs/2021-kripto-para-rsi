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
    <?php error_reporting(0); $algoritma->adxListe(); 
    for ($i=0; $i < count($algoritma->adxID) ; $i++) { ?>
    <tr>
      <th scope="row"><?php echo $i+1; ?></th>
      <td><?php echo $algoritma->adxName[$i]; ?></td>
      <td><?php echo $algoritma->adxPeriod[$i]; ?></td>
      <td><?php echo $algoritma->adxTime[$i]; ?></td>
      <td><?php echo $algoritma->adxMinLimit[$i]; ?></td>
      <td><?php echo $algoritma->adxMaxLimit[$i]; ?></td>
      <td>
        <div class="form-check form-switch">
          <input class="form-check-input" coin-id="<?php echo $algoritma->adxID[$i]; ?>" type="checkbox" id="adxGuncelleButon" <?php if($algoritma->adxStatus[$i]==1){ echo "checked";} ?>>
        </div>
      </td>
      <td class="text-end">
        <button coin-id="<?php echo $algoritma->adxID[$i]; ?>" type="button" class="btn btn-outline-danger btn-sm" id="adxKaldirButon">Kaldır</button>
      </td>
    <?php } ?>
    </tr>
  </tbody>
</table>
<div class="row"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adxModal">ADX Ekle</button></div>


<div class="modal fade" id="adxModal" tabindex="-1" aria-labelledby="adxModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adxModalLabel">ADX Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="adxEkle" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $algoritma->coinID; ?>">
        <label class="form-label">İsim</label>
        <input name="name" class="form-control" type="text" placeholder="ADX 14">
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
        <button type="button" class="btn btn-primary" id="adxKaydetButon">Kaydet</button>
      </div>
    </div>
  </div>
</div>