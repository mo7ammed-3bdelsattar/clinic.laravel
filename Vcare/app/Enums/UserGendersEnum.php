<?php

namespace App\Enums;


enum UserGendersEnum: string
{
    case MALE = '0';
    case FEMALE ='1';


    /**
     * Get a friendly name for the user type.
     */
    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        };
    }

    /**
     * Get all user types as an array.
     */
    public static function all(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    /**
     * Check if a given value is a valid user type.
     */
    public static function isValid(string $value): bool
    {
        return in_array($value, self::all(), true);
    }
}
