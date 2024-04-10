<?php

namespace App\Enums;

enum StatusEnum: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case ARCHIVE = 'ARCHIVE';

    public static function getName(StatusEnum $status): string
    {
        return match ($status) {
            self::PUBLISHED => 'Опубликовано',
            self::DRAFT => 'Черновик',
            self::ARCHIVE => 'В архиве',
            default => 'Такого статуса нет!'
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
