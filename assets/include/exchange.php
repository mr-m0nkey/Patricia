<?php
//debug_backtrace() || die ("Direct access not permitted");
session_start();
include_once('config.php');
if(isset($_SESSION['user_id'])){
// TODO: improve validation
  if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['usd']) && isset($_POST['email']) && isset($_POST['amount']) && isset($_POST['equivalent'])){
    $stmt = $db->prepare("INSERT INTO history (user_id, transfer_from, transfer_to, equivalence, amount, email, usd_account_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['from'], $_POST['to'], $_POST['equivalent'], $_POST['amount'], $_POST['email'], $_POST['usd']]);
  }

}




  ?>
