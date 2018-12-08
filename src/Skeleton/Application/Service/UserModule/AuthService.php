<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\Exception\BrokenContractException;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\AuthRequest;
use Skeleton\Application\Service\UserModule\Response\AuthResponse;
use Yggdrasil\Core\Service\AbstractService;

/**
 * Class AuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
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
        $this->validateContracts();

        $user = $this
            ->getEntityManager()
            ->getRepository('Entity:User')
            ->findOneBy(['email' => $request->getEmail()]);

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
                $this->getEntityManager()->flush();

                $response->setRememberToken($rememberToken);
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
        if (!$this->getEntityManager() instanceof EntityManagerInterface) {
            throw new BrokenContractException(EntityManagerInterface::class);
        }

        if (!$this->getEntityManager()->getRepository('Entity:User') instanceof UserRepositoryInterface) {
            throw new BrokenContractException(UserRepositoryInterface::class);
        }
    }
}
