<?php
session_start();
include_once('../../assets/include/config.php');

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== "admin"){
  header("location: $app_root");
}

$stmt = $db->prepare("SELECT COUNT(*) FROM users ;");
$stmt->execute();
$user_count = $stmt->fetchAll()[0][0];
$stmt = $db->prepare("SELECT COUNT(*) FROM history WHERE status = 'pending' ;");
$stmt->execute();
$pending_count = $stmt->fetchAll()[0][0];
$stmt = $db->prepare("SELECT COUNT(*) FROM history WHERE status = 'completed' ;");
$stmt->execute();
$completed_count = $stmt->fetchAll()[0][0];
$stmt = $db->prepare("SELECT COUNT(*) FROM history WHERE status = 'declined' ;");
$stmt->execute();
$declined_count = $stmt->fetchAll()[0][0];
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
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Patricia Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="../css/animate.css" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">

    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
         -->
    <link href="../css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <!-- Related File -->
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="fix-sidebar">
    <div id="app">
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
                    <li><a class="logo" href="../index.php">
                        <img class="dash-logo-view" src="../plugins/images/patricia/patriciax-logo-white.png" alt="Home">
                    </a></li>
                </ul>
                <!-- This is the message dropdown -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.Task dropdown -->
                    <!-- /.dropdown -->
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href="../">
                                <i class="fa fa-search"></i>
                            </a>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="../#">
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
                                    <a href="../#">
                                        <div class="user-img">
                                            <img src="../plugins/images/users/horpey.jpg" alt="user" class="img-circle">
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
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="../#">
                            <img src="../plugins/images/users/<?=$_SESSION['avatar']?>" alt="user-img" width="36" class="img-circle">
                            <b class="hidden-xs"><?=$_SESSION['first_name']?></b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated slideInUp">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                        <img src="../plugins/images/users/<?=$_SESSION['avatar']?>" alt="user" />
                                    </div>
                                    <div class="u-text">
                                        <h4><?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></h4>
                                        <p class="text-muted"><?=$_SESSION['email']?></p>
                                        <a href="../profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="../profile.php">
                                    <i class="ti-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="../history.php">
                                    <i class="ti-wallet"></i> History</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="../settings.php">
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
                            <img class="dash-logo" src="../plugins/images/patricia/patriciax-logo-white.png" alt="Home">
                        </span>
                    </h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="javascript:void(0)" class="waves-effect active">
                            <i data-icon="v" class="mdi mdi-av-timer fa-fw"></i>
                            <span class="hide-menu">Dashboard </span>
                        </a>
                        <a href="pending.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-lan-pending fa-fw"></i>
                            <span class="hide-menu">Pending </span>
                        </a>
                        <a href="completed.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-account-check fa-fw"></i>
                            <span class="hide-menu">Completed </span>
                        </a>
                        <a href="cancel.php" class="waves-effect">
                            <i data-icon="v" class="mdi mdi-account-off fa-fw"></i>
                            <span class="hide-menu">Cancelled </span>
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                            <i class="ti-settings text-white"></i>
                        </button> -->
                        <ol class="breadcrumb">
                            <!-- <li class="">
                                <a href="../index.php">Dashboard</a>
                            </li> -->
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


                <!-- Add Main Content -->
                <!-- /row -->

                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="panel wallet-widgets p-0 ">
                             <div class="panel-body analytics-info p-relative">
                                <img class="img-responsive img-col" src="../plugins/images/card-bg.png">
                                <h3 class="box-title mt-0 text-bold">Total Registered Users</h3>
                                <ul class="list-inline two-part">
                                    <li>
                                        <span class="text-danger"><?=$user_count?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="panel wallet-widgets p-0 ">
                             <div class="panel-body analytics-info p-relative">
                                <img class="img-responsive img-col" src="../plugins/images/card-bg-green.png">
                                <h3 class="box-title mt-0 text-bold">Completed Transactions</h3>
                                <ul class="list-inline two-part">
                                    <li>
                                        <span class="text-success"><?=$completed_count?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="panel wallet-widgets p-0 ">
                             <div class="panel-body analytics-info p-relative">
                                <img class="img-responsive img-col" src="../plugins/images/card-bg-yel.png">
                                <h3 class="box-title mt-0 text-bold">Pending Transactions</h3>
                                <ul class="list-inline two-part">
                                    <li>
                                        <span class="text-yellow"><?=$pending_count?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="panel wallet-widgets p-0 ">
                             <div class="panel-body analytics-info p-relative">
                                <img class="img-responsive img-col" src="../plugins/images/card-bg-red.png">
                                <h3 class="box-title mt-0 text-bold">Declined Transactions</h3>
                                <ul class="list-inline two-part">
                                    <li>
                                        <span class="text-danger"><?=$declined_count?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">All Transactions</h3>
                            <!-- <p class="text-muted m-b-30">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Username</th>
                                            <th>Email Address</th>
                                            <th>Conversion</th>
                                            <th>Amount</th>
                                            <th>Equivalence</th>
                                            <th>Amount Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $stmt = $db->prepare("SELECT users.username, users.email, history.transfer_from, history.transfer_to, history.amount, history.equivalence, history.usd_account_number, history.status, history.time FROM history LEFT OUTER JOIN users ON history.user_id = users.id");
                                      $stmt->execute();
                                      if($stmt->rowCount()){
                                          $history = $stmt->fetchAll(PDO::FETCH_OBJ);
                                      }else{
                                        $history = [];
                                      }
                                       ?>

                                       <?php foreach($history as $h){?>
                                         <tr>
                                             <td>08-12-18</td>
                                             <td><?=$h->username?></td>
                                             <td><?=$h->email?></td>
                                             <td><?=$h->transfer_from?>-<?=$h->transfer_to?></td>
                                             <td><?=$h->amount?></td>
                                             <td><?=$h->equivalence?></td>
                                             <td><?=$h->usd_account_number?></td>
                                             <td class="<?=$h->status?>"><?=$h->status?></td>
                                         </tr>
                         											<?php	}	?>
                                    </tbody>
                                </table>
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
</div>

    </body>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sidebar menu plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--Slimscroll JavaScript For custom scroll-->
    <script src="../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>

    <script src="../js/vue.min.js"></script>




    <!-- Custom Theme JavaScript -->
    <script src="../js/custom.min.js"></script>
    <script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
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

            $( ".btn-exchange" ).click(function( event ) {
                event.preventDefault();
                $('.form-x').slideUp();
                $('.scan-code').slideDown();


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

    <script type="text/javascript">

    var data = {
        test: "Hello World",
        convertFrom: null,
        convertTo: null,
        showMobileMenu: true

    }
    new Vue({
        el: '#app',
        data: data,
        methods: {
            toggleD: function(){
                this.isActive = !this.isActive;
              // some code to filter users
            }
        },
        mounted() {
        },
    })
</script>



</html>
