<?php
$id='';
    if(isset($_GET['jedan'])){
       $id = $_GET['jedan'];
    }

    $queryBook = "SELECT *,b.id as bid, p.path as pathcina FROM book b INNER JOIN author a ON b.author_id= a.id INNER JOIN pictures p ON b.picture_id= p.id INNER JOIN category c ON b.cat_id = c.id WHERE b.id = $id";
    $knjigaJedna = executeQuery($queryBook);

if (isset($_SESSION['error'])) {
    foreach ($_SESSION['error'] as $error) {
        echo "<script type='text/javascript'> alert($error);</script>";
    }
}
?>
<div class="main">
    <div class="shop_top">
        <?php foreach ($knjigaJedna as $knjiga):?>
        <div class="container">
            <div class="row">
                <div class="col-md-9 single_left">

                    <div class="single_image">

                        <ul id="etalage">

                            <li>
                                <img class="etalage_thumb_image" src="<?=$knjiga->pathcina ?>" />

                            </li>

                        </ul>
                    </div>
                    <!-- end product_slider -->
                    <div class="single_right">
                        <h3><?=$knjiga->title ?>  </h3>
                        <p class="m_10"><?= $knjiga->about ?> </p>

                        <div class="btn_form">
                            <form action="php/buy.php?id=<?= $knjiga->bid ?>" method="post">
                                <input type="submit" name="btnBuy" value="Buy" title="" data-id="<?= $knjiga->bid ?>">

                        </div>
                        <ul class="add-to-links">
                            <li><img src="images/wish.png" alt=""><a href="#">Add to wishlist</a></li>
                        </ul>
                        <div class="social_buttons">
                            <h4>95 Items</h4>
                            <button type="button" class="btn1 btn1-default1 btn1-twitter" onclick="">
                                <i class="icon-twitter"></i> Tweet
                            </button>
                            <button type="button" class="btn1 btn1-default1 btn1-facebook" onclick="">
                                <i class="icon-facebook"></i> Share
                            </button>
                            <button type="button" class="btn1 btn1-default1 btn1-google" onclick="">
                                <i class="icon-google"></i> Google+
                            </button>
                            <button type="button" class="btn1 btn1-default1 btn1-pinterest" onclick="">
                                <i class="icon-pinterest"></i> Pinterest
                            </button>
                        </div>
                    </div>
                    <div class="clear"> </div>
                </div>
                <div class="col-md-3">
                    <div class="box-info-product">
                        <p class="price2">$<?= $knjiga->price ?></p>
                        <ul class="prosuct-qty">
                            <span>Quantity:</span>
                            <select name="tbOption">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </ul>
                    </div>
                </div>
            </div>
            </form>
            <div class="desc">
                <h4>Plot</h4>
                <p><?= $knjiga->summary ?></p>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</div>