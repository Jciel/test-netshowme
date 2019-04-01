<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\ContactService;
use App\Service\FileService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\Form;

/**
 * Class ContactPageHandler
 * @package App\Handler
 */
class ContactPageHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var ContactService */
    private $contactService;

    /** @var FileService */
    private $fileService;

    /** @var Form */
    private $form;

    /**
     * ContactPageHandler constructor.
     * @param TemplateRendererInterface $template
     * @param ContactService $contactService
     * @param FileService $fileService
     * @param Form $form
     */
    public function __construct(
        TemplateRendererInterface $template,
        ContactService $contactService,
        FileService $fileService,
        Form $form
    )
    {
        $this->template = $template;
        $this->contactService = $contactService;
        $this->fileService = $fileService;
        $this->form = $form;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $type = $request->getMethod();

        $result = [
            "data" => [],
            "errorMessages" => [],
            "success" => false,
            "successMessage" => ""
        ];

        if ($type === 'GET') {
            return new HtmlResponse($this->template->render('app::contact-page', $result));
        }

        $data = $this->getDataMessage($request);
        $this->form->setData($data);

        $result["data"] = $data;
        if (!$this->form->isValid()) {
            $result["errorMessages"] = $this->form->getMessages();
            return new HtmlResponse($this->template->render('app::contact-page', $result));
        }

        $this->fileService->saveFileInHD($data["file"]);
        $this->contactService->saveMessageData($data);

        $result["success"] = true;
        $result["data"] = [];
        $result["successMessage"] = "Menssagem enviada com sucesso.";
        return new HtmlResponse($this->template->render('app::contact-page', $result));
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    private function getDataMessage(ServerRequestInterface $request): array
    {
        $data = $request->getParsedBody();
        $data["file"] = $request->getUploadedFiles()["file"] ?? null;
        $data["ip"] = $request->getServerParams()["REMOTE_ADDR"] ?? "";

        if ($data["file"]->getClientFileName() === "") {
            $data["file"] = null;
        }

        return $data;
    }
}
