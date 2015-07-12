<?php

namespace Game;

/**
 * Class Board
 * @package Game
 */
class Board
{
	/**
	* sign used when board is showing
	*/
    const EMPTY_SIGN = ".";
    /**
     * @var int
     */
    private $boardSize;

    /**
     * @var int
     */
    private $maxNrOfElements;

    /**
     * @var array with all fields
     */
    private $fields;


    /**
     * @param $boardSize int
     */
    function __construct($boardSize)
    {
        $this->boardSize = $boardSize;
        $this->maxNrOfElements = $boardSize * $boardSize;
        $this->createBoard();
    }

    /**
     * create empty arrays for board fields
     */
    private function createBoard()
    {
        for ( $rowCounter = 0; $rowCounter < $this->boardSize; $rowCounter++) {

            $this->fields[$rowCounter] = [];

            for ( $columnCounter = 0; $columnCounter < $this->boardSize; $columnCounter++) {
                $this->fields[$rowCounter][] = static::EMPTY_SIGN;
            }
        }
    }

    /**
     * @return int
     */
    public function getBoardSize()
    {
        return $this->boardSize;
    }

    /**
     * @return int
     */
    public function getMaxNrOfElements()
    {
        return $this->maxNrOfElements;
    }

    /**
     * @param string $column
     * @param int $row
     * @param int $column
     */
    public function markField($playerSign, $row, $column)
    {
        $this->isFieldEmpty($row,$column);
        $this->fields[$row][$column] = $playerSign;
    }

    public function isBoardFull($moveNumber)
    {
        $result = false;

        if ($this->getMaxNrOfElements() == $moveNumber) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param $row
     * @param $column
     * @return bool
     * @throws Exception\FieldTaken
     */
    public function isFieldEmpty($row,$column)
    {
        if ( static::EMPTY_SIGN != $this->fields[$row][$column]) {
            throw new Exception\FieldTaken("Field $row,$column is taken.");
        }
        return true;
    }

    /**
     * method echo current state of the board
     */
    public function showBoard()
    {
        ksort($this->fields);

        foreach ($this->fields as $columns) {
            echo '<br/>';
            foreach ($columns as $columnValue) {
                echo ' '.$columnValue.' ';
            }
        }
        echo '<br/><br/>';
    }

}