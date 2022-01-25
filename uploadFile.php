<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");
$userid=$_SESSION["userId"];
?>

<?php
if(isset($_POST['submit'])){

    $givenName=$_POST['Name'];

    
    $splitPoint=$_POST['splitPoint'];
    $splitPoint=(int)$splitPoint;
    echo $splitPoint;


    $file=$_FILES['file'];
    $fileName=$_FILES['file']['name'];
    $fileType=$_FILES['file']['type'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));
    $allowedFileExt=array('txt');
    if(in_array($fileActualExt,$allowedFileExt)){
        $fileDestination ='Uploads/'.$fileName;
        move_uploaded_file($fileTmpName,$fileDestination);
    }
    else echo "Wrong File Formate";

    $fileContentCount=0;
    $proceedCount=1;
    $totalProcess=0;
    $groupCount=1;

    $myFile=fopen(('Uploads/'.$fileName),"r");
    while(!feof($myFile)){
        $content=fgets($myFile);
        $fileContentCount++;
        $carray=explode(",",$content);
        $number=$carray[0];
        $firstName=$carray[1];
        $lastName=$carray[2];
        $email=$carray[3];
        $state=$carray[4];
        $zip=$carray[5];

        if(strlen($number)<13){
            if(preg_match("/^((\+)?[1]{1})?\d{10}/",$number))
            {
                if(is_null($firstName)){
                    $firstName="empty";}
                else if(is_null($lastName)){
                    $lastName="empty";}
                else if(is_null($email)){
                    $email="empty";}
                else if(is_null($state)){
                    $state="empty";}
                else if(is_null($zip)){
                    $zip="empty";}

                if($proceedCount>$splitPoint) {
                   $proceedCount=1;
                   $groupCount++;
                }
                $proceedCount++;
                $totalProcess++;
                $time=date_time();
                $groupName=$givenName.'_'.$groupCount;
                

                $sql="INSERT INTO contract (userId,number,firstName,lastName,email,state,zip,groupName,dateTime,fileName) VALUES ('$userid','$number','$firstName','$lastName','$email','$state','$zip','$groupName','$time','$fileName') ";
                mysqli_query($conn, $sql);


                
            }
        }

    }

    $sql="INSERT INTO fileinformation (fileName,totalUploaded,totalProcess,usersId) VALUES ('$fileName','$fileContentCount','$totalProcess','$userid') ";
    mysqli_query($conn, $sql);
    header("Location:Users.php");
}
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
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
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

									        <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                   
                                </nav>
                            </div>


                        </div>
                    </div>

                </nav>
            </div>

			
			
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

						
						
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>		
                                Upload your File
                            </div>
                            <div class="card-body">

                            <form class="" action="uploadFile.php" method="post" enctype="multipart/form-data">                                             
                                <div class="card bg-secondary text-light">
                                    <div class="card-body bg-dark">

                                    <div class="form-group">
                                            <label for="Name"> <span style="color:rgb(0, 153, 153) ">Name</span></label>
                                            <input class ="form-control" type="text" name="Name" id="Name" placeholder="Name" value=""> 
                                        </div>

                                        <div class="form-group">
                                            <label for="splitPoint"> <span style="color:rgb(0, 153, 153) ">Split Point</span></label>
                                            <input class ="form-control" type="number" name="splitPoint" id="splitPoint" placeholder="Split Point" value=""> 
                                        </div>

                                        <div class="form-group">
                                            <label for="file"> <span style="FieldInfo; color:rgb(0, 153, 153);"> Select Text File</span></label>
                                                <div class="custom-file">
                                                    <input class ="custom-file-input" type="file" name="file" id="file" > 
                                                    <label for="file" class="custom-file-label"> </label>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="submit" name="submit" class="btn btn-success btn-block">
                                                <span >Upload</span>
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
				            </form>
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
