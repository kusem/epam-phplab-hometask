<?php

use PHPUnit\Framework\TestCase;

/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 */
class GetUniqueFirstLettersTest extends TestCase
{

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    [
                        "name" => "Albuquerque Sunport International Airport",
                        "code" => "ABQ",
                        "city" => "Albuquerque",
                        "state" => "New Mexico",
                        "address" => "2200 Sunport Blvd, Albuquerque, NM 87106, USA",
                        "timezone" => "America/Los_Angeles",
                    ],
                    [
                        "name" => "Charleston International Airport",
                        "code" => "CHS",
                        "city" => "Charleston",
                        "state" => "South Carolina",
                        "address" => "5500 International Blvd, Charleston, SC 29418, USA",
                        "timezone" => "America/New_York",
                    ],
                    [
                        "name" => "Baltimore Washington Airport",
                        "code" => "BWI",
                        "city" => "Baltimore",
                        "state" => "Maryland",
                        "address" => "Baltimore, MD 21240, USA",
                        "timezone" => "America/New_York",
                    ],
                ],
                ['A', 'B', 'C'],
            ],
        ];
    }
}
