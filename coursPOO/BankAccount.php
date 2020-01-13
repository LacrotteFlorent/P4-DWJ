<?php

class BankAccount
{
    private $accountNumber;
    private $balance = 0;
    const TAX = 0.08;


    public function __construct($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }
    
    public static function getTax()
    {
        return static::TAX;
    }

    public function setBalance($balance)
    {
        if($balance < 10000) {
            throw new Exception("L'argent est trop petit !");
        }

        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance * 100;
    }
}

$compteBancaireDeFlorent = new BankAccount("135153123123");
$compteBancaireDeFlorent->setBalance(50000);
var_dump($compteBancaireDeFlorent->getBalance());
var_dump(BankAccount::getTax());
