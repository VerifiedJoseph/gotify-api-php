<?php

class UserTest extends TestCase
{
	private static Gotify\Endpoint\User $user;

	private static int $userId = 0;

	private static string $testUsername = 'test';
	private static string $testPassword = 'test';

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$user = new Gotify\Endpoint\User(
			self::$server->get(),
			self::$auth->get()
		);
	}

	/**
	 * Test getting the current user
	 */
	public function testGetCurrent()
	{
		$current = self::$user->getCurrent();

		$this->assertIsObject($current);
	}

	/**
	 * Test getting a user
	 */
	public function testGetUser()
	{
		$user = self::$user->getUser(self::$userId);

		$this->assertIsObject($user);
	}

	/**
	 * Test getting all users
	 */
	public function testGetAll()
	{
		$users = self::$user->getAll();

		$this->assertIsArray($users);

		if (count($users) > 0) {
			$this->assertIsObject($users[0]);
		}
	}

	/**
	 * Test creating a user
	 */
	public function testCreate()
	{
		$created = self::$user->create(
			self::$testUsername,
			self::$testPassword,
			false // Admin status
		);

		$this->assertIsObject($created);
		self::$userId = $created->id;
	}

	/**
	 * Test updating passwrod for the current user
	 */
	public function testUpdatePassword()
	{
		// Login as test user
		$auth = new Gotify\Auth\User(self::$testUsername, self::$testPassword);
		$user = new Gotify\Endpoint\User(
			self::$server->get(),
			$auth->get()
		);

		$updated = $user->updatePassword('NewPassword');
		$this->assertNull($updated);
	}

	/**
	 * Test deleting a user
	 */
	public function testDelete()
	{
		$deleted = self::$user->delete(self::$userId);
		$this->assertNull($deleted);
	}
}
