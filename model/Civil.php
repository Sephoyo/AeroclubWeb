<?php

class CivilModel {
    //Fonction pour retrouver la civilité d'un membre
    public static function Civil($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM civilite where num_civilite=:id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['court'];
    }

}
