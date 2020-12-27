<?php

namespace Chizu\App;

use Chizu\DI\Container;
use Chizu\Event\Event;
use Chizu\Event\Events;
use Ds\Map;

/**
 * Class Application represents main application class.
 *
 * @package Chizu\App
 */
class Application
{
    /**
     * Executes when application starts.
     */
    public const StartEvent = 'application.start';

    /**
     * Executes when application ends.
     */
    public const EndEvent = 'application.end';

    /**
     * Contains application event dispatcher.
     *
     * @var Events $events
     */
    protected Events $events;

    /**
     * Returns application event dispatcher.
     *
     * @return Events
     */
    public function getEvents(): Events
    {
        return $this->events;
    }

    /**
     * Contains dependency injection container.
     *
     * @var Container $container
     */
    protected Container $container;

    /**
     * Returns dependency injection container.
     *
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * Contains map with modules.
     *
     * @var Map $modules
     */
    protected Map $modules;

    /**
     * Returns map with modules.
     *
     * @return Map
     */
    public function getModules(): Map
    {
        return $this->modules;
    }

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->events = new Events();

        $this->events->set(self::StartEvent, Event::createByMethod($this, 'onStart'));
        $this->events->set(self::EndEvent, Event::createByMethod($this, 'onEnd'));

        $this->container = new Container();
        $this->modules = new Map();
    }

    /**
     * Executes when start event dispatched.
     */
    protected function onStart(): void
    {

    }

    /**
     * Executes when end event dispatched.
     */
    protected function onEnd(): void
    {

    }

    /**
     * Executes start and end events.
     */
    public function start(): void
    {
        $this->events->get(self::StartEvent)->execute();
        $this->events->get(self::EndEvent)->execute();
    }
}