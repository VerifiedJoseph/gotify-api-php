<?php

namespace Gotify;

use stdClass;

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
     * @param array<mixed> $data
     * @return string
     *
     * @throws GotifyException if array could not be encoded
     */
    public static function encode(array $data): string
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
     * @return stdClass|array<mixed>
     *
     * @throws GotifyException if JSON could not be decoded
     */
    public static function decode(string $json): stdClass|array
    {
        try {
            $decoded = json_decode($json, flags: JSON_THROW_ON_ERROR);

            if (is_array($decoded) === true) {
                return (array) $decoded;
            }

            return (object) $decoded;
        } catch (JsonException $err) {
            throw new GotifyException('JSON Error: ' . $err->getMessage());
        }
    }
}
