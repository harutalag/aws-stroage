<?php
namespace repositories;

use app\models\Ticket;
use yii\httpclient\Client;
use yii\httpclient\Response;
use Yii;

class ApiTicketRepository implements TicketRepositoryInterface
{
    private Client $client;
    private string $baseUrl;

    public function __construct(Client $client, string $baseUrl = 'https://external.api/tickets')
    {
        $this->client = $client;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function load(int $ticketId): ?Ticket
    {
        $response = $this->sendRequest('GET', "{$this->baseUrl}/{$ticketId}");

        if (!$this->isSuccessful($response)) {
            return null;
        }

        $ticket = new Ticket();
        $ticket->setAttributes($response->data, false);

        return $ticket;
    }

    public function save(Ticket $ticket): bool
    {
        $response = $this->sendRequest('POST', $this->baseUrl, $ticket->getAttributes());
        return $this->isSuccessful($response);
    }

    public function update(Ticket $ticket): bool
    {
        $response = $this->sendRequest('PUT', "{$this->baseUrl}/{$ticket->id}", $ticket->getAttributes());
        return $this->isSuccessful($response);
    }

    public function delete(Ticket $ticket): bool
    {
        $response = $this->sendRequest('DELETE', "{$this->baseUrl}/{$ticket->id}");
        return $this->isSuccessful($response);
    }

    /**
     * Выполняет HTTP-запрос
     */
    private function sendRequest(string $method, string $url, array $data = []): Response
    {
        $request = $this->client->createRequest()
            ->setMethod($method)
            ->setUrl($url);

        if (!empty($data)) {
            $request->setData($data);
        }

        try {
            return $request->send();
        } catch (\Throwable $e) {
            Yii::error("API request failed: " . $e->getMessage(), __METHOD__);
            return new Response(); // Возвращаем пустой Response, чтобы не ломать логику
        }
    }

    /**
     * Проверка успешности ответа
     */
    private function isSuccessful(?Response $response): bool
    {
        return $response && $response->getIsOk();
    }
}
