<?php
require_once 'db.php';

$keyword = $_GET['keyword'];

// 使用參數化查詢 - 搜尋標題或創建者名稱
$query = "SELECT t.topic_id, t.title, t.created_at, u.name, u.email
          FROM topics t
          JOIN users u ON t.user_id = u.user_id
          WHERE LOWER(t.title) LIKE ? OR LOWER(u.name) LIKE ?";

$result = $conn->Execute($query, array('%' . $keyword . '%', '%' . $keyword . '%'));

if ($result === false) {
    echo "Error executing query: " . $conn->ErrorMsg();
    exit;
}

$topics = [];
while ($row = $result->FetchRow()) {
    $topics[] = [
        'topic_id' => $row['topic_id'],
        'title' => $row['title'],
        'created_at' => $row['created_at'],
        'user' => [
            'name' => $row['name'],
            'email' => $row['email']
        ]
    ];
}

echo json_encode(['topics' => $topics]);
$conn->Close();
?>
