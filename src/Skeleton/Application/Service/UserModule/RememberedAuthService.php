<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Response\RememberedAuthResponse;
use Yggdrasil\Utils\Service\AbstractService;
use Yggdrasil\Utils\Annotation\Drivers;
use Yggdrasil\Utils\Annotation\Repository;

/**
 * Class RememberedAuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 *
 * @Drivers(install={EntityManagerInterface::class:"entityManager"})
 * @Repository(name="Entity:User", contract=UserRepositoryInterface::class, repositoryProvider="entityManager")
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
}
