<?php

namespace Skeleton\Infrastructure\Driver;

use Skeleton\Application\DriverInterface\MailerInterface;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\DriverInterface;
use Yggdrasil\Core\Exception\MissingConfigurationException;

/**
 * Class MailerDriver
 *
 * [SwiftMailer] Mailer driver
 *
 * @package Skeleton\Infrastructure\Driver
 */
class MailerDriver implements DriverInterface, MailerInterface
{
    /**
     * Instance of driver
     *
     * @var DriverInterface
     */
    private static $driverInstance;

    /**
     * Instance of mailer
     *
     * @var \Swift_Mailer
     */
    private static $mailerInstance;

    /**
     * Prevents object creation and cloning
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Installs mailer driver
     *
     * @param ConfigurationInterface $appConfiguration Configuration needed to configure mailer
     * @return DriverInterface
     *
     * @throws MissingConfigurationException if host, username or password are not configured
     */
    public static function install(ConfigurationInterface $appConfiguration): DriverInterface
    {
        if (self::$driverInstance === null) {
            $requiredConfig = ['host', 'username', 'password'];

            if (!$appConfiguration->isConfigured($requiredConfig, 'mailer')) {
                throw new MissingConfigurationException($requiredConfig, 'mailer');
            }

            $transport = (new \Swift_SmtpTransport(
                $appConfiguration->get('host', 'mailer'),
                $appConfiguration->get('port', 'mailer') ?? 465,
                $appConfiguration->get('encryption', 'mailer') ?? 'ssl'
            ))
                ->setUsername($appConfiguration->get('username', 'mailer'))
                ->setPassword($appConfiguration->get('password', 'mailer'));

            self::$mailerInstance = new \Swift_Mailer($transport);
            self::$driverInstance = new MailerDriver();
        }

        return self::$driverInstance;
    }

    /**
     * Creates message composed with given data
     *
     * @param string       $subject
     * @param string|array $sender
     * @param string|array $receivers
     * @param string       $body
     * @param string       $contentType
     * @return \Swift_Message
     */
    public function createMessage(string $subject, $sender, $receivers, string $body, string $contentType = 'text/html'): \Swift_Message
    {
        return (new \Swift_Message($subject))
            ->setFrom($sender)
            ->setTo($receivers)
            ->setBody($body, $contentType);
    }

    /**
     * Sends given message
     *
     * @param \Swift_Message $message
     * @return int Number of successful receivers
     */
    public function send(\Swift_Message $message): int
    {
        return self::$mailerInstance->send($message);
    }
}
