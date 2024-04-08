<?php

session_start();
include "../model.php";
echo $_POST['password'];
echo $_POST['email'];

if (isset($_POST['email']) || isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email)) {
        header("Location: ../index.php?url=login&error=Un email est requis");
        exit();
    } else if (empty($pass)) {
        header("Location: ../index.php?url=login&error=Un mot de passe est requis");
        exit();
    } else {
        $pass = md5($pass);
        $row = MembreModel::authenticate($email,$pass);

        if ($row) {
            if ($row['email'] === $email && $row['mdp'] === $pass) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['num_civilite'] = $row['num_civilite'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['adresse'] = $row['adresse'];
                $_SESSION['code_postal'] = $row['code_postal'];
                $_SESSION['tel'] = $row['tel'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['commentaire'] = $row['commentaire'];
                $_SESSION['num_badge'] = $row['num_badge'];
                $_SESSION['ville'] = $row['ville'];
                $_SESSION['date_vm'] = $row['date_vm'];
                $_SESSION['validite_vm'] = $row['validite_vm'];
                $_SESSION['date_sep'] = $row['date_sep'];
                $_SESSION['validite_sep'] = $row['validite_sep'];
                $_SESSION['carte_federale'] = $row['carte_federale'];
                $_SESSION['date_attestation'] = $row['date_attestation'];
                $_SESSION['mdp'] = $row['mdp'];
                $_SESSION['num_qualif'] = $row['num_qualif'];
                $_SESSION['profession'] = $row['profession'];
                $_SESSION['date_naissance'] = $row['date_naissance'];
                $_SESSION['lieu_naissance'] = $row['lieu_naissance'];
                $_SESSION['date_theorique_bb'] = $row['date_theorique_bb'];
                $_SESSION['date_theorique_ppla'] = $row['date_theorique_ppla'];
                $_SESSION['date_bb'] = $row['date_bb'];
                $_SESSION['date_ppla'] = $row['date_ppla'];
                $_SESSION['numero_bb'] = $row['numero_bb'];
                $_SESSION['numero_ppla'] = $row['numero_ppla'];

                header("Location: ../index.php?url=compte");
                exit();
            } else {
                header("Location: ../index.php?url=login&error=Email ou mot de passe incorrect");
                exit();
            }
        } else {
            header("Location: ../index.php?url=login&error=Email ou mot de passe incorrect");
            exit();
        }
    }
} else {
    header("Location: ../index.php?url=login");
    exit();
}
