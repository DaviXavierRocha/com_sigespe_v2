<?php
defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Sigespe\Component\Sigespe\Administrator\Extension\SigespeComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\Sigespe\\Component\\Sigespe'));
        $container->registerServiceProvider(new MVCFactory('\\Sigespe\\Component\\Sigespe'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Sigespe\\Component\\Sigespe'));
        $container->registerServiceProvider(new RouterFactory('\\Sigespe\\Component\\Sigespe'));

        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new SigespeComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                return $component;
            }
        );
    }
};