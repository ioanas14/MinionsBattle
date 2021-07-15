<?php

class Player{
    public $health;
    public $strength;
    public $defense;
    public $speed;
    public $luck;

    function getHealth(){
        return $this->health;
    }

    function getStrength(){
        return $this->strength;
    }

    function getDefense(){
        return $this->defense;
    }

    function getSpeed(){
        return $this->speed;
    }

    function getLuck(){
        return $this->luck;
    }

    function setHealth($newHealth){
        $this->health = $newHealth; 
    }
}

class Tim extends Player{

    function __construct(){
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defense = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->luck = rand(10, 30);
    }

// 10% chance of using this skill
    function bananaStrike(){
        
        $randomNumber = rand(1, 100);

        if($randomNumber <= 10)
            return true;
        else  
            return false;
    }

// 20% chance of using this skill
    function umbrellaShield(){

        $randomNumber = rand(1, 100);

        if($randomNumber <= 20)
            return true;
        else  
            return false;
    }



}

class Evil extends Player{

    function __construct(){
        $this->health = rand(60, 90);
        $this->strength = rand(60, 90);
        $this->defense = rand(40, 60);
        $this->speed = rand(40, 60);
        $this->luck = rand(25, 40);
    }
}


$playerTim = new Tim();
$playerEvil = new Evil();


?>
