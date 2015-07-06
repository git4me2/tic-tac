<?php

namespace Game;

/**
 * Class Player
 * @package Game
 */
class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $playerSign;

    /**
     * @var WinningCounter Object
     */
    private $winningCounter;

    /**
     * @param string $playerSign
     */
    function __construct($playerSign)
    {
        $this->playerSign = $playerSign;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlayerSign()
    {
        return $this->playerSign;
    }

    public function setWinningCounter(WinningCounter $winningCounter)
    {
        $this->winningCounter = $winningCounter;
    }

    public function getWinningCounter()
    {
        return $this->winningCounter;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}