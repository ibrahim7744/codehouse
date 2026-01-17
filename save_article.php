<?php
require 'conn.php';

if (isset($_POST['save_article'])) {

    
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    $fileName = null;

    
    if (!empty($_FILES['imageFile']['name'])) {
        
        $uploadsDir = "uploads/";
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);

        
        $fileName = time() . '_' . basename($_FILES['imageFile']['name']);

        move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadsDir . $fileName);
    }

    
    $sql = "INSERT INTO articles (title, category, content, image)
            VALUES ('$title', '$category', '$content', '$fileName')";

    if (mysqli_query($conn, $sql)) {
        
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


