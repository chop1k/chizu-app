<?php

namespace Chizu\App;

use Chizu\DI\Container;
use Chizu\Event\Event;
use Chizu\Event\Events;
use Chizu\Module\Modules;

class Application
{
    public const StartEvent = 'application.start';
    public const EndEvent = 'application.end';

    protected Events $events;

    public function getEvents(): Events
    {
        return $this->events;
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
        $this->events = new Events();

        $this->events->set(self::StartEvent, Event::createByMethod($this, 'onStart'));
        $this->events->set(self::EndEvent, Event::createByMethod($this, 'onEnd'));

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
        $this->events->get(self::StartEvent)->execute();
        $this->events->get(self::EndEvent)->execute();
    }
}