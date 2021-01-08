<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg" alt="logo">
        </div>
        <div class="login-container">
            <form action="login" method="POST">
                <div class="messages">
                    <?php
                        if (isset($messages))
                        {
                            foreach ($messages as $message)
                            {
                                echo $message;
                            }                         
                        }
                    ?>
                </div>
                <input class="input-field-line-under input-login" name="email" type="email" placeholder="email">
                <input class="input-field-line-under input-login" name="password" type="password"
                    placeholder="password">
                <button type="submit" class="button input-field-round bt-blue button-login">Log in</button>
                <p>Don't have an account?</p>
                <a href="signup">Sign up</a>
            </form>
        </div>
    </div>
</body>

</html>