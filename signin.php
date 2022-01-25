<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
$eemail="";
$epass="";
if(isset($_POST["Submit"]))
    {
        $email=$_POST["email"];
        $password=$_POST["pass"];
        $act=$_POST["accounttype"];
        if(empty($email))
            {
                $eemail='<div class="alert alert-danger">Email is Required</div></br>';
            }
        if(empty($password))
        {
            $epass='<div class="alert alert-danger">Password is Required</div></br>';
        }
        if(!empty($email)&&!empty($password))
        {   
            if($act=="Admin")
            {

                    $sql="SELECT * FROM admin WHERE email='$email'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);
                         
                         $NAME=$row["name"];
                         $fetchPassword=$row["password"];
                         $verify=password_verify($password,$fetchPassword);
                        if($verify==1){
                            
                            $_SESSION["username"]=$NAME;
                            $_SESSION["success"]="Welcome ".$NAME;
                            header("Location:Admin.php");  
                        }
                        else {
                            $_SESSION["Error"]="Wrong Username or password";
                            header("Location:signin.php");
                             } 
                    
                    }
                    else {
                        $_SESSION["Error"]="Wrong Username or password";
                        header("Location:signin.php");
                    }
                    mysqli_close($conn);
            }
        


            else{
                $sql="SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_assoc($result);
                     $id=$row["id"];
                     $NAME=$row["name"];
                     $fetchPassword=$row["password"];
                     $status=$row["status"];
                     $verify=password_verify($password,$fetchPassword);
                    if($verify==1 && $status=="Active"){
                        $_SESSION["userId"]=$id;
                        $_SESSION["actType"]="User";
                        $_SESSION["username"]=$NAME;
                        $_SESSION["success"]="Welcome ".$NAME;
                        header("Location:Users.php");  
                    }
                    else {
                        $_SESSION["Error"]="Wrong Username or password";
                        header("Location:signin.php");
                         } 
                
                }
                else {
                    $_SESSION["Error"]="Wrong Username or password";
                    header("Location:signin.php");
                }
                mysqli_close($conn);

            }
        }


    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">
	

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="">
       <p style="color:#27aae1;font-weight: bold;">
            Demo Project</p></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col-auto">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="signup.php">Sign Up <span class="sr-only"></span></a>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>

    </nav>
    <?php 
        echo error();
    ?>

    
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >

				<form class="" action="signin.php" method="post">                                              
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Sign In</h1>
						</div>
                        
						<div class="card-body bg-dark">

                            <div class="form-group">
								<label for="email"> <span style="color:rgb(0, 153, 153) ">Email</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email Address" value=""> <?php echo $eemail; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="password"> <span style="color:rgb(0, 153, 153) ">Password</span></label>
								<input class ="form-control" type="password" name="pass" id="password" placeholder="Password" value=""> <?php echo $epass; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="AccountType"> <span class="FieldInfo"style="color:rgb(0, 153, 153)">Account Type</span></label>
								<select class="form-control" id="AccountType" name="accounttype"><?php echo $etype; ?>
                                        <option>Admin</option> 
                                        <option>User</option> 
                                </select>
                            </div>
                            


							<div class="row">
								<div class="col-lg-12">
									<button type="submit" name="Submit" class="btn btn-success btn-block bg-info">
										Login
									</button>
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	</section>
    
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
