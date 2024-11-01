<?php

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\Depends;
use Tests\AbstractTestCase;
use Gotify\Endpoint\Plugin;
use Gotify\Endpoint\Application;
use Gotify\Endpoint\AbstractEndpoint;
use Gotify\Auth\Token;

#[CoversClass(Plugin::class)]
#[CoversClass(Application::class)]
#[CoversClass(Token::class)]
#[UsesClass(AbstractEndpoint::class)]
#[UsesClass(\Gotify\Auth\AbstractAuth::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
class PluginTest extends AbstractTestCase
{
    private static Plugin $plugin;

    private static int $pluginId = 1;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$plugin = new Plugin(
            self::$server,
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
        $this->assertObjectHasProperty('plugins', $plugins);

        if (count($plugins->plugins) > 0) {
            $this->assertIsObject($plugins->plugins[0]);

            $plugin = $plugins->plugins[0];

            $this->assertObjectHasProperty('id', $plugin);
            $this->assertObjectHasProperty('name', $plugin);
            $this->assertObjectHasProperty('token', $plugin);
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
     */
    #[Depends('testEnable')]
    public function testDisable(): void
    {
        $disabled = self::$plugin->disable(self::$pluginId);

        $this->assertIsBool($disabled);
        $this->assertEquals(true, $disabled);
    }
}
