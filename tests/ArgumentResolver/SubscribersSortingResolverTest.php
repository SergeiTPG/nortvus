<?php

namespace App\Tests\ArgumentResolver;

use App\ArgumentResolver\SubscribersSortingResolver;
use App\Query\SubscribersSorting;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class SubscribersSortingResolverTest extends TestCase
{
    public function testSupports()
    {
        $resolver = new SubscribersSortingResolver();
        $request = new Request();

        $argument = new ArgumentMetadata('arg', SubscribersSorting::class, true, true, null);
        $result = $resolver->supports($request, $argument);
        Assert::assertTrue($result);

        $argument = new ArgumentMetadata('arg', self::class, true, true, null);
        $result = $resolver->supports($request, $argument);
        Assert::assertFalse($result);
    }
}
