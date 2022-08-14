# Authentication Classes

## Token

```PHP
Gotify\Auth\Token(string $token)
```

Class: [Token](../src/Auth/Token.php)

### Examples
- [Create a message](../examples/Message/create.php)
- [Get all applications](../examples/Application/get.php)

### Methods

Get token and authentication method

```PHP
get(): array
```

## User

```PHP
Gotify\Auth\User(string $username, string $password)
```

Class: [User](../src/Auth/User.php)

### Examples
- [Create a client](../examples/Client/create.php)

### Methods

Get username, password and authentication method

```PHP
get(): array
```