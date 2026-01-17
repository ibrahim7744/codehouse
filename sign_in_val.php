<?php
require 'conn.php';
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    
    $query=mysqli_query($conn,"SELECT * FROM users where email='$email'");

    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        
        if ((password_verify($password, $user['password']))) {
            echo "success";
        } else {
            echo "wrong";
        }
    } else {
        echo "Wrong";
    }

    
    

}

