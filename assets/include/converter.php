<?php
//debug_backtrace() || die ("Direct access not permitted");
session_start();
include_once('config.php');
if(isset($_SESSION['user_id'])){

  require('ChangerAPI.php');
  require('../../vendor/autoload.php');

  $dotenv = new Dotenv\Dotenv("../../");
  $dotenv->load();
  $Changer_API = new ChangerAPI();
  //currencies
  $currency['perfect_money'] = "pm_USD";
  $currency['bitcoin'] = "BTC";
  $currency['dollars'] = "USD";
  $currency['naira'] = "NGN";
  $currency['cedis'] = "GHS";

  //functions
  function getRate($from, $to){
    $currency['perfect_money'] = "pm_USD";
    $currency['bitcoin'] = "BTC";
    $currency['dollars'] = "USD";
    $currency['naira'] = "NGN";
    $currency['cedis'] = "GHS";
    $rate = false;
    if($from === $to){
      $rate = 1;
    }else if($from === $currency['perfect_money']){
      $rate = getRateChangerApi($from, "bitcoin_BTC") * roundAbout($currency['bitcoin'], $to);
    }else if($to === $currency['perfect_money']){
      $rate = getRateChangerApi("bitcoin_BTC", $to) * roundAbout($from, $currency['bitcoin']);
    }else{
      $rate = roundAbout($from, $to);
    }
    return $rate;
  }

  function getRateChangerApi($from, $to){
    try {
        $rate = $Changer_API->getRate($from, $to);
        return $rate;
    } catch (Exception $e) {
        echo 'ERROR: '. $e->getMessage();
        return false;
    }
  }

  function getRateCurrencyLayer($to){
    try{
      // set API Endpoint, access key, required parameters
      $endpoint = 'live';
      $access_key = $_ENV['CURRENCY_LAYER_API_KEY'];


      $amount = 10;

      // initialize CURL:
      $query = "http://apilayer.net/api/".$endpoint."?access_key=".$access_key."&source=USD&currencies=".$to."&format=1";
      $ch = curl_init($query);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


      // get the (still encoded) JSON data:
      $json = curl_exec($ch);
      curl_close($ch);

      // Decode JSON response:
      $conversionResult = json_decode($json, true);
       //die(json_decode($json, true));

      // access the conversion result
      return $conversionResult['quotes']["USD".$to];

    }catch(Exception $ex){
      return false;
    }
  }

  function roundAbout($from, $to){
    return getRateCurrencyLayer($to)/getRateCurrencyLayer($from);
  }

  function convert($from, $to, $amount){
    return getRate($from, $to) * $amount;
  }

  if(isset($_POST['from']) && isset($_POST['to'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $json['rate'] = getRate($from, $to);
    echo json_encode($json);
  }

}




  ?>
