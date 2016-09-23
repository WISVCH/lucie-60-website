<?php include_once "components/header.html" ?>

<section class="bg-secondary" id="photolist">
    <div class="container">
        <div id="main_area">
            <!-- Slider -->
            <div class="row">
                <div class="col-sm-6" id="slider-thumbs">
                    <!-- Bottom switcher of slider -->
                    <ul class="hide-bullets">

                        <li class="col-sm-3">
                            <a id="carousel-selector-0"><img class="thumbnail" src="img/thumbnails/P1100488_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-1"><img class="thumbnail" src="img/thumbnails/P1100491_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-2"><img class="thumbnail" src="img/thumbnails/P1100508_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-3"><img class="thumbnail" src="img/thumbnails/P1100511_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-4"><img class="thumbnail" src="img/thumbnails/P1100529_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-5"><img class="thumbnail" src="img/thumbnails/P1100559_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-6"><img class="thumbnail" src="img/thumbnails/P1100566_tn.jpg"></a>
                        </li>
                        <li class="col-sm-3">
                            <a id="carousel-selector-7"><img  class="thumbnail" src="img/thumbnails/P1100571_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-8"><img class="thumbnail-vertical" src="img/thumbnails/P1100528_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-9"><img class="thumbnail" src="img/thumbnails/P1100572_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-10"><img class="thumbnail" src="img/thumbnails/P1100582_tn.jpg"></a>
                        </li>

                        <li class="col-sm-3">
                            <a id="carousel-selector-11"><img class="thumbnail-vertical" src="img/thumbnails/P1100500_tn.jpg"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="col-xs-12" id="slider">
                        <!-- Top part of the slider -->
                        <div class="row">
                            <div class="col-sm-12" id="carousel-bounding-box">
                                <div class="carousel slide" id="myCarousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="active item" data-slide-number="0">
                                            <img class = "slide-photo" src="img/photos/P1100488.jpg"></div>

                                        <div class="item" data-slide-number="1">
                                            <img src="img/photos/P1100491.jpg"></div>

                                        <div class="item" data-slide-number="2">
                                            <img src="img/photos/P1100508.jpg"></div>

                                        <div class="item" data-slide-number="3">
                                            <img src="img/photos/P1100511.jpg"></div>

                                        <div class="item" data-slide-number="4">
                                            <img src="img/photos/P1100529.jpg"></div>

                                        <div class="item" data-slide-number="5">
                                            <img src="img/photos/P1100559.jpg"></div>

                                        <div class="item" data-slide-number="6">
                                            <img src="img/photos/P1100566.jpg"></div>

                                        <div class="item" data-slide-number="7">
                                            <img src="img/photos/P1100571.jpg"></div>

                                        <div class="item" data-slide-number="8">
                                            <img src="img/photos/P1100528.jpg"></div>

                                        <div class="item" data-slide-number="9">
                                            <img src="img/photos/P1100572.jpg"></div>

                                        <div class="item" data-slide-number="10">
                                            <img src="img/photos/P1100582.jpg"></div>

                                        <div class="item" data-slide-number="11">
                                            <img src="img/photos/P1100500.jpg"></div>

                                    </div>
                                    <!-- Carousel nav -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Slider-->
            </div>
        </div>
    </div>

</section>


<?php include_once "components/footer.html" ?>
