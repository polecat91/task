<div class="notify text-center"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-6 login-content">
            <div class="text-center content">
                <h2>Login</h2>
                <!-- Main Form -->
                <div class="login-form-1">
                    <form name="form-login" class="text-left form-login" method="POST">
                        <div class="main-login-form">
                            <div class="login-group">
                                <div class="form-group">
                                    <label for="lg_username" class="sr-only">E-mail</label>
                                    <input type="text" class="form-control login-email" maxlength="128" required="required" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="lg_password" class="sr-only">Jelszó</label>
                                    <input type="password" class="form-control login-password" maxlength="64" required="required" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="login-button btn-primary text-center"><strong>Belépek</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-6 sign-up-content">
            <div class="text-center content">
                <h2>Regisztráció</h2>
                <!-- Main Form -->
                <div class="sign-up-form-1">
                    <form name="form-sign-up" class="text-left form-sign-up" method="POST">
                        <div class="main-sign-up-form">
                            <div class="sign-up-group">
                                <div class="form-group">
                                    <label for="lg_username" class="sr-only">Felhasználónév</label>
                                    <input type="text" name="username" maxlength="64" class="form-control sign-up-username" required="required" placeholder="Felhasználónév">
                                </div>
                                <div class="form-group">
                                    <label for="lg_username" class="sr-only">E-mail</label>
                                    <input type="text" name="email" maxlength="128" class="form-control sign-up-email" required="required" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="lg_password" class="sr-only">Jelszó</label>
                                    <input type="password" name="password" maxlength="64" class="form-control sign-up-password" required="required" placeholder="Jelszó">
                                </div>
                                <div class="form-group">
                                    <label for="lg_password" class="sr-only">Jelszó újra</label>
                                    <input type="password" name="re_password" maxlength="64" class="form-control sign-up-re-password" required="required" placeholder="Jelszó újra">
                                </div>
                            </div>
                            <button type="submit" class="sign-up-button btn-primary text-center"><strong>Regisztrálok</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>