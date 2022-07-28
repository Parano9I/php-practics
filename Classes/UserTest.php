<?php
class UserTest
{
    protected string $name;
    protected int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}

class Worker extends UserTest
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

class Student extends UserTest
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

class Driver extends Worker
{
    private array $categories = [];
    private array $availableCategories = ['A', 'B', 'C', 'D'];

    public function __construct(string $name, int $age, float $salary, $category)
    {
        parent::__construct($name, $age, $salary);
        $this->setCategory($category);
    }

    public function setCategory(string $category): void
    {
        if(in_array($category, $this->availableCategories)){

            if(!in_array($category, $this->categories)){

                array_push($this->categories, $category);

            } else throw new Exception("User is having this category");

        } else throw new Exception("Category {$category} does not exist");
    }

    public function getCategories(): array{
        return $this->categories;
    }
}
