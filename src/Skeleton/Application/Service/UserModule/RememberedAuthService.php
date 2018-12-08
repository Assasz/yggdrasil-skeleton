<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\Exception\BrokenContractException;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Response\RememberedAuthResponse;
use Yggdrasil\Core\Service\AbstractService;

/**
 * Class RememberedAuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
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
        $this->validateContracts();

        $user = $this
            ->getEntityManager()
            ->getRepository('Entity:User')
            ->findOneBy(['rememberIdentifier' => $request->getRememberIdentifier()]);

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
     * Validates contracts between service and external suppliers
     *
     * @throws BrokenContractException
     */
    private function validateContracts(): void
    {
        if (!$this->getEntityManager() instanceof EntityManagerInterface) {
            throw new BrokenContractException(EntityManagerInterface::class);
        }

        if (!$this->getEntityManager()->getRepository('Entity:User') instanceof UserRepositoryInterface) {
            throw new BrokenContractException(UserRepositoryInterface::class);
        }
    }
}
