CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE Topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    topic_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (topic_id) REFERENCES Topics(topic_id)
);
CREATE TABLE chat (
    chat_id INT PRIMARY KEY AUTO_INCREMENT COMMENT '聊天記錄ID',
    user_id INT NOT NULL COMMENT '用戶ID',
    message TEXT NOT NULL COMMENT '訊息內容',
    is_ai TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否為AI回應 (0=用戶, 1=AI)',
    conversation_id VARCHAR(50) DEFAULT NULL COMMENT '會話ID，用於區分不同對話串',
    model VARCHAR(50) DEFAULT NULL COMMENT '使用的AI模型',
    tokens_used INT DEFAULT NULL COMMENT '使用的token數',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '建立時間',
    
    -- 外鍵約束
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    
    -- 索引
    INDEX idx_user_id (user_id),
    INDEX idx_conversation_id (conversation_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
