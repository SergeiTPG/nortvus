<?php

namespace App\Model;


interface Subscribers
{
    public function get(string $id):Subscriber;

    public function save(Subscriber $subscriber);

    public function delete(string $id):void;

    /**
     * @return Subscriber[]
     */
    public function all():array;
}