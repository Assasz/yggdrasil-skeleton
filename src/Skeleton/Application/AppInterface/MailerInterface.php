<?php

namespace Skeleton\Application\AppInterface;

/**
 * Interface MailerInterface
 *
 * @package Skeleton\Application\AppInterface
 */
interface MailerInterface
{
    /**
     * Creates message composed with given data
     *
     * @param string       $subject
     * @param string|array $sender
     * @param string|array $receivers
     * @param string       $body
     * @param string       $contentType
     * @return \Swift_Message
     */
    public function createMessage(string $subject, $sender, $receivers, string $body, string $contentType = 'text/html'): \Swift_Message;

    /**
     * Sends given message
     *
     * @param \Swift_Message $message
     * @return int Number of successful receivers
     */
    public function send(\Swift_Message $message): int;
}