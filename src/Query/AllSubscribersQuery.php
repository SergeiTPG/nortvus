<?php

namespace App\Query;


use App\Model\Subscriber;
use App\Model\Subscribers;
use App\Query\SubscribersSorting;

class AllSubscribersQuery
{
    /**
     * @var Subscribers
     */
    private Subscribers $subscribers;

    public function __construct(Subscribers $subscribers){
        $this->subscribers = $subscribers;
    }

    /**
     * @return Subscribers
     */
    public function __invoke(SubscribersSorting $sorting=null):array
    {
        $collectionArray = $this->subscribers->all();

        if($sorting!==null){
            usort($collectionArray,$this->getSortingCallback($sorting));
        }

        return $collectionArray;
    }

    private function getSortingCallback(SubscribersSorting $sorting):callable
    {
        $directionModifier = $sorting->dir()===SubscribersSorting::ASC?1:-1;
        return fn(Subscriber $a,Subscriber $b)=>($a->{$sorting->field()} <=> $b->{$sorting->field()}) * $directionModifier;
    }
}