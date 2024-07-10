<?php
session_start();
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->topic_id) || !isset($data->content) || !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$topic_id = $data->topic_id;
$content = $data->content;
$user_id = $_SESSION['user_id']; // 使用從 session 中取得的 user_id

$query = "INSERT INTO Comments (user_id, topic_id, content) VALUES (?, ?, ?)";
$result = $conn->Execute($query, [$user_id, $topic_id, $content]);

if ($result) {
    echo json_encode(['success' => true, 'comment_id' => $conn->Insert_ID(), 'user_name' => $_SESSION['user_name']]);
} else {
    echo json_encode(['success' => false]);
}

$conn->Close();
?>
