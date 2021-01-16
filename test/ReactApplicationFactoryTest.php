<?php

declare(strict_types=1);

namespace AntidotTest\React;

use Antidot\Application\Http\Router;
use Antidot\Application\Http\RouteFactory;
use Antidot\Container\MiddlewareFactory;
use Antidot\React\ReactApplicationFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ReactApplicationFactoryTest extends TestCase
{
    public function testItShouldCreateInstancesOfReactApplication(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(3))
            ->method('get')
            ->withConsecutive(
                [Router::class],
                [MiddlewareFactory::class],
                [RouteFactory::class],
            )
            ->willReturnOnConsecutiveCalls(
                $this->createMock(Router::class),
                $this->createMock(MiddlewareFactory::class),
                $this->createMock(RouteFactory::class)
            );

        $factory = new ReactApplicationFactory();
        $factory($container);
    }
}
