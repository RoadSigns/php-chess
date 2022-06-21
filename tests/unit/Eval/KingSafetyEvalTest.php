<?php

namespace Chess\Tests\Unit\Eval;

use Chess\Board;
use Chess\Eval\KingSafetyEval;
use Chess\Tests\AbstractUnitTestCase;
use Chess\Tests\Sample\Opening\Sicilian\Closed as ClosedSicilian;
use Chess\Tests\Sample\Opening\Sicilian\Open as OpenSicilian;

class KingSafetyEvalTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function start()
    {
        $kSafetyEval = (new KingSafetyEval(new Board()))->eval();

        $expected = [
            'w' => 1,
            'b' => 1,
        ];

        $this->assertSame($expected, $kSafetyEval);
    }

    /**
     * @test
     */
    public function open_sicilian()
    {
        $board = (new OpenSicilian(new Board()))->play();

        $kSafetyEval = (new KingSafetyEval($board))->eval();

        $expected = [
            'w' => 1,
            'b' => 1,
        ];

        $this->assertSame($expected, $kSafetyEval);
    }

    /**
     * @test
     */
    public function closed_sicilian()
    {
        $board = (new ClosedSicilian(new Board()))->play();

        $kSafetyEval = (new KingSafetyEval($board))->eval();

        $expected = [
            'w' => 1,
            'b' => 1,
        ];

        $this->assertSame($expected, $kSafetyEval);
    }
}