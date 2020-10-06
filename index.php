<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

// Usage
$game = new CardGame();
$game->initGame();

while(!$game->isGameEnded) {
    $game->playRound();
}