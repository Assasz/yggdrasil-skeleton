<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\SignupConfirmationRequest;
use Skeleton\Application\Service\UserModule\Response\SignupConfirmationResponse;
use Yggdrasil\Utils\Service\AbstractService;

/**
 * Class SignupConfirmationService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 *
 * @property EntityManagerInterface $entityManager
 * @property UserRepositoryInterface $userRepository
 */
class SignupConfirmationService extends AbstractService
{
    /**
     * Activates user account
     *
     * @param SignupConfirmationRequest $request
     * @return SignupConfirmationResponse
     */
    public function process(SignupConfirmationRequest $request): SignupConfirmationResponse
    {
        $user = $this->userRepository->fetchOne(['confirmationToken' => $request->getToken()]);

        $response = new SignupConfirmationResponse();

        if (empty($user)) {
            return $response;
        }

        if ($user->isEnabled()) {
            return $response->setAlreadyActive(true);
        }

        $user->setEnabled('1');
        $this->entityManager->flush();

        return $response->setSuccess(true);
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
            EntityManagerInterface::class  => $this->getEntityManager(),
            UserRepositoryInterface::class => $this->getEntityManager()->getRepository('Entity:User')
        ];
    }
}
