<?php 
    session_start();
    include_once "config.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
      
        if(mysqli_num_rows($sql) > 0){ //if user credentials are matched 
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['unique_id'] = $row['unique_id']; //Using this session,we used users unique_id in other php files
            echo "success";  
        }
        else{
            echo "Email or Password is Incorrect !";
        }
    }
    else {
        echo "All the input fields are required !";
    }
?>