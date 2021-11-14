<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ItemCategory extends Enum
{
    const PLAIN_BREAD =   1;
    const STUFFED_BREAD =   2;
    const PASTRIES = 3;
    const OTHERS = 9;

    public static function getDescription($value): string
    {
        if ($value === self::PLAIN_BREAD) {
            return '食パン';
        }
        if ($value === self::STUFFED_BREAD) {
            return '総菜パン';
        }
        if ($value === self::PASTRIES) {
            return '菓子パン';
        }
        if ($value === self::OTHERS) {
            return 'その他';
        }
        return parent::getDescription($value);
    }

    public static function getValue(string $key)
    {
        if ($key === '食パン') {
            return self::PLAIN_BREAD;
        }
        if ($key === '総菜パン') {
            return self::STUFFED_BREAD;
        }
        if ($key === '菓子パン') {
            return self::PASTRIES;
        }
        if ($key === 'その他') {
            return self::OTHERS;
        }
        return parent::getValue($key);
    }
}
