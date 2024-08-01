<?php

namespace Gotify\Endpoint;

use Gotify\Json;
use stdClass;

/**
 * Class for interacting with the message methods in Application API endpoint
 *
 * @see https://gotify.net/api-docs#/message API docs for message endpoint
 */
class ApplicationMessage extends AbstractEndpoint
{
    /** @var string $endpoint API endpoint */
    private string $endpoint = 'application';

    /**
     * Get all messages for an application (ordered by most recent)
     *
     * @param int $id Application Id
     * @param int $limit Maximum number of messages to return
     * @param int $since Return all messages after a message id
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/message/getAppMessages API docs for getting all messages for an application
     */
    public function getAll(int $id, int $limit = 100, int $since = 0): stdClass
    {
        $query = [
            'limit' => $limit,
            'since' => $since
        ];

        $response = $this->guzzle->get($this->endpoint . '/' . $id . '/message', $query);
        $messages = Json::decode($response->getBody());

        return (object) $messages;
    }

    /**
     * Delete all messages for an application
     *
     * @param int $id Application Id
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/message/deleteAppMessages API docs for deleting all messages for an application
     */
    public function deleteAll(int $id): bool
    {
        $response = $this->guzzle->delete($this->endpoint . '/' . $id . '/message');
        $body = $response->getBody()->getContents();

        return $body === '' ? true : false;
    }
}
