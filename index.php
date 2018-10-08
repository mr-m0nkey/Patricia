<?php
include_once('assets/include/config.php');
include_once('assets/include/validation.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['submit'])) {
    $name = test_input(filter_input(INPUT_POST, 'name'));
    $mail = test_input(filter_input(INPUT_POST, 'mail'));
    $message = test_input(filter_input(INPUT_POST, 'message'));

    try{
      $stmt = $db->prepare("INSERT INTO messages (email, name, message) VALUES (?, ?, ?)");
      $stmt->execute([$mail, $name, $message]);
    }catch(Exception $ex){


    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.svg">
    <link rel="icon" type="image/png" href="assets/img/favicon.svg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Patricia</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
    />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />

    <link href="./assets/css/demo.css" rel="stylesheet" />
    <link href="./assets/css/custom.css" rel="stylesheet" />

    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="assets/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="assets/slick/slick-theme.css"/>

     <!-- Scroll -->
    <link href="assets/scroll/scrolling-nav.css" rel="stylesheet">

    <script src="dashboard/js/vue.min.js"></script>

</head>

<body class="index-page sidebar-collapse">
    <nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent" color-on-scroll="10">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/patriciax-logo.png" class="img-fluid img-white" alt="">
                    <img src="assets/img/patriciax-logo-blue.png" class="img-fluid img-blue" alt="">
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#currencies">
                            <p>Currencies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#contactForm" style="font-size: 14px;">
                           Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="faq.php" class="nav-link" style="font-size: 14px;">
                           FAQ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="font-size: 14px;">
                            Log In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-white" href="signup.php">
                            <p>Sign Up</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <div class="page-header page-header-custom clear-filter">
            <div class="page-header-image bg-overlay" data-parallax="false">
            </div>
            <div class="container">
                <div class="content-center brand text-left">
                    <div class="row" id="exchange">
                        <div class="col-md-5">
                            <p class="text-greyy safer">The Faster, cheaper and Safer way to</p>
                            <h1 class="mb-2 exh">Exchange <a href="" class="typewrite text-color" data-period="2000" data-type='["Bitcoin", "Dollar","Cedis"]'>
                                <span class="wrap"></span>
                              </a></h1>
                            <!-- Exchange Input -->
                            <div class="btn-group select-wide" role="group" aria-label="Basic example">
                                <select class="form-control br-l patri-select partss partss-r" v-model="from_currency">
                                  <option value="USD">USD</option>
                                  <option value="BTC">BTC</option>
                                  <option value="ETH">ETH</option>
                                  <option value="NGN">NGN</option>
                                  <option value="GHS">GHS</option>
                                  <option value="RMB">RMB</option>
                                </select>
                                <select class="form-control patri-select partss partss-l" v-model="to_currency">
                                  <option value="USD">USD</option>
                                  <option value="BTC">BTC</option>
                                  <option value="ETH">ETH</option>
                                  <option value="NGN">NGN</option>
                                  <option value="GHS">GHS</option>
                                  <option value="RMB">RMB</option>
                                </select>
                            </div>
                            <p class="total">Total fee 2% - $6</p>
                            <div class="btn-group select-wide" role="group" aria-label="Basic example">
                                <input type="number" class= " quantity form-control br-l patri-select text-color partss partss-r" placeholder="Value" v-model="from_amount">
                                <input type="number" class= " quantity form-control patri-select text-color partss partss-l" placeholder="Converted Value" v-model="to_amount.toFixed(2)" disabled>
                            </div>
                            <p>Exchange rate - 1{{from_currency}} /{{rate.toFixed(2)}}{{to_currency}}</p>
                            <a class="nav-link btn btn-lg btn-orange text-left" href="#">Get Started
                                <span class="pull-right fa fa-chevron-right"></span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <img src="assets/img/illustration.png" class="img-fluid land-illust" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="why-choose bg-blue">
                <div class="container" id="what-we-do">
                    <div class="how-it text-center">
                        <h3>Why Choose Patricia Exchange</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="info info-hover text-center">
                                <div class="iconny">
                                    <img src="assets/img/low-exchange.png" class="img-fluid" alt="">
                                </div>
                                <h5 class="no-margin">Low exchange rate</h5>
                                <p class="text-greyy">Our Platform makes it very easy to make exchange seamlessly</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info info-hover text-center">
                                <div class="iconny">
                                    <img src="assets/img/faster.png" class="img-fluid" alt="">
                                </div>
                                <h5 class="no-margin">Faster</h5>
                                <p class="text-greyy">Make an exchange in less than three steps</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info info-hover text-center">
                                <div class="iconny">
                                    <img src="assets/img/trusted.png" class="img-fluid" alt="">
                                </div>
                                <h5 class="no-margin">Trusted</h5>
                                <p class="text-greyy">We guarantee that your details are secure with us</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="think text-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="assets/img/safe.png" class="img-fluid safe-img">
                        </div>
                        <div class="col-md-5 think-x">
                            <h4 class="movedd">Think Exchange, Think Patricia</h4>
                            <p>Did we mention we are the fastest, safest and easiest way to Buy or turn Bitcoin/Ethereum/Perfect money to cash in the Digital Space?</p>
                            <div class="">
                                <a class="btn-lg btn btn-white" href="#">
                                Buy Now
                                </a>
                                <a class="btn-lg btn btn-orange" href="#">
                                    Sell Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="exchange" id="currencies">
                <div class="container">
                    <div class="how-it text-center">
                        <h3 class="text-color no-margin">Our Exchange Currencies</h3>
                        <p class="text-greyy">Patricia exchange has over five currencies you <br>convert to.
                    </div>
                    <div class="row text-center text-white">
                        <div class="col-6 col-lg-2 border-right">
                            <img src="assets/img/currencies/perfect.png" class="img-fluid rotating mb-3">
                            <p>Perfect Money</p>
                        </div>
                        <div class="col-6 col-lg-2 border-right">
                            <img src="assets/img/currencies/dollar.png" class="img-fluid rotating mb-3">
                            <p>Dollar</p>
                        </div>
                        <div class="col-6 col-lg-2 border-right">
                            <img src="assets/img/currencies/cedi.png" class="img-fluid rotating mb-3">
                            <p>Ghana Cedis</p>
                        </div>
                        <div class="col-6 col-lg-2 border-right">
                            <img src="assets/img/currencies/naira.png" class="img-fluid rotating mb-3">
                            <p>Naira</p>
                        </div>
                        <div class="col-6 col-lg-2 border-right">
                            <img src="assets/img/currencies/bitcoin.png" class="img-fluid rotating mb-3">
                            <p>Bitcoin</p>
                        </div>
                        <div class="col-6 col-lg-2">
                            <img src="assets/img/currencies/rmb.png" class="img-fluid rotating mb-3">
                            <p>Renminbi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customer text-center">
                <div class="container">
                    <h3 class="text-color mb-5">What our loyal Customers say.</h3>
                    <!-- Testimonial Slider -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active" style="margin-bottom: 30px;">
                                <p class="text-greyy mb-40" style="margin: 0 auto;
                                max-width: 600px;">"Patricia exchange is really awesome, in less than 24hours I got my Money transferred to my bank account"</p>
                                <p class="mt-3 text-bold text-ll">Seyike Sojirin</p>
                            </div>
                            <div class="carousel-item" style="margin-bottom: 30px;">
                                <p class="text-greyy mb-40" style="margin: 0 auto;
                                max-width: 600px;">"Patricia exchange is really awesome, in less than 24hours I got my Money transferred to my bank account"</p>
                                <p class="mt-3 text-bold text-ll">Micheal Joe</p>
                            </div>
                            <div class="carousel-item" style="margin-bottom: 30px;">
                                <p class="text-greyy mb-40" style="margin: 0 auto;
                                max-width: 600px;">"Patricia exchange is really awesome, in less than 24hours I got my Money transferred to my bank account"</p>
                                <p class="mt-3 text-bold text-ll">Patricia James</p>
                            </div>
                        </div>


                        <ol class="carousel-indicators" style="bottom: -50px">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                        </ol>
                    </div>

                    <!-- Testimonial Slider -->
                </div>
            </div>
            <div class="logo-bg">
                <div class="container">
                    <div class="logos">
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                      <div>
                          <img src="assets/img/patricia-logo.png" class="img-fluid">
                      </div>
                    </div>
                </div>
            </div>
            <div class="patricia-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="assets/img/patriciax-logo.png" class="img-fluid footer-img" alt="">
                            <p style="color: #88899d">
                                The Faster cheaper and Safer way to exchange Bitcoin, Dollars, Cedis, Perfect Money, and Renminbi
                            </p>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3 text-white">
                            <p>COMPANY</p>
                            <ul class="list-style-none footer-ul">
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 text-white">
                            <p>SUPPORT</p>
                            <ul class="list-style-none footer-ul">
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                                <li>
                                    <a href="#">FAQ's</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#contactForm">Contact Us</a>
                                </li>
                            </ul>
                        </div>


                        <div class="col-md-2">
                            <div class="socials">
                                <a class="social-icons" href="#" target="_blank" rel="noopener">
                                    <span class="fa fa-facebook"></span>
                                </a>
                                <a class="social-icons" href="#" target="_blank" rel="noopener">
                                    <span class="fa fa-twitter"></span>
                                </a>
                                <a class="social-icons" href="#" target="_blank" rel="noopener">
                                    <span class="fa fa-instagram"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p class="text-greyy patri">Copyright &copy; 2018 PatriciaExchange</p>
                </div>
            </div>
        </div>


        <!-- Contact Modal -->
                    <!-- Modal Core -->
                    <div class="modal fade" id="contactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" class= "form-control-md form-control contact-input partss" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class= "form-control-md form-control contact-input partss" placeholder="Email Address"  name="mail">
                                </div>
                                <div class="form-group"><!--
                                    <input type="email" class= "form-control-md form-control contact-input partss" placeholder="Email Address" "> -->
                                    <textarea class="form-control message-in" placeholder="Message" rows="10" name="message"></textarea>
                                </div>
                                <button class="nav-link btn btn-lg btn-orange text-center btn-block" name="submit">Send a Message</button>
                            </form>
                          </div>
                          <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-info btn-simple">Save</button>
                          </div> -->
                        </div>
                      </div>
                    </div>

                    <!-- Contact Modal -->

</body>
<!--   Core JS Files   -->
<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<!-- Slider Slider -->
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/slick/slick.min.js"></script>

<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
<script src="./assets/js/script.js" type="text/javascript"></script>
<script src="./assets/js/typewritter.js" type="text/javascript"></script>
<!-- Scrolling Nav JavaScript -->
<script src="assets/scroll/jquery.easing.min.js"></script>
<script src="assets/scroll/scrolling-nav.js"></script>



<script type="text/javascript">
    $('.logos').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 3,
      autoplay: true,
      arrows: false,
      autoplaySpeed: 2000
    });

    $('.img-blue').hide();
    function scrollToDownload() {
        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    };
    $(window).scroll(function(){
        if ($(window).scrollTop() > 100){
            $('.img-blue').show();
            $('.img-white').hide();
        }else{
            $('.img-blue').hide();
            $('.img-white').show();
        }
    });

    var app = new Vue({
        el: '#exchange',
        data: {
          from_currency: "USD",
          to_currency: "BTC",
          from_amount: 0,
          to_amount: 0,
          rate: 1
        },

        watch: {
          from_amount: function(value){
            $.post("<?=$app_root?>assets/include/converter.php",{ from: app.from_currency, to: app.to_currency },function(d, s, x){
              response = JSON.parse(d);
              app.to_amount = value * response.rate;
              app.rate = response.rate;
            });

          }
        }

    })
</script>

</html>
