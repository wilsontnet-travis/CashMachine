<?php

namespace ApiBundle\Exception;

class InvalidArgumentException extends ApiException
{
    public const HTTP_STATUS_CODE = 412;

    /**
     * @param string          $message
     * @param null|\Exception $previousEx
     */
    public function __construct($message, \Exception $previousEx = null)
    {
        parent::__construct($message, static::HTTP_STATUS_CODE, $previousEx);
    }
}
