<?php

use PHPUnit\Framework\TestCase as BaseTestCase;
use Gotify\Server;
use Gotify\Auth\User as AuthUser;

/**
 * Class TestCase
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends BaseTestCase
{
    protected static string $gotifyUri = 'http://127.0.0.1:8080/';
    protected static string $httpBinUri = 'https://httpbin.org/';

    protected static string $username = 'admin';
    protected static string $password = 'admin';

    protected string $appImage = 'appImage.png';
    protected string $yaml = 'broadcaster-config.yaml';

    protected static Server $server;
    protected static AuthUser $auth;

    public static function setUpBeforeClass(): void
    {
        self::$server = new Server(self::getGotifyUri());
        self::$auth = new AuthUser(self::$username, self::$password);
    }

    /**
     * Returns text fle path
     */
    protected function getTextFilePath(): string
    {
        $path = __DIR__ . '/TestAssets/file.txt';

        $this->assertFileExists($path);

        return $path;
    }

    /**
     * Returns YAML path
     */
    protected function getYamlPath(): string
    {
        $path = __DIR__ . '/TestAssets/' . $this->yaml;

        $this->assertFileExists($path);

        return $path;
    }

    /**
     * Returns app image path
     */
    protected function getAppImagePath(): string
    {
        $path = __DIR__ . '/TestAssets/' . $this->appImage;

        $this->assertFileExists($path);

        return $path;
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
