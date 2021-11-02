<?php

namespace Gotify;

use JsonException;
use Gotify\Exception\GotifyException;

/**
 * Class for encoding and decoding JSON
 */
final class Json
{
	/**
	 * Encode JSON
	 *
	 * @param array $data
	 * @return string
	 */
	static function encode(array $data)
	{
		try {
			return json_encode($data, flags: JSON_THROW_ON_ERROR);

		} catch (JsonException $err) {
			throw new GotifyException('JSON Error: ' . $err->getMessage());
		}
	}

	/**
	 * Decode JSON
	 *
	 * @param string $json
	 * @return \stdClass
	 */
	public static function decode(string $json)
	{
		try {
			return json_decode($json, flags: JSON_THROW_ON_ERROR);

		} catch (JsonException $err) {
			throw new GotifyException('JSON Error: ' . $err->getMessage());
		}
	}
}
