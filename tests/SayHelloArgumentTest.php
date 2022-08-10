<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->SayHelloArgument($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['Epam', 'Hello Epam'],
            [1, 'Hello 1'],
            [true, 'Hello 1'],
        ];
    }
}