<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
$ID=$_GET["id"];
$status=$_GET["status"];
if($status=="Active"){
    $status="Block";
}
else{
    $status="Active";
}

$sql="UPDATE users SET status='$status'WHERE id='$ID'";

if (mysqli_query($conn, $sql)) {
        header("Location:Admin.php");
}
mysqli_close($conn);

?>