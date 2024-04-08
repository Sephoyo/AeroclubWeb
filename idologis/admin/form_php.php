<?php
require '../bdd/connect.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device_width, initial-scale=1">
        <title>Idologis</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href="index.php"><img src="../img/logo.png" alt="" class="logo"></a>
                <ul>
                    <li><a href="">Accueil</a></li>
                    <li><a href="../ventes.php">Ventes</a></li>
                    <li><a href="../locations.php">Locations</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
            <div class="content">
                <form class="formasm" action="form_php.php" method="POST" enctype="multipart/form-data">
                    <label class="label">Ventes ou locations</label>
                    <select name="select" required>
                        <option value="" disabled selected hidden>--S'il vous plaît choisissez--</option>
                        <option value="locations" name="locations">Location</option>
                        <option value="ventes" name="ventes">Vente</option>
                    </select>
                    <label class="label">Référence</label>
                    <input class="input" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="ref" maxlength="3" required>
                    <label class="label">Type</label>
                    <input class="input" type="text" name="type" maxlength="30" required>
                    <label class="label">Secteur</label>
                    <input class="input" type="text" name="sec" maxlength="30" required>
                    <label class="label">Surfaces</label>
                    <input class="input" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="sur" maxlength="30" required>
                    <label class="label">Mail vendeur</label>
                    <input class="input" type="mail" name="mail" maxlength="30" required>
                    <label class="label">Loyer</label>
                    <input class="input" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="loyer" maxlength="30" required>
                    <label class="label">Fichier : </label>
                    <input class="input2" type="file" name="file" required>
                    <input type="submit" name="envoyer" value="Soumettre"><input type="reset" name="Annuler" value="Annuler">
                </form>
                <?php
                if (isset($_POST["envoyer"])) {
                    ///Variable pour ajouts de bien///
                    $ref = $_POST['ref'];
                    $ty = $_POST['type'];
                    $sec = $_POST['sec'];
                    $sur = $_POST['sur'];
                    $mail = $_POST['mail'];
                    $loyer = $_POST['loyer'];
                    $fileName = $_FILES["file"]["name"];
                    $fileTemp = $_FILES["file"]["tmp_name"];
                    
                    // Vérifier si la référence existe déjà
                    $stmt_check_ref = $db->prepare("SELECT COUNT(*) FROM Locations WHERE Reference = ?");
                    $stmt_check_ref->execute([$ref]);
                    $ref_exists = $stmt_check_ref->fetchColumn();
                    
                    if ($ref_exists) {
                        // Si la référence existe déjà, afficher un message d'erreur
                        echo 'La référence ' . $ref . ' existe déjà.';
                    } else {
                        // Si la référence n'existe pas, insérer les données dans la base de données
                        move_uploaded_file($fileTemp, "../img/" . $fileName);
                        if ($_POST['select'] == "locations") {
                            // Requête d'insertion pour une location
                            $sql = "INSERT INTO Locations (Reference, Type, Secteur, Surface, Loyer, Mail_vendeur, Img) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        } elseif ($_POST['select'] == "ventes") {
                            // Requête d'insertion pour une vente
                            $sql = "INSERT INTO Ventes (Reference, Type, Secteur, Surface, Prix, Mail_vendeur, Img) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        }
                        // Préparation de la requête
                        $stmt = $db->prepare($sql);
                        // Exécution de la requête avec les valeurs des variables
                        $stmt->execute([$ref, $ty, $sec, $sur, $loyer, $mail, $fileName]);
                        // Affichage d'un message de confirmation
                        echo 'Votre bien n°' . $ref . ' a bien été ajouté !';
                    }
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <p><?php
                $var = fopen("../copyright.txt", "r");
                while ($ligne = fgets($var)) {
                    echo "$ligne<br>";
                }
                fclose($var);
                ?>
            </p>
        </div>
    </body>
</html>