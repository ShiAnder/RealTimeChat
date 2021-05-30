<?php 
session_start();
if(isset($_SESSION['unique_id'])){ //if user is logged in, come to this page otherwise go to login page
    include_once "config.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    
    if(isset($logout_id)){
        $status = "Offline now";

        // update user status to offline when user is logged out
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$logout_id}' ");
        if($sql){
            session_unset();
            session_destroy();
            header("location: ../login.php");
        }
        else {
            header("location : ../users.php");
        }
    }
}
else {
    header("location : ../login.php");
}



?>