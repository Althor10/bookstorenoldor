<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php
            if (isset($_SESSION['error'])) {
                foreach ($_SESSION['error'] as $error) {
                    echo "<p>$error</p>";
                }
            } ?>
            <form action="php/registration.php" method="post">
                <div class="register-top-grid">
                    <h3>PERSONAL INFORMATION</h3>
                    <div>
                        <span>First Name<label>*</label></span>
                        <input type="text" name="tbIme">
                    </div>
                    <div>
                        <span>Last Name<label>*</label></span>
                        <input type="text" name="tbPrezime">
                    </div>
                    <div>
                        <span>Home Address<label>*</label></span>
                        <input type="text" name="tbAdresa">
                    </div>
                    <div class="clear"></div>

                </div>
                <div class="clear"></div>
                <div class="register-bottom-grid">
                    <h3>LOGIN INFORMATION</h3>
                    <div>
                        <span>Password<label>*</label></span>
                        <input id="modlgn_passwd" type="password" name="tbLozinka" class="inputbox" width="96%"
                               size="10" autocomplete="off">
                    </div>
                    <div>
                        <span>Email Adress<label>*</label></span>
                        <input type="text" name="tbEmail">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <input type="submit" value="submit" name="btnUnos">
            </form>
        </div>
    </div>
</div>