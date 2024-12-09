<?php

namespace app\cores;

class Request
{

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    private function isGet(): bool
    {
        return $this->getMethod() === "GET";
    }

    private function isPost(): bool
    {
        return $this->getMethod() === "POST";
    }

    public function body(): array
    {
        $data = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        foreach ($_FILES as $key => $file) {
            // Jika multiple file uploads (error dalam bentuk array)
            if (is_array($file['error'])) {
                $data[$key] = [];
                foreach ($file['error'] as $index => $error) {
                    if ($error === UPLOAD_ERR_OK) {
                        $data[$key][$index] = [
                            'name' => $file['name'][$index],
                            'type' => $file['type'][$index],
                            'tmp_name' => $file['tmp_name'][$index],
                            'size' => $file['size'][$index],
                        ];
                    } else {
                        $data[$key][$index] = [
                            'error' => $error,
                            'message' => $this->fileUploadErrorMessage($error),
                        ];
                    }
                }
            } else {
                // Jika single file upload (error bukan array)
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $data[$key] = [
                        'name' => $file['name'],
                        'type' => $file['type'],
                        'tmp_name' => $file['tmp_name'],
                        'size' => $file['size'],
                    ];
                } else {
                    $data[$key] = [
                        'error' => $file['error'],
                        'message' => $this->fileUploadErrorMessage($file['error']),
                    ];
                }
            }
        }
        return $data;
    }
    private function fileUploadErrorMessage(int $errorCode): string
    {
        $errors = [
            UPLOAD_ERR_OK => 'Tidak ada error.',
            UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melebihi batas upload_max_filesize di php.ini).',
            UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melebihi batas MAX_FILE_SIZE yang ditentukan di form).',
            UPLOAD_ERR_PARTIAL => 'File hanya ter-upload sebagian.',
            UPLOAD_ERR_NO_FILE => 'Tidak ada file yang di-upload.',
            UPLOAD_ERR_NO_TMP_DIR => 'Folder temporer hilang.',
            UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk.',
            UPLOAD_ERR_EXTENSION => 'Upload file dihentikan oleh ekstensi PHP.',
        ];

        return $errors[$errorCode] ?? 'Error tidak dikenal.';
    }
    public function getParams(array|string $param): array|string
    {

        if (is_string($param)) {
            return Router::$params[$param] ?? "";
        }

        return array_map(fn($value) => $value, Router::$params);
    }
}
