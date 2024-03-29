<?php

use Gotify\Endpoint\Health;

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
