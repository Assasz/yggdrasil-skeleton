<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Application\Service\UserModule\Request\EmailCheckRequest;
use Skeleton\Application\Service\UserModule\Response\EmailCheckResponse;
use Yggdrasil\Utils\Service\AbstractService;

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
