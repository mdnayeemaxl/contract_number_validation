
<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>

<?php
$ename="";
$eemail="";
$epass="";

if(isset($_POST["Submit"]))
    {
        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["pass"];
        

        
        $checkName=0;
        $checkEmail=0;

           
            $sql="SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
                {
                    $_SESSION["Error"]="Email Already Exist. Please use another email to sign up ";  
                               //17
                    header("Location:signup.php");
                    //mysqli_close($conn); 
                }
            else{

                if(empty($name)){
                    $ename='<div class="alert alert-danger">Name is Required</div></br>';
                }
                else {
                        if(!preg_match("/^[A-Za-z. ]*$/",$name))
                        {
                            $ename='<div class="alert alert-danger">Only Letters and white space are Required</div></br>';
                        }
                        else $checkName=1;
                    }
        
                    if(empty($email)){
                        $eemail='<div class="alert alert-danger">Email is Required</div></br>';
                    }
                    else {
                            if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$email))
                            {
                                $eemail='<div class="alert alert-danger">Please provide valid email Address</div></br>';
                            }
                            else $checkEmail=1;
                        }
                    if(empty($password))
                        {
                            $epass='<div class="alert alert-danger">Password is required</div></br>';
                        }

                if(!empty($name)&&!empty($email)&&!empty($password)&&($checkName==1)&& ($checkEmail==1))
                    {
                        $password=password_hash($password,PASSWORD_DEFAULT);
                        $sql="INSERT INTO users (name,email,password,status,accountType) VALUES ('$name','$email','$password','Active','user') ";
                        if (mysqli_query($conn, $sql)) { 
                            $_SESSION["success"]="Sign up has Successfully Completed";              
                            header("location:signin.php");                                     
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    
	<title>Job Categories </title>

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
                            <a class="nav-link" href="signin.php">Sign In <span class="sr-only"></span></a>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>

    </nav>
	
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >
                <?php
                    echo error();
                    echo success();
                ?>
				<form class="" action="signup.php" method="post" enctype="multipart/form-data">                                              <?php//////////////////////////////////////?>
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1>User Register Form</h1>
						</div>
                        
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="name"> <span style="color:rgb(0, 153, 153) ">Name</span></label>
								<input class ="form-control" type="text" name="name" id="name" placeholder="Name" value=""> <?php echo $ename; ?>
                            </div>
                            <div class="form-group">
								<label for="email"> <span style="color:rgb(0, 153, 153) ">Email</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email Address" value=""> <?php echo $eemail; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="password"> <span style="color:rgb(0, 153, 153) ">Password</span></label>
								<input class ="form-control" type="password" name="pass" id="password" placeholder="Password" value=""> <?php echo $epass; ?>
                            </div>
                            
							<div class="row">
								<div class="col-lg-12">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										Register
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





