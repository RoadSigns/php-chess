<?php

namespace Chess\Tests\Unit\Evaluation;

use Chess\Board;
use Chess\Evaluation\Square as SquareEvaluation;
use Chess\Tests\AbstractUnitTestCase;

class SquareTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function start()
    {
        $board = new Board;

        $sqEvald = (new SquareEvaluation($board))->evaluate(SquareEvaluation::FEATURE_FREE);

        $expected = [
            'a3', 'a4', 'a5', 'a6',
            'b3', 'b4', 'b5', 'b6',
            'c3', 'c4', 'c5', 'c6',
            'd3', 'd4', 'd5', 'd6',
            'e3', 'e4', 'e5', 'e6',
            'f3', 'f4', 'f5', 'f6',
            'g3', 'g4', 'g5', 'g6',
            'h3', 'h4', 'h5', 'h6',
        ];

        $this->assertEquals($expected, $sqEvald);
    }
}
