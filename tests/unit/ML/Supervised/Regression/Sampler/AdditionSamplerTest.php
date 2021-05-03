<?php

namespace Chess\Tests\Unit\ML\Supervised\Regression\Sampler;

use Chess\Board;
use Chess\ML\Supervised\Regression\Sampler\AdditionSampler;
use Chess\PGN\Convert;
use Chess\PGN\Symbol;
use Chess\Tests\AbstractUnitTestCase;
use Chess\Tests\Sample\Checkmate\Fool as FoolCheckmate;
use Chess\Tests\Sample\Checkmate\Scholar as ScholarCheckmate;

class AdditionSamplerTest extends AbstractUnitTestCase
{
    /**
     * @test
     */
    public function start()
    {
        $board = new Board;

        $expected = [
            Symbol::WHITE => [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5],
            Symbol::BLACK => [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5],
        ];

        $this->assertEquals($expected, (new AdditionSampler($board))->sample());
    }

    /**
     * @test
     */
    public function w_e4_b_e5()
    {
        $board = new Board;

        $board->play(Convert::toStdObj(Symbol::WHITE, 'e4'));
        $board->play(Convert::toStdObj(Symbol::BLACK, 'e5'));

        $expected = [
            Symbol::WHITE => [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5],
            Symbol::BLACK => [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5],
        ];

        $this->assertEquals($expected, (new AdditionSampler($board))->sample());
    }

    /**
     * @test
     */
    public function fool_checkmate()
    {
        $board = (new FoolCheckmate(new Board))->play();

        $expected = [
            Symbol::WHITE => [0, 0.2, 0, 0, 0.9, 0, 0],
            Symbol::BLACK => [1, 1, 1, 1, 0, 1, 1],
        ];

        $this->assertEquals($expected, (new AdditionSampler($board))->sample());
    }

    /**
     * @test
     */
    public function scholar_checkmate()
    {
        $board = (new ScholarCheckmate(new Board))->play();

        $expected = [
            Symbol::WHITE => [1, 0.8, 0, 1, 0.07, 1, 0.87],
            Symbol::BLACK => [0, 0.4, 1, 0, 0.93, 0.4, 1],
        ];

        $this->assertEquals($expected, (new AdditionSampler($board))->sample());
    }
}