<?php

namespace Game;

interface TicTacToeInterface {

    /**
     * @param $player string (player sign)
     * @param $row integer
     * @param $column integer
     */
    public function makeMove(Player $player, $row,$column);

    /**
     * @return boolean
     */
    public function isEnded();

    /**
     * @return boolean
     */
    public function isTied();

    /**
     * @return Player object
     */
    public function getWinner();
}