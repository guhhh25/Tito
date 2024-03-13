<?php

$host = 'localhost'; 
$dbname = 'Tito'; 
$username = 'root'; 
$password = 'gustavohr123'; 

try {

    $dsn = "mysql:host=$host;dbname=$dbname";

    $dbh = new PDO($dsn, $username, $password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    
    echo 'Erro de conexão: ' . $e->getMessage();
    die();
}
?>