<?php

namespace ApiBundle\Exception;

class ApiException extends \Exception
{
    /**
     * @param null|string     $message
     * @param int             $status
     * @param null|\Exception $previousException
     */
    public function __construct($message = null, $status = 500, \Exception $previousException = null)
    {
        if (null === $message) {
            $message = 'Internal Server Error';
        }

        parent::__construct($message, $status, $previousException);
    }
}
