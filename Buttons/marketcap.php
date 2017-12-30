      <?php

      
      function marketcap($chatId,$message){
        $messaggio = "CURRENCY | MARKETCAP | 24h | 7d";

        //BTC

        $url = "https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=EUR";
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


        $marketcapBTC = number_format($result[0]["market_cap_usd"]);
        $percent24h = number_format($result[0]["percent_change_24h"]);
        $percentWeek = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nBTC    | <em>".$marketcapBTC."</em> | <strong>".$percent24h."%</strong>"." | <strong>".$percentWeek."%</strong>");
        //inviaMessaggio($chatId,$messaggio);

        //ETH

        $url = "https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=EUR";
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


        $marketcapETH = number_format($result[0]["market_cap_usd"]);
        $percent24heth = number_format($result[0]["percent_change_24h"]);
        $percentWeeketh = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nETH    | <em>".$marketcapETH."</em> | <strong>".$percent24heth."%</strong>"." | <strong>".$percentWeeketh."%</strong>");
        //LTC

        $url = "https://api.coinmarketcap.com/v1/ticker/litecoin/?convert=EUR";
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


        $marketcapLTC = number_format($result[0]["market_cap_usd"]);
        $percent24hltc = number_format($result[0]["percent_change_24h"]);
        $percentWeekltc = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nLTC    | <em>".$marketcapLTC."</em> | <strong>".$percent24hltc."%</strong>"." | <strong>".$percentWeekltc."%</strong>");

        //DOGE

        $url = "https://api.coinmarketcap.com/v1/ticker/dogecoin/?convert=EUR";
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


        $marketcapDOGE = number_format($result[0]["market_cap_usd"]);
        $percent24hdoge = number_format($result[0]["percent_change_24h"]);
        $percentWeekdoge = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nDOGE    | <em>".$marketcapDOGE."</em> | <strong>".$percent24hdoge."%</strong>"." | <strong>".$percentWeekdoge."%</strong>");

        //CARDANO

        $url = "https://api.coinmarketcap.com/v1/ticker/cardano/?convert=EUR";
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


        $marketcapADA = number_format($result[0]["market_cap_usd"]);
        $percent24hada = number_format($result[0]["percent_change_24h"]);
        $percentWeekada = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nADA    | <em>".$marketcapADA."</em> | <strong>".$percent24hada."%</strong>"." | <strong>".$percentWeekada."%</strong>");
        //RIPPLE

        $url = "https://api.coinmarketcap.com/v1/ticker/ripple/?convert=EUR";
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


        $marketcapXRP = number_format($result[0]["market_cap_usd"]);
        $percent24hxrp = number_format($result[0]["percent_change_24h"]);
        $percentWeekxrp = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nXRP    | <em>".$marketcapXRP."</em> | <strong>".$percent24hxrp."%</strong>"." | <strong>".$percentWeekxrp."%</strong>");

        //MONERO


        $url = "https://api.coinmarketcap.com/v1/ticker/monero/?convert=EUR";
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


        $marketcapXMR = number_format($result[0]["market_cap_usd"]);
        $percent24hxmr = number_format($result[0]["percent_change_24h"]);
        $percentWeekxmr = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nXMR    | <em>".$marketcapXMR."</em> | <strong>".$percent24hxmr."%</strong>"." | <strong>".$percentWeekxmr."%</strong>");
        //ZCASH

        $url = "https://api.coinmarketcap.com/v1/ticker/zcash/?convert=EUR";
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


        $marketcapZEC = number_format($result[0]["market_cap_usd"]);
        $percent24hzec = number_format($result[0]["percent_change_24h"]);
        $percentWeekzec = number_format($result[0]["percent_change_7d"]);
        $messaggio .= urlencode("\nZEC    | <em>".$marketcapZEC."</em> | <strong>".$percent24hzec."%</strong>"." | <strong>".$percentWeekzec."%</strong>");

        inviaMessaggio($chatId,$messaggio);
      }

?>