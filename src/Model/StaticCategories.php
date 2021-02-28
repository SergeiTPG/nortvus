<?php

namespace App\Model;


class StaticCategories implements Categories
{
    public function all(): array
    {
        return [
            new Category('development'),
            new Category('sport'),
            new Category('movies'),
            new Category('music'),
        ];
    }

}