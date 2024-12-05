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

        return $data;
    }
    public function getParams(array|string $param): array|string
    {
        if (is_string($param)) {
            return Router::$params[$param] ?? "";
        }
        return array_map(fn($value) => $value, Router::$params);
    }
}