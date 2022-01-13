# gotify-api-php

[![Latest Version](https://img.shields.io/github/release/VerifiedJoseph/gotify-api-php.svg?style=flat-square)](https://github.com/VerifiedJoseph/gotify-api-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

gotify-api-php is a PHP library for interacting with a [Gotify](https://github.com/gotify/server) server using the [Gotify REST-API](https://gotify.net/api-docs).

Supports Gotify server version 2.1.4.

## Install

```
composer require verifiedjoseph/gotify-api-php
```

## Quick Start
```PHP
require __DIR__ . '/vendor/autoload.php';

use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;

// Set server
$server = new Server('https://gotify.example.com/');

// Set application token
$auth = new Token('ApplicationTokenHere');

// Create a message class instance
$message = new Message(
  $server->get(),
  $auth->get()
);

// Send a message
$message->create(
  title: 'hello?',
  message: 'Hello World',
  priority: Message::PRIORITY_HIGH,
);
```

## Documentation
- [Authentication](docs/auth.md)
- [Endpoints](docs/endpoints.md)
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
