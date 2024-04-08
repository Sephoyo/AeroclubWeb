<?php
session_start();
$host = '192.168.0.20';
$dbname = 'postgres';
$user = 'admin';
$password = 'admin';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo 'Échec de la connexion, contactez un administrateur !';
    die();
}

require_once 'model/Avion.php';
require_once 'model/Membre.php';
require_once 'model/Instru.php';
require_once 'model/Civil.php';
require_once 'model/SeqVol.php';
require_once 'model/Comptes.php';
require_once 'model/Ope_compte.php';
require_once 'model/Ope_forfait.php';