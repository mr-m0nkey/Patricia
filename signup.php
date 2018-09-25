<?php
session_start();

include_once('assets/include/config.php');
include_once('assets/include/validation.php');

if(isset($_SESSION['user_id'])){
  // TODO: check if the id is valid
  header('location: dashboard/index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['submit'])) {

    $username = test_input(filter_input(INPUT_POST, 'username'));
    $email = test_input(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $passy = test_input(filter_input(INPUT_POST, 'passy'));
    $confirm_passy = test_input(filter_input(INPUT_POST, 'confirm-passy'));

    // TODO: create functions to check if the username and email already exist in the database(to improve readability)
    try{
      $stmt = $db->prepare("SELECT username FROM users where username = ?");
      $stmt->execute([$username]);
      if(!$stmt->rowCount()){
        $stmt = $db->prepare("SELECT email FROM users where email = ?");
        $stmt->execute([$email]);
        if(!$stmt->rowCount()){
          $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
          $stmt->execute([$username, sha1($passy), $email]);
          $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
          $stmt->execute([$username]);
          $get = $stmt->fetch(PDO::FETCH_OBJ);
          // TODO: use reference instead of id
          $_SESSION['user_id'] = $get->id;
            header('location: dashboard/index.php');
        }else{
          $_SESSION['email_err'] = "Email exists";
        }
      }else{
          $_SESSION['username_err'] = "Username exists";
      }
    }catch(Exception $ex){
      $_SESSION['login_err'] = "An error occured";
      die($ex->getMessage());
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

</head>

<body class="index-page sidebar-collapse bg-overlay">
    <!-- Navbar -->
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
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.php#currencies">
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
    <!-- body content  -->

    <div class="container min-h">
        <div class="wizard-container">
                    <div class="card card-pricing card-raised">
                        <!-- <div class="card-header card-header-custom">
                                        <h6 class="category">Foodtics</h6>
                                    </div> -->
                        <div class="card-body">
                            <h3 class="m-0">Create an Account</h3>
                            <hr class="mb-4">
                            <form id ="sign-up-form" action="" method="post">
                              <?php // TODO: add divs for error messages.?>
                              <?php // TODO: implement client side validification ?>
                                <div class="form-group label-floating">
                                    <label class="control-label text-bold">Username</label>
                                    <input type="text" class="form-control sign-input" name="username" id="username">
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label text-bold">Email Address</label>
                                    <input type="email" class="form-control sign-input" name="email" id="email">
                                </div>
                                <div class="form-group label-floating mt-2">
                                    <label class="control-label text-bold">Password</label>
                                    <input type="password" class="form-control sign-input" name="passy" id="passy">
                                </div>
                                <div class="form-group label-floating mt-2">
                                    <label class="control-label text-bold">Confirm Password</label>
                                    <input type="password" class="form-control sign-input" name="confirm-passy" id="confirm-passy">
                                    <div id="confirm-passy-error" class="q-col-1-1">
                                      <?php // TODO: change colour to red ?>
                                    </div>
                                </div>
                                <div class="form-group label-floating mt-2">
                                    <input id="submit" type="submit" name="submit" class="btn btn-next btn-fill btp btn-wd btn-orange btn-block" value="Create Account">
                                </div>
                            </form>
                            <p>Already have an Account?
                                <a class="login" href="login.php">Log In</a>
                            </p>
                        </div>
                    </div>
                </div>
        <!-- row -->
    </div>
    <!--  big container -->
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
                            <form>
                                <div class="form-group">
                                    <input type="text" class= "form-control-md form-control contact-input partss" placeholder="Name" ">
                                </div>
                                <div class="form-group">
                                    <input type="email" class= "form-control-md form-control contact-input partss" placeholder="Email Address" ">
                                </div>
                                <div class="form-group"><!--
                                    <input type="email" class= "form-control-md form-control contact-input partss" placeholder="Email Address" "> -->
                                    <textarea class="form-control message-in" placeholder="Message" name="" rows="10"></textarea>
                                </div>
                                <button class="nav-link btn btn-lg btn-orange text-center btn-block">Send a Message</button>
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

    var submit = document.getElementById('submit');
    submit.addEventListener("click", function(e){
      // TODO: create validation methods to reduce clutter
      has_errors = false;
      var passy = document.getElementById('passy');
      var confirm_passy = document.getElementById('confirm-passy');
      if(passy.value != confirm_passy.value){
        document.getElementById('confirm-passy-error').innerHTML = "Passwords do not match";
        has_errors = true;
      }

      if(has_errors === true){
        e.preventDefault();
      }

    });
</script>

</html>
