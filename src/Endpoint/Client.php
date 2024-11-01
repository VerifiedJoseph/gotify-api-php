<?php

namespace Gotify\Endpoint;

use Gotify\Json;
use stdClass;

/**
 * Class for interacting with client API endpoint
 *
  * @see https://gotify.net/api-docs#/client API docs for client endpoint
 */
class Client extends AbstractEndpoint
{
    /** @var string $endpoint API endpoint */
    private string $endpoint = 'client';

    /**
     * Get all clients
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/client/getClients API docs for getting all clients
     */
    public function getAll(): stdClass
    {
        $response = $this->guzzle->get($this->endpoint);
        $clients = Json::decode($response->getBody());

        return (object) ['clients' => $clients];
    }

    /**
     * Create a client
     *
     * @param string $name Client name
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/client/createClient API docs for creating a client
     */
    public function create(string $name): stdClass
    {
        $data = [
            'name' => $name,
        ];

        $response = $this->guzzle->post($this->endpoint, $data);
        $client = Json::decode($response->getBody());

        return (object) $client;
    }

    /**
     * Update a client
     *
     * @param int $id Client Id
     * @param string $name New client name
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/client/updateClient API docs for updating a client
     */
    public function update(int $id, string $name): stdClass
    {
        $data = [
            'name' => $name,
        ];

        $response = $this->guzzle->put($this->endpoint . '/' . $id, $data);
        $client = Json::decode($response->getBody());

        return (object) $client;
    }

    /**
     * Delete a client
     *
     * @param int $id Client Id
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/client/deleteClient API docs for deleting a client
     */
    public function delete(int $id): bool
    {
        $response = $this->guzzle->delete($this->endpoint . '/' . $id);
        $body = $response->getBody()->getContents();

        return $body === '' ? true : false;
    }
}
