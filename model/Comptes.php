<?php

class ComptesModel {
    // Fonction pour obtenir tous les membres
    public static function getCom($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM comptes where id=:id');
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fonction pour authentifier un membre par email et mot de passe
    public static function authenticate($email, $password) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM membres WHERE email = :email AND mdp = :password');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        // Retourne le membre s'il est trouvé, sinon retourne false
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Fonction pour compter le nombre total de membres dans la table
    public static function countAll() {
        global $db;
        $stmt = $db->query('SELECT COUNT(*) AS total FROM membres');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}

