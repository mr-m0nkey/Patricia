<?php
session_start();
include_once('../assets/include/config.php');
if(!isset($_SESSION['user_id'])){
    header('location: ../index.php');
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
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                        <a href="javascript:void(0)" class="waves-effect active">
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
                        <h4 class="page-title">Start Exchange</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                            <i class="ti-settings text-white"></i>
                        </button> -->
                        <ol class="breadcrumb">
                            <li class="">
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">Exchange</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


                <!-- Add Main Content -->
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel wallet-widgets white-box p-0">
                                    <ul class="wallet-list">
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input v-on:click="showMobileMenu = !showMobileMenu" value="BTC" v-model="convertFrom" class="radiocheck" id="bitcoin" name="convertFrom" type="radio">
                                                <label class="label-for" for="bitcoin" name="convertFrom">Bitcoin</label>
                                                <!-- <span v-bind:class="{ hide: showMobileMenu }">
                                                    <span class="fa fa-check text-color pull-right check-icon"></span>
                                                </span> -->
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="PM" v-model="convertFrom" class="radiocheck" id="perfect" name="convertFrom" type="radio">
                                                <label class="label-for" for="perfect" name="convertFrom">Perfect Money</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="US" v-model="convertFrom" class="radiocheck" id="us" name="convertFrom" type="radio">
                                                <label class="label-for" for="us" name="convertFrom">US Dollars</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="NGN" v-model="convertFrom" class="radiocheck" id="naira" name="convertFrom" type="radio">
                                                <label class="label-for" for="naira" name="convertFrom">Naira</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="Cedis" v-model="convertFrom" class="radiocheck" id="cedis" name="convertFrom" type="radio">
                                                <label class="label-for" for="cedis" name="convertFrom">Ghana Cedis</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="Renminbi" v-model="convertFrom" class="radiocheck" id="renminbi" name="convertFrom" type="radio">
                                                <label class="label-for" for="renminbi" name="convertFrom">Renminbi</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel wallet-widgets p-0" style="margin-bottom: 8px!important;">
                                    <div class="panel-body" style="min-height: 334px;">
                                        <!-- <h3>Select Currency to Exchange</h3> -->
                                        <form class="form-horizontal form-x">
                                            <div class="form-group">
                                                <label class="col-md-12">{{convertFrom}} / {{convertTo}}: <span class="text-color">{{rate}}</span> <span class="help pull-right"> Rate: <span class="text-color">2%</span></span></label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" value="0" v-model="amount"> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" id="equivalent" class="form-control" value="0" v-model="equivalent" disabled> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" id="usd-account-number" value="" class="form-control" placeholder="USD Account Number"> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" id="email-address" value="" class="form-control" placeholder="Email Address"> </div>
                                            </div>
                                            <button class="btn btn-block btn-orange btn-exchange">Exchange</button>
                                        </form>

                                        <!-- Scan to Pay -->
                                        <div class="scan-code text-center">
                                            <p class="text-bold">Scan to pay into this Wallet</p>
                                            <img src="plugins/images/qr-code.png" class="img-fluid img-responsive">
                                            <p class="text-bold">or pay into this wallet address</p>
                                            <p class="qr-address">FHNDSKFD232MNDSDK2E2KS1021</p>
                                        </div>

                                        <!-- Scan to Pay -->
                                    </div>
                                </div>
                                <div class="panel wallet-widgets p-0">
                                    <div class="panel-body" style="min-height: 120px;">
                                        <!-- <h3>Select Currency to Exchange</h3> -->
                                        <div class="lds-css ng-scope">
                                            <div class="lds-spinner" style="100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel wallet-widgets white-box p-0">
                                    <ul class="wallet-list">
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input v-on:click="showMobileMenu = !showMobileMenu" value="BTC" v-model="convertTo" class="radiocheck" id="bitcoin2" name="convertTo" type="radio">
                                                <label class="label-for" for="bitcoin2" name="convertTo">Bitcoin</label>
                                                <!-- <span v-bind:class="{ hide: showMobileMenu }">
                                                    <span class="fa fa-check text-color pull-right check-icon"></span>
                                                </span> -->
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="PM" v-model="convertTo" class="radiocheck" id="perfect2" name="convertTo" type="radio">
                                                <label class="label-for" for="perfect2" name="convertTo">Perfect Money</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="US" v-model="convertTo" class="radiocheck" id="us2" name="convertTo" type="radio">
                                                <label class="label-for" for="us2" name="convertTo">US Dollars</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="NGN" v-model="convertTo" class="radiocheck" id="naira2" name="convertTo" type="radio">
                                                <label class="label-for" for="naira2" name="convertTo">Naira</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="Cedis" v-model="convertTo" class="radiocheck" id="cedis2" name="convertTo" type="radio">
                                                <label class="label-for" for="cedis2" name="convertTo">Ghana Cedis</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio radio-hide radio-circle radio-info">
                                                <input value="Renminbi" v-model="convertTo" class="radiocheck" id="renminbi2" name="convertTo" type="radio">
                                                <label class="label-for" for="renminbi2" name="convertTo">Renminbi</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="white-box">
                            <h3 class="box-title m-b-0">History</h3>
                            <!-- <p class="text-muted m-b-30">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Equivalence</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $stmt = $db->prepare("SELECT equivalence, transfer_from, transfer_to, usd_account_number, email, amount, status  FROM history WHERE user_id = ?");
                                      $stmt->execute([$_SESSION['user_id']]);
                                      if($stmt->rowCount()){
                                          $history = $stmt->fetchAll(PDO::FETCH_OBJ);
                                      }else{
                                        $history = [];
                                      }
                                       ?>

                                       <?php foreach($history as $h){?>
                                         <tr>
                                             <td><?=$h->amount?></td>
                                             <td><?=$h->transfer_from?></td>
                                             <td><?=$h->transfer_to?></td>
                                             <td><?=$h->equivalence?></td>
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

<script>




</script>

    </body>
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

    <script src="js/vue.min.js"></script>




    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        $(document).ready(function () {

            $( ".btn-exchange" ).click(function( event ) {
                event.preventDefault();
                if(!document.getElementById('email-address').value || !document.getElementById('usd-account-number').value || !document.getElementById('equivalent').value){
                  // TODO: validation
                }else {
                  pay();

                }

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


    function pay(){
      if(getCode(data.convertFrom) === "NGN" || getCode(data.convertFrom) === "USD" || getCode(data.convertFrom) === "GHS"){
        payWithPaystack();
      }else{
        $('.form-x').slideUp();
        $('.scan-code').slideDown();
        var send = {
          from: getCode(data.convertFrom),
          to: getCode(data.convertTo),
          usd: document.getElementById('usd-account-number').value,
          email: document.getElementById('email-address').value,
          amount: data.amount,
          equivalent: document.getElementById('equivalent').value,
          reference: response.reference
        }
        $.post("<?=$app_root?>/assets/include/exchange.php",send,function(d, s, x){

        });
      }



    }

    function payWithPaystack(){

      var handler = PaystackPop.setup({
        key: 'pk_test_bf7678f6e0542ee6771c8b072931e4f3fd0f67df',
        email: document.getElementById('email-address').value,
        amount: data.amount * 100,
        currency: getCode(data.convertFrom),

        callback: function(response){
            var send = {
              from: getCode(data.convertFrom),
              to: getCode(data.convertTo),
              usd: document.getElementById('usd-account-number').value,
              email: document.getElementById('email-address').value,
              amount: data.amount,
              equivalent: document.getElementById('equivalent').value,
              reference: response.reference
            }
            $.post("<?=$app_root?>/assets/include/exchange.php",send,function(d, s, x){

            });
        },
        onClose: function(){

        }
      });
      handler.openIframe();
    }

  //  payWithPaystack();

    function getCode(code){
      switch(code) {
        case "BTC":
            return code
            break;
        case "PM":
            return "pm_USD";
            break;
        case "US":
            return "USD";
            break;
        case "NGN":
            return code;
            break;
        case "Cedis":
            return "GHS";
            break;
        default:
            return null;
        }
    }



    var data = {
        test: "Hello World",
        convertFrom: null,
        convertTo: null,
        rate: 0.0,
        amount: 0,
        equivalent: 0,
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
        watch: {
          convertFrom: function(value){
            if(data.convertTo !== null){

              $.post("<?=$app_root?>/assets/include/converter.php",{ from: getCode(value), to: getCode(data.convertTo) },function(d, s, x){
                console.log(d);
                data.rate = JSON.parse(d).ratetoFixed(4);
                var i = data.rate * data.amount;
                data.equivalent = i.toFixed(2);
                console.log(data.amount);
              });
            }
          },

          convertTo: function(value){
            if(data.convertFrom !== null){
              $.post("<?=$app_root?>/assets/include/converter.php",{ from: getCode(data.convertFrom), to: getCode(value) }, function(d, s, x){
                console.log(d);
                data.rate = JSON.parse(d).rate.toFixed(4);
                var i =data.rate * data.amount;
                data.equivalent = i.toFixed(2);
                console.log(data.amount);
              });
            }
          },

          amount: function(value){
            var i = value * data.rate;
            data.equivalent = i.toFixed(2);
          }
        }
    })


</script>



</html>
