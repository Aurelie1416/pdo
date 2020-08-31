<?php
    function interval(){
        ob_flush();
        flush();
    }

    class Warrior {
        private $health;
        private $hitPoint;

        public function __construct(int $health, int $hitPoint){
            $this->health = $health;
            $this->hitPoint = $hitPoint;
        }

        public function isalive(){
            if($this->health > 0){
                return true;
            }
            else{
                return false;
            }
            /* return $this->health > 0; 
            return !$this->health <= 0; */
        }

        public function attack(){
            if($this->isalive()){
                return $this->hitPoint; 
            }
            else{
                return 0;
            }
        }

        public function takeDamage(int $damage){
            $this->health -= $damage;
        }
    }

    $point = Wizard::MAGIC_POINT_PER_ATTACK;

    class Wizard {
        const MAGIC_POINT_PER_ATTACK = 1;
        private $health;
        private $hitPoint;
        private $magicPoint;

        public function __construct(int $health, int $hitPoint, int $magicPoint = 10){
            $this->health = $health;
            $this->hitPoint = $hitPoint;
            $this->magicPoint = $magicPoint;
        }

        public function isalive(){
            if($this->health > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function attack(){
            if($this->isalive() && $this->magicPoint > 0){
                $this->magicPoint -= 1;
            }
            else{
                return 0;
            }  
        }

        public function bilan(){
            if($this->isalive() && $this->magicPoint > 0){
                return $this->hitPoint;
            }
            else{
                return 0;
            }
        }

        public function takeDamage(int $damage){
            $this->health -= $damage;
        }
    }

    class Fighter {

        public function __construct(int $health, int $hitPoint){
            $this->health = $health;
            $this->hitPoint = $hitPoint;
        }

        public function isalive(){
            if($this->health > 0){
                return true;
            }
            else{
                return false;
            }
            /* return $this->health > 0; 
            return !$this->health <= 0; */
        }

        public function attack(){
            if($this->isalive()){
                return $this->hitPoint; 
            }
            else{
                return 0;
            }
        }

        public function magic(){
            if($this->isalive() && $this->magicPoint > 0){
                $this->magicPoint -= 1;
            }
            else{
                return 0;
            }  
        }

        public function takeDamage(int $damage){
            $this->health -= $damage;
        }
    }

    class Warrior2 extends Fighter{
        public function isalive(){

        }
    }

    class Wizzard2 extends Fighter{
        
    }

    $batman = new Warrior(100, rand(1, 20));
    $superman = new Warrior(100, rand(1, 20));
    while($batman->isalive() == true && $superman->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $superman->takeDamage($batman->attack());
            echo 'Batman inflige '.$batman->attack().' points de dégats à Superman'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $batman->takeDamage($superman->attack());
            echo 'Superman inflige '.$superman->attack().' points de dégats à Batman'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $batman->takeDamage($superman->attack());
            $superman->takeDamage($batman->attack());
            echo 'Batman inflige '.$batman->attack().' points de dégats à Superman et Superman inflige '.$superman->attack().' points de dégats à Batman'.'<br>';
            interval();
        }
    }  

    if ($batman->isalive() == false){
        echo '<h2>Superman a battu Batman</h2>'.'<br>'.'<br>';
        interval();
    }
    else if($superman->isalive() == false){
        echo '<h2>Batman a battu Superman</h2>'.'<br>'.'<br>';
        interval();
    }

    $harry = new Wizard(100, rand(1, 20));
    $voldemort = new Wizard(100, rand(1, 20));
    while($harry->isalive() == true && $voldemort->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $voldemort->takeDamage(rand(1, 20));
            $harry->attack();
            echo 'Harry Potter inflige '.$harry->bilan().' points de dégats à Voldemort'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $harry->takeDamage(rand(1, 20));
            $voldemort->attack();
            echo 'Voldemort inflige '.$voldemort->bilan().' points de dégats à Harry Potter'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $harry->takeDamage(rand(1, 20));
            $voldemort->takeDamage(rand(1, 20));
            $harry->attack();
            $voldemort->attack();
            echo 'Harry Potter inflige '.$harry->bilan().' points de dégats à Voldemort et Voldemort inflige '.$voldemort->bilan().' points de dégats à Harry Potter'.'<br>';
            interval();
        }
    }  

    if ($harry->isalive() == false){
        echo '<h2>Voldemort a battu Harry Potter</h2>'.'<br>'.'<br>';
        interval();
    }
    else if($voldemort->isalive() == false){
        echo '<h2>Harry Potter a battu Voldemort</h2>'.'<br>'.'<br>';
        interval();
    }

    $potter = new Wizard(100, rand(1, 20));
    $brucewayne = new Warrior(100, rand(1, 20));
    while($potter->isalive() == true && $brucewayne->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $brucewayne->takeDamage($potter->bilan());
            $potter->attack();
            echo 'Harry Potter inflige '.$potter->bilan().' points de dégats à Batman'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $potter->takeDamage($brucewayne->attack());
            echo 'Batman inflige '.$brucewayne->attack().' points de dégats à Harry Potter'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $potter->attack();
            $potter->takeDamage($brucewayne->attack());
            $brucewayne->takeDamage($potter->bilan());
            echo 'Harry Potter inflige '.$potter->bilan().' points de dégats à Batman et Batman inflige '.$brucewayne->attack().' points de dégats à Harry Potter'.'<br>';
            interval();
        }
    }  

    if ($potter->isalive() == false){
        echo '<h2>Batman a battu Harry Potter'.'<br>'.'<br>';
        interval();
    }
    else if($brucewayne->isalive() == false){
        echo '<h2>Harry Potter a battu Batman</h2>'.'<br>'.'<br>';
        interval();
    }
?>