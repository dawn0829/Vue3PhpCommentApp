<?php
//引入ADODB
require_once './lib/adodb5/adodb.inc.php';
//Allow All test 
//prevent CROS ERR
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://192.168.3.181:8080');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
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
