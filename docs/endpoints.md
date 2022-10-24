# Endpoint Classes

Jump to:

- [Application](#application)
- [ApplicationMessage](#applicationmessage)
- [Message](#message)
- [Client](#client)
- [User](#user)
- [Health](#health)
- [Plugin](#plugin)
- [Version](#version)

## Application

```PHP
Gotify\Endpoint\Application(Server $server, ?auth $server)
```

Class: [Application](../src/Endpoint/Application.php)

API docs: [https://gotify.net/api-docs#/application](https://gotify.net/api-docs#/application)

### Examples
- [Get all applications](../examples/Application/get.php)
- [Create an application](../examples/Application/create.php)

### Methods

Get all applications

```PHP
getAll(): stdClass
```

Create an application

```PHP
create(string $name, string $description): stdClass
```

Update an application

```PHP
update(int $id, string $name, string $description): stdClass
```

Delete an application

```PHP
delete(int $id): boolean
```

Upload image for an application

```PHP
uploadImage(int $id, string $image): stdClass
```

## ApplicationMessage

```PHP
Gotify\Endpoint\ApplicationMessage(Server $server, ?auth $server)
```

Class: [ApplicationMessage](../src/Endpoint/ApplicationMessage.php)

API docs: [https://gotify.net/api-docs#/message](https://gotify.net/api-docs#/message)

### Methods

Get all messages for an application

```PHP
getAll(int $id, int $limit = 100, int $since = 0): stdClass
```

Delete all messages for an application

```PHP
deleteAll(int $id): boolean
```

## Message

```PHP
Gotify\Endpoint\Message(Server $server, ?auth $server)
```

Class: [Message](../src/Endpoint/Message.php)

API docs: [https://gotify.net/api-docs#/message](https://gotify.net/api-docs#/message)

### Examples
- [Get all messages](../examples/Message/get.php)
- [Create a message](../examples/Message/create.php)
- [Create a message with extras](../examples/Message/create-with-extras.php)

### Constants

High message priority

```PHP
Gotify\Endpoint\Message::PRIORITY_HIGH
```

Default message priority

```PHP
Gotify\Endpoint\Message::PRIORITY_DEFAULT
```

Low message priority

```PHP
Gotify\Endpoint\Message::PRIORITY_LOW
```

Minimum message priority

```PHP
Gotify\Endpoint\Message::PRIORITY_MIN
```

### Methods

Get all messages

```PHP
getAll(int $limit = 100, int $since = 0): stdClass
```

Create a message

```PHP
create(string $title, string $message, int $priority = 0, array $extras = array(): stdClass
```

Delete a message

```PHP
delete(int $id): boolean
```

Delete all messages

```PHP
deleteAll(): boolean
```

## Client

```PHP
Gotify\Endpoint\Client(Server $server, ?auth $server)
```

Class: [Client](../src/Endpoint/Client.php)

API docs: [https://gotify.net/api-docs#/client](https://gotify.net/api-docs#/client)

### Examples 
- [Create a client](../examples/Client/create.php)
- [Get all Clients](../examples/Client/get.php)

### Methods

Get all clients

```PHP
getAll(): stdClass
```

Create a client

```PHP
create(string $name): stdClass
```

Update a client

```PHP
 update(int $id, string $name): stdClass
```

Delete a client

```PHP
delete(int $id): boolean
```

## User

```PHP
Gotify\Endpoint\User(Server $server, ?auth $server)
```

Class: [User](../src/Endpoint/User.php)

API docs: [https://gotify.net/api-docs#/user](https://gotify.net/api-docs#/user)

### Examples
- [Create a user](../examples/User/create.php)

### Methods

Get current user

```PHP
getCurrent(): stdClass
```

Update password for the current user

```PHP
updatePassword(string $password): boolean
```

Get a user

```PHP
getUser(int $id): stdClass
```

Get all users

```PHP
getAll(): stdClass
```

Create a user

```PHP
create(string $name, string $password, bool $admin = false): stdClass
```

Update a user

```PHP
update(int $id, string $name, string $password = '', bool $admin = false): stdClass
```

Delete a user

```PHP
delete(int $id): boolean
```

## Health

```PHP
Gotify\Endpoint\Health(Server $server)
```

Class: [Health](../src/Endpoint/Health.php)

API docs: [https://gotify.net/api-docs#/health](https://gotify.net/api-docs#/health)

### Methods

Get health information

```PHP
get(): stdClass
```

## Plugin

```PHP
Gotify\Endpoint\Plugin(Server $server, ?auth $server)
```

Class: [Plugin](../src/Endpoint/Plugin.php)

API docs: [https://gotify.net/api-docs#/plugin](https://gotify.net/api-docs#/plugin)

### Methods

Get all plugins

```PHP
getAll(): stdClass
```

Get configuration for a plugin.

```PHP
getConfig(int $id): string
```

Update configuration for a plugin.

```PHP
updateConfig(int $id, string $config): bool
```

Get display info for a plugin

```PHP
getDisplayInfo(int $id): string
```

Enable a plugin

```PHP
enable(int $id): stdClass
```

Disable a plugin

```PHP
disable(int $id): stdClass
```

## Version

```PHP
Gotify\Endpoint\Version(Server $server)
```

Class: [Version](../src/Endpoint/Version.php)

API docs: [https://gotify.net/api-docs#/version](https://gotify.net/api-docs#/version)

### Examples
- [Get version information](../examples/Version/get.php)

### Methods

Get version information

```PHP
get(): stdClass
```
