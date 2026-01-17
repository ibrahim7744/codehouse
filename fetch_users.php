<?php
require 'conn.php';

header('Content-Type: application/json; charset=utf-8');

$result = mysqli_query($conn, "SELECT id, first_name, last_name, email, created_at FROM users ORDER BY id DESC");

$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = [
        "id" => $row['id'],
        "name" => $row['first_name'] . " " . $row['last_name'],
        "email" => $row['email'],
        "createdAt" => $row['created_at']
    ];
}

echo json_encode($users, JSON_UNESCAPED_UNICODE);
