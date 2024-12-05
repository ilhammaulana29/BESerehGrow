<?php

if (!function_exists('cleanNumericValues')) {
    function cleanNumericValues($data)
    {
        return array_map(function ($value) {
            if (is_numeric($value)) {
                return floatval($value); // Menghapus trailing zeros
            }
            return $value;
        }, $data);
    }
}
