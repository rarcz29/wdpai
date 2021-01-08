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
            <form action="register" method="POST">
                <input class="input-field-line-under input-login" name="nickname" type="text" placeholder="nickname">
                <input class="input-field-line-under input-login" name="email" type="email" placeholder="email">
                <input class="input-field-line-under input-login" name="password" type="password"
                    placeholder="password">
                <input class="input-field-line-under input-login" name="confirmedPassword" type="password"
                    placeholder="confirm password">
                <button class="button-login button bt-blue input-field-round">Sign up</button>
                <p>or</p>
                <a href="login">Log in</a>
            </form>
        </div>
    </div>
</body>

</html>