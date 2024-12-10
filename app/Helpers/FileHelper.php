<?php

if (!function_exists('storage_asset')) {
    function storage_asset($path)
    {
        return asset('storage' . $path);
    }
}