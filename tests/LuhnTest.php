<?php
declare(strict_types=1);

namespace Tervis\Algorithms\Tests;

use PHPUnit\Framework\TestCase;
use Tervis\Algorithms\Luhn;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class LuhnTest extends TestCase
{
    private const WITH_CHECK_DIGIT = '1234-5678-9012-3452';

    private const WITHOUT_CHECK_DIGIT = '555-666-777-88';
    protected int $checkDigit = 6;


    public function testValidate()
    {
        $this->assertTrue(Luhn::validate(self::WITH_CHECK_DIGIT));
    }

    public function testCalculate()
    {
        $this->assertSame($this->checkDigit, Luhn::calculate(self::WITHOUT_CHECK_DIGIT));
    }

    public function testAppendCheckDigit()
    {
        $appended = Luhn::appendCheckDigit(self::WITHOUT_CHECK_DIGIT);
        $expected = self::WITHOUT_CHECK_DIGIT . $this->checkDigit;
        $this->assertSame($expected, $appended);
        $this->assertTrue(Luhn::validate($appended));
    }
}