<?php

declare(strict_types=1);

namespace App\Listener;

use App\Document\ContactMessage;
use App\Document\File;
use PHPMailer\PHPMailer\PHPMailer;
use Zend\EventManager\Event;

/**
 * Class SendEmailEventListener
 * @package App\Listener
 */
class SendEmailEventListener
{
    /** @var array */
    private $mailConfig;

    /**
     * SendEmailEventListener constructor.
     * @param array $mailConfig
     */
    public function __construct(array $mailConfig)
    {
        $this->mailConfig = $mailConfig;
    }

    /**
     * @param Event $event
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function execute(Event $event): bool
    {
        /** @var ContactMessage $contactMessage */
        $contactMessage = $event->getParams();

        /** @var File $file */
        $file = $contactMessage->getFile();

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = $this->mailConfig["smtpOptions"]["host"];
        $mail->SMTPAuth = true;
        $mail->Username = $this->mailConfig["smtpOptions"]["connection_config"]["username"];
        $mail->Password = $this->mailConfig["smtpOptions"]["connection_config"]["password"];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $this->mailConfig["smtpOptions"]["port"];

        $mail->setFrom($this->mailConfig['originEmail'], $this->mailConfig['originName']);
        $mail->addAddress($this->mailConfig['destinationEmail'], $this->mailConfig['destinationName']);

        $mail->isHTML(true);
        $mail->Subject = "Contact Message";
        $mail->Body = $this->getMessageFormat($contactMessage);
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->addAttachment('.' . $file->getPath(), $file->getName());

        return $mail->send();
    }

    /**
     * @param array $data
     * @return string
     */
    private function getMessageFormat($contactMessage): string
    {
        return "<h2>Mensagem de contato</h2>" .
            "<br>" .
            "<strong>Nome: </strong>" . $contactMessage->getName() . "<br>" .
            "<strong>E-Mail: </strong>" . $contactMessage->getEmail() . "<br>" .
            "<strong>Telefone: </strong>" . $contactMessage->getPhone() . "<br>" .
            "<strong>IP: </strong>" . $contactMessage->getIp() . "<br>" .
            "<strong>Mensagem: </strong>" . "<br>" . $contactMessage->getMessage();
    }
}
