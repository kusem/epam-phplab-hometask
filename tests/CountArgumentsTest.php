<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testPositiveString()
    {
        $this->assertEquals(
            [
                'argument_count' => 1,
                'argument_values' => Array (0 => '#russiaisaterroriststate'),
            ],
            $this->functions->countArguments('#russiaisaterroriststate')
        );
    }

    /**
     * Tests if empty argument sent
     */
    public function testPositiveEmpty()
    {
        $this->assertEquals(
            [
                'argument_count' => 0,
                'argument_values' => Array (),
            ],
            $this->functions->countArguments()
        );
    }

    /**
     * Tests for random qty of strings passed to array
     * @dataProvider positiveDataProviderMultipleArgs
     */
    public function testPositiveArgs($expected, $arg1, $arg2, $arg3, $arg4, $arg5 )
    {
        $this->assertEquals($expected, $this->functions->countArguments($arg1, $arg2, $arg3, $arg4, $arg5));
    }

    public function positiveDataProviderMultipleArgs(): array
    {
        return [
            '5 strings' =>[
                [
                    'argument_count' => 5,
                    'argument_values' => [
                        0 => 'russia',
                        1 => 'is',
                        2 => 'a',
                        3 => 'terrorist',
                        4 => 'state'
                    ],
                ],
                'russia', 'is', 'a','terrorist','state',
            ],
        ];
    }

}
