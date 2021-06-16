function run(symbol,candle_interval){
  var link = "wss://stream.binance.com:9443/ws/"+symbol+"@kline_"+candle_interval;
  const WebSocket = require('ws');
  const ws = new WebSocket(link);  
  ws.on('message', function incoming(data) {
    const veri = JSON.parse(data);
    if(veri.k.x==true){
      console.log("Kapanış:");
      console.log(veri.k.c);
      candle_stick(symbol,candle_interval,veri.k.t,veri.k.o,veri.k.h,veri.k.l,veri.k.c,veri.k.T);
      alarm(symbol,candle_interval);
    }
    else if(veri.k.x==false){
      console.log(veri.k.c);}
   
    
  });
}

function alarm(symbol,candle_interval){
  var link = "/kripto-alarm/dashboard/server/servis.php?islem=alarm&symbol="+symbol+"&candle_interval="+candle_interval;
  const https = require('http')
  const options = {
    hostname: 'localhost',
    port: 80,
    path: link,
    method: 'GET'
  }
  
  const req = https.request(options, res => {
    console.log(`statusCode: ${res.statusCode}`)
  
    res.on('data', d => {
      process.stdout.write(d)
    })
  })
  
  req.on('error', error => {
    console.error(error)
  })
  
  req.end()
}

function candle_stick(symbol,candle_interval,open_time,open,high,low,close,close_time){
  var link = "/kripto-alarm/dashboard/server/servis.php?islem=candle_stick&symbol="+symbol+"&candle_interval="+candle_interval+"&open_time="+open_time+"&open="+open+"&high="+high+"&low="+low+"&close="+close+"&close_time="+close_time;
  const https = require('http')
  const options = {
    hostname: 'localhost',
    port: 80,
    path: link,
    method: 'GET'
  }
  
  const req = https.request(options, res => {
    console.log(`statusCode: ${res.statusCode}`)
  
    res.on('data', d => {
      process.stdout.write(d)
    })
  })
  
  req.on('error', error => {
    console.error(error)
  })
  
  req.end()
}


  run("btcusdt","1m");
  // run("ethusdt","1m");
  // run("xrpusdt","1m");


