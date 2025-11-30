<?php
session_start();
require_once 'db.php';
require_once 'ollama.php';

header('Content-Type: application/json');

// 檢查用戶是否已登入
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => '用戶未登入']);
    exit;
}

$userId = $_SESSION['user_id'];

// 檢查請求方法
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => '只允許 POST 請求']);
    exit;
}

// 檢查 OLLAMA 服務是否可用
if (!$ollama->isAvailable()) {
    http_response_code(503);
    echo json_encode(['error' => 'OLLAMA 服務不可用']);
    exit;
}

// 獲取請求數據
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['message'])) {
    http_response_code(400);
    echo json_encode(['error' => '缺少 message 參數']);
    exit;
}

$message = trim($data['message']);

if (empty($message)) {
    http_response_code(400);
    echo json_encode(['error' => '訊息不能為空']);
    exit;
}

// 獲取或生成 conversation_id
$conversationId = isset($data['conversation_id']) ? trim($data['conversation_id']) : null;
if (empty($conversationId)) {
    $conversationId = 'conv_' . $userId . '_' . time(); // 生成唯一會話ID
}

// 儲存用戶訊息到資料庫
$userMessageQuery = "INSERT INTO chat (user_id, message, is_ai, conversation_id) VALUES (?, ?, 0, ?)";
$userMessageResult = $conn->Execute($userMessageQuery, [$userId, $message, $conversationId]);

if (!$userMessageResult) {
    http_response_code(500);
    echo json_encode(['error' => '儲存用戶訊息失敗']);
    exit;
}

$userChatId = $conn->Insert_ID();

// 設定對話選項 - 優化速度和簡短回答
$options = [
    'temperature' => 0.3,     // 降低隨機性，讓回答更確定、簡潔
    'top_p' => 0.7,          // 降低概率分佈範圍
    'top_k' => 40,           // 限制考慮的top k tokens，提高速度
    'num_predict' => 150,    // 限制生成的最大token數，讓回答更短
    'repeat_penalty' => 1.1, // 輕微懲罰重複內容
    'repeat_last_n' => 64    // 檢查重複的上下文長度
];

// 如果有提供額外選項，合併它們（用戶可以覆蓋預設值）
if (isset($data['options']) && is_array($data['options'])) {
    $options = array_merge($options, $data['options']);
}

// 呼叫 OLLAMA 生成回應
$result = $ollama->generate($message, $options);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => '生成回應失敗']);
    exit;
}

// 儲存AI回應到資料庫
$aiMessage = $result['response'];
$model = $result['model'];
$tokensUsed = $result['eval_count'] ?? null;

$aiMessageQuery = "INSERT INTO chat (user_id, message, is_ai, conversation_id, model, tokens_used) VALUES (?, ?, 1, ?, ?, ?)";
$aiMessageResult = $conn->Execute($aiMessageQuery, [$userId, $aiMessage, $conversationId, $model, $tokensUsed]);

if (!$aiMessageResult) {
    http_response_code(500);
    echo json_encode(['error' => '儲存AI回應失敗']);
    exit;
}

$aiChatId = $conn->Insert_ID();

// 返回成功回應
echo json_encode([
    'success' => true,
    'message' => $aiMessage,
    'conversation_id' => $conversationId,
    'chat_ids' => [
        'user' => $userChatId,
        'ai' => $aiChatId
    ],
    'model' => $model,
    'timestamp' => date('Y-m-d H:i:s'),
    'usage' => [
        'prompt_eval_count' => $result['prompt_eval_count'] ?? null,
        'eval_count' => $result['eval_count'] ?? null,
        'total_duration' => $result['total_duration'] ?? null,
        'tokens_used' => $tokensUsed
    ]
]);

$conn->Close();
?>
