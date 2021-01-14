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
                        <!-- <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/uploads/Blockchain-Dubai.jpg" alt="Project">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/img/example/pictures/anne-nygard-lOcP_QZzitI-unsplash.jpg"
                                        alt="Project">
                                </div>
                            </a>
                        </li> -->
                        <!-- <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/img/example/pictures/danial-ricaros-FCHlYvR5gJI-unsplash.jpg"
                                        alt="Project">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/img/example/pictures/jeshoots-com-eCktzGjC-iU-unsplash.jpg"
                                        alt="Project">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/img/example/pictures/markus-winkler-A0iDWXTrQEY-unsplash.jpg"
                                        alt="Project">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="project-tile">
                                    <div>
                                        <h1>Snake</h1>
                                        <p>developer123</p>
                                    </div>
                                    <img src="public/img/example/pictures/pawel-kadysz-CuFYW1c97w8-unsplash.jpg"
                                        alt="Project">
                                </div>
                            </a>
                        </li> -->
                    </ul>
                </section>
            </div>
        </section>

        <section class="home-news-container">
            <div id="news-empty-image"></div>
            <!-- <img id="news-empty-image" src="public/img/empty.png" alt="emtpy image"> -->
            <!-- <section class="join-project-message">
                <img src="public/img/example/faces/image-2.png" alt="Avatar">
                <div class="news-right-side">
                    <p>someone123 <span>wants to joint your project "Snake"</span></p>
                    <div class="news-buttons">
                        <button class="input-field-round button bt-blue">
                            Go to the profile
                        </button>
                        <button class="input-field-round button bt-green">
                            Accept
                        </button>
                        <button class="input-field-round button bt-red">
                            Decline
                        </button>
                    </div>
                </div>
                <hr> -->
                <!-- </section>
            <section class="join-project-message">
                <img src="public/img/example/faces/image-3.png" alt="Avatar">
                <div class="news-right-side">
                    <p>someone123 <span>wants to joint your project "Snake"</span></p>
                    <div class="news-buttons">
                        <button class="input-field-round button bt-blue">
                            Go to the profile
                        </button>
                        <button class="input-field-round button bt-green">
                            Accept
                        </button>
                        <button class="input-field-round button bt-red">
                            Decline
                        </button>
                    </div>
                </div>
                <hr>
            </section>
            <section class="join-project-message">
                <img src="public/img/example/faces/image-4.png" alt="Avatar">
                <div class="news-right-side">
                    <p>someone123 <span>wants to joint your project "Snake"</span></p>
                    <div class="news-buttons">
                        <button class="input-field-round button bt-blue">
                            Go to the profile
                        </button>
                        <button class="input-field-round button bt-green">
                            Accept
                        </button>
                        <button class="input-field-round button bt-red">
                            Decline
                        </button>
                    </div>
                </div>
                <hr>
            </section>
            <section class="join-project-message">
                <img src="public/img/example/faces/image-5.png" alt="Avatar">
                <div class="news-right-side">
                    <p>someone123 <span>wants to joint your project "Snake"</span></p>
                    <div class="news-buttons">
                        <button class="input-field-round button bt-blue">
                            Go to the profile
                        </button>
                        <button class="input-field-round button bt-green">
                            Accept
                        </button>
                        <button class="input-field-round button bt-red">
                            Decline
                        </button>
                    </div>
                </div>
                <hr>
            </section> -->

                <!-- <section class="pull-request-message">
                    <div class="pull-request-logo">
                        <i class="fab fa-github"></i>
                    </div>
                    <div class="pull-request-info">
                        <h1>Pull request <span>by someone123</span></h1>
                        <h2>asdfasdf asdfadsf asdfasdfsadf asdfasddfasdf</h2>
                        <h3>opened 11 days ago by someone321</h3>
                    </div>
                </section> -->
                <!-- <section class="pull-request-message">
                <div class="pull-request-logo">
                    <i class="fab fa-github"></i>
                </div>
                <div class="pull-request-info">
                    <h1>Pull request <span>by someone123</span></h1>
                    <h2>asdfasdf</h2>
                    <h3>opened 11 days ago by someone321</h3>
                </div>
            </section>
            <section class="pull-request-message">
                <div class="pull-request-logo">
                    <i class="fab fa-github"></i>
                </div>
                <div class="pull-request-info">
                    <h1>Pull request <span>by someone123</span></h1>
                    <h2>asdfasdf</h2>
                    <h3>opened 11 days ago by someone321</h3>
                </div>
            </section> -->
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
                    <input type="password" name="password" placeholder="password" class="input-field-line-under git-input">
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