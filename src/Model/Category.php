<?php

namespace App\Model;


class Category
{
    public string $id;
    public string $title;

    public function __construct(string $id, string $title = null)
    {
        $this->id = $id;
        $this->title = $title??ucfirst($id);
    }
}