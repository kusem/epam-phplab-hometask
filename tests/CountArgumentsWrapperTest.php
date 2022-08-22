<?php

use PHPUnit\Framework\TestCase;

class countArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->functions->countArgumentsWrapper(2, 4, 0, 2, ['russiaisaterroriststate']);
    }
}
