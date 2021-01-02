<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CNode</title>
    <meta name="description" content="WdPAI project">
    <meta name="keywords" content="code programming team crew">
    <link rel="stylesheet" href="public/css/style.css" />
    <link rel="stylesheet" href="public/css/login.css" />
</head>

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