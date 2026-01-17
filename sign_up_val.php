<?php
require 'conn.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim(mysqli_real_escape_string($conn, $_POST['firstname']));
    $lastname = trim(mysqli_real_escape_string($conn, $_POST['lastname']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $confirm_password = trim(mysqli_real_escape_string($conn, $_POST['Confirm_password']));

    $_SESSION['firstname_error']=null;
    $_SESSION['lastname_error']=null;
    $_SESSION['email_error']=null;
    $_SESSION['password_error']=null;
    $_SESSION['confirm_password_error'] = null;
    

    if (empty($firstname)) {
        $_SESSION['firstname_error'] = "*firstname is Required";
    } elseif (!preg_match('/^[a-zA-Z\s\x{0600}-\x{06FF}]+$/u', $firstname)) {
        $_SESSION['firstname_error'] = "*the firstname cann't contain symbles or numbers!";
    }

    if (empty($lastname)) {
        $_SESSION['lastname_error'] = "*lastname is Required";
    } elseif (!preg_match('/^[a-zA-Z\s\x{0600}-\x{06FF}]+$/u', $lastname)) {
        $_SESSION['lastname_error'] = "*the lastname cann't contain symbles or numbers!";
    }

    if (empty($email)) {
        $_SESSION['email_error'] = "*email is Required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = "*invaled Email";
    }
    if (empty($password)) {
        $_SESSION['password_error'] = "*password is Required";
    } elseif (strlen($password) < 5) {
        $_SESSION['password_error'] = "*The password must be at least 5 numbers";
    }

    if (empty($confirm_password)) {
        $_SESSION['confirm_password_error'] = "*Confirem is Required";
    } elseif ($confirm_password !== $password) {
        $_SESSION['confirm_password_error'] = "*Passwords are not matched";
    }

    $sql_email = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");
    if(mysqli_num_rows($sql_email) > 0){
        $_SESSION['email_error'] = "this email is already registered";
    }


    if (!(isset($_SESSION['firstname_error']) || isset($_SESSION['lastname_error']) || isset($_SESSION['email_error']) 
        || isset($_SESSION['password_error']) || isset($_SESSION['confirm_password_error']))){
       
        $hashPass = password_hash($password,PASSWORD_BCRYPT); 
    
    
    $sql = "insert into users (first_name,last_name,email,password)
    values ('$firstname','$lastname','$email','$hashPass') " ; 

    if ($conn->query($sql)) {
    
    echo "success";
    exit; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}

}
?>
