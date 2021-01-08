<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
<?php require __DIR__.'/shared/_header.html'; ?>

    <main class="main-container">
        <nav class="input-field-line-under community-navbar">
            <ul>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Advertisements</a></li>
            </ul>
        </nav>
    </main>

</body>

</html>