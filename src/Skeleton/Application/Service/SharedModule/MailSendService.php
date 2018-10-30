<?php

namespace Skeleton\Application\Service\SharedModule;

use Skeleton\Application\Service\SharedModule\Response\MailSendResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class MailSendService
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\SharedModule
 */
class MailSendService extends AbstractService implements ServiceInterface
{
    /**
     * Sends mails
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $message = $this->getMailer()->createMessage(
            $request->getSubject(),
            $request->getSender(),
            $request->getReceivers(),
            $request->getBody()
        );

        $response = new MailSendResponse();

        if ($this->getMailer()->send($message)) {
            $response->setSuccess(true);
        }

        return $response;
    }
}