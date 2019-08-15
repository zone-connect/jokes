[![Build Status](https://travis-ci.org/zone-connect/jokes.svg?branch=master)](https://travis-ci.org/zone-connect/jokes)

# Crazzy Jokes

A library for creating random crazzy jokes when you need one!

## Installation

Use the composer tool to include this library to your PHP based project.

```bash
composer install zonec/base
```

## Usage

```php
$factory = new \Zonec\Base\JokesFactory();

$randomJoke = $factory->getRandomJoke();
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
