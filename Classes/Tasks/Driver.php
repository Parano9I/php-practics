<?php

namespace Shop\Tasks;

use \FFI\Exception;

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
        if (in_array($category, $this->availableCategories)) {

            if (!in_array($category, $this->categories)) {

                array_push($this->categories, $category);
            } else throw new Exception("User is having this category");
        } else throw new Exception("Category {$category} does not exist");
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
}