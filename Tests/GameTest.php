<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @category    PhpStorm
 * @author     aurelien
 * @copyright  2014 Efidev
 * @version    CVS: Id:$
 */

namespace Bowling\Tests;


use Bowling\Game;

class GameTest extends \PHPUnit_Framework_TestCase
{

    private $game;

    protected function setUp()
    {
        $this->game = new Game();
    }

    public function testGutterGame()
    {
        $this->rollMany(20, 0);
        $this->assertEquals(0, $this->game->score());
    }

    public function testAllOnes()
    {
        $this->rollMany(20, 1);
        $this->assertEquals(20, $this->game->score());
    }

    public function testOneSpare()
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->rollMany(17, 0);

        $this->assertEquals(16, $this->game->score());
    }

    public function testOneStrike()
    {
        $this->game->roll(10);
        $this->game->roll(3);
        $this->game->roll(4);

        $this->rollMany(16, 0);

        $this->assertEquals(24, $this->game->score());
    }

    public function testPerfectGame()
    {
        $this->rollMany(12,10);

        $this->assertEquals(300, $this->game->score());
    }

    private function rollMany($n, $points)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->game->roll($points);
        }
    }


    private function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

}
 