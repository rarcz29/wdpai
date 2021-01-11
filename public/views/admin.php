<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
<?php require __DIR__.'/shared/_header.php'; ?>

    <main class="main-container">
        <?php foreach ($users as $user): ?>
            <div id="<?= $user->getId(); ?>">
                <?php echo $user->getNickname() ?>
            </div>
        <?php endforeach; ?>
    </main>

</body>

</html>