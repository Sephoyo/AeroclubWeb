<?php

class OpeComModel {
    public static function getAll() {
        global $db; // Référence à la variable $db définie dans model.php
        $stmt = $db->query('SELECT * FROM operation_compte');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour obtenir un seul avion par son numéro
    public static function getOpeByCo($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM operation_compte WHERE id_co = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}