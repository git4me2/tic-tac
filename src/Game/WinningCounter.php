<?php

namespace Game;

/**
 * Class Board
 * @package Game
 */
class WinningCounter
{
    /**
     * @var string
     */
    private  $playerSign;

    /**
     * @var array
     */
    protected $rowsCounters = [];

    /**
     * @var array
     */
    protected $colsCounters = [];

    /**
     * @var int
     */
    protected $diagonalCounter = 0;

    /**
     * @var int
     */
    protected $antiDiagonalCounter = 0;


    /**
     * @param string $playerSign
     * @param int $boardSize
     */
    public function __construct($playerSign, $boardSize)
    {
        $this->playerSign = $playerSign;
        $this->boardSize = $boardSize;
    }

    /**
     * @return string
     */
    public function isAnyCounterEqualBoardSize()
    {
        $winner = false;

        foreach ($this->rowsCounters as $rowCounter) {
            if ($rowCounter == $this->boardSize) {
                $winner = $this->playerSign;
            }
        }

        foreach ($this->colsCounters as $columnCounter) {
            if ($columnCounter == $this->boardSize) {
                $winner = $this->playerSign;
            }
        }

        if ($this->diagonalCounter == $this->boardSize) {
            $winner = $this->playerSign;
        }

        if ($this->antiDiagonalCounter == $this->boardSize) {
            $winner = $this->playerSign;
        }

        return $winner;
    }
    
    /**
     * @param $row
     * @param $column
     */
    public function increaseCounters($row,$column)
    {
        $this->increaseRowsCounter($row);
        $this->increaseColsCounter($column);

        // 0,0  1,1  2,2
        if ( $row == $column) {
            $this->increaseDiagonalCounter($row,$column);
        }

        // 0,2  1,1  2,0 example for boardSize 3x3
        // row,col(2,0) = boardSize-1 antiDiagonal 2+0 = 3-1
        if ( $row + $column == $this->boardSize-1) {
            $this->increaseAntiDiagonalCounter($row, $column);
        }
    }

    /**
     * @param int $row
     */
    private function increaseRowsCounter($row)
    {
        if (empty($this->rowsCounters[$row])) {
            $this->rowsCounters[$row] = 0;
        }
        $this->rowsCounters[$row]++;
    }

    /**
     * @param int $column
     */
    private function increaseColsCounter($column)
    {
        if (empty($this->colsCounters[$column])) {
            $this->colsCounters[$column] = 0;
        }
        $this->colsCounters[$column]++;
    }

    private function increaseDiagonalCounter()
    {
        $this->diagonalCounter++;
    }

    private function increaseAntiDiagonalCounter()
    {
        $this->antiDiagonalCounter++;
    }
}