<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>

<?php
$ename="";
$eemail="";
$epass="";
$checkEmail=0;
if( isset($_SESSION["userid"]) ){
    $usrid=$_SESSION['userid'];
    }


if(isset($_POST["Submit"]))
    {   $name=$_POST["name"];

        $email=$_POST["email"];
        $password=$_POST["password"];

        
        if(empty($name)){
            $ename='<div class="alert alert-danger">Name is Required</div></br>';
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

            if(!empty($name)&&!empty($email)&&!empty($password)&& ($checkEmail==1)){
                $sql="UPDATE users SET name='$name',email='$email' WHERE id='$usrid'";
                if (mysqli_query($conn, $sql)) {            
                    header("location:Admin.php");                                     
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        else if(!empty($name)&&!empty($email)&& empty($password)&& ($checkEmail==1)){
            $password=password_hash($password,PASSWORD_DEFAULT);
            $sql="UPDATE users SET name='$name',email='$email',password='$password' WHERE id='$usrid'";
            if (mysqli_query($conn, $sql)) {            
                header("location:Admin.php");                                     
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
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
	<title>Job Categories </title>

</head>
<body>
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >
                <?php
                   
                    if( isset($_GET["id"]) ){
                        $ID=$_GET["id"];
                        }
                    
                    $_SESSION['userid']=$ID;
                    $sql="SELECT * FROM users WHERE id ='$ID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                            
                                $fetchName=$row['name'];
                                $fetchEmail=$row['email'];
                                $fetchPassword=$row['password'];
                    } 
                    
                    else {
                        echo "0 results";
                    }
                ?>
				<form class="" action="editUserProfile.php" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Update Profile</h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="fetchName"> <span style="color:rgb(0, 153, 153) ">Name</span></label>
								<input class ="form-control" type="text" name="name" id="fetchName" placeholder="Name" value="<?php echo $fetchName; ?>"> <?php echo $ename; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="Email"> <span style="color:rgb(0, 153, 153) ">Email</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email" value="<?php echo $fetchEmail; ?>"> <?php echo $eemail; ?>
                            </div>

                            <div class="form-group">
								<label for="word$password"> <span style="color:rgb(0, 153, 153) ">Password</span></label>
								<input class ="form-control" type="text" name="word$password" id="$password" placeholder="Password"">
                            </div> 

                            <div class="row">
								<div class="col-lg-12">
									<button type="Submit" name="Submit" class="btn btn-success btn-block">
										Update
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