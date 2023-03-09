<?php
$EST = simplexml_load_file('../../data/database.xml');
// supression de user
if(isset($_GET['action'])) {
	$EST = simplexml_load_file('../../data/database.xml');
	$idUser = $_GET['id'];
	$index = 0;
	$i = 0;
	foreach($EST->users->user as $user){
		if($user['matricule']==$idUser){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($EST->users->user[$index]);
	file_put_contents('../../data/database.xml', $EST->asXML());
    header("location:users.php");
}

// ajout user code
if(isset($_GET['ajoutUser'])) {
$matricule=$_GET['matricule'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$role=$_GET['role'];

$user = $EST->users->addChild('user');
$user->addAttribute('matricule', $matricule);
$user->addAttribute('role', $role);
$user->addChild('login',);
$user->addChild('password',);
$user->addChild('nom', $nom);
$user->addChild('prenom', $prenom);

$permission=$user->addChild('permission',);
$permission->addAttribute('ajoutEtd',0 );
$permission->addAttribute('suppEtd', 0);
$permission->addAttribute('modifierEtd',0 );
$permission->addAttribute('suppAbscence',0 );



file_put_contents('../../data/database.xml', $EST->asXML());
header("location:users.php");
}




// modifier info user
if(isset($_GET['modifier'])) {
    foreach($EST->departements->departement as $departement){
		if($departement['idDept']==$_GET['idDept']){
			$departement->nom = $_GET['nomDept'];
			$departement->chefDept = $_GET['chefDept'];
			break;
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                    <h1 class="h3 mb-2 text-gray-800">Utilisateurs</h1>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">utilisateurs </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>matricule</th>
                                            <th>nom </th>
                                            <th>prenom </th>
                                            <th>role</th>
                                            <th>modification</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php foreach($EST->users->user as $user) { ?>
	                                    <tr>
		                                    <td><?php echo $user['matricule']; ?></td>
                                            <td><?php echo $user->nom; ?></td>
                                            <td><?php echo $user->prenom ?></td>
                                            <td><?php echo $user['role'] ?></td>
                                            <td><a href="usersModification.php?id=<?php echo $id=$user['matricule']; ?>">Edit</a> |
                                                <a href="users.php?action=delete&id=<?php echo $user['matricule']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
	                                    </tr>
	                                <?php } ?>
                                    </tbody>
                                </table>

    <!-- button ajout user -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Ajout user</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="get" action="">
            <div class="mb-3">
                <label for="idDept" class="col-form-label">matricule:</label>
                <input type="text" name="matricule" class="form-control" id="idDept">
            </div>
            <div class="mb-3">
                <label for="nomDept" class="col-form-label">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nomDept"></input>
            </div>

            <div class="mb-3">
                <label for="nomDept" class="col-form-label">prenom :</label>
                <input type="text" class="form-control" name="prenom" id="nomDept"></input>
            </div>

            <div class="mb-3">
            <label for="chefDept" class="col-form-label">role:</label>
            <select class="form-select" name="role" aria-label="Default select example">
                <option selected>choisir...</option>
                <option value="superAdmin">superAdmin</option>
                <option value="chefDept">chefDept</option>
                <option value="chefFiliere">chefFiliere</option>
                <option value="prof">prof</option>
                <option value="agentScolarite">agentScolarite</option>
                
            </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
            <button type="submit" name="ajoutUser" class="btn btn-primary">ajout</button>
            
            </form>
        </div>
        </div>
        </div>
    </div>
    </div>
    <!-- End ajout user -->
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