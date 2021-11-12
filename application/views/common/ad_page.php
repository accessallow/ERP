
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Sanchaar ERP</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap.min.css" />

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="<?php echo base_url(); ?>assets/frontpage/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?php echo base_url(); ?>assets/frontpage/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/frontpage/carousel.css" rel="stylesheet">
        <style>
            .carousel-caption{
                background:rgba(0,0,0,0.8);
                padding:10px;
                padding-left:20px;
                padding-right: 20px;
                border-radius: 1em;
            }
        </style>
    </head>
    <!-- NAVBAR
    ================================================== -->
    <body>
        <div class="navbar-wrapper">
            <div class="container">

                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url("Front"); ?>">Sanchaar ERP</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#about">Features</a></li>
                                <li><a href="<?php echo site_url("Product"); ?>">Demo</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pricing <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Sales brochure</a></li>
                                        <li><a href="#">Custom Implementation</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>


        <!-- Carousel
        ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="<?php echo base_url(); ?>assets/images/slider1.png" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>ERP for product based business.</h1>
                            <p>
                            End to end business coverage under one software. Manages all your product,sellers,
                            pricing, billing, payments and stock.
                            </p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="second-slide" src="<?php echo base_url(); ?>assets/images/slider2.png" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Cutting edge features.</h1>
                            <p>Armed with instantaneous search, price compare, image attachment,analytics and reporting modules.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="third-slide" src="<?php echo base_url(); ?>assets/images/slider3.png" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Built on top of open source technologies.</h1>
                            <p>Built in HTML5,Twitter Bootstrap,AngularJS,CodeIgniter & MySQL.<br/>Sleek design,strong architecture. Ready to scale up.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
                 <div class="item">
                    <img class="fourth-slide" src="<?php echo base_url(); ?>assets/images/slider4.png" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Completely customizable.</h1>
                            <p>Open architecture of Sanchaar makes it easy to customize according to your business requirements.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->


        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4">
                    <img class="img-circle" src="<?php echo base_url(); ?>assets/frontpage/im1.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2>Products</h2>
                    <p>Manage store products in simplest and most innovative way.Our instant product dasboard makes everything about products availbale at your fingertips. </p>
                    <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="img-circle" src="<?php echo base_url(); ?>assets/frontpage/im3.png" alt="Generic placeholder image" width="140" height="140">
                    <h2>Sellers</h2>
                    <p>Sellers are the key revenue contributors. Manage seller accounts, their inventory and payments. Our seller dashboard enables you with everything that you need to manage sellers information.</p>
                    <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="img-circle" src="<?php echo base_url(); ?>assets/frontpage/im2.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2>Inventory</h2>
                    <p>Manage your store inventory like never before. Our innovative inventory linking and categorization features makes everyting about inventory available at just one click.</p>
                    <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Awesome product dashboard. <span class="text-muted">with maximum linking.</span></h2>
                    <p class="lead">Product to seller,inventory and analytics linking, so that you can browse every aspect of your business smoothly.Our super intelligent search feature powers you with multiple attribute search options.</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>assets/images/products_dashboard.png" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 col-md-push-5">
                    <h2 class="featurette-heading">Your pending payments.<br/><small class="text-muted">now easily traceble.</small></h2>
                    <p class="lead">Sanchaar helps you manage payments coming from sellers,customers on an easy to use integrated dashboard. You can see pending payments associated with every seller on just one click.</p>
                </div>
                <div class="col-md-5 col-md-pull-7">
                    <img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>assets/images/payment_bills.png"  alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Attach images with almost everything.<small class="text-muted">our image attachment feature.</small></h2>
                    <p class="lead">Never loose your business documents. Our image attachment feature lets you add multiple images with Products,Sellers,Inventory,Payment Bills and Tax Forms.
                    So that you always have your business documents at your fingertips.
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>assets/images/image_att.png" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->


            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2015 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>

        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>assets/frontpage//jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="<?php echo URL; ?>assets/bootstrap3/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="<?php echo base_url(); ?>assets/frontpage/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo base_url(); ?>assets/frontpage/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
