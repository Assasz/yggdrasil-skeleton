<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\AuthRequest;
use Skeleton\Application\Service\UserModule\Response\AuthResponse;
use Yggdrasil\Utils\Service\AbstractService;

/**
 * Class AuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 *
 * @property EntityManagerInterface $entityManager
 * @property UserRepositoryInterface $userRepository
 */
class AuthService extends AbstractService
{
    /**
     * Authenticates user
     *
     * @param AuthRequest $request
     * @return AuthResponse
     *
     * @throws \Exception
     */
    public function process(AuthRequest $request): AuthResponse
    {
        $user = $this->userRepository->fetchOne(['email' => $request->getEmail()]);

        $response = new AuthResponse();

        if (empty($user)) {
            return $response;
        }

        if (password_verify($request->getPassword(), $user->getPassword())) {
            $response
                ->setSuccess(true)
                ->setUser($user);

            if (!$user->isEnabled()) {
                return $response->setEnabled(false);
            }

            if ($request->isRemembered()) {
                $rememberToken = bin2hex(random_bytes(32));

                $user->setRememberToken(password_hash($rememberToken, PASSWORD_BCRYPT));
                $this->entityManager->flush();

                $response->setRememberToken($rememberToken);
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
            EntityManagerInterface::class  => $this->getEntityManager(),
            UserRepositoryInterface::class => $this->getEntityManager()->getRepository('Entity:User')
        ];
    }
}
