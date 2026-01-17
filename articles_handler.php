<?php
require 'conn.php'; 

header('Content-Type: application/json');


$action = $_GET['action'] ?? '';

if ($action === 'fetch') {
    
    $result = $conn->query("SELECT * FROM articles ORDER BY createdAt DESC");
    $articles = [];
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
    echo json_encode($articles);
    exit;
}

if ($action === 'create') {
    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? 'المسؤول';
    $createdAt = date('Y-m-d H:i:s');

   
    $imageData = '';
    if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
        $image = $_FILES['image'];
        $imageData = base64_encode(file_get_contents($image['tmp_name']));
        $imageData = "data:{$image['type']};base64,$imageData";
    }

    $stmt = $conn->prepare("INSERT INTO articles (title, category, content, author, image, createdAt) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $category, $content, $author, $imageData, $createdAt);
    $stmt->execute();
    echo json_encode(['success'=>true, 'id'=>$stmt->insert_id]);
    exit;
}

if ($action === 'update') {
    $id = $_POST['id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? 'المسؤول';

    $imageData = '';
    if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
        $image = $_FILES['image'];
        $imageData = base64_encode(file_get_contents($image['tmp_name']));
        $imageData = "data:{$image['type']};base64,$imageData";
    }

    if($imageData) {
        $stmt = $conn->prepare("UPDATE articles SET title=?, category=?, content=?, author=?, image=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $category, $content, $author, $imageData, $id);
    } else {
        $stmt = $conn->prepare("UPDATE articles SET title=?, category=?, content=?, author=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $category, $content, $author, $id);
    }
    $stmt->execute();
    echo json_encode(['success'=>true]);
    exit;
}

if ($action === 'delete') {
    $id = $_POST['id'] ?? 0;
    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo json_encode(['success'=>true]);
    exit;
}

echo json_encode(['success'=>false, 'message'=>'Action not defined']);
