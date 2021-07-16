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
$turns = 0; // maximum 20 turns
$count = 0; // for counting which player attacks
$damage = 0;
$luckEvil = 0;
$luckTim = 0;


echo '<h1>' . 'Start of battle' . '</h1>';
echo "

";

// displaying the players' skills
echo '<h2>' . "Tim's skills:" . '</h2>';
echo '<ul>';
echo '<li> Health: ' . $playerTim->getHealth() . '</li>';
echo '<li> Strength: ' . $playerTim->getStrength() . '</li>';
echo '<li> Defense: ' . $playerTim->getDefense() . '</li>';
echo '<li> Speed: ' . $playerTim->getSpeed() . '</li>';
echo '<li> Luck: ' . $playerTim->getLuck() . '</li>';
echo '</ul>';

echo '<h2>' . "Evil's skills:" . '</h2>';
echo '<ul>';
echo '<li> Health: ' . $playerEvil->getHealth() . '</li>';
echo '<li> Strength: ' . $playerEvil->getStrength() . '</li>';
echo '<li> Defense: ' . $playerEvil->getDefense() . '</li>';
echo '<li> Speed: ' . $playerEvil->getSpeed() . '</li>';
echo '<li> Luck: ' . $playerEvil->getLuck() . '</li>';
echo '</ul>';
echo "\n";

// the actions repeat for 20 turns (or less, if one of the players wins before the 20th turn)

do {
    // if the players have equal speeds
    if($playerEvil->getSpeed() == $playerTim->getSpeed()){
        // if Tim has greater luck than Evil
        if($playerTim->getLuck() > $playerEvil->getLuck()){
            // when count == 0, Tim attacks
            if($count == 0){
                echo '<h3> TURN ' . $turns . '</h3>';
                echo nl2br("\n");
                echo nl2br("Tim attacks!\n");
                
                $turns++;
                $damage = $playerTim->getStrength() - $playerEvil->getDefense(); // calculating the damage

                // checking to see if Tim has Banana Strike
                if($playerTim->bananaStrike()){
                    $damage = $damage * 2;
                    $turns++; // Tim strikes twice
                    echo nl2br("Tim has BANANA STRIKE: he attacks twice!\n");;
                }
                 // checking to see if Evil is lucky
                 if($playerEvil->getLuck() == 40 && $luckEvil == 0){
                    echo nl2br("Evil is lucky! DAMAGE = 0.");
                    $damage = 0;
                    $luckEvil = 1;
                }

                // setting the new value for Evil's health
                $playerEvil->setHealth($playerEvil->getHealth() - $damage);
                $count++; // Evil's turn to attack

                echo "Damage: " . $damage;
                echo nl2br("\n");
                echo "Evil's health:" . $playerEvil->getHealth();
                echo nl2br("\n");

                if($playerEvil->getHealth() < 0){
                    echo '<h3> Tim HAS WON THE BATTLE! </h3>';
                    echo "\n";
                    exit(); // ending the game
                }
            }

            // if the count is 1, Evil attacks
            if($count == 1){
                echo '<h3> TURN ' . $turns . '</h3>';
                echo nl2br("\n");
                echo 'Evil attacks!';
                echo nl2br("\n");
                $turns++;

                $damage = $playerEvil->getStrength() - $playerTim->getDefense();

                // checking to see if Tim has the Umbrella Shield
                if($playerTim->umbrellaShield()){
                    $damage = $damage / 2;
                    echo 'Tim uses the UMBRELLA SHIELD!';
                    echo nl2br("\n");
                }

                if($playerTim->getLuck() == 30 && $luckTim == 0){
                    echo 'Tim is LUCKY! DAMAGE = 0.';
                    echo nl2br("\n");
                    $luckTim = 1;
                    $damage = 0;
                }

                // recalculating Tim's health
                $playerTim->setHealth($playerTim->getHealth() - $damage);
                $count = 0;

                echo 'Damage: ' . $damage;
                echo nl2br("\n");
                echo "Tim's health: " . $playerTim->getHealth();
                echo nl2br("\n");

                if($playerTim->getHealth() < 0){
                    echo '<h3> Evil HAS WON THE BATTLE! </h3>';
                    exit();
                }

            }
        }

        // if Evil has greater luck than Tim
        else{
            if($count == 0){
                echo '<h3> TURN ' . $turns . '</h3>';
                echo nl2br("\n");
                echo 'Evil attacks!';
                echo nl2br("\n");
                $turns++;

                $damage = $playerEvil->getStrength() - $playerTim->getDefense();
                
                if($playerTim->umbrellaShield()){
                    $damage = $damage / 2;
                    echo 'Tim uses the UMBRELLA SHIELD!';
                    echo nl2br("\n");
                }

                if($playerTim->getLuck() == 30 && $luckTim == 0){
                    echo 'Tim is LUCKY! DAMAGE = 0.';
                    echo nl2br("\n");
                    $luckTim = 1;
                    $damage = 0;
                }

                // recalculating Tim's health
                $playerTim->setHealth($playerTim->getHealth() - $damage);

                echo 'Damage: ' . $damage;
                echo nl2br("\n");
                echo "Tim's health: " . $playerTim->getHealth();
                echo nl2br("\n");

                if($playerTim->getHealth() < 0){
                    echo '<h3> Evil HAS WON THE BATTLE! </h3>';
                    echo nl2br("\n");
                    exit();
                }
            }

            if($count == 1){
                echo '<h3> TURN ' . $turns . '</h3>';
                echo nl2br("\n");
                echo nl2br("Tim attacks!\n");
                $turns++;
                $damage = $playerTim->getStrength() - $playerEvil->getDefense(); // calculating the damage

                // checking to see if Tim has Banana Strike
                if($playerTim->bananaStrike()){
                    $damage = $damage * 2;
                    $turns++; // Tim strikes twice
                    echo 'Tim has BANANA STRIKE: he attacks twice!';
                    echo nl2br("\n");
                }
                 // checking to see if Evil is lucky
                 if($playerEvil->getLuck() == 40 && $luckEvil == 0){
                    echo 'Evil is lucky! DAMAGE = 0.';
                    echo nl2br("\n");
                    $damage = 0;
                    $luckEvil = 1;
                }

                // setting the new value for Evil's health
                $playerEvil->setHealth($playerEvil->getHealth() - $damage);
                $count = 0; 

                echo 'Damage: ' . $damage;
                echo nl2br("\n");
                echo "Evil's health:" . $playerEvil->getHealth();
                echo nl2br("\n");

                if($playerEvil->getHealth() < 0){
                    echo '<h3> Tim HAS WON THE BATTLE! </h3>';
                    exit(); // ending the game
                }
            }
        }
    }

    // if Tim has greater speed than Evil
    if($playerTim->getSpeed() > $playerEvil->getSpeed()){
        
        if($count == 0){
            echo '<h3> TURN ' . $turns . '</h3>';
            echo nl2br("\n");
            echo nl2br("Tim attacks!\n");
            $turns++;

            $damage = $playerTim->getStrength() - $playerEvil->getDefense();

            if($playerTim->bananaStrike()){
                $damage = $damage * 2;
                $turns++;
                echo 'Tim has BANANA STRIKE: he attacks twice!';
                echo nl2br("\n");
            }

            if($playerEvil->getLuck() == 40 && $luckEvil == 0){
                echo 'Evil is lucky! DAMAGE = 0.';
                $luckEvil = 1;
                echo nl2br("\n");
                $damage = 0;
            }

            $playerEvil->setHealth($playerEvil->getHealth() - $damage);
            $count++; 

            echo 'Damage: ' . $damage;
            echo nl2br("\n");
            echo "Evil's health:" . $playerEvil->getHealth();
            echo nl2br("\n");

            if($playerEvil->getHealth() < 0){
                echo '<h3> Tim HAS WON THE BATTLE! </h3>';
                exit(); // ending the game
            }
        }

        if($count == 1){
            echo '<h3> TURN ' . $turns . '</h3>';
            echo nl2br("\n");
                echo 'Evil attacks!';
                echo nl2br("\n");
                $turns++;

                $damage = $playerEvil->getStrength() - $playerTim->getDefense();
                
                if($playerTim->umbrellaShield()){
                    $damage = $damage / 2;
                    echo 'Tim uses the UMBRELLA SHIELD!';
                    echo nl2br("\n");
                }

                if($playerTim->getLuck() == 30 && $luckTim == 0){
                    echo 'Tim is LUCKY! DAMAGE = 0.';
                    echo nl2br("\n");
                    $luckTim = 1;
                    $damage = 0;
                }

                // recalculating Tim's health
                $playerTim->setHealth($playerTim->getHealth() - $damage);
                $count = 0;

                echo 'Damage: ' . $damage;
                echo nl2br("\n");
                echo "Tim's health: " . $playerTim->getHealth();
                echo nl2br("\n");

                if($playerTim->getHealth() < 0){
                    echo '<h3> Evil HAS WON THE BATTLE! </h3>';
                    echo nl2br("\n");
                    exit();
                }
        }
    }

    // if Evil has greater speed than Tim
    if($playerTim->getSpeed() < $playerEvil->getSpeed()){
        
        if($count == 0){
            echo '<h3> TURN ' . $turns . '</h3>';
            echo nl2br("\n");
                echo 'Evil attacks!';
                echo nl2br("\n");
                $turns++;

                $damage = $playerEvil->getStrength() - $playerTim->getDefense();
                
                if($playerTim->umbrellaShield()){
                    $damage = $damage / 2;
                    echo 'Tim uses the UMBRELLA SHIELD!';
                    echo nl2br("\n");
                }

                if($playerTim->getLuck() == 30 && $luckTim == 0){
                    echo 'Tim is LUCKY! DAMAGE = 0.';
                    echo nl2br("\n");
                    $damage = 0;
                    $luckTim = 1;
                }

                // recalculating Tim's health
                $playerTim->setHealth($playerTim->getHealth() - $damage);
                $count++;

                echo 'Damage: ' . $damage;
                echo nl2br("\n");
                echo "Tim's health: " . $playerTim->getHealth();
                echo nl2br("\n");

                if($playerTim->getHealth() < 0){
                    echo '<h3> Evil HAS WON THE BATTLE! </h3>';
                    echo nl2br("\n");
                    exit();
                }
        }

        if($count == 1){
            echo '<h3> TURN ' . $turns . '</h3>';
            echo nl2br("\n");
            echo nl2br("Tim attacks!");
            echo nl2br("\n");
            $turns++;

            $damage = $playerTim->getStrength() - $playerEvil->getDefense();

            if($playerTim->bananaStrike()){
                $damage = $damage * 2;
                $turns++;
                echo 'Tim has BANANA STRIKE: he attacks twice!';
                echo nl2br("\n");
            }

            if($playerEvil->getLuck() == 40 && $luckEvil == 0){
                echo 'Evil is lucky! DAMAGE = 0.';
                echo nl2br("\n");
                $damage = 0;
                $luckEvil = 1;
            }

            $playerEvil->setHealth($playerEvil->getHealth() - $damage);
            $count = 0;

            echo 'Damage: ' . $damage;
            echo nl2br("\n");
            echo "Evil's health:" . $playerEvil->getHealth();
            echo nl2br("\n");

            if($playerEvil->getHealth() < 0){
                echo '<h3> Tim HAS WON THE BATTLE! </h3>';
                exit(); // ending the game
            }
        }
    }

} while($turns <= 20);

if($playerTim->getHealth() < $playerEvil->getHealth()){
    echo '<h3> Tim HAS WON THE BATTLE! </h3>';
}
else{
    echo '<h3> Evil HAS WON THE BATTLE! </h3>';
}

?>
