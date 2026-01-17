<?php
require 'conn.php';
header('Content-Type: application/json');

if (!isset($_GET['action'])) {
    echo json_encode(["success"=>false,"msg"=>"no action"]);
    exit;
}

if ($_GET['action'] === 'delete') {

    if (!isset($_POST['id'])) {
        echo json_encode(["success"=>false,"msg"=>"no id"]);
        exit;
    }

    $id = intval($_POST['id']);

    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success"=>true]);
    } else {
        echo json_encode(["success"=>false,"error"=>mysqli_error($conn)]);
    }
}
