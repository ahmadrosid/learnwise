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
        $formattedAmount = '';

        switch ($currency) {
            case 'idr':
                $formattedAmount = 'Rp. '.number_format(abs($amount), 0, ',', '.');
                break;
            default:
                $formattedAmount = '$ '.number_format(abs($amount), 2, '.', ',');
                break;
        }

        return $amount < 0 ? '-'.$formattedAmount : $formattedAmount;
    }
}
