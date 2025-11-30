<?php
session_start();
require_once 'db.php';

// 檢查用戶是否已登入
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => '用戶未登入']);
    exit;
}

$userId = $_SESSION['user_id'];

header('Content-Type: application/json');

// 檢查請求方法
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => '只允許 GET 請求']);
    exit;
}

// 獲取查詢參數
$conversationId = isset($_GET['conversation_id']) ? trim($_GET['conversation_id']) : null;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

// 建構查詢
$params = [$userId];
$query = "SELECT chat_id, message, is_ai, conversation_id, model, tokens_used, created_at
          FROM chat
          WHERE user_id = ?";

if ($conversationId) {
    $query .= " AND conversation_id = ?";
    $params[] = $conversationId;
}

$query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

// 執行查詢
$result = $conn->Execute($query, $params);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => '查詢聊天記錄失敗']);
    exit;
}

$chats = [];
while ($row = $result->FetchRow()) {
    $chats[] = [
        'chat_id' => (int)$row['chat_id'],
        'message' => $row['message'],
        'is_ai' => (bool)$row['is_ai'],
        'conversation_id' => $row['conversation_id'],
        'model' => $row['model'],
        'tokens_used' => $row['tokens_used'] ? (int)$row['tokens_used'] : null,
        'created_at' => $row['created_at']
    ];
}

// 反轉順序，使最新的在最後
$chats = array_reverse($chats);

// 獲取總數量（用於分頁）
$countQuery = "SELECT COUNT(*) as total FROM chat WHERE user_id = ?";
$countParams = [$userId];

if ($conversationId) {
    $countQuery .= " AND conversation_id = ?";
    $countParams[] = $conversationId;
}

$countResult = $conn->Execute($countQuery, $countParams);
$total = 0;
if ($countResult) {
    $total = (int)$countResult->fields['total'];
}

// 返回成功回應
echo json_encode([
    'success' => true,
    'chats' => $chats,
    'pagination' => [
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset,
        'has_more' => ($offset + $limit) < $total
    ],
    'conversation_id' => $conversationId
]);

$conn->Close();
?>

