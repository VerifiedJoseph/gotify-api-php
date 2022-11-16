<?php

use Gotify\Endpoint\Version;

class VersionTest extends TestCase
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
