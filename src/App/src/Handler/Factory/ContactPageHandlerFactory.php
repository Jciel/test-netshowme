<?php

declare(strict_types=1);

namespace App\Handler\Factory;

use App\Form\ContactForm;
use App\Handler\ContactPageHandler;
use App\Service\ContactService;
use App\Service\FileService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\Form;

/**
 * Class ContactPageHandlerFactory
 * @package App\Handler\Factory
 */
class ContactPageHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /** @var ContactService $contactService */
        $contactService = $container->get(ContactService::class);

        /** @var FileService $fileService */
        $fileService = $container->get(FileService::class);

        /** @var Form $form */
        $form = new ContactForm();

        return new ContactPageHandler($template, $contactService, $fileService, $form);
    }
}
