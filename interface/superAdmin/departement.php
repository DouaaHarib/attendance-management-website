<?php
$EST = simplexml_load_file('../../data/database.xml');
session_start();
    if(isset($_GET['matricule'])){
        $matricule=$_GET['matricule'];
        foreach($EST->users->user as $user){
            if($user['matricule']==$_GET['matricule']){
                $username=$user->nom." ".$user->prenom;
            }
        }
    }
// supression de departement
if(isset($_GET['action'])) {
	$EST = simplexml_load_file('../../data/database.xml');
	$idDept = $_GET['id'];
	$index = 0;
	$i = 0;
	foreach($EST->departements->departement as $departement){
		if($departement['idDept']==$idDept){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($EST->departements->departement[$index]);
	file_put_contents('../../data/database.xml', $EST->asXML());
    header("location:departement.php?matricule=$matricule");
}

// ajout departement code
if(isset($_GET['ajoutDept'])) {
$idDept=$_GET['idDept'];
$nomDept=$_GET['nomDept'];
$chefDept=$_GET['chefDept'];

$departement = $EST->departements->addChild('departement');
$departement->addAttribute('idDept', $idDept);
$departement->addChild('nom', $nomDept);
$chefDeptElm=$departement->addChild('chefDept', );
$chefDeptElm->addAttribute('matricule', $chefDept);
file_put_contents('../../data/database.xml', $EST->asXML());
header("location:departement.php?matricule=$matricule");
}


// recuperation du nom chef departement a partir du matricule
function getChefDept($matricule){
    $EST = simplexml_load_file('../../data/database.xml');
    foreach($EST->users->user as $user){
        if($user['matricule']== $matricule && $user['role']=="chefDept"){
            $nom=$user->nom;
            $prenom=$user->prenom;
            $nomComplet=$nom." ".$prenom;
            return $nomComplet;
        }
        
    }
return "chef dept non definie";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/f251f5e598.js" crossorigin="anonymous"></script>
    
    <!-- Custom styles for this template-->
    
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
    

</head>

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
                <a class="nav-link" href="./index.php">
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
                <a class="nav-link" href="departement.php">
                    <!-- <i class="fas fa-user-cog"></i> -->
                    <i class="fa-solid fa-building-user"></i>
                    <!-- <i class="fa-solid fa-buildings"></i> -->
                    <span>Departement</span></a>
            </li>
            <!-- end Absence nav -->
            <!--  emplois du temps nav -->
            <li class="nav-item ">
                <a class="nav-link " href="filiere.php">
                <i class="fa-solid fa-gear"></i>
                    <span>filiere</span>
                </a>
                
            </li>
            <!-- end emplois du temps nav -->
            <!--  historique d'absence nav -->
            <li class="nav-item">
                <a class="nav-link " href="users.php" >
                <i class="fa-solid fa-users"></i>
                    <span>utilisateures</span>
                </a>
                
            </li>
            <!-- end historique d'absence nav -->
            <li class="nav-item">
                <a class="nav-link " href="autorisation.php" >
                <i class="fa-solid fa-lock-open"></i>
                    <span>gestion des autorisation</span>
                </a>
                
            </li>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                    <h1 class="h3 mb-2 text-gray-800">Departements</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Departement </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Departement</th>
                                            <th>nom </th>
                                            <th>chef departement</th>
                                            <th>modification</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php foreach($EST->departements->departement as $departement) { ?>
	                                    <tr>
		                                    <td><?php echo $departement['idDept']; ?></td>
                                            <td><?php echo $departement->nom; ?></td>
                                            <?php $matriculeChef=$departement->chefDept['matricule']; ?>
                                            <td><?php echo getChefDept("$matriculeChef") ?></td>
                                            <!-- data-bs-toggle="modal" data-bs-target="#exampleModifier" -->
                                            <td><a  
                                            href="departementModification.php?id=<?php echo $id=$departement['idDept']; ?>&matricule=<?php echo $matricule ?>">Edit</a> |
                                                <a href="departement.php?action=delete&id=<?php echo $departement['idDept']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
	                                    </tr>
	                                <?php } ?>
                                    </tbody>
                                </table>

    <!-- button ajout departement -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Ajout departement</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout departement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="get" action="">
            <div class="mb-3">
                <label for="idDept" class="col-form-label">ID departement:</label>
                <input type="text" name="idDept" class="form-control" id="idDept">
            </div>
            <div class="mb-3">
                <label for="nomDept" class="col-form-label">Nom departement:</label>
                <input type="text" class="form-control" name="nomDept" id="nomDept"></input>
            </div>
            
            <div class="mb-3">
            <label for="chefDept" class="col-form-label">Chef departement:</label>
            <select class="form-select" name="chefDept" aria-label="Default select example">
                <option selected>choisir le chef de departement</option>
                <?php foreach($EST->users->user as $user) { ?>
                    <?php  if($user['role']=="chefDept"){  ?>
                <option value="<?php echo $user['matricule'] ?>"><?php echo $user->nom." ".$user->prenom ;?></option>
                <?php } ?> 
                
                <?php } ?>
            </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
            <button type="submit" name="ajoutDept" class="btn btn-primary">ajout</button>
            
            </form>
        </div>
        </div>
        </div>
    </div>
    </div>
    <!-- End ajout departement -->
    <!-- modification form -->
    
    <!-- End modification form -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>


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