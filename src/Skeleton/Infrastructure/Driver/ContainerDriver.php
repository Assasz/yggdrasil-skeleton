<?php

namespace Skeleton\Infrastructure\Driver;

use Skeleton\Application\AppInterface\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\DriverInterface;
use Yggdrasil\Core\Exception\MissingConfigurationException;
use Yggdrasil\Core\Exception\NotServiceReturnedException;
use Yggdrasil\Core\Exception\ServiceNotFoundException;
use Yggdrasil\Core\Service\ServiceInterface;

/**
 * Class ContainerDriver
 *
 * [Symfony Dependency Injection] DI Container driver
 *
 * @package Skeleton\Infrastructure\Driver
 */
class ContainerDriver implements DriverInterface, ContainerInterface
{
    /**
     * Instance of driver
     *
     * @var DriverInterface
     */
    private static $driverInstance;

    /**
     * Instance of container
     *
     * @var ContainerBuilder
     */
    private static $containerInstance;

    /**
     * Prevents object creation and cloning
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Installs container driver
     *
     * @param ConfigurationInterface $appConfiguration Configuration needed to configure container
     * @return DriverInterface
     *
     * @throws MissingConfigurationException if resource_path is not configured
     * @throws \Exception
     */
    public static function install(ConfigurationInterface $appConfiguration): DriverInterface
    {
        if (self::$driverInstance === null) {
            if (!$appConfiguration->isConfigured(['resource_path'], 'container')) {
                throw new MissingConfigurationException(['resource_path'], 'container');
            }

            $configuration = $appConfiguration->getConfiguration();
            $resourcePath = dirname(__DIR__, 4) . '/src/' . $configuration['container']['resource_path'];

            $container = new ContainerBuilder();

            $loader = new YamlFileLoader($container, new FileLocator($resourcePath));
            $loader->load('services.yaml');

            $container->setParameter('app.configuration', $appConfiguration);

            self::$containerInstance = $container;
            self::$driverInstance = new ContainerDriver();
        }

        return self::$driverInstance;
    }

    /**
     * Returns given service from container
     *
     * @param string $alias Alias of service like module.service_name
     * @return ServiceInterface
     *
     * @throws \Exception
     * @throws ServiceNotFoundException if given service doesn't exist
     * @throws NotServiceReturnedException if object returned by container is not a service
     */
    public function getService(string $alias): ServiceInterface
    {
        if (!self::$containerInstance->get($alias)) {
            throw new ServiceNotFoundException('Service with alias ' . $alias . ' doesn\'t exist.');
        }

        if (!self::$containerInstance->get($alias) instanceof ServiceInterface) {
            throw new NotServiceReturnedException('Not a service returned by container for alias ' . $alias . '.');
        }

        return self::$containerInstance->get($alias);
    }
}
