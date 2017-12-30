      <?php

      function buy($price,$amount,$apiKey,$apiSecret,$chatId){

      /*
        $fund_id = "ETHEUR";
        $uri = "https://api.therocktrading.com/v1/funds/${fund_id}/orders";
        $side = "buy";
        
        $params = array (
            "fund_id" => $fund_id,
            "side" => $side,
            "amount" => $amount,
            "price" => $price 
            );
        $nonce = microtime ( true ) * 10000;
        $signature = hash_hmac ( "sha512", $nonce . $uri, $apiSecret );
        $http = new http ();
        $headers = array (
            "X-TRT-KEY" => $apiKey,
            "X-TRT-SIGN" => $signature,
            "X-TRT-NONCE" => $nonce 
            );
        
        $options = [ 
        'http_errors' => false,
        'headers' => $headers,
        'json' => $params 
        ];
        
        return $http->post ( $uri, $options );
        */
        $messaggio = urlencode("hai comprato ".$amount."ETH a ".$price." EUR.");
        inviaMessaggio($chatId,$messaggio);
      }

///////////////////////////////////////////////////////////////////////

      function sell($price,$amount,$apiKey,$apiSecret,$chatId){
/*
        $fund_id = "ETHEUR";
        $uri = "https://api.therocktrading.com/v1/funds/${fund_id}/orders";
        $side = "sell";
        
        $params = array (
            "fund_id" => $fund_id,
            "side" => $side,
            "amount" => $amount,
            "price" => $price 
            );
        $nonce = microtime ( true ) * 10000;
        $signature = hash_hmac ( "sha512", $nonce . $uri, $apiSecret );
        $http = new http ();
        $headers = array (
            "X-TRT-KEY" => $apiKey,
            "X-TRT-SIGN" => $signature,
            "X-TRT-NONCE" => $nonce 
            );
        
        $options = [ 
        'http_errors' => false,
        'headers' => $headers,
        'json' => $params 
        ];
        
        return $http->post ( $uri, $options );
        */
        $messaggio = urlencode("hai venduto ".$amount."ETH a ".$price." EUR.");
        inviaMessaggio($chatId,$messaggio);

      }

      function buyOffert($chatId,$message){

        $offert = ask($chatId,$message);
        $price = $offert['price'];
        $amount = $offert['amount'];
        $apiKey = "scemo";
        $apiSecret = " chi legge";
        buy($price,$amount,$apiKey,$apiSecret,$chatId);
      }

///////////////////////////////////////////////////////////////////////

      function sellOffert($chatId,$message){

        $offert = bid($chatId,$message);
        $price = $offert['price'];
        $amount = $offert['amount'];
        $apiKey = "scemo";
        $apiSecret = " chi legge";
        sell($price,$amount,$apiKey,$apiSecret,$chatId);
      }
  ?>