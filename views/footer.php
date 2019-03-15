<div class="footer">
    <div class="container">
        <div class="row">
            <?php
            $queryNavH4 = "SELECT * FROM h4footer";
            $h4 = executeQuery($queryNavH4);
            foreach ($h4 as $nas):
            ?>
            <div class="col-md-3">
                <ul class="footer_box">

                    <h4><?= $nas->text ?></h4>
                    <?php
                    $queryNavFoot = "SELECT * FROM footer_nav WHERE h4_id =".$nas->id;
                    $ostalo = executeQuery($queryNavFoot);
                    foreach ($ostalo as $item):
                    ?>
                    <li><a href="<?= $item->path  ?>"> <?= $item->text ?></a> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>

<!--            <div class="col-md-3">-->
<!--                <ul class="footer_box">-->
<!--                    <h4>Customer Support</h4>-->
<!--                    <li><a href="http://localhost/PHPWebsite/BookStoreWebsite/Noldor/index.php?page=contact">Contact Us</a></li>-->
<!--                    --><?php //if(!isset($_SESSION['korisnik'])): ?>
<!--                        <li><a href="http://localhost/PHPWebsite/BookStoreWebsite/Noldor/index.php?page=login">Login</a></li>-->
<!--                    --><?php //else: ?>
<!--                        <li><a href="http://localhost/PHPWebsite/BookStoreWebsite/Noldor/php/logout.php">Logout</a></li>-->
<!--                    --><?php //endif; ?>
<!---->
<!--                    <li><a href="#">Easy Returns</a></li>-->
<!--                    <li><a href="#">Warranty</a></li>-->
<!--                </ul>-->
<!--            </div>-->
            <div class="col-md-3">
                    <ul class="social">
                        <li class="facebook"><a href="http://www.facebook.com/althor10"><span> </span></a></li>
                        <li class="twitter"><a href="http://www.twitter.com"><span> </span></a></li>
                        <li class="instagram"><a href="http://www.instagram.com/patakcoda"><span> </span></a></li>
                        <li class="pinterest"><a href="http://www.pintrest.com"><span> </span></a></li>
                        <li class="youtube"><a href="http://www.youtube.com"><span> </span></a></li>
                    </ul>
            </div>
        </div>
        <div class="row footer_bottom">
            <div class="copy">
                <p>© 2014 Template by <a href="http://w3layouts.com" target="_blank">w3layouts</a></p>
            </div>

        </div>
    </div>
</div>
</body>
</html>