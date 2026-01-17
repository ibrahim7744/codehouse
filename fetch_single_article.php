<?php
require 'conn.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM articles WHERE id = $id");
    if($query->num_rows > 0){
        echo json_encode($query->fetch_assoc());
    } else {
        echo json_encode(['error' => 'المقالة غير موجودة']);
    }
}
?>
