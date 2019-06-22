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
 * Class CreateInstance
 * @package instance-container
 */
trait CreateInstanceEventTrait
{
    /**
     * @var InstanceContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    private $class;

    /**
     * @var mixed
     */
    private $instance;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * Returns instance container.
     *
     * @api
     * @return InstanceContainerInterface
     */
    public function getContainer(): InstanceContainerInterface
    {
        return $this->container;
    }

    /**
     * Inject instance container.
     *
     * @param InstanceContainerInterface $container
     */
    protected function setContainer(InstanceContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * Returns instance class.
     *
     * @api
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Set instance class.
     *
     * @param string $class
     */
    protected function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * Returns class instance.
     *
     * @internal
     * @return mixed
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Set class instance.
     *
     * @internal
     * @param mixed $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * Returns instance creation parameters.
     *
     * @api
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Set instance creation parameters.
     *
     * @param array $parameters
     */
    protected function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }
}
