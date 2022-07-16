<?php

namespace Chess\Tests\Unit\Fen;

use Chess\FEN\StrToPgn;
use Chess\Tests\AbstractUnitTestCase;

class StrToPgnTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function e4()
    {
        $pgn = (new StrToPgn(
            'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq -',
            'rnbqkbnr/pppppppp/8/8/4P3/8/PPPP1PPP/RNBQKBNR b KQkq e3'
        ))->create();

        $expected = [
            'w' => 'e4',
        ];

        $this->assertSame($expected, $pgn);
    }

    /**
     * @test
     */
    public function Nf3()
    {
        $pgn = (new StrToPgn(
            'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq -',
            'rnbqkbnr/pppppppp/8/8/8/5N2/PPPPPPPP/RNBQKB1R b KQkq -'
        ))->create();

        $expected = [
            'w' => 'Nf3',
        ];

        $this->assertSame($expected, $pgn);
    }

    /**
     * @test
     */
    public function e6()
    {
        $pgn = (new StrToPgn(
            'rnbqkbnr/pp1ppppp/8/2p5/4P3/5N2/PPPP1PPP/RNBQKB1R b KQkq -',
            'rnbqkbnr/pp1p1ppp/4p3/2p5/4P3/5N2/PPPP1PPP/RNBQKB1R w KQkq - 0 2'
        ))->create();

        $expected = [
            'b' => 'e6',
        ];

        $this->assertSame($expected, $pgn);
    }
}
