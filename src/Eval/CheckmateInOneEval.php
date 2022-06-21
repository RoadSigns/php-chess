<?php

namespace Chess\Eval;

use Chess\Board;
use Chess\PGN\AN\Color;

/**
 * Checkmate in one.
 *
 * @author Jordi Bassagañas
 * @license GPL
 */
class CheckmateInOneEval extends AbstractEval
{
    const NAME = 'Checkmate';

    public function __construct(Board $board)
    {
        parent::__construct($board);

        $this->result = [
            Color::W => 0,
            Color::B => 0,
        ];
    }

    public function eval(): array
    {
        foreach ($this->board->legalMoves() as $move) {
            $this->board->play($this->board->getTurn(), $move);
            if ($this->board->isMate()) {
                $this->result[$this->board->getTurn()] = 1;
                return $this->result;
            } else {
                $this->board->undo($this->board->getCastlingAbility());
            }
        }

        return $this->result;
    }
}