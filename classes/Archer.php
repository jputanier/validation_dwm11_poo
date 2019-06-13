<?php 
class Archer extends Character {

    public function __construct($pseudo) {
        $this->pseudo = $pseudo;
        $this->carquois = 7;
        $this->arrow = 9;
        $this->lifePoint = 300;
        $this->critArrow = false;
    }
    public function action($target) {
        if($this->carquois == 0) { // si il n'y as plus de flèches dans le carquois, attaque numero 3.
            $this->daggerAttack($target);
            $status = "$this->pseudo n'as plus de flèches, il attaque avec une dague $target->pseudo qui a $target->lifePoint points de vie!";
            return $status;
        } else { // sinon, attaque 1 ou 2 choisies aléatoirement.
            if($this->critArrow == true) {
                $rand = rand(70, 100);
                $this->critAttack($target);
                if ($this->critArrow == false) {
                    $status = "$this->pseudo envoie son attaque critique ! Il lui reste $this->carquois flèches. ($target->lifePoint PDV pour $target->pseudo)";
                    return $status;
                } else if ($this->critArrow == true) {
                    $status = "$this->pseudo charge son attaque critique, il n'attaque pas pendant ce tour.($target->lifePoint PDV pour $target->pseudo)";
                    return $status;
                }    
            } else {
                $rand = rand(1, 100);
                if ($rand >= 1 && $rand <= 70) {
                    $this->arrowAttack($target);
                    $status = "$this->pseudo attaque $target->pseudo qui a $target->lifePoint points de vie! Il reste $this->carquois flèches à $this->pseudo!";
                    return $status;
                } else if ($rand > 70 && $rand <= 100) {
                    $this->critAttack($target);
                    if ($this->critArrow == false) {
                        $status = "$this->pseudo envoie son attaque critique ! ($target->lifePoint PDV pour $target->pseudo)";
                        return $status;
                    } else if ($this->critArrow == true) {
                        $status = "$this->pseudo charge son attaque critique, il n'attaque pas pendant ce tour.($target->lifePoint PDV pour $target->pseudo)";
                        return $status;
                    }
                }
            }
        }         
    }
    // Attaque simple avec une fleche
    public function arrowAttack($target) {
        // $arrow vaut pour une flèche avec des dégats de 5.
        $damage = $this->arrow;
        $this->carquois--; // a chaque fois que Jon tire une flèche, on en retire une du carquois. 
        $target->setHP($damage);
        $target->isAlive();
    }
    // Attaque critique au tour suivant.
    public function critAttack($target) {
        if ($this->critArrow == false) {
            $damage = 0;
            $target->setHP($damage);
            $target->isAlive();
            $this->critArrow = true; 
        } else if ($this->critArrow == true) {
            $damage = $this->arrow * rand(1.5, 3);
            $this->carquois--;
            $target->setHP($damage);
            $target->isAlive();
            $this->critArrow = false;
        }
        return;
    }
    // Attaque avec une dague si plus de flèches disponible.
    public function daggerAttack($target) {
        $damage = 5;
        $target->setHP($damage);
        $target->isAlive();
    }

    public function setHP($damage) {
        $this->lifePoint -= $damage;
        return;
    }
}