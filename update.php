<?php

require_once'model.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    if (isset($_POST['nouveau-nom'], $_POST['nouveau-prenom'], $_POST['nouveau-email'], $_POST['nouveau-ad'], $_POST['nouveau-cp'], $_POST['nouveau-ville'], $_POST['nouveau-tel'])) {
        $nouveauNom = $_POST['nouveau-nom'];
        $nouveauPrenom = $_POST['nouveau-prenom'];
        $nouveauEmail = $_POST['nouveau-email'];
        $nouveauMdp = $_POST['nouveau-mdp'];
        $nouveauAd = $_POST['nouveau-ad'];
        $nouveauCp = $_POST['nouveau-cp'];
        $nouveauVille = $_POST['nouveau-ville'];
        $nouveauTel = $_POST['nouveau-tel'];
        MembreModel::UpMem($nouveauNom, $nouveauPrenom, $nouveauEmail, $nouveauMdp, $nouveauAd, $nouveauCp, $nouveauVille, $nouveauTel);
        $_SESSION['nom'] = $nouveauNom;
        $_SESSION['prenom'] = $nouveauPrenom;
        $_SESSION['adresse'] = $nouveauAd;
        $_SESSION['code_postal'] = $nouveauCp;
        $_SESSION['tel'] = $nouveauTel;
        $_SESSION['email'] = $nouveauEmail;
        $_SESSION['ville'] = $nouveauVille;
        $_SESSION['mdp'] = $nouveauMdp;
        header("Location: index.php?url=compte");
        exit();
    } else {
        header("Location: index.php?url=compte");
        exit();
    }
}