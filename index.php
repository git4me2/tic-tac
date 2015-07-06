<?php
namespace Game;

require "vendor/autoload.php";
echo "<PRE>" . PHP_EOL;

$board = new Board(3);
$pX = new Player('X');
$pX->setName('Robert');

$pO = new Player('O');
$pO->setName('Andrzej');

$game = new TicTacToe($board, [$pX,$pO]);


$game->makeMove($pX,0,0);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pO,0,1);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pX,2,0);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pO,1,0);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pX,2,2);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pO,2,1);
echo $game->getGameStatus() . PHP_EOL;

$game->makeMove($pX,1,1);
echo $game->getGameStatus() . PHP_EOL;