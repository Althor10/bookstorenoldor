<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php
            if (isset($_SESSION['error'])) {
                foreach ($_SESSION['error'] as $error) {
                    echo "<p>$error</p>";
                    unset($_SESSION['error']);
                }
            }
            ?>
            <form action="php/survey.php" method="post">
                <div class="register-top-grid">
                    <h2>SURVEY</h2>
                    <div>
                        <span>First Name</span>
                        <input type="text" name="tbIme">
                    </div>
                    <div class="clear"></div>

                </div>
                <div class="clear"></div>
                <div class="register-bottom-grid">
                    <h3>QUESTION</h3>
                    <div>
                        <span>What type of novels do you like to read?<label>*</label></span>
                        <select name="novels">
                            <option  value="0">Choose category...</option>
                            <option  value="1">Epic-Fantasy</option>
                            <option  value="2">Criminal/Detective</option>
                            <option  value="3">Horror</option>
                            <option  value="4">Romance/Love</option>
                            <option  value="5">Drama/Tragedy</option>
                            <option  value="6">Sci-Fi</option>
                            <option  value="7">Mystery</option>
                            <option  value="7">Westerns</option>
                            <option  value="8">Comic Books</option>
                        </select>
                    </div>
                    <div>
                        <span>Has any book ever made you laugh out loud?</span>
                        <input type="text" name="tbLaugh" name="answer">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <input type="submit" value="Answer" name="btnUnos">
            </form>
        </div>
    </div>
</div>