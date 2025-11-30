INSERT INTO Users (name, email, password) VALUES
('dawn','dawn@example.com','$2a$12$9QDPnik9KvgQE4xWL8CNd.VNaVqHRAvm6MKqMfeTmssr6C.yttlUa'),
('dawn2','bob@example.com','$2a$12$9QDPnik9KvgQE4xWL8CNd.VNaVqHRAvm6MKqMfeTmssr6C.yttlUa'),
('dawn3','charlie@example.com','$2a$12$9QDPnik9KvgQE4xWL8CNd.VNaVqHRAvm6MKqMfeTmssr6C.yttlUa');
INSERT INTO Topics (user_id, title) VALUES
(1, 'MySQL 新手教學'),
(2, '今天學到的 Laravel 心得'),
(1, 'Django 專案規劃筆記');

INSERT INTO Comments (user_id, topic_id, content) VALUES
(2, 1, '這篇 MySQL 教學蠻好懂的，謝謝分享！'),
(3, 1, '我也剛開始學 MySQL，可以一起討論～'),
(1, 2, 'Laravel 的 migration 我還在研究中 QQ'),
(3, 2, '我覺得 Laravel 的 Eloquent 還蠻好用的'),
(2, 3, 'Django 的 ORM 也很強大，可以比較看看'),
(1, 3, '之後我會補上 admin 自訂的部分');
