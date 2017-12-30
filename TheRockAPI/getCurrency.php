      <?php
      
        function getCurrency($chatId,$message){
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
              $result = $row[1];
              pg_close($conn);          
            }
             return $result;
      }

?>