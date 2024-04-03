<?php

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Tests\AbstractTestCase;
use Gotify\Endpoint\Health;

#[CoversClass(Health::class)]
#[CoversClass(\Gotify\Api::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
class HealthTest extends AbstractTestCase
{
    /**
     * Test getting server health status
     */
    public function testGet(): void
    {
        $health = new Health(
            self::$server
        );

        $status = $health->get();

        $this->assertIsObject($status);
    }
}
