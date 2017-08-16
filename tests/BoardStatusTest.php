<?php
namespace PGNChess\Tests;

use PGNChess\Board;
use PGNChess\PGN\Convert;
use PGNChess\PGN\Symbol;
use PGNChess\Piece\Bishop;
use PGNChess\Piece\King;
use PGNChess\Piece\Knight;
use PGNChess\Piece\Pawn;
use PGNChess\Piece\Queen;
use PGNChess\Piece\Rook;
use PGNChess\Type\RookType;

class StatusTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiateDefaultBoardAndCountSquares()
    {
        $board = new Board;

        $this->assertEquals(count($board), 32);
        $this->assertEquals(count($board->getSquares()->used->w), 16);
        $this->assertEquals(count($board->getSquares()->used->b), 16);
    }

    public function testInstantiateCustomBoardAndCountSquares()
    {
        $pieces = [
            new Bishop(Symbol::WHITE, 'c1'),
            new Queen(Symbol::WHITE, 'd1'),
            new King(Symbol::WHITE, 'e1'),
            new Pawn(Symbol::WHITE, 'e2'),
            new King(Symbol::BLACK, 'e8'),
            new Bishop(Symbol::BLACK, 'f8'),
            new Knight(Symbol::BLACK, 'g8')
        ];

        $castling = (object) [
            Symbol::WHITE => (object) [
                'castled' => false,
                Symbol::CASTLING_SHORT => false,
                Symbol::CASTLING_LONG => false
            ],
            Symbol::BLACK => (object) [
                'castled' => false,
                Symbol::CASTLING_SHORT => false,
                Symbol::CASTLING_LONG => false
            ]
        ];

        $board = new Board($pieces, $castling);

        $this->assertEquals(count($board), 7);
        $this->assertEquals(count($board->getSquares()->used->w), 4);
        $this->assertEquals(count($board->getSquares()->used->b), 3);
    }

    public function testPlaySomeMovesAndCheckCastling()
    {
        $board = new Board;

        $board->play(Convert::toObject(Symbol::WHITE, 'd4'));
        $board->play(Convert::toObject(Symbol::BLACK, 'c6'));
        $board->play(Convert::toObject(Symbol::WHITE, 'Bf4'));
        $board->play(Convert::toObject(Symbol::BLACK, 'd5'));
        $board->play(Convert::toObject(Symbol::WHITE, 'Nc3'));
        $board->play(Convert::toObject(Symbol::BLACK, 'Nf6'));
        $board->play(Convert::toObject(Symbol::WHITE, 'Bxb8'));
        $board->play(Convert::toObject(Symbol::BLACK, 'Rxb8'));

        $castling = (object) [
            Symbol::WHITE => (object) [
                'castled' => false,
                Symbol::CASTLING_SHORT => true,
                Symbol::CASTLING_LONG => true
            ],
            Symbol::BLACK => (object) [
                'castled' => false,
                Symbol::CASTLING_SHORT => true,
                Symbol::CASTLING_LONG => false
            ]
        ];

        $this->assertEquals($castling, $board->getCastling());
    }

    public function testPlaySomeMovesAndCheckSpace()
    {
        $game = [
            'e4 e5',
            'f4 exf4',
            'd4 Nf6',
            'Nc3 Bb4',
            'Bxf4 Bxc3+'
        ];

        $board = new Board;

        foreach ($game as $entry)
        {
            $moves = explode(' ', $entry);
            $board->play(Convert::toObject(Symbol::WHITE, $moves[0]));
            $board->play(Convert::toObject(Symbol::BLACK, $moves[1]));
        }

        $example = (object) [
            Symbol::WHITE => [
                'a3',
                'a6',
                'b1',
                'b3',
                'b5',
                'c1',
                'c4',
                'c5',
                'd2',
                'd3',
                'd5',
                'd6',
                'e2',
                'e3',
                'e5',
                'f2',
                'f3',
                'f5',
                'g3',
                'g4',
                'g5',
                'h3',
                'h5',
                'h6'
            ],
            Symbol::BLACK => [
                'a5',
                'a6',
                'b4',
                'b6',
                'c6',
                'd2',
                'd5',
                'd6',
                'e6',
                'e7',
                'f8',
                'g4',
                'g6',
                'g8',
                'h5',
                'h6'
            ]
        ];

        $this->assertEquals($example, $board->getControl()->space);
    }
}
