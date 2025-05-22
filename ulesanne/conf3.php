<?php
$db_host = "localhost";
$db_user = "burdyga";
$db_pass = "23051982";
$db_name = "pizzeria_db";

$yhendus = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($yhendus->connect_error) {
    die("Ühenduse viga: " . $yhendus->connect_error);
}
$yhendus->set_charset("utf8mb4");
?>