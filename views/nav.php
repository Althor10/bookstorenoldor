<div class="menu">
    <a class="toggleMenu" href="#"><img src="images/nav.png" alt=""/></a>
    <ul class="nav" id="nav">
        <?php
        $queryNav = "SELECT * FROM navigation";
        $doNav = executeQuery($queryNav);

        foreach ($doNav as $item):
            ?>
            <?php if (!$item->admin): ?>
            <li><a href="<?= $item->path ?>"><?= $item->name ?></a></li>
        <?php elseif (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin" && $item->admin): ?>

            <li><a href="<?= $item->path ?>"><?= $item->name ?></a></li>
        <?php endif; ?>
        <?php endforeach; ?>
        <div class="clear"></div>
    </ul>
    <script type="text/javascript" src="js/responsive-nav.js"></script>
</div>
<div class="clear"></div>
</div>
<div class="header_right">
    <script src="js/classie.js"></script>
    <script src="js/uisearch.js"></script>
    <script>
        new UISearch(document.getElementById('sb-search'));
    </script>
    <!----//search-scripts---->
    <ul class="icon1 sub-icon1 profile_img">
        <li><a class="active-icon c1" href="#"> </a>
            <ul class="sub-icon1 list">
                <?php if (isset($_SESSION['korisnik'])) {
                    echo "Username: " . $_SESSION['korisnik']->bookaneer_name;
                } else echo "Please log in!";
                ?>
                <div class="login_buttons">
                    <?php if (!isset($_SESSION['korisnik'])): ?>
                        <div class="login_button"><a
                                    href="index.php?page=login">Login</a>
                        </div>
                    <?php else: ?>
                        <div class="login_button"><a
                                    href="php/logout.php">Logout</a>
                        </div>
                    <?php endif; ?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </ul>
        </li>
    </ul>
    <div class="clear"></div>
</div>
</div>
</div>
</div>
</div>