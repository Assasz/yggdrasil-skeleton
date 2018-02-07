<?php

namespace AppModule\Application\Service;

use AppModule\Application\Service\Response\MailSenderResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class MailSenderService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $mailer = $this->getMailer();

        $message = (new \Swift_Message($request->getSubject()))
            ->setFrom($request->getSender())
            ->setTo($request->getReceivers())
            ->setBody($request->getBody(), 'text/html');

        $response = new MailSenderResponse();

        if($mailer->send($message)){
            $response->setSuccess(true);
        }

        return $response;
    }
}