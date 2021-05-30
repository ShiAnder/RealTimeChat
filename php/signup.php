<?php 
    session_start();
    include_once "config.php";

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //if email is valid
            // check already exist or not
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email ='{$email}'");
            if(mysqli_num_rows($sql) > 0){ //if email already exist
                echo "$email - This email already exist !";
            }
            else {
                //check user upload file or not
                if(isset($_FILES['image'])){
                    $image_name = $_FILES['image']['name']; // Get the image name
                    $tmp_name = $_FILES['image']['tmp_name']; // Tempory name used to save file in our folder

                    //get the extension from the uploaded image
                    $image_explode = explode('.', $image_name);
                    $image_ext = end($image_explode);

                    $extensions = ['jpg', 'jpeg', 'png']; //valid images extensions and store in an array

                    if(in_array($image_ext, $extensions) == true){
                        $time = time();
                        $new_img_name = $time.$image_name;
                        $img_dir = "C:/xampp/htdocs/RealTimeChat/images/";

                       if(move_uploaded_file( $tmp_name, $img_dir.$new_img_name)){
                            $status = "Active Now";
                            $random_id = rand(time(), 10000000); // creating random id for user

                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) 
                                    VALUES ('{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; //Using this session,we used users unique_id in other php files
                                    echo "success";  
                                                                                    
                                }
                            }   
                            else {
                                echo "Data Not Inserted !";
                            }
                        }

                    }
                    else {
                        echo "Please select an image - jpg , jpeg, png";
                    }

                }
                else {
                    echo "Please select an Image File !";
                }
            }

        }
        else {
            echo "Email is not valid !";
        }
    }
    else {
        echo "All the fields are required !";
    }
    
?>