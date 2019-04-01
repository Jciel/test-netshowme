<?php

declare(strict_types=1);

namespace App\Listener\Factory;

use App\Listener\SendEmailEventListener;
use Psr\Container\ContainerInterface;

/**
 * Class SendEmailEventListenerFactory
 * @package App\Listener\Factory
 */
class SendEmailEventListenerFactory
{
    /**
     * @param ContainerInterface $container
     * @return SendEmailEventListener
     */
    public function __invoke(ContainerInterface $container): SendEmailEventListener
    {
        $config = $container->get('config');

        $mailConfig = $config['mail'];

        return new SendEmailEventListener($mailConfig);
    }
}
