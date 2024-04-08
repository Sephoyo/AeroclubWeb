<main>
    <div class="container">
        <div class="signin-signup">
            <form method="post" action="log_sign/login.php" class="sign-in-form">
                <h2 class="title">Se connecter</h2>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="email" type="email" placeholder="email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input  name="password" type="password" placeholder="password">
                </div>
                <input type="submit" value="Se connecter" class="btn">
<!--                <p class="account-text">Pas encore de compte ? <a href="#" id="sign-up-btn2">Sign up</a></p>-->
            </form>
            <form action="" class="sign-up-form">
                <h2 class="title">S'inscrire</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <input type="submit" value="S'inscrire" class="btn">
<!--                <p class="account-text">Déjà un compte ? <a href="#" id="sign-in-btn2">Sign in</a></p>-->
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Déjà membre ?</h3>
                    <p>Accèder à votre compte avec simplicité en vous connectant</p>
                    <button class="btn_v" id="sign-in-btn">Se connecter</button>
                </div>
                <img src="/asset/login.svg" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Nouveau membre ?</h3>
                    <p>Contacter le secrétariat</p>
                    <!--<button class="btn_v" id="sign-up-btn">S'inscrire</button>-->
                </div>
                <img src="/asset/signup.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="/js/login.js"></script>
</main>