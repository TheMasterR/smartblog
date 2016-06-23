<header>
    <div class="content">
        <a href="/">
            <img src="/public/img/logo.png" alt="Smart logo">
        </a>
        <nav>
            <a href="/">HOME</a>
            <?php
                if (!$TEMPLATE_VARS['userIsLogged']) {
                    echo '<a href="/?page=auth&action=register">Register</a>';
                    echo '<a href="/?page=auth&action=login">Login</a>';
                } else {
            ?>
                <span href="#" class="account">
                    <a href="/?page=myAccount">MY ACCOUNT</a>
                    <span class="dropdown">
                        <a href="/?page=article&action=add">New article</a>
                        <a href="/?page=article&action=myArticles">My Articles</a>
                        <a href="/phpmyadmin/" target="_BLANK">PhPMyAdmin</a>
                        <a href="/?page=auth&action=doLogout">Logout</a>
                    </span>
                </span>
            <?php
                }
            ?>
            <a href="#" class="search"></a>
        </nav>
    </div>
</header>