<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
<?php require __DIR__.'/shared/_header.php'; ?>

    <main class="main-container container">
        <?php
            if (isset($users)):
                foreach ($users as $user):
        ?>
            <section class="admin-form">
                <form action="admin" method="POST">
                    <div class="title">
                        <h1><?= $user->getNickname() ?></h1>
                        <p><?= $user->getEmail() ?></p>
                    </div>
                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                    <div class="checkboxes">
                        <label>
                            admin
                            <input type="checkbox" name="admin"
                                <?= $user->getUserRoles()->isAdmin() ? 'checked' : '' ?>>
                        </label>
                        <label>
                            moderator
                            <input type="checkbox" name="moderator"
                                <?= $user->getUserRoles()->isModerator() ? 'checked' : '' ?>>
                        </label>
                        <input type="submit" class="input-field-round button bt-green">
                    </div>
                </form>
            </section>
            <hr />
        <?php endforeach; endif; ?>
    </main>

<?php require __DIR__ . '/shared/_footer.html'; ?>
</body>

</html>