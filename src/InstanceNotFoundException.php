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

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class InstanceNotFoundException
 * @package instance-container
 */
final class InstanceNotFoundException extends InstanceContainerException implements NotFoundExceptionInterface
{

}
