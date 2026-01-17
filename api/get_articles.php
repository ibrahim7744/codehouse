<?php
require "../conn.php";

$res = $conn->query("SELECT * FROM articles ORDER BY id DESC");
$data = [];

while($row = $res->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);

