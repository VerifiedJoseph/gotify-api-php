<?php

use Gotify\Guzzle;
use Gotify\Json;
use Gotify\Auth\Token as AuthToken;
use Gotify\Auth\User as AuthUser;

class GuzzleTest extends TestCase
{
	private static Guzzle $guzzle;

	public static function setUpBeforeClass(): void
	{
		self::$guzzle = new Guzzle(self::getHttpBinUri());
	}

	/**
	 * Test making a GET request
	 */
	public function testGet(): void
	{
		$query = array(
			'test' => 'HelloWorld'
		);

		$response = self::$guzzle->get('get', $query);
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('args', $body);
		$this->assertObjectHasAttribute('test', $body->args);
		$this->assertEquals('HelloWorld', $body->args->test);
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
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('json', $body);
		$this->assertObjectHasAttribute('test', $body->json);
		$this->assertEquals('HelloWorld', $body->json->test);
	}

	/**
	 * Test making a POST request with a YAML body
	 */
	public function testPostYaml(): void
	{
		$data = $this->getYaml();

		$response = self::$guzzle->PostYaml('post', $data);
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('data', $body);
		$this->assertEquals($data, $body->data);
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
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('files', $body);
		$this->assertObjectHasAttribute('file', $body->files);
		$this->assertEquals($this->getAppImageBase64(), $body->files->file);
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
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('json', $body);
		$this->assertObjectHasAttribute('test', $body->json);
		$this->assertEquals('HelloWorld', $body->json->test);
	}

	/**
	 * Test making a DELETE request
	 */
	public function testDelete(): void
	{
		$response = self::$guzzle->delete('delete');
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
	}

	/**
	 * Test making a GET request with Basic Auth
	 */
	public function testBasicAuth(): void
	{
		$username = 'admin';
		$password = 'adminPassword';

		$auth = new AuthUser(
			$username,
			$password
		);

		$guzzle = new Guzzle(self::getHttpBinUri(), $auth->get());

		$response = $guzzle->get('basic-auth/' . $username . '/' . $password);
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('authenticated', $body);
		$this->assertObjectHasAttribute('user', $body);

		$this->assertEquals(true, $body->authenticated);
		$this->assertEquals($username, $body->user);
	}

	/**
	 * Test making a GET request with a X-Gotify-Key header
	 */
	public function testTokenAuth(): void
	{
		$token = 'HelloWorld';

		$auth = new AuthToken($token);

		$guzzle = new Guzzle(self::getHttpBinUri(), $auth->get());

		$response = $guzzle->get('get');
		$body = (object) Json::decode($response->getBody());

		$this->assertIsObject($body);
		$this->assertObjectHasAttribute('headers', $body);
		$this->assertObjectHasAttribute('X-Gotify-Key', $body->headers);

		$headers = get_object_vars($body->headers);

		$this->assertEquals($token, $headers['X-Gotify-Key']);
	}
}
