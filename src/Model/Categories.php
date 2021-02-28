<?php

namespace App\Model;


interface Categories
{
    /**
     * @return Category[]
     */
    public function all():array;
}