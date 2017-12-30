      <?php

      function getUserForChatId($chatId){

        $result = "";
        $connStr = "host=''  port=  dbname='' user='' password=''";
        $conn = pg_connect($connStr);
        if(!$conn){
          $messaggio = urlencode("Connessione assente.\nRiprovare più tardi");
          inviaMessaggio($chatId,$messaggio);
        }else{
          $catid = intval($chatId);
          $result = pg_query_params($conn, "SELECT * FROM public.user c  WHERE chatid = $1",array($chatId));
          $row = pg_fetch_row($result);

          if(pg_num_rows($result) == 0)
           $result = pg_query_params($conn, "INSERT INTO public.user VALUES($1,'BTCEUR',null,null)",array($chatId));
       }
     }

           ?>