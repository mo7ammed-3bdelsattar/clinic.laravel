<?php

namespace App\Enums;


enum UserTypesEnum: string
{
    case ADMIN = '1';
    case MANAGER ='2';
    case DOCTOR ='3';
    case PATIENT ='4';

    /**
     * Get a friendly name for the user type.
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::MANAGER => 'Manager',
            self::DOCTOR => 'Doctor',
            self::PATIENT => 'Patient',
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
