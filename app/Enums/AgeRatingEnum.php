<?php

namespace App\Enums;

enum AgeRatingEnum: string
{
    case ZERO = '0+';
    case SIX = '6+';
    case TWELVE = '12+';
    case SIXTEEN = '16+';
    case EIGHTEEN = '18+';

    public static function getName(AgeRatingEnum $status): string
    {
        return match ($status) {
            self::ZERO => '0+',
            self::SIX => '6+',
            self::TWELVE => '12+',
            self::SIXTEEN => '16+',
            self::EIGHTEEN => '18+',
            default => 'Такого возрастного рейтинга нет!'
        };
    }

    public static function getAll(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
