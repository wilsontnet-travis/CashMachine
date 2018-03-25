<?php

namespace ApiBundle\Controller;

use ApiBundle\Exception\InvalidArgumentException;
use ApiBundle\Exception\NoteUnavailableException;
use ApiBundle\Service\Interfaces\CashAllocateStrategyInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CashController extends Controller
{
    /**
     * @var CashAllocateStrategyInterface
     */
    private $cashAllocateService;

    /**
     * @param CashAllocateStrategyInterface $cashAllocateService
     */
    public function __construct(
        CashAllocateStrategyInterface    $cashAllocateService
    ) {
        $this->cashAllocateService = $cashAllocateService;
    }

    /**
     * @Route("/v{apiVersion}/cash/{input}", name="api_cash_get_note")
     * @Method("GET")
     *
     * @param mixed $input
     *
     * @return JsonResponse
     *
     * @throws NoteUnavailableException
     * @throws InvalidArgumentException
     */
    public function getNotes($input)
    {
        $result = $this->cashAllocateService->process($input);

        return new JsonResponse(
            $result,
            Response::HTTP_OK
        );
    }
}
