<?php

class AvionModel {

    // Fonction pour obtenir tous les avions
    public static function getAll() {
        global $db;
        $stmt = $db->query('SELECT * FROM AVION');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour obtenir un seul avion par son numéro
    public static function getAvionById($numAvion) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM AVION WHERE NUM_AVION = :numAvion');
        $stmt->bindParam(':numAvion', $numAvion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fonction pour compter le nombre total de d'avions dans la table
    public static function countAll() {
        global $db;
        $stmt = $db->query('SELECT COUNT(*) AS total FROM avion');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
