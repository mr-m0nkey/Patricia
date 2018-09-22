<?php
session_start();
include_once('assets/include/config.php');
session_destroy();
header('location: '.$app_root);
?>
