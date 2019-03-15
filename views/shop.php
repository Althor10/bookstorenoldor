<?php $actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; ?>
<div class="main">
    <div class="shop_top">
        <div class="container">
            <div class="row shop_box-top">
                <?php

                if (isset($_GET['strana'])) {
                    $strana = $_GET['strana'];
                } else
                    $strana = 1;


                $perPage = 4;
                $limit = $strana * $perPage;
                $offSet = ($strana * $perPage) - $perPage;


                $tupi = "SELECT *,b.id as bid FROM book b INNER JOIN author a ON b.author_id=a.id INNER JOIN pictures p ON b.picture_id=p.id INNER JOIN category c ON b.cat_id=c.id ORDER BY bid LIMIT $limit OFFSET $offSet";
                $tupi2 = "SELECT * FROM book b INNER JOIN author a ON b.author_id=a.id INNER JOIN pictures p ON b.picture_id=p.id INNER JOIN category c ON b.cat_id=c.id";
                $proizvodi = executeQuery($tupi);

                $pagina = executeQuery($tupi2);
                $count = count($pagina);
                foreach ($proizvodi

                         as $proizvod):
                    ?>


                    <div class="col-md-3 shop_box">
                        <a href="<?= $actual_link ?>?page=single&jedan=<?= $proizvod->bid ?>">
                            <img src="<?= $proizvod->path ?>" class="img-responsive image-center"
                                 alt="<?= $proizvod->alt ?>"/>
                            <?php if ($proizvod->new == 1): ?>
                                <span class="new-box">
						<span class="new-label">New</span>
					</span>
                            <?php endif; ?>
                            <?php if ($proizvod->sale == 1): ?>
                                <span class="sale-box">
						<span class="sale-label">Sale!</span>
					</span>
                            <?php endif; ?>
                            <div class="shop_desc">
                                <h3>
                                    <a href="<?= $actual_link ?>?page=single&jedan=<?= $proizvod->bid ?>"></a> <?= $proizvod->title ?>
                                </h3>
                                <p><?= $proizvod->author_firstname . " " . $proizvod->author_lastname ?> </p>
                                <span class="actual">$<?= $proizvod->price ?></span><br>
                                <ul class="buttons">
                                    <li class="cart"><?= $proizvod->name ?></li>
                                    <li class="shop_btn"><a href="index.php?page=single&jedan=<?= $proizvod->bid ?>">Read More</a></li>
                                    <div class="clear"></div>
                                </ul>
                            </div>


                        </a>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="row div-pagination">
                <div class="col-4 col-offset-6" id="paginacija">
                    <ul class="pagination">
                        <?php if ($strana - 2 > 0): ?>
                            <li>
                                <a href="<?= $actual_link ?>?page=shop&strana=<?= $strana - 2 ?>"><?= $strana - 2; ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($strana - 1 > 0): ?>
                            <li>
                                <a href="<?= $actual_link ?>?page=shop&strana=<?= $strana - 1 ?>"><?= $strana - 1; ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="active"><a href="#"><?= $strana ?></a></li>
                        <?php if ($strana + 1 < $count/$perPage+1): ?>
                            <li>
                                <a href="<?= $actual_link ?>?page=shop&strana=<?= $strana + 1 ?>"><?= $strana + 1; ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($strana + 2 < $count/$perPage+1): ?>
                            <li>
                                <a href="<?= $actual_link ?>?page=shop&strana=<?= $strana + 2 ?>"><?= $strana + 2; ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>