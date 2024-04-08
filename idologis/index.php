<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device_width, intial-scale=1">
        <title>Idologis</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href="index.php"><img src="img/logo.png" alt="" class="logo"></a>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ventes.php">Ventes</a></li>
                    <li><a href="locations.php">Locations</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="/idologis/admin/index.php">Admin</a><li>
                </ul>
            </div>
            <div class="content">
                <h1>Idologis</h1>
                <p>Toutes vos envies de logis se trouvent ici ! </p>
            </div>
        </div>
        <div class="footer">
        <p><?php $var=fopen("copyright.txt","r");
            while($ligne= fgets($var))echo "$ligne<br>";
            fclose($var); ?>
        </p>
        </div>
    </body>
</html>