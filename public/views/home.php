<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__ . '/shared/_headTag.php'; ?>

<body>
    <?php require __DIR__ . '/shared/_header.php'; ?>

    <main class="home-main-container">
        <section class="home-left-container">
            <hr class="left-nav-separator" />
            <div class="projects-container">
                <section>
                    <form class="search-form search-projects-form">
                        <input class="input-field-round" placeholder="&#xF002; Find a project">
                            <!-- TODO: fix fonts -->
                    </form>

                    <div class="projects-buttons">
                        <button onclick="location.href='newProject'" class="input-field-round button bt-green new-project-bt">
                            <i class="fas fa-folder-plus"></i>New
                        </button>

                        <div class="filters">

                        </div>
                    </div>
                </section>
                <section class="projects">
                    <section id="no-projects-info">
                        <hr />
                        <h1>Your project list is empty</h1>
                        <p>Connect your account to GitHub, Bitbucket and GitLab. Create new repositories and manage them from one place.</p>
                        <p>Find a team to work with. Add other users to your projects or join other's ones.</p>
                    </section>
                    <ul id="projects-container" class="list">

                    </ul>
                </section>
            </div>
        </section>

        <section class="home-news-container">
            <div id="news-empty-image"></div>

        </section>

        <section class="git-tools">
            <form id="git-tools-form">
                <div class="input-radio-container git-icons">
                    <input type="radio" id="gitTool1" name="gitTool" value="github" checked>
                    <label for="gitTool1">
                        <i class="fab fa-github main-icon"></i>
                        <i id="github-connected-icon" class="fas fa-check-circle check-icon"></i>
                    </label>
                    <input type="radio" id="gitTool2" name="gitTool" value="bitbucket" unchecked>
                    <label for="gitTool2">
                        <i class="fab fa-bitbucket main-icon"></i>
                        <i id="bitbucket-connected-icon" class="fas fa-check-circle check-icon"></i>
                    </label>
                    <input type="radio" id="gitTool3" name="gitTool" value="gitlab" unchecked>
                    <label for="gitTool3">
                        <i class="fab fa-gitlab main-icon"></i>
                        <i id="gitlab-connected-icon" class="fas fa-check-circle check-icon"></i>
                    </label>
                </div>
                <div>
                    <input type="text" name="login" placeholder="login" autocomplete="off" class="input-field-line-under git-input">
                    <input type="password" name="token" placeholder="token" class="input-field-line-under git-input">
                    <input type="submit" class="input-field-round button bt-blue git-submit-bt" value="Connect">
                </div>
            </form>
        </section>
    </main>
</body>

<template id="project-tile-template">
    <a href="#" target="_blank">
        <div class="project-tile">
            <div>
                <h1>Title</h1>
                <p>Description</p>
            </div>
            <img src="public/uploads/Blockchain-Dubai.jpg" alt="Project">
        </div>
    </a>
</template>

<template id="notification-template">
    <article class="join-request">
        <div class="request-info">
            <h1>username</h1>
            <p>want's to join your project <span>projectName</span></p>
        </div>
        <div class="request-buttons">
            <button class="input-field-round button bt-green">Accept</button>
            <button class="input-field-round button bt-red">Decline</button>
        </div>
    </article>
</template>

</html>