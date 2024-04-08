<?php
require '../bdd/connect.php';

// Variable pour stocker l'état de la suppression
$delete_message = '';

// Si une référence de vente doit être supprimée
if (isset($_POST['delete_vente'])) {
    $reference_vente = $_POST['reference_vente'];
    $stmt_delete_vente = $db->prepare("DELETE FROM Ventes WHERE Reference = ?");
    if ($stmt_delete_vente->execute([$reference_vente])) {
        $delete_message = 'Suppression réussie.';
    } else {
        $delete_message = 'Erreur lors de la suppression.';
    }
}

// Si une référence de location doit être supprimée
if (isset($_POST['delete_location'])) {
    $reference_location = $_POST['reference_location'];
    $stmt_delete_location = $db->prepare("DELETE FROM Locations WHERE Reference = ?");
    if ($stmt_delete_location->execute([$reference_location])) {
        $delete_message = 'Suppression réussie.';
    } else {
        $delete_message = 'Erreur lors de la suppression.';
    }
}

// Récupérer les références des locations
$stmt_locations = $db->query("SELECT Reference FROM Locations");
$references_locations = $stmt_locations->fetchAll(PDO::FETCH_COLUMN);

// Récupérer les références des ventes
$stmt_ventes = $db->query("SELECT Reference FROM Ventes");
$references_ventes = $stmt_ventes->fetchAll(PDO::FETCH_COLUMN);
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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../ventes.php">Ventes</a></li>
                    <li><a href="../locations.php">Locations</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
            <div class="content">
                <!-- Affichage du message de suppression -->
                <?php if (!empty($delete_message)): ?>
                    <p><?php echo $delete_message; ?></p>
                <?php endif; ?>

                <h3>Locations</h3>
                <?php if (!empty($references_locations)): ?>
                    <ul>
                        <?php foreach ($references_locations as $reference_location): ?>
                            <li><?php echo $reference_location; ?>
                                <form method="post">
                                    <input type="hidden" name="reference_location" value="<?php echo $reference_location; ?>">
                                    <button type="submit" name="delete_location">Supprimer</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucune location disponible.</p>
                <?php endif; ?>

                <h3>Ventes</h3>
                <?php if (!empty($references_ventes)): ?>
                    <ul>
                        <?php foreach ($references_ventes as $reference_vente): ?>
                            <li><?php echo $reference_vente; ?>
                                <form method="post">
                                    <input type="hidden" name="reference_vente" value="<?php echo $reference_vente; ?>" class="delete-button">
                                    <button type="submit" name="delete_vente" class="delete-button" >Supprimer</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucune vente disponible.</p>
                <?php endif; ?>
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
