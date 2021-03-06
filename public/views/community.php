<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
<?php require __DIR__ . '/shared/_header.php'; ?>

    <main class="main-container">
        <nav class="input-field-line-under community-navbar">
            <ul>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Advertisements</a></li>
            </ul>
        </nav>

        <section class="projects-container">

        </section>

    </main>
</body>

<template id="project-template">
    <article id="" class="project">
        <div class="image">
            <h1>JOIN</h1>
            <img src="public/uploads/Blockchain-Dubai.jpg">
        </div>
        <div class="info">
            <div class="basic-info">
                <h2></h2>
                <p></p>
            </div>
            <div class="details-section">
                <p></p>
                <div class="social-section">
                    <div class="likes">
                        <i class="fas fa-thumbs-up font-green"></i><p class="thumbs-up"></p>
                        <i class="fas fa-thumbs-down font-red"></i><p class="thumbs-down"></p>
                    </div>
                    <div class="comments">
                        <p></p>
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div>
    </article>
</template>

<template id="comments-section-template">
    <article class="comment-section">
        <button class="exit-button">
            <i class="fas fa-times"></i>
        </button>
        <div class="write-comment-section">
            <form>
                <input type="text" name="text" autocomplete="off">
                <input type="hidden" name="project-id">
                <button type="submit" class="bt-green">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>

        <div class="comments">

        </div>

    </article>
</template>

<template id="single-comment-template">
    <section class="comment">
        <?php if ($_SESSION['moderator']) echo "<button class='bt-red'>remove</button>" ?>
        <header>
            <h2></h2>
            <p></p>
        </header>
        <div>
            <p></p>
        </div>
    </section>
</template>

</html>