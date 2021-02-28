<?php

namespace App\Model;

use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

class Subscriber
{
    public Uuid $id;

    public string $name;

    public string $email;

    public Subscription $subscription;

    public DateTimeInterface $registeredAt;

    public function __construct(string $name, string $email, Subscription $subscription)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->email = $email;
        $this->subscription = $subscription;
        $this->registeredAt = new DateTimeImmutable();
    }

    public function editSubscriber(string $name, string $email):void
    {
        $this->name = $name;
        $this->email = $email;
    }
}