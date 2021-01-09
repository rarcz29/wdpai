<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $_SESSION['title']; ?></title>
    <meta name="description" content="WdPAI project">
    <meta name="keywords" content="code programming team crew">
    <link rel="stylesheet" href="public/css/style.css" />
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>

    <?php
        $resources = '';

        switch ($_SESSION['state'])
        {
            case 'login':
            case 'signup':
                $resources = "<link rel='stylesheet' href='public/css/login.css' />".
                             "<script defer src='public/js/login_validation.js'></script>";
                break;

            case 'home':
                $resources = "<link rel='stylesheet' href='public/css/home.css' />".
                             "<script defer type='module' src='public/js/home.js'></script>";
                break;

            case 'newProject':
                $resources = "<link rel='stylesheet' href='public/css/new-project.css' />".
                             "<script defer src='public/js/new_project.js'></script>";
                break;

            case 'community':
                $resources = "<link rel='stylesheet' type='module' href='public/css/community.css' />";
                break;
        }

        echo $resources;
    ?>
</head>