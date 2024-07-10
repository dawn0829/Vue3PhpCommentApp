<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo json_encode(["loggedIn" => true,"user_id" => $_SESSION['user_id'],"user_name" => $_SESSION['user_name']]);
} else {
    echo json_encode(["loggedIn" => false]);
}
?>