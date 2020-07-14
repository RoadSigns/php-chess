<?php

namespace PGNChess;

use PGNChess\Board;
use PGNChess\PGN\Symbol;

/**
 * Abstract heuristic snapshot.
 *
 * @author Jordi Bassagañas <info@programarivm.com>
 * @link https://programarivm.com
 * @license GPL
 */
abstract class AbstractHeuristicSnapshot
{
    protected $board;

    protected $moves;

    protected $snapshot = [];

    public function __construct(string $movetext)
    {
        $this->board = new Board;
        $this->moves = $this->moves($this->filter($movetext));
    }

    abstract public function take(): array;

    protected function moves(string $movetext)
    {
        $items = [];
        $pairs = array_filter(preg_split('/[0-9]+\./', $movetext));
        foreach ($pairs as $pair) {
            $items[] = array_values(array_filter(explode(' ', $pair)));
        }

        return $items;
    }

    protected function filter(string $movetext)
    {
        $movetext = str_replace([
            Symbol::RESULT_WHITE_WINS,
            Symbol::RESULT_BLACK_WINS,
            Symbol::RESULT_DRAW,
            Symbol::RESULT_UNKNOWN,
        ], '', $movetext);

        return $movetext;
    }
}