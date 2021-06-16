<div id="grafikler" class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <h1 class="app-page-title">Grafikler</h1>
      <div class="row g-4 mb-4">
        <div class="col-12 col-lg-12">
          <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <h4 class="app-card-title">Kripto Para Grafiği</h4>
                </div>
              </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
              <form id="kripto-para-form" name="kripto-para-form">
                <div class="mb-3 d-flex">
                  <select id="kripto-select" class="m-1 form-select form-select-sm ml-auto d-inline-flex w-auto" name="sembol">
                    <option value="BTCUSDT" selected>
                      BTC/USDT
                    </option>
                    <option value="ETHUSDT">
                      ETH/USDT
                    </option>
                    <option value="XRPUSDT">
                      XRP/USDT
                    </option>
                    <option value="LTCUSDT">
                      LTC/USDT
                    </option>
                    <option value="DOGEUSDT">
                      DOGE/USDT
                    </option>
                  </select> <select class="m-1 form-select form-select-sm ml-auto d-inline-flex w-auto" name="candle">
                    <option value="1m" selected>
                      1m
                    </option>
                    <option value="15">
                      5m
                    </option>
                    <option value="30">
                      30m
                    </option>
                    <option value="4s">
                      4s
                    </option>
                  </select> <button id="grafikButon" type="button" class="m-1 btn app-btn-primary btn-sm">Uygula</button>
                </div>
                <div class="chart-container">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <canvas id="canvas-linechart" style="display: block; width: 588px; height: 392px;" width="588" height="392" class="chartjs-render-monitor"></canvas>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="app-footer">
    <div class="container text-center py-3">
      <small class="copyright">Designed with by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
    </div>
  </footer>
</div>