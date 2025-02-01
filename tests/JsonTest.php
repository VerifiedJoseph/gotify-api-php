<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Gotify\Json;
use Gotify\Exception\GotifyException;
use stdClass;

#[CoversClass(Json::class)]
#[UsesClass(GotifyException::class)]
class JsonTest extends AbstractTestCase
{
    public function testEncode(): void
    {
        $this->assertEquals('{"foo":"bar"}', Json::encode(['foo' => 'bar']));
    }

    public function testDecode(): void
    {
        $expected = new stdClass();
        $expected->foo = 'bar';
        $this->assertEquals($expected, Json::decode('{"foo": "bar"}'));
    }

    public function testDecodeToArray(): void
    {
        $expected = ['hello'];
        $this->assertEquals($expected, Json::decode('["hello"]'));
    }

    public function testEncodeInvalid(): void
    {
        $this->expectException(GotifyException::class);
        $this->expectExceptionMessage('JSON Error: Malformed UTF-8 characters, possibly incorrectly encoded');
        Json::encode("\xB1\x31");
    }

    public function testDecodeInvalid(): void
    {
        $this->expectException(GotifyException::class);
        $this->expectExceptionMessage('JSON Error: Syntax error');
        Json::decode('foo');
    }
}
