<?php

namespace app\cores;

class View
{
    private static string $title = "SIMPA-TI";
    private static array $data = [];


    public function render(string $viewPath, string $title, array $data = []): void
    {
        self::$title = $title;
        self::$data = $data;
        require_once "./views/layouts/header.php";
        require_once "./views/{$viewPath}.php";
        require_once "./views/layouts/footer.php";
    }


    public static function getTitle(): string
    {
        return self::$title;
    }

    public static function getData(): array
    {
        return self::$data;
    }

    private static function setTitle(string $title): void
    {
        self::$title = $title;
    }

    public function renderException(string $viewPath, array $data = []): void
    {
        self::setTitle($data["title"]);
        require_once "./views/layouts/header.php";
        require_once "./views/exceptions/{$viewPath}.php";
        require_once "./views/layouts/footer.php";

    }
}