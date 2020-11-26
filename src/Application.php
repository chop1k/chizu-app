<?php

namespace Chizu\App;

use Chizu\DI\Container;
use Chizu\Event\Dispatcher;

class Application
{
    public const StartEvent = 'application.start';
    public const EndEvent = 'application.end';

    protected Dispatcher $dispatcher;

    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }

    protected Container $container;

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function __construct()
    {
        $this->dispatcher = new Dispatcher();

        $this->dispatcher->listen(self::StartEvent, function () {
            $this->onStart();
        });
        $this->dispatcher->listen(self::EndEvent, function () {
            $this->onEnd();
        });

        $this->container = new Container();
    }

    protected function onStart(): void
    {

    }

    protected function onEnd(): void
    {

    }

    public function start(): void
    {
        $this->dispatcher->dispatch(self::StartEvent, null);
        $this->dispatcher->dispatch(self::EndEvent, null);
    }
}