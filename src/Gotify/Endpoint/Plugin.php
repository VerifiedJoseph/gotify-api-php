<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
		return $this->guzzle->get($this->endpoint);
	}

	/**
	 * Get configuration for Configurer plugin.
	 *
	 * @param string $id Plugin Id
	 *
	 * @return \stdClass
	 */
	public function getConfig(int $id)
	{
		return $this->guzzle->get($this->endpoint . '/' . $id . '/config');
	}

	/**
	 * Update configuration for Configurer plugin.
	 *
	 * @param string $id Plugin Id
	 *
	 * @return \stdClass
	 */
	public function updateConfig(int $id)
	{
		// Todo: Add action
	}

	/**
	 * Get display info for a Displayer plugin
	 *
	 * @param string $id Plugin Id
	 *
	 * @return \stdClass
	 */
	public function getDisplayInfo(int $id)
	{
		return $this->guzzle->get($this->endpoint . '/' . $id . '/display');
	}

	/**
	 * Enable a plugin.
	 *
	 * @param string $id Plugin Id
	 *
	 * @return null
	 */
	public function enable(int $id)
	{
		return $this->guzzle->post($this->endpoint . '/' . $id . '/enable');
	}

	/**
	 * Disable a plugin
	 *
	 * @param string $id Plugin Id
	 *
	 * @return null
	 */
	public function disable(int $id)
	{
		return $this->guzzle->post($this->endpoint . '/' . $id . '/disable');
	}
}
