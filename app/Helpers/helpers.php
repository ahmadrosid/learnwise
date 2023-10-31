<?php

use Illuminate\Support\Str;

if (! function_exists('formatThumbnail')) {
    function formatThumbnail($item)
    {
        return Str::startsWith($item->thumbnail, 'http') ? $item->thumbnail : asset('storage/'.$item->thumbnail);
    }
}

if (! function_exists('formatCurrency')) {
    function formatCurrency($amount)
    {
        $currency = getenv('CURRENCY');
        switch ($currency) {
            case 'idr':
                return "Rp. <?php echo number_format($amount, 0, ',', '.'); ?>";
            case 'usd':
                return "$ <?php echo number_format($amount, 2, '.', ','); ?>";

        }
    }
}
