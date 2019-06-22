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
 * Class CreateInstanceEvent
 * @package instance-container
 */
class CreateInstanceEvent extends Event implements
    CreateInstanceEventInterface
{
    use CreateInstanceEventTrait;

    /**
     * @param EventEmitterInterface $emitter
     * @param string $class
     * @param array $parameters
     */
    public function __construct(EventEmitterInterface $emitter, string $class, array $parameters)
    {
        parent::__construct(null, $emitter);

        if ($emitter instanceof InstanceContainerInterface) {
            $this->setContainer($emitter);
        }

        $this->setClass($class);
        $this->setParameters($parameters);
    }
}
