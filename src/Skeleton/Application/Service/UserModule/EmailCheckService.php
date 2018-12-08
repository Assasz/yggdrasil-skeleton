<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\Exception\BrokenContractException;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\EmailCheckRequest;
use Skeleton\Application\Service\UserModule\Response\EmailCheckResponse;
use Yggdrasil\Core\Service\AbstractService;

/**
 * Class EmailCheckService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
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
        $this->validateContracts();

        $users = $this
            ->getEntityManager()
            ->getRepository('Entity:User')
            ->findBy(['email' => $request->getEmail()]);

        $response = new EmailCheckResponse();

        if (count($users) < 1) {
            $response->setSuccess(true);
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
