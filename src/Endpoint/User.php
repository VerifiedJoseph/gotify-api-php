<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

/**
 * Class for interacting with the user endpoint
 *
 * @see https://gotify.net/api-docs#/user API docs for the user endpoint
 */
class User extends Api
{
    /** @var string $endpoint API endpoint */
    private string $endpoint = 'user';

    /**
     * Get current user
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/user/currentUser API docs for getting the current user
     */
    public function getCurrent(): stdClass
    {
        $response = $this->guzzle->get('current/user');
        $current = Json::decode($response->getBody());

        return (object) $current;
    }

    /**
     * Update password for the current user
     *
     * @param string $password New password
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/user/updateCurrentUser API docs for updating the current user's password
     */
    public function updatePassword(string $password): bool
    {
        $data = [
            'pass' => $password,
        ];

        $response = $this->guzzle->post('current/user/password', $data);
        $body = $response->getBody()->getContents();

        if (empty($body) === true) {
            return true;
        }

        return false;
    }

    /**
     * Get user
     *
     * @param int $id User Id
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/user/getUser API docs for getting a user
     */
    public function getUser(int $id): stdClass
    {
        $response = $this->guzzle->get($this->endpoint . '/' . $id);
        $user = Json::decode($response->getBody());

        return (object) $user;
    }

    /**
     * Get all users
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/user/getUsers API docs for getting all users
     */
    public function getAll(): stdClass
    {
        $response = $this->guzzle->get($this->endpoint);
        $users = Json::decode($response->getBody());

        return (object) ['users' => $users];
    }

    /**
     * Create a user
     *
     * @param string $name Username
     * @param string $password Password
     * @param boolean $admin Admin status
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/user/createUser API docs for creating a user
     */
    public function create(string $name, string $password, bool $admin = false): stdClass
    {
        $data = [
            'name' => $name,
            'pass' => $password,
            'admin' => $admin
        ];

        $response = $this->guzzle->post($this->endpoint, $data);
        $user = Json::decode($response->getBody());

        return (object) $user;
    }

    /**
     * Update a user
     *
     * @param int $id User Id
     * @param string $name New username
     * @param string $password New password (leave if no change)
     * @param boolean $admin Admin status
     *
     * @return stdClass
     *
     * @see https://gotify.net/api-docs#/user/updateUser API docs for updating a user
     */
    public function update(int $id, string $name, string $password = '', bool $admin = false): stdClass
    {
        $data = [
            'name' => $name,
            'pass' => $password,
            'admin' => $admin
        ];

        $response = $this->guzzle->post($this->endpoint . '/' . $id, $data);
        $user = Json::decode($response->getBody());

        return (object) $user;
    }

    /**
     * Delete a user
     *
     * @param int $id User Id
     *
     * @return boolean
     *
     * @see https://gotify.net/api-docs#/user/deleteUser API docs for deleting a user
     */
    public function delete(int $id): bool
    {
        $response = $this->guzzle->delete($this->endpoint . '/' . $id);
        $body = $response->getBody()->getContents();

        if (empty($body) === true) {
            return true;
        }

        return false;
    }
}
