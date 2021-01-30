<?php 
$coinler = new coinClass;
$coinler->coinListe();
?>
<h1 class="coinler">Coinler</h1>
<div class="row">
  <div class="col-md-8">
    <p>Kayıtlı <?php echo count($coinler->coinID); ?> adet Coin bulunmaktadır.</p>
  </div>
  <div class="col-md-4 text-end">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Coin Ekle</button>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Coin</th>
      <th scope="col">Durum</th>
      <th scope="col" style="width: 20%;"></th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i=0; $i < count($coinler->coinID) ; $i++) { ?>
    <tr>
      <th scope="row"><?php echo $i+1; ?></th>
      <td><?php echo $coinler->coinAdi[$i]; ?></td>
      <td>
        <div class="form-check form-switch">
          <input class="form-check-input" coin-id="<?php echo $coinler->coinID[$i]; ?>" type="checkbox" id="coinGuncelleButon" <?php if($coinler->coinDurum[$i]==1){ echo "checked";} ?>>
        </div>
      </td>
      <td class="text-end">
        <a href="http://localhost/tez/index.php?sayfa=algoritmalar&coin=<?php echo $coinler->coinAdi[$i]; ?>" type="button" class="btn btn-outline-primary btn-sm">Algoritma Ayarları</a>

        <button coin-id="<?php echo $coinler->coinID[$i]; ?>" type="button" class="btn btn-outline-danger btn-sm" id="coinKaldirButon">Kaldır</button>
      </td>
    <?php } ?>
    </tr>
  </tbody>
</table>
<?php
  $apiLink="https://www.binance.com/api/v3/ticker/price";
  $fgc = file_get_contents($apiLink);
  $symbol_json=json_decode($fgc,true);
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coin Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="coinEkle" enctype="multipart/form-data">
        <select class="form-select" name="coin">
          <option selected>Coin Seç</option>
          <?php foreach ($symbol_json as $item) { ?>
          <option selected><?php echo $item["symbol"] ?></option>
          <?php } ?>
        </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="coinKaydetButon">Kaydet</button>
      </div>
    </div>
  </div>
</div>