<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\EmailCheckRequest;
use Skeleton\Application\Service\UserModule\Response\EmailCheckResponse;
use Yggdrasil\Utils\Service\AbstractService;
use Yggdrasil\Utils\Annotation\Drivers;
use Yggdrasil\Utils\Annotation\Repository;

/**
 * Class EmailCheckService
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
class EmailCheckService extends AbstractService
{
    /**
     * Checks if email address is already taken by another user
     *
     * @param EmailCheckRequest $request
     * @return EmailCheckResponse
     */
    public function process(EmailCheckRequest $request): EmailCheckResponse
    {
        $users = $this->userRepository->fetch(['email' => $request->getEmail()]);

        $response = new EmailCheckResponse();

        if (count($users) < 1) {
            $response->setSuccess(true);
        }

        return $response;
    }
}
