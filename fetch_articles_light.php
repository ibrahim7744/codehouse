<?php
require 'conn.php';

$sql = "SELECT * FROM articles ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$articles = [];

while($row = mysqli_fetch_assoc($result)) {
   
    if (!empty($row['image'])) {
        $row['image'] = "../../uploads/" . $row['image'];
    }

   
    if (!empty($row['createdAt'])) {
        $timestamp = strtotime($row['createdAt']);
        if ($timestamp !== false) {
            $row['createdAt'] = date('c', $timestamp); 
        } else {
            $row['createdAt'] = date('c'); 
        }
    } else {
        $row['createdAt'] = date('c'); 
    }

    $articles[] = $row;
}

header('Content-Type: application/json');
echo json_encode($articles);
?>

