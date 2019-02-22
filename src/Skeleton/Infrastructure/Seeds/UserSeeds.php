<?php

namespace Skeleton\Infrastructure\Seeds;

use Skeleton\Domain\Entity\User;
use Yggdrasil\Utils\Seeds\AbstractSeeds;

/**
 * Class UserSeeds
 *
 * @package Skeleton\Infrastructure\Seeds
 */
class UserSeeds extends AbstractSeeds
{
    /**
     * Creates user seeds
     *
     * @return array
     *
     * @throws \Exception
     */
    protected function create(): array
    {
        return [
            (new User())
                ->setUsername('Leslie')
                ->setEmail('leslie@gmail.com')
                ->setPassword(password_hash('1234', PASSWORD_BCRYPT))
                ->setEnabled('1'),
            (new User())
                ->setUsername('Mike')
                ->setEmail('mike@gmail.com')
                ->setPassword(password_hash('1234', PASSWORD_BCRYPT))
                ->setEnabled('1'),
            (new User())
                ->setUsername('Sassy')
                ->setEmail('sassy@gmail.com')
                ->setPassword(password_hash('1234', PASSWORD_BCRYPT))
                ->setEnabled('1'),
        ];
    }
}
