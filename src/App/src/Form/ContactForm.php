<?php

declare(strict_types=1);

namespace App\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Form\Element\Email;
use Zend\Form\Element\File;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\I18n\Validator\PhoneNumber;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\File\Extension;
use Zend\Validator\File\FilesSize;
use Zend\Validator\File\Upload;
use Zend\Validator\File\UploadFile;
use Zend\Validator\Ip;

/**
 * Class ContactForm
 * @package App\Form
 */
class ContactForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add([
            'type' => Text::class,
            'name' => 'name',
        ]);

        $this->add([
            'type' => Email::class,
            'name' => 'email',
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'phone',
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'message',
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'ip',
        ]);

        $this->add([
            'type' => File::class,
            'name' => 'file',
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class]
                ],
            ],

            'email' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    new EmailAddress()
                ]
            ],

            'phone' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    new PhoneNumber(["country" => "BR"])
                ]
            ],

            'message' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
            ],

            'ip' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    new Ip(["allowipv4" => true])
                ]
            ],

            'file' => [
                'required' => true,
//                'filters' => [
//                    ['name' => File]
//                ],
                'validators' => [
                    new UploadFile(),
                    new FilesSize(["max" => "500kb"]),
                    new Extension(["doc", "pdf", "docx", "odt", "txt"])
                ]
            ]
        ];
    }
}
