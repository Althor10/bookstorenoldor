<div class="main">
<div class="banner">
    <!-- start slider -->
    <div id="fwslider">
        <div class="slider_container">
            <?php
                $querySlide = "SELECT * FROM slider s INNER JOIN pictures_slide ps ON s.picture_id=ps.id";
                $sliderBig = executeQuery($querySlide);
                foreach ($sliderBig as $item):
            ?>
            <div class="slide">
                <!-- Slide image -->
                <img src="<?=$item->path ?>" class="img-responsive" alt="<?= $item->alt ?>"/>
                <!-- /Slide image -->
                <!-- Texts container -->
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <!-- Text title -->
                        <h1 class="title"><?= $item->text ?></h1>
                        <!-- /Text title -->
                        <div class="button"><a href="<?= $item->a_path ?>">See Details</a></div>
                    </div>
                </div>
                <!-- /Texts container -->
            </div>
            <?php endforeach; ?>

        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div>
    <!--/slider -->
</div>


<!-- MAIN!!! -->
<div class="main">
    <div class="content-top">
        <h2>In store</h2>
        <p>Books that we have in store!</p>
        <div class="close_but"><i class="close1"> </i></div>
        <ul id="flexiselDemo3">
            <?php
            $upitcina = "SELECT * FROM pictures p INNER JOIN book b ON p.id = b.picture_id";
            $slider = executeQuery($upitcina);
            foreach($slider as $sliderImage): ?>
          <li>
                <img src="<?=$sliderImage->path ?>" /> </li>
            <?php endforeach; ?>
        </ul>
        <h3>Do not miss them!</h3>
        <script type="text/javascript">
            $(window).load(function() {
                $("#flexiselDemo3").flexisel({
                    visibleItems: 5,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint:480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint:640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint:768,
                            visibleItems: 3
                        }
                    }
                });

            });
        </script>
        <script type="text/javascript" src="js/jquery.flexisel.js"></script>
    </div>
</div>
<div class="content-bottom">
    <div class="container">
        <div class="row content_bottom-text">
            <div class="col-md-7">
                <h3 style="color:black">Words from the<br>Author</h3>
                <p class="m_1" style="color:black"> Hello! My name is Danilo! Just wanted to say, before anything else that this is a non-profit website and it's just for show. This supposed "company" that I made up is just to have a preview of the skills used to make this website.</p>
                <p class="m_2" style="color:black">I do not sell any of the books, nor do i own them. They are written by their respected writers and published by REAL publishers. Hope you enjoy the design that this site has, and hopefully you would find an interesting book to read. Please buy the real one. Like i said we dont sell them here, it's just for show!</p>
            </div>
        </div>
    </div>
</div>

</div>
      
      