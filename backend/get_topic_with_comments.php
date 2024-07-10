<?php
require_once 'db.php';

$topic_id = $_GET['topic_id'];

// Topic
$topic_query = "SELECT * FROM Topics WHERE topic_id = ?";
$topic_result = $conn->Execute($topic_query, [$topic_id]);
$topic = $topic_result->FetchRow();

// Comment
$comments_query = "SELECT Comments.*, Users.name AS user_name FROM Comments
                   JOIN Users ON Comments.user_id = Users.user_id
                   WHERE Comments.topic_id = ?";
$comments_result = $conn->Execute($comments_query, [$topic_id]);
$comments = [];
while ($row = $comments_result->FetchRow()) {
    $comments[] = $row;
}

echo json_encode(['topic' => $topic, 'comments' => $comments]);

$conn->Close();
?>
