<?php

namespace Gotify;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

// Guzzle exceptions
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

use function Gotify\json_decode;

/**
 * Class for making HTTP requests using GuzzleHttp.
 */
final class Guzzle
{
	private Client $client;

	/** @var array<int, string> $requestMethods Array of supported HTTP request methods */
	private array $requestMethods = array('GET', 'POST', 'PUT', 'DELETE');

	/** @var int $timeout Request timeout in seconds */
	private int $timeout = 10;

	/**
	 *
	 * @param string $uri Server URI
	 * @param array<string, string> $auth Authentication
	 */
	function __construct(string $uri, array $auth = array())
	{
		$config = $this->getConfig($uri, $auth);

		$this->client = new Client($config);
	}

	/**
	 * Make GET request
	 *
	 * @param string $endpoint API endpoint
	 * @param array<string, mixed> $query HTTP Query data
	 * @return ResponseInterface
	 */
	public function get(string $endpoint, array $query = array()): ResponseInterface
	{
		$options = array(
			RequestOptions::QUERY => $query
		);

		return $this->request('GET', $endpoint, $options);
	}

	/**
	 * Make POST request a JOSN payload
	 *
	 * @param string $endpoint API endpoint
	 * @param array<string, mixed> $data
	 * @return ResponseInterface
	 */
	public function post(string $endpoint, array $data = array()): ResponseInterface
	{
		$options = array(
			RequestOptions::JSON => $data
		);

		return $this->request('POST', $endpoint, $options);
	}

	/**
	 * Make POST request with a YAML payload
	 *
	 * @param string $endpoint API endpoint
	 * @param string $data
	 * @return ResponseInterface
	 */
	public function postYaml(string $endpoint, string $data): ResponseInterface
	{
		$options = array(
			'headers' => [
				'content-type' => 'application/x-yaml',
			],
			'body' => $data
		);

		return $this->request('POST', $endpoint, $options);
	}

	/**
	 * Make POST request with a file
	 *
	 * @param string $endpoint API endpoint
	 * @param array<string, string> $data
	 * @return ResponseInterface
	 *
	 * @throws GotifyException if the file cannot be opened
	 */
	public function postFile(string $endpoint, array $data): ResponseInterface
	{
		try {
			$options = array(
				RequestOptions::MULTIPART => array([
					'name' => 'file',
					'contents' => Psr7\Utils::tryFopen($data['file'], 'r')
				])
			);

			return $this->request('POST', $endpoint, $options);
		} catch (\RuntimeException $err) {
			throw new GotifyException($err->getMessage());
		}
	}

	/**
	 * Make PUT request
	 *
	 * @param string $endpoint API endpoint
	 * @param array<string, string> $data
	 * @return ResponseInterface
	 */
	public function put(string $endpoint, array $data): ResponseInterface
	{
		$options = array(
			RequestOptions::JSON => $data
		);

		return $this->request('PUT', $endpoint, $options);
	}

	/**
	 * Make DELETE request
	 *
	 * @param string $endpoint API endpoint
	 * @return ResponseInterface
	 */
	public function delete(string $endpoint): ResponseInterface
	{
		return $this->request('DELETE', $endpoint);
	}

	/**
	 * Make HTTP request
	 *
	 * @param string $method HTTP request method
	 * @param string $endpoint API endpoint
	 * @param array<string, mixed> $options HTTP request options
	 * @return ResponseInterface
	 *
	 * @throws GotifyException if HTTP request method is not supported
	 * @throws GotifyException if a connection cannot be established
	 * @throws EndpointException if API returned an error
	 */
	private function request(string $method, string $endpoint, array $options = array()): ResponseInterface
	{
		try {
			if (in_array($method, $this->requestMethods) === false) {
				throw new GotifyException('Request method must be GET, POST, PUT, or DELETE');
			}

			$response = $this->client->request($method, $endpoint, $options);

		} catch (ConnectException $err) {
			throw new GotifyException($err->getMessage());

		} catch (RequestException $err) {
			if ($err->hasResponse() === false) {
				throw new EndpointException($err->getMessage(), 0);
			}

			$response = $err->getResponse();
			$contentType = $response->getHeaderLine('Content-Type');

			if ($contentType === 'application/json') {
				$json = (object) json_decode($response->getBody());
				$message = $json->error . ': ' . $json->errorDescription . ' (' . $json->errorCode . ')';

				throw new EndpointException($message, $json->errorCode);
			}

			throw new EndpointException($err->getMessage(), $response->getStatusCode());
		}

		return $response;
	}

	/**
	 * Get GuzzleHttp client config
	 *
	 * @param string $uri Server URI
	 * @param array<string, string> $auth Authentication
	 *
	 * @return array<string, mixed> Returns client config array
	 */
	private function getConfig(string $uri, array $auth): array
	{
		$config = array(
			'base_uri' => $uri,
			'Accept' => 'application/json',
			'timeout' => $this->timeout,
			'allow_redirects' => false,
		);

		$config = array_merge(
			$config,
			$this->getAuthConfig($auth)
		);

		return $config;
	}

	/**
	 * Get authentication config
	 *
	 * @param array<string, string> $auth Authentication
	 *
	 * @return array<string, array<int|string, string>>
	 */
	private function getAuthConfig(array $auth): array
	{
		$config = array();

		if (isset($auth['method'])) {
			switch($auth['method']) {
				case 'user':
					$config[RequestOptions::AUTH] = array(
						$auth['username'],
						$auth['password']
					);

					break;
				case 'token':
					$config[RequestOptions::HEADERS] = array(
						'X-Gotify-Key' => $auth['token']
					);

					break;
			}
		}

		return $config;
	}
}
