<header class="main-navbar flex-center home-navbar">
    <img class="logo" src="public/img/logo.svg" alt="logo" />

    <div class="nav-container flex-center">
        <nav>
            <ul class="list main-list">
                <li><a href="home">Home</a></li>
                <li><a href="community">Community</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Help</a></li>
                <?php
                    if ($_SESSION['admin'] === true)
                    {
                        echo "<li><a href='admin'>Admin</a></li>";
                    }
                ?>
            </ul>

            <ul class="list user-list">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Sign out</a></li>
            </ul>
        </nav>

        <div class="right-side-icons flex-center">
<!--            <i class="fas fa-search"></i>-->
<!--            <i class="fas fa-bell"></i>-->
            <a href="login"><i class="fas fa-user-circle"></i></a>
        </div>
    </div>

    <i class="fas fa-bars burger"></i>
</header>
