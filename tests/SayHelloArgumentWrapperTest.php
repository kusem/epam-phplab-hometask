<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     *
     * @dataProvider exceptionDataProvider
     */
    public function testException($input)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->functions->sayHelloArgumentWrapper($input);
    }

    public function exceptionDataProvider(): array
    {
        return [
            'null'      => [null, InvalidArgumentException::class],
            'double'    => [3.14, InvalidArgumentException::class],
            'array'     => [['russia', 'is', 'a', 'terrorist', 'state'], InvalidArgumentException::class],
            'stdClass'  => [new stdClass(), InvalidArgumentException::class],
            //'string'  => ["", InvalidArgumentException::class], // should fail - valid data type, but exception is expected
        ];
    }
}