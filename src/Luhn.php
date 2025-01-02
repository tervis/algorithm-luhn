<?php
declare(strict_types=1);

namespace Tervis\Algorithms;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class Luhn
{
    /**
     * Validates a number.
     * @param int|string $number
     * @return bool
     */
    public static function validate(int|string $number): bool
    {
        return self::getChecksum($number) === 0;
    }

    protected static function getChecksum(int|string $number): int
    {
        // digits only, replace anything else
        $number = preg_replace('/\W/', '', (string)$number);
        $parts = str_split($number);
        $sum = 0;
        
        for ($i = 0; $i < count($parts); $i++) {
            $factor = $i % 2 ? 1 : 2;
            $sum += array_sum(str_split((string)((int)$parts[$i] * $factor)));
        }

        return $sum % 10;
    }

    /**
     * Calculates the check digit and returns number with check digit appended.
     * @param int|string $partial_number
     * @return string
     */
    public static function appendCheckDigit(int|string $partial_number): string
    {
        return $partial_number . self::calculate($partial_number);
    }

    /**
     * Calculates the check digit of a number.
     * @param int|string $partial_number
     * @return int
     */
    public static function calculate(int|string $partial_number): int
    {
        $checksum = self::getChecksum($partial_number);
        return $checksum ? 10 - $checksum : $checksum;
    }
}