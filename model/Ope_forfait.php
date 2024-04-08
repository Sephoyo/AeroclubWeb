<?php

class OpeForModel {
    public static function getAll() {
        global $db; // Référence à la variable $db définie dans model.php
        $stmt = $db->query('SELECT * FROM ope_forfait');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour obtenir un seul avion par son numéro
    public static function getOpeForBySeq($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM ope_forfait WHERE id_seq = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}