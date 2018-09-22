<?php
$host = $_SERVER['HTTP_HOST'];

if($host == "localhost" || strpos($host, "192.168.") !== FALSE || strpos($host, "127.0.0.") !== FALSE){
    $app_root = "http://{$host}/Patricia/";

    $db = new PDO('mysql:host=localhost;dbname=patricia_dev;charset=utf8mb4', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,
                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

else{
    $protocol = $_SERVER['HTTPS'] ? "https://" : "http://";

    $app_root = $protocol . $host . "/";

    $db = new PDO('mysql:host=localhost;dbname=patricia_prod;charset=utf8mb4', 'paaatriiiciiiaaa', 'XLytudk-[q8T', array(PDO::ATTR_EMULATE_PREPARES => false,
                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
