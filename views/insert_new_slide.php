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
            ?>
            <form action="php/insert_slider.php" method="post" enctype="multipart/form-data">
                <div id="primary">
                    <div class="register-top-grid">
                        <h2>Insert Slide</h2>

                        <div>
                            <input type="hidden" value="" name=""/>
                            <span>Slide Text<label>*</label></span>
                            <input type="text" name="tbSlideText" placeholder="The Text that will show!"/>
                        </div>
                        <div>
                            <span>Slide Path <label>*</label></span>
                            <input type="text" name="tbSPath" placeholder="Path that you will send the user"/>
                        </div>
                       <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="register-bottom-grid" value="">


                        <h2>Slide image</h2>

                        <div>
                            <span>Image Path<label>*</label></span>
                            <input type="file" name="fSlika" />
                        </div>


                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="submit" name="btnInsertSlide">
            </form>
        </div>
    </div>
</div>
</div>
<?php else: ?>
    <h1>YOU ARE NOT AUTHORIZED FOR THIS PAGE!! LEAVE!</h1>
<?php endif; ?>
