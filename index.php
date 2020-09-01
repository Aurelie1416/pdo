<?php
    function interval(){
        ob_flush();
        usleep(500000);
        flush();
    }

    class Warriorfirst {
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

    $point = Wizardfirst::MAGIC_POINT_PER_ATTACK;

    class Wizardfirst {
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

        public function magic(){
            if($this->isalive() && $this->magicPoint > 0){
                $this->magicPoint -= 1;
            }
            else{
                return 0;
            }  
        }

        public function attack(){
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

    abstract class Fighter {

        protected $health;
        protected $hitPoint;

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

    class Warrior extends Fighter{
    }

    class Wizard extends Fighter{

        private $magicPoint;

        public function __construct(int $health, int $hitPoint, int $magicPoint = 10){
            parent::__construct($health, $hitPoint);
            $this->magicPoint = $magicPoint;
        }

        public function magic(){
            if($this->isalive() && $this->magicPoint > 0){
                $this->magicPoint -= 1;
            }
            else{
                return 0;
            }  
        }

        public function attack(){
            if($this->isalive() && $this->magicPoint > 0){
                return $this->hitPoint;
            }
            else{
                return 0;
            }  
        }
    }

    $batman = new Warriorfirst(100, rand(1, 20));
    $superman = new Warriorfirst(100, rand(1, 20));
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

    $harry = new Wizardfirst(100, rand(1, 100));
    $voldemort = new Wizardfirst(100, rand(1, 100));
    while($harry->isalive() == true && $voldemort->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $voldemort->takeDamage($harry->attack());
            $harry->magic();
            echo 'Harry Potter inflige '.$harry->attack().' points de dégats à Voldemort'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $harry->takeDamage($voldemort->attack());
            $voldemort->magic();
            echo 'Voldemort inflige '.$voldemort->attack().' points de dégats à Harry Potter'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $harry->takeDamage($voldemort->attack());
            $voldemort->takeDamage($harry->attack());
            $harry->magic();
            $voldemort->magic();
            echo 'Harry Potter inflige '.$harry->attack().' points de dégats à Voldemort et Voldemort inflige '.$voldemort->attack().' points de dégats à Harry Potter'.'<br>';
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

    $jedusor = new Wizard(100, rand(1, 20));
    $brucewayne = new Warrior(100, rand(1, 20));
    while($jedusor->isalive() == true && $brucewayne->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $brucewayne->takeDamage($jedusor->attack());
            $jedusor->magic();
            echo 'Voldemort inflige '.$jedusor->attack().' points de dégats à Batman'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $jedusor->takeDamage($brucewayne->attack());
            echo 'Batman inflige '.$brucewayne->attack().' points de dégats à Voldemort'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $jedusor->magic();
            $jedusor->takeDamage($brucewayne->attack());
            $brucewayne->takeDamage($jedusor->attack());
            echo 'Voldemort inflige '.$jedusor->attack().' points de dégats à Batman et Batman inflige '.$brucewayne->attack().' points de dégats à Voldemort'.'<br>';
            interval();
        }
    }  

    if ($brucewayne->isalive() == true){
        echo '<h2>Batman a battu Voldemort</h2>'.'<br>'.'<br>';
        interval();
    }
    else if($jedusor->isalive() == true){
        echo '<h2>Voldemort a battu Batman</h2>'.'<br>'.'<br>';
        interval();
    }

    $potter = new Wizard(100, rand(1, 20));
    $clarckkent = new Warrior(100, rand(1, 20));
    while($potter->isalive() == true && $clarckkent->isalive() == true){
        $hasard = rand(1, 3);
        if($hasard == 1){
            $clarckkent->takeDamage($potter->attack());
            $potter->magic();
            echo 'Harry Potter inflige '.$potter->attack().' points de dégats à Superman'.'<br>';
            interval();
        }
        else if($hasard == 2){
            $potter->takeDamage($clarckkent->attack());
            echo 'Superman inflige '.$clarckkent->attack().' points de dégats à Harry Potter'.'<br>';
            interval();
        } 
        else if($hasard == 3){
            $potter->magic();
            $potter->takeDamage($clarckkent->attack());
            $clarckkent->takeDamage($potter->attack());
            echo 'Harry Potter inflige '.$potter->attack().' points de dégats à Superman et Superman inflige '.$clarckkent->attack().' points de dégats à Harry Potter'.'<br>';
            interval();
        }
    }  

    if ($clarckkent->isalive() == true){
        echo '<h2>Superman a battu Harry Potter'.'<br>'.'<br>';
        interval();
    }
    else if($potter->isalive() == true){
        echo '<h2>Harry Potter a battu Superman</h2>'.'<br>'.'<br>';
        interval();  
    }
?>

<!-- array_push($warriors, 'Gannondorf', 'Wolverine', 'Mario', 'Link', 'Ironman', 'Spiderman', 'Thor', 'Hulk', 'Batman', 'Superman', 'Jocker', 'Lex Luthor', 'Wonderwoman', 'Arthur', 'Percival', 'Lancelot', 'Galahad', 'Gawain', 'Geralt de Rive', 'Ciri');
     array_push($wizards, 'Mystic', 'Sheik', 'Remus Lupin', 'Zelda', 'Magneto', 'Professor X', 'Doctor Strange', 'Harry Potter', 'Dumbledore', 'Voldemort', 'Hermione Granger', 'Ron Weasley', 'Sirius Black', 'Norbert Dragonneau', 'Gelert Grindewald', 'Merlin', 'Morgane', 'Viviane', 'Triss', 'Yennefer'); -->