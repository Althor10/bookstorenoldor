<?php if (isset($_SESSION['korisnik'])): ?>
    <div class="main">
        <div class="shop_top">
            <div class="container">
                <div class="row shop_box-top">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#cart">Cart</a></li>
                    </ul>
                    <?php
                    $korName = $_SESSION['korisnik']->bookaneer_name;
                    $upit = "SELECT * FROM cart c INNER JOIN book b ON c.book_id = b.id INNER JOIN author a ON b.author_id = a.id INNER JOIN bookaneers u ON c.bookaneers_id = u.id  WHERE bookaneer_name = '$korName' ";
                    $proizvodi = executeQuery($upit);

                    ?>
                    <div class="tab-content">
                        <div id="cart" class="tab-pane fade in active">
                            <h3>Items</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($proizvodi): ?>
                                    <?php foreach ($proizvodi as $proizvod): ?>
                                        <tr>
                                            <th scope="row"><?= $korName ?></th>
                                            <td><?= $proizvod->title ?></td>
                                            <td><?= $proizvod->author_firstname . " " . $proizvod->author_lastname ?></td>
                                            <td><?= $proizvod->quantity ?></td>
                                            <td><?= $proizvod->price * $proizvod->quantity ?></td>
                                            <td> Delivery Pending</td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="row"><?= $korName ?></th>
                                        <td><?= $proizvod->title ?></td>
                                        <td><?= $proizvod->author_firstname . " " . $proizvod->author_lastname ?></td>
                                        <td><?= $proizvod->quantity ?></td>
                                        <td><?= $proizvod->price * $proizvod->quantity ?></td>
                                        <td> Delivery Pending</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="main">
        <div class="shop_top">
            <div class="container">
                <h4 class="title">Shopping cart is empty</h4>
                <p class="cart">You are not logged in.<br>Click<a href="index.php?page=login"> here</a> to continue
                    login and continue shopping !</p>
            </div>
        </div>
    </div>
<?php endif; ?>