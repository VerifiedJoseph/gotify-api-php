# gotify-api-php

[![Latest Version](https://img.shields.io/github/release/VerifiedJoseph/gotify-api-php.svg?style=flat-square)](https://github.com/VerifiedJoseph/gotify-api-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

gotify-api-php is a PHP library for interacting with a [Gotify](https://github.com/gotify/server) server using the [Gotify REST-API](https://gotify.net/api-docs).

Supported Gotify server version: 2.1.3

## Install

```
composer require verifiedjoseph/gotify-api-php
```

## Quick Start
```PHP
require __DIR__ . '/vendor/autoload.php';

// Set server
$server = new Gotify\Server('https://gotify.example.com/');

// Set application token
$auth = new Gotify\Auth\Token('ApplicationTokenHere');

// Create a message class instance
$message = new Gotify\Endpoint\Message(
  $server->get(),
  $auth->get()
);

// Send a message
$message->create(
  title: 'hello?',
  message: 'Hello World',
  priority: 8,
);
```

## Documentation

- [Endpoint Classes](docs/endpoints.md)
- [Exceptions](docs/exceptions.md)
- [Code examples](docs/examples.md)

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
