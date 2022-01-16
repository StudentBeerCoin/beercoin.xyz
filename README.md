# BeerCoin

[![CI](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/CI.yml/badge.svg)](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/CI.yml)
[![phpstan](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/phpstan.yml/badge.svg)](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/phpstan.yml)
[![phpunit](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/phpunit.yml/badge.svg)](https://github.com/StudentBeerCoin/beercoin.xyz/actions/workflows/phpunit.yml)
[![coverage](https://codecov.io/gh/StudentBeerCoin/beercoin.xyz/branch/master/graph/badge.svg)](https://app.codecov.io/gh/StudentBeerCoin/beercoin.xyz/)
[![wakatime](https://wakatime.com/badge/github/StudentBeerCoin/beercoin.xyz.svg)](https://wakatime.com/badge/github/StudentBeerCoin/beercoin.xyz)

## Wymagania

### Minimalne

- Interpreter PHP 7.4
- `composer` w wersji 2.*

### Zalecane

- Linux
- Interpreter PHP 7.4
- `symfony-cli`
- `composer` w wersji 2.*

## Zanim zaczniesz

Przed uruchomieniem aplikacji należy pobrać zależności:

```bash
$ composer install
```

## Uruchamianie aplikacji w środowisku `dev`

### Z użyciem `symfony-cli`

```bash
$ symfony server:start
```

Więcej informacji w [dokumentacji Symfony](https://symfony.com/doc/current/setup/symfony_server.html).

### Z użyciem `php`

```bash
$ php -S 127.0.0.1:8000 ./public/index.php
```

Po uruchomieniu serwera, aplikacja jest dostępna pod adresem [http://127.0.0.1:8000/](http://127.0.0.1:8000/).

### Z użyciem `apache2`/`nginx`

Należy skorzystać z oficjalnej [dokumentacji Symfony](https://symfony.com/doc/current/setup/web_server_configuration.html).

## Uruchamianie aplikacji w środowisku `prod`

Należy skorzystać z oficjalnej [dokumentacji Symfony](https://symfony.com/doc/current/deployment.html).
