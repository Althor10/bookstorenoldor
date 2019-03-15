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
            else{
                echo "Uneti podatke.";
                unset($_SESSION['greske']);
            }

            $upit = "SELECT *, b.id as bid,p.path as ppath FROM book b INNER JOIN pictures p ON b.picture_id = p.id INNER JOIN author a ON b.author_id = a.id INNER JOIN category c ON b.cat_id=c.id WHERE b.id = $id";
            $books = executeQuery($upit);
            ?>
            <form action="php/update_book.php" method="post">
                <div class="register-top-grid">
                    <h3>Book Info</h3>
                    <?php foreach ($books as $book):?>
                    <div>
                        <input type="hidden" value="<?=$book->bid ?>" name="bookid"/>
                        <span>Book Title<label>*</label></span>
                        <input type="text" name="tbTitle" value="<?= $book->title ?>">
                    </div>
                    <div>
                        <span>Change Summary<label>*</label></span>
                        <textarea class="textarea" name="tbSummary" "><?= $book->summary ?> </textarea>
                    </div>
                    <div>
                        <span>Change Category<label>*</label></span>
                        <textarea class="textarea" name="tbCategory" "><?= $book->name ?> </textarea>
                    </div>
                    <div>
                        <span>Change Short Summary<label>*</label></span>
                        <textarea class="textarea" name="tbSSummary" "><?= $book->about ?> </textarea>

                    </div>
                    <div>
                        <span>Put it on SALE<label>*</label></span>
                        <input type="radio" name="radio" value="<?= $book->sale ?>"> Yes
                        <input type="radio" name="radio" value="<?= $book->sale ?>"> No
                    </div>
                    <div>
                        <span>Change Image Path<label>*</label></span>
                        <input type="text" name="tbPath" value="<?= $book->ppath ?>">

                    </div>
                    <div>
                        <span>Change Price<label>*</label></span>
                        <input type="text" name="tbPrice" value="<?= $book->price ?>">

                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="register-bottom-grid" value="">
                    <h3>Author Information</h3>

                    <div>
                        <span>Author First Name<label>*</label></span>
                        <input type="text" name="tbAuthorF" value="<?= $book->author_firstname ?>">
                    </div>

                    <div>
                        <span>Author Last Name<label>*</label></span>
                        <input type="text" name="tbAuthorL" value="<?= $book->author_lastname ?>">
                    </div>
                    <div>
                        <span>Author Bio<label>*</label></span>
                        <input type="text" name="tbBio" value="<?= $book->bio ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <?php endforeach; ?>
                <div class="clear"></div>
                <input type="submit" value="submit" name="btnUnos3">
            </form>
        </div>
    </div>
</div>
<?php else: ?>
    <h1>YOU ARE NOT AUTHORIZED FOR THIS PAGE!! LEAVE!</h1>
<?php endif; ?>
