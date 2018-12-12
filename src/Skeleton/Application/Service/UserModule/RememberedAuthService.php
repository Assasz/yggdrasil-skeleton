<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Response\RememberedAuthResponse;
use Yggdrasil\Utils\Service\AbstractService;

/**
 * Class RememberedAuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 *
 * @property EntityManagerInterface $entityManager
 * @property UserRepositoryInterface $userRepository
 */
class RememberedAuthService extends AbstractService
{
    /**
     * Authenticates remembered user
     *
     * @param RememberedAuthRequest $request
     * @return RememberedAuthResponse
     */
    public function process(RememberedAuthRequest $request): RememberedAuthResponse
    {
        $user = $this->userRepository->fetchOne(['rememberIdentifier' => $request->getRememberIdentifier()]);

        $response = new RememberedAuthResponse();

        if (empty($user)) {
            return $response;
        }

        if (password_verify($request->getRememberToken(), $user->getRememberToken())) {
            $response
                ->setSuccess(true)
                ->setUser($user);
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
            EntityManagerInterface::class  => $this->getEntityManager(),
            UserRepositoryInterface::class => $this->getEntityManager()->getRepository('Entity:User')
        ];
    }
}
