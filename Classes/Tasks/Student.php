<?php

namespace Shop\Tasks;

class Student extends User
{
    private float $scholarship;
    private int $year;

    public function __construct(string $name, int $age, float $scholarship, int $year)
    {
        parent::__construct($name, $age);
        $this->scholarship = $scholarship;
        $this->year = $year;
    }

    public function setScholarship(float $scholarship): void
    {
        $this->scholarship = $scholarship;
    }

    public function getScholarship(): float
    {
        return $this->name;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}
