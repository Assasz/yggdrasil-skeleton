<?php

namespace Skeleton\Application\DriverInterface;

/**
 * Interface TemplateEngineInterface
 *
 * @package Skeleton\Application\DriverInterface
 */
interface TemplateEngineInterface
{
    /**
     * Renders given view
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;
}
