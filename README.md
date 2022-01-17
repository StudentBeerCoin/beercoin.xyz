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
- PostgreSQL

### Zalecane

- Linux
- Interpreter PHP 7.4
- `symfony-cli`
- `composer` w wersji 2.*
- PostgreSQL

## Uwaga

Wszystkie przykłady zakładają spełnienie zalecanych wymagań. W przypadku braku `symfony-cli` należy zastąpić `symfony console` na `bin/console`.

## Zanim zaczniesz

Przed uruchomieniem aplikacji należy pobrać zależności:

```bash
$ composer install
```

Kolejnym krokiem jest uzupełnienie informacji w pliku `.env.local` oraz utworzenie bazy danych:

```bash
$ symfony console doctrine:migrations:migrate
```

## Analiza statyczna kodu

Analiza statyczna jest realizowana przy użyciu narzędzia PHPStan. Po zainstalowaniu zależności można uruchomić analizę następującym poleceniem:

```bash
$ php -d memory_limit=1G vendor/bin/phpstan analyze
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

## Uruchamianie aplikacji w środowisku `test`

Środowisko to jest wykorzystywane do automatycznego testowania aplikacji. Ma ono osobną bazę z przykładowymi danymi i nie jest ona powiązana z główną bazą aplikacji.
Na początku należy uzupełnić informacje w pliku `.env.test.local`

```bash
$ symfony console --env=test --no-interaction doctrine:schema:create
$ symfony console --env=test --no-interaction doctrine:schema:update --force
$ symfony console --env=test --no-interaction doctrine:fixtures:load
```

Następnie możliwe jest uruchomienie testów:

```bash
$ vendor/bin/phpunit
```

## Uruchamianie aplikacji w środowisku `prod`

Należy skorzystać z oficjalnej [dokumentacji Symfony](https://symfony.com/doc/current/deployment.html).
