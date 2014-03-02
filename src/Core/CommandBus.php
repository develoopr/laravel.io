<?php namespace Lio\Core;

use Illuminate\Container\Container;

class CommandBus
{
    private $container;
    private $inflector;

    public function __construct(Container $container, CommandHandlerNameInflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    public function execute($command)
    {
        return $this->getHandler($command)->handle($command);
    }

    private function getHandler($command)
    {
        return $this->container->make($this->inflector->getHandlerClass($command));
    }
}