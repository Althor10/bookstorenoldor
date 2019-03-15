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

            $upit = "SELECT *, s.id as sid,s.a_path as apath,ps.path as imgpath FROM slider s INNER JOIN pictures_slide ps ON s.picture_id = ps.id WHERE s.id = $id";
            $sliders = executeQuery($upit);
            ?>
            <form action="php/update_slide.php" method="post">
                <div class="register-top-grid">
                    <h3>SLIDE INFORMATION</h3>
                    <?php foreach ($sliders as $slider):?>
                    <div>
                        <input type="hidden" value="<?=$slider->sid ?>" name="sid"/>
                        <span>Change Text<label>*</label></span>
                        <input type="text" name="tbText" value="<?= $slider->text ?>">
                    </div>
                    <div>
                        <span>Change A href Path<label>*</label></span>
                        <input type="text" name="tbAHref" value="<?= $slider->apath ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="register-bottom-grid" >
                    <h3>PICTURE INFORMATION</h3>

                    <div>
                        <span>Change Picture Path<label>*</label></span>
                        <input type="file" name="fSlika"/>
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
