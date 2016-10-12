<?php
/**
 * Created by PhpStorm.
 * User: n3vrax
 * Date: 8/5/2016
 * Time: 11:41 PM
 */

namespace Dot\Frontend\User\Factory;

use Dot\Authentication\AuthenticationInterface;
use Dot\Frontend\User\Service\UserService;
use Dot\User\Mapper\UserMapperInterface;
use Dot\User\Options\UserOptions;
use Dot\User\Service\PasswordInterface;
use Interop\Container\ContainerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;

/**
 * Class UserServiceFactory
 * @package Dot\Frontend\User\Factory
 */
class UserServiceFactory extends \Dot\User\Factory\UserServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserService
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var UserOptions $options */
        $options = $container->get(UserOptions::class);
        $this->options = $options;

        $isDebug = isset($container->get('config')['debug'])
            ? (bool) $container->get('config')['debug']
            : false;

        $eventManager = $container->has(EventManagerInterface::class)
            ? $container->get(EventManagerInterface::class)
            : new EventManager();

        $service = new UserService(
            $container->get(UserMapperInterface::class),
            $options,
            $container->get(PasswordInterface::class),
            $container->get(AuthenticationInterface::class)
        );

        $service->setUserEntityPrototype($container->get($options->getUserEntity()));
        $service->setUserEntityHydrator($container->get($options->getUserEntityHydrator()));
        $service->setEventManager($eventManager);
        $service->setDebug($isDebug);

        $this->attachUserListeners($service, $container);

        return $service;
    }
}