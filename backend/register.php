<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if(!data || !isset($data->username) || !isset($data->email) || !isset($data->password)){
    echo json_encode(["message" => "Invalid input"]);
    exit;
}
$username = $data->username;
$password = password_hash($data->password, PASSWORD_DEFAULT);
$email = $data->email;    

// 使用 AdoDB 的參數化
$query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$params = [$username, $email, $password];

$result = $conn->Execute($query, $params);

if($result){
    echo json_encode(["message" => "User registered successfully"]);
} else {
    echo json_encode(["message" => "User registration failed"]);
}

$conn->close();
?>
