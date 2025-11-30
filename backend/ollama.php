<?php
class OllamaService {
    private $ollamaUrl;
    private $modelName;

    public function __construct() {
        $this->ollamaUrl = "http://localhost:11434/api/generate";
        $this->modelName = "gemma3:1b";
    }

    /**
     * 向 OLLAMA 發送請求並獲取回應
     * @param string $prompt 提示詞
     * @param array $options 額外選項（可選）
     * @return array|false 成功返回包含回應的陣列，失敗返回 false
     */
    public function generate($prompt, $options = []) {
        $data = [
            'model' => $this->modelName,
            'prompt' => $prompt,
            'stream' => false
        ];

        // 合併額外選項
        if (!empty($options)) {
            $data = array_merge($data, $options);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->ollamaUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $result;
    }

    /**
     * 檢查 OLLAMA 服務是否可用
     * @return bool
     */
    public function isAvailable() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:11434/api/tags");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 200;
    }
}

// 建立全域實例
$ollama = new OllamaService();
?>