<?php


class Person
{
    private $firstName;
    private $lastName;
    private $age;

    public static $totalCount = 0;

    public function __construct($firstName, $lastName, $age)
    {  
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;

        static::$totalCount ++;
    }

    /* return total count of person */
    public static function getTotalCount()
    {
        return static::$totalCount;
    }

    /* return firstName LastName and Age */
    public function getFullName()
    {
        return sprintf("%s %s", $this->firstName, $this->lastName);
    }

    /* return Age x 365 day */
    public function getAge()
    {
        return $this->age * 365;
    }

    /*set age => only positif age*/
    public function setAge($age)
    {
        if($age < 0) {
            throw new Exception ("L'age est négatif ....");
        }
        $this->age = $age;
    }
}


$florent = new Person('florent', 'lacrotte', 28);
$fabien = new Person('fabien', 'lacrotte', 26);
$honore = new Person('honore', 'hounwanou', 34);

echo Person::getTotalCount() . PHP_EOL;