<?php

use Illuminate\Support\Str;

if (!function_exists('formatThumbnail')) {
    function formatThumbnail($item)
    {
        return Str::startsWith($item->thumbnail, 'http') ? $item->thumbnail : asset('storage/' . $item->thumbnail);
    }
}
