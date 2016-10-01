<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sunrise Systems | Web & Application Development </title>
    <!-- Font Family -->
    <link href='//fonts.googleapis.com/css?family=Raleway:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    {!! HTML::style('css/bootstrap.css') !!}
    {!! HTML::style('css/admins/animate.css') !!}
    {!! HTML::style('css/admins/font-awesome.css') !!}
    {!! HTML::style('css/user/owl.carousel.css') !!}
    {!! HTML::style('css/user/owl.theme.css') !!}
    {!! HTML::style('css/user/owl.transitions.css') !!}
    <!-- custom style sheet -->
    {!! HTML::style('css/user/sunsystems.css') !!}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="has-fixed-footer">
    <!-- Preloader -->
    <div class="preloader">
        <div class="itma">
            <div class="la-ball-scale-multiple la-2x">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div id="page-wrapper" class="page-wrapper">
      <header id="site-header" role="header">
        <div role="navigation" class="navbar sticky-navigation">
        <div class="very-top-header">
          <div class="container">
            <div class="header-top">
            <div class="very-top-left"><a class="call-on"><i class="fa fa-phone" aria-hidden="true"></i>
 (+91) 75886 07261</a> | <a href="mailto:contact@sunrisesystems.in"><i class="fa fa-envelope" aria-hidden="true"></i>
 contact@sunrisesystems.in</a></div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="navbar-header">
            <!-- NAVBAR EXPAND COLLAPSE ON MOBILE -->
            <button data-target="#sunrise-navigation" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- LOGO -->
            <a href="{!! URL::to('/') !!}" class="navbar-brand ss-brand" title="Sunrise Systems">
              {!! HTML::image('images/user/ss-logo.png', 'Sunrise Systems', array('class' => 'img-responsive')) !!}
            </a>
          </div>

          <div id="sunrise-navigation" class="navbar-collapse collapse">
            <!-- NAVIGATION LINK -->
            <ul id="menu-primary" class="nav navbar-nav navbar-right main-navigation">
              <li class="current"><a href="#home">Home</a></li>
              <li class=""><a href="#services">Our Services</a></li>
              <li><a href="#team">Our Team</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients Login <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="http://sunrisesystems.in/admin/login">Sunpet</a></li>
                  <li><a href="#">Modest App</a></li>
                </ul>
              </li>
              <li><a href="#contact">Reach Us</a></li>
            </ul>
          </div>

        </div>
        <!-- /END CONTAINER -->
      </div>
      </header>

      <!-- SECTION: Banner -->
      <section id="home" role="region" aria-label="banners" class="banners">
        <div class="home-page-slider" class="owl-carousel owl-theme">
          
          <div class="item">
            {!! HTML::image('images/user/banners/banner2.jpg', 'The Last of us', array('class' => '')) !!}
          </div>
          <div class="item">
            {!! HTML::image('images/user/banners/banner3.jpg', 'The Last of us', array('class' => '')) !!}
          </div>
          <div class="item">
            {!! HTML::image('images/user/banners/banner4.jpg', 'The Last of us', array('class' => '')) !!}
          </div>
        </div>
      </section>
      <!-- /.SECTION: banner -->
      
    <!-- SECTION: SERVICES -->
    <section aria-label="Services" role="region" id="services" class="services white-bg">
      <div class="section-overlay-layer">
        <div class="container">
          <!-- SECTION HEADER -->
          <div class="section-header">
            <h2 class="dark-text">Our Services</h2><div class="colored-line"></div>
            <div class="sub-heading">Share your idea with us, we will build it for you...</div>
          </div>

          <div id="our_services_wrap" class="services-wrap row">
            <div class="col-md-3 col-sm-2">
              <div class="service-box">
                <div class="single-service border-bottom-hover">
                  <div class="service-icon colored-text">
                    <span class="icon-basic-webpage-multiple"></span>
                  </div>
                  <h4 class="colored-text">System Applications (Web and Desktop)</h4>
                  <p>We have developed both web and desktop applications for our clients with all types of reports as per needs. We have a good experience in developing MIS applications for different types of industries including Banking, Manufacturing etc.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-2">
              <div class="service-box">
                <div class="single-service border-bottom-hover">
                  <div class="service-icon colored-text">
                    <span class="icon-basic-webpage-multiple"></span>
                  </div>
                  <h4 class="colored-text">Mobile Apps</h4>
                  <p>Unlike others, we have expertise in creating mobile app for MIS too, we have created mobile applications that displays summary and detailed reports on the go.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-2">
              <div class="service-box">
                <div class="single-service border-bottom-hover">
                  <div class="service-icon colored-text">
                    <span class="icon-basic-webpage-multiple"></span>
                  </div>
                  <h4 class="colored-text">Websites</h4>
                  <p>Our team is good in graphics and content writing for website. Your dream site is a discussion away from you, reach us @ our contact page.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-2">
              <div class="service-box">
                <div class="single-service border-bottom-hover">
                  <div class="service-icon colored-text">
                    <span class="icon-basic-webpage-multiple"></span>
                  </div>
                  <h4 class="colored-text">Customer Site Hosting</h4>
                  <p>Hassle free website and app hosting from our side. No worries if you don't have your hosting server, we will host as well as maintain your application at our end with minimal cost.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.services -->

    <!-- SECTION: Team -->
    <section aria-label="Team" role="region" id="team" class="team grey-bg">
      <div class="section-overlay-layer">
        <div class="container">
          <!-- SECTION HEADER -->
          <div class="section-header">
            <h2 class="dark-text">Our Teams</h2><div class="colored-line"></div>
          </div>
        
          <div id="out-team" class="our-team row">
            <div class="col-md-8 col-md-offset-2">
              <div class="team-block text-center">
                <p>Our team is small in number but big enough to convert your <strong>THOUGHTS</strong> in an <strong>APPLICATION</strong>.
      Team includes M. Tech Engineers with 7+ years of experience in website, database and application developments.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> <!-- Section: Team -->

     <!-- SECTION: Reach Us -->
    <section aria-label="contact" role="region" id="contact" class="reach-us my-grey-bg">
      <div class="section-overlay-layer">
        <div class="container">
          <!-- SECTION HEADER -->
          <div class="section-header">
            <h2 class="dark-text">Reach Us</h2><div class="colored-line"></div>
            <div class="sub-heading">Mail Us Your Message</div>
          </div>
        
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="reach-us-block">
                  <a href="mailto:contact@sunrisesystems.in" title="Sunrise Systems">contact@sunrisesystems.in</a>
                  <a href="javascript:void(0)" class="call-us-on">(+91) - 75886 07261</a>
              </div>
              <div class="copyright">
                <div class="logo-wrapper">
                  {!! HTML::image('images/user/ss-logo.png', 'Sunrise Systems', array('class' => 'img-responsive')) !!}
                </div>
                <div>Copyright 2016. All Rights Reserved</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    </div><!-- /.page-wrapper -->
    <a class="go-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! HTML::script('js/user/jquery.min.js') !!}
    {!! HTML::script('js/user/jquery-migrate-1.4.1.min.js') !!}
    {!! HTML::script('js/admins/jquery-ui.min.js') !!}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {!! HTML::script('js/bootstrap.js') !!}
    {!! HTML::script('js/user/owl.carousel.min.js')!!}
    {!! HTML::script('js/user/jquery.stellar.min.js')!!}
    {!! HTML::script('js/user/wow.min.js')!!}
    {!! HTML::script('js/user/main.js')!!}
  </body>
</html>