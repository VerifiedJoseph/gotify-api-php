<?php

declare(strict_types=1);

namespace Gotify\Endpoint;

use Gotify\Json;
use stdClass;

/**
 * Class for interacting with the health API endpoint
 *
 * @see https://gotify.net/api-docs#/health API docs for the health endpoint
 */
class Health extends AbstractEndpoint
{
    /** @var string $endpoint API endpoint */
    private string $endpoint = 'health';

    /**
     * Get health information
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/client/getClients API docs for getting health information
     */
    public function get(): stdClass
    {
        $response = $this->guzzle->get($this->endpoint);
        $health = Json::decode($response->getBody()->getContents());

        return (object) $health;
    }
}
