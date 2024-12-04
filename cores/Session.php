<?php
namespace app\cores;
class Session
{
    public function __construct()
    {
        session_start();
    }
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
    public static function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }
    public static function destroy(): void
    {
        session_destroy();
    }
}