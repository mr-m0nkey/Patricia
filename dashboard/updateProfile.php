<?php
session_start();
include_once('../assets/include/config.php');
include_once('../assets/include/upload.php');
include_once('../assets/include/validation.php');
include_once('../assets/include/helpers.php');

if(!isset($_SESSION['user_id'])){
    header('location: ../index.php');
}

if(isset($_POST['submit'])){
  $first_name = test_input(filter_input(INPUT_POST, 'first_name'));
  $last_name = test_input(filter_input(INPUT_POST, 'last_name'));
  $username = test_input(filter_input(INPUT_POST, 'username'));
  $email = test_input(filter_input(INPUT_POST, 'email'));
  $location = test_input(filter_input(INPUT_POST, 'location'));
  $state = test_input(filter_input(INPUT_POST, 'state'));
  $notifications = test_input(filter_input(INPUT_POST, 'notifications'));
  $avatar = $_SESSION['avatar'];
  if(!$notifications){
    $notifications = "off";
  }
  
  if(isset($_FILES['picture']['name'])){
    $upload = uploadImage($_FILES['picture'], $_SESSION['avatar']);
    if($upload){
      $avatar = $upload;
      $_SESSION['avatar'] = $avatar;
    }

  }
  try{
    $stmt = $db->prepare("SELECT username FROM users where username = ?");
    $stmt->execute([$username]);
    if(!$stmt->rowCount() || $username == $_SESSION['username']){
      $stmt = $db->prepare("SELECT email FROM users where email = ?");
      $stmt->execute([$email]);
      if(!$stmt->rowCount() || $email == $_SESSION['email']){
        $stmt = $db->prepare("UPDATE users SET username = ?, first_name = ?, last_name = ?, email = ?, location = ?, state = ?, notifications = ?, avatar = ? where username = ?");

        $stmt->execute([$username, $first_name, $last_name, $email, $location, $state, $notifications, $avatar, $_SESSION['username']]);
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $get = $stmt->fetch(PDO::FETCH_OBJ);
        // TODO: use reference instead of id
        $_SESSION['user_id'] = $get->id;
        $_SESSION['username'] = $get->username;
        $_SESSION['email'] = $get->email;
        $_SESSION['first_name'] = $get->first_name;
        $_SESSION['last_name'] = $get->last_name;
        $_SESSION['location'] = $get->location;
        $_SESSION['state'] = $get->state;
        $_SESSION['notifications'] = $get->notifications;
        $_SESSION['avatar'] = $get->avatar;
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


?>

<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>Patricia Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
         -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <!-- Related File -->
    <link href="plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="fix-sidebar">
    <!-- Preloader -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div> -->
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <!-- Toggle icon for mobile view -->
                <div class="top-left-part">
                    <!-- Logo -->

                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li>
                        <a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs">
                            <i class="ti-close ti-menu"></i>
                        </a>
                    </li>
                    <li><a class="logo" href="index.php">
                        <img class="dash-logo-view" src="plugins/images/patricia/patriciax-logo-white.png" alt="Home">
                    </a></li>
                </ul>
                <!-- This is the message dropdown -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.Task dropdown -->
                    <!-- /.dropdown -->
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#">
                            <i class="mdi mdi-bell"></i>
                            <div class="notify">
                                <span class="heartbit"></span>
                                <span class="point"></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu mailbox  animated slideInUp">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img">
                                            <img src="<?=$app_root?>dashboard/plugins/images/users/<?=$_SESSION['avatar']?>" alt="user" class="img-circle">
                                            <span class="profile-status online pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Seyike Sojirin</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);">
                                    <strong>See all notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                            <img src="<?=$app_root?>dashboard/plugins/images/users/<?=$_SESSION['avatar']?>" alt="user-img" width="36" class="img-circle">
                            <b class="hidden-xs"><?=$_SESSION['first_name']?></b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated slideInUp">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                        <img src="<?=$app_root?>dashboard/plugins/images/users/<?=$_SESSION['avatar']?>" alt="user" />
                                    </div>
                                    <div class="u-text">
                                        <h4><?=$_SESSION['first_name']?>  <?=$_SESSION['last_name']?></h4>
                                        <p class="text-muted"><?=$_SESSION['email']?></p>
                                        <a href="profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="profile.php">
                                    <i class="ti-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="history.php">
                                    <i class="ti-wallet"></i> History</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="settings.php">
                                    <i class="ti-settings"></i> Account Setting</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="<?=$app_root?>logout.php">
                                    <i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3>
                        <span class="fa-fw open-close">
                            <!-- <i class="ti-menu hidden-xs"></i> -->
                            <i class="ti-close visible-xs"></i>
                        </span>
                        <span class="hide-menu">
                            <img class="dash-logo" src="plugins/images/patricia/patriciax-logo-white.png" alt="Home">
                        </span>
                    </h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-av-timer fa-fw"></i>
                            <span class="hide-menu">Exchange </span>
                        </a>
                    </li>
                    <li>
                        <a href="history.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-history fa-fw"></i>
                            <span class="hide-menu">History </span>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-account fa-fw"></i>
                            <span class="hide-menu">Profile </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- ============================================================== -->

        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                            <i class="ti-settings text-white"></i>
                        </button> -->
                        <ol class="breadcrumb">
                            <li class="">
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


                <!-- Add Main Content -->
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="panel wallet-widgets p-0">
                            <div class="panel-body" style="min-height: 120px;">
                              <form class="form-horizontal form-material" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3 col-xs-3">
                                        <div class="user-profile">
                                            <div class="user-pro-body">
                                                <div>
                                                    <img id = "pic" src="<?=$app_root?>dashboard/plugins/images/users/<?=$_SESSION['avatar']?>" alt="user-img" class="img-circle">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input accept=".jpg, .jpeg, .png" type="file" name="picture" id="picture" style="display: none;">
                                    <div class="col-md-5 col-sm-5 col-xs-4">
                                        <div class="profile-action">
                                            <a id = "eee" href="profile.php" class="btn btn-white btn-exchange">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            <a href="#" class="btn btn-white btn-exchange">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>First Name</strong>
                                        <br>
                                       <input name="first_name" type="text" placeholder="First Name" value="<?=$_SESSION['first_name']?>" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>Last Name</strong>
                                        <br>
                                       <input name="last_name" type="text" placeholder="Last Name" value="<?=$_SESSION['last_name']?>" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>Username</strong>
                                        <br>
                                        <input name="username" type="text" placeholder="User Name" value="<?=$_SESSION['username']?>" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>Email ID</strong>
                                        <br>
                                        <input name="email" type="email" placeholder="Email ID" value="<?=$_SESSION['email']?>" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>Location</strong>
                                        <select name="location" class="form-control form-control-line profile-sel">
                                            <option <?=$_SESSION['location'] == 'Nigeria' ? 'selected' : ''?>>Nigeria</option>
                                            <option <?=$_SESSION['location'] == 'India' ? 'selected' : ''?>>India</option>
                                            <option <?=$_SESSION['location'] == 'Usa' ? 'selected' : ''?>>Usa</option>
                                            <option <?=$_SESSION['location'] == 'Canada' ? 'selected' : ''?>>Canada</option>
                                            <option <?=$_SESSION['location'] == 'Thailand' ? 'selected' : ''?>>Thailand</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>State</strong>
                                        <br>
                                        <select name="state" class="form-control form-control-line profile-sel">
                                            <option <?=$_SESSION['state'] == 'Lagos' ? 'selected' : ''?>>Lagos</option>
                                            <option <?=$_SESSION['state'] == 'Abuja' ? 'selected' : ''?>>Abuja</option>
                                            <option <?=$_SESSION['state'] == 'Oyo' ? 'selected' : ''?>>Oyo</option>
                                            <option <?=$_SESSION['state'] == 'Kaduna' ? 'selected' : ''?>>Kaduna</option>
                                            <option <?=$_SESSION['state'] == 'Ekiti' ? 'selected' : ''?>>Ekiti</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xs-6 m-b-20 b-r"> <strong>Notification</strong>
                                        <br>
                                        <p class="text-muted d-inline">Send Notification</p>
                                        <div class="m-b-30 m-l-30 d-inline">
                                            <input id="notif" name="notifications" value="<?=$_SESSION['notifications']?>" type="checkbox" <?=$_SESSION['notifications'] == 'on' ? 'checked' : ''?> class="js-switch" data-color="#ff6b00" data-size="small" />
                                        </div>
                                    </div>
                                </div>
                                <input name="submit" type="submit" class="btn btn-orange btn-exchange" value="Update Account Settings"/>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->



                <!-- Main Content -->

            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; Patricia </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sidebar menu plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--Slimscroll JavaScript For custom scroll-->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>



    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/bower_components/switchery/dist/switchery.min.js"></script>

    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {




          document.getElementById('pic').onclick = function(){
            document.getElementById('picture').click();
          }

          document.getElementById('picture').onchange = function(){
            var file    = document.getElementById('picture').files[0];
            var reader  = new FileReader();
            reader.onloadend = function () {
              document.getElementById('pic').src = reader.result;
            }
            if (file) {
              reader.readAsDataURL(file);
            }
          }


            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elems[0].onchange = function(){

              if(document.getElementById('notif').value === "on"){
                document.getElementById('notif').value = "off";
              }else{
                document.getElementById('notif').value = "on";
              }
            }
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' +
                                    group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>

</body>

</html>
