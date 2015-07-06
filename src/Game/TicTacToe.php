<?php
namespace Game;

/**
 * Class TicTacToe
 * @package Game
 */
class TicTacToe implements TicTacToeInterface
{
    /**
     * @var Board Object
     */
    protected $board;

    /**
     * @var array of Player objects
     */
    protected $players = [];

    /**
     * @var string or null
     */
    protected $lastMovedPlayer = null;

    /**
     * @var int
     */
    protected $moveNumber = 0;

    /**
    * @var string
    */
    protected $lastMove = null;

    /**
     * @var Player object
     */
    protected $winner = false;

    /**
     * @param Board $board
     * @param array $players
     */
    public function __construct(Board $board, array $players)
    {
        $this->board = $board;
        $this->setPlayers($players);
        $this->setWinningCounters();
    }

    /**
     * method show game status and show board
     * @return string
     */
    public function getGameStatus()
    {
        $gameStatus = sprintf("%d move in game: (%s) Player: %s\n\n",
                                $this->moveNumber, $this->lastMove, $this->lastMovedPlayer);
        $gameStatus .= $this->getResult();

        $this->showBoard();

        return $gameStatus;
    }

    /**
     *
     * @return string
     */
    public function getResult()
    {
        $result = "Continue playing.\n";

        if ($this->isEnded()) {
            $result = "Game Over.\n";
        }

        if ($this->isTied()) {
            $result = "Tied.\n";
        }

        if ($this->getWinner()) {
            $winner = $this->getWinner();
            $result .= sprintf("%s won, played %s.\n", $winner->getName(), $winner->getPlayerSign());
        }

        return $result;
    }

    /**
     * method for show board for current game
     */
    public function showBoard()
    {
        $this->board->showBoard();
    }

    /**
     * @return boolean
     */
    public function isEnded()
    {
        $result = false;

        if ($this->getWinner()) {
            $result = true;
        }

        if ( $this->isTied()) {
            $result = true;
        }
        return $result;
    }

    /**
     * @return boolean
     */
    public function isTied()
    {
        $result = false;
        if ($this->board->isBoardFull($this->moveNumber) &&
            false == $this->getWinner()) {

            $result = true;
        }
        return $result;
    }

    /**
     *
     * @return winner as Player object
     */
    public function getWinner()
    {
        foreach ($this->players as $player) {
            $winningCounter = $player->getWinningCounter();
            $winnerSign = $winningCounter->isAnyCounterEqualBoardSize();

            if ( $winnerSign ) {
                $this->winner = $this->players["$winnerSign"];
            }
            continue;
        }
        return $this->winner;
    }

    /**
     * @return null|string
     */
    public function getWinnerSign()
    {
        $result = null;
        if (false != $this->winner) {
            $result =  $this->winner->getPlayerSign();
        }

        return $result;
    }

    /**
     * $row,$column - 0,2
     *
     * @param Player $player
     * @param int $row
     * @param int $column
     */
    public function makeMove(Player $player, $row, $column)
    {
        $playerSign = $player->getPlayerSign();

        $this->isPlayerMove($playerSign);
        $this->board->isFieldEmpty($row, $column);

        $this->board->markField($player->getPlayerSign(),$row,$column);
        $player->getWinningCounter()->increaseCounters($row,$column);

        $this->lastMovedPlayer = $playerSign;
        $this->lastMove = sprintf("%d,%d",$row, $column);
        $this->moveNumber++;
    }

    /**
     * set object with winning counters for each player
     */
    private function setWinningCounters()
    {
        foreach ($this->players as $player) {
            $player->setWinningCounter( new WinningCounter($player->getPlayerSign(),
                $this->board->getBoardSize()));
        }
    }

    /**
     * @param $player
     * @return bool
     * @throws Exception\WrongPlayer
     */
    private function isPlayerMove($playerSign)
    {
        if ($playerSign == $this->lastMovedPlayer) {
            throw new Exception\WrongPlayer("It is not $playerSign move.");
        }
        return true;
    }

    /**
     * set arrays with Players objects
     * playerSign as array Key
     * @param array $players
     */
    private function setPlayers($players)
    {
        foreach ($players as $player) {
            $this->players[$player->getPlayerSign()] = $player;
        }
    }

}