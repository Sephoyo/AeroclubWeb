<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php echo $additionalMetaTags; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/base_view.js"></script>
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <header>
        
        <div class="logo">Aeroclub</div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="nav-bar">
            <ul>
                <li>
                    <a href="index.php?url=accueil" class="<?php echo isset($activeAccueil) ? $activeAccueil : ''; ?>">Accueil</a>
                </li>
                <li>
                    <a href="index.php?url=avion" class="<?php echo isset($activeAvion) ? $activeAvion : ''; ?>">Avions</a>
                </li>
                <li>
                    <a href="index.php?url=contact" class="<?php echo isset($activeContact) ? $activeContact : ''; ?>">Contact</a>
                </li>
<!--                //Si il y a une connexion valider alors il peut consulter son compte -->
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {?>
                <li>
                    <a href="index.php?url=compte" class="<?php echo isset($activeCompte) ? $activeCompte : ""; ?>">Compte</a>
                </li>';
                <?php
                }
                if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {?>
                <li>
                    <a href="log_sign/logout.php" class="<?php echo isset($activeLogin) ? $activeLogin : ""; ?>">Déconnexion</a>
                </li>';
                <?php }else{?>
                <li>
                    <a href="index.php?url=login" class="<?php echo isset($activeLogin) ? $activeLogin : ""; ?>">Connexion</a>
                </li><?php }?>
            </ul>
        </div>
    </header>
    <video src="/asset/fondvid.mp4" autoplay muted loop></video>
    <script>
        hamburger = document.querySelector(".hamburger");
        hamburger.onclick =function(){
            navbar =document.querySelector(".nav-bar");
            navbar.classList.toggle("active");
        };
    </script>
        <?php include $contentView; ?>
</body>
</html>