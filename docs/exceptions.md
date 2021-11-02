# Exceptions

When the library encounters an error it will always throw an exception. Your code must catch the exceptions listed below.

## GotifyException
```PHP
Gotify\Exception\GotifyException
```

Thrown when the Gotify library experiences an error.

Exmaple: [`Gotify\Server`](../src/Gotify/Server.php) will throw `GotifyException` if the given server URI is invalid.

## EndpointException 
```PHP
Gotify\Exception\EndpointException
```

Thrown when a Gotify API endpoint returns an error.