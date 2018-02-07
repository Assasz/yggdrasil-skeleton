<?php

namespace AppModule\Application\Service;

use AppModule\Application\Service\Request\MailSenderRequest;
use AppModule\Application\Service\Response\SignupResponse;
use AppModule\Domain\Entity\User;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;
use Symfony\Component\Validator\Validation;

class SignupService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = new User();
        $user->setEmail($request->getEmail());
        $user->setUsername($request->getUsername());
        $user->setPassword($request->getPassword());

        $errors = $this->getValidator()->validate($user);
        $response = new SignupResponse();

        if(count($errors) < 1){
            $router = $this->getDriver('router');

            $link = $router->getQuery('User:signupConfirm', [$user->getConfirmationToken()]);
            $body = 'Hi '.$user->getUsername().'! Click <a href="'.$link.'">here</a> to activate your account.<br><br>Best regards, your Team.';

            $mailSenderRequest = new MailSenderRequest();
            $mailSenderRequest->setSubject('Sign up confirmation');
            $mailSenderRequest->setBody($body);
            $mailSenderRequest->setSender(['team@application.com' => 'Application Team']);
            $mailSenderRequest->setReceivers([$user->getEmail() => $user->getUsername()]);

            $mailSenderService = $this->getContainer()->get('mail_sender');
            $mailSenderResponse = $mailSenderService->process($mailSenderRequest);

            if($mailSenderResponse->isSuccess()) {
                $user->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));

                $entityManager = $this->getEntityManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $response->setSuccess(true);
            }
        }

        return $response;
    }
}