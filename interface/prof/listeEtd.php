<?php
$EST = simplexml_load_file('../../data/database.xml');
session_start();
// echo $_SESSION['matricule'];
if(isset($_GET['matricule'])){
    $matricule=$_GET['matricule'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>gestion d'absence</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/f251f5e598.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
</head>

<style>
    .formSend{
        /* background: red; */
        border: 3px solid #36b9cc;
        border-radius: 10px;
        padding: 50px;
        margin: 10px;
        /* display: grid; */
        display: flex;
        justify-content: center;
        grid-gap: 50px;
        
    }
</style>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="../../img/est.png" width="70 px" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">EST</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!--  absence nav -->
            <li class="nav-item active">
                <a class="nav-link" href="absences.php?matricule=<?php echo $matricule ;?>">
                <i class="fa-sharp fa-solid fa-list-check"></i>
                <!-- <i class="fa-light fa-list-check"></i> -->
                    <span>marker l'absence</span></a>
            </li>
            <!-- end Absence nav -->
            <!--  emplois du temps nav -->
            <li class="nav-item">
                <a class="nav-link " href="listeEtd.php?matricule=<?php echo $matricule ;?>">
                <i class="fa-solid fa-rectangle-list"></i>
                    <span>liste des etudiant</span>
                </a>
                
            </li>
            <!-- end emplois du temps nav -->
            <!--  historique d'absence nav -->
            <li class="nav-item">
                <a class="nav-link " href="historiqueAbsences.php" >
                <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>historique d'absence</span>
                </a>
                
            </li>
            <!-- end historique d'absence nav -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
        <!-- start page content -->
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Liste des etudiants</h1>

                    <!-- dropdown button filiere -->
                <form action="afficherListeEtd.php" method="get">
                <div class="dropdown mb-4 row g-3 formSend">
            <input type="text" name="matricule" value="<?php echo $matricule ;?>" hidden>
            <!-- dropdown button matiere -->
            
                <select class="btn bg-light border-bottom-primary dropdown-toggle" name="matiere" id="matiere">
                    <div class="dropdown-menu animated--fade-in">
                    <option selected class="dropdown-item" value="">matiere</option>   
                    <?php foreach($EST->matieres->matiere as $matiere) { ?>
                        <?php  if($matiere->enseignant['matricule']==$matricule){  ?>
                    <option class="dropdown-item" value="<?php echo $matiere['idMat']?>"><?php echo $matiere->nom ?> </option>
                    <?php } ?> 
                    <?php } ?>
                </div>
                </select>

                <select class="btn bg-light border-bottom-primary dropdown-toggle" name="typeSeance" id="typeSeance">
                    <div class="dropdown-menu animated--fade-in">
                    <option selected class="dropdown-item" value="">type Seance</option>    
                    <option class="dropdown-item" value="cours">cours</option>
                    <option class="dropdown-item" value="TP">TP</option>
                    <option class="dropdown-item" value="TD">TD</option>
                </div>
                </select>

            <!-- button suivant -->
            <button name="listeEtd" class="btn btn-info btn-icon-split" >
                <span class="text">afficher la liste</span>
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
            </button>
        </div>
        </form>
        <!-- End page content -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>

</html>