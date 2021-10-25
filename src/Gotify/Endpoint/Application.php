<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
		return $this->guzzle->get($this->endpoint);
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

		return $this->guzzle->post($this->endpoint, $data);
	}

	/**
	 * Update an application
	 * 
	 * @param string $id Application Id
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

		return $this->guzzle->put($this->endpoint . '/' . $id, $data);
	}

	/**
	 * Delete an application
	 * 
	 * @param string $id Application Id
	 * 
	 * @return 
	 */
	public function delete(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id);
	}

	/**
	 * Upload an image for the application
	 * 
	 * @param string $id Application Id
	 * @param mixed $image Image path
	 * 
	 * @return \stdClass
	 */
	public function uploadImage(int $id, mixed $image)
	{
		$data = array(
			'file' => $image
		);

		return $this->guzzle->postFile($this->endpoint . '/' . $id . '/image', $data);
	}
} 