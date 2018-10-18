<?php
//debug_backtrace() || die ("Direct access not permitted");
session_start();
include_once('config.php');
include_once('validation.php');
if(isset($_SESSION['user_id'])){
// TODO: improve validation
  if(isset($_POST['reference']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['usd']) && isset($_POST['email']) && isset($_POST['amount']) && isset($_POST['equivalent']) && isset($_POST['reference'])){
    $reference = test_input(filter_input(INPUT_POST, 'reference'));
    $from = test_input(filter_input(INPUT_POST, 'from'));
    $to = test_input(filter_input(INPUT_POST, 'to'));
    $usd = test_input(filter_input(INPUT_POST, 'usd'));
    $email = test_input(filter_input(INPUT_POST, 'email'));
    $amount = test_input(filter_input(INPUT_POST, 'amount'));
    $equivalent = test_input(filter_input(INPUT_POST, 'equivalent'));
    $stmt = $db->prepare("INSERT INTO history (user_id, transfer_from, transfer_to, equivalence, amount, email, usd_account_number, reference) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $from, $to, $equivalent, $amount, $email, $usd, $reference]);
  }

}




  ?>
