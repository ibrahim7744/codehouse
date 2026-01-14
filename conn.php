<?php 

$conn=new mysqli("localhost","root","","Test1");
if ($conn->connect_errno) {
    die("Error in connection");
}
?>