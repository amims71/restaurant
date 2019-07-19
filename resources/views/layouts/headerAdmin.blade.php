<?php

$con=mysqli_connect('localhost','root','','restaurant');
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$users='';
$orders = '';
$reservation='';
$foods='';
$dashboard='';


$uri=$_SERVER['REQUEST_URI'];
switch ($uri) {
    case '/admin/users':
        $users='class="active"';
        break;
    case '/admin/orders':
        $orders='class="active"';
        break;
    case '/admin/reservation':
        $reservation='class="active"';
        break;
    case '/admin/foods':
        $foods='class="active"';
        break;
    default:
        $dashboard='class="active"';
        break;
}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="favicon.png" rel="shortcut icon" type="image/x-icon">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">


<link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link href="../css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/custom-style.css" rel="stylesheet">

    <link href="../css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <!--CSS for Image Uploaded -->
    <link href="../css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <!--Datbase table view-->
    <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
     <link href="../css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="../user.png" width="100px" height="100px"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold"><?php //echo$user;?></strong>
                             </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        Restaurant
                    </div>
                </li>
                <li <?php echo $dashboard;?>>
                    <a href="{{route('admin')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></span>
                    </a>
                </li>
                <li <?php echo $users; ?>>
                    <a href="{{route('users')}}"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a>
                </li>
                <li <?php echo $orders; ?>>
                    <a href="{{route('orders')}}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span></a> 
                </li>
                 <li <?php echo $reservation; ?>>
                    <a href="{{route('reservation')}}"><i class="fa fa-calendar-check-o"></i> <span class="nav-label">Reservation</span></a>
                </li>
                <li <?php echo $foods; ?>>
                    <a href="{{route('foods')}}"><i class="fa fa-cutlery"></i> <span class="nav-label">Foods</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!--        put sidebar on start of page-wrapper -->
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm welcome-message">Welcome Admin</span>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        <div class="row  border-bottom "></div>


@yield('body')


 <div class="footer">

                    <div>
                        <strong>Copyright</strong>Amimul &copy; <strong id="ff"></strong>
                    </div>
                </div>


    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../js/plugins/select2/select2.full.min.js"></script>

    <!-- Peity -->
    <script src="../js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="../js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../js/plugins/toastr/toastr.min.js"></script>
 <script src="../js/plugins/clockpicker/clockpicker.js"></script>

    <script>
        <?php //echo $login; ?>
    </script>
    <script type="text/javascript">n =  new Date();y = n.getFullYear();m = n.getMonth() + 1;d = n.getDate();document.getElementById('ff').innerHTML =y;document.getElementById('asd').value=m+'/'+d+'/'+y;document.getElementById('asdf').value=m+'/'+d+'/'+y;
    </script>


</div>

   </div>
</body>
</html>
