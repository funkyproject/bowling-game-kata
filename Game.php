<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @category    PhpStorm
 * @author     aurelien
 * @copyright  2014 Efidev
 * @version    CVS: Id:$
 */

namespace Bowling;


class Game
{

    private $rolls = array();
    private $currentRoll = 0;

    public function roll($pin)
    {
        $this->rolls[$this->currentRoll++] = $pin;
    }

    public function score()
    {
        $score      = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {

            if ($this->isStrike($frameIndex)) {
                $score += 10 + $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];

                $frameIndex += 1;

            } else if ($this->isSpare($frameIndex)) {
                $score += 10 + $this->rolls[$frameIndex + 2];

                $frameIndex += 2;
            } else {

                $score += $this->rolls[$frameIndex];
                $score += $this->rolls[$frameIndex + 1];

                $frameIndex = $frameIndex + 2;
            }
        }

        return $score;
    }

    /**
     * @param $frameIndex
     * @return bool
     */
    private function isSpare($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10;
    }

    /**
     * @param $frameIndex
     * @return bool
     */
    private function isStrike($frameIndex)
    {
        return $this->rolls[$frameIndex] == 10;
    }
} 