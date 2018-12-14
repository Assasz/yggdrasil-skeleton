<?php

namespace Skeleton\Application\Service\SharedModule;

use Skeleton\Application\DriverInterface\MailerInterface;
use Skeleton\Application\Service\SharedModule\Request\MailSendRequest;
use Skeleton\Application\Service\SharedModule\Response\MailSendResponse;
use Yggdrasil\Utils\Service\AbstractService;

/**
 * Class MailSendService
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\SharedModule
 *
 * @property MailerInterface $mailer
 */
class MailSendService extends AbstractService
{
    /**
     * Sends mails
     *
     * @param MailSendRequest $request
     * @return MailSendResponse
     */
    public function process(MailSendRequest $request): MailSendResponse
    {
        $message = $this->mailer->createMessage(
            $request->getSubject(),
            $request->getSender(),
            $request->getReceivers(),
            $request->getBody()
        );

        $response = new MailSendResponse();

        if ($this->mailer->send($message)) {
            $response->setSuccess(true);
        }

        return $response;
    }

    /**
     * Returns contracts between service and external suppliers
     *
     * @example [EntityManagerInterface::class => $this->getEntityManager()]
     *
     * @return array
     */
    protected function getContracts(): array
    {
        return [
            MailerInterface::class => $this->getDriver('mailer'),
        ];
    }
}