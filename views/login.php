<div class="main">
    <div class="shop_top">
        <div class="container">
            <div class="col-md-6">
                <div class="login-page">
                    <h4 class="title">New Customers</h4>
                    <p>Dont have an account? You can create one in just one step! After that you can browse our wares
                        and find a book that you fancy. You will be given a option to enter your address. Don't be
                        alarmed it is so that we know where to ship the products. Hope you enjoy our collection and
                        Happy Bookaneering! </p>
                    <div class="button1">
                        <a href="index.php?page=register"><input
                                    type="submit" name="Submit" value="Create an Account"></a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-title">
                    <h4 class="title">Registered Customers</h4>
                    <?php if (isset($_SESSION['greske'])) {
                        $sesija = $_SESSION['greske'];
                        foreach ($sesija as $error) {
                            echo "<b>$error</b>";
                        }
                    }; ?>
                    <div id="loginbox" class="loginbox">

                        <form action="php/login.php" method="post" name="login" id="login-form">
                            <fieldset class="input">
                                <p id="login-form-username">
                                    <label for="modlgn_username">Email</label>
                                    <input id="modlgn_username" type="text" name="email" class="inputbox" size="18"
                                           autocomplete="off">
                                </p>
                                <p id="login-form-password">
                                    <label for="modlgn_passwd">Password</label>
                                    <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18"
                                           autocomplete="off">
                                </p>
                                <div class="remember">

                                    <input type="submit" name="submit" class="button" value="Login">
                                    <div class="clear"></div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>