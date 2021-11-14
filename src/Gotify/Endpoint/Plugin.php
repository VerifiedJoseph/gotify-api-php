<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;

/**
 * Class for interacting with plugin API endpoint
 */
class Plugin extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'plugin';

	/**
	 * Get all plugins
	 *
	 * @return \stdClass
	 */
	public function getAll()
	{
		$response = $this->guzzle->get($this->endpoint);
		$plugins = Json::decode($response->getBody());

		return (object) $plugins;
	}

	/**
	 * Get configuration for Configurer plugin.
	 *
	 * @param int $id Plugin Id
	 *
	 * @return \stdClass
	 */
	public function getConfig(int $id)
	{
		$response =  $this->guzzle->get($this->endpoint . '/' . $id . '/config');
		$config = Json::decode($response->getBody());

		return (object) $config;
	}

	/**
	 * Update configuration for Configurer plugin.
	 *
	 * @param int $id Plugin Id
	 *
	 * @return \stdClass
	 */
	/*public function updateConfig(int $id)
	{
		// Todo: Add action
	}*/

	/**
	 * Get display info for a Displayer plugin
	 *
	 * @param int $id Plugin Id
	 *
	 * @return \stdClass
	 */
	public function getDisplayInfo(int $id)
	{
		$response =  $this->guzzle->get($this->endpoint . '/' . $id . '/display');;
		$displayInfo = Json::decode($response->getBody());

		return (object) $displayInfo;
	}

	/**
	 * Enable a plugin.
	 *
	 * @param int $id Plugin Id
	 *
	 * @return boolean
	 */
	public function enable(int $id)
	{
		$response = $this->guzzle->post($this->endpoint . '/' . $id . '/enable');
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}

	/**
	 * Disable a plugin
	 *
	 * @param int $id Plugin Id
	 *
	 * @return boolean
	 */
	public function disable(int $id)
	{
		$response =  $this->guzzle->post($this->endpoint . '/' . $id . '/disable');
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}
}
