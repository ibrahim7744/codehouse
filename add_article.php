<?php

require 'conn.php';

$title = $_POST['title'];
$category = $_POST['category'];
$content = $_POST['content'];
$author = $_POST['author'] ?: 'المسؤول';
$createdAt = date('Y-m-d H:i:s');


$fileName = null;

if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == 0) {
    if (!is_dir('uploads')) mkdir('uploads', 0777, true);

    $fileName = time() . '_' . basename($_FILES['imageFile']['name']);
    move_uploaded_file($_FILES['imageFile']['tmp_name'], 'uploads/' . $fileName);
}


$stmt = $conn->prepare("INSERT INTO articles (title, category, content, author, image, createdAt)
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $title, $category, $content, $author, $fileName, $createdAt);

if($stmt->execute()){
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'msg' => $stmt->error]);
}
?>