<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\ContainerInterface;
use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\DriverInterface\RouterInterface;
use Skeleton\Application\DriverInterface\TemplateEngineInterface;
use Skeleton\Application\DriverInterface\ValidatorInterface;
use Skeleton\Application\Service\SharedModule\Request\MailSendRequest;
use Skeleton\Application\Service\UserModule\Request\SignupRequest;
use Skeleton\Application\Service\UserModule\Response\SignupResponse;
use Skeleton\Domain\Entity\User;
use Yggdrasil\Utils\Service\AbstractService;

/**
 * Class SignupService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 */
class SignupService extends AbstractService
{
    /**
     * Registers user
     *
     * @param SignupRequest $request
     * @return SignupResponse
     *
     * @throws \Exception
     */
    public function process(SignupRequest $request): SignupResponse
    {
        $user = (new User())
            ->setEmail($request->getEmail())
            ->setUsername($request->getUsername())
            ->setPassword($request->getPassword());

        $response = new SignupResponse();

        if ($this->getValidator()->isValid($user)) {
            $link = $this->getRouter()->getQuery('User:signupConfirmation', [
                $user->getConfirmationToken()
            ]);

            $body = $this->getTemplateEngine()->render('mail/signup_confirmation.html.twig', [
                'username' => $user->getUsername(),
                'link'     => $link
            ]);

            $mailSendRequest = (new MailSendRequest())
                ->setSubject('Sign up confirmation')
                ->setBody($body)
                ->setSender(['skeleton@yggdrasil.com' => 'Yggdrasil Skeleton'])
                ->setReceivers([$user->getEmail() => $user->getUsername()]);

            $mailSendResponse = $this->getContainer()->getService('shared.mail_send')->process($mailSendRequest);

            if ($mailSendResponse->isSuccess()) {
                $user->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));

                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();

                $response->setSuccess(true);
            }
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
            ValidatorInterface::class      => $this->getValidator(),
            RouterInterface::class         => $this->getRouter(),
            TemplateEngineInterface::class => $this->getTemplateEngine(),
            ContainerInterface::class      => $this->getContainer(),
            EntityManagerInterface::class  => $this->getEntityManager()
        ];
    }
}
