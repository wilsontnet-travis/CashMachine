<?php

namespace Tests\ApiBundle\Controller;

use ApiBundle\Exception\ApiException;
use ApiBundle\Exception\InvalidArgumentException;
use ApiBundle\Exception\NoteUnavailableException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CashControllerTest extends WebTestCase
{
    /**
     * @dataProvider getNotesDataProvider
     *
     * @param int   $input
     * @param array $expected
     */
    public function testGetNotes(int $input, array $expected): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            'api/v1/cash/' . $input,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
         );

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $data = json_decode($response->getContent());
        $this->assertEquals($expected, $data);
    }

    /**
     * @return array
     */
    public function getNotesDataProvider(): array
    {
        return [
            '#1 - test 120' => [
                120,
                [50, 50, 5, 5, 5, 5],
            ],
            '#2 - test 180 return all type of notes' => [
                85,
                [50, 30, 5],
            ],
            '#3 - 0 return []' => [
                0,
                [],
            ],
        ];
    }

    /**
     * @dataProvider getNotesExceptionDataProvider
     *
     * @param int          $input
     * @param int          $expectedStatusCode
     * @param ApiException $expected
     */
    public function testGetNotesException(int $input, int $expectedStatusCode, ApiException $expected): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            'api/v1/cash/' . $input,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $client->getResponse();
        $this->assertEquals($expectedStatusCode, $response->getStatusCode());
        $data = json_decode($response->getContent());
        $this->assertEquals(get_class($expected), $data->type);
    }

    /**
     * @return array
     */
    public function getNotesExceptionDataProvider(): array
    {
        return [
            '#1 - "-100" should return InvalidArgumentException' => [
                -100,
                Response::HTTP_PRECONDITION_FAILED,
                new InvalidArgumentException('whatever message'),
            ],
            '#2 - "33" should return NoteUnavailableException' => [
                33,
                Response::HTTP_PRECONDITION_FAILED,
                new NoteUnavailableException(),
            ],
        ];
    }
}
