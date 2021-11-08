<?php

class AuthTest extends TestCase
{
	/**
	 * Test Auth\User
	 */
	public function testUser(): void
	{
		$method = 'user';
		$username = 'username';
		$password = 'password';

		$auth = new Gotify\Auth\User($username, $password);
		$values = $auth->get();

		$this->assertIsArray($values);
		$this->assertArrayHasKey('method', $values);
		$this->assertArrayHasKey('username', $values);
		$this->assertArrayHasKey('password', $values);

		$this->assertEquals($method, $values['method']);
		$this->assertEquals($username, $values['username']);
		$this->assertEquals($password, $values['password']);
	}

	/**
	 * Test Auth\Token
	 */
	public function testToken(): void
	{
		$method = 'token';
		$token = 'TokenHere';

		$auth = new Gotify\Auth\Token($token);
		$values = $auth->get();

		$this->assertIsArray($values);
		$this->assertArrayHasKey('method', $values);
		$this->assertArrayHasKey('token', $values);

		$this->assertEquals($method, $values['method']);
		$this->assertEquals($token, $values['token']);
	}
}
