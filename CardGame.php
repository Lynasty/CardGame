<?php

class CardGame {
    public function __construct() {
        $this->pile = new Pile();
        $this->player1 = new Player();
        $this->player2 = new Player();
        $this->isGameEnded = false;
    }

    public function initGame() {
        
        // Initiate pile and pileGenerator
        $this->pile->build();
        $this->pile->shuffle();
        $this->pileGenerator = $this->pile->generator();

        // Get Starting Hands
        $this->player1->drawStartingHand($this->pileGenerator);
        $this->player2->drawStartingHand($this->pileGenerator);
    }

    public function playRound() {
        // Get cards value
        $cardPlayer1 = $this->player1->playCard();
        $cardPlayer2 = $this->player2->playCard();

        $cardValuePlayer1 = current($cardPlayer1);
        $cardValuePlayer2 = current($cardPlayer2);

        // Compare cards value
        if($cardValuePlayer1 > $cardValuePlayer2) {
            $this->player1->points += 1;
        } elseif ($cardValuePlayer2 > $cardValuePlayer1) {
            $this->player2->points += 1;
        } else {
            NULL;
        }

        // Players draw a card
        $this->player1->drawCard($this->pileGenerator);
        $this->player2->drawCard($this->pileGenerator);

        // Fix skipped indexes
        sort($this->player1->cardsInHand);
        sort($this->player2->cardsInHand);

        // Handle end-game
        $cardLeftInPile = count($this->pile->pile);
        if(!$cardLeftInPile) {
            $this->endGame();
        }
    }

    public function endGame(){
        if($this->player1->points > $this->player2->points) {
            echo 'Player 1 WINS THE GAME ! WOOP WOOP !';
        }
        if($this->player1->points < $this->player2->points) {
            echo 'Player 2 WINS THE GAME ! WOOP WOOP !';
        }
        $this->isGameEnded = true;
    }
}