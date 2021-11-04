<?php

use Gotify\Guzzle;

class GuzzleTest extends TestCase
{
	private static Guzzle $guzzle;

	public static function setUpBeforeClass(): void
	{
		self::$guzzle = new Guzzle(self::$httpBinUri);
	}

	/**
	 * Test making a GET request
	 */
	public function testGet(): void
	{
		$response = self::$guzzle->get('get?test=HelloWorld');

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('args', $response);
		$this->assertObjectHasAttribute('test', $response->args);
		$this->assertEquals('HelloWorld', $response->args->test);
	}

	/**
	 * Test making a POST request
	 */
	public function testPost(): void
	{
		$data = array(
			'test' => 'HelloWorld'
		);

		$response = self::$guzzle->post('post', $data);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('json', $response);
		$this->assertObjectHasAttribute('test', $response->json);
		$this->assertEquals('HelloWorld', $response->json->test);
	}

	/**
	 * Test making a POST request with a file
	 */
	public function testPostFile(): void
	{
		$data = array(
			'file' => $this->getAppImagePath()
		);

		$response = self::$guzzle->postFile('post', $data);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('files', $response);
		$this->assertObjectHasAttribute('file', $response->files);
		$this->assertEquals($this->getAppImageBase64(), $response->files->file);
	}

	/**
	 * Test making a PUT request
	 */
	public function testPut(): void
	{
		$data = array(
			'test' => 'HelloWorld'
		);

		$response = self::$guzzle->put('put', $data);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('json', $response);
		$this->assertObjectHasAttribute('test', $response->json);
		$this->assertEquals('HelloWorld', $response->json->test);
	}

	/**
	 * Test making a DELETE request
	 */
	public function testDelete(): void
	{
		$response = self::$guzzle->delete('delete');

		$this->assertIsObject($response);
	}

	/**
	 * Test making a GET request with Basic Auth
	 */
	public function testBasicAuth(): void
	{
		$username = 'admin';
		$password = 'adminPassword';

		$auth = new Gotify\Auth\User(
			$username,
			$password
		);
		
		$guzzle = new Gotify\Guzzle(self::$httpBinUri, $auth->get());
		$response = $guzzle->get('basic-auth/'. $username . '/' . $password);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('authenticated', $response);
		$this->assertObjectHasAttribute('user', $response);

		$this->assertEquals(true, $response->authenticated);
		$this->assertEquals($username, $response->user);
	}

	/**
	 * Test making a GET request with a X-Gotify-Key header
	 */
	public function testTokenAuth(): void
	{
		$token = 'HelloWorld';

		$auth = new \Gotify\Auth\Token($token);
		
		$guzzle = new Gotify\Guzzle(self::$httpBinUri, $auth->get());
		$response = $guzzle->get('get');

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('headers', $response);
		$this->assertObjectHasAttribute('X-Gotify-Key', $response->headers);

		$headers = get_object_vars($response->headers);

		$this->assertEquals($token, $headers['X-Gotify-Key']);
	}
}
