<?php

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends BaseTestCase
{
	protected static $serverUri = 'http://127.0.0.1:8080/';
	protected $username = 'admin';
	protected $password = 'admin';
	protected $clientToken = 'TokenHere';

	protected static Gotify\Server $server;

	public static function setUpBeforeClass(): void
	{
 		self::$server = new Gotify\Server(self::$serverUri);
	}
}
