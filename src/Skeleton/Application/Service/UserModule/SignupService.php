<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\Service\SharedModule\Request\MailSendRequest;
use Skeleton\Application\Service\UserModule\Response\SignupResponse;
use Skeleton\Domain\Entity\User;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SignupService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 */
class SignupService extends AbstractService implements ServiceInterface
{
    /**
     * Registers user
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = (new User())
            ->setEmail($request->getEmail())
            ->setUsername($request->getUsername())
            ->setPassword($request->getPassword());

        $errors = $this->getValidator()->validate($user);

        $response = new SignupResponse();

        if (count($errors) < 1) {
            $link = $this->getRouter()->getQuery('User:signupConfirmation', [$user->getConfirmationToken()]);
            $body = $this->getTemplateEngine()->render('mail/signup_confirmation.html.twig', [
                'username' => $user->getUsername(),
                'link' => $link
            ]);

            $mailSendRequest = (new MailSendRequest())
                ->setSubject('Sign up confirmation')
                ->setBody($body)
                ->setSender(['team@application.com' => 'Application Team'])
                ->setReceivers([$user->getEmail() => $user->getUsername()]);

            $mailSendService = $this->getContainer()->get('shared.mail_send');
            $mailSendResponse = $mailSendService->process($mailSendRequest);

            if ($mailSendResponse->isSuccess()) {
                $user->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));

                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();

                $response->setSuccess(true);
            }
        }

        return $response;
    }
}
