<?php

namespace ApiBundle\Exception;

class NoteUnavailableException extends ApiException
{
    public const HTTP_STATUS_CODE = 412;

    /**
     * @param string          $message
     * @param null|\Exception $previousEx
     */
    public function __construct(
        $message = 'Sorry no notes available for your desired amount',
        \Exception $previousEx = null
    ) {
        parent::__construct($message, static::HTTP_STATUS_CODE, $previousEx);
    }
}
