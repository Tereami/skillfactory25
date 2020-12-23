<?php
declare(strict_types=1);

abstract class Person
{
    public $age;
    public $name;
    public $surname;
    
    private static $allPeoplesCount = 0;
    public static function GetAllPeoplesCount()
    {
        return static::$allPeoplesCount;
    }

    public function __construct(int $Age, string $Name, string $Surname)
    {
        self::$allPeoplesCount++;
        $this->age = $Age;
        $this->name = $Name;
        $this->surname = $Surname;
    }
}

class Adult extends Person
{
    public $partner;
    
    public function setPartner(Adult $newPartner)
    {
        $this->partner = $newPartner;
    }
}

class Child extends Person
{
    public $isMale;
    public $mother;
    public $father;

    public function __construct()
    {
        $this->age = 0;
        $this->isMale = rand(0,1) == 1;
    }
}

class Family
{
    private $members = [];
    public $familySurname;

    public function getAllMembers()
    {
        return $this->members;
    }

    public function __construct(Adult $wife, Adult $husband)
    {
        $wife->setPartner($husband);
        $husband->setPartner($wife);
        $this->members[] = $husband;
        $this->members[] = $wife;
        $this->familySurname = $husband->surname;
    }

    public function BornChild() :Person
    {
        $child = new Child();
        $child->father = $this->members[0];
        $child->mother = $this->members[1];
        $this->members[] = $child;
        return $child;
    }

    public function getMembersCount() :int
    {
        return count($this->members);
    }
}


$wife1 = new Adult(43, "Maria", "Smith");
$wife2 = new Adult(18, "Anna", "Black");
$husband = new Adult(47, "Andy", "Mayer");
$family1 = new Family($wife1, $husband);
$family2 = new Family($wife2, $husband);

$child1 = $family1->BornChild();

echo "Family1 members: " . $family1->getMembersCount();
echo "<br>Family2 members: " . $family2->getMembersCount();
echo "<br>Sum peoples: " . Person::GetAllPeoplesCount();
//хм, Child не учитывается - не запускается конструктор в классе Person