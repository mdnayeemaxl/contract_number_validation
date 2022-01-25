<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");
$userid=$_SESSION["userId"];
$actType=$_SESSION["actType"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="signout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
		
		
		
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

							
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

									        <a class="nav-link" href="uploadFile.php">File Upload</a>
                                            <a class="nav-link" href="Users.php">File and Group info</a>
                                            <a class="nav-link" href="signout.php">Logout</a>
                                   
                                </nav>
                            </div>


                        </div>
                    </div>

                </nav>
            </div>
			
			
			
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>		
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Date & Time</th>
                                            
                                        </tr>
                                    </thead>


                                    <?php

                                        $gName=$_GET['name'];
                                        
                                        $sql= "SELECT * FROM contract WHERE groupName='$gName'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) { 
                                            $number=$row["number"];
                                            
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php 
                                                    echo $number;
                                                ?>
                                            </td> 
                                            <td>          
                                                <?php 
                                                    echo $row["firstName"];
                                                ?>                               
                                            </td>
                                            <td>          
                                                <?php 
                                                    echo $row["lastName"];
                                                ?> 
                                             </td>  
                                             <td>          
                                                <?php 
                                                    echo $row["email"];
                                                ?>                               
                                            </td>
                                            <td>          
                                                <?php 
                                                    echo $row["state"];
                                                ?> 
                                             </td> 
                                             <td>          
                                                <?php 
                                                    echo $row["zip"];
                                                ?>                               
                                            </td>
                                            <td>          
                                                <?php 
                                                    echo $row["dateTime"];
                                                ?> 
                                             </td>                             
  
  
                                        </tr>

                                    </tbody>
                                    
                                    <?php }
                                    } else {
                                        echo "0 results";
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </table>
                            </div>
                        </div>
						
						
						
                    </div>
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
