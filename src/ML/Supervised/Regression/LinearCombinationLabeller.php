<?php

namespace Chess\ML\Supervised\Regression;

use Chess\AbstractPicture;
use Chess\Heuristic\LinearCombinationEvaluation;
use Chess\PGN\Symbol;

/**
 * LinearCombination labeller.
 *
 * @author Jordi Bassagañas
 * @license GPL
 */
class LinearCombinationLabeller implements LabellerInterface
{
    private $heuristicPicture;

    private $sample;

    private $label;

    private $weights;

    public function __construct(AbstractPicture $heuristicPicture, array $sample = [])
    {
        $this->heuristicPicture = $heuristicPicture;

        $this->sample = $sample;

        $this->label = [
            Symbol::WHITE => 0,
            Symbol::BLACK => 0,
        ];

        $this->weights = (new LinearCombinationEvaluation($heuristicPicture))->getWeights();
    }

    public function label(): array
    {
        foreach ($this->sample as $color => $arr) {
            foreach ($arr as $key => $val) {
                $this->label[$color] += $this->weights[$key] * $val;
            }
            $this->label[$color] = round($this->label[$color], 2);
        }

        return $this->label;
    }
}
