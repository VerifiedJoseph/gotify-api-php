<?php

declare(strict_types=1);

namespace Gotify\Endpoint;

use Gotify\Json;
use stdClass;

/**
 * Class for interacting with application API endpoint
 *
  * @see https://gotify.net/api-docs#/application API docs for message endpoint
 */
class Application extends AbstractEndpoint
{
    /** @var string $endpoint API endpoint */
    private string $endpoint = 'application';

    /**
     * Get all applications
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/application/getApps API docs for getting all applications
     */
    public function getAll(): stdClass
    {
        $response = $this->guzzle->get($this->endpoint);
        $applications = Json::decode($response->getBody()->getContents());

        return (object) ['apps' => $applications];
    }

    /**
     * Create an application
     *
     * @param string $name Application name
     * @param string $description Application description
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/application/createApp API docs for creating an application
     */
    public function create(string $name, string $description): stdClass
    {
        $data = [
            'name' => $name,
            'description' => $description
        ];

        $response = $this->guzzle->post($this->endpoint, $data);
        $application = Json::decode($response->getBody()->getContents());

        return (object) $application;
    }

    /**
     * Update an application
     *
     * @param int $id Application Id
     * @param string $name New application name
     * @param string $description New application description
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/application/updateApplication API docs for updating an application
     */
    public function update(int $id, string $name, string $description): stdClass
    {
        $data = [
            'name' => $name,
            'description' => $description
        ];

        $response = $this->guzzle->put($this->endpoint . '/' . $id, $data);
        $application = Json::decode($response->getBody()->getContents());

        return (object) $application;
    }

    /**
     * Delete an application
     *
     * @param int $id Application Id
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/application/deleteApp API docs for deleting an application
     */
    public function delete(int $id): bool
    {
        $response = $this->guzzle->delete($this->endpoint . '/' . $id);
        $body = $response->getBody()->getContents();

        return $response->getStatusCode() === 200 ? true : false;
    }

    /**
     * Upload an image for the application
     *
     * @param int $id Application Id
     * @param string $image Image path
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/application/uploadAppImage API docs for uploading an application image
     */
    public function uploadImage(int $id, string $image): stdClass
    {
        $data = [
            'file' => $image
        ];

        $response = $this->guzzle->postFile($this->endpoint . '/' . $id . '/image', $data);
        $application = Json::decode($response->getBody()->getContents());

        return (object) $application;
    }

    /**
     * Delete the image of an application
     *
     * @param int $id Application Id
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/application/removeAppImage API docs for deleting an application image
     */
    public function deleteImage(int $id): bool
    {
        $response = $this->guzzle->delete($this->endpoint . '/' . $id . '/image');
        return $response->getStatusCode() === 200 ? true : false;
    }
}
