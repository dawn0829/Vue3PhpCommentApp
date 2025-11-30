<?php
//引入ADODB
require_once './lib/adodb5/adodb.inc.php';
// 避免CORS前端路由端路由
header('Content-Type: application/json');
$allowed_origins = [
    'http://127.0.0.1:8080',
    'http://localhost:8080',
    'http://127.0.0.1:8082',
    'http://localhost:8082',
];

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
if (in_array($origin, $allowed_origins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
}
// Allow credentials (cookies, HTTP auth). Only works when Access-Control-Allow-Origin is a specific origin.
header("Access-Control-Allow-Credentials: true");
// Allowed methods and headers for preflight requests
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Access-Control-Max-Age: 86400'); // cache preflight for 1 day
// 處理GET、POST Request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204); // 204 No Content
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comment_app";

try {
    // 可使用 mysqli OR pdo 驅動
    $conn = ADONewConnection('mysqli');
    $conn->Connect($servername, $username, $password, $dbname);

    if (!$conn->IsConnected()) {
        throw new Exception('Connection failed: ' . $conn->ErrorMsg());
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
