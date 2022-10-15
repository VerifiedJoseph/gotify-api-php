<?php

use Gotify\Endpoint\Plugin;

class PluginTest extends TestCase
{
	private static Plugin $plugin;

	private static int $pluginId = 1;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$plugin = new Plugin(
			self::$server->get(),
			self::$auth
		);
	}

	/**
	 * Test getting all plugins
	 */
	public function testGetAll(): void
	{
		$plugins = self::$plugin->getAll();

		$this->assertIsObject($plugins);
		$this->assertObjectHasAttribute('plugins', $plugins);

		if (count($plugins->plugins) > 0) {
			$this->assertIsObject($plugins->plugins[0]);

			$plugin = $plugins->plugins[0];

			$this->assertObjectHasAttribute('id', $plugin);
			$this->assertObjectHasAttribute('name', $plugin);
			$this->assertObjectHasAttribute('token', $plugin);
		}
	}

	/**
	 * Test getting config for a plugin
	 */
	public function testGetConfig(): void
	{
		$config = self::$plugin->getConfig(self::$pluginId);

		$this->assertNotEmpty($config);
	}

	/**
	 * Test updating config for a plugin
	 */
	public function testUpdateConfig(): void
	{
		$updated = self::$plugin->updateConfig(self::$pluginId, $this->getYaml());

		$this->assertIsBool($updated);
		$this->assertEquals(true, $updated);

		$config = self::$plugin->getConfig(self::$pluginId);

		$this->assertEquals($config, $this->getYaml());
	}

	public function testGetDisplayInfo(): void
	{
		$info = self::$plugin->getDisplayInfo(self::$pluginId);

		$this->assertNotEmpty($info);
	}

	/**
	 * Test enabling a plugin
	 */
	public function testEnable(): void
	{
		$enabled = self::$plugin->enable(self::$pluginId);

		$this->assertIsBool($enabled);
		$this->assertEquals(true, $enabled);
	}

	/**
	 * Test disabling a plugin
	 *
	 * @depends testEnable
	 */
	public function testDisable(): void
	{
		$disabled = self::$plugin->disable(self::$pluginId);

		$this->assertIsBool($disabled);
		$this->assertEquals(true, $disabled);
	}
}
