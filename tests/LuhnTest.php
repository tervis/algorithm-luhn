<?php
declare(strict_types=1);

namespace Tervis\Algorithms\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tervis\Algorithms\Luhn;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class LuhnTest extends TestCase
{
    public function testValidate(): void
    {
        $this->assertTrue(Luhn::validate('1234-5678-9012-3452')); // string
        $this->assertTrue(Luhn::validate(1234567890123452)); // int
        $this->assertFalse(Luhn::validate('555-666-777-88')); // without check digit
    }

    #[DataProvider('digitDataProvider')]
    public function testCalculate($value, $checkDigit): void
    {
        $this->assertSame($checkDigit, Luhn::calculate($value));
    }

    #[DataProvider('digitDataProvider')]
    public function testAppendCheckDigit($value, $checkDigit): void
    {
        $appended = Luhn::appendCheckDigit($value);
        $expected = $value . $checkDigit;

        $this->assertSame($expected, $appended);
        $this->assertTrue(Luhn::validate($appended));
    }

    public static function digitDataProvider(): iterable
    {
        yield ['1234567', 4];
        yield [1234567, 4];
        yield ['8765432', 3];
        yield ['555-666-777-88', 6];
        yield ['1234-5678-9012-345', 2];
    }
}