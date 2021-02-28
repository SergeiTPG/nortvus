<?php

namespace App\Model;


class Subscription
{
    private array $categories;

    public function __construct(Category $category, Category ...$categories)
    {
        $this->categories = [$category,...$categories];
    }

    public function categories():array
    {
        return $this->categories;
    }

}