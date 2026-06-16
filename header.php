<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NPone - Dashboard</title>

    <base href="<?= base_url(); ?>">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Hind', sans-serif !important;
            font-size: 16px;
        }

        .nav-link span {
            font-size: 20px !important;
        }

        .collapse-item {
            font-size: 18px !important;
        }

        #dataTable thead th {
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #3659f5c7;
            text-align: center;
        }

        #dataTable tbody td {
            font-size: 18px;
            font-weight: 500;
            color: black;
        }

        /* .sidebar {
            width:250px;
            

        } */
    </style>

    <!-- <style>
        thead th.bg-bhavan,
        tbody td.bg-bhavan,
        tfoot th.bg-bhavan {
            background: #f9f46d8a !important;
            color: black !important;
        }

        thead th.bg-khali,
        tbody td.bg-khali,
        tfoot th.bg-khali {
            background: #6dcaf98a !important;
            color: black !important;
        }

        thead th.bg-jal,
        tbody td.bg-jal,
        tfoot th.bg-jal {
            background: #b3f96d8a !important;
            color: black !important;
        }

        thead th.bg-dey,
        tbody td.bg-dey,
        tfoot th.bg-dey {
            background: #f9f06d8a !important;
            color: black !important;
        }
    </style> -->


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <style>
        html,
        body {
            overflow-x: hidden;
        }

       
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1040;
            overflow-x: hidden;
        }

       
        #content-wrapper {
            margin-left: 14rem;
            /* SB Admin default sidebar width */
            width: calc(100% - 14rem);
        }

       
        .topbar {
            position: fixed;
            top: 0;
            left: 14rem;
            right: 0;
            z-index: 1050;
            background: #fff;
        }

        
        #content {
            padding-top: 80px;
        }

       
        body.sidebar-toggled #content-wrapper {
            margin-left: 6.5rem;
            width: calc(100% - 6.5rem);
        }

        body.sidebar-toggled .topbar {
            left: 6.5rem;
        }

       
        @media (max-width: 768px) {

            .sidebar {
                left: -14rem;
            }

            body.sidebar-toggled .sidebar {
                left: 0;
            }

            #content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                left: 0;
            }

            body.sidebar-toggled .topbar {
                left: 0;
            }
        }
    </style> -->

    <style>
        /* Prevent horizontal scroll */
        html,
        body {
            overflow-x: hidden;
        }

        /* Fixed sidebar (SAFE way) */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1040;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari */
        }

        /* Content respects sidebar automatically */
        #content-wrapper {
            margin-left: 14rem;
        }

        /* Fixed topbar */
        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 14rem;
            z-index: 1050;
        }

        /* push content below topbar */
        #content {
            padding-top: 80px;
        }

        /* COLLAPSED STATE (IMPORTANT) */
        body.sidebar-toggled #content-wrapper {
            margin-left: 6.5rem;
        }

        body.sidebar-toggled .topbar {
            left: 6.5rem;
        }

        /* mobile fix */
        @media (max-width: 768px) {
            #content-wrapper {
                margin-left: 0;
            }

            .topbar {
                left: 0;
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- <ul class="navbar-nav bg-gradient-primary sticky-top h-100 sidebar sidebar-dark accordion" id="accordionSidebar"> -->

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tasks"></i>
                </div>
                <div style='font-size:1.5rem' class="sidebar-brand-text mx-3">ओटीएमएस</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="Admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>डैशबोर्ड</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                ओटीएमएस प्रबंधन
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="Admin" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>ओटीएमएस प्रबंधन</span>
                </a>

            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Pages
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bhavankarPages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>भवन कर</span>
                </a>
                <div id="bhavankarPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                        <a class="collapse-item" href="Admin/registration">उपभोक्ता पंजिकरण</a>
                        <a class="collapse-item" href="Admin/searchRegistrationByWard">उपभोक्ता विवरण</a>
                        <a class="collapse-item" href="Admin/searchRegistrationByWardFin">कर गणना</a>
                        <a class="collapse-item" href="Admin/searchGeneratedDemand">कर की मांग</a>
                        <a class="collapse-item" href="Admin/searchByWardFinPayTax">कर जमा करें</a>
                        <a class="collapse-item" href="Admin/searchReceipt">कर की रसीद </a>
                        <a class="collapse-item" href="Admin/searchBigDueForm">वार्ड अनुसार बड़े बकायेदार</a>

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportPages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>रिपोर्ट</span>
                </a>
                <div id="reportPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                        <a class="collapse-item" href="Admin/searchReportByFinYear">अवधि अनुसार</a>
                        <a class="collapse-item" href="Admin/searchReportByWard">वार्ड अनुसार</a>
                        <a class="collapse-item" href="Admin/searchReportByDate">तिथि अनुसार संग्रह राशि</a>


                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterPages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>मास्टर</span>
                </a>
                <div id="masterPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                        <a class="collapse-item" href="Admin/houseLocation">भवन या भूमि अवस्थिति</a>
                        <a class="collapse-item" href="Admin/houseType">भवन के प्रकार</a>
                        <a class="collapse-item" href="Admin/financialYear">वित्तीय वर्ष </a>
                        <a class="collapse-item" href="<?php echo base_url('Admin/ward')  ?>">वार्ड </a>


                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white  topbar mb-4  shadow">
                    <!-- <nav class="navbar navbar-expand navbar-light bg-white  topbar mb-4 static-top shadow"> -->



                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">




                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="Login/logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->