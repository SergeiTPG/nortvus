<?php

namespace App\Model;


use DateTimeImmutable;
use LogicException;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

class FileSubscribers implements Subscribers
{

    private string $storageFile;

    private array $subscribers=[];

    public function __construct(string $storageFile)
    {
        $this->storageFile = $storageFile;
        if(file_exists($storageFile)){
            $this->load();
        }
    }

    private function find(Uuid $id):array
    {
        return array_filter($this->subscribers,fn(Subscriber $subscriber)=>$subscriber->id->equals($id));
    }

    public function get(string $id):Subscriber
    {
        $subscriber = $this->find(Uuid::fromString($id));

        if(count($subscriber)!==1){
            throw new LogicException('Subscriber not found');
        }

        return clone array_values($subscriber)[0];
    }

    public function all():array
    {
        return array_map(fn(Subscriber $subscriber)=>clone $subscriber,$this->subscribers);
    }

    public function save(Subscriber $subscriber):void
    {
        $foundSubscriber = $this->find($subscriber->id);
        $isNew = count($foundSubscriber)===0;

        if($isNew){
            $this->subscribers[] = clone $subscriber;
        }else{
            $key = array_keys($foundSubscriber)[0];
            $this->subscribers[$key] = clone $subscriber;
        }
        $this->flush();
    }

    public function delete(string $id):void
    {
        $foundSubscriber = $this->find(Uuid::fromString($id));
        if(count($foundSubscriber)===1){
            $key = array_keys($foundSubscriber)[0];

            unset($this->subscribers[$key]);
            $this->flush();
        }
    }

    private function flush():void
    {
        file_put_contents($this->storageFile,serialize($this->subscribers));
    }

    private function load():void
    {
        $this->subscribers = unserialize(file_get_contents($this->storageFile),
            ['allowed_classes'=>[Subscriber::class, DateTimeImmutable::class, Subscription::class, UuidV4::class, Category::class]]);
    }


}