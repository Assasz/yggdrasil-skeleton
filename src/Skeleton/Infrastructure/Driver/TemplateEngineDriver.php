<?php

namespace Skeleton\Infrastructure\Driver;

use Skeleton\Application\AppInterface\TemplateEngineInterface;
use Yggdrasil\Component\TwigComponent\FormExtension;
use Yggdrasil\Component\TwigComponent\RoutingExtension;
use Yggdrasil\Component\TwigComponent\StandardExtension;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\DriverInterface;
use Yggdrasil\Core\Driver\Abstraction\TemplateEngineDriver as AbstractDriver;
use Yggdrasil\Core\Exception\MissingConfigurationException;

/**
 * Class TemplateEngineDriver
 *
 * [Twig] Template Engine driver
 *
 * @package Skeleton\Infrastructure\Driver
 */
class TemplateEngineDriver extends AbstractDriver implements DriverInterface, TemplateEngineInterface
{
    /**
     * Instance of driver
     *
     * @var DriverInterface
     */
    private static $driverInstance;

    /**
     * Prevents object creation and cloning
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Installs template engine driver
     *
     * @param ConfigurationInterface $appConfiguration Configuration needed to configure template engine
     * @return DriverInterface
     *
     * @throws MissingConfigurationException if view_path, form_path or application_name is not configured
     */
    public static function install(ConfigurationInterface $appConfiguration): DriverInterface
    {
        if (self::$driverInstance === null) {
            $requiredConfig = ['view_path', 'form_path', 'application_name'];

            if (!$appConfiguration->isConfigured($requiredConfig, 'template_engine')) {
                throw new MissingConfigurationException($requiredConfig, 'template_engine');
            }

            $configuration = $appConfiguration->getConfiguration();

            $basePath = dirname(__DIR__, 4) . '/src/';
            $viewPath = $basePath . $configuration['template_engine']['view_path'];
            $formPath = $basePath . $configuration['template_engine']['form_path'];

            $loader = new \Twig_Loader_Filesystem($viewPath);
            $twig   = new \Twig_Environment(
                $loader, ['cache' => (!DEBUG) ? dirname(__DIR__, 4) . '/var/twig' : false]
            );

            $router = $appConfiguration->loadDriver('router')->getComponentInstance();

            $twig->addExtension(new StandardExtension($configuration['template_engine']['application_name']));
            $twig->addExtension(new RoutingExtension($router));
            $twig->addExtension(new FormExtension($formPath));

            self::$engineInstance = $twig;
            self::$driverInstance = new TemplateEngineDriver();
        }

        return self::$driverInstance;
    }
}
