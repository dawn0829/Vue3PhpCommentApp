<?php
session_start();
include 'db.php';
$user_id = $_SESSION['user_id'] ?? null;
//驗證uid
if (!isset($user_id)){
    echo json_encode(["success" => false, "message" => "User not authenticed"]);
    exit;
}
//驗證post req
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
} 
//驗證input字串資料
$data = json_decode(file_get_contents("php://input"));
if (!isset($data->title) || !is_string($data->title)) {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}
$title = $data->title;

$query = "INSERT INTO topics (title, user_id) VALUES (?, ?)";
$result = $conn->Execute($query, [$title, $user_id]);

if ($result) {
    echo json_encode(["success" => true, "message" => "Topic added successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add topic"]);
}

$conn->Close();
?>
