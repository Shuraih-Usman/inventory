<?php
require_once __DIR__.'/../config/init.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo APP_NAME; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">

    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/icon.css">

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/simple-line-icons/css/simple-line-icons.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/svg-weather.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/morris.js/morris.css">

    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="/assets/plugins/chartist/dist/chartist.css" type="text/css" media="all">



    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">

    <!-- Responsive.css-->
    <link href="/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/sweetalert.css">



    <style>

        .d-none {
            display: none !important;
        }

        .overlay2 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

       .overlay2 .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .shu-loader {
            width: 48px;
            height: 48px;
            border: 3px dotted #373a3c;
            border-style: solid solid dotted dotted;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            box-sizing: border-box;
            animation: rotation 2s linear infinite;
        }
        .shu-loader::after {
            content: '';
            box-sizing: border-box;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            border: 3px dotted #2196F3;
            border-style: solid solid dotted;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            animation: rotationBack 1s linear infinite;
            transform-origin: center center;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes rotationBack {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(-360deg);
            }
        }
    </style>

</head>

<body class="sidebar-mini fixed">

<div class="loader-bg">
    <div class="loader-bar">
    </div>
</div>
<div class="wrapper">
    <!-- Navbar-->
    <header class="main-header-top hidden-print">
        <a href="/" class="logo"><img class="img-fluid able-logo" src="/assets/images/logo2.jpg" width="300" height="50" alt="Theme-logo"></a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>

            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">

                <ul class="top-nav">
                    <!--Notification Menu-->


                    <!-- window screen -->
                    <li class="pc-rheader-submenu">
                        <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                            <i class="icon-size-fullscreen"></i>
                        </a>

                    </li>
             
                </ul>


            </div>
        </nav>
    </header>
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print ">
        <section class="sidebar" id="sidebar-scroll">
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                <li class="nav-level">--- Navigation</li>
                <li class="active treeview">
                    <a class="waves-effect waves-dark" href="/">
                        <i class="icon-speedometer"></i><span> Dashboard</span>
                    </a>
                </li>
                <li class="nav-level">--- Menu</li>
                <li class="treeview"><a class="waves-effect waves-dark" href="/c/product"><i class="icon-doc"></i><span> Products</span></a>
                </li>
                <li class="treeview"><a class="waves-effect waves-dark" href="/c/category"><i class="icon-folder-alt"></i><span> Category</span></a>
                </li>

                <li class="treeview"><a class="waves-effect waves-dark" href="/c/pos"><i class="icon-pin"></i><span> Make Order</span></a>
                </li>

                <li class="treeview"><a class="waves-effect waves-dark" href="/c/order"><i class="icon-chart"></i><span> Orders</span></a>
                </li>

                <li class="treeview"><a class="waves-effect waves-dark" href="/c/order-report"><i class="icon-chart"></i><span> Orders Report</span></a>
                </li>


                <li class="nav-level">--- More</li>

                <li class="treeview"><a class="waves-effect waves-dark" href="/c/setting"><i class="icon-settings"></i><span> Setting</span></a>
                </li>

                <li class="treeview"><a class="waves-effect waves-dark" href="/logout.php"><i class="icon-logout"></i><span> Logout</span></a>
                </li>

            </ul>
        </section>
    </aside>

    <div id="" class="overlay2 d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="shu-loader"></span>
        </div>
    </div>





