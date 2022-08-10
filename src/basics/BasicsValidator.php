<?php


namespace basics;


use InvalidArgumentException;

class BasicsValidator implements BasicsValidatorInterface
{

    /**
     * @inheritDoc
     */
    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 or $minute >= 60) {
            throw new InvalidArgumentException('Argument should be in range 0..59');
        }
    }

    /**
     * @inheritDoc
     */
    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new InvalidArgumentException('Cannot work with year<1900');
        }
    }

    /**
     * @inheritDoc
     */
    public function isValidStringException(string $input): void
    {
        if (strlen($input) != 6) {
            throw new InvalidArgumentException('String should have length=6');
        }
    }
}