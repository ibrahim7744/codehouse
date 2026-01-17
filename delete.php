<?php
// delete.php
require 'conn.php';

$type = $_POST['type'];
$id = $_POST['id'];

if($type === 'article'){
    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);
} else if($type === 'user'){
    $stmt = $conn->prepare("DELETE FROM users WHERE email=?");
    $stmt->bind_param("s", $id);
}

if($stmt->execute()){
    echo json_encode(['status' => 'success']);
}else{
    echo json_encode(['status' => 'error', 'msg' => $stmt->error]);
}
?>


