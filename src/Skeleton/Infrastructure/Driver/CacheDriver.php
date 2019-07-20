<?php

namespace Skeleton\Infrastructure\Driver;

use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\DriverInterface;
use Yggdrasil\Core\Exception\MissingConfigurationException;

/**
 * Class CacheDriver
 *
 * [Redis] Cache mechanism driver
 *
 * @package Skeleton\Infrastructure\Driver
 */
class CacheDriver implements DriverInterface
{
    /**
     * Instance of driver
     *
     * @var DriverInterface
     */
    private static $driverInstance;

    /**
     * Instance of cache
     *
     * @var \Redis
     */
    private static $cacheInstance;

    /**
     * Prevents object creation and cloning
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Installs cache driver
     *
     * @param ConfigurationInterface $appConfiguration Configuration needed to configure cache
     * @return DriverInterface
     *
     * @throws MissingConfigurationException if redis_host or redis_port is not configured
     */
    public static function install(ConfigurationInterface $appConfiguration): DriverInterface
    {
        if (self::$driverInstance === null) {
            $requiredConfig = ['redis_host', 'redis_port'];

            if (!$appConfiguration->isConfigured($requiredConfig, 'cache')) {
                throw new MissingConfigurationException($requiredConfig, 'cache');
            }

            $redis = new \Redis();
            $redis->connect(
                $appConfiguration->get('redis_host', 'cache'),
                $appConfiguration->get('redis_port', 'cache')
            );

            self::$cacheInstance = $redis;
            self::$driverInstance = new CacheDriver();
        }

        return self::$driverInstance;
    }

    /**
     * Returns instance of cache
     *
     * @return \Redis
     */
    public function getComponentInstance(): \Redis
    {
        return self::$cacheInstance;
    }
}