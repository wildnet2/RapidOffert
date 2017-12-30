      <?php

      include 'TheRockAPI/ask&bid.php';
      include 'TheRockAPI/buy&sell.php';
      include 'Buttons/functions.php';
      include 'TheRockAPI/balance.php';
      include 'TheRockAPI/removeOfferts.php';
      include 'Buttons/marketcap.php';
      include 'Buttons/selectCurrency.php';
      include 'TheRockAPI/getCurrency.php';
      include 'Utilities/checkUser.php';

      $currency = "ETHEUR";
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);

      $botoken="472056215:AAEDb17dV-qIOEXm6S0uHJYW4UGcmvlj9OE";
      $website="https://api.telegram.org/bot".$botoken;
      define('api', 'https://api.telegram.org/bot'.$botoken.'/');

      $data = file_get_contents('php://input');
      $update = json_decode($data,TRUE);

      if(isset($update["message"])){
        $chatId = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        $telegramUsername = $update['message']['from']['username'];
        $messageId = $update['message']['message_id'];
        $message_name = $update['message']['chat']['first_name'];
      }
      if(isset($update["callback_query"])){
        $cbid = $update["callback_query"]["from"]["id"];
        $cbdata = $update["callback_query"]["data"];
      }
      getUserForChatId($chatId);

      switch($message){  

        //CASE COMMANDS:  Apro laa tastiera di base

        case ($message == "/commands"):

        $keyboard = [
        ["Ask", "Bid","Select Currency"],
        ["Buy","Sell","Market Cap"],
        ["Get Balance", "Remove Offerts","TODO"],
        ];
        $key = array(
          "resize_keyboard" => true,
          "keyboard" => $keyboard,
          );
        keyboard($key, "Benvenuto nel bot per il trading ed il monitoring rapido!", $chatId);  
        break;

        //CASE BUTTON: definisco il comportamento per ogni bottone della tastiera di base

        case ($message == "Ask"):
        $currencyForUser = getCurrency($chatId,$message);
        $cast = (string)$currencyForUser;
        ask($chatId,$message,$cast);
        break;

        case ($message == "Bid"):
        $currencyForUser = getCurrency($chatId,$message);
        $cast = (string)$currencyForUser;
        bid($chatId,$message,$cast);
        break;

        case ($message == "Get Balance"):
        getBalance($chatId);
        break;

        case ($message == "Remove Offerts"):
        cancellAllOrders($chatId);
        break;

        case ($message == "Buy"):
        $but = array(
                array(
                  array("text" => "0.1", "callback_data" =>"0.1"),
                  array("text" => "0.5", "callback_data" =>"0.5"),
                  array("text" => "1", "callback_data" =>"1"),
                  ),
                array(
                  array("text" => "2", "callback_data" =>"2"),
                  array("text" => "5", "callback_data" =>"5"),
                  array("text" => "ALL IN", "callback_data" =>"ALL IN"),
                  ),
                );
        inlineKeyboard($but, $chatId, "Seleziona la quantità che si desidera acquistare");
        // ask($chatId,$message,$currency);
        break;

        case ($message == "Sell"):
        bid($chatId,$message,$currency);
        break;

        case ($message == "Select Currency"):
        $but = array(
                  array(
                      array("text" => "ETHEUR", "callback_data" =>"etheur"),
                      array("text" => "BTCEUR", "callback_data" =>"btceur"),      
                      ),
                  array(
                      array("text" => "LTCEUR", "callback_data" =>"ltceur"),
                      array("text" => "ZECEUR", "callback_data" =>"zeceur"),
                    ),
                  );
        inlineKeyboard($but,$chatId,"Seleziona il mercato su cui vuoi agire");
        break;

        case($message == "Market Cap"):
        marketcap($chatId,$message);
        break;

        case($message == "TODO"):
        $messaggio = urlencode("Invia un messaggio così composto:\napik: <em>YourApiKey</em>\napis: <em>YourApiSecret</em>");
        inviaMessaggio($chatId,$messaggio);
        break;

        default:
        $messaggio = "Inserisci un comando valido.";
        inviaMessaggio($chatId,$messaggio);
        break;
      }

      //SECND BUTTON CALLBACK.
      /*
        DA RIVEDERE LO STACK, NON è STATO DEBUGGATO ED è PROBABILE CHE QUA SUCCEDA UN PUTTANAIO
      */

      if(callback($update)){

        //SELECTION CURRENCY

        if($cbdata == "etheur"){
          $message = "";
          setETHEURcurrency($cbid,$message);
          send($cbid, "E' stato selezionato il mercato ETHEUR");
        }else if($cbdata == "btceur"){
          $message = "";
          setBTCEURcurrency($cbid,$message);
          send($cbid, "E' stato selezionato il mercato BTCEUR");
        }else if($cbdata == "ltceur"){
          $message = "";
          setLTCEURcurrency($cbid,$message);
          send($cbid, "E' stato selezionato il mercato LTCEUR");
        }else if($cbdata == "zeceur"){
          $message = "";
          setZECEURcurrency($cbid,$message);
          send($cbid, "E' stato selezionato il mercato ZECEUR");
        }

        //SELECTION QUANTITY

        else if($cbdata == '0.1'){
        $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"conferma0.10"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
        inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");
        }else if($cbdata == "0.5"){
          $message = "";
          $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"conferma0.50"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
          inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");
        } else if($cbdata == '1'){
        $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"conferma1.0"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
        inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");
      } else if($cbdata == '2'){
        $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"conferma2.0"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
        inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");
      } else if($cbdata == '5'){
        $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"conferma5.0"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
        inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");
      } else if($cbdata == 'ALL IN'){
        $but = array(array(array("text" => "Conferma operazione", "callback_data" =>"confermaALLIN"),array("text" => "Annulla", "callback_data" =>"annulla"),),);
        inlineKeyboard($but, $cbid, "Sei sicuro di volere eseguire questa transazione?");

        //CONFIRM QUANTITY

        }else if($cbdata == "conferma0.10"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata 0.10");
        }else if($cbdata == "conferma0.50"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata 0.50");
        }else if($cbdata == "conferma1.0"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata 1.0");
        }else if($cbdata == "conferma2.0"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata 2.0");
        }else if($cbdata == "conferma5.0"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata 5.0");
        }else if($cbdata == "confermaALLIN"){
          //COMPRA CON 0.10 COME AMOUNT
          $message = "";
          send($cbid, "L'operazione è stata confermata ALL IN");
        }else if($cbdata == "annulla"){
          $message = "";
          send($cbid, "Operazione annullata");
        }
      }

///////////////////////////////////////////////////////////////////////

      function inviaMessaggio($chatId,$message){
        $urltel = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message&parse_mode=html";
        file_get_contents($urltel);
      }

           ?>