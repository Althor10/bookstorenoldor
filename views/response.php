<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php

            if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin"): ?>
            <?php

            if (isset($_SESSION['error'])) {
                foreach ($_SESSION['error'] as $error) {
                    echo "<p>$error</p>";
                }

            }
            $id="";
            if(isset($_GET['id'])){
                $id= $_GET['id'];
            }
            $upit = "SELECT * FROM contact WHERE id = $id";
            $contact = executeQuery($upit);
            ?>
            <form action="php/respond_admin.php" method="post">
                 <?php foreach ($contact as $item): ?>
                <div id="primary">
                    <input type="hidden" name="adminMail" value="<?php if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin"){echo $_SESSION['korisnik']->private_mail;}?>" />

                    <div class="register-top-grid">

                        <h2>Respond to <?= $item->name ?></h2>

                        <div>
                            <span>Subject<label>*</label></span>
                            <input type="text" name="tbSubject"/>
                        </div>
                        <div>
                            <span>Text<label>*</label></span>
                            <input type="text" name="tbText" />
                        </div>
                        <div>
                            <span>Email<label>*</label></span>
                            <input type="text" name="tbEmail" value="<?=$item->email ?>"/>
                        </div>
                       <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="submit" name="btnInsertMessage">
                    <?php endforeach;?>
            </form>
        </div>
    </div>
</div>
</div>
<?php else: ?>
    <h1>YOU ARE NOT AUTHORIZED FOR THIS PAGE!! LEAVE!</h1>
<?php endif; ?>
