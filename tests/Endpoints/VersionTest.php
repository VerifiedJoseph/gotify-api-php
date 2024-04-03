<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Gotify\Endpoint\Version;

#[CoversClass(Version::class)]
#[UsesClass(Gotify\Api::class)]
#[UsesClass(Gotify\Guzzle::class)]
#[UsesClass(Gotify\Json::class)]
#[UsesClass(Gotify\Server::class)]
class VersionTest extends AbstractTestCase
{
    /**
     * Test getting server version
     */
    public function testGet(): void
    {
        $version = new Version(
            self::$server
        );

        $details = $version->get();

        $this->assertIsObject($details);
    }
}
