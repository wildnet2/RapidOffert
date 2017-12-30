      <?php

      function ask($chatId,$message,$cast){
      //richiesta per comprare
        $url = "https://api.therocktrading.com/v1/funds/".$cast."/orderbook";
        $ask = array();
        $bid = array();
        $headers = array(
          "Content-Type: application/json"
          );
                //chiamata al server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $callResult = curl_exec($ch);
        curl_close($ch);
                //decodifico risultato della chiamata in json
        $result = json_decode($callResult, true);

        if($message === "Ask"){
          $offertPrice = floatval($result['asks'][0]['price']);
          $offertAmount = floatval($result['asks'][0]['amount']);

          $currency = getCurrency($chatId,$message);
          $cast = (string)$currency;
          if($cast == 'BTCEUR')
            $param = 'BTC';
          else if($cast == 'ETHEUR')
            $param = 'ETH';
          else if($cast == 'LTCEUR')
            $param = 'LTC';
          else if($cast == 'ZECEUR')
            $param = 'ZEC';
          else 
            $param = 'ETH';

          $messaggio = urlencode("FOR ISTA BUY\n".$offertAmount." ".$param."  | ".$offertPrice." EUR");
          inviaMessaggio($chatId,$messaggio);
        }else if($message === "Buy"){
          $offert = $result['asks'][0];
           $offertPrice = floatval($result['asks'][0]['price']);
          $offertAmount = floatval($result['asks'][0]['amount']);

          $messaggio = "Hai comprato ".$offertAmount." ETH al prezzo di ".$offertPrice." EUR !";
          inviaMessaggio($chatId,$messaggio);
          //return $offert;
        }
      }

///////////////////////////////////////////////////////////////////////

      function bid($chatId,$message,$cast){
      //richiesta per vendere
        $url = "https://api.therocktrading.com/v1/funds/".$cast."/orderbook";
        $ask = array();
        $bid = array();
        $headers = array(
          "Content-Type: application/json"
          );
      //chiamata al server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $callResult = curl_exec($ch);
        curl_close($ch);
      //decodifico risultato della chiamata in json
        $result = json_decode($callResult, true);

        if($message === "Bid"){
          $offertPrice = floatval($result['bids'][0]['price']);
          $offertAmount = floatval($result['bids'][0]['amount']);

          $currency = getCurrency($chatId,$message);
          $cast = (string)$currency;
       if($cast == 'BTCEUR')
            $param = 'BTC';
          else if($cast == 'ETHEUR')
            $param = 'ETH';
          else if($cast == 'LTCEUR')
            $param = 'LTC';
          else if($cast == 'ZECEUR')
            $param = 'ZEC';
          else 
            $param = 'ETH';

          $messaggio = urlencode("FOR ISTA SELL\n".$offertAmount." ".$param."  | ".$offertPrice." EUR");
          inviaMessaggio($chatId,$messaggio);
        }else if($message === "Sell"){
          $offert = $result['bids'][0];
                    $offertPrice = floatval($result['bids'][0]['price']);
          $offertAmount = floatval($result['bids'][0]['amount']);

          $messaggio = "Hai venduto ".$offertAmount." ETH al prezzo di ".$offertPrice." EUR !";
          inviaMessaggio($chatId,$messaggio);
         // return $offert;
        }
      }


      ?>