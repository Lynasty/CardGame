<?php

class Pile {

    public function __construct() {
        $this->pile = [];
    }

    public function build() {
        $colors = ['Coeur','Pique','Carreau','Trefle'];
        foreach($colors as $color) {
            for($i = 1; $i <= 13; $i++ ) {
                // handle 'non-numeric' cards
                if($i == 1){
                    $this->pile[] = ["As de $color" => 14];
                } elseif($i == 11) {
                    $this->pile[] = ["Valet de $color" => 11];
                } elseif($i == 12) {
                    $this->pile[] = ["Dame de $color" => 12];
                } elseif($i == 13) {
                    $this->pile[] = ["Roi de $color" => 13];
                // handle 'numeric' cards
                } else {
                    $this->pile[] = ["$i de $color" => $i];
                }
            }
        }
    }

    public function shuffle() {
        shuffle($this->pile);
    }

    public function generator() : iterator {
        while(!empty($this->pile)) {
            yield array_pop($this->pile);
        }
    }
}