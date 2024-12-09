<?php
class ArrayFormatter {

    public static function formatKeyValue(array $data): string {
        return implode(", ", array_map(function ($key, $value) {
            return "$key = $value";
        }, array_keys($data), $data));
    }
}
