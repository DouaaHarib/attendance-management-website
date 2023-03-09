<?php
$EST = simplexml_load_file('../../data/database.xml');
session_start();
// echo $_SESSION['matricule'];
if(isset($_GET['listeEtd'])){
    $matiere=$_GET['matiere'];
    $typeSeance=$_GET['typeSeance'];
    $matricule=$_GET['matricule'];
    
}
if(isset($_GET['matiere'])){
    $matiere=$_GET['matiere'];
    $typeSeance=$_GET['typeSeance'];
    $matricule=$_GET['matricule'];
    
}
// recuperation des info etudiant a partir du cne
function getEtudiant($cne){
    $EST = simplexml_load_file('../../data/database.xml');
    foreach($EST->etudiants->etudiant as $etudiant){
        if($etudiant['cne']== $cne ){
            $nom=$etudiant->nom;
            $prenom=$etudiant->prenom;
            $nomComplet=$nom." ".$prenom;
            return $nomComplet;
        }
        
    }
return "etudiant non trouve";
}
// supression d'un etudiant
if(isset($_GET['action'])) {
	$EST = simplexml_load_file('../../data/database.xml');
	$cne = $_GET['id'];
    $matiere=$_GET['matiere'];
    $typeSeance=$_GET['typeSeance'];
	$index = 0;
	$i = 0;
	foreach($EST->listes->liste->etudiant as $etudiant){
		if($etudiant['cne']==$cne){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($EST->listes->liste->etudiant[$index]);
	file_put_contents('../../data/database.xml', $EST->asXML());
    header("location:afficherListeEtd.php?matricule=$matricule&matiere=$matiere&typeSeance=$typeSeance");
}
// recuperation des valeure de permission a partir de matricule
function getajoutEtd($matricule){
    $EST = simplexml_load_file('../../data/database.xml');
    foreach($EST->users->user as $user){
        if($user['matricule']== $matricule ){
            $ajoutEtd=$user->permission['ajoutEtd'];
            return $ajoutEtd;
        }
        
    }
}

function getasuppEtd($matricule){
    $EST = simplexml_load_file('../../data/database.xml');
    foreach($EST->users->user as $user){
        if($user['matricule']== $matricule ){
            $suppEtd=$user->permission['suppEtd'];
            return $suppEtd;
        }
        
    }
}

function getmodifierEtd($matricule){
    $EST = simplexml_load_file('../../data/database.xml');
    foreach($EST->users->user as $user){
        if($user['matricule']== $matricule ){
            $modifierEtd=$user->permission['modifierEtd'];
            return $modifierEtd;
        }
        
    }
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
                <a class="nav-link" href="absences.php">
                <i class="fa-sharp fa-solid fa-list-check"></i>
                <!-- <i class="fa-light fa-list-check"></i> -->
                    <span>marker l'absence</span></a>
            </li>
            <!-- end Absence nav -->
            <!--  emplois du temps nav -->
            <li class="nav-item">
                <a class="nav-link " href="listeEtd.php">
                <i class="fa-solid fa-rectangle-list"></i>
                    <span>liste des etudiant</span>
                </a>
                
            </li>
            <!-- end emplois du temps nav -->
            <!--  historique d'absence nav -->
            <li class="nav-item">
                <a class="nav-link " href="historiqueAbsences.php?matricule=<?php echo $matricule ?>" >
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
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des etudiants </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CNE</th>
                                            <th>nom et prenom</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <form action="" method="post">
                                    <?php foreach($EST->listes->liste as $liste) { ?>
                                        <?php if($liste['matiere']==$matiere && $liste['typeseance']==$typeSeance){ ?>
	                                    <tr>
                                        <?php foreach($EST->listes->liste->etudiant as $etudiant) { ?>
		                                    <td><?php $cne=$etudiant['cne']; echo $cne; ?></td>
                                                    <td><?php  echo getEtudiant("$cne");  ?></td>
                                            <td><?php if(getmodifierEtd($matricule)=='1'){ ?> 
                                            <a href="modifierEtd.php?matricule=<?php echo $matricule; ?>&id=<?php echo $id=$cne; ?>&matiere=<?php echo $matiere; ?>&typeSeance=<?php echo $typeSeance; ?>">Edit</a> |<?php } ?>
                                            <?php if(getasuppEtd($matricule)=='1'){ ?> 
                                                <a href="afficherListeEtd.php?matricule=<?php echo $matricule; ?>&action=delete&id=<?php echo $cne; ?>&matiere=<?php echo $matiere; ?>&typeSeance=<?php echo $typeSeance; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                                <?php } ?>
                                            </td>
	                                    </tr>
                                        <?php } ?>
                                        <?php } ?>
	                                <?php } ?>
                                    </tbody>
                                </table>
                                <?php if(getajoutEtd($matricule)=='1'){ ?>
                                <button type="submit" name="ajouter" class="btn btn-primary" >ajouter</button>
                                <?php } ?>
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