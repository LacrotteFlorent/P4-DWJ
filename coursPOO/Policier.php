<?php

class Policier extends Person
{

    private $grade;

    public function __construct($firstName, $lastName, $age, $grade)
    {

        parent::__construct($firstName, $lastName, $age);

        $this->grade = $grade;
    }

    public function getFullName()
    {
        return parent::getFullName() . ', policier ' . $this->grade;
    }
}
    