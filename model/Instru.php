<?php

class InstruModel {
    // Fonction pour obtenir tous les membres
    public static function getAll() {
        global $db;
        $stmt = $db->query('SELECT * FROM instructeurs');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour compter le nombre total de membres dans la table
    public static function countAll() {
        global $db;
        $stmt = $db->query('SELECT COUNT(*) AS total FROM instructeurs');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public static function getIn($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM instructeurs where id=:id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
}


