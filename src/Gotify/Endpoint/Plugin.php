<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

/**
 * Class for interacting with the plugin API endpoint
 *
 * @see https://gotify.net/api-docs#/plugin API docs for the user endpoint
 */
class Plugin extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'plugin';

	/**
	 * Get all plugins
	 *
	 * @return stdClass
	 *
	 * @see https://gotify.net/api-docs#/plugin/getPlugins API docs for getting all plugins
	 */
	public function getAll():stdClass
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
	 * @return stdClass
	 *
	 * @see https://gotify.net/api-docs#/plugin/getPluginConfig API docs for getting the configuration for a plugin
	 */
	public function getConfig(int $id):stdClass
	{
		$response = $this->guzzle->get($this->endpoint . '/' . $id . '/config');
		$config = Json::decode($response->getBody());

		return (object) $config;
	}

	/**
	 * Update configuration for Configurer plugin.
	 *
	 * @param int $id Plugin Id
	 *
	 * @return \stdClass
	 *
	 * @see https://gotify.net/api-docs#/plugin/updatePluginConfig API docs for updating the configuration for a plugin
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
	 * @return stdClass
	 *
	 * @see https://gotify.net/api-docs#/plugin/getPluginDisplay API docs for getting the display info for a plugin
	 */
	public function getDisplayInfo(int $id): stdClass
	{
		$response = $this->guzzle->get($this->endpoint . '/' . $id . '/display');;
		$displayInfo = Json::decode($response->getBody());

		return (object) $displayInfo;
	}

	/**
	 * Enable a plugin.
	 *
	 * @param int $id Plugin Id
	 *
	 * @return boolean
	 *
	 * @see https://gotify.net/api-docs#/plugin/enablePlugin API docs for enabling a plugin
	 */
	public function enable(int $id): bool
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
	 *
	 * @see https://gotify.net/api-docs#/plugin/disablePlugin API docs for disabling a plugin
	 */
	public function disable(int $id): bool
	{
		$response = $this->guzzle->post($this->endpoint . '/' . $id . '/disable');
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}
}
