<?php

use Gotify\Guzzle;
use Gotify\Json;
use Gotify\Auth\Token as AuthToken;
use Gotify\Auth\User as AuthUser;
use Gotify\Exception\GotifyException;

class GuzzleTest extends AbstractTestCase
{
    private static Guzzle $guzzle;

    public static function setUpBeforeClass(): void
    {
        self::$guzzle = new Guzzle(self::getHttpBinUri(), null);
    }

    /**
     * Test making a GET request
     */
    public function testGet(): void
    {
        $query = [
            'test' => 'HelloWorld'
        ];

        $response = self::$guzzle->get('get', $query);
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('args', $body);
        $this->assertObjectHasProperty('test', $body->args);
        $this->assertEquals('HelloWorld', $body->args->test[0]);
    }

    /**
     * Test making a POST request
     */
    public function testPost(): void
    {
        $data = [
            'test' => 'HelloWorld'
        ];

        $response = self::$guzzle->post('post', $data);
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('json', $body);
        $this->assertObjectHasProperty('test', $body->json);
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
        $this->assertObjectHasProperty('data', $body);
        $this->assertEquals($this->getYamlBase64(), $body->data);
    }

    /**
     * Test making a POST request with a file
     */
    public function testPostFile(): void
    {
        $data = [
            'file' => $this->getTextFilePath()
        ];

        $response = self::$guzzle->postFile('post', $data);
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('files', $body);
        $this->assertObjectHasProperty('file', $body->files);
        $this->assertEquals(file_get_contents($this->getTextFilePath()), $body->files->file[0]);
    }

    /**
     * Test making a POST request with a non-existent file
     */
    public function testPostFileWithMissingFile(): void
    {
        $this->expectException(GotifyException::class);
        $this->expectExceptionMessage('Unable to open "not-found.file"');

        $data = [
            'file' => 'not-found.file'
        ];

        self::$guzzle->postFile('post', $data);
    }

    /**
     * Test making a PUT request
     */
    public function testPut(): void
    {
        $data = [
            'test' => 'HelloWorld'
        ];

        $response = self::$guzzle->put('put', $data);
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('json', $body);
        $this->assertObjectHasProperty('test', $body->json);
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

        $guzzle = new Guzzle(self::getHttpBinUri(), $auth);

        $response = $guzzle->get('basic-auth/' . $username . '/' . $password);
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('authorized', $body);
        $this->assertObjectHasProperty('user', $body);

        $this->assertEquals(true, $body->authorized);
        $this->assertEquals($username, $body->user);
    }

    /**
     * Test making a GET request with a X-Gotify-Key header
     */
    public function testTokenAuth(): void
    {
        $token = 'HelloWorld';

        $auth = new AuthToken($token);

        $guzzle = new Guzzle(self::getHttpBinUri(), $auth);

        $response = $guzzle->get('get');
        $body = (object) Json::decode($response->getBody());

        $this->assertIsObject($body);
        $this->assertObjectHasProperty('headers', $body);
        $this->assertObjectHasProperty('X-Gotify-Key', $body->headers);

        $headers = get_object_vars($body->headers);

        $this->assertEquals($token, $headers['X-Gotify-Key'][0]);
    }
}
