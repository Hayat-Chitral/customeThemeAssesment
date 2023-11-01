<?php
include "Include/header.php";
?>
<div class="container-fluid px-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100"
                    src="<?php echo get_template_directory_uri()?>/assests/Images/banner (1).jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                    src="<?php echo get_template_directory_uri()?>/assests/Images/banner (2).jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                    src="<?php echo get_template_directory_uri()?>/assests/Images/banner (3).jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                    src="<?php echo get_template_directory_uri()?>/assests/Images/banner (4).jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                    src="<?php echo get_template_directory_uri()?>/assests/Images/banner (5).jpg"
                    alt="First slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="slider-counter"></div>
</div>

<div class="container-fluid px-0 mt-5">
    <div class="container px-0">
        <div class="row mx-auto cardsection">
            <div class="col-md-6 col-sm-12 col-lg-4 " data-aos="fade-up" data-aos-duration="2000">
                <a href="#">
                    <div class="cardimagediv">
                        <img class=" img-fluid "
                            src="<?php echo get_template_directory_uri()?>/assests/Images/card (1).jpg"
                            alt="Card image cap">
                    </div>
                    <h3 class="text-center textoverimage">Card Heading</h3>
                </a>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4 " data-aos="fade-up" data-aos-duration="2000">
                <a href="#">
                    <div class="cardimagediv">
                        <img class=" img-fluid "
                            src="<?php echo get_template_directory_uri()?>/assests/Images/card (2).jpg"
                            alt="Card image cap">
                    </div>
                    <h3 class="text-center textoverimage">Card Heading</h3>
                </a>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4 " data-aos="fade-up" data-aos-duration="2000">
                <a href="#">
                    <div class="cardimagediv">
                        <img class=" img-fluid"
                            src="<?php echo get_template_directory_uri()?>/assests/Images/card (3).jpg"
                            alt="Card image cap">
                    </div>
                    <h3 class="text-center textoverimage">Card Heading</h3>
                </a>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid px-3">
    <div class="container px-0">
        <h1 class="text-center header-text-color"><?php the_title(); ?></h1>
        <p class="text-justify"><?php the_content(); ?></p>
    </div>
</div>
<div class="container-fluid px-0 bg-fixed">
    <img style="background-repeat: no-repeat; background-attachment: fixed;" class="d-block w-100" src="<?php echo get_template_directory_uri()?>/assests/Images/ben.jpg"alt="First slide">
</div>
<div class="container-fluid px-3 why-travel-with-us-fluid">
    <div class="container px-0">
    <h1 class="text-center header-text-color">Dummy Heading</h1>
        <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the
            printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum. </p>
    </div>
</div>

<?php 
include "Include/footer.php";
?>