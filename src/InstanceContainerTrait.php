<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/instance-container
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Class InstanceContainerTrait
 * @package instance-container
 */
trait InstanceContainerTrait
{
    /**
     * Instances bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var array
     */
    protected $aliases = [];

    /**
     * General instance container setup.
     */
    protected function setupInstanceContainer(): void
    {
        $this->on(CreateInstanceEvent::class, [$this, 'onInstanceMake'], CreateInstanceEvent::MAIN);
    }

    /**
     * Handle instance creation.
     *
     * @internal
     * @param CreateInstanceEventInterface $event
     * @return mixed New instance
     */
    public function onInstanceMake(CreateInstanceEventInterface $event)
    {
        $class = $event->getClass();

        $factoryMethod = $this->getFactoryMethod($class);
        if ($factoryMethod) {
            return $factoryMethod($event);
        }

        if (isset($this->bindings[$class])) {
            $binding = $this->bindings[$class];

            if ($binding instanceof InstanceFactoryInterface) {
                $factory = $binding;
            } elseif (is_callable($binding)) {
                return $binding($event);
            } else {
                $factory = $this->get($binding);
            }

            return $factory->createInstance($event);
        }

        $parameters = $event->getParameters();
        return new $class(...$parameters);
    }

    /**
     * Returns true if the container can return an instance for the given identifier, false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception,
     * it does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @api
     * @param string $id Identifier of the entry to look for
     * @return bool
     */
    public function has($id)
    {
        return !empty($this->instances[(string) $id]) || $this->getClass($id);
    }

    /**
     * Returns entry of the container by its identifier.
     *
     * @api
     * @param string $id Identifier of the entry to look for
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed Instance
     */
    public function get($id)
    {
        $id = (string) $id;

        if (isset($this->aliases[$id])) {
            while (isset($this->aliases[$id])) {
                $id = $this->aliases[$id];
            }
        }

        if (isset($this->instances[$id])) {
            return $this->instances[$id] ?: null;
        }

        return $this->instances[$id] = $this->make($id);
    }

    /**
     * Set entry instance.
     *
     * @api
     * @param string $id Instance identifier
     * @param mixed $instance Container entry instance
     * @return void
     */
    public function set(string $id, $instance): void
    {
        $this->instances[$id] = $instance ?? false;
    }

    /**
     * Bind provider to an entry instance.
     *
     * @api
     * @param string $id Instance identifier
     * @param mixed $binding
     */
    public function bind(string $id, $binding): void
    {
        $this->bindings[$id] = $binding;
    }

    /**
     * Set alias to an entry instance.
     *
     * @api
     * @param string $id Instance id
     * @param string $alias Instance alias
     */
    public function alias(string $id, string $alias): void
    {
        $this->aliases[$alias] = $id;
    }

    /**
     * Creates new instance.
     *
     * @api
     * @param string $id Instance id
     * @param array<int, mixed> $parameter Optional parameters
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed New instance
     */
    public function make(string $id, ...$parameter)
    {
        $class = $this->getClass($id);
        if (!$class) {
            throw (new InstanceNotFoundException('Expected class with name %s'))
                ->format($class);
        }

        try {
            if ($this instanceof EventEmitterInterface) {
                $event = new CreateInstanceEvent($this, $class, $parameter);
            } else {
                throw (new InstanceContainerException('Expected container implements %s'))
                    ->format(EventEmitterInterface::class);
            }

            $this->emit($event, function ($result) use ($event) {
                if ($result && !$event->getInstance()) {
                    $event->setInstance($result);
                }
            });

            return $event->getInstance();
        } catch (\Throwable $exc) {
            throw (new InstanceContainerException('Cannot create valid instance for class %s', 0, $exc))
                ->format($class);
        }
    }

    /**
     * Returns class for an entry id.
     *
     * @param string $id Instance id
     * @return string|null Class name
     */
    protected function getClass(string $id): ?string
    {
        $class = $id;
        if (interface_exists($id)) {
            // get default implementation class name from interface
            $class = substr($id, 0, strlen($id) - 9);
        }
        return class_exists($class) ? $class : null;
    }

    /**
     * Returns factory method callable.
     *
     * @param mixed $class
     * @return callable|null
     */
    protected function getFactoryMethod($class): ?callable
    {
        if (method_exists($class, 'create')) {
            $callback = "$class::" . 'create';
            if (is_callable($callback)) {
                return $callback;
            }
        }
        return null;
    }
}
