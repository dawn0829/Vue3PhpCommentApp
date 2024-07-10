<?php
require_once 'db.php';

// 獲取所有 Topics 及其對應的 User data，並根據最後評論時間排序
$query = "
    SELECT 
        Topics.topic_id, 
        Topics.title, 
        Topics.created_at, 
        Users.name, 
        Users.email,
        MAX(Comments.created_at) AS last_comment_time
    FROM 
        Topics
    JOIN 
        Users ON Topics.user_id = Users.user_id
    LEFT JOIN 
        Comments ON Topics.topic_id = Comments.topic_id
    GROUP BY 
        Topics.topic_id, 
        Topics.title, 
        Topics.created_at, 
        Users.name, 
        Users.email
    ORDER BY 
        last_comment_time DESC, 
        Topics.created_at DESC
";
$result = $conn->Execute($query);

$topics = [];

if ($result && $result->RecordCount() > 0) {
    while ($row = $result->FetchRow()) {
        $topics[] = [
            'topic_id' => $row['topic_id'],
            'title' => $row['title'],
            'created_at' => $row['created_at'],
            'user' => [
                'name' => $row['name'],
                'email' => $row['email']
            ],
            'last_comment_time' => $row['last_comment_time'] // 增加最後評論時間字段
        ];
    }
}

echo json_encode($topics);
$conn->Close();
?>