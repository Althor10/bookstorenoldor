<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php
            if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin"): ?>
            <?php
            $id = "";
            if(isset($_GET['id'])){
                $id= $_GET['id'];
            }
            if (isset($_SESSION['error'])) {
                foreach ($_SESSION['error'] as $error) {
                    echo "<p>$error</p>";
                }
            }

            $upit = "SELECT * FROM bookaneers WHERE id = $id";
            $korisnici = executeQuery($upit);
            ?>
            <form action="php/update_user.php" method="post">
                <div class="register-top-grid">
                    <h3>PERSONAL INFORMATION</h3>
                    <?php foreach ($korisnici as $korisnik):?>
                    <div>
                        <input type="hidden" value="<?=$korisnik->id ?>" name="korid"/>
                        <span>Change First Name<label>*</label></span>
                        <input type="text" name="tbIme2" value="<?= $korisnik->first_name ?>">
                    </div>
                    <div>
                        <span>Change Last Name<label>*</label></span>
                        <input type="text" name="tbPrezime2" value="<?= $korisnik->last_name ?>">
                    </div>
                    <div>
                        <span>Change Address<label>*</label></span>
                        <input type="text" name="tbAdresa2" value="<?= $korisnik->adress ?>">
                        <?php


                        ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="register-bottom-grid" value="">
                    <h3>LOGIN INFORMATION</h3>

                    <div>
                        <span>Password<label>*</label></span>
                        <input id="modlgn_passwd" type="text" name="tbLozinka2" class="inputbox" width="96%"
                               size="10" autocomplete="off" value="<?= $korisnik->bookaneer_pass ?>">
                    </div>

                    <div>
                        <span>Email Adress<label>*</label></span>
                        <input type="text" name="tbMail2" value="<?= $korisnik->private_mail ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <?php endforeach; ?>
                <div class="clear"></div>
                <input type="submit" value="submit" name="btnUnos2">
            </form>
        </div>
    </div>
</div>
<?php else: ?>
    <h1>YOU ARE NOT AUTHORIZED FOR THIS PAGE!! LEAVE!</h1>
<?php endif; ?>
