      <?php

      function getBalance($chatId){
          $validate = validate($chatId);

          if($validate === true)
          {

            $balance = array();

            $apiKey = getApiKey($chatId);
            $apiSecret = getApiSecret($chatId);

            $url = "https://api.therocktrading.com/v1/balances";

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
            curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $callResult = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($callResult,true);

            $balance = $result['balances'];
            $messaggio = "";
            for($i = 0; $i < count($balance); $i++ ){
              if($balance[$i]['balance'] != 0){
                  $messaggio .= urlencode("<strong>".$balance[$i]['currency']."</strong> : <em>".$balance[$i]['balance']."</em>\n");
              }
          }
          inviaMessaggio($chatId,$messaggio);
      }else{
        $messaggio = "Operazione non riuscita. Mancano le tue credenziali per usare questa funzione."
      //  $messaggio =  "il tuo chatid è: ".$chatId;
        inviaMessaggio($chatId,$messaggio);
    }
}

////////////////////////////////////////////////////////////////////////////

      function validate($chatId){
        if($chatId === 37192021 || $chatId === 36323662){
          return true;
        }else{
          return false;
        }
      }

////////////////////////////////////////////////////////////////////////////


      function getApiKey($chatId){

        $result = "";
        $connStr = "host=''  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $catid = intval($chatId);
              $result = pg_query_params($conn, "SELECT * FROM public.user c  WHERE chatid = $1",array($chatId));
              $row = pg_fetch_row($result);
              $result = $row[2];
              pg_close($conn);          
            }
             return $result;
      }

////////////////////////////////////////////////////////////////////////////

      function getApiSecret($chatId){
        $result = "";
        $connStr = "host=''  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $catid = intval($chatId);
              $result = pg_query_params($conn, "SELECT * FROM public.user c  WHERE chatid = $1",array($chatId));
              $row = pg_fetch_row($result);
              $result = $row[3];
              pg_close($conn);          
            }
             return $result;
      }
?>