<?php

namespace ApiBundle\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiRequestListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $statusCode = null;
        $exception = $event->getException();

        $errorObj = [
            'type' => get_class($exception),
            'message' => $exception->getMessage(),
        ];

        $event->setResponse(
            new JsonResponse($errorObj, $exception->getCode())
        );
    }
}
