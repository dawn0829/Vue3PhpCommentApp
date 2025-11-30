# Vue3 + PHP Comment App

本專案示範使用 Vue (前端) 與 PHP (後端) 建立討論區、留言系統。以下說明如何在 Windows 環境使用 Laragon、Node.js，以及本地 LLM (Ollama) 進行開發、測試與執行。

📋 **專案結構（重點）**
- `frontend/` - Vue.js 源碼（使用 Vue CLI & Tailwind）
- `backend/` - PHP API (ADODB + mysqli) 與登入、留言等 API
- `basic_comment.sql`, `testdata.sql` - DB schema & 測試資料

---

## 系統需求
- Windows (10/11)
- Laragon（推薦用來快速啟動 Apache / MySQL / PHP）
- Node.js (v18+ 建議) / npm
- Ollama（若要使用本地 LLM，選擇性）

---

## 1) 安裝 Laragon（推薦）
Laragon 提供輕量的 LAMP 開發環境，適合 Windows 本地開發。
1. 下載 Laragon：
   - 官方網站：https://laragon.org
2. 安裝完成後，啟動 Laragon。
3. 將 `backend/` 放到 Laragon 的 `www` 資料夾下（例如 `C:\laragon\www\Vue3PhpCommentApp\backend`）或使用 Laragon 的快速新增專案功能。
4. 在 Laragon 中設定 Apache/Nginx 與 PHP 版本（預設即可），啟動 Apache 與 MySQL（或 MariaDB）。
5. 在 Laragon 的 http://localhost 或 http://localhost:PORT 測試 PHP API（若使用 Laragon 預設 port 80，請使用 `http://localhost/backend/...`）。

> Tip: Laragon 的 `Menu > www > Make VirtualHost` 可以建立虛擬主機（例如 `http://vue3-php-app.test`）讓開發更方便。

---

## 2) 安裝 Node.js（前端）
1. 下載並安裝 Node.js LTS（官方）:
   - https://nodejs.org/
2. 在 `frontend` 資料夾執行：
```powershell
cd c:\Users\w7823\Desktop\Vue3PhpCommentApp\frontend
npm install
npm run serve
```
3. 若成功啟動：會看到 dev server URL，通常是 `http://localhost:8080`。

---

## 3) 設定資料庫
1. 使用 phpMyAdmin (Laragon 預設) 或 MySQL CLI 建立 `comment_app` 資料庫：
```powershell
# 使用 MySQL client
mysql -u root -p
# inside mysql
CREATE DATABASE comment_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE comment_app;
SOURCE c:/Users/w7823/Desktop/Vue3PhpCommentApp/basic_comment.sql;
SOURCE c:/Users/w7823/Desktop/Vue3PhpCommentApp/testdata.sql;
```
2. 若 Laragon 密碼為空，請使用 `root` 並空密碼連線；或按 Laragon 的 MariaDB 設定使用你的 credentials。

---

## 4) 後端設定（PHP）
後端檔案位於 `backend/`。
1. 將 `backend/` 放到 Laragon 的 `www` 資料夾，或建立 virtual host 指向該資料夾。
2. 開啟 Laragon 靜態 root 頁或直接使用 URL 呼叫 API：
```
http://localhost/backend/login.php
http://localhost/backend/get_topic_with_comments.php?id=1
```
3. 若需要修改 MySQL 連線設定，編輯 `backend/db.php` 的 `$servername`, `$username`, `$password`, `$dbname`。

---

## 5) CORS 與跨域
- 前端 dev server (Vue) 預設為 `http://localhost:8080`。
- 若後端為 `http://localhost/backend`，請參考 `backend/db.php` 內的 CORS 設定：
  - 使用 `Access-Control-Allow-Origin` 回傳請求來源 (若啟用了 credentials)，或在 `vue.config.js` 加上 proxy 以避免 CORS。

若要在 `frontend/vue.config.js` 中設定 proxy（建議）:
```javascript
module.exports = {
  devServer: {
    proxy: {
      '^/backend': {
        target: 'http://localhost',
        changeOrigin: true,
        secure: false,
        xfwd: true
      }
    }
  }
}
```
這可以在瀏覽器端開發時避免 CORS 與 cookies 的跨域問題。

---

## 6) 使用 Ollama（選用）
若你要在本機使用 Ollama（local LLM）協助開發／測試：
1. 安裝 Ollama for Windows（依 Ollama 官方文件）：https://ollama.com/docs
2. 下載並啟動模型（例如 gpt-4o-mini）:
```powershell
# 先啟動 Ollama daemon (指令依官方)
ollama run gpt-4o-mini
# 或 pull model
ollama pull gpt-4o-mini
ollama run gpt-4o-mini
```
3. 使用 CLI 或 HTTP 接口與模型互動（文件依 Ollama）。

> Tip: Ollama 可用來產生內容、建議程式碼片段，或本地測試文字處理功能；但它不是必需項目。

---

## 7) 啟動流程（整體建議）
1. 啟動 Laragon，確保 Apache / MySQL 運作；或使用 Laragon 的 VirtualHost 指向後端目錄。
2. 在 `frontend/` 啟動 dev server：
```powershell
cd c:\Users\w7823\Desktop\Vue3PhpCommentApp\frontend
npm install
npm run serve
```
3. 確認 `backend` API 可用並回傳 JSON，若有 CORS，改為使用 `vue.config.js` proxy 或確保 `backend/db.php` 的 `Access-Control-Allow-Origin` 包含前端 origin。

---

## 8) 開發時常用命令
- 啟動前端：
```powershell
cd frontend
npm run serve
```
- 建置前端：
```powershell
cd frontend
npm run build
```
- 開啟 Laragon，啟動 Web 與 MySQL
- 對 PHP 檔案做修改，對應在 `http://localhost/backend/` 的 API
