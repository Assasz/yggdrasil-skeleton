<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\ContainerInterface;
use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\DriverInterface\RouterInterface;
use Skeleton\Application\DriverInterface\TemplateEngineInterface;
use Skeleton\Application\DriverInterface\ValidatorInterface;
use Skeleton\Application\Service\SharedModule\MailSendService;
use Skeleton\Application\Service\SharedModule\Request\MailSendRequest;
use Skeleton\Application\Service\UserModule\Request\SignupRequest;
use Skeleton\Application\Service\UserModule\Response\SignupResponse;
use Skeleton\Domain\Entity\User;
use Yggdrasil\Utils\Service\AbstractService;
use Yggdrasil\Utils\Annotation\Drivers;
use Yggdrasil\Utils\Annotation\Services;

/**
 * Class SignupService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 *
 * @Drivers(install={
 *     ValidatorInterface::class:"validator",
 *     RouterInterface::class:"router",
 *     EntityManagerInterface::class:"entityManager",
 *     TemplateEngineInterface::class:"templateEngine"
 * })
 *
 * @Services(install={MailSendService::class})
 *
 * @property ValidatorInterface $validator
 * @property RouterInterface $router
 * @property TemplateEngineInterface $templateEngine
 * @property EntityManagerInterface $entityManager
 * @property MailSendService $sharedMailSendService
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

        if (!$this->validator->isValid($user)) {
            return $response;
        }

        $link = $this->router->getQuery('User:signupConfirmation', [
            $user->getConfirmationToken()
        ]);

        $body = $this->templateEngine->render('mail/signup_confirmation.html.twig', [
            'username' => $user->getUsername(),
            'link'     => $link
        ]);

        $mailSendRequest = (new MailSendRequest())
            ->setSubject('Sign up confirmation')
            ->setBody($body)
            ->setSender(['skeleton@yggdrasil.com' => 'Yggdrasil Skeleton'])
            ->setReceivers([$user->getEmail() => $user->getUsername()]);

        $mailSendResponse = $this->sharedMailSendService->process($mailSendRequest);

        if ($mailSendResponse->isSuccess()) {
            $user->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $response->setSuccess(true);
        }

        return $response;
    }
}
