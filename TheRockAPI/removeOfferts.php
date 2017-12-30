      <?php

  function cancellAllOrders($chatId){

      $validate = validate($chatId);
      if($validate === true){
        //SONO IMPOOSTATE LE MIE VERE CHIAVI
        $apiKey = getApyKey($chatId);
        $apiSecret = getApiSecret($chatId);

        $fund_id = "ETHEUR";

        $url = "https://api.therocktrading.com/v1/funds/".$fund_id."/orders/remove_all";

        $nonce = microtime(true)*10000;
        $signature = hash_hmac("sha512",$nonce.$url,$apiSecret);

        $headers = array(
          "Content-Type: application/json",
          "X-TRT-KEY: ".$apiKey,
          "X-TRT-SIGN: ".$signature,
          "X-TRT-NONCE: ".$nonce
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $callResult = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);

        $message = "status: ".$httpCode."    Offerte rimosse.";
        inviaMessaggio($chatId,$message);
      }else{
        $message = "Errore. Non sei autorizzato.";
        inviaMessaggio($chatId, $message);
      }
    }
?>