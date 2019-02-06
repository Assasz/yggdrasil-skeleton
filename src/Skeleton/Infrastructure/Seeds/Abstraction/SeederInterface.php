<?php

namespace Skeleton\Infrastructure\Seeds\Abstraction;

/**
 * Interface SeederInterface
 *
 * Persistence mechanism able to manage seeds
 *
 * @package Skeleton\Infrastructure\Seeds\Abstraction
 */
interface SeederInterface
{
    /**
     * Persists given seed object
     *
     * @param object $seed Seed object to persist
     */
    public function persist(object $seed): void;

    /**
     * Flushes all changes to seeds objects
     */
    public function flush(): void;

    /**
     * Truncates seeds storage
     *
     * @param string $storage Name of seeds storage
     * @return bool
     */
    public function truncate(string $storage): bool;
}
