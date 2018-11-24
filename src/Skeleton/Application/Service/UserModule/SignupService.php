<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\ContainerInterface;
use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\DriverInterface\RouterInterface;
use Skeleton\Application\DriverInterface\TemplateEngineInterface;
use Skeleton\Application\DriverInterface\ValidatorInterface;
use Skeleton\Application\Exception\BrokenContractException;
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
     * @throws \Exception
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $this->validateContracts();

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
     * Validates contracts between service and external suppliers
     *
     * @throws BrokenContractException
     */
    private function validateContracts(): void
    {
        $contracts = [
            ValidatorInterface::class      => $this->getValidator(),
            RouterInterface::class         => $this->getRouter(),
            TemplateEngineInterface::class => $this->getTemplateEngine(),
            ContainerInterface::class      => $this->getContainer(),
            EntityManagerInterface::class  => $this->getEntityManager()
        ];

        foreach ($contracts as $contract => $supplier) {
            if (!is_subclass_of($supplier, $contract)) {
                throw new BrokenContractException($contract);
            }
        }
    }
}
