<?php
require_once __DIR__.'/../config/db-config.php';

$pdo = new PDO("$db_ms:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $content = 'connection established';
?>