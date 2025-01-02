# algorithms-luhn
Luhn algorithm implementation for PHP

The Luhn algorithm, also known as the `modulus 10` or `mod 10` algorithm, is a simple checksum formula used to validate a variety of identification numbers, such as credit card numbers, IMEI numbers and some national identity numbers.

Luhn makes it possible to check numbers thanks to its control key (a digit which makes it possible to check the others digits). If a character is misread or badly written, then Luhn's algorithm will detect this error.


> Example: `12345674` is a valid card number, `1234567` is the initial number and `4` is the checksum.

The Luhn algorithm starts by the end of the number, from the last right digit to the first left digit. Multiplying by 2 all digits of even rank.
If the double of a digit is equal or superior to 10, replace it by the sum of its digits.

Realize the sum $s$ of all digits found. The control digit $c$ is equal to $c = (10 − (s mod 10)) mod 10 $.

## Installation

To add this package as a dependency to your project, simply add a dependency on `tervis/algorithms-luhn` to your project's `composer.json` file.
```json
    {
        "require": {
            "tervis/algorithms-luhn": "*"
        }
    }
```
### Usage

```php
use Tervis\Algorithms\Luhn;
```

#### Static methods

Validates a number.
```php
Luhn::validate('12345678'); // returns false
Luhn::validate(87654323); // returns true
```

Calculates the check digit of a number.
```php
Luhn::calculate('1234567'); // returns 4
Luhn::calculate(8765432); // returns 3
```

Calculates the check digit and returns number with check digit appended.
```php
Luhn::appendCheckDigit('1234567'); // returns 12345674
Luhn::appendCheckDigit(8765432); // returns 87654323
```