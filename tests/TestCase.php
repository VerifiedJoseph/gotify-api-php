<?php

use PHPUnit\Framework\TestCase as BaseTestCase;

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

	protected static Gotify\Server $server;
	protected static Gotify\Auth\User $auth;

	public static function setUpBeforeClass(): void
	{
		self::$server = new Gotify\Server(self::getGotifyUri());
		self::$auth = new Gotify\Auth\User(self::$username, self::$password);
	}

	/**
	 * Retruns app image path
	 */
	protected function getAppImagePath(): string
	{
		$path = __DIR__ . '/TestAssets/' . $this->appImage;

		$this->assertFileExists($path);

		return $path;
	}

	/**
	 * Retruns app image as a base64 encoded string
	 */
	protected function getAppImageBase64(): string
	{
		$imageData = (string) file_get_contents($this->getAppImagePath());
		$imageMimeType = mime_content_type($this->getAppImagePath());

		$encoded = base64_encode($imageData);

		return 'data:' . $imageMimeType . ';base64,' . $encoded;
	}

	/**
	 * Retruns Gotify server URI
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
	 * Retruns httpbin server URI
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
