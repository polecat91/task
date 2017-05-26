        <div class="top_nav">
            <div class="nav_menu">
                <nav class="container text-center">
                    <span class="user-content pull-left">
                        <i class="fa fa-user"></i>
                        <?=$_SESSION['user']['username']?>
                    </span>
                    
                    <a class="logout pull-right" href="<?=$APP_CONF['base_url']?>logout">
                        Kilépés
                        <i class="fa fa-sign-out"></i>
                    </a>
                </nav>
            </div>
        </div>

        <main>