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
Gotify\Endpoint\Application(string $server, array $auth)
```

Class: [Application](../src/Gotify/Endpoint/Application.php)

API docs: [https://gotify.net/api-docs#/application](https://gotify.net/api-docs#/application)

### Methods

Get all applications

```PHP
getAll(): array
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
delete(int $id): null
```

Upload image for an application

```PHP
uploadImage(int $id, string $image): stdClass
```

## ApplicationMessage

```PHP
Gotify\Endpoint\ApplicationMessage(string $server, array $auth)
```

Class: [ApplicationMessage](../src/Gotify/Endpoint/ApplicationMessage.php)

API docs: [https://gotify.net/api-docs#/message](https://gotify.net/api-docs#/message)

### Methods

Get all messages for an application

```PHP
getAll(int $id, int $limit = 100, int $since = 0): stdClass
```

Delete all messages for an application

```PHP
deleteAll(int $id): null
```

## Message

```PHP
Gotify\Endpoint\Message(string $server, array $auth)
```

Class: [Message](../src/Gotify/Endpoint/Message.php)

API docs: [https://gotify.net/api-docs#/message](https://gotify.net/api-docs#/message)

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
delete(int $id): null
```

Delete all messages

```PHP
deleteAll(): null
```

## Client

```PHP
Gotify\Endpoint\Client(string $server, array $auth)
```

Class: [Client](../src/Gotify/Endpoint/Client.php)

API docs: [https://gotify.net/api-docs#/client](https://gotify.net/api-docs#/client)

### Methods

Get all clients

```PHP
getAll(): array
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
delete(int $id): null
```

## User

```PHP
Gotify\Endpoint\User(string $server, array $auth)
```

Class: [User](../src/Gotify/Endpoint/User.php)

API docs: [https://gotify.net/api-docs#/user](https://gotify.net/api-docs#/user)

### Methods

Get current user

```PHP
getCurrent(): stdClass
```

Update password for the current user

```PHP
updatePassword(string $password): null
```

Get a user

```PHP
getUser(int $id): stdClass
```

Get all users

```PHP
getAll(): array
```

Create a user

```PHP
create(string $name, string $password, bool $admin = false): stdClass
```

Delete a user

```PHP
delete(int $id): null
```

## Health

```PHP
Gotify\Endpoint\Health(string $server)
```

Class: [Health](../src/Gotify/Endpoint/Health.php)

API docs: [https://gotify.net/api-docs#/health](https://gotify.net/api-docs#/health)

### Methods

Get health information

```PHP
get(): stdClass
```

## Plugin

```PHP
Gotify\Endpoint\Plugin(string server, array $auth)
```

Class: [Plugin](../src/Gotify/Endpoint/Plugin.php)

API docs: [https://gotify.net/api-docs#/plugin](https://gotify.net/api-docs#/plugin)

### Methods

Get all plugins

```PHP
getAll(): stdClass
```

Get configuration for Configurer plugin.

```PHP
getConfig(int $id): stdClass
```

Get display info for a Displayer plugin

```PHP
getDisplayInfo(int $id): stdClass
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
Gotify\Endpoint\Version(string server)
```

Class: [Version](../src/Gotify/Endpoint/Version.php)

API docs: [https://gotify.net/api-docs#/version](https://gotify.net/api-docs#/version)

### Methods

Get version information

```PHP
get(): stdClass
```
