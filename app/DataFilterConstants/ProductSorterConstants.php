<?php

namespace App\DataFilterConstants;

use Illuminate\Support\Facades\Log;

class ProductSorterConstants
{
    const LATEST = 'Date: Latest';
    const PRICE_LOW_TO_HIGH = 'Price: Low to High';
    const PRICE_HIGH_TO_LOW = 'Price: High to Low';

    private function __construct()
    {
    }

    public static function toArray()
    {
        return [
            static::LATEST,
            static::PRICE_LOW_TO_HIGH,
            static::PRICE_HIGH_TO_LOW,
        ];
    }
}
