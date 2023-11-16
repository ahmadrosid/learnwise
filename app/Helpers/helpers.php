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

if (! function_exists('sec2HMS')) {
    function sec2HMS($seconds)
    {

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        if ($hours > 0) {
            $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
            $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
            $formattedSeconds = str_pad($remainingSeconds, 2, '0', STR_PAD_LEFT);

            return "$formattedHours:$formattedMinutes:$formattedSeconds";
        } else {
            $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
            $formattedSeconds = str_pad($remainingSeconds, 2, '0', STR_PAD_LEFT);

            return "$formattedMinutes:$formattedSeconds";
        }
    }
}
