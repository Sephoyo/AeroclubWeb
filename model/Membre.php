<?php


class MembreModel {

    // Fonction pour obtenir tous les membres
    public static function getAll() {
        global $db;
        $stmt = $db->query('SELECT * FROM membres');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public static function UpMem($nouveauNom,$nouveauPrenom,$nouveauEmail,$nouveauMdp,$nouvelleAdresse,$nouveauCodePostal,$nouvelleVille,$nouveauTel) {
        global $db;
        echo $_SESSION['id'];
        $hashedPassword = md5($nouveauMdp);
        $stmt = $db->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, adresse = :adresse, code_postal = :code_postal,tel = :tel, ville = :ville WHERE id = :id');
        $stmt->bindParam(':nom', $nouveauNom);
        $stmt->bindParam(':prenom', $nouveauPrenom);
        $stmt->bindParam(':email', $nouveauEmail);
        $stmt->bindParam(':mdp', $hashedPassword);
        $stmt->bindParam(':adresse', $nouvelleAdresse);
        $stmt->bindParam(':code_postal', $nouveauCodePostal);
        $stmt->bindParam(':ville', $nouvelleVille);
        $stmt->bindParam(':tel', $nouveauTel);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        echo $stmt->queryString;
    }
}
