<?php




namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

Enum DaysEnum: string
{

    case SATURDAY ='1';
    case SUNDAY ='2';
    case MONDAY ='3';
    case TUESDAY ='4';
    case WEDNESDAY ='5';
    case THURSDAY ='6';
    case FRIDAY ='7';

    /**
     * Get a friendly name for the user type.
     */
    public function label(): string
    {
        return match ($this) {
            self::SATURDAY=>'Saturday',
            self::SUNDAY => 'Sunday',
            self::MONDAY => 'Monday',
            self::TUESDAY =>'Tuesday',
            self::WEDNESDAY=>'Wednesday',
            self::THURSDAY => 'Thursday',
            self::FRIDAY => 'Friday',
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