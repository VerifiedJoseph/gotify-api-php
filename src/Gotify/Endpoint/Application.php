<?php

namespace Gotify\Endpoint;

Use Gotify\Api;
Use Gotify\Json;

/**
 * Class for interacting with application API endpoint
 */
class Application extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'application';

	/**
	 * Get all applications
	 *
	 * @return \stdClass
	 */
	public function getAll()
	{
		$response = $this->guzzle->get($this->endpoint);
		$applications = Json::decode($response->getBody());

		return (object) $applications;
	}

	/**
	 * Create an application
	 *
	 * @param string $name Application name
	 * @param string $description Application description
	 *
	 * @return \stdClass
	 */
	public function create(string $name, string $description)
	{
		$data = array(
			'name' => $name,
			'description' => $description
		);

		$response = $this->guzzle->post($this->endpoint, $data);
		$application = Json::decode($response->getBody());

		return (object) $application;
	}

	/**
	 * Update an application
	 *
	 * @param int $id Application Id
	 * @param string $name New application name
	 * @param string $description New application description
	 *
	 * @return \stdClass
	 */
	public function update(int $id, string $name, string $description)
	{
		$data = array(
			'name' => $name,
			'description' => $description
		);

		$response = $this->guzzle->put($this->endpoint . '/' . $id, $data);
		$application = Json::decode($response->getBody());

		return (object) $application;
	}

	/**
	 * Delete an application
	 *
	 * @param int $id Application Id
	 *
	 * @return void
	 */
	public function delete(int $id)
	{
		$this->guzzle->delete($this->endpoint . '/' . $id);
	}

	/**
	 * Upload an image for the application
	 *
	 * @param int $id Application Id
	 * @param string $image Image path
	 *
	 * @return \stdClass
	 */
	public function uploadImage(int $id, string $image)
	{
		$data = array(
			'file' => $image
		);

		$response = $this->guzzle->postFile($this->endpoint . '/' . $id . '/image', $data);
		$application = Json::decode($response->getBody());

		return (object) $application;
	}
}
