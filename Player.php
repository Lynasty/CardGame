<?php

class Player {
    public function __construct() {
        $this->cardsInHand = [];
        $this->points = 0;
    }
    public function playCard() : array {
        $rand = rand(0,4);
        $card = $this->cardsInHand[$rand];
        unset($this->cardsInHand[$rand]);
        return $card;
    }

    public function drawStartingHand(Iterator $pileIterator) {
        for($i = 0; $i < 5; $i++) {
            $this->cardsInHand[] = $pileIterator->current();
            $pileIterator->next();
        }
    }

    public function drawCard(Iterator $pileIterator) {
        array_push($this->cardsInHand, $pileIterator->current());
        $pileIterator->next();
    }
}