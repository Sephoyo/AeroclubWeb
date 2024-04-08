<?php

$host = 'localhost';
$dbname = 'idologis';
$user = 'admin';
$password = 'admin';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
    die();
}
