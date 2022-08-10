<?php


namespace basics;


use JetBrains\PhpStorm\Pure;

class basics implements BasicsInterface
{
    private BasicsValidator $validator;

    #[Pure] public function __construct()
    {
        $this->validator = new BasicsValidator();
    }

    /**
     * @inheritDoc
     */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        if ($minute > 45 or $minute == 0) {
            return "fourth";
        }
        if ($minute <= 15) {
            return "first";
        }

        if ($minute <= 30) {
            return "second";
        }
        return "third";
    }

    /**
     * @inheritDoc
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));
    }

    /**
     * @inheritDoc
     */

    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $convertedString = str_split($input);
        $firstHalf =
            (int)$convertedString[0] +
            (int)$convertedString[1] +
            (int)$convertedString[2];
        $secondHalf =
            (int)$convertedString[3] +
            (int)$convertedString[4] +
            (int)$convertedString[5];
        return $firstHalf == $secondHalf;
    }
}