<?php

namespace Chizu\App;

use Chizu\DI\Container;
use Chizu\Event\Dispatcher;
use Chizu\Event\Event;
use Chizu\Module\Modules;

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

    protected Modules $modules;

    /**
     * @return Modules
     */
    public function getModules(): Modules
    {
        return $this->modules;
    }

    public function __construct()
    {
        $this->dispatcher = new Dispatcher();

        $this->dispatcher->set(self::StartEvent, new Event([function () {
            $this->onStart();
        }]));
        $this->dispatcher->set(self::EndEvent, new Event([function () {
            $this->onEnd();
        }]));

        $this->container = new Container();
        $this->modules = new Modules();
    }

    protected function onStart(): void
    {

    }

    protected function onEnd(): void
    {

    }

    public function start(): void
    {
        $this->dispatcher->dispatch(self::StartEvent);
        $this->dispatcher->dispatch(self::EndEvent);
    }
}