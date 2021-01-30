<?php
error_reporting(0);  
$coin = new coinClass;
$coin->coinAdi=$_GET['coin'];
$coin->coinBul();
$grafik = new coinClass;
$coinler = new coinClass;
$coinler->coinComboListe();
$algoritmalar = ['sma_rsi','ema_rsi','williams_r','adx'];
$g = new coinClass;
?>
<div class="row">
  <div class="col-md-6">
    <h1>Grafikler - <?php echo $coin->coinAdi; ?></h1>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-8">
        <form action="index.php" method="get">
        <input type="hidden" name="sayfa" value="grafikler" />
        <select class="form-select" name="coin">
          <option selected>Coin Seç</option>
          <?php for ($i=0; $i < count($coinler->coinComboAdi) ; $i++) { ?>
          <option value="<?php echo $coinler->coinComboAdi[$i]; ?>"><?php echo $coinler->coinComboAdi[$i]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-4">
      <button class="btn btn-primary" type="submit">Seç</button>
    </form>
      </div>
    </div>

  </div>
</div>

   
<div class="row" style="margin-top:50px;">
    <?php 
    
    for ($k=0; $k <count($algoritmalar) ; $k++) { 
      $grafik->table=$algoritmalar[$k];
      $grafik->coinID=$coin->coinID;
      $grafik->grafikAlgoritmaCek();
      for ($i=0; $i <count($grafik->sID) ; $i++) { 

        ?>
         <div class="col-md-6">
        <h3> <?php echo $grafik->grafikName[$i]; ?></h3>
    <canvas id="<?php echo $algoritmalar[$k]."_".$i ?>"></canvas>
         </div>
        <?php 
      }
    }
   
    ?>
</div>

<script>
<?php 
for ($k=0; $k <count($algoritmalar) ; $k++) { 
  $grafik->table=$algoritmalar[$k];
  $grafik->coinID=$coin->coinID;
  $grafik->grafikAlgoritmaCek();
  for ($i=0; $i <count($grafik->sID) ; $i++) 
  {
    $g->table=$algoritmalar[$k]."_logs";
    $g->pID=$grafik->sID[$i];
    $g->coinAlgoritmagGrafik();
    $canvasid= $algoritmalar[$k]."_".$i;
     ?>
     
     var ctx = document.getElementById('<?php echo $canvasid; ?>').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $g->algoritmaTarih; ?>,
        datasets: [{
            label: 'RSI',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $g->algoritmaDegeri;; ?>
        }
        ]
    },
    options: {}
    });
    
    <?php

  }
}

?>

</script>

