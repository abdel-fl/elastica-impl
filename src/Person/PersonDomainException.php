<?php

namespace App\Person;

use Throwable;

/**
 * Class PersonDomainException
 */
class PersonDomainException extends \DomainException
{
    const FORM_VALIDATION_ERROR_CODE = 101;
    const FORM_VALIDATION_ERROR_MESSAGE = 'Invalid data given !';

    /**
     * @var array|null
     */
    private $data;

    /**
     * PersonDomainException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param array|null     $data
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, array $data = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->data = $data;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }
}
