<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device_width, intial-scale=1">
        <title>Idologis</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href="../index.php"><img src="../img/logo.png" alt="" class="logo"></a>
                <ul>
                    <li><a href="">Accueil</a></li>
                    <li><a href="../ventes.php">Ventes</a></li>
                    <li><a href="../locations.php">Locations</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
            <div class="content">
                <p class="adtxt">Supprimer un bien (ventes et locations) 
                    <button onclick="window.location = 'supprimer.php'" class="btn">DELETE<div class="background"></div></button>
                </p>
                <p class="adtxt">Ajouter un bien (ventes et locations) 
                    <button onclick="window.location = 'form_php.php'" class="btn">AJOUT<div class="background"></div></button>
                </p>
                <div class="cadre_scroll">
            </div>
        </div>
        <div class="footer">
            <p><?php
                $var = fopen("../copyright.txt", "r");
                while ($ligne = fgets($var))
                    echo "$ligne<br>";
                fclose($var);
                ?>
            </p>
        </div>
    </body>
</html>