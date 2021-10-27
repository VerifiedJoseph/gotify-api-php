<?php

namespace Gotify;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use InvalidArgumentException;
use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

// Guzzle exceptions
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

/**
 * Class for making HTTP requests using GuzzleHttp.
 */
final class Guzzle
{
	private Client $client;

	/** @var array $requestMethods Array of supported HTTP request methods */
	private array $requestMethods = array('get', 'post', 'put', 'patch', 'delete');

	/** @var array $timeout Request timeout in seconds */
	private int $timeout = 10;

	/**
	 *
	 * @param string $uri Server URI
	 * @param string $auth Authentication
	 */
	function __construct(string $uri, array $auth = array())
	{
		$config = $this->getConfig($uri, $auth);

		$this->client = new Client($config);
	}

	/**
	 * Make GET request
	 *
	 * @param $endpoint API endpoint
	 * @return \stdClass
	 */
	public function get(string $endpoint)
	{
		return $this->request('get', $endpoint);
	}

	/**
	 * Make POST request
	 *
	 * @param string $endpoint API endpoint
	 * @param array $data
	 * @return \stdClass
	 */
	public function post(string $endpoint, array $data = array())
	{
		$options = array(
			RequestOptions::JSON => $data
		);

		return $this->request('post', $endpoint, $options);
	}

	/**
	 * Make POST request with a file
	 *
	 * @param string $endpoint API endpoint
	 * @param array $data
	 * @return \stdClass
	 * 
	 * @throws GotifyException if the file cannot be opened
	 */
	public function postFile(string $endpoint, array $data)
	{
		try {
			$options = array(
				RequestOptions::MULTIPART => array([
					'name' => 'file',
					'contents' => Psr7\Utils::tryFopen($data['file'], 'r')
				])
			);

			return $this->request('post', $endpoint, $options);
		} catch (\RuntimeException $err) {
			throw new GotifyException($err->getMessage());
		}
	}

	/**
	 * Make PUT request
	 *
	 * @param string $endpoint API endpoint
	 * @param array $data
	 * @return \stdClass
	 */
	public function put(string $endpoint, array $data)
	{
		$options = array(
			RequestOptions::JSON => $data
		);

		return $this->request('put', $endpoint, $options);
	}

	/**
	 * Make DELETE request
	 *
	 * @param string $endpoint API endpoint
	 * @return \stdClass|null
	 */
	public function delete(string $endpoint)
	{
		return $this->request('delete', $endpoint);
	}

	/**
	 * Make HTTP request
	 *
	 * @param string $method HTTP request method
	 * @param string $endpoint API endpoint
	 * @param array $options HTTP request options
	 * @return \stdClass|null
	 *
	 * @throws InvalidArgumentException if HTTP request method is not supported
	 * @throws EndpointException if API returned an error
	 */
	private function request(string $method, string $endpoint, array $options = array())
	{
		try {
			if (in_array($method, $this->requestMethods) === false) {
				throw new InvalidArgumentException('Request method must be get, post, put, patch, or delete');
			}

			$response = $this->client->$method($endpoint, $options);

		} catch (ConnectException $err) {
			throw new GotifyException($err->getMessage());

		} catch (RequestException $err) {
			if ($err->hasResponse() === false) {
				throw new EndpointException($err->getMessage(), $response->getStatusCode());
			}

			$response = $err->getResponse();
			$contentType = $response->getHeaderLine('Content-Type');

			if ($contentType === 'application/json') {
				$json = Json::decode($response->getBody());
				$message = $json->error . ': ' . $json->errorDescription . ' (' . $json->errorCode . ')';

				throw new EndpointException($message, $json->errorCode);
			}

			throw new EndpointException($err->getMessage(), $response->getStatusCode());
		}

		if (empty($response->getBody()->getContents())) { // Some requests do not return anything
			return null;
		}

		return Json::decode($response->getBody());
	}

	/**
	 * Get GuzzleHttp client config
	 *
	 * @param string $uri Server URI
	 * @param string $auth Authentication
	 *
	 * @return array
	 */
	private function getConfig(string $uri, array $auth) {
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
	 * @param string $auth Authentication
	 *
	 * @return array
	 */
	private function getAuthConfig(array $auth) {
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
