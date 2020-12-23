<?php

interface IFighttable
{
    public function Attack(Machine $otherMachine);
    public function GetHP() :int;
}

abstract class Machine implements IFighttable
{
    protected $signalSound = "---";
    public $color = "black";
    private  $hp = 100;

    public function GetHP() :int
    {
        return $this->hp;
    }

    public function Attack(Machine $otherMachine)
    {
        $otherMachine->hp -= 10;
        $this->hp += 10;
    }

    public function Signal()
    {
        echo $this->modelName;
    }

    public abstract function Clean();
}


class Auto extends Machine 
{
    public $signalSound = "Beeep";
    public $соlor = "Red";

    public function Clean()
    {
        echo "clean auto";
    }
}
class Tank extends Machine
{
    public $signalSound = "Booom";
    public $color = "Green";

    public function Clean()
    {
        echo "clean tank";
    }
}

class Excavator extends Machine
{
    public $color = "Yellow";

    public function Clean()
    {
        echo "clean excavator";
    }

    public function UseBucket()
    {
        echo "bucket sound";
    }
} 


$auto = new Auto();
$tank = new Tank();
$ex = new Excavator();
var_dump($auto);
echo "<br><br>";
var_dump($tank);
echo "<br><br>";
var_dump($ex);
echo "<br><br>";

$auto->Signal();
$tank->Attack($ex);
$ex->UseBucket();

echo "<br><br>";
var_dump($auto);
echo "<br><br>";
var_dump($tank);
echo "<br><br>";
var_dump($ex);