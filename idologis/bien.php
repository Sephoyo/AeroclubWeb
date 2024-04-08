<?php
require __DIR__ . '/bdd/connect.php';
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device_width, initial-scale=1">
        <title>Idologis</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href="../index.php"><img src="img/logo.png" alt="" class="logo"></a>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ventes.php">Ventes</a></li>
                    <li><a href="locations.php">Locations</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="/idologis/admin/index.php">Admin</a><li>
                </ul>
            </div>
                <?php
                if (isset($_GET['reference']) && isset($_GET['type'])) {
                    //Récupération des données dans l'URL
                    $reference = $_GET['reference'];
                    $type = $_GET['type'];

                    // Requête SQL pour récupérer les détails du bien en fonction de la référence
                    $sql = "SELECT * FROM ";
                    if ($type == "v") {
                        $sql .= "Ventes";
                    } elseif ($type == "l") {
                        $sql .= "Locations";
                    }
                    $sql .= " WHERE Reference = ?";

                    // Préparation de la requête
                    $stmt = $db->prepare($sql);

                    // Exécution de la requête avec la référence
                    $stmt->execute([$reference]);

                    // Récupération des résultats
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Vérification si la référence correspond à un bien existant
                    if ($row) {
                        // Affichage des détails du bien en fonction du type
                        echo '<div class="content">';
                        echo '<h1>Référence: ' . $row['Reference'] . '</h1>';
                        echo '<img src="img/' . $row['Img'] . '" class="imgadb"></img>';
                        echo '<h2>Type: ' . $row['Type'] . '</h2>';
                        echo '<h3>Secteur: ' . $row['Secteur'] . '</h3>';
                        echo '<p>Surface: ' . $row['Surface'] . '</p>';
                        if ($type == "v") {
                            echo '<p class="or">Prix : ' . $row['Prix'] . '</p>';
                        } elseif ($type == "l") {
                            echo '<p class="or">Loyer: ' . $row['Loyer'] . '</p>';
                        }
                        echo '<p>Mail: ' . $row['Mail_vendeur'] . '</p>';
                        echo '</div>';
                    } else {
                        echo "<p>Aucun bien trouvé pour la référence $reference.</p>";
                    }
                } else {
                    echo "<p>La référence ou le type n'est pas fourni dans l'URL.</p>";
                }
                ?>

        <div class="footer">
            <p><?php
                $var = fopen("copyright.txt", "r");
                while ($ligne = fgets($var))
                    echo "$ligne<br>";
                fclose($var);
                ?>
            </p>
        </div>
    </body>
</html>'
