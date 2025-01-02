<?php
declare(strict_types=1);

namespace Tervis\Algorithms;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class Luhn
{
    public static function validate(string $number): bool
    {
        return self::getChecksum($number) === 0;
    }

    protected static function getChecksum(string $number): int
    {
        $number = preg_replace('/\W/', '', $number);
        $sequence = str_split($number);
        $sum = 0;
        for ($i = 0; $i < count($sequence); $i++) {
            $factor = $i % 2 ? 1 : 2;
            $sum += array_sum(str_split((string)((int)$sequence[$i] * $factor)));
        }

        return $sum % 10;
    }

    public static function appendCheckDigit($partial_number): string
    {
        return $partial_number . self::calculate($partial_number);
    }

    public static function calculate($partial_number): int
    {
        $checksum = self::getChecksum($partial_number);
        return $checksum ? 10 - $checksum : $checksum;
    }
}