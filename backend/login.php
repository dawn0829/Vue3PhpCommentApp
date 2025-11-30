<?php
session_start();
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

$response = [];

// Default error_code: 4 = Invalid input (overwritten below on success)
$response['error_code'] = 4;

//提早跳出
if(!isset($data->email) || !isset($data->password)){
    $response["message"] = "Invalid input";
    echo json_encode($response);
    exit;
}
$email = $data->email;
$password = $data->password;

// 使用ADODB
$query = "SELECT * FROM users WHERE email = ?";
$result = $conn->Execute($query, [$email]);

// 檢查查詢是否成功
if(!$result) {
    $response["error_code"] = 3; // Database error
    $response["message"] = "Database error"; // 或者其他適合的錯誤訊息
    echo json_encode($response);
    exit;
}

// 檢查是否找到用戶
if($result->RecordCount() == 0){
    $response["error_code"] = 1; // User not found
    $response["message"] = "User not found";
    echo json_encode($response);
    exit;
}
$user = $result->FetchRow();
if(password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION["loggedIn"] = true;
    $response["error_code"] = 0; // Success
    $response["message"] = "Login successful";
    $response["user_id"] = $user['user_id'];
    $response["user_name"] = $user['name'];
} else {
    $response["error_code"] = 2; // Invalid password
    $response["message"] = "Invalid password";
}

$conn->Close();

echo json_encode($response);
?>
