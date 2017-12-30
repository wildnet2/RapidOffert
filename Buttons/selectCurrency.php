      <?php  

      //BTC
   
      function setBTCEURcurrency($chatId,$message){

        $connStr = "host=''  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $chatid = intval($chatId);
              pg_query_params($conn, "UPDATE public.user c SET currency = 'BTCEUR' WHERE chatid = $1",array($chatid));
              pg_close($conn);
            }
      }


      //ETH

      function setETHEURcurrency($chatId,$message){

        $connStr = "host=''  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $catid = intval($chatId);
              pg_query_params($conn, "UPDATE public.user c SET currency = 'ETHEUR' WHERE chatid = $1",array($chatId));
              pg_close($conn);
            }
      }


      //LTC

            function setLTCEURcurrency($chatId,$message){

        $connStr = "'  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $catid = intval($chatId);
              pg_query_params($conn, "UPDATE public.user c SET currency = 'LTCEUR' WHERE chatid = $1",array($chatId));
              pg_close($conn);
            }
      }


      //ZEC

            function setZECEURcurrency($chatId,$message){

        $connStr = "'  port=  dbname='' user='' password=''";
        //simple check
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
          }else{
              $catid = intval($chatId);
              pg_query_params($conn, "UPDATE public.user c SET currency = 'ZECEUR' WHERE chatid = $1",array($chatId));
              pg_close($conn);
            }
      }

?>