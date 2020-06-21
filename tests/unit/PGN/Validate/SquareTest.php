<?php

namespace PGNChess\Tests\Unit\PGN;

use PGNChess\PGN\Symbol;
use PGNChess\PGN\Validate;
use PGNChess\Tests\AbstractUnitTestCase;

class SquareTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function integer_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        Validate::square(9);
    }

    /**
     * @test
     */
    public function float_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        Validate::square(9.75);
    }

    /**
     * @test
     */
    public function a9_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        Validate::square('a9');
    }

    /**
     * @test
     */
    public function foo_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        Validate::square('foo');
    }

    /**
     * @test
     */
    public function e4()
    {
        $this->assertEquals(Validate::square('e4'), 'e4');
    }
}