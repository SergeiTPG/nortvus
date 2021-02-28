<?php

namespace App\Query;


use InvalidArgumentException;

class SubscribersSorting
{
    public const ASC='asc';
    public const DESC='desc';

    private string $field;
    private string $direction;

    public function __construct($field, $direction=self::ASC)
    {
        if(!in_array($field,['registeredAt','name','email'], true)){
            throw new InvalidArgumentException('Incorrect sorting field');
        }

        if(!in_array($direction,[self::ASC, self::DESC], true)){
            throw new InvalidArgumentException('Incorrect sorting field');
        }
        $this->field = $field;
        $this->direction = $direction;
    }

    public function field():string
    {
        return $this->field;
    }

    public function dir():string
    {
        return $this->direction;
    }
}