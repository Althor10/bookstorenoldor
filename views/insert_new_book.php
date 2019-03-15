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
            <form action="php/insert_book.php" method="post" enctype="multipart/form-data">
                <div id="primary">
                    <div class="register-top-grid">
                        <h2>Author Info</h2>

                        <div>
                            <input type="hidden" value="" name=""/>
                            <span>Author First Name<label>*</label></span>
                            <input type="text" name="tbAuthorF" placeholder="Name of the Author"/>
                        </div>
                        <div>
                            <span>Author Last Name <label>*</label></span>
                            <input type="text" name="tbAuthorL" placeholder="Last name of the Author"/>
                        </div>
                        <div>
                            <span>Bio<label>*</label></span>
                            <textarea class="textarea" name="tbBio" placeholder="His bio"> </textarea>

                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="register-bottom-grid" value="">


                        <h2>Book Info</h2>

                        <div>
                            <span>Book Title<label>*</label></span>
                            <input type="text" name="tbTitle" placeholder="Book Title..."/>
                        </div>

                        <div>
                            <span>Summary<label>*</label></span>
                            <textarea class="textarea" name="tbSummary" placeholder="Summary of the book..."> </textarea>
                        </div>
                        <div>
                            <span>Short Summary<label>*</label></span>
                            <textarea class="textarea" name="tbSSummary" > </textarea>
                        </div>
                        <div>
                            <span>Picture Path<label>*</label></span>
                            <input type="file" name="movePic" />
                        </div>
                        <div>
                            <span>Category<label>*</label></span>
                            <input type="text" name="tbCat" placeholder="The Category that the book is in">
                        </div>
                        <div>
                            <span>Price<label>*</label></span>
                            <input type="text" name="tbPrice" placeholder="Price of the book (in decimal)">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="submit" name="btnInsert">
            </form>
        </div>
    </div>
</div>
</div>
<?php else: ?>
    <h1>YOU ARE NOT AUTHORIZED FOR THIS PAGE!! LEAVE!</h1>
<?php endif; ?>
