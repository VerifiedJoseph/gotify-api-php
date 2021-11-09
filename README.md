# gotify-api-php

gotify-api-php is a PHP library for interacting with a [Gotify](https://github.com/gotify/server) server using the [Gotify REST-API](https://gotify.net/api-docs).

## Todo

- Add support for the stream endpoint.
- Add class for working with message extras.

## Documentation

- [Endpoint Classes](docs/endpoints.md)
- [Exceptions](docs/exceptions.md)
- [Code examples](examples/)

## Install

```
composer require verifiedjoseph/gotify-api-php
```

## Requirements

- PHP >= 8.0
- Composer
- PHP Extensions:
  - [`JSON`](https://www.php.net/manual/en/book.json.php)
  - [`cURL`](https://secure.php.net/manual/en/book.curl.php)

## Dependencies

[`guzzlehttp/guzzle`](https://github.com/guzzle/guzzle/)

## Changelog

All notable changes to this project are documented in the [CHANGELOG](CHANGELOG.md).

## License

MIT License. Please see [LICENSE](LICENSE) for more information.
