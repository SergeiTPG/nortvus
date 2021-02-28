<?php

namespace App\ArgumentResolver;


use App\Query\SubscribersSorting;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class SubscribersSortingResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument):bool
    {
        return $argument->getType() === SubscribersSorting::class && $argument->isNullable();
    }

    public function resolve(Request $request, ArgumentMetadata $argument):?\Generator
    {
        $field = $request->query->get('f');
        $direction = $request->query->get('d');
        yield !$field?null:new SubscribersSorting($field,$direction??SubscribersSorting::ASC);
    }

}