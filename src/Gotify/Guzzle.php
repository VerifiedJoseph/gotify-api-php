<?php

namespace Gotify;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use Exception;
use InvalidArgumentException;
use Gotify\Exception\UnauthorizedException;

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

	/**
	 * 
	 * @param string $uri Server URI
	 * @param string $token Authentication token
	 */
	function __construct(string $uri, string $token = '')
	{
		$headers = array();

		if (empty($token) === false) {
			$headers['X-Gotify-Key'] = $token;
		}

		$this->client = new Client([
			'base_uri' => $uri,
			'headers' => $headers,
			'Accept' => 'application/json',
			'timeout' => 10,
			'allow_redirects' => false
		]);
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
	public function post(string $endpoint, array $data)
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
	 */
	public function postFile(string $endpoint, array $data)
	{
		$options = array(
			'multipart' => array([
				'name' => 'file',
				'contents' => Psr7\Utils::tryFopen($data['file'], 'r')
			])
		);

		return $this->request('post', $endpoint, $options);
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
	 * @throws UnauthorizedException if server returned unauthorized error
	 */
	private function request(string $method, string $endpoint, array $options = array())
	{
        try {
			if (in_array($method, $this->requestMethods) === false) {
				throw new InvalidArgumentException('Request method must be get, post, put, patch, or delete');
			}

            $response = $this->client->$method($endpoint, $options);

        } catch (ConnectException $err) {
			throw new Exception($err->getMessage());

        } catch (RequestException $err) {
			if ($err->hasResponse() === false) {
				throw new Exception($err->getMessage());
			}

			$response = $err->getResponse();
			$contentType = $response->getHeaderLine('Content-Type');

			if ($contentType === 'application/json') {
				$json = Json::decode($response->getBody());
				$message =  $json->error . ': ' . $json->errorDescription . ' (' . $json->errorCode .')';

				switch($response->getStatusCode()) 
				{
					case 401:
						throw new UnauthorizedException($message);
						break;
					default:
						throw new Exception($message);
				}
			}

			throw new Exception($err->getMessage());
        }

		if ($method === 'delete') { // Delete requests do not return anything
			return null;
		}

		return Json::decode($response->getBody());
	}
} 
