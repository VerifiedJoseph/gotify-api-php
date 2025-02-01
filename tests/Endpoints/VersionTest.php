<?php

declare(strict_types=1);

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Tests\AbstractTestCase;
use Gotify\Endpoint\Version;
use Gotify\Endpoint\AbstractEndpoint;

#[CoversClass(Version::class)]
#[UsesClass(AbstractEndpoint::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
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

        $this->assertObjectHasProperty('version', $details);
    }
}
