<?php

class SeqVolModel {
    public static function getAll() {
        global $db; // Référence à la variable $db définie dans model.php
        $stmt = $db->query('SELECT * FROM seq_vol');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour obtenir un seul avion par son numéro
    public static function getSeqByMem($numMem) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM seq_vol WHERE id_mem = :numMem');
        $stmt->bindParam(':numMem', $numMem, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Fonction pour obtenir un seul avion par son numéro
    public static function getSeqByIn($numIn) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM seq_vol WHERE id_in = :numIn');
        $stmt->bindParam(':numIn', $numIn, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Fonction pour obtenir un seul avion par son numéro
    public static function getSeqByAv($numAvion) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM seq_vol WHERE id_av = :numAvion');
        $stmt->bindParam(':numAvion', $numAvion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}