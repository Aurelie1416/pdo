<?php

abstract class Fighter
{
    /** @var string */
    protected $name;

    /** @var int */
    protected $health;

    /** @var int */
    protected $hitPoint;

    public function __construct(string $name, int $health, int $hitPoint)
    {
        $this->name = $name;
        $this->health = $health;
        $this->hitPoint = $hitPoint;
    }

    public function isAlive(): bool
    {
        return $this->health >= 0;
    }

    public function takeDamage(int $damage)
    {
        $this->health -= $damage;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return "Fighter " . $this->name;
    }
}

class Warrior extends Fighter
{
    public function attack(): int
    {
        if (!$this->isAlive()) {
            return 0;
        }

        return $this->hitPoint;
    }

    public function __toString()
    {
        return "Warrior " . $this->name;
    }
}

class Wizard extends Fighter
{
    const MAGIC_POINT_PER_ATTACK = 2;

    /** @var int */
    private $magicPoint;

    public function __construct(string $name, int $health, int $hitPoint)
    {
        parent::__construct($name, $health, $hitPoint);
        $this->magicPoint = 10;
    }

    public function attack(): int
    {
        if (!$this->isAlive() || $this->magicPoint <= 0) {
            return 0;
        }

        $this->magicPoint -= self::MAGIC_POINT_PER_ATTACK;
        return $this->hitPoint;
    }

    public function __toString()
    {
        return "Wizard " . $this->name;
    }
}

class Arena
{
    /** @var Fighter[] */
    private $fighters;

    /** @var Fighter|null */
    private $winner;

    public function __construct()
    {
        $this->fighters = [];
        $this->winner = null;
    }

    public function add(Fighter $fighter): void
    {
        $this->fighters[] = $fighter;
    }

    public function fightAll(): void
    {
        while (null === $this->winner) {
            $aliveFighters = $this->getAliveFighters();
            if (count($aliveFighters) === 0) {
                return;
            } elseif (count($aliveFighters) === 1) {
                $this->winner = $aliveFighters[0];
            } else {
                shuffle($aliveFighters);
                $fighterOne = $aliveFighters[0];
                $fighterTwo = $aliveFighters[1];
                $fighterOne->takeDamage($fighterTwo->attack());
                $fighterTwo->takeDamage($fighterOne->attack());
            }
        }

        //Here
    }

    public function getWinner(): ?Fighter
    {
        return $this->winner;
    }

    /**
     * @return Fighter[]
     */
    private function getAliveFighters(): array
    {
        $aliveFighters = [];
        foreach ($this->fighters as $fighter) {
            if ($fighter->isAlive()) {
                $aliveFighters[] = $fighter;
            }
        }

        return $aliveFighters;
    }
}

$arena = new Arena();
for ($i = 1; $i <= 10; $i++) {
    $warrior = new Warrior("Number $i", 100, rand(0, 50));
    $wizard = new Wizard("Number $i", 100, rand(25, 50));

    $arena->add($warrior);
    $arena->add($wizard);
}

$arena->fightAll();
$winner = $arena->getWinner();
if (null === $winner) {
    echo "<h1>There is no winner!</h1>";
} else {
    echo "<h1>" . $winner . " has won!</h1>";
}
