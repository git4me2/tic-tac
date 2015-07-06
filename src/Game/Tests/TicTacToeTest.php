<?php
namespace Game\Tests;

use Game\Board;
use Game\Player;
use Game\TicTacToe;

class TicTacToeTest extends \PHPUnit_Framework_TestCase
{

    function testInitialize()
    {
        $board = new Board(3);
        $playersX = new Player('X');
        $playersO = new Player('O');

        new TicTacToe($board, [$playersX,$playersO]);
    }

    /**
     * @expectedException \Game\Exception\FieldTaken
     */
    function testSameField()
    {
        $board = new Board(3);
        $playersX = new Player('X');
        $playersO = new Player('O');

        $c = new TicTacToe($board, [$playersX,$playersO]);

        $c->makeMove($playersX, 1, 1);
        $c->makeMove($playersO, 1, 1);
    }

    /**
     * @expectedException \Game\Exception\WrongPlayer
     */
    function testWrongPlayer()
    {
        $board = new Board(3);
        $playersX = new Player('X');
        $playersO = new Player('O');

        $c = new TicTacToe($board, [$playersX,$playersO]);

        $c->makeMove($playersX,1, 1);
        $c->makeMove($playersX,1, 2);
    }

    function testGame()
    {
        $games   = Array();
        $games[] = '1274985W';
        $games[] = '15263W';
        $games[] = '1974352W';
        $games[] = '15487W';
        $games[] = '74859W';
        $games[] = '74859W';
        $games[] = '24578W';
        $games[] = '31547W';
        $games[] = '97541W';
        $games[] = '159647328T';
        $games[] = '579146823T';
        $games[] = '453912876T';

        for ($whoStarts = 0; $whoStarts <= 1; $whoStarts++)
            foreach ($games as $game) {

                $board = new Board(3);
                $playersX = new Player('X');
                $playersO = new Player('O');

                $c = new TicTacToe($board, [$playersX,$playersO]);

                $l = strlen($game);
                for ($i = 0; $i < $l; $i++) {
                    if ($game{$i} == 'W') {
                        $this->assertTrue($c->isEnded(), 'game not end after won');
                        $this->assertEquals($whoStarts ? $playersO->getPlayerSign() : $playersX->getPlayerSign(), $c->getWinnerSign());
                    } elseif ($game{$i} == 'T') {
                        $this->assertTrue($c->isEnded());
                        $this->assertTrue($c->isTied());
                    } else {
                        $p = intval($game{$i});
                        $posX = floor(($p - 1) / 3);
                        $posY = ($p - 1) % 3;
                        if ($i % 2 == $whoStarts) {
                            $c->makeMove($playersX, $posX, $posY);
                        }
                        else {
                            $c->makeMove($playersO, $posX, $posY);
                        }
                        if ($i < $l - 2) {
                            $this->assertFalse($c->isEnded(),'end of game should be false');
                            $this->assertFalse($c->isTied(), 'tied should be false');
                        }

                    }
                }
            }
    }

}