<?php

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends BaseTestCase
{
	protected static string $serverUri = 'http://127.0.0.1:8080/';
	protected static string $username = 'admin';
	protected static string $password = 'admin';

	protected string $appImage = 'appImage.png';

	protected static Gotify\Server $server;
	protected static Gotify\Auth\User $auth;

	public static function setUpBeforeClass(): void
	{
		self::$server = new Gotify\Server(self::$serverUri);
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
}
