<?php

namespace Shop\Tasks;

class Worker extends User
{
    private float $salary;

    public function __construct(string $name, int $age, float $salary)
    {
        parent::__construct($name, $age);
        $this->salary = $salary;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }
}