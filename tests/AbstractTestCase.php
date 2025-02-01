<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Gotify\Server;
use Gotify\Auth\User;

abstract class AbstractTestCase extends TestCase
{
    protected static string $gotifyUri = 'http://127.0.0.1:8080/';
    protected static string $httpBinUri = 'https://httpbin.org/';

    protected static Server $server;
    protected static User $auth;

    public static function setUpBeforeClass(): void
    {
        self::$server = new Server(self::getGotifyUri());
        self::$auth = new User('admin', 'admin');
    }

    /**
     * Returns text fle path
     */
    protected function getTextFilePath(): string
    {
        return __DIR__ . '/TestAssets/file.txt';
    }

    /**
     * Returns YAML path
     */
    protected function getYamlPath(): string
    {
        return __DIR__ . '/TestAssets/broadcaster-config.yaml';
    }

    /**
     * Returns app image path
     */
    protected function getAppImagePath(): string
    {
        return __DIR__ . '/TestAssets/appImage.png';
    }

    /**
     * Returns app image as a base64 encoded string
     */
    protected function getAppImageBase64(): string
    {
        $imageData = (string) file_get_contents($this->getAppImagePath());
        $imageMimeType = mime_content_type($this->getAppImagePath());

        $encoded = base64_encode($imageData);

        return 'data:' . $imageMimeType . ';base64,' . $encoded;
    }

    /**
     * Returns example broadcaster config YAML
     */
    protected function getYaml(): string
    {
        $data = (string) file_get_contents($this->getYamlPath());
        return $data;
    }

    /**
     * Returns example broadcaster config YAML as base64 encoded string
     */
    protected function getYamlBase64(): string
    {
        $data = (string) file_get_contents($this->getYamlPath());
        $encoded = base64_encode($data);

        return 'data:application/x-yaml;base64,' . $encoded;
    }

    /**
     * Returns Gotify server URI
     *
     * Return value of `self::$gotifyUri` or environment variable `GOTIFY_URI` if set.
     */
    protected static function getGotifyUri(): string
    {
        if (getenv('GOTIFY_URI') !== false) {
            return getenv('GOTIFY_URI');
        }

        return self::$gotifyUri;
    }

    /**
     * Returns httpbin server URI
     *
     * Return value of `self::$gotifyUri` or  environment variable `HTTPBIN_URI` if set.
     */
    protected static function getHttpBinUri(): string
    {
        if (getenv('HTTPBIN_URI') !== false) {
            return getenv('HTTPBIN_URI');
        }

        return self::$httpBinUri;
    }
}
